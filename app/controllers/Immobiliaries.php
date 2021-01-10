<?php
    class Immobiliaries extends Controller {
        public function __construct(){
            $this->usuariModel = $this->model('Usuari');
            $this->operacioModel = $this->model('Operacio');
            $this->categoriaModel = $this->model('Categoria');
            $this->caracteristicaModel = $this->model('Caracteristica');
            $this->provinciaModel = $this->model('Provincia');
            $this->poblacioModel = $this->model('Poblacio');
            $this->immobleModel = $this->model('Habitatge');

            $this->categories = $this->categoriaModel->getCategories();
        }

        public function llista(){

            $usuaris = $this->usuariModel->getUsuaris();

            $data=[
                'operacions' => $operacions,
                'usuaris' => $usuaris
            ];

            $this->view('immobiliaries/llista',$data);

        }

        public function immobles($id){

            $immobles = $this->usuariModel->getUsuaris();

            // Pasar el nom de l'empresa
            $empresa = $this->usuariModel->getUsuariById($id);

            $data=[
                'categories' => $this->categories,
                'provincies' => $provincies,
                'poblacions' => $poblacions,
                'caracteristiques' => $caracteristiques,
                'empresa' => $empresa,
                'immobles' => $immobles
            ];

            $this->view('immobiliaries/cercar',$data);

        }
}