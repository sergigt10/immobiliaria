<?php
  class Caracteristiques extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }
      $this->caracteristicaModel = $this->model('Caracteristica');
    }

    // Get caracteristiques
    public function index(){
      // Call model with switch
      $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

      $data = [
        'caracteristiques' => $caracteristiques
      ];

      // Send to View
      $this->view('caracteristiques/index', $data);
    }

    // Add new caracteristica
    public function add(){
      // POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'nom_cat' => trim(ucfirst($_POST['nom_cat'])),
          'nom_esp' => trim(ucfirst($_POST['nom_esp'])),
          'nom_eng' => trim(ucfirst($_POST['nom_eng'])),
          'activat' => trim($_POST['activat']),
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la característica en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el nom de la característica en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el nom de la característica en anglès';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_cat_err']) && empty($data['nom_cat_err'])){

          if($this->caracteristicaModel->add($data)){
            flash('caracteristica_message', 'Característica afegida correctament');
            redirect('caracteristiques/index');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('caracteristiques/add', $data);
        }

      } else {
        $data = [
          'nom_cat' => '',
          'nom_esp' => '',
          'nom_eng' => '',
          'activat' => '',
        ];
        $this->view('caracteristiques/add', $data);
      }
    }

    // Editar característica
    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'nom_cat' => trim(ucfirst($_POST['nom_cat'])),
          'nom_esp' => trim(ucfirst($_POST['nom_esp'])),
          'nom_eng' => trim(ucfirst($_POST['nom_eng'])),
          'activat' => trim($_POST['activat'])
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom de la característica en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el nom de la característica en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el nom de la característica en anglès';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_cat_err']) && empty($data['nom_cat_err'])){
          // Validated
          if($this->caracteristicaModel->update($data)){
            flash('caracteristica_message', 'Característica actualitzada correctament');
            redirect('caracteristiques/index');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('caracteristiques/edit', $data);
        }

      } else {

        // Get existing característica from model
        $caracteristica = $this->caracteristicaModel->getCaracteristicaById($id);

        $data = [
          'id' => $id,
          'nom_cat' => $caracteristica->nom_cat,
          'nom_esp' => $caracteristica->nom_esp,
          'nom_eng' => $caracteristica->nom_eng,
          'activat' => $caracteristica->activat,
        ];
  
        $this->view('caracteristiques/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->caracteristicaModel->delete($id)){
          flash('caracteristica_message', 'Característica eliminada correctamente');
          redirect('caracteristiques');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('caracteristiques');
      }
    }

  }