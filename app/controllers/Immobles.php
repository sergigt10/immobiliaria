<?php
  class Immobles extends Controller {
    public function __construct(){

        $this->operacioModel = $this->model('Operacio');
        $this->categoriaModel = $this->model('Categoria');
        $this->provinciaModel = $this->model('Provincia');
        $this->poblacioModel = $this->model('Poblacio');
        $this->immobleModel = $this->model('Habitatge');
      
    }
    
    public function detall($id){

        $operacions = $this->operacioModel->getOperacions();
        $categories = $this->categoriaModel->getCategories();
        $immobles = $this->immobleModel->getImmobleById($id);

        $data = [
          'operacions' => $operacions,
          'categories' => $categories,
          'titol_cat' => $immobles->titol_cat
        ];
        
        $this->view('immobles/detall', $data);

    }
  }