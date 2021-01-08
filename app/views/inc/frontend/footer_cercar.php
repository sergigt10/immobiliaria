    <!-- Our Footer -->
    <section class="footer_one home3">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_about_widget home3">
						<h4>La nostra missió</h4>
						<p>Facilitem als i les agents eines de gestió, legals, tecnològiques, administratives i de màrqueting perquè puguin col·laborar amb altres/as agents de la seva zona.</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_qlink_widget home3">
						<h4>Informació</h4>
						<ul class="list-unstyled">
							<li><a href="#">Qui som</a></li>
							<li><a href="#">Afiliats</a></li>
							<li><a href="#">Venda d'immobles</a></li>
							<li><a href="#">Compra d'immobles</a></li>
							<li><a href="#">Uneix-te</a></li>
							<li><a href="#">Contacte</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg col-xl">
					<div class="footer_contact_widget home3">
						<h4>Contacte</h4>
						<ul class="list-unstyled">
							<li><a href="#">08500 Vic - Barcelona</a></li>
							<li><a href="#">699 475 902</a></li>
							<li><a href="#">info@immobiliariesenxarxa.net</a></li>
							<li><a href="#">www.immobiliariesenxarxa.net</a></li>
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
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/snackbar.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/simplebar.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/parallax.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/scrollto.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/jquery.counterup.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/wow.min.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/progressbar.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/slider.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/timepicker.js"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/frontend/script.js"></script>

<link href="<?php echo URLROOT; ?>/css/frontend/select2.min.css" rel="stylesheet" />
<script src="<?php echo URLROOT; ?>/js/frontend/select2.min.js"></script>

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
			},
		});
		$(".buscador.preu_minim").select2({
			placeholder: "Preu mínim",
			allowClear: true
		});
		$(".buscador.preu_maxim").select2({
			placeholder: "Preu màxim",
			allowClear: true
		});
		$(".buscador.habitacio").select2({
			placeholder: "Habitacions",
			allowClear: true
		});
		$(".buscador.banys").select2({
			placeholder: "Banys",
			allowClear: true
		});
		$(".buscador.metres_minim").select2({
			placeholder: "Superficie mínima",
			allowClear: true
		});
		$(".buscador.metres_maxim").select2({
			placeholder: "Superficie màxima",
			allowClear: true
		});
		$(".buscador.certificat").select2({
			placeholder: "Certificat energètic",
			allowClear: true
		});

		// var selector = document.getElementById("preu_minim");
		// var selector = document.getElementById("preu_maxim");
		// https://pandagg.games/javascript/javascript-cargar-valores-de-una-funcion-de-js-a-un-select-en-html/

		function cargarPreus(preuMaxMin) {
			var preu = ["indiferent"];
			for (i = 10000; i <= 4000000; i = i + 10000) {
				preu.push(i);
			}
			addOptionsPrice(preuMaxMin, preu);
		}

		function addOptionsPrice( valueSelector , array) {
			var selector = document.getElementById(valueSelector);
			for (valor in array) {
				var option = document.createElement("option");
				option.value = array[valor]
				option.text = array[valor] === "indiferent" ? "indiferent" : array[valor].toLocaleString('es-ES') + " €";
				selector.add(option);
			}
		}

		cargarPreus("preu_minim");
		cargarPreus("preu_maxim");

		function cargarMetres(metreMaxMin) {
			var metre = ["indiferent"];
			for (i = 50; i <= 600; i = i + 20) {
				metre.push(i);
			}
			addOptionsPrice(metreMaxMin, metre);
		}

		function addOptionsMetre( valueSelector , array) {
			var selector = document.getElementById(valueSelector);
			for (valor in array) {
				var option = document.createElement("option");
				option.value = array[valor]
				option.text = array[valor] === "indiferent" ? "indiferent" : array[valor]+" m";
				selector.add(option);
			}
		}

		addOptionsMetre("metres_minim");
		addOptionsMetre("metres_maxim");

	});
</script>

</body>
</html>