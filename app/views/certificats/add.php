<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Afegir una nou certificat</h2>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/certificats/add" enctype="multipart/form-data">

                <?php echo (!empty($data['nom_cat_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['nom_cat_err']."</div>" : ' '; ?>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail3">Nom del certificat *:</label>
                    <input name="nom_cat" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom" value="<?php echo $data['nom_cat']; ?>">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">Activat?:</label>
                    <select name="activat" class="form-control" id="exampleSelectGender">
                      <option value="1" selected>Si</option>
                      <option value="0">No</option>
                    </select>
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