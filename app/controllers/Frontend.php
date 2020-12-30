<?php
  class Frontend extends Controller {
    public function __construct(){
      
    }
    public function index(){   
        $this->view('frontend/index');
    }
  }