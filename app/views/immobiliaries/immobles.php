<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
	<!-- Listing Grid View -->
	<section class="our-listing pb30-991">
		<div class="container">
            <!-- filtrar -->
            <?php require APPROOT . '/views/inc/frontend/filtrar.php'; ?>
            <!-- -->
			<div class="row">
				<div class="col-md-8 col-lg-6">
					<div class="breadcrumb_content style2">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page">Immobles</li>
						</ol>
						<h3 class="breadcrumb_title"><?php echo isset($data['empresaCercada']) ? " ". $data['empresaCercada'] : '' ?></h3>
						<p><?php echo isset($data['descripcioEmpresa']) ? '<script>document.write(tallarText("'.$data['descripcioEmpresa'].'", 800))</script>' : '' ?></p>
						<p><?php echo isset($data['telefonEmpresa']) ? '<span class="fa fa-phone"></span> '.$data['telefonEmpresa'] : '' ?></p>
						<p><?php echo isset($data['emailEmpresa']) ? '<span class="fa fa-envelope"></span> '.$data['emailEmpresa'] : '' ?></p>
					</div>
				</div>
				<div class="col-md-4 col-lg-6">
					<div class="sidebar_switch text-right">
						<div id="main2">
							<span id="open2" class="flaticon-filter-results-button filter_open_btn">FILTRAR</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="grid_list_search_result style2">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="left_area">
									<p><?php echo ($data['immoblesTotal'] == 0) ? "<h5>No s'ha trobat cap resultat</h5>" : '<h5>'.$data['immoblesTotal']. ' resultat/s </h5>'  ?> </p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <!-- Cerca -->
                        <?php require APPROOT . '/views/inc/frontend/cerca.php'; ?>
						<!-- -->
						<!-- Paginació -->
                        <?php require APPROOT . '/views/inc/frontend/paginacio_immobiliaries_immobles.php'; ?>
						<!-- -->
					</div>
				</div>
			</div>
		</div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer_cercar.php'; ?>