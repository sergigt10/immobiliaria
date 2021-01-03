<?php require APPROOT . '/views/inc/backend/header.php'; ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card bg-white">
            <div class="card-body d-flex align-items-center justify-content-between">
              <h4 class="mt-1 mb-1">Hola! <?php echo ucwords($_SESSION['name_surname']) ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/backend/footer.php'; ?>