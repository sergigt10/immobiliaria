<?php
  class Habitatges extends Controller {

    public function __construct(){
      // If not registered
      if(!isLoggedIn()){
        redirect('usuaris/login');
        return false;
      }
      // Import models
      $this->immobleModel = $this->model('Habitatge');
      $this->provinciaModel = $this->model('Provincia');
      $this->poblacioModel = $this->model('Poblacio');
      $this->caracteristicaModel = $this->model('Caracteristica');
      $this->categoriaModel = $this->model('Categoria');
      $this->certificatModel = $this->model('Certificat');
      $this->operacioModel = $this->model('Operacio');
      $this->usuariModel = $this->model('Usuari');
      // If not activated
      if(!$this->usuariModel->getIsActivateById($_SESSION['usuari_id'])) {
        redirect('usuaris/logout');
        return false;
      }
    }

    // Get immobles
    public function index(){
      // Get all immobles or only immobles by usuari
      if(!isLoggedInAndAdmin()){
        $immobles = $this->immobleModel->getImmoblesByUsuari($_SESSION['usuari_id']);
      } else {
        $immobles = $this->immobleModel->getImmobles();
      }

      $data = [
        'immobles' => $immobles
      ];

      $this->view('habitatges/index', $data);
    }

    // Add immobles
    public function add(){
      
      // Check if we overcome the max immobles by usuari
      $totalImmoblesByUser = $this->immobleModel->getTotalImmoblesByUsuari($_SESSION['usuari_id']);
      $MaxImmobleByUser = $this->usuariModel->getMaxImmobleByUser($_SESSION['usuari_id']);

      if( $totalImmoblesByUser->total_immobles >= $MaxImmobleByUser->total_max_immobles ){
        flash('immoble_message', 'Has superat el límit d\'immobles permesos. Contacte amb l\'administrador.', 'alert alert-danger');
        redirect('habitatges/index');
        return false;
      }

      $provincies = $this->provinciaModel->getProvincies();
      $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(8);
      $caracteristiques = $this->caracteristicaModel->getCaracteristiquesActivades() ;
      $categories = $this->categoriaModel->getCategoriesActivades();
      $certificats = $this->certificatModel->getCertificatsActivats();
      $operacions = $this->operacioModel->getOperacionsActives();
      $totalPortada = $this->immobleModel->getTotalImmoblesPortada();

      // Si viene de un POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'titol_cat' => trim($_POST['titol_cat']),
          'titol_esp' => trim($_POST['titol_esp']),
          'titol_eng' => trim($_POST['titol_eng']),
          'slug_cat' => '',
          'slug_esp' => '',
          'slug_eng' => '',
          'referencia' => trim($_POST['referencia']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'imatge1' => trim($_POST['imatge1']),
          'imatge2' => trim($_POST['imatge2']),
          'imatge3' => trim($_POST['imatge3']),
          'imatge4' => trim($_POST['imatge4']),
          'imatge5' => trim($_POST['imatge5']),
          'imatge6' => trim($_POST['imatge6']),
          'imatge7' => trim($_POST['imatge7']),
          'imatge8' => trim($_POST['imatge8']),
          'imatge9' => trim($_POST['imatge9']),
          'imatge10' => trim($_POST['imatge10']),
          'portada' => (!isLoggedInAndAdmin()) ? '0' : trim($_POST['portada']),
          'preu' => trim($_POST['preu']),
          'habitacio' => trim($_POST['habitacio']),
          'banys' => trim($_POST['banys']),
          'tamany' => trim($_POST['tamany']),
          'activat' => trim($_POST['activat']),
          'operacio_id' => trim($_POST['operacio_id']),
          'poblacio_id' => trim($_POST['poblacio_id']),
          'categoria_id' => trim($_POST['categoria_id']),
          'caracteristica_id' => !isset($_POST['caracteristica_id']) ? '[""]' : json_encode($_POST['caracteristica_id']),
          'certificat_id' => trim($_POST['certificat_id']),
          'usuari_id' => $_SESSION['usuari_id'],
          'titol_esp_err' => '',
          'referencia_err' => '',
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'categories' => $categories,
          'certificats' => $certificats,
          'operacions' => $operacions,
          'totalPortada' => $totalPortada->total_portada
        ];

        // Validate data
        if(empty($data['titol_cat'])){
          $data['titol_cat_err'] = 'Introduïr títol en català';
        } else {
          $data['slug_cat'] = urls_amigables($data['titol_cat']);
        }

        // Validate data
        if(empty($data['titol_esp'])){
          $data['titol_esp_err'] = 'Introduïr títol en castellà';
        } else {
          $data['slug_esp'] = urls_amigables($data['titol_esp']);
        }

        // Validate data
        if(empty($data['titol_eng'])){
          $data['titol_eng_err'] = 'Introduïr títol en anglès';
        } else {
          $data['slug_eng'] = urls_amigables($data['titol_eng']);
        }

        if(empty($data['referencia'])){
          $data['referencia_err'] = 'Introduïr referencia de l\'immoble';
        }

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['titol_esp_err']) && empty($data['titol_eng_err']) && empty($data['referencia_err'])){
          // Validated

          // Pujada d'imatges
          if (!empty($data['imatge1'])) {
            $nombre_archivo = $_FILES['foto1file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto1file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto1file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto1file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "1-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge2'])) {
            $nombre_archivo = $_FILES['foto2file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto2file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto2file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto2file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "2-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge3'])) {
            $nombre_archivo = $_FILES['foto3file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto3file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto3file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto3file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "3-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge4'])) {
            $nombre_archivo = $_FILES['foto4file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto4file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto4file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto4file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "4-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge5'])) {
            $nombre_archivo = $_FILES['foto5file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto5file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto5file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto5file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "5-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge6'])) {
            $nombre_archivo = $_FILES['foto6file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto6file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto6file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto6file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "6-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }else if($_FILES['foto6file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }else if($_FILES['foto6file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge7'])) {
            $nombre_archivo = $_FILES['foto7file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto7file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto7file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto7file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "7-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }else if($_FILES['foto7file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }else if($_FILES['foto7file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge8'])) {
            $nombre_archivo = $_FILES['foto8file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto8file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto8file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto8file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "8-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }else if($_FILES['foto8file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }else if($_FILES['foto8file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge9'])) {
            $nombre_archivo = $_FILES['foto9file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto9file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto9file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto9file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "9-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }else if($_FILES['foto9file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }else if($_FILES['foto9file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge10'])) {
            $nombre_archivo = $_FILES['foto10file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto10file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto10file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto10file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "10-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }else if($_FILES['foto10file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }else if($_FILES['foto10file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if($this->immobleModel->add($data)){
            flash('immoble_message', 'Immoble creat correctament');
            redirect('habitatges/index');
            return false;
          } else {
            die('Error add');
          }
        } else {
          // Load view with errors
          $this->view('habitatges/add', $data);
        }

      } else {
        $data = [
          'titol_cat' => '',
          'titol_esp' => '',
          'titol_eng' => '',
          'referencia' => '',
          'descripcio_cat' => '',
          'descripcio_esp' => '',
          'descripcio_eng' => '',
          'imatge1' => '',
          'imatge2' => '',
          'imatge3' => '',
          'imatge4' => '',
          'imatge5' => '',
          'imatge6' => '',
          'imatge7' => '',
          'imatge8' => '',
          'imatge9' => '',
          'imatge10' => '',
          'portada' => '',
          'preu' => '',
          'habitacio' => '',
          'banys' => '',
          'tamany' => '',
          'activat' => '',
          'operacio_id' => '',
          'poblacio_id' => '',
          'categoria_id' => '',
          'caracteristica_id' => '',
          'certificat_id' => '',
          'provincies' => $provincies,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'categories' => $categories,
          'certificats' => $certificats,
          'operacions' => $operacions,
          'totalPortada' => $totalPortada->total_portada
        ];

        $this->view('habitatges/add', $data);
      }
    }

    // Edit immoble
    public function edit($id){

      // Get existing immoble from model
      $immoble = $this->immobleModel->getImmobleById(intval($id));

      // Control of parameter
      if( !$immoble ) {
        flash('immoble_message', 'Aquest immoble no existeix', 'alert alert-danger');
        redirect('habitatges/index');
        return false;
      }

      $provincies = $this->provinciaModel->getProvincies();
      $idProvinciaByPoblacio = $this->poblacioModel->getPoblacioById($immoble->poblacio_id);
      $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId($idProvinciaByPoblacio->provincia_id);
      
      $caracteristiques = $this->caracteristicaModel->getCaracteristiquesActivades() ;
      $categories = $this->categoriaModel->getCategoriesActivades();
      $certificats = $this->certificatModel->getCertificatsActivats();
      $operacions = $this->operacioModel->getOperacionsActives();
      $totalPortada = $this->immobleModel->getTotalImmoblesPortada();
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'titol_cat' => trim($_POST['titol_cat']),
          'titol_esp' => trim($_POST['titol_esp']),
          'titol_eng' => trim($_POST['titol_eng']),
          'slug_cat' => '',
          'slug_esp' => '',
          'slug_eng' => '',
          'referencia' => trim($_POST['referencia']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'imatge1' => trim($_POST['imatge1']),
          'imatge2' => trim($_POST['imatge2']),
          'imatge3' => trim($_POST['imatge3']),
          'imatge4' => trim($_POST['imatge4']),
          'imatge5' => trim($_POST['imatge5']),
          'imatge6' => trim($_POST['imatge6']),
          'imatge7' => trim($_POST['imatge7']),
          'imatge8' => trim($_POST['imatge8']),
          'imatge9' => trim($_POST['imatge9']),
          'imatge10' => trim($_POST['imatge10']),
          'portada' => (!isLoggedInAndAdmin()) ? '0' : trim($_POST['portada']),
          'preu' => trim($_POST['preu']),
          'habitacio' => trim($_POST['habitacio']),
          'banys' => trim($_POST['banys']),
          'tamany' => trim($_POST['tamany']),
          'activat' => trim($_POST['activat']),
          'operacio_id' => trim($_POST['operacio_id']),
          'poblacio_id' => trim($_POST['poblacio_id']),
          'categoria_id' => trim($_POST['categoria_id']),
          'caracteristica_id' => !isset($_POST['caracteristica_id']) ? '[""]' : json_encode($_POST['caracteristica_id']),
          'certificat_id' => trim($_POST['certificat_id']),
          'usuari_id' => $_SESSION['usuari_id'],
          'titol_cat_err' => '',
          'titol_esp_err' => '',
          'titol_eng_err' => '',
          'provincies' => $provincies,
          'idProvinciaByPoblacio' => $idProvinciaByPoblacio->provincia_id,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'categories' => $categories,
          'certificats' => $certificats,
          'operacions' => $operacions,
          'totalPortada' => $totalPortada->total_portada
        ];

        $del_img1 = (!empty($_POST["del_img1"])) ? '1' : '0';
        $del_img2 = (!empty($_POST["del_img2"])) ? '1' : '0';
        $del_img3 = (!empty($_POST["del_img3"])) ? '1' : '0';
        $del_img4 = (!empty($_POST["del_img4"])) ? '1' : '0';
        $del_img5 = (!empty($_POST["del_img5"])) ? '1' : '0';
        $del_img6 = (!empty($_POST["del_img6"])) ? '1' : '0';
        $del_img7 = (!empty($_POST["del_img7"])) ? '1' : '0';
        $del_img8 = (!empty($_POST["del_img8"])) ? '1' : '0';
        $del_img9 = (!empty($_POST["del_img9"])) ? '1' : '0';
        $del_img10 = (!empty($_POST["del_img10"])) ? '1' : '0';

        // Validate data
        if(empty($data['titol_cat'])){
          $data['titol_cat_err'] = 'Introduïr títol en català';
        } else {
          $data['slug_cat'] = urls_amigables($data['titol_cat']);
        }

        // Validate data
        if(empty($data['titol_esp'])){
          $data['titol_esp_err'] = 'Introduïr títol en castellà';
        } else {
          $data['slug_esp'] = urls_amigables($data['titol_esp']);
        }

        // Validate data
        if(empty($data['titol_eng'])){
          $data['titol_eng_err'] = 'Introduïr títol en anglès';
        } else {
          $data['slug_eng'] = urls_amigables($data['titol_eng']);
        }

        if(empty($data['referencia'])){
          $data['referencia_err'] = 'Introduïr referencia de l\'immoble';
        }

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['titol_esp_err']) && empty($data['titol_eng_err']) && empty($data['referencia_err'])){
          
          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge1']);
            $data['imatge1'] = "";
          }

          if($del_img2 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge2']);
            $data['imatge2'] = "";
          }

          if($del_img3 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge3']);
            $data['imatge3'] = "";
          }

          if($del_img4 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge4']);
            $data['imatge4'] = "";
          }

          if($del_img5 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge5']);
            $data['imatge5'] = "";
          }

          if($del_img6 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge6']);
            $data['imatge6'] = "";
          }

          if($del_img7 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge7']);
            $data['imatge7'] = "";
          }

          if($del_img8 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge8']);
            $data['imatge8'] = "";
          }

          if($del_img9 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge9']);
            $data['imatge9'] = "";
          }

          if($del_img10 == "1"){
            unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge10']);
            $data['imatge10'] = "";
          }

          $getimmobleImg = $this->immobleModel->getImmobleById($id);

          $dataImg = [
            'imatge1' => $getimmobleImg->imatge_1,
            'imatge2' => $getimmobleImg->imatge_2,
            'imatge3' => $getimmobleImg->imatge_3,
            'imatge4' => $getimmobleImg->imatge_4,
            'imatge5' => $getimmobleImg->imatge_5,
            'imatge6' => $getimmobleImg->imatge_6,
            'imatge7' => $getimmobleImg->imatge_7,
            'imatge8' => $getimmobleImg->imatge_8,
            'imatge9' => $getimmobleImg->imatge_9,
            'imatge10' => $getimmobleImg->imatge_10
          ];

          // Pujada d'imatges. Es mira si ens passen un arxiu i si aquest es nou.
          if (!empty($data['imatge1']) && $del_img1 != "1" && $dataImg['imatge1']!=$data['imatge1']) {
            $nombre_archivo = $_FILES['foto1file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto1file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto1file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto1file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "1-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge1'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge1']);
              }
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge1'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge1']);
              }
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge1'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge1']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge2']) && $del_img2 != "1" && $dataImg['imatge2']!=$data['imatge2']) {
            $nombre_archivo = $_FILES['foto2file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto2file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto2file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto2file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "2-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge2'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge2']);
              }
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge2'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge2']);
              }
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge2'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge2']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge3']) && $del_img3 != "1" && $dataImg['imatge3']!=$data['imatge3']) {
            $nombre_archivo = $_FILES['foto3file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto3file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto3file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto3file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "3-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge3'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge3']);
              }
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge3'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge3']);
              }
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge3'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge3']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge4']) && $del_img4 != "1" && $dataImg['imatge4']!=$data['imatge4']) {
            $nombre_archivo = $_FILES['foto4file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto4file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto4file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto4file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "4-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge4'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge4']);
              }
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge4'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge4']);
              }
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge4'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge4']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge5']) && $del_img5 != "1" && $dataImg['imatge5']!=$data['imatge5']) {
            $nombre_archivo = $_FILES['foto5file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto5file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto5file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto5file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "5-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge5'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge5']);
              }
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge5'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge5']);
              }
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge5'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge5']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge6']) && $del_img6 != "1" && $dataImg['imatge6']!=$data['imatge6']) {
            $nombre_archivo = $_FILES['foto6file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto6file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto6file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto6file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "6-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge6'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge6']);
              }
            }else if($_FILES['foto6file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge6'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge6']);
              }
            }else if($_FILES['foto6file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge6'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge6']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge7']) && $del_img7 != "1" && $dataImg['imatge7']!=$data['imatge7']) {
            $nombre_archivo = $_FILES['foto7file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto7file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto7file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto7file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "7-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge7'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge7']);
              }
            }else if($_FILES['foto7file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge7'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge7']);
              }
            }else if($_FILES['foto7file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge7'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge7']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge8']) && $del_img8 != "1" && $dataImg['imatge8']!=$data['imatge8']) {
            $nombre_archivo = $_FILES['foto8file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto8file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto8file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto8file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "8-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge8'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge8']);
              }
            }else if($_FILES['foto8file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge8'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge8']);
              }
            }else if($_FILES['foto8file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge8'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge8']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge9']) && $del_img9 != "1" && $dataImg['imatge9']!=$data['imatge9']) {
            $nombre_archivo = $_FILES['foto9file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto9file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto9file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto9file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "9-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge9'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge9']);
              }
            }else if($_FILES['foto9file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge9'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge9']);
              }
            }else if($_FILES['foto9file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge9'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge9']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge10']) && $del_img10 != "1" && $dataImg['imatge10']!=$data['imatge10']) {
            $nombre_archivo = $_FILES['foto10file']['name'];
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            // ********* Inici REDUIR IMATGE *********
            //Imatge reduida 360 x 230
            //Imagen original
            $rtOriginal=$_FILES['foto10file']['tmp_name'];
            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear variable
              $original = imagecreatefromjpeg($rtOriginal);
            }else if($_FILES['foto10file']['type']=='image/png'){
              $original = imagecreatefrompng($rtOriginal);
            }
            else if($_FILES['foto10file']['type']=='image/gif'){
              $original = imagecreatefromgif($rtOriginal);
            }  
            //Ancho y alto máximo
            $max_ancho = 1200; $max_alto = 752;
            //Medir la imagen
            list($ancho,$alto)=getimagesize($rtOriginal);
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            //Proporciones
            if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            else if(($x_ratio * $alto) < $max_alto){
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            //Crear un lienzo
            $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
            //Copiar original en lienzo
            imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
            $id_thumb=rand(1, 50);
            $new_nombre_thumb = "10-".$data['slug_esp']."-".$id_thumb."-".$data['usuari_id']."-".uniqid().".".$ext;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge10'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge10']);
              }
            }else if($_FILES['foto10file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge10'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge10']);
              }
            }else if($_FILES['foto10file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img-xarxa/immoble/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              if(!empty($dataImg['imatge10'])) {
                unlink("../../admin-web/public/images/img-xarxa/immoble/".$dataImg['imatge10']);
              }
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if($this->immobleModel->update($data)){
            flash('immoble_message', 'Immoble actualitzat correctament');
            redirect('habitatges/index');
            return false;
          } else {
            die('Error update');
          }
        } else {
          $getimmobleImg = $this->immobleModel->getImmobleById($id);
          // Load view with errors
          $data['imatge1'] = $getimmobleImg->imatge_1;
          $data['imatge2'] = $getimmobleImg->imatge_2;
          $data['imatge3'] = $getimmobleImg->imatge_3;
          $data['imatge4'] = $getimmobleImg->imatge_4;
          $data['imatge5'] = $getimmobleImg->imatge_5;
          $data['imatge6'] = $getimmobleImg->imatge_6;
          $data['imatge7'] = $getimmobleImg->imatge_7;
          $data['imatge8'] = $getimmobleImg->imatge_8;
          $data['imatge9'] = $getimmobleImg->imatge_9;
          $data['imatge10'] = $getimmobleImg->imatge_10;
          $this->view('habitatges/edit', $data);
        }

      } else {

        // Check owner
        if(!isLoggedInAndAdmin()){
          if($immoble->usuari_id != $_SESSION['usuari_id']){
            redirect('habitatges/index');
            return false;
          }
        }

        $data = [
          'id' => $id,
          'titol_cat' => $immoble->titol_cat,
          'titol_esp' => $immoble->titol_esp,
          'titol_eng' => $immoble->titol_eng,
          'referencia' => $immoble->referencia,
          'descripcio_cat' => $immoble->descripcio_cat,
          'descripcio_esp' => $immoble->descripcio_esp,
          'descripcio_eng' => $immoble->descripcio_eng,
          'imatge1' => $immoble->imatge_1,
          'imatge2' => $immoble->imatge_2,
          'imatge3' => $immoble->imatge_3,
          'imatge4' => $immoble->imatge_4,
          'imatge5' => $immoble->imatge_5,
          'imatge6' => $immoble->imatge_6,
          'imatge7' => $immoble->imatge_7,
          'imatge8' => $immoble->imatge_8,
          'imatge9' => $immoble->imatge_9,
          'imatge10' => $immoble->imatge_10,
          'portada' => $immoble->portada,
          'preu' => $immoble->preu,
          'habitacio' => $immoble->habitacio,
          'banys' => $immoble->banys,
          'tamany' => $immoble->tamany,
          'activat' => $immoble->activat,
          'operacio_id' => $immoble->operacio_id,
          'poblacio_id' => $immoble->poblacio_id,
          'categoria_id' => $immoble->categoria_id,
          'caracteristica_id' => $immoble->caracteristica_id,
          'certificat_id' => $immoble->certificat_id,
          'provincies' => $provincies,
          'idProvinciaByPoblacio' => $idProvinciaByPoblacio->provincia_id,
          'poblacions' => $poblacions,
          'caracteristiques' => $caracteristiques,
          'categories' => $categories,
          'certificats' => $certificats,
          'operacions' => $operacions,
          'totalPortada' => $totalPortada->total_portada
        ];

        $this->view('habitatges/edit', $data);
      }
    }

    public function carregar_poblacions(){

      // If we select a new provincia then get only their poblacions
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Default 8 = Barcelona
        $idProvincia = empty(trim($_POST['id_provincia'])) ? 8 : trim(intval($_POST['id_provincia']));

        $poblacions = $this->poblacioModel->getPoblacionsWithProvinciaId(intval($idProvincia));

        if(!$poblacions) {
          redirect('habitatges/index');
          return false;
        }

        $data = [
          'poblacions' => $poblacions
        ];

        // Send by JSON
        echo json_encode($data);

      } else {
        redirect('habitatges/index');
      }

    }

    // Delete immoble
    public function delete($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Get existing immoble from model
        $immoble = $this->immobleModel->getImmobleById($id);

        // Check owner
        if(!isLoggedInAndAdmin()){
          if($immoble->usuari_id != $_SESSION['usuari_id']){
            redirect('habitatges/index');
            return false;
          }
        }
        
        $data = [
          'imatge1' => $immoble->imatge_1,
          'imatge2' => $immoble->imatge_2,
          'imatge3' => $immoble->imatge_3,
          'imatge4' => $immoble->imatge_4,
          'imatge5' => $immoble->imatge_5,
          'imatge6' => $immoble->imatge_6,
          'imatge7' => $immoble->imatge_7,
          'imatge8' => $immoble->imatge_8,
          'imatge9' => $immoble->imatge_9,
          'imatge10' => $immoble->imatge_10
        ];

        // Delete all images of the immoble
        if(!empty($data['imatge1']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge1'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge1']);
        }
        if(!empty($data['imatge2']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge2'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge2']);
        }
        if(!empty($data['imatge3']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge3'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge3']);
        }
        if(!empty($data['imatge4']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge4'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge4']);
        }
        if(!empty($data['imatge5']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge5'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge5']);
        }
        if(!empty($data['imatge6']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge6'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge6']);
        }
        if(!empty($data['imatge7']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge7'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge7']);
        }
        if(!empty($data['imatge8']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge8'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge8']);
        }
        if(!empty($data['imatge9']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge9'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge9']);
        }
        if(!empty($data['imatge10']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge10'])){
          unlink('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge10']);
        }

        if($this->immobleModel->delete($id)){
          flash('immoble_message', 'Immoble eliminat correctament');
          redirect('habitatges/index');
          return false;
        } else {
          die('Error delete');
        }
      } else {
        redirect('habitatges/index');
        return false;
      }
    }
  }