<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Afegir un nou immoble</h2>
              <p> * Camps obligatoris </p>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/immobles/add" enctype="multipart/form-data">

                <?php echo (!empty($data['titol_esp_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['titol_esp_err']."</div>" : ' '; ?>
                <?php echo (!empty($data['referencia_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['referencia_err']."</div>" : ' '; ?>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Títol CAT:</label>
                    <input name="titol_cat" type="text" class="form-control" id="exampleInputEmail3" placeholder="Títol CAT" value="<?php echo $data['titol_cat']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Títol ESP *:</label>
                    <input name="titol_esp" type="text" class="form-control" id="exampleInputEmail3" placeholder="Títol ESP" value="<?php echo $data['titol_esp']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Títol ENG:</label>
                    <input name="titol_eng" type="text" class="form-control" id="exampleInputEmail3" placeholder="Títol ENG" value="<?php echo $data['titol_eng']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail3">Referencia *:</label>
                  <input name="referencia" type="text" class="form-control" id="exampleInputEmail3" placeholder="Referencia" value="<?php echo $data['referencia']; ?>">
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

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Preu:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">€</span>
                      </div>
                      <input type="number" name="preu" min="0" class="form-control" placeholder="Preu" aria-label="Preu" aria-describedby="basic-addon1" value="<?php echo $data['preu']; ?>">
                    </div>
                    <h5 style="color:red">No s'ha d'afegir el simbol €. Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Habitacions:</label>
                    <input name="habitacio" min="0" type="number" class="form-control" id="exampleInputEmail3" placeholder="Habitació" value="<?php echo $data['habitacio']; ?>">
                    <br>
                    <h5 style="color:red">Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                  <label for="exampleInputEmail3">Tamany:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">m²</span>
                      </div>
                      <input type="number" name="tamany" min="0" step="any" class="form-control" placeholder="Tamany" aria-label="Tamany" aria-describedby="basic-addon1" value="<?php echo $data['tamany']; ?>">
                    </div>
                    <h5 style="color:red">No s'ha d'afegir el simbol m². Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Banys:</label>
                    <input name="banys" min="0" type="number" class="form-control" id="exampleInputEmail3" placeholder="Banys" value="<?php echo $data['banys']; ?>">
                    <br>
                    <h5 style="color:red">Si el camp no s'omple, per defecte és 0.</h5>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Població:</label>
                    <select name="poblacio_id" class="js-example-basic-single w-100">
                      <?php foreach($data['poblacions'] as $poblacio) : ?>
                        <option value="<?php echo $poblacio->id; ?>"><?php echo $poblacio->poblacio; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Tipus de venda:</label>
                    <select name="tipus_venda" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['categories'] as $categoria) : 
                        if($categoria->nom_cat === "Compra" || $categoria->nom_cat === "Lloguer" || $categoria->nom_cat === "Obra nova") {
                      ?>
                        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nom_cat; ?></option>
                      <?php 
                        }
                        endforeach; 
                      ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Categoria de l'immoble:</label>
                    <select name="categoria_id" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['categories'] as $categoria) : 
                        if($categoria->nom_cat !== "Compra" && $categoria->nom_cat !== "Lloguer" && $categoria->nom_cat !== "Obra nova") {
                      ?>
                        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nom_cat; ?></option>
                      <?php 
                        }
                        endforeach; 
                      ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Eficiencia energètica:</label>
                    <select name="certificat_id" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['certificats'] as $certificat) : ?>
                        <option value="<?php echo $certificat->id; ?>"><?php echo $certificat->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Característiques:</label><br>
                  <?php foreach($data['caracteristiques'] as $caracteristica) : ?>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" name="caracteristica_id[]" value="<?php echo $caracteristica->id; ?>">
                        <?php echo $caracteristica->nom_cat; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>

                <div class="row grid-margin">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 style="color:red">Pujar imatges en format: jpg, png o gif</h4>
                        <br>
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 1</label>
                                <input name="foto1file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge1" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 1" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 1</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 2</label>
                                <input name="foto2file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge2" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 2" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 2</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 3</label>
                                <input name="foto3file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge3" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 3" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 3</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 4</label>
                                <input name="foto4file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge4" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 4" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 4</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 5</label>
                                <input name="foto5file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge5" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 5" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 5</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 6</label>
                                <input name="foto6file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge6" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 6" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 6</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 7</label>
                                <input name="foto7file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge7" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 7" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 7</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 8</label>
                                <input name="foto8file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge8" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 8" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 8</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 9</label>
                                <input name="foto9file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge9" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 9" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 9</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <div class="form-group">
                                <label>Pujar imatge 10</label>
                                <input name="foto10file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge10" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 10" value="">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 10</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                
                <?php if(isLoggedInAndAdmin() && ($data['totalPortada'] <= MAXPORTADA) ) { ?>
                  <div class="form-group">
                    <label for="exampleInputName1">Portada?:</label>
                    <select name="portada" class="form-control" id="exampleSelectGender">
                      <option value="1">Si</option>
                      <option value="0" selected>No</option>
                    </select>
                  </div>
                <?php } ?>
                
                <div class="form-group">
                  <label for="exampleInputName1">Activat?:</label>
                  <select name="activat" class="form-control" id="exampleSelectGender">
                    <option value="1" selected>Si</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <button type="submit" name="funcioBoto" class="btn btn-primary mr-2" value="Guardar">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/footer_edit_add.php'; ?>