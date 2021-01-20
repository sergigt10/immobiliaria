<!-- META TAGS title, desc., keyword -->
<?php meta_tags('Immobiliàries en xarxa','"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non accumsan mi. Quisque sed nunc nec risus vestibulum porta. Praesent venenatis dignissim sem id commodo."','"Immobiliàries en xarxa"') ?>
<!-- -->
<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
    <section class="our-listing pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index"><?php echo BREADCRUMB_1_AFILIATS; ?></a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page"><?php echo BREADCRUMB_2_AFILIATS; ?></li>
                        </ol>
                        <h3 class="breadcrumb_title"><?php echo BREADCRUMB_TITLE_AFILIATS; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="grid_list_search_result style2">
                            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                <div class="left_area">
                                    <p><?php echo ($data['usuarisTotal'] == 0) ? '<h5>'. NO_RESULTATS .'</h5>' : '<h5>'.$data['usuarisTotal'].' '. RESULTATS .'</h5>' ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($data['usuaris'] as $usuari) : ?>
                            <div class="col-md-4 col-lg-4">
                                <div class="feat_property home7 agency" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>'">
                                    <div class="thumb">
                                        <?php if( !empty($usuari->logo) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$usuari->logo ) ){ ?>
                                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $usuari->logo ?>&size=360x230&crop=1&trim=0" alt="<?php echo $usuari->empresa ?>">
                                        <?php } else { ?>
                                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=0" alt="<?php echo $usuari->empresa ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="details">
                                        <div class="tc_content">
                                            <h4><?php echo $usuari->empresa ?></h4>
                                            <p class="text-thm"><?php echo $usuari->nom_cognoms ?></p>
                                            <ul class="prop_details mb0">
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->direccio ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->poblacio ?> - <?php echo $usuari->codi_postal ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>">T: <?php echo $usuari->telefon ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->email ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->web ?></a></li>
                                            </ul>
                                        </div>
                                        <div class="fp_footer">
                                            <div class="fp_pdate float-right text-thm"> <?php echo VEURE_IMMOBLES_AFILIATS; ?> <i class="fa fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- Paginació -->
						<?php require APPROOT . '/views/inc/frontend/paginacio_immobiliaries.php'; ?>
						<!-- -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>