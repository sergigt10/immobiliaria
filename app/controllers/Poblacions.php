<?php
  class Poblacions extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }
      $this->poblacioModel = $this->model('Poblacio');
      $this->provinciaModel = $this->model('Provincia');
    }

    // Get poblacions
    public function index(){
      // Call model with switch
      $poblacions = $this->poblacioModel->getPoblacions();

      $data = [
        'poblacions' => $poblacions
      ];

      // Send to View
      $this->view('poblacions/index', $data);
    }

    // Add new poblacio
    public function add(){

      $provincies = $this->provinciaModel->getProvinciesActivats();
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
            redirect('poblacions');
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

      $provincies = $this->provinciaModel->getProvinciesActivats();
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
            redirect('poblacions');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('poblacions/edit', $data);
        }

      } else {

        // Get existing poblacio from model
        $poblacio = $this->poblacioModel->getPoblacioById($id);

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
          flash('poblacio_message', 'Població eliminada');
          redirect('poblacions');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('poblacions');
      }
    }

  }