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
									<ul class="sasw_list style2 mb0">
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputName1" placeholder="keyword">
                                                <label for="exampleInputEmail"><span class="flaticon-magnifying-glass"></span></label>
                                            </div>
                                        </li>
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputEmail" placeholder="Location">
                                                <label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
                                            </div>
                                        </li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Status</option>
														<option>Apartment</option>
														<option>Bungalow</option>
														<option>Condo</option>
														<option>House</option>
														<option>Land</option>
														<option>Single Family</option>
													</select>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Property Type</option>
														<option>Apartment</option>
														<option>Bungalow</option>
														<option>Condo</option>
														<option>House</option>
														<option>Land</option>
														<option>Single Family</option>
													</select>
												</div>
											</div>
										</li>
										<li>
											<div class="small_dropdown2">
												<div id="prncgs" class="btn dd_btn">
													<span>Price</span>
													<label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
												</div>
												<div class="dd_content2">
													<div class="pricing_acontent">
														<input type="text" class="amount" placeholder="$52,239"> 
														<input type="text" class="amount2" placeholder="$985,14">
														<div class="slider-range"></div>
													</div>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Bathrooms</option>
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
														<option>6</option>
													</select>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Bedrooms</option>
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
														<option>6</option>
													</select>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Garages</option>
														<option>Yes</option>
														<option>No</option>
														<option>Others</option>
													</select>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Year built</option>
														<option>2013</option>
														<option>2014</option>
														<option>2015</option>
														<option>2016</option>
														<option>2017</option>
														<option>2018</option>
														<option>2019</option>
														<option>2020</option>
													</select>
												</div>
											</div>
										</li>
										<li class="min_area style2 list-inline-item">
											<div class="form-group">
												<input type="text" class="form-control" id="exampleInputName2" placeholder="Min Area">
											</div>
										</li>
										<li class="max_area list-inline-item">
											<div class="form-group">
												<input type="text" class="form-control" id="exampleInputName3" placeholder="Max Area">
											</div>
										</li>
										<li>
											<div id="accordion" class="panel-group">
												<div class="panel">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i> Advanced features</a>
														</h4>
													</div>
													<div id="panelBodyRating" class="panel-collapse collapse">
														<div class="panel-body row">
															<div class="col-lg-12">
																<ul class="ui_kit_checkbox selectable-list float-left fn-400">
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck1">
																			<label class="custom-control-label" for="customCheck1">Air Conditioning</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck4">
																			<label class="custom-control-label" for="customCheck4">Barbeque</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck10">
																			<label class="custom-control-label" for="customCheck10">Gym</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck5">
																			<label class="custom-control-label" for="customCheck5">Microwave</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck6">
																			<label class="custom-control-label" for="customCheck6">TV Cable</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck2">
																			<label class="custom-control-label" for="customCheck2">Lawn</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck11">
																			<label class="custom-control-label" for="customCheck11">Refrigerator</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck3">
																			<label class="custom-control-label" for="customCheck3">Swimming Pool</label>
																		</div>
																	</li>
																</ul>
																<ul class="ui_kit_checkbox selectable-list float-right fn-400">
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck12">
																			<label class="custom-control-label" for="customCheck12">WiFi</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck14">
																			<label class="custom-control-label" for="customCheck14">Sauna</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck7">
																			<label class="custom-control-label" for="customCheck7">Dryer</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck9">
																			<label class="custom-control-label" for="customCheck9">Washer</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck13">
																			<label class="custom-control-label" for="customCheck13">Laundry</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck8">
																			<label class="custom-control-label" for="customCheck8">Outdoor Shower</label>
																		</div>
																	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck15">
																			<label class="custom-control-label" for="customCheck15">Window Coverings</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li>
											<div class="search_option_button">
												<button type="submit" class="btn btn-block btn-thm">Search</button>
											</div>
										</li>
									</ul>
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
						<h2 class="breadcrumb_title">Resultats de la cerca: </h2>
					</div>
				</div>
				<div class="col-md-4 col-lg-6">
					<div class="sidebar_switch text-right">
						<div id="main2">
							<span id="open2" class="flaticon-filter-results-button filter_open_btn">Filtre</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="grid_list_search_result style2">
							<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
								<div class="left_area">
									<p><?php echo sizeof($data['immobles']) ?> resultat/s</p>
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
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>