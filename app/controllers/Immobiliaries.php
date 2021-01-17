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

        public function llista( $paginaParametre = '' ){

            $limitPage = 1;
            $page = ( isset($paginaParametre) && is_numeric($paginaParametre) ) ? intval($paginaParametre) : 1;
            $paginationStart = ($page - 1) * $limitPage;

            $usuaris = $this->usuariModel->getUsuarisActivats($paginationStart, $limitPage);
            $usuarisTotal = $this->usuariModel->getTotalUsuarisActivats();

            // Calculate total pages
            // $immoblesTotal->total
            $totalPages = ceil($usuarisTotal->total / $limitPage);

            // Prev + Next
            $prev = $page - 1;
            $next = $page + 1;

            // How many adjacent pages should be shown on each side?
            $adjacents = 3;

            //last page minus 1
            $totalPagesMinus1 = $totalPages - 1; 

            $data=[
                'categories' => $this->categories,
                'usuaris' => $usuaris,
                'usuarisTotal' => $usuarisTotal->total,
                'page' => $page,
                'totalPages' => $totalPages,
                'prev' => $prev,
                'next' => $next,
                'adjacents' => $adjacents,
                'totalPagesMinus1' => $totalPagesMinus1,
                'nomPagina' => 'llista'
            ];

            $this->view('immobiliaries/llista',$data);

        }

        public function immobles($id, $paginaParametre = ''){

            $limitPage = 5;
            $page = ( isset($paginaParametre) && is_numeric($paginaParametre) ) ? intval($paginaParametre) : 1;
            $paginationStart = ($page - 1) * $limitPage;

            $immobles = $this->immobleModel->getImmoblesActivatsByUsuariPaginacio(intval($id), $paginationStart, $limitPage);
            $immoblesTotal = $this->immobleModel->getTotalImmoblesActivatsByUsuari(intval($id));

            // Pasar el nom de l'empresa
            $empresaCercada = $this->usuariModel->getIsActivateByIdFrontend(intval($id));

            if( !$empresaCercada ) {
                redirect('immobiliaries/llista');
                return false;
            }

            // Calculate total pages
            // $immoblesTotal->total
            $totalPages = ceil($immoblesTotal->total / $limitPage);

            // Prev + Next
            $prev = $page - 1;
            $next = $page + 1;

            // How many adjacent pages should be shown on each side?
            $adjacents = 3;

            //last page minus 1
            $totalPagesMinus1 = $totalPages - 1; 

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
                'idEmpresaCercada' => $empresaCercada->id,
                'descripcioEmpresa' => $empresaCercada->descripcio_cat,
                'telefonEmpresa' => $empresaCercada->telefon,
                'emailEmpresa' => $empresaCercada->email,
                'immobles' => $immobles,
                'immoblesTotal' => $immoblesTotal->total,
                'page' => $page,
                'totalPages' => $totalPages,
                'prev' => $prev,
                'next' => $next,
                'adjacents' => $adjacents,
                'totalPagesMinus1' => $totalPagesMinus1,
                'nomPagina' => 'immobles'
            ];

            $this->view('immobiliaries/immobles',$data);

        }
}