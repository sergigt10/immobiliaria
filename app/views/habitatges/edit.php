<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <style>
    select.form-control:not([size]):not([multiple]), select.asColorPicker-input:not([size]):not([multiple]), .dataTables_wrapper select:not([size]):not([multiple]), .jsgrid .jsgrid-table .jsgrid-filter-row select:not([size]):not([multiple]), .select2-container--default select.select2-selection--single:not([size]):not([multiple]), .select2-container--default .select2-selection--single select.select2-search__field:not([size]):not([multiple]), select.typeahead:not([size]):not([multiple]), select.tt-query:not([size]):not([multiple]), select.tt-hint:not([size]):not([multiple]) {
      height: calc(2.65rem + 2px) !important;
    }
  </style>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Modificar immoble</h2>
              <p><b>* Camps obligatoris</b></p>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $data['id'];?>" enctype="multipart/form-data">
                
                <?php echo (!empty($data['titol_cat_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['titol_cat_err']."</div>" : ' '; ?>
                <?php echo (!empty($data['titol_esp_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['titol_esp_err']."</div>" : ' '; ?>
                <!-- <?php echo (!empty($data['titol_eng_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['titol_eng_err']."</div>" : ' '; ?> -->
                <?php echo (!empty($data['referencia_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['referencia_err']."</div>" : ' '; ?>

                <?php echo (!empty($data['pdf_1_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['pdf_1_err']."</div>" : ' '; ?>
                <?php echo (!empty($data['pdf_2_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['pdf_2_err']."</div>" : ' '; ?>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Títol CAT *:</label>
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
                  <label for="exampleInputEmail3">Referència *:</label>
                  <input name="referencia" type="text" class="form-control" id="exampleInputEmail3" placeholder="Número de referència" value="<?php echo $data['referencia']; ?>">
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
                      <input type="number" name="preu" min="0" class="form-control" placeholder="100000" aria-label="Preu" aria-describedby="basic-addon1" value="<?php echo $data['preu']; ?>">
                    </div>
                    <h5 style="color:red"><u>No s'ha d'afegir decimals, tampoc el símbol €.</u> Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Habitacions:</label>
                    <input name="habitacio" min="0" type="number" class="form-control" id="exampleInputEmail3" placeholder="Núm. habitacions" value="<?php echo $data['habitacio']; ?>">
                    <br>
                    <h5 style="color:red">Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Superfície:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">m²</span>
                      </div>
                      <input type="number" name="tamany" min="0" step="any" class="form-control" placeholder="Superfície" aria-label="Tamany" aria-describedby="basic-addon1" value="<?php echo $data['tamany']; ?>">
                    </div>
                    <h5 style="color:red">No s'ha d'afegir el símbol m². Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Banys:</label>
                    <input name="banys" min="0" type="number" class="form-control" id="exampleInputEmail3" placeholder="Núm. banys" value="<?php echo $data['banys']; ?>">
                    <br>
                    <h5 style="color:red">Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                </div>

                <div class="form-row">

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Provincia:</label>
                    <select name="provincia_id" id="provincia" class="js-example-basic-single w-100">
                      <?php foreach($data['provincies'] as $provincia) : ?>
                        <option value="<?php echo $provincia->id; ?>" <?php echo ($data['idProvinciaByPoblacio']) == $provincia->id ? 'selected' : ''; ?> ><?php echo $provincia->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Població:</label>
                    <select name="poblacio_id" id="poblacio" class="js-example-basic-single w-100">
                      <?php foreach($data['poblacions'] as $poblacio) : ?>
                        <option value="<?php echo $poblacio->id; ?>" <?php echo ($data['poblacio_id']) == $poblacio->id ? 'selected' : ''; ?> ><?php echo $poblacio->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Tipus d'operacio:</label>
                    <select name="operacio_id" id="operacio" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['operacions'] as $operacio) : ?>
                        <option value="<?php echo $operacio->id; ?>" <?php echo ($data['operacio_id']) == $operacio->id ? 'selected' : ''; ?> ><?php echo $operacio->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Categoria de l'immoble:</label>
                    <select name="categoria_id" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['categories'] as $categoria) : ?>
                        <option value="<?php echo $categoria->id; ?>" <?php echo ($data['categoria_id']) == $categoria->id ? 'selected' : ''; ?> ><?php echo $categoria->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  
                </div>
                
                <div class="row grid-margin" id="preu-lloguer">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4>Lloguer:</h4>
                        <div class="form-row">

                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Index de lloguer:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">€</span>
                              </div>
                              <input type="number" name="index_lloguer" min="0" class="form-control" placeholder="10" aria-label="index_lloguer" aria-describedby="basic-addon1" value="<?php echo $data['index_lloguer']; ?>">
                            </div>
                            <h5 style="color:red"><u>No s'ha d'afegir decimals, tampoc el símbol €.</u> Si el camp no s'omple, per defecte és 0.</h5>
                          </div>

                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Preu comunitat:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">€</span>
                              </div>
                              <input type="number" name="preu_comunitat" min="0" class="form-control" placeholder="10" aria-label="preu_comunitat" aria-describedby="basic-addon1" value="<?php echo $data['preu_comunitat']; ?>">
                            </div>
                            <h5 style="color:red"><u>No s'ha d'afegir decimals, tampoc el símbol €.</u> Si el camp no s'omple, per defecte és 0.</h5>
                          </div>

                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Preu contribució:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">€</span>
                              </div>
                              <input type="number" name="preu_contribucio" min="0" class="form-control" placeholder="10" aria-label="preu_contribucio" aria-describedby="basic-addon1" value="<?php echo $data['preu_contribucio']; ?>">
                            </div>
                            <h5 style="color:red"><u>No s'ha d'afegir decimals, tampoc el símbol €.</u> Si el camp no s'omple, per defecte és 0.</h5>
                          </div>

                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Preu basura:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">€</span>
                              </div>
                              <input type="number" name="preu_basura" min="0" class="form-control" placeholder="10" aria-label="preu_basura" aria-describedby="basic-addon1" value="<?php echo $data['preu_basura']; ?>">
                            </div>
                            <h5 style="color:red"><u>No s'ha d'afegir decimals, tampoc el símbol €.</u> Si el camp no s'omple, per defecte és 0.</h5>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Escala eficiència consum:</label>
                    <select name="consum_id" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['certificats'] as $certificat) : ?>
                        <option value="<?php echo $certificat->id; ?>" <?php echo ($data['consum_id']) == $certificat->id ? 'selected' : ''; ?> ><?php echo $certificat->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Valor eficiència consum:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">KWh/m² any</span>
                      </div>
                      <input type="number" name="valor_consum" min="0" step="any" class="form-control" placeholder="Valor eficiència consum" aria-label="valor_consum" aria-describedby="basic-addon1" value="<?php echo $data['valor_consum']; ?>">
                    </div>
                    <h5 style="color:red">No s'ha d'afegir el símbol KWh/m² any. Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Escala eficiència emisions:</label>
                    <select name="emisio_id" class="form-control" id="exampleSelectGender">
                      <?php foreach($data['certificats'] as $certificat) : ?>
                        <option value="<?php echo $certificat->id; ?>" <?php echo ($data['emisio_id']) == $certificat->id ? 'selected' : ''; ?> ><?php echo $certificat->nom_cat; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Valor eficiència emisions:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Kg CO₂/m² any</span>
                      </div>
                      <input type="number" name="valor_emisio" min="0" step="any" class="form-control" placeholder="Valor eficiència emisions" aria-label="valor_emisio" aria-describedby="basic-addon1" value="<?php echo $data['valor_emisio']; ?>">
                    </div>
                    <h5 style="color:red">No s'ha d'afegir el símbol CO₂/m² any. Si el camp no s'omple, per defecte és 0.</h5>
                  </div>

                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Característiques:</label><br>
                  <div class="row">
                    <?php
                      $numberOfColumns = 4;
                      $bootstrapColWidth = 12 / $numberOfColumns ;
                      $arrayChunks = array_chunk($data['caracteristiques'], 10);

                      foreach($arrayChunks as $caracteristiques) {
                        echo '<div class="col-sm-12 col-md-12 col-lg-'.$bootstrapColWidth.'">';
                        foreach($caracteristiques as $caracteristica) {
                    ?>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" <?php echo ( !empty(json_decode($data['caracteristica_id'])) && in_array( $caracteristica->id, json_decode($data['caracteristica_id'])) ) ? 'checked' : '' ?> name="caracteristica_id[]" value="<?php echo $caracteristica->id; ?>">
                              <?php echo $caracteristica->nom_cat; ?>
                            </label>
                          </div>
                    <?php
                        }
                        echo '</div>';
                      }
                    ?>
                  </div>
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
                                  <input name="imatge1" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 1" value="<?php echo $data['imatge1']; ?>">
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
                                  <?php if(!empty($data['imatge1']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge1'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge1'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 2</label>
                                <input name="foto2file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge2" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 2" value="<?php echo $data['imatge2']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 2</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img2" value="2">
                                  Eliminar imatge 2?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge2']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge2'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge2'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
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
                                  <input name="imatge3" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 3" value="<?php echo $data['imatge3']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 3</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img3" value="3">
                                  Eliminar imatge 3?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge3']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge3'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge3'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
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
                                  <input name="imatge4" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 4" value="<?php echo $data['imatge4']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 4</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img4" value="4">
                                  Eliminar imatge 4?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge4']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge4'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge4'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
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
                                  <input name="imatge5" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 5" value="<?php echo $data['imatge5']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 5</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img5" value="5">
                                  Eliminar imatge 5?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge5']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge5'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge5'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 6</label>
                                <input name="foto6file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge6" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 6" value="<?php echo $data['imatge6']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 6</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img6" value="6">
                                  Eliminar imatge 6?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge6']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge6'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge6'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 7</label>
                                <input name="foto7file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge7" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 7" value="<?php echo $data['imatge7']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 7</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img7" value="7">
                                  Eliminar imatge 7?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge7']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge7'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge7'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 8</label>
                                <input name="foto8file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge8" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 8" value="<?php echo $data['imatge8']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 8</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img8" value="8">
                                  Eliminar imatge 8?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge8']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge8'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge8'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 9</label>
                                <input name="foto9file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge9" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 9" value="<?php echo $data['imatge9']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 9</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img9" value="9">
                                  Eliminar imatge 9?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge9']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge9'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge9'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="form-group col-md-9">
                              <div class="form-group">
                                <label>Pujar imatge 10</label>
                                <input name="foto10file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="imatge10" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="Imatge 10" value="<?php echo $data['imatge10']; ?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar imatge 10</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="form-check form-check-danger" style="float:right;">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="del_img10" value="10">
                                  Eliminar imatge 10?
                                  <i class="input-helper"></i></label>
                                  <br>
                                  <?php if(!empty($data['imatge10']) && file_exists('../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge10'])){ ?>
                                      <p><img src="../../../admin-web/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge10'] ?>&size=209x92&crop=0&trim=1" class="img-responsive"/></p>
                                  <?php } ?>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row grid-margin">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <h4 style="color:red">Pujar només fitxers en format PDF. Màxim 5 MB per PDF.</h4>
                            <br>
                            <div class="form-row">
                              <div class="form-group col-md-9">
                                <label>Pujar PDF 1</label>
                                <input name="pdf_1_file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="pdf_1" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="PDF 1" value="<?php echo $data['pdf_1']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar PDF 1</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="form-check form-check-danger" style="float:right;">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="del_pdf_1" value="1">
                                    Eliminar pdf 1?
                                    <i class="input-helper"></i></label>
                                </div>
                              </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-md-9">
                                <label>Pujar PDF 2</label>
                                <input name="pdf_2_file" type="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input name="pdf_2" type="text" class="form-control file-upload-info" readonly="readonly" placeholder="PDF 2" value="<?php echo $data['pdf_2']?>">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Pujar PDF 2</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-3">
                                <div class="form-check form-check-danger" style="float:right;">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="del_pdf_2" value="1">
                                    Eliminar pdf 2?
                                    <i class="input-helper"></i></label>
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
                      <option value="1" <?php echo ($data['portada']) === '1' ? 'selected' : ''; ?>>Si</option>
                      <option value="0" <?php echo ($data['portada']) === '0' ? 'selected' : ''; ?>>No</option>
                    </select>
                  </div>
                <?php } ?>
                
                <div class="form-group">
                  <label for="exampleInputName1">Activat?:</label>
                  <select name="activat" class="form-control" id="exampleSelectGender">
                    <option value="1" <?php echo ($data['activat']) === '1' ? 'selected' : ''; ?>>Si</option>
                    <option value="0" <?php echo ($data['activat']) === '0' ? 'selected' : ''; ?>>No</option>
                  </select>
                </div>

                <button type="submit" name="funcioBoto" class="btn btn-primary mr-2" value="Guardar">Guardar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/backend/footer_edit_add.php'; ?>