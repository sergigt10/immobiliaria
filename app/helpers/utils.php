<?php
  header('Content-Type: text/html; charset=utf-8');

  function urls_amigables($url) {
    // Tranformamos todo a minusculas
    $url = mb_strtolower($url);
    
    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'à', 'è', 'ì', 'ò', 'ù');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u');
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

  function limitar_cadena($cadena, $limite, $sufijo){
    // Si la longitud es mayor que el límite...
    if(strlen($cadena) > $limite){
      // Entonces corta la cadena y ponle el sufijo
      return mb_substr(trim($cadena), 0, $limite) . $sufijo;
    }
    
    // Si no, entonces devuelve la cadena normal
    return $cadena;
  }

  function meta_tags($title, $description, $keywords){
    define('TITLE', $title);
    define('DESCRIPTION', $description);
    define('KEYWORDS', $keywords);
  }