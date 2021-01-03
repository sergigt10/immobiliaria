<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Modificar categoria</h2>
              <p> * Camps obligatoris </p>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/categories/edit/<?php echo $data['id']; ?>" enctype="multipart/form-data">

                <?php echo (!empty($data['nom_cat_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['nom_cat_err']."</div>" : ' '; ?>
                <?php echo (!empty($data['nom_esp_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['nom_esp_err']."</div>" : ' '; ?>
                <?php echo (!empty($data['nom_eng_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['nom_eng_err']."</div>" : ' '; ?>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Nom de la categoria CAT *:</label>
                    <input name="nom_cat" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom CAT" value="<?php echo $data['nom_cat']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Nom de la categoria ESP *:</label>
                    <input name="nom_esp" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom ESP" value="<?php echo $data['nom_esp']; ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail3">Nom de la categoria ENG *:</label>
                    <input name="nom_eng" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom ENG" value="<?php echo $data['nom_eng']; ?>">
                  </div>
                </div>

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