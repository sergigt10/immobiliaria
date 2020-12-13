<?php
  class Categories extends Controller {

    public function __construct(){
      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }
      $this->categoriaModel = $this->model('Categoria');
    }

    // Get categories
    public function index(){
      // Call model with switch
      $categories = $this->categoriaModel->getCategories();

      $data = [
        'categories' => $categories
      ];

      // Send to View
      $this->view('categories/index', $data);
    }

    // Add new categoria
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
          $data['nom_cat_err'] = 'Introduïr el nom de la categoria en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el nom de la categoria en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el nom de la categoria en anglès';
        }
        
        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_cat_err']) && empty($data['nom_cat_err'])){

          if($this->categoriaModel->add($data)){
            flash('categoria_message', 'Categoria afegida correctament');
            redirect('categories');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('categories/add', $data);
        }

      } else {
        $data = [
          'nom_cat' => '',
          'nom_esp' => '',
          'nom_eng' => '',
          'activat' => '',
        ];
        $this->view('categories/add', $data);
      }
    }

    // Editar categoria
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
          $data['nom_cat_err'] = 'Introduïr el nom de la categoria en català';
        }

        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el nom de la categoria en castellà';
        }

        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el nom de la categoria en anglès';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_cat_err']) && empty($data['nom_cat_err'])){
          // Validated
          if($this->categoriaModel->update($data)){
            flash('categoria_message', 'Categoria actualitzada correctament');
            redirect('categories');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('categories/edit', $data);
        }

      } else {

        // Get existing característica from model
        $categoria = $this->categoriaModel->getcategoriaById($id);

        $data = [
          'id' => $id,
          'nom_cat' => $categoria->nom_cat,
          'nom_esp' => $categoria->nom_esp,
          'nom_eng' => $categoria->nom_eng,
          'activat' => $categoria->activat,
        ];
  
        $this->view('categories/edit', $data);
      }
    }

    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->categoriaModel->delete($id)){
          flash('categoria_message', 'Categoria eliminada');
          redirect('categories');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('categories');
      }
    }

  }