<?php
  class Menus extends Controller {
    public function __construct(){
      // Sino esta registrado
      // Función helper
      if(!isLoggedIn()){
        redirect('users/login');
      }
      // Importamos los modelos
      $this->menuModel = $this->model('Menu');
      $this->userModel = $this->model('User');
    }

    // Cargar menu
    public function index(){
      // Get menus
      $menus = $this->menuModel->getMenus();
      // Cargamos el array
      $data = [
        'menus' => $menus
      ];
      // Mostramos en la vista
      $this->view('menus/index', $data);
    }

    public function add(){
      // Si viene de un POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'primers' => trim($_POST['primers']),
          'segons' => trim($_POST['segons']),
          'postres' => trim($_POST['postres']),
          'preu' => trim($_POST['preu']),
          'dia' => trim($_POST['dia']),
          'primers_err' => '',
          'segons_err' => ''
        ];

        // Validate data
        if(empty($data['primers'])){
          $data['primers_err'] = 'Introduïr primers';
        }
        if(empty($data['segons'])){
          $data['segons_err'] = 'Introduïr segons';
        }

        // Make sure no errors
        if(empty($data['primers_err']) && empty($data['segons_err'])){
          // Validated
          if($this->menuModel->addMenu($data)){
            flash('post_message', 'Menu creat');
            redirect('menus');
          } else {
            die('Error add');
          }
        } else {
          // Load view with errors
          $this->view('menus/add', $data);
        }

      } else {
        $data = [
          'primers' => '',
          'segons' => '',
          'postres' => '',
          'preu' => '',
          'dia' => ''
        ];
  
        $this->view('menus/add', $data);
      }
    }

    // Editar post
    public function edit($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'id_menu' => $id,
          'primers' => trim($_POST['primers']),
          'segons' => trim($_POST['segons']),
          'postres' => trim($_POST['postres']),
          'preu' => trim($_POST['preu']),
          'dia' => trim($_POST['dia']),
          'primers_err' => '',
          'segons_err' => ''
        ];

        // Validate data
        if(empty($data['primers'])){
          $data['primers_err'] = 'Introduïr primers';
        }
        if(empty($data['segons'])){
          $data['segons_err'] = 'Introduïr segons';
        }

        // Make sure no errors
        if(empty($data['primers_err']) && empty($data['segons_err'])){
          // Validated
          if($this->menuModel->updateMenu($data)){
            flash('post_message', 'Menú actualitzat correctament');
            redirect('menus');
          } else {
            die('Error update');
          }
        } else {
          // Load view with errors
          $this->view('menus/edit', $data);
        }

      } else {
        // Accedemos a la página editar para editar el producto pasado por parámetros
        // Get existing post from model
        $menu = $this->menuModel->getMenuById($id);

        $data = [
          'id_menu' => $id,
          'primers' => $menu->primers,
          'segons' => $menu->segons,
          'postres' => $menu->postres,
          'preu' => $menu->preu,
          'dia' => $menu->dia
        ];
  
        $this->view('menus/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing post from model
        $post = $this->menuModel->getMenuById($id);
        
        if($this->postModel->deletePost($id)){
          flash('post_message', 'Menu eliminat');
          redirect('menus');
        } else {
          die('Error delete');
        }
      } else {
        redirect('menus');
      }
    }
  }