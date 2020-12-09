<?php
  class Blogs extends Controller {
    public function __construct(){
      // Sino esta registrado
      // Función helper
      if(!isLoggedIn()){
        redirect('users/login');
      }
      // Importamos los modelos
      $this->blogModel = $this->model('Blog');
      $this->userModel = $this->model('User');
    }

    // Cargar menu
    public function index(){
      // Get menus
      $blogs = $this->blogModel->getBlogs();
      // Cargamos el array
      $data = [
        'blogs' => $blogs
      ];
      // Mostramos en la vista
      $this->view('blogs/index', $data);
    }

    public function add(){
      // Si viene de un POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'titol_cat' => trim($_POST['titol_cat']),
          'id_tag' => trim($_POST['id_tag']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'imatge1' => trim($_POST['imatge1']),
          'imatge2' => trim($_POST['imatge2']),
          'imatge3' => trim($_POST['imatge3']),
          'imatge4' => trim($_POST['imatge4']),
          'imatge5' => trim($_POST['imatge5']),
          'titol_cat_err' => '',
          'descripcio_cat_err' => ''
        ];

        // Validate data
        if(empty($data['titol_cat'])){
          $data['titol_cat_err'] = 'Introduïr títol';
        }
        if(empty($data['descripcio_cat'])){
          $data['descripcio_cat_err'] = 'Introduïr descripció';
        }

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['descripcio_cat_err'])){
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }
          if($this->blogModel->addBlog($data)){
            flash('post_message', 'Creat correctament');
            redirect('blogs');
          } else {
            die('Error add');
          }
        } else {
          // Load view with errors
          $this->view('blogs/add', $data);
        }

      } else {
        $data = [
          'titol_cat' => '',
          'id_tag' => '',
          'descripcio_cat' => '',
          'imatge1' => '',
          'imatge2' => '',
          'imatge3' => '',
          'imatge4' => '',
          'imatge5' => ''
        ];
  
        $this->view('blogs/add', $data);
      }
    }

    // Editar post
    public function edit($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'id_blog' => $id,
          'titol_cat' => trim($_POST['titol_cat']),
          'id_tag' => trim($_POST['id_tag']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'imatge1' => trim($_POST['imatge1']),
          'imatge2' => trim($_POST['imatge2']),
          'imatge3' => trim($_POST['imatge3']),
          'imatge4' => trim($_POST['imatge4']),
          'imatge5' => trim($_POST['imatge5']),
          'titol_cat_err' => '',
          'descripcio_cat_err' => ''
        ];

        $del_img1 = (!empty($_POST["del_img1"])) ? '1' : '0';
        $del_img2 = (!empty($_POST["del_img2"])) ? '1' : '0';
        $del_img3 = (!empty($_POST["del_img3"])) ? '1' : '0';
        $del_img4 = (!empty($_POST["del_img4"])) ? '1' : '0';
        $del_img5 = (!empty($_POST["del_img5"])) ? '1' : '0';

        // Validate data
        if(empty($data['titol_cat'])){
          $data['titol_cat_err'] = 'Introduïr títol';
        }
        if(empty($data['descripcio_cat'])){
          $data['descripcio_cat_err'] = 'Introduïr descripció';
        }

        // Make sure no errors
        if(empty($data['titol_cat_err']) && empty($data['descripcio_cat_err'])){
          // Validated
          
          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img_podologia/'.$data['imatge1']);
            $data['imatge1'] = "";
          }

          if($del_img2 == "1"){
            unlink('../../admin-web/public/images/img_podologia/'.$data['imatge2']);
            $data['imatge2'] = "";
          }

          if($del_img3 == "1"){
            unlink('../../admin-web/public/images/img_podologia/'.$data['imatge3']);
            $data['imatge3'] = "";
          }

          if($del_img4 == "1"){
            unlink('../../admin-web/public/images/img_podologia/'.$data['imatge4']);
            $data['imatge4'] = "";
          }

          if($del_img5 == "1"){
            unlink('../../admin-web/public/images/img_podologia/'.$data['imatge5']);
            $data['imatge5'] = "";
          }

          $getblogImg = $this->blogModel->getBlogById($id);

          $dataImg = [
            'imatge1' => $getblogImg->imatge1,
            'imatge2' => $getblogImg->imatge2,
            'imatge3' => $getblogImg->imatge3,
            'imatge4' => $getblogImg->imatge4,
            'imatge5' => $getblogImg->imatge5
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge1']);
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge1']);
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge1'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge1']);
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge2']);
            }else if($_FILES['foto2file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge2']);
            }else if($_FILES['foto2file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge2'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge2']);
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge3']);
            }else if($_FILES['foto3file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge3']);
            }else if($_FILES['foto3file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge3'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge3']);
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge4']);
            }else if($_FILES['foto4file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge4']);
            }else if($_FILES['foto4file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge4'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge4']);
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
              imagejpeg($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge5']);
            }else if($_FILES['foto5file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge5']);
            }else if($_FILES['foto5file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_podologia/$new_nombre_thumb");
              $data['imatge5'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_podologia/".$dataImg['imatge5']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          if($this->blogModel->updateBlog($data)){
            flash('post_message', 'Actualitzat correctament');
            redirect('blogs');
          } else {
            die('Error update');
          }
        } else {
          // Load view with errors
          $this->view('blogs/edit', $data);
        }

      } else {
        // Accedemos a la página editar para editar el producto pasado por parámetros
        // Get existing post from model
        $blog = $this->blogModel->getBlogById($id);

        $data = [
          'id_blog' => $id,
          'titol_cat' => $blog->titol_cat,
          'id_tag' => $blog->id_tag,
          'descripcio_cat' => $blog->descripcio_cat,
          'imatge1' => $blog->imatge1,
          'imatge2' => $blog->imatge2,
          'imatge3' => $blog->imatge3,
          'imatge4' => $blog->imatge4,
          'imatge5' => $blog->imatge5
        ];
  
        $this->view('blogs/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $blog = $this->blogModel->getBlogById($id);
        $data = [
          'imatge1' => $blog->imatge1,
          'imatge2' => $blog->imatge2,
          'imatge3' => $blog->imatge3,
          'imatge4' => $blog->imatge4,
          'imatge5' => $blog->imatge5
        ];
        if(!empty($data['imatge1']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge1'])){
          unlink('../../admin-web/public/images/img_podologia/'.$data['imatge1']);
        }
        if(!empty($data['imatge2']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge2'])){
          unlink('../../admin-web/public/images/img_podologia/'.$data['imatge2']);
        }
        if(!empty($data['imatge3']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge3'])){
          unlink('../../admin-web/public/images/img_podologia/'.$data['imatge3']);
        }
        if(!empty($data['imatge4']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge4'])){
          unlink('../../admin-web/public/images/img_podologia/'.$data['imatge4']);
        }
        if(!empty($data['imatge5']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge5'])){
          unlink('../../admin-web/public/images/img_podologia/'.$data['imatge5']);
        }

        if($this->blogModel->deleteBlog($id)){
          flash('post_message', 'Eliminat correctament');
          redirect('blogs');
        } else {
          die('Error delete');
        }
      } else {
        redirect('blogs');
      }
    }
  }