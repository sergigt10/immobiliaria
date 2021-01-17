    <!-- Our Footer -->
    <section class="footer_one home3">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4>La nostra missió</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac leo ut purus consectetur finibus. Aliquam tincidunt metus consectetur nisi tincidunt, at sollicitudin ante dapibus.</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_qlink_widget home3">
						<h4>Informació</h4>
						<ul class="list-unstyled">
							<li><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
							<li><a href="<?php echo URLROOT; ?>/immobles/nosaltres">Qui som</a></li>
							<li><a href="<?php echo URLROOT; ?>/immobiliaries/llista">Afiliats</a></li>
							<li><a href="<?php echo URLROOT; ?>/immobles/unirme">Uneix-te</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_contact_widget home3">
						<h4>Contacte</h4>
						<ul class="list-unstyled">
							<li><p>08500 Vic - Barcelona</p></li>
							<li><p>699 475 902</p></li>
							<li><p>info@immobiliariesenxarxa.net</p></li>
							<li><p>www.immobiliariesenxarxa.net</p></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_social_widget home3">
						<h4>Segueix-nos</h4>
						<ul class="mb30">
							<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_social_widget home3">
						<h4>Subscriu-te</h4>
						<form class="footer_mailchimp_form home3">
						 	<div class="form-row align-items-center">
                                <div class="col-auto">
                                    <input type="email" class="form-control mb-2" id="inlineFormInput" placeholder="El teu email">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-angle-right"></i></button>
                                </div>
						  	</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Footer Bottom Area -->
	<section class="footer_middle_area home3 pt30 pb30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-xl-6">
					<div class="footer_menu_widget home3">
						<ul>
							<li class="list-inline-item"><a href="#">Avís legal</a></li>
							<li class="list-inline-item"><a href="#">Política de privacitat</a></li>
							<li class="list-inline-item"><a href="#">Política cookies</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6">
					<div class="copyright-widget home3 text-right">
						<p>© 2020 IMMOBILIARIES EN XARXA</p>
					</div>
				</div>
			</div>
		</div>
	</section>
<a class="scrollToHome text-thm3" href="#"><i class="flaticon-arrows"></i></a>
</div>
<!-- Wrapper End -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery-3.3.1.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery-migrate-3.0.0.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/popper.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/ace-responsive-menu.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/isotop.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/snackbar.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/simplebar.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/parallax.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/scrollto.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery.counterup.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/wow.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/slider.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/timepicker.js"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/script.js"></script>

<link href="<?php echo URLROOT; ?>/css/frontend/select2.min.css" rel="stylesheet" />
<script src="<?php echo URLROOT; ?>/js/frontend/select2.min.js"></script>

<!-- AJAX POBLACIONS -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.buscador').select2({
			language: {
				noResults: function() {
					return " ... ";        
				},
				searching: function() {
					return " ... ";
				}
			}
		});
	});
	// Quan seleccionem una provincia
	$("#provincia").change(function() {
		// Obtenim id de la provincia
		var provincia = jQuery("select#provincia option:selected").val();
		// S'envia aquest valor per POST
		var datastring = 'id_provincia='+provincia;

		jQuery.ajax({
			type: 'POST',
			url: '<?php echo URLROOT; ?>/immobles/carregar_poblacions_frontend/',
			dataType: 'json',
			data: datastring,
				success: function(data){
					let arrayPoblacions = "";

					data['poblacions'].forEach(function(poblacio) {
						arrayPoblacions += "<option value="+poblacio['id']+">"+poblacio['nom_cat']+"</option>";
					});

					jQuery('#poblacio').html('');
					jQuery('#poblacio').html(arrayPoblacions);
				},
				error: function() {
					alert('ERROR !');
      			}
		});
	});
</script>

</body>
</html>