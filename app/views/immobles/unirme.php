<!-- META TAGS title, desc., keyword -->
<?php meta_tags('Immobiliàries en xarxa','"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non accumsan mi. Quisque sed nunc nec risus vestibulum porta. Praesent venenatis dignissim sem id commodo."','"Immobiliàries en xarxa"') ?>
<!-- -->
<?php require APPROOT . '/views/inc/frontend/header.php'; ?>

    <section class="our-contact pb0">
		<div class="container">
            <div class="row">
				<div class="col-md-8 col-lg-6">
					<div class="breadcrumb_content style2">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index"><?php echo BREADCRUMB_1_UNIRME; ?></a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page"><?php echo BREADCRUMB_2_UNIRME; ?></li>
						</ol>
						<h3 class="breadcrumb_title"> <?php echo BREADCRUMB_TITLE_UNIRME; ?> </h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
                        <h4 class="mb5"><?php echo TITLE_1_UNIRME; ?></h4>
                        <p><?php echo SUBTITLE_1_UNIRME; ?><br>
                        <?php echo PARA_1_UNIRME; ?><br>
                        <?php echo PARA_2_UNIRME; ?><br>
                        <?php echo PARA_3_UNIRME; ?><br>
                        <?php echo PARA_4_UNIRME; ?></p>
                        <p><?php echo PARA_5_UNIRME; ?></p>
                        <form class="contact_form" method="post" action="<?php echo URLROOT; ?>/immobles/correu/unirme">
                            <p><?php echo CAMPS_OBLIGATORIS_DETALL; ?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="nom" class="form-control" required="required" type="text" placeholder="<?php echo NOM_COGNOMS_DETALL; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="email" class="form-control" required="required" type="email" placeholder="<?php echo CORREU_DETALL; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="telefon" class="form-control" required="required" type="phone" placeholder="<?php echo TELEFON_DETALL; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="empresa" class="form-control" required="required" type="text" placeholder="<?php echo EMPRESA_UNIRME; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="missatge" class="form-control" rows="8" required="required" placeholder="<?php echo COMENTARI_DETALL; ?>"></textarea>
                                    </div>
                                    <div class="form-group mb0">
                                        <button type="submit" class="btn btn-lg btn-thm"><?php echo ENVIAR_DETALL; ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div class="col-lg-5 col-xl-4">
					<div class="contact_localtion">
						<h4><?php echo CONTACTE_UNIRME; ?></h4>
						<div class="content_list">
							<h5><?php echo DIRECCIO_UNIRME; ?></h5>
							<p>08500 Vic - Barcelona</p>
						</div>
						<div class="content_list">
							<h5><?php echo TELEFON_UNIRME; ?></h5>
							<p>93 883 59 31</p>
						</div>
						<div class="content_list">
							<h5><?php echo EMAIL_UNIRME; ?></h5>
							<p>info@immobiliariesenxarxa.net</p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>