<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php flash('provincia_message'); ?>
          <br>
          <h2>Províncies</h2>
          <br>
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-info mb-3" onclick="location.href='<?php echo URLROOT; ?>/provincies/add'">+ Inserir</button>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                        <th>Nom</th>
                        <th data-orderable="false">Estat</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['provincies'] as $provincia) : ?>
                    <tr>
                        <td><a href="<?php echo URLROOT; ?>/provincies/edit/<?php echo $provincia->id; ?>" style="color: black;"><?php echo $provincia->nom_cat; ?></a></td>
                        <td>
                          <a href="<?php echo URLROOT; ?>/provincies/edit/<?php echo $provincia->id; ?>" style="color: black;">
                            <?php if($provincia->activat == 1) { ?>
                              <i class="mdi mdi-check"></i>
                            <?php } else { ?>
                              <i class="mdi mdi-close"></i>
                            <?php } ?>
                          </a>
                        </td>
                        <td><a href="<?php echo URLROOT; ?>/provincies/edit/<?php echo $provincia->id; ?>" style="color: black;"><i class="mdi mdi-pencil menu-icon"></i></a></td>
                        <td><a href="" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $provincia->id ?>"><i class="mdi mdi-close-circle menu-icon"></i></a></td>
                    </tr>
                    <div class="modal fade" id="exampleModalCenter<?php echo $provincia->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Segur que vols esborrar: <?php echo $provincia->nom_cat; ?>
                          </div>
                          <div class="modal-footer">
                            <form class="pull-right" action="<?php echo URLROOT; ?>/provincies/delete/<?php echo $provincia->id ?>" method="post">
                              <input type="submit" value="Esborrar" class="btn btn-danger">
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·lar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>        
<?php require APPROOT . '/views/inc/backend/footer_table.php'; ?>