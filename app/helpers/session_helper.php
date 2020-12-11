<?php
  session_start();

  // Flash message helper
  // EXAMPLE - flash('register_success', 'You are now registered');
  // DISPLAY IN VIEW - echo flash('register_success');
  function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
      if(!empty($message) && empty($_SESSION[$name])){
        if(!empty($_SESSION[$name])){
          unset($_SESSION[$name]);
        }

        if(!empty($_SESSION[$name. '_class'])){
          unset($_SESSION[$name. '_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;
      } elseif(empty($message) && !empty($_SESSION[$name])){
        $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name. '_class']);
      }
    }
  }

  function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
      return true;
    } else {
      return false;
    }
  }

  function isLoggedInAndAdmin(){
    if(isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1){
      return true;
    } else {
      return false;
    }
  }

  function isActive(){
    if(isset($_SESSION['user_id']) && $_SESSION['active'] == 1){
      return true;
    } else {
      return false;
    }
  }

  function urls_amigables($url) {
    // Tranformamos todo a minusculas
    $url = strtolower($url);

    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace ($find, $repl, $url);

    // Añadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace ($find, '-', $url);

    // Eliminamos y Reemplazamos otros carácteres especiales
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace ($find, $repl, $url);
    return $url;
  }
