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

      $this->categories = $this->categoriaModel->getCategories();

    }

    public function index(){
      $operacions = $this->operacioModel->getOperacions();
      $provincies = $this->provinciaModel->getProvincies();
      $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
      $immoblesPortada = $this->immobleModel->getInfoImmoblesPortada();

      $data = [
        'operacions' => $operacions,
        'categories' => $this->categories,
        'provincies' => $provincies,
        'poblacions' => $poblacions,
        'immoblesPortada' => $immoblesPortada
      ];
      
      $this->view('immobles/index', $data);
    }

    public function carregar_poblacions_frontend(){
      // If we select a new provincia then get only their poblacions
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Default 8 = Barcelona
        $idProvincia = empty(trim($_POST['id_provincia'])) ? 8 : trim(intval($_POST['id_provincia']));

        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(intval($idProvincia));

        if(!$poblacions) {
          redirect('immobles/index');
          return false;
        }

        $data = [
          'poblacions' => $poblacions
        ];

        // Send by JSON
        echo json_encode($data);
      }
    }

    public function cercar( $paginaParametre = '' ){

      // Problems about expired document
      header('Cache-Control: max-age=900');

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $dataPOST =[
          'operacio' => trim(intval($_POST['operacio'])),
          'categoria' => trim(intval($_POST['categoria'])),
          'poblacio' => trim(intval($_POST['poblacio']))
        ];

        if(empty($dataPOST['operacio'])){
          redirect('immobles/error');
          return false;
        } else {
          $_SESSION["operacio_cercar"] = $dataPOST['operacio'];
        }

        if(empty($dataPOST['categoria'])){
          redirect('immobles/error');
          return false;
        } else {
          $_SESSION["categoria_cercar"] = $dataPOST['categoria'];
        }

        if(empty($dataPOST['poblacio'])){
          redirect('poblacio/error');
          return false;
        } else {
          $_SESSION["poblacio_cercar"] = $dataPOST['poblacio'];
        }

      }

      if( !empty($_SESSION["operacio_cercar"]) && !empty($_SESSION["categoria_cercar"]) && !empty($_SESSION["poblacio_cercar"]) ) {
        $limitPage = 1;
        $page = ( isset($paginaParametre) && is_numeric($paginaParametre) ) ? intval($paginaParametre) : 1;
        $paginationStart = ($page - 1) * $limitPage;

        $immobles = $this->immobleModel->getImmoblesCercar($_SESSION["operacio_cercar"], $_SESSION["categoria_cercar"], $_SESSION["poblacio_cercar"], $paginationStart, $limitPage);
        $immoblesTotal = $this->immobleModel->getImmoblesTotalCercar($_SESSION["operacio_cercar"], $_SESSION["categoria_cercar"], $_SESSION["poblacio_cercar"]);

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
        $operacioCercada = $this->operacioModel->getOperacioById($_SESSION["operacio_cercar"]);
        $categoriaCercada = $this->categoriaModel->getCategoriaById($_SESSION["categoria_cercar"]);
        $poblacioCercada = $this->poblacioModel->getPoblacioById($_SESSION["poblacio_cercar"]);
        $provincies = $this->provinciaModel->getProvincies();
        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
        $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

        $data = [
          'immobles' => $immobles,
          'immoblesTotal' => $immoblesTotal->total,
          'operacions' => $operacions,
          'operacioCercada' => $operacioCercada->nom_cat,
          'categoriaCercada' => $categoriaCercada->nom_cat,
          'poblacioCercada' => $poblacioCercada->nom_cat,
          'categories' => $this->categories,
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'page' => $page,
          'totalPages' => $totalPages,
          'prev' => $prev,
          'next' => $next,
          'adjacents' => $adjacents,
          'totalPagesMinus1' => $totalPagesMinus1,
          'nomPagina' => 'cercar'
        ];

        $this->view('immobles/cercar', $data);

      } else {
        redirect('immobles/error');
      }

    }

    public function filtrar( $paginaParametre = '' ){
      // Problems about expired document
      header('Cache-Control: max-age=900');

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dataPOST = [
          'operacio' => !empty(trim($_POST['operacio'])) && is_numeric($_POST['operacio']) ? intval(trim($_POST['operacio'])) : 3, // Lloguer
          'categoria' => !empty(trim($_POST['categoria'])) && is_numeric($_POST['categoria']) ? intval(trim($_POST['categoria'])) : 1, // Pis
          'poblacio' => !empty(trim($_POST['poblacio'])) && is_numeric($_POST['poblacio']) ? intval(trim($_POST['poblacio'])) : 1158, // Població
          'preu_minim' => !empty(trim($_POST['preu_minim'])) && trim($_POST['preu_minim']) !== 'Indiferent' && is_numeric($_POST['preu_minim']) ? intval(trim($_POST['preu_minim'])) : 0,
          'preu_maxim' => !empty(trim($_POST['preu_maxim'])) && trim($_POST['preu_maxim']) !== 'Indiferent' && is_numeric($_POST['preu_maxim']) ? intval(trim($_POST['preu_maxim'])) : 4000000,
          'habitacions' => !empty(trim($_POST['habitacions'])) && trim($_POST['habitacions']) !== 'Indiferent' && is_numeric($_POST['habitacions']) ? intval(trim($_POST['habitacions'])) : 0,
          'banys' => !empty(trim($_POST['banys'])) && trim($_POST['banys']) !== 'Indiferent' && is_numeric($_POST['banys']) ? intval(trim($_POST['banys'])) : 0,
          'superficies_minim' => !empty(trim($_POST['superficies_minim'])) && trim($_POST['superficies_minim']) !== 'Indiferent' && is_numeric($_POST['superficies_minim']) ? intval(trim($_POST['superficies_minim'])) : 0,
          'superficies_maxim' => !empty(trim($_POST['superficies_maxim'])) && trim($_POST['superficies_maxim']) !== 'Indiferent' && is_numeric($_POST['superficies_maxim']) ? intval(trim($_POST['superficies_maxim'])) : 600,
          'caracteristica_id' => !isset($_POST['caracteristica_id']) ? '[""]' : json_encode($_POST['caracteristica_id']),
        ];

        $_SESSION["operacio_filtrar"] = $dataPOST['operacio'];
        $_SESSION["categoria_filtrar"] = $dataPOST['categoria'];
        $_SESSION["poblacio_filtrar"] = $dataPOST['poblacio'];
        $_SESSION["preu_minim_filtrar"] = $dataPOST['preu_minim'];
        $_SESSION["preu_maxim_filtrar"] = $dataPOST['preu_maxim'];
        $_SESSION["habitacions_filtrar"] = $dataPOST['habitacions'];
        $_SESSION["banys_filtrar"] = $dataPOST['banys'];
        $_SESSION["superficies_minim_filtrar"] = $dataPOST['superficies_minim'];
        $_SESSION["superficies_maxim_filtrar"] = $dataPOST['superficies_maxim'];
        $_SESSION["caracteristica_id_filtrar"] = $dataPOST['caracteristica_id'];

      }

      if( !empty($_SESSION["operacio_filtrar"]) && !empty($_SESSION["categoria_filtrar"]) && !empty($_SESSION["poblacio_filtrar"]) ) {

        $limitPage = 1;
        $page = ( isset($paginaParametre) && is_numeric($paginaParametre) ) ? intval($paginaParametre) : 1;
        $paginationStart = ($page - 1) * $limitPage;

        $immoblesFirst = $this->immobleModel->getImmoblesFiltrar($_SESSION["operacio_filtrar"], $_SESSION["categoria_filtrar"], $_SESSION["poblacio_filtrar"], $_SESSION["preu_minim_filtrar"], $_SESSION["preu_maxim_filtrar"], $_SESSION["habitacions_filtrar"], $_SESSION["banys_filtrar"], $_SESSION["superficies_minim_filtrar"], $_SESSION["superficies_maxim_filtrar"], $paginationStart, $limitPage);
        $immoblesFirstSensePaginacio = $this->immobleModel->getImmoblesFiltrarSensePaginacio($_SESSION["operacio_filtrar"], $_SESSION["categoria_filtrar"], $_SESSION["poblacio_filtrar"], $_SESSION["preu_minim_filtrar"], $_SESSION["preu_maxim_filtrar"], $_SESSION["habitacions_filtrar"], $_SESSION["banys_filtrar"], $_SESSION["superficies_minim_filtrar"], $_SESSION["superficies_maxim_filtrar"]);

        if ( $_SESSION["caracteristica_id_filtrar"] !== '[""]' ) {
          $caracteristiquesFiltrar = json_decode($_SESSION["caracteristica_id_filtrar"]);

          // Paginar immobles
          foreach ($immoblesFirst as $immoble) {
            // $containsSearch = count(array_intersect($caracteristiques, $var)) == count($caracteristiques);
            $caracteristiquesImmoble = json_decode($immoble->caracteristica_id);
            if(!array_diff($caracteristiquesFiltrar, $caracteristiquesImmoble)) {
              $immobles[] = $immoble;
            }
          }

          if(empty($immobles)){
            $immobles = array();
          }

          // Sense paginar immobles
          foreach ($immoblesFirstSensePaginacio as $immoble) {
            // $containsSearch = count(array_intersect($caracteristiques, $var)) == count($caracteristiques);
            $caracteristiquesImmoble = json_decode($immoble->caracteristica_id);
            if(!array_diff($caracteristiquesFiltrar, $caracteristiquesImmoble)) {
              $immoblesSensePaginar[] = $immoble;
            }
          }

          if(!empty($immoblesSensePaginar)) {
            $immoblesTotal = sizeof($immoblesSensePaginar);
          } else {
            $immoblesTotal = 0;
          }
          
        } else {
          $immobles = $immoblesFirst;
          $immoblesTotal = sizeof($immoblesFirstSensePaginacio);
        }

        // Calculate total pages
        // $immoblesTotal->total
        $totalPages = ceil($immoblesTotal / $limitPage);

        // Prev + Next
        $prev = $page - 1;
        $next = $page + 1;

        // How many adjacent pages should be shown on each side?
        $adjacents = 3;

        //last page minus 1
        $totalPagesMinus1 = $totalPages - 1; 

        $operacions = $this->operacioModel->getOperacions();
        $operacioCercada = $this->operacioModel->getOperacioById($_SESSION["operacio_filtrar"]);
        $categoriaCercada = $this->categoriaModel->getCategoriaById($_SESSION["categoria_filtrar"]);
        $poblacioCercada = $this->poblacioModel->getPoblacioById($_SESSION["poblacio_filtrar"]);
        $provincies = $this->provinciaModel->getProvincies();
        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
        $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

        $data = [
          'immobles' => $immobles,
          'immoblesTotal' => $immoblesTotal,
          'operacions' => $operacions,
          'operacioCercada' => $operacioCercada->nom_cat,
          'categoriaCercada' => $categoriaCercada->nom_cat,
          'poblacioCercada' => $poblacioCercada->nom_cat,
          'categories' => $this->categories,
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'page' => $page,
          'totalPages' => $totalPages,
          'prev' => $prev,
          'next' => $next,
          'adjacents' => $adjacents,
          'totalPagesMinus1' => $totalPagesMinus1,
          'nomPagina' => 'filtrar'
        ];

        $this->view('immobles/cercar', $data);

      } else {
        redirect('immobles/error');
      }
    }
    
    public function operacio($operacio = 3, $categoria = 1, $paginaParametre = '') {

      $limitPage = 1;
      $page = ( isset($paginaParametre) && is_numeric($paginaParametre) ) ? intval($paginaParametre) : 1;
      $paginationStart = ($page - 1) * $limitPage;

      switch (intval($operacio)) {
        // Comprar, lloguer, obra nova
        case 2:
        case 3:
        case 4:
          $immobles = $this->immobleModel->getImmoblesOperacioCategoria(intval($operacio), intval($categoria), $paginationStart, $limitPage);
          $immoblesTotal = $this->immobleModel->getImmoblesTotalOperacioCategoria(intval($operacio), intval($categoria));
          break;
        default:
          // Lloguer i pis
          $immobles = $this->immobleModel->getImmoblesOperacioCategoria(3, 1, $paginationStart, $limitPage);
          $immoblesTotal = $this->immobleModel->getImmoblesTotalOperacioCategoria(intval($operacio), intval($categoria));
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
      $operacioCercada = $this->operacioModel->getOperacioById(intval($operacio));
      $categoriaCercada = $this->categoriaModel->getCategoriaById(intval($categoria));
      $provincies = $this->provinciaModel->getProvincies();
      $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
      $caracteristiques = $this->caracteristicaModel->getCaracteristiques();

      $data = [
        'immobles' => $immobles,
        'immoblesTotal' => $immoblesTotal->total,
        'operacions' => $operacions,
        'operacioCercada' => $operacioCercada->nom_cat,
        'idOperacioCercada' => $operacioCercada->id,
        'categoriaCercada' => $categoriaCercada->nom_cat,
        'idCategoriaCercada' => $categoriaCercada->id,
        'categories' => $this->categories,
        'provincies' => $provincies,
        'poblacions' => $poblacions,
        'caracteristiques' => $caracteristiques,
        'page' => $page,
        'totalPages' => $totalPages,
        'prev' => $prev,
        'next' => $next,
        'adjacents' => $adjacents,
        'totalPagesMinus1' => $totalPagesMinus1,
        'nomPagina' => 'operacio'
      ];
      $this->view('immobles/operacions', $data);
    }

    public function detall($id){

      $operacions = $this->operacioModel->getOperacions();
      $caracteristiques = $this->caracteristicaModel->getCaracteristiques();
      $immobles = $this->immobleModel->getImmobleDetallById(intval($id));

      if( !$immobles ) {
        redirect('immobles/index');
        return false;
      }

      $recomendeds = $this->immobleModel->getRecomendedImmobles($immobles->id_immoble, $immobles->operacio_id, $immobles->categoria_id, $immobles->poblacio_id);

      $data = [
        'operacions' => $operacions,
        'categories' => $this->categories,
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

    public function nosaltres() {
      $data = [
        'categories' => $this->categories
      ];
      $this->view('immobles/nosaltres', $data);
    }

    public function unirme() {
      $data = [
        'categories' => $this->categories
      ];
      $this->view('immobles/unirme', $data);
    }

    public function correu($tipusCorreu) {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          switch (htmlspecialchars($tipusCorreu)) {
            // Informació
            case "informacio":
              $AdminMessage = "Formulari de contacte - IMMOBILIARIES EN XARXA\n\n";

              $AdminMessage .= "Nom i cognoms: ".utf8_decode($_POST['nom'])."\n";
              $AdminMessage .= "Correu: ".utf8_decode($_POST['email'])."\n";
              $AdminMessage .= "Ref. immoble: ".utf8_decode($_POST['referencia'])."\n";
              $AdminMessage .= "Tlf: ".utf8_decode($_POST['telefon'])."\n";
              $AdminMessage .= "Comentaris: ".utf8_decode($_POST['missatge'])."\n";

              mail(utf8_decode($_POST['email_venedor']), "Formulari de contacte - IMMOBILIARIES EN XARXA", $AdminMessage, "From: ".$_POST['email']);
              redirect('immobles/gracies');
              break;
            // Uneix-te
            case "unirme":
              $AdminMessage = "Formulari de contacte - UNEIX-TE - IMMOBILIARIES EN XARXA\n\n";

              $AdminMessage .= "Nom i cognoms: ".utf8_decode($_POST['nom'])."\n";
              $AdminMessage .= "Correu: ".utf8_decode($_POST['email'])."\n";
              $AdminMessage .= "Empresa: ".utf8_decode($_POST['empresa'])."\n";
              $AdminMessage .= "Tlf: ".utf8_decode($_POST['telefon'])."\n";
              $AdminMessage .= "Comentaris: ".utf8_decode($_POST['missatge'])."\n";

              mail("info@immobiliariesenxarxa.net", "Formulari de contacte - UNEIX-TE - IMMOBILIARIES EN XARXA", $AdminMessage, "From: ".$_POST['email']);
              redirect('immobles/gracies');
              break;
            default:
              redirect('immobles/error');
          }
      } else {
        redirect('immobles/error');
      }
    }

    // Gràcies
    public function gracies() {
      $data = [
        'categories' => $this->categories
      ];
      $this->view('immobles/gracies', $data);
    }

    // Error 404
    public function error() {
      $data = [
        'categories' => $this->categories
      ];
      $this->view('immobles/error', $data);
    }

  }