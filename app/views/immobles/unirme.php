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
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page">Unir-me</li>
						</ol>
						<h3 class="breadcrumb_title"> Guanya visibilitat </h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
                        <h4 class="mb5">Unir-me a Immobiliàries en xarxa</h4>
                        <p>Creiem que Immobiliàries en xarxa pot ajudar a qualsevol agent a impulsar el seu negoci, especialment:<br>
                        - Si t'agradaria comptar amb una força de vendes molt potent sense necessitat d'ampliar l'estructura de la teva agència.<br>
                        - Si t'agradaria ampliar la difusió dels teus immobles.<br>
                        - Si tens molts potencials compradors i vols ampliar la teva cartera d'immobles per poder atendre les seves necessitats.<br>
                        - Si vols créixer més i estàs buscant un model de negoci que et permeti fer-ho.</p>
                        <p>Deixa'ns les teves dades i ens posarem en contacte per donar-te més informació dels nostres serveis.</p>
                        <form class="contact_form" method="post" action="<?php echo URLROOT; ?>/immobles/correu/unirme" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="nom" class="form-control" required="required" type="text" placeholder="Nom i cognoms *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="email" class="form-control" required="required" type="email" placeholder="Correu electrònic *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="telefon" class="form-control" required="required" type="phone" placeholder="Telèfon *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="empresa" class="form-control" required="required" type="text" placeholder="Empresa *">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="missatge" class="form-control" rows="8" required="required" placeholder="Comentari *"></textarea>
                                    </div>
                                    <div class="form-group mb0">
                                        <button type="submit" class="btn btn-lg btn-thm">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div class="col-lg-5 col-xl-4">
					<div class="contact_localtion">
						<h4>Contacte</h4>
						<div class="content_list">
							<h5>Direcció</h5>
							<p>08500 Vic - Barcelona</p>
						</div>
						<div class="content_list">
							<h5>Telèfon</h5>
							<p>93 883 59 31</p>
						</div>
						<div class="content_list">
							<h5>Correu electrònic</h5>
							<p>info@immobiliariesenxarxa.net</p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>