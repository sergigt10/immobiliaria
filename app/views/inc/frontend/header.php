<!DOCTYPE html>
<html dir="ltr" lang="ca">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/frontend/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/frontend/style.css">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/frontend/responsive.css">
<!-- Title -->
<title>Immobiliàries en xarxa</title>
<!-- Favicon -->
<link href="<?php echo URLROOT; ?>/images/frontend/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo URLROOT; ?>/images/frontend/favicon.ico" sizes="128x128" rel="shortcut icon" />

<script type="text/javascript" src="<?php echo URLROOT; ?>/js/all/helper.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="maxw1600 m0a">
<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one style2 home3 navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid p0">
            <!-- Ace Responsive Menu -->
            <nav>
                <!-- Menu Toggle btn-->
                <div class="menu-toggle">
                    <img class="nav_logo_img img-fluid" src="<?php echo URLROOT; ?>/images/frontend/header-logo.png" alt="header-logo.png">
                    <button type="button" id="menu-btn">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <a href="<?php echo URLROOT; ?>/immobles/index" class="navbar_brand float-left dn-smd">
                    <img class="logo1 img-fluid" src="<?php echo URLROOT; ?>/images/frontend/header-logo2.png" alt="header-logo.png">
                    <img class="logo2 img-fluid" src="<?php echo URLROOT; ?>/images/frontend/header-logo2.png" alt="header-logo2.png">
                    <span></span>
                </a>
                <!-- Responsive Menu Structure-->
                <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
                <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
                    <li>
                        <a href="<?php echo URLROOT; ?>/immobles/index"><span class="title">INICI</span></a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/immobles/nosaltres"><span class="title">QUI SOM</span></a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/immobiliaries/llista"><span class="title">AFILIATS</span></a>
                        <!-- Level Two-->
                    </li>
                    
                    <li>
                        <a href="#"><span class="title">COMPRAR</span></a>
                        <ul>
                            <?php foreach ($data['categories'] as $categoria) : ?>
                                <li><a href="<?php echo URLROOT; ?>/immobles/operacio/2/<?php echo $categoria->id ?>"><?php echo mb_strtoupper($categoria->nom_cat) ?></a></li>
                            <?php endforeach; ?>
                        </ul>           
                    </li>
                    
                    <li>
                        <a href="#"><span class="title">LLOGUER</span></a>
                        <ul>
                            <?php foreach ($data['categories'] as $categoria) : ?>
                                <li><a href="<?php echo URLROOT; ?>/immobles/operacio/3/<?php echo $categoria->id ?>"><?php echo mb_strtoupper($categoria->nom_cat) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><span class="title">OBRA NOVA</span></a>
                        <ul>
                            <?php foreach ($data['categories'] as $categoria) : ?>
                                <li><a href="<?php echo URLROOT; ?>/immobles/operacio/4/<?php echo $categoria->id ?>"><?php echo mb_strtoupper($categoria->nom_cat) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li class="last">
                        <a href="<?php echo URLROOT; ?>/immobles/unirme"><span class="title">UNEIX-TE</span></a>
                    </li>
                    <li class="last">
                        <a href="<?php echo URLROOT; ?>/immobles/contacte"><span class="title">CONTACTE</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
			<div class="header stylehome1">
				<div class="main_logo_home2 text-center">
                    <img class="nav_logo_img img-fluid mt20" src="<?php echo URLROOT; ?>/images/frontend/header-logo2.png" alt="header-logo2.png">  
				</div>
				<ul class="menu_bar_home2">
                    <li class="list-inline-item list_s"><a href="page-register.html"></a></li>
					<li class="list-inline-item"><a href="#menu"><span></span></a></li>
				</ul>
			</div>
		</div><!-- /.mobile-menu -->
		<nav id="menu" class="stylehome1">
			<ul>
                <li>
                    <a href="#"><span class="title">INICI</span></a>
                </li>
                
                <li>
                    <a href="#"><span class="title">QUI SOM</span></a>
                </li>
                <li>
                    <a href="#"><span class="title">AFILIATS</span></a>
                </li>

                <li>
                    <a href="#"><span class="title">VENDA</span></a>
                    <ul>
                        <li><a href="page-blog-v1.html">PISOS</a></li>
                        <li><a href="page-blog-grid.html">CASES</a></li>
                        <li><a href="page-blog-single.html">CHALETS</a></li>
                        <li><a href="page-blog-single.html">LOCALS</a></li>
                        <li><a href="page-blog-single.html">GARATGES</a></li>
                        <li><a href="page-blog-single.html">TARRENYS</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#"><span class="title">COMPRA</span></a>
                    <ul>
                        <li><a href="page-blog-v1.html">PISOS</a></li>
                        <li><a href="page-blog-grid.html">CASES</a></li>
                        <li><a href="page-blog-single.html">CHALETS</a></li>
                        <li><a href="page-blog-single.html">LOCALS</a></li>
                        <li><a href="page-blog-single.html">GARATGES</a></li>
                        <li><a href="page-blog-single.html">TARRENYS</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#"><span class="title">LLOGUER</span></a>
                    <ul>
                        <li><a href="page-blog-v1.html">PISOS</a></li>
                        <li><a href="page-blog-grid.html">CASES</a></li>
                        <li><a href="page-blog-single.html">CHALETS</a></li>
                        <li><a href="page-blog-single.html">LOCALS</a></li>
                        <li><a href="page-blog-single.html">GARATGES</a></li>
                        <li><a href="page-blog-single.html">TARRENYS</a></li>
                    </ul>
                </li>

                <li class="last">
                    <a href="page-contact.html"><span class="title">UNEIX-TE</span></a>
                </li>

                <li class="last">
                    <a href="page-contact.html"><span class="title">CONTACTE</span></a>
                </li>
			</ul>
		</nav>
	</div>