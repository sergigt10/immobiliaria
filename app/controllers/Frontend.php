<?php
  class Frontend extends Controller {
    public function __construct(){

      $this->operacioModel = $this->model('Operacio');
      $this->categoriaModel = $this->model('Categoria');
      $this->provinciaModel = $this->model('Provincia');
      $this->poblacioModel = $this->model('Poblacio');
      
    }
    
    public function index(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId($_POST['id_provincia']);

        $data = [
          'poblacions' => $poblacions
        ];

        echo json_encode($data);

      } else {
        $operacions = $this->operacioModel->getOperacions();
        $categories = $this->categoriaModel->getCategories();
        $provincies = $this->provinciaModel->getProvincies();
        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);

        $data = [
          'operacions' => $operacions,
          'categories' => $categories,
          'provincies' => $provincies,
          'poblacions' => $poblacions
        ];
        
        $this->view('frontend/index', $data);
      }
      
      

      

      
    }
  }