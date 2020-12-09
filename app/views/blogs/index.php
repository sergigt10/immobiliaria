<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <?php flash('post_message'); ?>
              <br>
              <h2>Blog</h2>
              <br>
              <input class="form-control" id="myInput" type="text" placeholder="Buscar blog.." aria-label="Search">
              <br>
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                  <thead>
                    <tr style="background: black; color: white;">
                      <th scope="col">Titol</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Editar</th>
                      <th scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php foreach($data['blogs'] as $blog) : ?>
                      <tr>
                        <td><a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $blog->id_blog; ?>" style="color: black;"><b>&nbsp;<?php echo $blog->titol_cat; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $blog->id_blog; ?>" style="color: black;"><b>&nbsp;<?php echo $blog->id_tag; ?></b></a></td>
                        <td><a href="<?php echo URLROOT; ?>/blogs/edit/<?php echo $blog->id_blog; ?>" style="color: black;"><i class="mdi mdi-pencil menu-icon"></i></a></td>
                        <td><a href="" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $blog->id_blog ?>"><i class="mdi mdi-close-circle menu-icon"></i></a></td>
                      </tr>
                      <div class="modal fade" id="exampleModalCenter<?php echo $blog->id_blog?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Segur que vols esborrar: <?php echo $blog->titol_cat; ?>
                            </div>
                            <div class="modal-footer">
                              <form class="pull-right" action="<?php echo URLROOT; ?>/blogs/delete/<?php echo $blog->id_blog ?>" method="post">
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