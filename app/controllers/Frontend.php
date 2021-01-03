<?php
  class Frontend extends Controller {
    public function __construct(){

      $this->operacioModel = $this->model('Operacio');
      $this->categoriaModel = $this->model('Categoria');
      $this->provinciaModel = $this->model('Provincia');
      $this->poblacioModel = $this->model('Poblacio');
      $this->immobleModel = $this->model('Immoble');
      
    }
    
    public function index(){

      // If we select a new provincia then get only their poblacions
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Default 8 = Barcelona
        $idProvincia = empty(trim($_POST['id_provincia'])) ? 8 : trim($_POST['id_provincia']);

        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId($idProvincia);

        $data = [
          'poblacions' => $poblacions
        ];

        // Send by JSON
        echo json_encode($data);

      } else {
        $operacions = $this->operacioModel->getOperacions();
        $categories = $this->categoriaModel->getCategories();
        $provincies = $this->provinciaModel->getProvincies();
        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
        $immoblesPortada = $this->immobleModel->getInfoImmoblesPortada();

        $data = [
          'operacions' => $operacions,
          'categories' => $categories,
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'immoblesPortada' => $immoblesPortada
        ];
        
        $this->view('frontend/index', $data);
      }

    }
  }