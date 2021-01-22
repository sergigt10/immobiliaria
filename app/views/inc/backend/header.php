<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Zona restringida - Immobiliàries en xarxa</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/backend/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?php echo URLROOT; ?>/images/favicon.ico" />
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo URLROOT; ?>/admin/index"><img src="<?php echo URLROOT; ?>/images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo URLROOT; ?>/admin/index"><img src="<?php echo URLROOT; ?>/images/logo-mini.svg" alt="logo"/></a>
      </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav navbar-nav-left">
            <a href="<?php echo URLROOT; ?>" target="_blank" style="color:black">Veure pàgina web</a>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown mr-0 mr-sm-2">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <span class="nav-profile-name"><?php echo $_SESSION['name_surname']?> - Desconectar</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/usuaris/logout">
                  <i class="mdi mdi-logout text-primary"></i>
                  Tancar sessió
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <div id="right-sidebar" class="settings-panel"></div>
        <?php (isLoggedInAndAdmin()) ?  require APPROOT . '/views/inc/backend/navbar_admin.php' : require APPROOT . '/views/inc/backend/navbar.php'; ?>