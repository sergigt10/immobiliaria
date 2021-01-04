<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          <?php flash('immoble_message'); ?>
          <br>
          <h2>Immobles</h2>
          <br>
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-info mb-3" onclick="location.href='<?php echo URLROOT; ?>/habitatges/add'">+ Inserir</button>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                        <th>Títol</th>
                        <th>Referencia</th>
                        <th>Categoria</th>
                        <th>Tipus d'operació</th>
                        <th>Població</th>
                        <?php if (isLoggedInAndAdmin()) { ?>
                          <th>Venedor</th>
                          <th data-orderable="false">Portada</th>
                        <?php } ?>
                        <th data-orderable="false">Estat</th>
                        <th data-orderable="false">Editar</th>
                        <th data-orderable="false">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['immobles'] as $immoble) : ?>
                    <tr>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->titol_esp; ?></a></td>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->referencia; ?></a></td>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->categoria; ?></a></td>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->operacio; ?></a></td>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->poblacio; ?></a></td>
                        <?php if (isLoggedInAndAdmin()) { ?>
                          <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><?php echo $immoble->usuari; ?> - <?php echo $immoble->usuariNom; ?></a></td>
                        <?php } ?>
                        <?php if (isLoggedInAndAdmin()) { ?>
                          <td>
                            <a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;">
                              <?php if($immoble->portada == 1) { ?>
                                <i class="mdi mdi-check"></i>
                              <?php } else { ?>
                                <i class="mdi mdi-close"></i>
                              <?php } ?>
                            </a>
                          </td>
                        <?php } ?>
                        <td>
                          <a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;">
                            <?php if($immoble->activat == 1) { ?>
                              <i class="mdi mdi-check"></i>
                            <?php } else { ?>
                              <i class="mdi mdi-close"></i>
                            <?php } ?>
                          </a>
                        </td>
                        <td><a href="<?php echo URLROOT; ?>/habitatges/edit/<?php echo $immoble->id; ?>" style="color: black;"><i class="mdi mdi-pencil menu-icon"></i></a></td>
                        <td><a href="" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $immoble->id ?>"><i class="mdi mdi-close-circle menu-icon"></i></a></td>
                    </tr>
                    <div class="modal fade" id="exampleModalCenter<?php echo $immoble->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Segur que vols esborrar: <?php echo $immoble->titol_esp; ?>
                          </div>
                          <div class="modal-footer">
                            <form class="pull-right" action="<?php echo URLROOT; ?>/habitatges/delete/<?php echo $immoble->id ?>" method="post">
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