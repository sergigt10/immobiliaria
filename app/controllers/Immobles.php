<?php
  class Immobles extends Controller {
    public function __construct(){

        $this->operacioModel = $this->model('Operacio');
        $this->categoriaModel = $this->model('Categoria');
        $this->caracteristicaModel = $this->model('Caracteristica');
        $this->provinciaModel = $this->model('Provincia');
        $this->poblacioModel = $this->model('Poblacio');
        $this->immobleModel = $this->model('Habitatge');
      
    }
    
    public function detall($id){

        $operacions = $this->operacioModel->getOperacions();
        $categories = $this->categoriaModel->getCategories();
        $caracteristiques = $this->caracteristicaModel->getCaracteristiques();
        $immobles = $this->immobleModel->getImmobleDetallById($id);

        $data = [
          'operacions' => $operacions,
          'categories' => $categories,
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
  }