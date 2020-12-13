<?php
  class Pages extends Controller {
    public function __construct(){
      
    }
    public function index(){
      if(!isLoggedIn()){
        redirect('usuaris/login');
      }
           
      $this->view('pages/index');
    }
  }