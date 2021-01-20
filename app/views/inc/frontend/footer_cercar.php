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

	// START PREUS OPTION

	function carregarPreus(preuMaxMin, inicial, final, increment) {
		let preu = ["<?php echo INDIFERENT_FILTRE; ?>"];
		for (i = inicial; i <= final; i = i + increment) {
			if( inicial == 50000 && i == 1000000 ) {
				increment = 1000000;
			}
			if( inicial == 400 && i == 1000 ) {
				increment = 100;
			}
			preu.push(i);
		}
		addOptionsPreus(preuMaxMin, preu);
	}

	function addOptionsPreus( valueSelector , array) {
		let selector = document.getElementById(valueSelector);
		removeOptions(selector);

		// Empty option
		inicialOption(selector);

		for (valor in array) {
			let option = document.createElement("option");
			option.value = array[valor] === "<?php echo INDIFERENT_FILTRE; ?>" ? "Indiferent" : array[valor];
			option.text = array[valor] === "<?php echo INDIFERENT_FILTRE; ?>" ? "<?php echo INDIFERENT_FILTRE; ?>" : array[valor].toLocaleString('es-ES') + " €";
			selector.add(option);
		}
	}

	function inicialOption(selector) {
		let emptyOption = document.createElement("option");
		emptyOption.value = "";
		emptyOption.text = "";
		selector.add(emptyOption);
	}

	function removeOptions(selectElement) {
		var i, L = selectElement.options.length - 1;

		for(i = L; i >= 0; i--) {
			selectElement.remove(i);
		}
	}

	// END PREUS OPTION

	// START SUPERFICIES OPTION

	function carregarSuperficies(superficieMaxMin) {
		var superficie = ["<?php echo INDIFERENT_FILTRE; ?>"];
		var increment = 20;
		for (i = 40; i <= 600; i = i + increment) {
			if( i == 200 ) {
				increment = 100;
			}
			superficie.push(i);
		}
		addOptionsSuperficies(superficieMaxMin, superficie);
	}

	function addOptionsSuperficies( valueSelector , array) {
		var selector = document.getElementById(valueSelector);
		for (valor in array) {
			var option = document.createElement("option");
			option.value = array[valor] === "<?php echo INDIFERENT_FILTRE; ?>" ? "Indiferent" : array[valor];
			option.text = array[valor] === "<?php echo INDIFERENT_FILTRE; ?>" ? "<?php echo INDIFERENT_FILTRE; ?>" : array[valor]+" m²";
			selector.add(option);
		}
	}
	
	// END SUPERFICIES OPTION

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

	$("#operacio").change(function() {
		// Obtenim id de la provincia
		var operacio = jQuery("select#operacio option:selected").text();

		if (operacio === "<?php echo LLOGUER_FILTRE; ?>") {
			carregarPreus("preu_minim", 400, 3000, 50);
			carregarPreus("preu_maxim", 400, 3000, 50);
		} else {
			carregarPreus("preu_minim", 50000, 4000000, 50000);
			carregarPreus("preu_maxim", 50000, 4000000, 50000);
		}

	});

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
			placeholder: "<?php echo PREU_MINIM_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.preu_maxim").select2({
			placeholder: "<?php echo PREU_MAXIM_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.habitacions").select2({
			placeholder: "<?php echo HABITACIONS_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.banys").select2({
			placeholder: "<?php echo BANYS_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.superficies_minim").select2({
			placeholder: "<?php echo SUPERFICIE_MINIMA_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.superficies_maxim").select2({
			placeholder: "<?php echo SUPERFICIE_MAXIMA_FILTRE; ?>",
			allowClear: true
		});
		$(".buscador.certificat").select2({
			placeholder: "<?php echo CERTIFICAT_ENERGETIC_FILTRE; ?>",
			allowClear: true
		});

		carregarPreus("preu_minim", 50000, 4000000, 50000);
		carregarPreus("preu_maxim", 50000, 4000000, 50000);

		carregarSuperficies("superficies_minim");
		carregarSuperficies("superficies_maxim");

	});

</script>

</body>
</html>