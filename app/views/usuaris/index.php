<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php flash('usuari_message'); ?>
          <br>
          <h2>Usuaris</h2>
          <br>
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-info mb-3" onclick="location.href='<?php echo URLROOT; ?>/usuaris/add'">+ Inserir</button>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                        <th>Nom i cognoms</th>
                        <th>Empresa</th>
                        <?php if(isLoggedInAndAdmin()) { ?>
                          <th>Email</th>
                          <th data-orderable="false">Estat</th>
                        <?php } ?>
                        <th data-orderable="false">Editar</th>
                        <?php if(isLoggedInAndAdmin()) { ?>
                          <th data-orderable="false">Eliminar</th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['usuaris'] as $usuari) : ?>
                    <tr>
                      <td><a href="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $usuari->id; ?>" style="color: black;"><?php echo $usuari->nom_cognoms; ?></a></td>
                      <td><a href="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $usuari->id; ?>" style="color: black;"><?php echo $usuari->empresa; ?></a></td>
                      <?php if(isLoggedInAndAdmin()) { ?>
                        <td><a href="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $usuari->id; ?>" style="color: black;"><?php echo $usuari->email; ?></a></td>
                        <td>
                          <a href="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $usuari->id; ?>" style="color: black;">
                            <?php if($usuari->activat == 1) { ?>
                              <i class="mdi mdi-check"></i>
                            <?php } else { ?>
                              <i class="mdi mdi-close"></i>
                            <?php } ?>
                          </a>
                        </td>
                      <?php } ?>
                      <td><a href="<?php echo URLROOT; ?>/usuaris/edit/<?php echo $usuari->id; ?>" style="color: black;"><i class="mdi mdi-pencil menu-icon"></i></a></td>
                      <?php if( $usuari->id == $_SESSION['usuari_id'] ) { ?>
                        <?php if(isLoggedInAndAdmin()) { ?>
                          <td></td>
                        <?php } ?>
                      <?php } else { ?>
                        <td><a href="" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $usuari->id ?>"><i class="mdi mdi-close-circle menu-icon"></i></a></td>
                      <?php } ?>
                    </tr>
                    <div class="modal fade" id="exampleModalCenter<?php echo $usuari->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Segur que vols esborrar: <?php echo $usuari->nom_cognoms; ?>
                          </div>
                          <div class="modal-footer">
                            <form class="pull-right" action="<?php echo URLROOT; ?>/usuaris/delete/<?php echo $usuari->id ?>" method="post">
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
<?php require APPROOT . '/views/inc/footer_table.php'; ?>