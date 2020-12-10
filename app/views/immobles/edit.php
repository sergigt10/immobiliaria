<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Modificar immoble</h2>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/blogs/edit/<?php echo $data['id_blog']; ?>" enctype="multipart/form-data">

                <?php echo (!empty($data['titol_cat_err'])) ? '<div class="alert alert-danger" role="alert">* Falta omplir el títol</div>' : ''; ?>
                <?php echo (!empty($data['descripcio_cat_err'])) ? '<div class="alert alert-danger" role="alert">* Falta omplir la descripció</div>' : ''; ?>

                <div class="form-group">
                  <label for="exampleInputEmail3">Títol *:</label>
                  <input name="titol_cat" type="text" class="form-control" id="exampleInputEmail3" placeholder="Títol" value="<?php echo $data['titol_cat']; ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail3">Descripció *:</label>
                  <textarea id="tinyMceExample2" class="editor" name="descripcio_cat"><?php echo $data['descripcio_cat']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Categoria:</label>
                  <select name="id_tag" class="form-control" id="exampleSelectGender">
                    <option value="Blog" <?php echo ($data['id_tag']) === 'Blog' ? 'selected' : ''; ?>>Blog</option>
                    <option value="Destacats" <?php echo ($data['id_tag']) === 'Destacats' ? 'selected' : ''; ?>>Destacats</option>
                  </select>
                </div>

                <div class="row grid-margin">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 style="color:red">Pujar imatges en format: jpg, png o gif</h4>
                          <br>
                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 1</label>
                                <input name="foto1file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge1" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 1" value="<?php echo $data['imatge1'];?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 1</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img1" value="1">
                                  Eliminar imatge 1?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge1']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge1'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img_podologia/thumb_img/thumb.php?src=../<?php echo $data['imatge1'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <!-- <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 2</label>
                                <input name="foto2file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge2" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 2" value="<?php echo $data['imatge2']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 2</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img2" value="1">
                                  Eliminar imatge 2?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge2']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge2'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img_podologia/thumb_img/thumb.php?src=../<?php echo $data['imatge2'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 3</label>
                                <input name="foto3file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge3" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 3" value="<?php echo $data['imatge3']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 3</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img3" value="1">
                                  Eliminar imatge 3?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge3']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge3'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img_podologia/thumb_img/thumb.php?src=../<?php echo $data['imatge3'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 4</label>
                                <input name="foto4file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge4" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 4" value="<?php echo $data['imatge4']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 4</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img4" value="1">
                                  Eliminar imatge 4?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge4']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge4'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img_podologia/thumb_img/thumb.php?src=../<?php echo $data['imatge4'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 5</label>
                                <input name="foto5file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge5" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 5" value="<?php echo $data['imatge5']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 5</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img5" value="1">
                                  Eliminar imatge 5?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge5']) && file_exists('../../admin-web/public/images/img_podologia/'.$data['imatge5'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img_podologia/thumb_img/thumb.php?src=../<?php echo $data['imatge5'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div> -->

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
<?php require APPROOT . '/views/inc/footer_edit_add.php'; ?>