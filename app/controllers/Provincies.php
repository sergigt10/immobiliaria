<?php
  class Provincies extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }
      $this->provinciaModel = $this->model('Provincia');
    }

    // Get províncies
    public function index(){
      // Call model with switch
      $provincies = $this->provinciaModel->getProvincies();

      $data = [
        'provincies' => $provincies
      ];

      // Send to View
      $this->view('provincies/index', $data);
    }

    // Add new provincia
    public function add(){
      // POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'nom_cat' => trim(ucfirst($_POST['nom_cat'])),
          'activat' => trim($_POST['activat']),
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la província';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err'])){

          if($this->provinciaModel->add($data)){
            flash('provincia_message', 'Província afegida correctament');
            redirect('provincies');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('provincies/add', $data);
        }

      } else {
        $data = [
          'nom_cat' => '',
          'activat' => '',
        ];
        $this->view('provincies/add', $data);
      }
    }

    // Editar provincia
    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'nom_cat' => trim($_POST['nom_cat']),
          'activat' => trim($_POST['activat'])
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la població';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err'])){
          // Validated
          if($this->provinciaModel->update($data)){
            flash('provincia_message', 'Població actualitzada correctament');
            redirect('provincies');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('provincies/edit', $data);
        }

      } else {

        // Get existing provincia from model
        $provincia = $this->provinciaModel->getProvinciaById($id);

        $data = [
          'id' => $id,
          'nom_cat' => $provincia->nom_cat,
          'activat' => $provincia->activat,
        ];
  
        $this->view('provincies/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->provinciaModel->delete($id)){
          flash('provincia_message', 'Província eliminada');
          redirect('provincies');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('provincies');
      }
    }

  }