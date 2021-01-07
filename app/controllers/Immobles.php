<?php
  class Immobles extends Controller {
    public function __construct(){
      $this->operacioModel = $this->model('Operacio');
      $this->categoriaModel = $this->model('Categoria');
      $this->caracteristicaModel = $this->model('Caracteristica');
      $this->provinciaModel = $this->model('Provincia');
      $this->poblacioModel = $this->model('Poblacio');
      $this->certificatModel = $this->model('Certificat');
      $this->immobleModel = $this->model('Habitatge');
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
        
        $this->view('immobles/index', $data);
      }

    }

    public function cercar(){
      // Problems about expired document
      header('Cache-Control: max-age=900');
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'operacio' => trim(($_POST['operacio'])),
          'categoria' => trim($_POST['categoria']),
          'poblacio' => trim($_POST['poblacio'])
        ];

        if(empty($data['operacio'])){
          redirect('immobles/index');
        }

        if(empty($data['categoria'])){
          redirect('immobles/index');
        }

        if(empty($data['poblacio'])){
          redirect('poblacio/index');
        }

        $immobles = $this->immobleModel->getImmoblesCercar($data['operacio'], $data['categoria'], $data['poblacio']);

        $operacions = $this->operacioModel->getOperacions();
        $categories = $this->categoriaModel->getCategories();
        $provincies = $this->provinciaModel->getProvincies();
        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
        $certificats = $this->certificatModel->getCertificats();
        $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

        $data = [
          'immobles' => $immobles,
          'operacions' => $operacions,
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'certificats' => $certificats,
          'caracteristiques' => $caracteristiques
        ];

        $this->view('immobles/cercar', $data);

      } else {
        $this->view('immobles/error');
      }
    }
    
    public function detall($id){

      $operacions = $this->operacioModel->getOperacions();
      $categories = $this->categoriaModel->getCategories();
      $caracteristiques = $this->caracteristicaModel->getCaracteristiques();
      $immobles = $this->immobleModel->getImmobleDetallById($id);

      $recomendeds = $this->immobleModel->getRecomendedImmobles($immobles->id_immoble, $immobles->operacio_id, $immobles->categoria_id, $immobles->poblacio_id,);

      $data = [
        'operacions' => $operacions,
        'categories' => $categories,
        'recomendeds' => $recomendeds,
        'titol_cat' => $immobles->titol_cat,
        'titol_esp' => $immobles->titol_esp,
        'titol_eng' => $immobles->titol_eng,
        'referencia' => $immobles->referencia,
        'descripcio_cat' => $immobles->descripcio_cat,
        'descripcio_esp' => $immobles->descripcio_esp,
        'descripcio_eng' => $immobles->descripcio_eng,
        'imatge_1' => $immobles->imatge_1,
        'imatge_2' => $immobles->imatge_2,
        'imatge_3' => $immobles->imatge_3,
        'imatge_4' => $immobles->imatge_4,
        'imatge_5' => $immobles->imatge_5,
        'imatge_6' => $immobles->imatge_6,
        'imatge_7' => $immobles->imatge_7,
        'imatge_8' => $immobles->imatge_8,
        'imatge_9' => $immobles->imatge_9,
        'imatge_10' => $immobles->imatge_10,
        'preu' => $immobles->preu,
        'habitacio' => $immobles->habitacio,
        'banys' => $immobles->banys,
        'tamany' => $immobles->tamany,
        'activat' => $immobles->activat,
        'caracteristica_id' => $immobles->caracteristica_id,
        'caracteristiques' => $caracteristiques,
        'operacio_cat' => $immobles->operacio_cat,
        'operacio_esp' => $immobles->operacio_esp,
        'operacio_eng' => $immobles->operacio_eng,
        'categoria_cat' => $immobles->categoria_cat,
        'categoria_esp' => $immobles->categoria_esp,
        'categoria_eng' => $immobles->categoria_eng,
        'poblacio' => $immobles->poblacio,
        'provincia' => $immobles->provincia,
        'email' => $immobles->email,
        'nom_cognoms' => $immobles->nom_cognoms,
        'empresa' => $immobles->empresa,
        'direccio' => $immobles->direccio,
        'poblacio_usuari' => $immobles->poblacio_usuari,
        'codi_postal' => $immobles->codi_postal,
        'telefon' => $immobles->telefon,
        'web' => $immobles->web,
        'logo' => $immobles->logo,
        'certificat' => $immobles->certificat,
      ];
      
      $this->view('immobles/detall', $data);

    }

    public function error() {
      $this->view('immobles/error');
    }

  }