<!-- META TAGS -->
<?php define('TITLE', 'Immobiliàries en xarxa'); ?>
<?php define('DESCRIPTION', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non accumsan mi. Quisque sed nunc nec risus vestibulum porta. Praesent venenatis dignissim sem id commodo."'); ?>
<?php define('KEYWORDS', '"Immobiliàries en xarxa"'); ?> 
<!-- -->
<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
    <!-- Portada -->
	<section class="home-three bg-img3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="home3_home_content text-center">
						<h1><?php echo TITLE_SLIDE; ?></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 d-flex justify-content-center">
					<div class="home_adv_srch_opt home3">
						<!-- <ul class="nav nav-pills" id="pills-tab" role="tablist" style="visibility: hidden">
							<li class="nav-item">
								Compra
							</li>
							<li class="nav-item">
								Lloguer
							</li>
						</ul> -->
						<div class="tab-content home1_adsrchfrm" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

								<form method="post" action="<?php echo URLROOT; ?>/immobles/cercar" >
									<div class="home1-advnc-search home3">
										<ul class="h1ads_1st_list mb0">
											<li class="list-inline-item">
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="operacio" class="buscador" id="operacio" style="width: 190px">
															<?php foreach($data['operacions'] as $operacio) : ?>
																<option value="<?php echo $operacio->id; ?>" <?php echo (2) == $operacio->id ? 'selected' : ''; ?> ><?php echo $operacio->$nom; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="categoria" class="buscador" id="categoria" style="width: 190px">
															<?php foreach($data['categories'] as $categoria) : ?>
																<option value="<?php echo $categoria->id; ?>" <?php echo (1) == $categoria->id ? 'selected' : ''; ?> ><?php echo $categoria->$nom; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="provincia" class="buscador" id="provincia">
															<?php foreach($data['provincies'] as $provincia) : ?>
																<option value="<?php echo $provincia->id; ?>" <?php echo (8) == $provincia->id ? 'selected' : ''; ?> ><?php echo $provincia->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="poblacio" class="buscador" id="poblacio">
															<?php foreach($data['poblacions'] as $poblacio) : ?>
																<option value="<?php echo $poblacio->id; ?>" <?php echo (881) == $poblacio->id ? 'selected' : ''; ?> ><?php echo $poblacio->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="search_option_button">
													<button type="submit" class="btn btn-thm3"><?php echo CERCAR; ?></button>
												</div>
											</li>
										</ul>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Destacats -->
	<section id="feature-property" class="feature-property mt80 pb50">
		<div class="container-fluid ovh">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title mb40">
						<h2><span class="flaticon-house-1"></span> <?php echo DESTACATS; ?></h2>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="feature_property_home3_slider">
						<?php foreach($data['immoblesPortada'] as $portada) : ?>
							<div onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>'" class="item">
								<div class="feat_property home3">
									<div class="thumb">
										<?php if( !empty($portada->imatge_1) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$portada->imatge_1 ) ){ ?>
											<img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $portada->imatge_1 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $portada->titol_cat ?>">
										<?php } else { ?>
											<img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $portada->titol_cat ?>">
										<?php } ?>
										<div class="thmb_cntnt">
											<ul class="tag mb0">
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>'"><?php echo $portada->$operacioImmoble ?></a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>'"><?php echo $portada->$categoriaImmoble ?></a></li>
											</ul>
											<a class="fp_price" href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>">
												<script>
													correctPrice(<?php echo $portada->preu ?>);
												</script>
											</a>
										</div>
									</div>
									<div class="details">
										<div class="tc_content">
											<h4><script>document.write(tallarText("<?php echo $portada->$titolImmoble ?>", 50))</script></h4>
											<p><span class="flaticon-placeholder"></span> <?php echo $portada->poblacio ?>, <?php echo $portada->provincia ?></p>
											<ul class="prop_details mb0">
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>"><?php echo ($portada->habitacio) == 0 ? " -" : $portada->habitacio ?> habitacions</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>"><?php echo ($portada->banys) == 0 ? " -" : $portada->banys ?> banys</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>"><?php echo ($portada->tamany) == 0 ? " -" : $portada->tamany ?> m²</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Uneix-te -->
	<section id="property-search" class="property-search bg-img4">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-6">
					<div class="modern_apertment">
						<h2 class="title"><?php echo UNEIX_TE_TITLE_1; ?></h2>
						<p><?php echo UNEIX_TE_TITLE_2; ?></p>
						<a class="btn booking_btn btn-thm" href="<?php echo URLROOT; ?>/immobles/unirme"><?php echo UNEIX_TE_BOTO; ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Agents -->
	<section id="our-agents" class="our-agents pt40 pb30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title">
						<h2><span class="flaticon-user-1"></span> <?php echo AGENTS_TITLE_1; ?></h2>
						<p><?php echo AGENTS_TITLE_2; ?> <a class="float-right" href="<?php echo URLROOT; ?>/immobiliaries/llista"><?php echo VEURE_AGENTS; ?> <span class="flaticon-next"></span></a></p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php foreach($data['usuarisPortada'] as $usuari) : ?>
					<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
						<div class="our_agent" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>'">
							<div class="thumb text-center">
								<?php if( !empty($usuari->logo) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$usuari->logo ) ){ ?>
									<img style="max-width: none;" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $usuari->logo ?>&size=240x300&crop=0&trim=0" alt="<?php echo $usuari->empresa ?>">
								<?php } else { ?>
									<img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=240x300&crop=0&trim=0" alt="<?php echo $usuari->empresa ?>">
								<?php } ?>
								<div class="overylay">
									<ul class="social_icon">
										<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><span class="flaticon-magnifying-glass"></span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php require APPROOT . '/views/inc/frontend/footer_portada.php'; ?>