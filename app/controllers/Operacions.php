<?php
  class Operacions extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
        return false;
      }
      $this->operacioModel = $this->model('Operacio');
    }

    // Get operacions
    public function index(){
      // Call model with switch
      $operacions = $this->operacioModel->getOperacions();

      $data = [
        'operacions' => $operacions
      ];

      // Send to View
      $this->view('operacions/index', $data);
    }

    // Add new operacio
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
          $data['nom_cat_err'] = 'Introduïr el tipus d\'operació en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el tipus d\'operació en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el tipus d\'operació en anglès';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_esp_err']) && empty($data['nom_eng_err'])){

          if($this->operacioModel->add($data)){
            flash('operacio_message', 'Tipus d\'operació afegida correctament');
            redirect('operacions/index');
            return false;
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('operacions/add', $data);
        }

      } else {
        $data = [
          'nom_cat' => '',
          'nom_esp' => '',
          'nom_eng' => '',
          'activat' => '',
        ];
        $this->view('operacions/add', $data);
      }
    }

    // Editar operacio
    public function edit($id){

      // Get existing característica from model
      $operacio = $this->operacioModel->getOperacioById(intval($id));

      // Control of parameter
      if( !$operacio ) {
        flash('operacio_message', 'Aquesta operació no existeix', 'alert alert-danger');
        redirect('operacions/index');
        return false;
      }

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
          $data['nom_cat_err'] = 'Introduïr el tipus d\'operació en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el tipus d\'operació en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el tipus d\'operació en anglès';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_esp_err']) && empty($data['nom_eng_err'])){
          // Validated
          if($this->operacioModel->update($data)){
            flash('operacio_message', 'Tipus d\'operació actualitzada correctament');
            redirect('operacions/index');
            return false;
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('operacions/edit', $data);
        }

      } else {

        $data = [
          'id' => $id,
          'nom_cat' => $operacio->nom_cat,
          'nom_esp' => $operacio->nom_esp,
          'nom_eng' => $operacio->nom_eng,
          'activat' => $operacio->activat,
        ];
  
        $this->view('operacions/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->operacioModel->delete($id)){
          flash('operacio_message', 'Tipus d\'operació eliminada correctament');
          redirect('operacions/index');
          return false;
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('operacions/index');
        return false;
      }
    }

  }