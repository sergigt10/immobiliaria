<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2>Afegir una nova població</h2>
              <br>
              <form class="forms-sample" method="post" action="<?php echo URLROOT; ?>/poblacions/add" enctype="multipart/form-data">

                <?php echo (!empty($data['nom_cat_err'])) ? "<div class='alert alert-danger' role='alert'>* ".$data['nom_cat_err']."</div>" : ' '; ?>

                <div class="form-group">
                  <label for="exampleInputEmail3">Nom de la població *:</label>
                  <input name="nom_cat" type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom" value="<?php echo $data['nom_cat']; ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Activat?:</label>
                  <select name="activat" class="form-control" id="exampleSelectGender">
                    <option value="1" selected>Si</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Provincia:</label>
                  <select name="provincia_id" class="form-control" id="exampleSelectGender">
                    <?php foreach($data['provincies'] as $provincia) : ?>
                      <option value="<?php echo $provincia->id; ?>"><?php echo $provincia->nom_cat; ?></option>
                    <?php endforeach; ?>
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