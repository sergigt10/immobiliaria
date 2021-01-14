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

            $usuaris = $this->usuariModel->getUsuarisActivats();

            $data=[
                'categories' => $this->categories,
                'usuaris' => $usuaris
            ];

            $this->view('immobiliaries/llista',$data);

        }

        public function immobles($id){

            $immobles = $this->immobleModel->getImmoblesActivatByUsuari(intval($id));

            // Pasar el nom de l'empresa
            $empresaCercada = $this->usuariModel->getIsActivateByIdFrontend(intval($id));

            if( !$empresaCercada ) {
                redirect('immobiliaries/llista');
                return false;
            }

            $operacions = $this->operacioModel->getOperacions();
            $provincies = $this->provinciaModel->getProvincies();
            $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
            $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

            $data=[
                'operacions' => $operacions,
                'categories' => $this->categories,
                'provincies' => $provincies,
                'poblacions' => $poblacions,
                'caracteristiques' => $caracteristiques,
                'empresaCercada' => $empresaCercada->empresa,
                'descripcioEmpresa' => $empresaCercada->descripcio_cat,
                'telefonEmpresa' => $empresaCercada->telefon,
                'emailEmpresa' => $empresaCercada->email,
                'immobles' => $immobles
            ];

            $this->view('immobles/cercar',$data);

        }
}