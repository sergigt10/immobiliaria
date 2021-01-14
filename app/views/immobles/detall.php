<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
	<section class="listing-title-area">
		<div class="container">
			<div class="row mb5">
				<div class="col-lg-7 col-xl-8">
					<div class="single_property_title mt30-767">
						<h2><?php echo $data['titol_cat']; ?></h2>
						<p><span class="flaticon-placeholder"></span> <?php echo $data['poblacio']; ?>, <?php echo $data['provincia']; ?></p>
						<div class="lsd_list">
							<ul class="mb0">
								<li class="list-inline-item"><p style="font-size: 14px"><?php echo $data['operacio_cat']; ?>, <?php echo $data['categoria_cat']; ?></p></li>
							</ul>
						</div>
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
							<?php echo $data['tamany']; ?> m²
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-7 col-lg-8">
					<div class="row">
						<div class="col-lg-12">
							<div class="spls_style_two mb30-520 text-center">
								<!-- img-fluid -->
								<?php if( !empty($data['imatge_1']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_1'] ) ){ ?>
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_1'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_1'] ?>&size=746x450&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								<?php } else { ?>
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/imatge-no-disponible.jpg"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=746x450&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5 col-lg-4">
					<div class="row">
						<?php if( !empty($data['imatge_2']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_2'] ) ){ ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_2'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_2'] ?>&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								</div>
							</div>
						<?php } ?>
						<?php if( !empty($data['imatge_3']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_3'] ) ){ ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_3'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_3'] ?>&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								</div>
							</div>
						<?php } ?>
						<?php if( !empty($data['imatge_4']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_4'] ) ){ ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_4'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_4'] ?>&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								</div>
							</div>
						<?php } ?>
						<?php if( !empty($data['imatge_5']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_5'] ) ){ ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_5'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_5'] ?>&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								</div>
							</div>
						<?php } ?>
						<?php if( !empty($data['imatge_6']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_6'] ) ){ ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_6'] ?>"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $data['imatge_6'] ?>&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>
								</div>
							</div>
						<?php } ?>
						<?php if( !empty($data['imatge_7']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_7']) || !empty($data['imatge_8']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_8']) || !empty($data['imatge_9']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_9']) || !empty($data['imatge_10']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_10']) ) { ?>
							<div class="col-sm-6 col-lg-6">
								<div class="spls_style_two mb30">
									<a href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/imatge-no-disponible.jpg"><img src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=165x130&crop=1&trim=1" alt="<?php echo $data['titol_cat']; ?>"></a>

									<?php 
										$mesfotos = "";
										if( !empty($data['imatge_7']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_7'] ) )
										{ 
											$mesfotos = $data['imatge_7'];
										} elseif( !empty($data['imatge_8']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_8'] )) 
										{
											$mesfotos = $data['imatge_8'];
										} elseif( !empty($data['imatge_9']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_9'] )) 
										{
											$mesfotos = $data['imatge_9'];
										} elseif( !empty($data['imatge_10']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_10'] )) 
										{
											$mesfotos = $data['imatge_10'];
										} 
									?>

									<div class="overlay popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $mesfotos ?>">
										<h3 class="title">+ fotos</h3>

										<?php if( $mesfotos != $data['imatge_7'] && !empty($data['imatge_7']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_7'] ) ){ ?>
											<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_7'] ?>"></a>
										<?php } ?>

										<?php if( $mesfotos != $data['imatge_8'] && !empty($data['imatge_8']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_8'] ) ){ ?>
											<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_8'] ?>"></a>
										<?php } ?>

										<?php if( $mesfotos != $data['imatge_9'] && !empty($data['imatge_9']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_9'] ) ){ ?>
											<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_9'] ?>"></a>
										<?php } ?>

										<?php if( $mesfotos != $data['imatge_10'] && !empty($data['imatge_10']) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$data['imatge_10'] ) ){ ?>
											<a class="popup-img" href="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/<?php echo $data['imatge_10'] ?>"></a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="our-agent-single bgc-f7 pb30-991" style="border-radius: 8px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8">
					<div class="row">
						<div class="col-lg-12">
							<div class="listing_single_description">
								<div class="lsd_list">
									<ul class="mb0">
										<li class="list-inline-item"><a href="#">Referencia: <?php echo $data['referencia']; ?></a></li>
									</ul>
								</div>
								<h4 class="mb30"><b>Descripció</b></h4>
								<p class="mb25">
									<?php echo strip_tags($data['descripcio_cat']) ?>
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
											<li><p><span><?php echo ($data['habitacio']) == 0 ? "-" : $data['habitacio'] ?></span></p></li>
											<li><p><span><?php echo ($data['banys']) == 0 ? "-" : $data['banys'] ?></span></p></li>
											<li><p><span><?php echo ($data['tamany']) == 0 ? "-" : $data['tamany'] ?></span></p></li>
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
										if( ( $data['caracteristica_id']) !== '[""]' && !empty(json_decode($data['caracteristica_id'])) ){
											$numberOfColumns = 3;
											$bootstrapColWidth = 12 / $numberOfColumns ;

											$arrayChunks = array_chunk(json_decode($data['caracteristica_id']), 5);
											foreach($arrayChunks as $caracteristiques) {
												echo '<div class="col-sm-6 col-md-6 col-lg-'.$bootstrapColWidth.'">';
													echo '<ul class="order_list list-inline-item">';
														foreach($caracteristiques as $caracteristica) {
															foreach($data['caracteristiques'] as $all_caracteristiques) {
																if( $caracteristica === $all_caracteristiques->id ){
																	echo '<li><a href="#"><span class="flaticon-tick"></span>'.$all_caracteristiques->nom_cat.'</a></li>';
																}
															}
														}
													echo '</ul>';
												echo '</div>';
											}
										} else {
											echo '<div class="col-sm-6 col-md-6 col-lg-4">';
												echo '<ul class="order_list list-inline-item">';
													echo "<p>No disponible</p>";
												echo '</ul>';
											echo '</div>';
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<h4 class="mt30 mb30"><?php echo (!empty($data['recomendeds'])) ? "També et pot interessar" : "" ?></h4>
						</div>
						<?php foreach($data['recomendeds'] as $recomended) : ?>
							<div class="col-lg-6">
								<div class="feat_property">
									<div class="thumb" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'">
										<?php if( !empty($recomended->imatge_1) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$recomended->imatge_1 ) ){ ?>
											<img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $recomended->imatge_1 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $recomended->titol_cat ?>">
										<?php } else { ?>
											<img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $recomended->titol_cat ?>">
										<?php } ?>
										<div class="thmb_cntnt">
											<ul class="tag mb0">
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'"><?php echo $recomended->operacio_cat ?></a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'"><?php echo $recomended->categoria_cat ?></a></li>
											</ul>
											<a class="fp_price" href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>">
												<script>
													correctPrice(<?php echo $recomended->preu ?>);
												</script>
											</a>
										</div>
									</div>
									<div class="details">
										<div class="tc_content" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'">
											<h4><?php echo $recomended->titol_cat ?></h4>
											<p><span class="flaticon-placeholder"></span><?php echo $recomended->poblacio ?>, <?php echo $recomended->provincia ?></p>
											<ul class="prop_details mb0">
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'"><?php echo ($recomended->habitacio) == 0 ? " -" : $recomended->habitacio ?> habitacions</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'"><?php echo ($recomended->banys) == 0 ? " -" : $recomended->banys ?> banys</a></li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $recomended->id_immoble ?>'"><?php echo ($recomended->tamany) == 0 ? " -" : $recomended->tamany ?> m²</a></li>
											</ul>
										</div>
										<div class="fp_footer" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $recomended->id_usuari?>'">
											<ul class="fp_meta float-left mb0">
												<li class="list-inline-item">
													<?php if( !empty($recomended->logo) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$recomended->logo ) ){ ?>
														<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $recomended->logo ?>&size=40x40&crop=0&trim=0" alt="<?php echo $recomended->empresa ?>">
													<?php } else { ?>
														<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=40x40&crop=0&trim=0" alt="<?php echo $recomended->empresa ?>">
													<?php } ?>
												</li>
												<li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $recomended->id_usuari?>"><?php echo $recomended->empresa ?></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-lg-4 col-xl-4">
					<div class="sidebar_listing_list">
						<div class="sidebar_advanced_search_widget">
							<div class="sl_creator">
								<h4 class="mb25"><b>Contacte</b></h4>
								<div class="media">
									<?php if( !empty($data['logo']) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$data['logo'] ) ){ ?>
										<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $data['logo'] ?>&size=90x90&crop=0&trim=0" alt="<?php echo $data['empresa']; ?>">
									<?php } else { ?>
										<img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=90x90&crop=0&trim=0" alt="<?php echo $data['empresa']; ?>">
									<?php } ?>
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
										<textarea id="form_message" name="form_message" class="form-control required" rows="5" required="required" placeholder="Hola, "></textarea>
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