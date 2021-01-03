<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Modificar usuari</h2>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $data['id']; ?>" enctype="multipart/form-data">

                <?php echo (!empty($data['email_err'])) ? '<div class="alert alert-danger" role="alert">'.$data['email_err'].'</div>' : ''; ?>
                <?php echo (!empty($data['contrasenya_err'])) ? '<div class="alert alert-danger" role="alert">'.$data['contrasenya_err'].'</div>' : ''; ?>
                <?php echo (!empty($data['confirm_password_err'])) ? '<div class="alert alert-danger" role="alert">'.$data['confirm_password_err'].'</div>' : ''; ?>
                <?php echo (!empty($data['nom_cognoms_err'])) ? '<div class="alert alert-danger" role="alert">'.$data['nom_cognoms_err'].'</div>' : ''; ?>

                <?php if(isLoggedInAndAdmin()) { ?>
                <div class="form-group">
                  <label for="exampleInputEmail3">Correu electrònic *:</label>
                  <input name="email" type="email" class="form-control" id="exampleInputEmail3" placeholder="Correu electrònic" value="<?php echo $data['email']; ?>">
                </div>
                <?php } ?>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Contrasenya *:</label>
                    <input name="contrasenya" type="password" class="form-control" id="exampleInputEmail3" placeholder="Contrasenya" value="<?php echo $data['contrasenya']; ?>">
                    <h5 style="color:red">Si es deixa buit el camp es manté la contrasenya actual. Mínim 6 caràcters.</h5>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Confirmar contrasenya *:</label>
                    <input name="confirm_password" type="password" class="form-control" id="exampleInputEmail3" placeholder="Confirmar la contrasenya" value="<?php echo $data['confirm_password']; ?>">
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Nom i cognom *:</label>
                    <input name="nom_cognoms" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom" value="<?php echo $data['nom_cognoms']; ?>">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Empresa:</label>
                    <input name="empresa" type="text" class="form-control" id="exampleInputEmail3" placeholder="Empresa" value="<?php echo $data['empresa']; ?>">
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Adreça:</label>
                    <input name="direccio" type="text" class="form-control" id="exampleInputEmail3" placeholder="Adreça" value="<?php echo $data['direccio']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Població:</label>
                    <input name="poblacio" type="text" class="form-control" id="exampleInputEmail3" placeholder="Població" value="<?php echo $data['poblacio']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Codi postal:</label>
                    <input name="codi_postal" type="text" class="form-control" id="exampleInputEmail3" placeholder="Codi postal" value="<?php echo $data['codi_postal']; ?>">
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Telèfon:</label>
                    <input name="telefon" type="text" class="form-control" id="exampleInputEmail3" placeholder="Telèfon" value="<?php echo $data['telefon']; ?>">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Pàgina web:</label>
                    <input name="web" type="text" class="form-control" id="exampleInputEmail3" placeholder="www.hola.com" value="<?php echo $data['web']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail3">Descripció CAT:</label>
                  <textarea id="tinyMceExample2" class="editor" name="descripcio_cat"><?php echo $data['descripcio_cat']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail3">Descripció ESP:</label>
                  <textarea id="tinyMceExample2" class="editor" name="descripcio_esp"><?php echo $data['descripcio_esp']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail3">Descripció ENG:</label>
                  <textarea id="tinyMceExample2" class="editor" name="descripcio_eng"><?php echo $data['descripcio_eng']; ?></textarea>
                </div>
                
                <?php if(isLoggedInAndAdmin()) { ?>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail3">Màxim d'immobles:</label>
                      <input name="max_immobles" min="1" min="500" type="number" class="form-control" id="exampleInputEmail3" placeholder="Màxim d'immobles" value="<?php echo $data['max_immobles']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail3">Màxim fotos:</label>
                      <input name="max_fotos" min="1" max="10" type="number" class="form-control" id="exampleInputEmail3" placeholder="Màxim de fotos" value="<?php echo $data['max_fotos']; ?>">
                    </div>

                    <?php if($data['id'] != $_SESSION['usuari_id']) { ?>
                      <div class="form-group col-md-4">
                        <label for="exampleInputName1">Activat?:</label>
                        <select name="activat" class="form-control" id="exampleSelectGender">
                          <option value="1" <?php echo ($data['activat']) === '1' ? 'selected' : ''; ?>>Si</option>
                          <option value="0" <?php echo ($data['activat']) === '0' ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    <?php } else if( isLoggedInAndAdmin() ) { ?>
                      <div class="form-group col-md-4" style="visibility: hidden">
                        <label for="exampleInputName1">Activat?:</label>
                        <select name="activat" class="form-control" id="exampleSelectGender">
                          <option value="1" <?php echo ($data['activat']) === '1' ? 'selected' : ''; ?>>Si</option>
                          <option value="0" <?php echo ($data['activat']) === '0' ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>

                <div class="row grid-margin">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 style="color:red">Pujar imatges en format: jpg, png o gifas</h4>
                          <br>
                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar logo</label>
                                <input name="foto1file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="logo" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Logo" value="<?php echo $data['logo'];?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar logo</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img1" value="1">
                                  Eliminar logo?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['logo']) && file_exists('../../admin-web/public/images/img-xarxa/usuari/'.$data['logo'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $data['logo'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                <button type="submit" name="funcioBoto" class="btn btn-primary mr-2" value="Guardar">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/backend/footer_edit_add.php'; ?>