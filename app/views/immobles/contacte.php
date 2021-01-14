<?php require APPROOT . '/views/inc/frontend/header.php'; ?>

    <section class="our-contact pb0">
		<div class="container">
            <div class="row">
				<div class="col-md-8 col-lg-6">
					<div class="breadcrumb_content style2">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
							<li class="breadcrumb-item active text-thm" aria-current="page">Contacte</li>
						</ol>
						<h3 class="breadcrumb_title"> Contacte amb nosaltres </h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
						<h4 class="mb5">Formulari</h4>
                        <form class="contact_form" id="contact_form" name="contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_name" name="form_name" class="form-control" required="required" type="text" placeholder="Nom i cognoms *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_email" name="form_email" class="form-control required email" required="required" type="email" placeholder="Correu electrònic *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_phone" name="form_phone" class="form-control required phone" required="required" type="phone" placeholder="Telèfon *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="form_subject" name="form_subject" class="form-control required" type="text" placeholder="Població">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea id="form_message" name="form_message" class="form-control required" rows="8" required="required" placeholder="Comentari *"></textarea>
                                    </div>
                                    <div class="form-group mb0">
                                        <button type="button" class="btn btn-lg btn-thm">Enviar missatge</button>
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
							<p>699 475 902</p>
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