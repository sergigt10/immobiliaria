<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Administració de la web</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?php echo URLROOT; ?>/images/favicon.ico" />
</head>
<style type="text/css">
    .auth .login-half-bg{
      background: url("<?php echo URLROOT; ?>/images/auth/portada-login.jpg");
      background-size: cover;
    }
    .content-wrapper {
      background: white;
      padding: 1.75rem 1.312rem;
      width: 100%;
      -webkit-flex-grow: 1;
      flex-grow: 1;
    }
    .text-primary, .list-wrapper .completed .remove{
      color: black !important;
    }
    .btn-primary:hover, .wizard > .actions a:hover{
      color: black;
      background-color: white;
      border-color: black;
    }
    .btn-primary, .wizard > .actions a{
      color: #fff;
      background-color: black;
      border-color: black;
    }
    .auth .brand-logo img{
      width: auto !important;
    }
</style>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?php echo URLROOT; ?>/images/logo_login.png" alt="logo">
              </div>
              <h4>Benvingut/da!</h4>
              <h6>Zona restringida</h6>
              <form class="pt-3" action="<?php echo URLROOT; ?>/usuaris/login" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail">Usuari</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="username" class="form-control form-control-lg border-left-0 <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>" id="exampleInputEmail" value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Contrasenya</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0 <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="exampleInputPassword" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>    
                  </div>
                </div>
                <div class="my-3">
                  <input name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value = "INICIAR SESSIÓ"/>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end"><a style="color: white" target="_blank" href="http://www.webmastervic.com/">Disseny web: Webmastervic</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo URLROOT; ?>/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?php echo URLROOT; ?>/js/off-canvas.js"></script>
  <script src="<?php echo URLROOT; ?>/js/hoverable-collapse.js"></script>
  <script src="<?php echo URLROOT; ?>/js/template.js"></script>
  <script src="<?php echo URLROOT; ?>/js/settings.js"></script>
  <script src="<?php echo URLROOT; ?>/js/todolist.js"></script>
</body>
</html>