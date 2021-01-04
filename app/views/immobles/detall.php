<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
	<!-- Listing Single Property -->
	<section class="listing-title-area">
		<div class="container">
			<div class="row mb30">
				<div class="col-lg-7 col-xl-8">
					<div class="single_property_title mt30-767">
						<h2><?php echo $data['titol_cat']; ?></h2>
						<p><?php echo $data['poblacio']; ?></p>
					</div>
				</div>
				<div class="col-lg-5 col-xl-4">
					<div class="single_property_social_share">
						<div class="price float-left fn-400">
							<h2>
								<script>
									correctPrice(<?php echo $data['preu']; ?>);
								</script>
							</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-7 col-lg-8">
					<div class="row">
						<div class="col-lg-12">
							<div class="spls_style_two mb30-520">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/1.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/1.jpg" alt="1.jpg"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5 col-lg-4">
					<div class="row">
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/2.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/2.jpg" alt="2.jpg"></a>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/3.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/3.jpg" alt="3.jpg"></a>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/4.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/4.jpg" alt="4.jpg"></a>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/5.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/5.jpg" alt="5.jpg"></a>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/6.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/6.jpg" alt="6.jpg"></a>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="spls_style_two mb30">
								<a class="popup-img" href="<?php echo URLROOT; ?>/images/frontend/property/7.jpg"><img class="img-fluid w100" src="<?php echo URLROOT; ?>/images/frontend/property/7.jpg" alt="7.jpg"></a>
								<div class="overlay popup-img">
									<h3 class="title">+20</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Agent Single Grid View -->
	<section class="our-agent-single bgc-f7 pb30-991" style="border-radius: 8px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8">
					<div class="row">
						<div class="col-lg-12">
							<div class="listing_single_description">
								<div class="lsd_list">
									<ul class="mb0">
										<li class="list-inline-item"><a href="#"><?php echo $data['operacio_cat']; ?></a></li>
										<li class="list-inline-item"><a href="#">Referencia: <?php echo $data['referencia']; ?></a></li>
									</ul>
								</div>
								<h4 class="mb30"><b>Descripció</b></h4>
								<p class="mb25">
									<?php echo $data['descripcio_cat']; ?>
								</p>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="additional_details">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb15"><b>Informació</b></h4>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-4">
										<ul class="list-inline-item">
											<li><p>Habitacions:</p></li>
											<li><p>Banys:</p></li>
											<li><p>m²:</p></li>
										</ul>
										<ul class="list-inline-item">
											<li><p><span><?php echo $data['habitacio']; ?></span></p></li>
											<li><p><span><?php echo $data['banys']; ?></span></p></li>
											<li><p><span><?php echo $data['tamany']; ?></span></p></li>
										</ul>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-4">
										<ul class="list-inline-item">
											<li><p>Certificat energètic:</p></li>
											<li><p>Referencia:</p></li>
											<li><p>Preu:</p></li>
										</ul>
										<ul class="list-inline-item">
											<li><p><span><?php echo $data['certificat']; ?></span></p></li>
											<li><p><span><?php echo $data['referencia']; ?></span></p></li>
											<li>
												<p>
													<span>
														<script>
															correctPrice(<?php echo $data['preu']; ?>);
														</script>
													</span>
												</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="application_statics mt30">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb10">Característiques</h4>
									</div>
									<?php
										$numberOfColumns = 3;
										$bootstrapColWidth = 12 / $numberOfColumns ;

										$arrayChunks = array_chunk($data['caracteristiques'], 5);
										foreach($arrayChunks as $caracteristiques) {
											echo '<div class="col-sm-6 col-md-6 col-lg-'.$bootstrapColWidth.'">';
												echo '<ul class="order_list list-inline-item">';
													foreach($caracteristiques as $caracteristica) {
														echo ( !empty(json_decode($data['caracteristica_id'])) && in_array( $caracteristica->id, json_decode($data['caracteristica_id'])) ) ? '<li><a href="#"><span class="flaticon-tick"></span>'.$caracteristica->nom_cat.'</a></li>' : '';
													}
												echo '</ul>';
											echo '</div>';
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<h4 class="mt30 mb30">També et pot interessar</h4>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img class="img-whp" src="<?php echo URLROOT; ?>/images/frontend/property/fp1.jpg" alt="fp1.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
											<li class="list-inline-item"><a href="#">Featured</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small>/mo</small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img src="<?php echo URLROOT; ?>/images/frontend/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img class="img-whp" src="<?php echo URLROOT; ?>/images/frontend/property/fp2.jpg" alt="fp2.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small>/mo</small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img src="<?php echo URLROOT; ?>/images/frontend/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img class="img-whp" src="<?php echo URLROOT; ?>/images/frontend/property/fp3.jpg" alt="fp3.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Sale</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small>/mo</small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img src="<?php echo URLROOT; ?>/images/frontend/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img class="img-whp" src="<?php echo URLROOT; ?>/images/frontend/property/fp1.jpg" alt="fp1.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
											<li class="list-inline-item"><a href="#">Featured</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small>/mo</small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img src="<?php echo URLROOT; ?>/images/frontend/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xl-4">
					<div class="sidebar_listing_list">
						<div class="sidebar_advanced_search_widget">
							<div class="sl_creator">
								<h4 class="mb25"><b>Contacte</b></h4>
								<div class="media">
									<img class="mr-3" src="<?php echo URLROOT; ?>/images/frontend/team/lc1.png" alt="lc1.png">
									<div class="media-body">
										<h5 class="mt-0 mb0"><?php echo $data['nom_cognoms']; ?></h5>
										<h5 class="mt-0 mb0"><?php echo $data['empresa']; ?></h5>
										<p class="mt-0 mb0"><?php echo $data['direccio']; ?></p>
										<p class="mt-0 mb0"><?php echo $data['poblacio_usuari']; ?> - <?php echo $data['codi_postal']; ?> </p>
										<p class="mb0"><?php echo $data['telefon']; ?></p>
										<p class="mb0"><?php echo $data['email']; ?></p>
										<p class="mb0"><?php echo $data['web']; ?></p>
								  	</div>
								</div>
							</div>
							<ul class="sasw_list mb0">
								<li class="search_area">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputName1" placeholder="Nom i cognoms *" required>
									</div>
								</li>
								<li class="search_area">
									<div class="form-group">
										<input type="number" class="form-control" id="exampleInputName2" placeholder="Telèfon *" required>
									</div>
								</li>
								<li class="search_area">
									<div class="form-group">
										<input type="email" class="form-control" id="exampleInputEmail" placeholder="Email *" required>
									</div>
								</li>
								<li class="search_area">
									<div class="form-group">
										<textarea id="form_message" name="form_message" class="form-control required" rows="5" required="required" placeholder="Número de referencia: <?php echo $data['referencia']; ?>"></textarea>
									</div>
								</li>
								<li>
									<div class="search_option_button">
										<button type="submit" class="btn btn-block btn-thm">Enviar</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>