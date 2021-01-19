<!-- META TAGS title, desc., keyword -->
<?php meta_tags('Immobiliàries en xarxa','"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non accumsan mi. Quisque sed nunc nec risus vestibulum porta. Praesent venenatis dignissim sem id commodo."','"Immobiliàries en xarxa"') ?>
<!-- -->
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
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index"><?php echo BREADCRUMB_1_OPERACIONS; ?></a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page"><?php echo BREADCRUMB_2_OPERACIONS; ?></li>
						</ol>
						<h3 class="breadcrumb_title"><?php echo isset($data[$operacioCercada]) ? $data[$operacioCercada] : '' ?></h3>
						<h4><?php echo isset($data[$categoriaCercada]) ? $data[$categoriaCercada] : '' ?></h4>
					</div>
				</div>
				<div class="col-md-4 col-lg-6">
					<div class="sidebar_switch text-right">
						<div id="main2">
							<span id="open2" class="flaticon-filter-results-button filter_open_btn"><?php echo FILTRAR; ?></span>
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
									<p><?php echo ($data['immoblesTotal'] == 0) ? '<h5>'. NO_RESULTATS .'</h5>' : '<h5>'.$data['immoblesTotal'].' '. RESULTATS .'</h5>' ?> </p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <!-- Cerca -->
                        <?php require APPROOT . '/views/inc/frontend/cerca.php'; ?>
						<!-- -->
						<!-- Paginació -->
						<?php require APPROOT . '/views/inc/frontend/paginacio_operacio.php'; ?>
						<!-- -->
					</div>
				</div>
			</div>
		</div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer_cercar.php'; ?>