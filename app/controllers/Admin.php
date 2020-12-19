<?php
  class Admin extends Controller {
    public function __construct(){
      
    }
    public function index(){
      if(!isLoggedIn()){
        redirect('usuaris/login');
      }

      $this->usuariModel = $this->model('Usuari');

      // If not activated
      if(!$this->usuariModel->getIsActivateById($_SESSION['usuari_id'])) {
        redirect('usuaris/logout');
      }
           
      $this->view('admin/index');
    }
  }