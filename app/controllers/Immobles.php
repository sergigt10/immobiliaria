<?php
  class Blogs extends Controller {
    public function __construct(){
      // Sino esta registrado
      // Función helper
      if(!isLoggedIn()){
        redirect('users/login');
      }
      // Importamos los modelos
      $this->immobleModel = $this->model('Immoble');
      $this->userModel = $this->model('User');
    }

    // Cargar immobles
    public function index(){
      // Get immobles
      $immobles = $this->immobleModel->getImmobles();
      // Cargamos el array
      $data = [
        'immobles' => $immobles
      ];
      // Mostramos en la vista
      $this->view('immobles/index', $data);
    }

    // Cargar opcions
    public function opcio($type){
      // Get immobles
      $opcions = $this->immobleModel->get.$type."()";
      // Cargamos el array
      $data = [
        'opcions' => $opcions
      ];
      // Mostramos en la vista
      $this->view('immobles/index_opcio', $data);
    }

    public function add_opcio($type){
      // Si viene de un POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'nom_cat' => trim($_POST['nom_cat']),
          'nom_esp' => trim($_POST['nom_esp']),
          'nom_eng' => trim($_POST['nom_eng']),
          'nom_cat_err' => '',
          'nom_esp_err' => '',
          'nom_eng_err' => ''
        ];

        // Validate data
        if(empty($data['nom_cat'])){
          $data['nom_cat_err'] = 'Introduïr el nom';
        }

        // Validate data
        if(empty($data['nom_esp'])){
          $data['nom_esp_err'] = 'Introduïr el nom';
        }

        // Validate data
        if(empty($data['nom_eng'])){
          $data['nom_eng_err'] = 'Introduïr el nom';
        }

        // Make sure no errors
        if(empty($data['nom_cat_err']) && empty($data['nom_esp_err']) && empty($data['nom_eng_err'])){
          // Validated
          $function="add".$type."(".$data.")";
          if($this->immobleModel->$function){
            flash('opcio_message', 'Afegit correctament');
            redirect('opcions');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('immobles/add_opcio', $data);
        }

      } else {
        $data = [
          'nom' => ''
        ];
        $this->view('immobles/add_opcio', $data);
      }
    }

    // Editar opcio
    public function edit_opcio($id,$type){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'nom' => trim($_POST['nom'])
        ];

        // Validate data
        if(empty($data['nom'])){
          $data['nom_err'] = 'Introduïr el nom';
        }

        // Make sure no errors
        if(empty($data['nom_err'])){
          // Validated
          if($this->immobleModel->updateOpcio($data)){
            flash('opcio_message', 'Actualitzat correctament');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('immobles/edit_opcio', $data);
        }

      } else {
        // Hacedemos a la página edita para editar el producto pasado por parámetros

        // Get existing post from model
        $opcio = $this->immobleModel->."get".$type."ById(".$id.")";

        $data = [
          'id' => $id,
          'nom' => $opcio->nom
        ];
  
        $this->view('immobles/edit_opcio', $data);
      }
    }

    public function add(){
      // Si viene de un POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'titol_cat' => trim($_POST['titol_cat']),
          'titol_esp' => trim($_POST['titol_esp']),
          'titol_eng' => trim($_POST['titol_eng']),
          'slug_cat' => '',
          'slug_esp' => '',
          'slug_eng' => '',
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'imatge1' => trim($_POST['imatge_1']),
          'imatge2' => trim($_POST['imatge_2']),
          'imatge3' => trim($_POST['imatge_3']),
          'imatge4' => trim($_POST['imatge_4']),
          'imatge5' => trim($_POST['imatge_5']),
          'imatge6' => trim($_POST['imatge_6']),
          'imatge7' => trim($_POST['imatge_7']),
          'imatge8' => trim($_POST['imatge_8']),
          'imatge9' => trim($_POST['imatge_9']),
          'imatge10' => trim($_POST['imatge_10']),
          'portada' => trim($_POST['portada']),
          'preu' => trim($_POST['preu']),
          'habitacio' => trim($_POST['habitacio']),
          'banys' => trim($_POST['banys']),
          'tamany' => trim($_POST['tamany']),
          'activat' => trim($_POST['activat']),
          'provincia_id' => trim($_POST['provincia_id']),
          'poblacio_id' => trim($_POST['poblacio_id']),
          'categoria_id' => trim($_POST['categoria_id']),
          'caracteristica_id' => trim($_POST['caracteristica_id']),
          'usuari_id' => $_SESSION['user_id'],
          'titol_cat_err' => '',
          'titol_esp_err' => '',
          'titol_eng_err' => '',
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

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['titol_esp_err']) && empty($data['titol_eng_err'])){
          // Validated

          // Pujada d'imatges
          if (!empty($data['imatge1'])) {
            $nombre_archivo = $_FILES['foto1file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "1_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge2'])) {
            $nombre_archivo = $_FILES['foto2file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "2_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge3'])) {
            $nombre_archivo = $_FILES['foto3file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "3_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge4'])) {
            $nombre_archivo = $_FILES['foto4file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "4_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge5'])) {
            $nombre_archivo = $_FILES['foto5file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "5_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge6'])) {
            $nombre_archivo = $_FILES['foto6file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "6_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }else if($_FILES['foto6file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }else if($_FILES['foto6file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge7'])) {
            $nombre_archivo = $_FILES['foto7file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "7_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }else if($_FILES['foto7file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }else if($_FILES['foto7file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge8'])) {
            $nombre_archivo = $_FILES['foto8file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "8_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }else if($_FILES['foto8file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }else if($_FILES['foto8file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge9'])) {
            $nombre_archivo = $_FILES['foto9file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "9_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }else if($_FILES['foto9file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }else if($_FILES['foto9file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if (!empty($data['imatge10'])) {
            $nombre_archivo = $_FILES['foto10file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "10_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }else if($_FILES['foto10file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }else if($_FILES['foto10file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if($this->immobleModel->add($data)){
            flash('immoble_message', 'Immoble creat correctament');
            redirect('immobles');
          } else {
            die('Error add');
          }
        } else {
          // Load view with errors
          $this->view('immobles/add', $data);
        }

      } else {
        $data = [
          'titol_cat' => '',
          'titol_esp' => '',
          'titol_eng' => '',
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
          'provincia_id' => '',
          'poblacio_id' => '',
          'categoria_id' => '',
          'caracteristica_id' => ''
        ];

        $this->view('immobles/add', $data);
      }
    }

    // Editar post
    public function edit($id){

      // Get existing post from model
      $immoble = $this->immobleModel->getImmobleById($id);

      // Check owner
      if($immoble->user_id != $_SESSION['user_id']){
        redirect('immobles');
      }
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'id' => $id,
          'titol_cat' => trim($_POST['titol_cat']),
          'titol_esp' => trim($_POST['titol_esp']),
          'titol_eng' => trim($_POST['titol_eng']),
          'slug_cat' => '',
          'slug_esp' => '',
          'slug_eng' => '',
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'imatge1' => trim($_POST['imatge_1']),
          'imatge2' => trim($_POST['imatge_2']),
          'imatge3' => trim($_POST['imatge_3']),
          'imatge4' => trim($_POST['imatge_4']),
          'imatge5' => trim($_POST['imatge_5']),
          'imatge6' => trim($_POST['imatge_6']),
          'imatge7' => trim($_POST['imatge_7']),
          'imatge8' => trim($_POST['imatge_8']),
          'imatge9' => trim($_POST['imatge_9']),
          'imatge10' => trim($_POST['imatge_10']),
          'portada' => trim($_POST['portada']),
          'preu' => trim($_POST['preu']),
          'habitacio' => trim($_POST['habitacio']),
          'banys' => trim($_POST['banys']),
          'tamany' => trim($_POST['tamany']),
          'activat' => trim($_POST['activat']),
          'provincia_id' => trim($_POST['provincia_id']),
          'poblacio_id' => trim($_POST['poblacio_id']),
          'categoria_id' => trim($_POST['categoria_id']),
          'caracteristica_id' => trim($_POST['caracteristica_id']),
          'usuari_id' => $_SESSION['user_id'],
          'titol_cat_err' => '',
          'titol_esp_err' => '',
          'titol_eng_err' => '',
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

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['titol_esp_err']) && empty($data['titol_eng_err'])){
          
          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge1']);
            $data['imatge1'] = "";
          }

          if($del_img2 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge2']);
            $data['imatge2'] = "";
          }

          if($del_img3 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge3']);
            $data['imatge3'] = "";
          }

          if($del_img4 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge4']);
            $data['imatge4'] = "";
          }

          if($del_img5 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge5']);
            $data['imatge5'] = "";
          }

          if($del_img6 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge6']);
            $data['imatge6'] = "";
          }

          if($del_img7 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge7']);
            $data['imatge7'] = "";
          }

          if($del_img8 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge8']);
            $data['imatge8'] = "";
          }

          if($del_img9 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge9']);
            $data['imatge9'] = "";
          }

          if($del_img10 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge10']);
            $data['imatge10'] = "";
          }

          $getimmobleImg = $this->immobleModel->getimmobleImg($id);

          $dataImg = [
            'imatge1' => $getimmobleImg->imatge1,
            'imatge2' => $getimmobleImg->imatge2,
            'imatge3' => $getimmobleImg->imatge3,
            'imatge4' => $getimmobleImg->imatge4,
            'imatge5' => $getimmobleImg->imatge5,
            'imatge6' => $getimmobleImg->imatge6,
            'imatge7' => $getimmobleImg->imatge7,
            'imatge8' => $getimmobleImg->imatge8,
            'imatge9' => $getimmobleImg->imatge9,
            'imatge10' => $getimmobleImg->imatge10
          ];

          // Pujada d'imatges. Es mira si ens passen un arxiu i si aquest es nou.
          if (!empty($data['imatge1']) && $del_img1 != "1" && $dataImg['imatge1']!=$data['imatge1']) {
            $nombre_archivo = $_FILES['foto1file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "1_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto1file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge1']);
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge1']);
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge1']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge2']) && $del_img2 != "1" && $dataImg['imatge2']!=$data['imatge2']) {
            $nombre_archivo = $_FILES['foto2file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "2_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto2file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge2']);
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge2']);
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge2']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge3']) && $del_img3 != "1" && $dataImg['imatge3']!=$data['imatge3']) {
            $nombre_archivo = $_FILES['foto3file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "3_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto3file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge3']);
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge3']);
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge3']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge4']) && $del_img4 != "1" && $dataImg['imatge4']!=$data['imatge4']) {
            $nombre_archivo = $_FILES['foto4file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "4_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto4file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge4']);
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge4']);
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge4']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge5']) && $del_img5 != "1" && $dataImg['imatge5']!=$data['imatge5']) {
            $nombre_archivo = $_FILES['foto5file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "5_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto5file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge5']);
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge5']);
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge5']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge6']) && $del_img6 != "1" && $dataImg['imatge6']!=$data['imatge6']) {
            $nombre_archivo = $_FILES['foto6file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "6_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto6file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge6']);
            }else if($_FILES['foto6file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge6']);
            }else if($_FILES['foto6file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge6'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge6']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge7']) && $del_img7 != "1" && $dataImg['imatge7']!=$data['imatge7']) {
            $nombre_archivo = $_FILES['foto7file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "7_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto7file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge7']);
            }else if($_FILES['foto7file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge7']);
            }else if($_FILES['foto7file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge7'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge7']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge8']) && $del_img8 != "1" && $dataImg['imatge8']!=$data['imatge8']) {
            $nombre_archivo = $_FILES['foto8file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "8_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto8file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge8']);
            }else if($_FILES['foto8file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge8']);
            }else if($_FILES['foto8file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge8'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge8']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge9']) && $del_img9 != "1" && $dataImg['imatge9']!=$data['imatge9']) {
            $nombre_archivo = $_FILES['foto9file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "9_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto9file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge9']);
            }else if($_FILES['foto9file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge9']);
            }else if($_FILES['foto9file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge9'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge9']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if (!empty($data['imatge10']) && $del_img10 != "1" && $dataImg['imatge10']!=$data['imatge10']) {
            $nombre_archivo = $_FILES['foto10file']['name'];
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
            $id_thumb=rand(1, 30);
            $new_nombre_thumb = "10_".$id_thumb."_".$nombre_archivo;

            //Destruir la original
            imagedestroy($original);

            //Comprovem si es jpg / png o gif depenent de la situacio cridara una funció o una altre
            if($_FILES['foto10file']['type']=='image/jpeg'){
              //Crear la imagen y guardar en un directorio
              imagejpeg($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge10']);
            }else if($_FILES['foto10file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge10']);
            }else if($_FILES['foto10file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['imatge10'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['imatge10']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if($this->immobleModel->update($data)){
            flash('immoble_message', 'Immbole actualitzat correctament');
            redirect('immobles');
          } else {
            die('Error update');
          }
        } else {
          // Load view with errors
          $this->view('immobles/edit', $data);
        }

      } else {
        // Accedemos a la página editar para editar el producto pasado por parámetros

        $data = [
          'id' => $id,
          'titol_cat' => $immoble->titol_cat,
          'titol_esp' => $immoble->titol_esp,
          'titol_eng' => $immoble->titol_eng,
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
          'provincia_id' => $immoble->provincia_id,
          'poblacio_id' => $immoble->poblacio_id,
          'categoria_id' => $immoble->categoria_id,
          'caracteristica_id' => $immoble->caracteristica_id
        ];

        $this->view('immobles/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $immoble = $this->immobleModel->getImmobleById($id);
        $data = [
          'imatge1' => $immoble->imatge1,
          'imatge2' => $immoble->imatge2,
          'imatge3' => $immoble->imatge3,
          'imatge4' => $immoble->imatge4,
          'imatge5' => $immoble->imatge5,
          'imatge6' => $immoble->imatge6,
          'imatge7' => $immoble->imatge7,
          'imatge8' => $immoble->imatge8,
          'imatge9' => $immoble->imatge9,
          'imatge10' => $immoble->imatge10
        ];
        if(!empty($data['imatge1']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge1'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge1']);
        }
        if(!empty($data['imatge2']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge2'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge2']);
        }
        if(!empty($data['imatge3']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge3'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge3']);
        }
        if(!empty($data['imatge4']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge4'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge4']);
        }
        if(!empty($data['imatge5']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge5'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge5']);
        }
        if(!empty($data['imatge6']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge6'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge6']);
        }
        if(!empty($data['imatge8']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge8'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge8']);
        }
        if(!empty($data['imatge9']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge9'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge9']);
        }
        if(!empty($data['imatge10']) && file_exists('../../admin-web/public/images/img_xarxa/'.$data['imatge10'])){
          unlink('../../admin-web/public/images/img_xarxa/'.$data['imatge10']);
        }

        if($this->blogModel->deleteBlog($id)){
          flash('immoble_message', 'Immoble eliminat correctament');
          redirect('immobles');
        } else {
          die('Error delete');
        }
      } else {
        redirect('immobles');
      }
    }
  }