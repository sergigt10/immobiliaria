<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
	<!-- Listing Grid View -->
	<section class="our-listing pb30-991">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="listing_sidebar">
						<div class="sidebar_content_details style3">
							<!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
							<div class="sidebar_listing_list style2 mb0">
								<div class="sidebar_advanced_search_widget">
									<h4 class="mb25">Buscador avançat <a class="filter_closed_btn float-right" href="#"><small>Tancar</small> <span class="flaticon-close"></span></a></h4>
									<form method="post" action="<?php echo URLROOT; ?>/immobles/filtrar">
										<ul class="sasw_list style2 mb0">
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="operacio" id="operacio" class="buscador w100">
															<?php foreach($data['operacions'] as $operacio) : ?>
																<option value="<?php echo $operacio->id; ?>" <?php echo (2) == $operacio->id ? 'selected' : ''; ?> ><?php echo $operacio->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="categoria" id="categoria" class="buscador w100">
															<?php foreach($data['categories'] as $categoria) : ?>
																<option value="<?php echo $categoria->id; ?>" <?php echo (1) == $categoria->id ? 'selected' : ''; ?> ><?php echo $categoria->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="provincia" id="provincia" class="buscador w100">
															<?php foreach($data['provincies'] as $provincia) : ?>
																<option value="<?php echo $provincia->id; ?>" <?php echo (8) == $provincia->id ? 'selected' : ''; ?> ><?php echo $provincia->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="poblacio" id="poblacio" class="buscador w100">
															<?php foreach($data['poblacions'] as $poblacio) : ?>
																<option value="<?php echo $poblacio->id; ?>" <?php echo (881) == $poblacio->id ? 'selected' : ''; ?> ><?php echo $poblacio->nom_cat; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="preu_minim" id="preu_minim" class="buscador preu_minim w100">
															<option></option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="preu_maxim" id="preu_maxim" class="buscador preu_maxim w100">
															<option></option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="habitacions" id="habitacions" class="buscador habitacions w100">
															<option></option>
															<option value="Indiferent">Indiferent</option>
															<option value="1">+ 1</option>
															<option value="2">+ 2</option>
															<option value="3">+ 3</option>
															<option value="4">+ 4</option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="banys" id="banys" class="buscador banys w100">
															<option></option>
															<option value="Indiferent">Indiferent</option>
															<option value="1">+ 1</option>
															<option value="2">+ 2</option>
															<option value="3">+ 3</option>
															<option value="4">+ 4</option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="superficies_minim" id="superficies_minim" class="buscador superficies_minim w100">
															<option></option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_two">
													<div class="candidate_revew_select">
														<select name="superficies_maxim" id="superficies_maxim" class="buscador superficies_maxim w100">
															<option></option>
														</select>
													</div>
												</div>
											</li>
											<li>
												<div id="accordion" class="panel-group">
													<div class="panel">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i>Característiques</a>
															</h4>
														</div>
														<div id="panelBodyRating" class="panel-collapse collapse">
															<div class="panel-body row">
																
																<?php 
																	if( !empty($data['caracteristiques']) ){
																		$numberOfColumns = 2;
																		$bootstrapColWidth = 12 / $numberOfColumns ;
							
																		$arrayChunks = array_chunk( $data['caracteristiques'] , 8);
																		foreach($arrayChunks as $caracteristiques) {
																			echo '<div class="col-sm-12 col-md-6 col-lg-'.$bootstrapColWidth.'">';
																				echo '<ul class="ui_kit_checkbox selectable-list float-left fn-400">';
																					foreach($caracteristiques as $caracteristica) {
																						echo '<div class="custom-control custom-checkbox">
																						<input type="checkbox" class="custom-control-input" id="customCheck'.$caracteristica->id .'" name="caracteristica_id[]" value="'. $caracteristica->id. '">
																						<label style="cursor: pointer;" class="custom-control-label" for="customCheck'. $caracteristica->id. '">'. $caracteristica->nom_cat. '</label>
																					</div>';
																					}
																				echo '</ul>';
																			echo '</div>';
																		}
																	}
																?>

																<!-- <ul class="ui_kit_checkbox selectable-list float-left fn-400">
																	<?php foreach($data['caracteristiques'] as $caracteristica) : ?>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck<?php echo $caracteristica->id; ?>" name="caracteristica_id[]" value="<?php echo $caracteristica->id; ?>">
																			<label class="custom-control-label" for="customCheck<?php echo $caracteristica->id; ?>"><?php echo $caracteristica->nom_cat ?></label>
																		</div>
																	<?php endforeach; ?>
																</ul> -->

															</div>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="search_option_button">
													<button type="submit" class="btn btn-block btn-thm">Cercar</button>
												</div>
											</li>
										</ul>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-lg-6">
					<div class="breadcrumb_content style2">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page">Immobles</li>
						</ol>
						<h3 class="breadcrumb_title"> Resultats de la cerca </h3>
						<h4><?php echo isset($data['operacioCercada']) ? $data['operacioCercada'] : '' ?><?php echo isset($data['categoriaCercada']) ? ", ". $data['categoriaCercada'] : '' ?><?php echo isset($data['poblacioCercada']) ? ", ". $data['poblacioCercada'] : '' ?><?php echo isset($data['empresaCercada']) ? " ". $data['empresaCercada'] : '' ?></h4>
						<?php echo isset($data['descripcioEmpresa']) ? $data['descripcioEmpresa'] : '' ?>
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
									<p><?php echo (sizeof($data['immobles']) == 0) ? "<h5>No s'ha trobat cap resultat</h5>" : '<h5>'.sizeof($data['immobles']). ' resultat/s </h5>'  ?> </p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <?php foreach($data['immobles'] as $immoble) : ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="feat_property home7 style4">
                                    <div class="thumb">
                                        <div class="fp_single_item_slider">

                                            <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                                                <?php if( !empty($immoble->imatge_1) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_1 ) ){ ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_1 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } else { ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } ?>
                                            </div>
                                            <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                                                <?php if( !empty($immoble->imatge_2) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_2 ) ){ ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_2 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } else { ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } ?>
                                            </div>
                                            <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                                                <?php if( !empty($immoble->imatge_3) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_3 ) ){ ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_3 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } else { ?>
                                                    <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->titol_cat ?>">
                                                <?php } ?>
                                            </div>
                                            
                                        </div>
                                        <div class="thmb_cntnt style2" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                                            <ul class="tag mb0">
                                                <li class="list-inline-item"><a href="#"><?php echo $immoble->operacio_cat ?></a></li>
                                                <li class="list-inline-item"><a href="#"><?php echo $immoble->categoria_cat ?></a></li>
                                            </ul>
                                        </div>
                                        <div class="thmb_cntnt style3">
                                            <a class="fp_price" href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>">
                                                <script>
													correctPrice(<?php echo $immoble->preu ?>);
												</script>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="tc_content" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                                            <h4><?php echo $immoble->titol_cat ?></h4>
                                            <p><span class="flaticon-placeholder"></span> <?php echo $immoble->poblacio ?>, <?php echo $immoble->provincia ?></p>
                                            <ul class="prop_details mb0">
                                                <li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->habitacio) == 0 ? " -" : $immoble->habitacio ?> habitacions</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->banys) == 0 ? " -" : $immoble->banys ?> banys</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->tamany) == 0 ? " -" : $immoble->tamany ?> m²</a></li>
                                            </ul>
                                        </div>
                                        <div class="fp_footer">
                                            <ul class="fp_meta float-left mb0">
												<li class="list-inline-item">
													<?php if( !empty($immoble->logo) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$immoble->logo ) ){ ?>
														<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $immoble->logo ?>&size=40x40&crop=0&trim=0" alt="<?php echo $immoble->empresa ?>">
													<?php } else { ?>
														<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=40x40&crop=0&trim=0" alt="<?php echo $immoble->empresa ?>">
													<?php } ?>
												</li>
												<li class="list-inline-item"><a href="#"><?php echo $immoble->empresa ?></a></li>
											</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php endforeach; ?>
						<div class="col-lg-12 mt20">
							<div class="mbp_pagination">
								<ul class="page_navigation">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">29</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                                    </li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer_cercar.php'; ?>