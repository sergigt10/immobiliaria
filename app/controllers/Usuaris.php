<?php
  class Usuaris extends Controller {
    public function __construct(){
      $this->usuariModel = $this->model('Usuari');
    }

    // Load usuari
    public function index(){

      if(!isLoggedIn()){
        redirect('usuaris/login');
      } else if(!$this->usuariModel->getIsActivateById($_SESSION['usuari_id'])) {
        redirect('usuaris/login');
      }

      if(!isLoggedInAndAdmin()){
        $usuaris = [$this->usuariModel->getUsuariById($_SESSION['usuari_id'])];
      } else {
        $usuaris = $this->usuariModel->getUsuaris();
      }
      
      // Cargamos el array
      $data = [
        'usuaris' => $usuaris
      ];
      // Mostramos en la vista
      $this->view('usuaris/index', $data);

    }
    
    // Login
    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'username_err' => '',
          'password_err' => '',      
        ];

        // Validate username
        if(empty($data['username'])){
          $data['username_err'] = "Introduïu el nom d'usuari";
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Introduïu la contrasenya';
        }

        // Check for username
        if(!$this->usuariModel->findUsuariByUsername($data['username'])){
          // User not found
          $data['username_err'] = "Hi ha un error amb l'usuari o contrasenya";
          $data['password_err'] = "Hi ha un error amb l'usuari o contrasenya";
        }

        // Make sure errors are empty
        if(empty($data['username_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in usuari
          $loggedInUser = $this->usuariModel->login($data['username'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            // Error password
            $data['username_err'] = "Hi ha un error amb l'usuari o contrasenya";
            $data['password_err'] = "Hi ha un error amb l'usuari o contrasenya";

            $this->view('usuaris/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('usuaris/login', $data);
        }
      } else {
        // Init data
        $data =[    
          'username' => '',
          'password' => '',
          'username_err' => '',
          'password_err' => '',        
        ];
        // Load view
        $this->view('usuaris/login', $data);
      }
    }

    // Add usuari
    public function add(){

      if(!isLoggedInAndAdmin()){
        redirect('usuaris/login');
      }

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'email' => trim(strtolower($_POST['email'])),
          'contrasenya' => trim($_POST['contrasenya']),
          'confirm_password' => trim($_POST['confirm_password']),
          'nom_cognoms' => trim(ucwords($_POST['nom_cognoms'])),
          'empresa' => trim($_POST['empresa']),
          'direccio' => trim($_POST['direccio']),
          'poblacio' => trim($_POST['poblacio']),
          'codi_postal' => trim($_POST['codi_postal']),
          'telefon' => trim($_POST['telefon']),
          'web' => trim($_POST['web']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'logo' => trim($_POST['logo']),
          'max_immobles' => trim($_POST['max_immobles']),
          'max_fotos' => trim($_POST['max_fotos']),
          'activat' => trim($_POST['activat']),
          'email_err' => '',
          'contrasenya_err' => '',
          'nom_cognoms_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Introduïu el correu electrònic';
        } else {
          // Check email
          if($this->usuariModel->findUsuariByUsername($data['email'])){
            $data['email_err'] = 'Aquest correu electrònic ja s\'utilitza';
          }
        }

        // Validate Password
        if(empty($data['contrasenya'])){
          $data['contrasenya_err'] = 'Introduïu una contrasenya';
        } elseif(strlen($data['contrasenya']) < 6){
          $data['contrasenya_err'] = 'La contrasenya ha de tenir com a mínim 6 caràcters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Introduïu la confirmació de la contrasenya';
        } else {
          if($data['contrasenya'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Les contrasenyes no coincideixen';
          }
        }

        // Validate Name
        if(empty($data['nom_cognoms'])){
          $data['nom_cognoms_err'] = 'Introduïu un nom i cognom';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['nom_cognoms_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Pujada d'imatges
          if (!empty($data['logo'])) {
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
              $data['logo'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['logo'] = "$new_nombre_thumb";
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['logo'] = "$new_nombre_thumb";
            }
            // ********* Fin REDUIR IMATGE *********
          }

          // Hash Password
          $data['contrasenya'] = password_hash($data['contrasenya'], PASSWORD_DEFAULT);

          // Register Usuaris
          if($this->usuariModel->add($data)){
            flash('register_success', 'L\'usuari s\'ha creat correctament');
            redirect('/usuaris/add');
          } else {
            die('Error !');
          }

        } else {
          // Load view with errors
          $this->view('usuaris/add', $data);
        }

      } else {
        // Init data
        $data =[
          'email' => '',
          'contrasenya' => '',
          'confirm_password' => '',
          'nom_cognoms' => '',
          'empresa' => '',
          'direccio' => '',
          'poblacio' => '',
          'codi_postal' => '',
          'telefon' => '',
          'web' => '',
          'descripcio_cat' => '',
          'descripcio_esp' => '',
          'descripcio_eng' => '',
          'logo' => '',
          'max_immobles' => '',
          'max_fotos' => '',
          'activat' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('usuaris/add', $data);
      }
    }

    // Edit usuari by admin
    public function edit($id){

      if(!isLoggedIn()){
        redirect('usuaris/login');
      } else if(!$this->usuariModel->getIsActivateById($_SESSION['usuari_id'])) {
        redirect('usuaris/login');
      }

      // Get existing usuari from model
      $usuari = $this->usuariModel->getUsuariById($id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST);

        $data = [
          'id' => $id,
          'email' => (isLoggedInAndAdmin()) ? trim(strtolower($_POST['email'])) : $usuari->email,
          'contrasenya' => trim($_POST['contrasenya']),
          'confirm_password' => trim($_POST['confirm_password']),
          'nom_cognoms' => trim(ucwords($_POST['nom_cognoms'])),
          'empresa' => trim($_POST['empresa']),
          'direccio' => trim($_POST['direccio']),
          'poblacio' => trim($_POST['poblacio']),
          'codi_postal' => trim($_POST['codi_postal']),
          'telefon' => trim($_POST['telefon']),
          'web' => trim($_POST['web']),
          'descripcio_esp' => trim($_POST['descripcio_esp']),
          'descripcio_cat' => trim($_POST['descripcio_cat']),
          'descripcio_eng' => trim($_POST['descripcio_eng']),
          'logo' => trim($_POST['logo']),
          'max_immobles' => (isLoggedInAndAdmin()) ? trim(strtolower($_POST['max_immobles'])) : $usuari->max_immobles,
          'max_fotos' => (isLoggedInAndAdmin()) ? trim(strtolower($_POST['max_fotos'])) : $usuari->max_fotos,
          'activat' => (isLoggedInAndAdmin()) ? trim(strtolower($_POST['activat'])) : $usuari->activat,
          'email_err' => '',
          'contrasenya_err' => '',
          'nom_cognoms_err' => '',
          'confirm_password_err' => ''
        ];

        $del_img1 = (!empty($_POST["del_img1"])) ? '1' : '0';

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Introduïu el correu electrònic';
        } else {
          // Check email
          if($this->usuariModel->findUsuariByUsername($data['email']) && $usuari->email != $data['email'] ){
            $data['email_err'] = 'Aquest correu electrònic ja s\'utilitza';
          }
        }

        if(empty($data['contrasenya'])){
          $data['contrasenya'] = $usuari->contrasenya;
        } else {
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Introduïu la confirmació de la contrasenya';
          } else {
            if($data['contrasenya'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Les contrasenyes no coincideixen';
            }
          }

          $data['contrasenya'] = password_hash($data['contrasenya'], PASSWORD_DEFAULT);
        }

        // Validate Name
        if(empty($data['nom_cognoms'])){
          $data['nom_cognoms_err'] = 'Introduïu un nom i cognom';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['nom_cognoms_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['logo']);
            $data['logo'] = "";
          }

          $getUsuariImg = $this->usuariModel->getUsuariById($id);

          $dataImg = [
            'logo' => $getUsuariImg->logo
          ];

          // Pujada d'imatges. Es mira si ens passen un arxiu i si aquest es nou.
          if (!empty($data['logo']) && $del_img1 != "1" && $dataImg['logo']!=$data['logo']) {
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
              $data['logo'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['logo']);
            }else if($_FILES['foto1file']['type']=='image/png'){
              imagepng($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['logo'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['logo']);
            }else if($_FILES['foto1file']['type']=='image/gif'){
              imagegif($lienzo,"../../admin-web/public/images/img_xarxa/$new_nombre_thumb");
              $data['logo'] = "$new_nombre_thumb";
              unlink("../../admin-web/public/images/img_xarxa/".$dataImg['logo']);
            }
            // ********* Fin REDUIR IMATGE *********
          }

          // Validated
          if($this->usuariModel->update($data)){
            flash('post_message', 'Usuari actualitzat correctament');
            redirect('usuaris');
          } else {
            die('Error!');
          }
        } else {
          // Load view with errors
          $data['contrasenya'] = '';
          $data['confirm_password'] = '';
          $this->view('usuaris/edit', $data);
        }

      } else {

        if(!isLoggedInAndAdmin()){
          // Check for usuari owner
          if($usuari->id != $_SESSION['usuari_id']){
            redirect('usuaris');
          }
        }
        
        $data = [
          'id' => $id,
          'email' => $usuari->email,
          'contrasenya' => '',
          'confirm_password' => '',
          'nom_cognoms' => $usuari->nom_cognoms,
          'empresa' => $usuari->empresa,
          'direccio' => $usuari->direccio,
          'poblacio' => $usuari->poblacio,
          'codi_postal' => $usuari->codi_postal,
          'telefon' => $usuari->telefon,
          'web' => $usuari->web,
          'descripcio_cat' => $usuari->descripcio_cat,
          'descripcio_esp' => $usuari->descripcio_esp,
          'descripcio_eng' => $usuari->descripcio_eng,
          'logo' => $usuari->logo,
          'max_immobles' => $usuari->max_immobles,
          'max_fotos' => $usuari->max_fotos,
          'activat' => $usuari->activat,
        ];
  
        $this->view('usuaris/edit', $data);
      }
    }

    // Session
    public function createUserSession($usuari){
      $_SESSION['usuari_id'] = htmlspecialchars(strip_tags($usuari->id));
      $_SESSION['user_name'] = htmlspecialchars(strip_tags($usuari->email));
      $_SESSION['name_surname'] = htmlspecialchars(strip_tags($usuari->nom_cognoms));
      $_SESSION['isAdmin'] = htmlspecialchars(strip_tags($usuari->es_admin));
      $_SESSION['max_immobles'] = htmlspecialchars(strip_tags($usuari->max_immobles));
      $_SESSION['max_fotos'] = htmlspecialchars(strip_tags($usuari->max_fotos));
      redirect('index');
    }

    // Logout
    public function logout(){
      unset($_SESSION['usuari_id']);
      unset($_SESSION['user_name']);
      unset($_SESSION['name_surname']);
      unset($_SESSION['isAdmin']);
      unset($_SESSION['max_immobles']);
      unset($_SESSION['max_fotos']);
      session_destroy();
      redirect('usuaris/login');
    }
  }