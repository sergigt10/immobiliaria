<?php
  class Poblacions extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
        return false;
      }
      $this->poblacioModel = $this->model('Poblacio');
      $this->provinciaModel = $this->model('Provincia');
    }

    // Get poblacions
    public function index(){
      // Call model with switch
      $poblacions = $this->poblacioModel->getPoblacionsWithProvincies();

      $data = [
        'poblacions' => $poblacions
      ];

      // Send to View
      $this->view('poblacions/index', $data);
    }

    // Add new poblacio
    public function add(){

      $provincies = $this->provinciaModel->getProvinciesActives();
      // POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'nom_cat' => trim(ucfirst($_POST['nom_cat'])),
          'activat' => trim($_POST['activat']),
          'provincia_id' => trim($_POST['provincia_id']),
          'provincies' => $provincies
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la població';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err'])){

          if($this->poblacioModel->add($data)){
            flash('poblacio_message', 'Població afegida correctament');
            redirect('poblacions/index');
            return false;
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('poblacions/add', $data);
        }

      } else {

        $data = [
          'nom_cat' => '',
          'activat' => '',
          'provincia_id' => '',
          'provincies' => $provincies
        ];
        $this->view('poblacions/add', $data);
      }
    }

    // Editar poblacio
    public function edit($id){

      // Get existing poblacio from model
      $poblacio = $this->poblacioModel->getPoblacioById(intval($id));

      // Control of parameter
      if( !$poblacio ) {
        flash('poblacio_message', 'Aquesta població no existeix', 'alert alert-danger');
        redirect('poblacions/index');
        return false;
      }

      $provincies = $this->provinciaModel->getProvinciesActives();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'nom_cat' => trim($_POST['nom_cat']),
          'activat' => trim($_POST['activat']),
          'provincia_id' => trim($_POST['provincia_id']),
          'provincies' => $provincies
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la població';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err'])){
          // Validated
          if($this->poblacioModel->update($data)){
            flash('poblacio_message', 'Població actualitzada correctament');
            redirect('poblacions/index');
            return false;
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('poblacions/edit', $data);
        }

      } else {

        $data = [
          'id' => $id,
          'nom_cat' => $poblacio->nom_cat,
          'activat' => $poblacio->activat,
          'provincia_id' => $poblacio->provincia_id,
          'provincies' => $provincies
        ];
  
        $this->view('poblacions/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->poblacioModel->delete($id)){
          flash('poblacio_message', 'Població eliminada correctament');
          redirect('poblacions/index');
          return false;
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('poblacions/index');
        return false;
      }
    }

  }