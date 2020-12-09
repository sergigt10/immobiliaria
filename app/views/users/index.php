<?php require APPROOT . '/views/inc/header.php'; ?>
  <?php
    if(!isLoggedInAndAdmin()){
      $path = '/users/edit/';
    } else {
      $path = '/users/edit_admin/';
    }
  ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <?php flash('post_message'); ?>
              <br>
              <h2>Usuaris</h2>
              <br>
              <input class="form-control" id="myInput" type="text" placeholder="Buscar usuari.." aria-label="Search">
              <br>
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                  <thead>
                    <tr style="background: black; color: white;">
                      <th scope="col">Nom i cognoms</th>
                      <th scope="col">Email</th>
                      <th scope="col">Empresa</th>
                      <th scope="col">Activat</th>
                      <th scope="col">Editar</th>
                      <th scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php foreach($data['users'] as $user) : ?>
                      <tr>
                        <td><a href="<?php echo URLROOT; ?><?php echo $path ?><?php echo $user->id; ?>" style="color: black;"><b>&nbsp;<?php echo $user->nom_cognoms; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?><?php echo $path ?><?php echo $user->id; ?>" style="color: black;"><b>&nbsp;<?php echo $user->email; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?><?php echo $path ?><?php echo $user->id; ?>" style="color: black;"><b>&nbsp;<?php echo $user->empresa; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?><?php echo $path ?><?php echo $user->id; ?>" style="color: black;"><b>&nbsp;<?php echo $user->activat; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?><?php echo $path ?><?php echo $user->id; ?>" style="color: black;"><i class="mdi mdi-pencil menu-icon"></i></a></td>
                        <td><a href="" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $user->id ?>"><i class="mdi mdi-close-circle menu-icon"></i></a></td>
                      </tr>
                      <div class="modal fade" id="exampleModalCenter<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Segur que vols esborrar: <?php echo $user->nom_cognoms; ?>
                            </div>
                            <div class="modal-footer">
                              <form class="pull-right" action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id ?>" method="post">
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
<?php require APPROOT . '/views/inc/footer.php'; ?>