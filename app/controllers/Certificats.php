<?php
  class Certificats extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }
      $this->certificatModel = $this->model('Certificat');
    }

    // Get províncies
    public function index(){
      // Call model with switch
      $certificats = $this->certificatModel->getCertificats();

      $data = [
        'certificats' => $certificats
      ];

      // Send to View
      $this->view('certificats/index', $data);
    }

    // Add new certificat
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
          $data['nom_cat_err'] = 'Introduïr el nom del certificat';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err'])){

          if($this->certificatModel->add($data)){
            flash('certificat_message', 'Certificat afegit correctament');
            redirect('certificats/index');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('certificats/add', $data);
        }

      } else {
        $data = [
          'nom_cat' => '',
          'activat' => '',
        ];
        $this->view('certificats/add', $data);
      }
    }

    // Editar certificats
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
          $data['nom_cat_err'] = 'Introduïr el nom del certificat';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err'])){
          // Validated
          if($this->certificatModel->update($data)){
            flash('certificat_message', 'Certificat actualitzat correctament');
            redirect('certificats/index');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('certificats/edit', $data);
        }

      } else {

        // Get existing certificat from model
        $certificat = $this->certificatModel->getCertificatById($id);

        $data = [
          'id' => $id,
          'nom_cat' => $certificat->nom_cat,
          'activat' => $certificat->activat,
        ];
  
        $this->view('certificats/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->certificatModel->delete($id)){
          flash('certificat_message', 'Certificat eliminat correctament');
          redirect('certificats/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('certificats/index');
      }
    }

  }