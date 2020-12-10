<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    // Load user
    public function index(){

      if(!isLoggedIn()){
        redirect('users/login');
      }

      if(!isLoggedInAndAdmin()){
        $users = [$this->userModel->getUserById($_SESSION['user_id'])];
      } else {
        $users = $this->userModel->getUsers();
      }
      
      // Cargamos el array
      $data = [
        'users' => $users
      ];
      // Mostramos en la vista
      $this->view('users/index', $data);

    }

    // Add user
    public function add(){

      if(!isLoggedInAndAdmin()){
        redirect('users/login');
      }

      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'email' => trim(strtolower($_POST['email'])),
          'contrasena' => trim($_POST['contrasena']),
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
          'contrasena_err' => '',
          'nom_cognoms_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Introduïu el correu electrònic';
        } else {
          // Check email
          if($this->userModel->findUserByUsername($data['email'])){
            $data['email_err'] = 'Aquest correu electrònic ja s\'utilitza';
          }
        }

        // Validate Password
        if(empty($data['contrasena'])){
          $data['contrasena_err'] = 'Introduïu una contrasenya';
        } elseif(strlen($data['contrasena']) < 6){
          $data['contrasena_err'] = 'La contrasenya ha de tenir com a mínim 6 caràcters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Introduïu la confirmació de la contrasenya';
        } else {
          if($data['contrasena'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Les contrasenyes no coincideixen';
          }
        }

        // Validate Name
        if(empty($data['nom_cognoms'])){
          $data['nom_cognoms_err'] = 'Introduïu un nom i cognoms';
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
          $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->add($data)){
            flash('register_success', 'L\'usuari s\'ha creat correctament');
            redirect('/users/add');
          } else {
            die('Error !');
          }

        } else {
          // Load view with errors
          $this->view('users/add', $data);
        }

      } else {
        // Init data
        $data =[
          'email' => '',
          'contrasena' => '',
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
        $this->view('users/add', $data);
      }
    }

    // Edit user by admin
    public function edit_admin($id){

      if(!isLoggedInAndAdmin()){
        redirect('users/login');
      }

      // Get existing user from model
      $user = $this->userModel->getUserById($id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'email' => trim(strtolower($_POST['email'])),
          'contrasena' => trim($_POST['contrasena']),
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
          'contrasena_err' => '',
          'nom_cognoms_err' => '',
          'confirm_password_err' => ''
        ];

        $del_img1 = (!empty($_POST["del_img1"])) ? '1' : '0';

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Introduïu el correu electrònic';
        } else {
          // Check email
          if($this->userModel->findUserByUsername($data['email']) && $user->email != $data['email'] ){
            $data['email_err'] = 'Aquest correu electrònic ja s\'utilitza';
          }
        }

        if(empty($data['contrasena'])){
          $data['contrasena'] = $user->contrasena;
        } else {
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Introduïu la confirmació de la contrasenya';
          } else {
            if($data['contrasena'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Les contrasenyes no coincideixen';
            }
          }

          $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        }

        // Validate Name
        if(empty($data['nom_cognoms'])){
          $data['nom_cognoms_err'] = 'Introduïu un nom i cognoms';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['nom_cognoms_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['logo']);
            $data['logo'] = "";
          }

          $getUserImg = $this->userModel->getUserById($id);

          $dataImg = [
            'logo' => $getUserImg->logo
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
          if($this->userModel->updateAdmin($data)){
            flash('post_message', 'Usuari actualitzat correctament');
            redirect('users');
          } else {
            die('Error!');
          }
        } else {
          // Load view with errors
          $data['contrasena'] = '';
          $data['confirm_password'] = '';
          $this->view('users/edit_admin', $data);
        }

      } else {
        // Acedemos a la página edita para editar el producto pasado por parámetros

        $data = [
          'id' => $id,
          'email' => $user->email,
          'contrasena' => '',
          'confirm_password' => '',
          'nom_cognoms' => $user->nom_cognoms,
          'empresa' => $user->empresa,
          'direccio' => $user->direccio,
          'poblacio' => $user->poblacio,
          'codi_postal' => $user->codi_postal,
          'telefon' => $user->telefon,
          'web' => $user->web,
          'descripcio_cat' => $user->descripcio_cat,
          'descripcio_esp' => $user->descripcio_esp,
          'descripcio_eng' => $user->descripcio_eng,
          'logo' => $user->logo,
          'max_immobles' => $user->max_immobles,
          'max_fotos' => $user->max_fotos,
          'activat' => $user->activat,
        ];
  
        $this->view('users/edit_admin', $data);
      }
    }

    // Edit user
    public function edit($id){

      if(!isLoggedIn()){
        redirect('users/login');
      }

      // Get existing user from model
      $user = $this->userModel->getUserById($id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'contrasena' => trim($_POST['contrasena']),
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
          'email_err' => '',
          'contrasena_err' => '',
          'nom_cognoms_err' => '',
          'confirm_password_err' => ''
        ];

        $del_img1 = (!empty($_POST["del_img1"])) ? '1' : '0';

        if(empty($data['contrasena'])){
          $data['contrasena'] = $user->contrasena;
        } else {
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Introduïu la confirmació de la contrasenya';
          } else {
            if($data['contrasena'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Les contrasenyes no coincideixen';
            }
          }

          $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        }

        // Validate Name
        if(empty($data['nom_cognoms'])){
          $data['nom_cognoms_err'] = 'Introduïu un nom i cognoms';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['nom_cognoms_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

          // Eliminar imatges
          if($del_img1 == "1"){
            unlink('../../admin-web/public/images/img_xarxa/'.$data['logo']);
            $data['logo'] = "";
          }

          $getUserImg = $this->userModel->getUserById($id);

          $dataImg = [
            'logo' => $getUserImg->logo
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
          if($this->userModel->update($data)){
            flash('post_message', 'Usuari actualitzat correctament');
            redirect('users');
          } else {
            die('Error!');
          }
        } else {
          // Load view with errors
          $data['contrasena'] = '';
          $data['confirm_password'] = '';
          $this->view('users/edit', $data);
        }

      } else {
        // Hacedemos a la página edita para editar el producto pasado por parámetros

        // Check for user owner
        if($user->id != $_SESSION['user_id']){
          redirect('users');
        }

        $data = [
          'id' => $id,
          'contrasena' => '',
          'confirm_password' => '',
          'nom_cognoms' => $user->nom_cognoms,
          'empresa' => $user->empresa,
          'direccio' => $user->direccio,
          'poblacio' => $user->poblacio,
          'codi_postal' => $user->codi_postal,
          'telefon' => $user->telefon,
          'web' => $user->web,
          'descripcio_cat' => $user->descripcio_cat,
          'descripcio_esp' => $user->descripcio_esp,
          'descripcio_eng' => $user->descripcio_eng,
          'logo' => $user->logo
        ];
  
        $this->view('users/edit', $data);
      }
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
        if($this->userModel->findUserByUsername($data['username'])){
          // User found
        } else {
          // User not found
          $data['username_err'] = "Hi ha un error amb l'usuari o contrasenya";
          $data['password_err'] = "Hi ha un error amb l'usuari o contrasenya";
        }

        // Make sure errors are empty
        if(empty($data['username_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['username'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            // Error password
            $data['username_err'] = "Hi ha un error amb l'usuari o contrasenya";
            $data['password_err'] = "Hi ha un error amb l'usuari o contrasenya";

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
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
        $this->view('users/login', $data);
      }
    }

    // Session
    public function createUserSession($user){
      $_SESSION['user_id'] = htmlspecialchars(strip_tags($user->id));
      $_SESSION['user_name'] = htmlspecialchars(strip_tags($user->email));
      $_SESSION['name_surname'] = htmlspecialchars(strip_tags($user->nom_cognoms));
      $_SESSION['activate'] = htmlspecialchars(strip_tags($user->activat));
      $_SESSION['isAdmin'] = htmlspecialchars(strip_tags($user->es_admin));
      redirect('index');
    }

    // Logout
    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_name']);
      unset($_SESSION['name_surname']);
      unset($_SESSION['activat']);
      unset($_SESSION['isAdmin']);
      session_destroy();
      redirect('users/login');
    }
  }