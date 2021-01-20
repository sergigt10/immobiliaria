    <!-- Footer -->
    <section class="footer_one home3">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4><?php echo FOOTER_1_TITLE_1; ?></h4>
						<p><?php echo FOOTER_1_TITLE_2; ?></p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4><?php echo FOOTER_2_TITLE_1; ?></h4>
						<ul class="list-unstyled">
							<li><a href="<?php echo URLROOT; ?>/immobles/index"><?php echo FOOTER_2_TITLE_2; ?></a></li>
							<li><a href="<?php echo URLROOT; ?>/immobles/nosaltres"><?php echo FOOTER_2_TITLE_3; ?></a></li>
							<li><a href="<?php echo URLROOT; ?>/immobiliaries/llista"><?php echo FOOTER_2_TITLE_4; ?></a></li>
							<li><a href="<?php echo URLROOT; ?>/immobles/unirme"><?php echo FOOTER_2_TITLE_5; ?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4><?php echo FOOTER_3_TITLE_1; ?></h4>
						<ul class="list-unstyled">
							<li><p>08500 Vic - Barcelona</p></li>
							<li><p>93 883 59 31</p></li>
							<li><p>info@immobiliariesenxarxa.net</p></li>
							<li><p>www.immobiliariesenxarxa.net</p></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4><?php echo FOOTER_4_TITLE_1; ?></h4>
						<ul class="mb30">
							<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3 text-center">
						<img class="nav_logo_img img-fluid" src="<?php echo URLROOT; ?>/images/frontend/logo-vertical.jpg" alt="immobiliàries en xarxa">
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer Bottom -->
	<section class="footer_middle_area home3 pt30 pb30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-xl-6">
					<div class="footer_menu_widget home3">
						<ul>
							<li class="list-inline-item"><a href="#"><?php echo FOOTER_6_TITLE_1; ?></a></li>
							<li class="list-inline-item"><a href="#"><?php echo FOOTER_6_TITLE_2; ?></a></li>
							<li class="list-inline-item"><a href="#"><?php echo FOOTER_6_TITLE_3; ?></a></li>
							<li class="list-inline-item"><a href="https://www.webmastervic.com/" target="_blank">Disseny web Webmastervic</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6">
					<div class="copyright-widget home3 text-right">
						<p>© 2021 IMMOBILIÀRIES EN XARXA</p>
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