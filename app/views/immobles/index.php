<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
    <!-- Home Design -->
	<section class="home-three bg-img3">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="home3_home_content">
						<h1>La vostra propietat, la nostra prioritat</h1>
						<h4>Des de tan sols 40€ mensuals amb descomptes d’oferta en temps limitat</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 d-flex justify-content-center">
					<div class="home_adv_srch_opt home3">
						<ul class="nav nav-pills" id="pills-tab" role="tablist" style="visibility: hidden">
							<li class="nav-item">
								Compra
							</li>
							<li class="nav-item">
								Lloguer
							</li>
						</ul>
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
																<option value="<?php echo $operacio->id; ?>" <?php echo (2) == $operacio->id ? 'selected' : ''; ?> ><?php echo $operacio->nom_cat; ?></option>
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
																<option value="<?php echo $categoria->id; ?>" <?php echo (1) == $categoria->id ? 'selected' : ''; ?> ><?php echo $categoria->nom_cat; ?></option>
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
													<button type="submit" class="btn btn-thm3">CERCAR</button>
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

	<!-- Feature Properties -->
	<section id="feature-property" class="feature-property mt80 pb50">
		<div class="container-fluid ovh">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title mb40">
						<h2>Propietats destacades</h2>
						<p>Propietats escollides pel nostre equip<a class="float-right" href="#">Veure tot <span class="flaticon-next"></span></a></p>
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
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>'"><?php echo $portada->operacio_cat ?></a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $portada->id ?>'"><?php echo $portada->categoria_cat ?></a></li>
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
											<h4><?php echo $portada->titol_cat ?></h4>
											<p><span class="flaticon-placeholder"></span><?php echo $portada->poblacio ?>, <?php echo $portada->provincia ?></p>
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

	<!-- Property Cities -->
	

	<!-- Property Search -->
	<section id="property-search" class="property-search bg-img4">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="search_smart_property text-center">
						<h2>UNIR-ME A XARXES IMMOBILIARIES</h2>
						<p>Si vols créixer més i estàs buscant un model de negoci que et permeti fer-ho.</p>
						<button class="btn ssp_btn">UNIR-ME</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Property Cities -->
	

	<!-- Our Agents -->
	<section id="our-agents" class="our-agents pt40 pb30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-title">
						<h2>Els nostres agents</h2>
						<p>Col·laboració exclusiva per a agències afiliades<a class="float-right" href="#"></a></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/5.jpg" alt="5.jpg">
							
						</div>
						
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/4.jpg" alt="6.jpg">
							
						</div>
						
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/7.jpg" alt="7.jpg">
							
						</div>
						<div class="details">
							<h4></h4>
							<p> </p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/8.jpg" alt="8.jpg">
							
						</div>
						<div class="details">
							<h4></h4>
							<p> </p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/9.jpg" alt="9.jpg">
							
						</div>
						<div class="details">
							<h4></h4>
							<p> </p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
					<div class="our_agent">
						<div class="thumb">
							<img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/team/10.jpg" alt="10.jpg">
							
						</div>
						<div class="details">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php require APPROOT . '/views/inc/frontend/footer_portada.php'; ?>