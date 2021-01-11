<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
    <section class="our-listing pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/immobles/index">Inici</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Detall</li>
                        </ol>
                        <h2 class="breadcrumb_title">Els nostres afiliats</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="grid_list_search_result style2">
                            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                <div class="left_area">
                                    <p><?php echo (sizeof($data['usuaris']) == 0) ? "<h4>No s'ha trobat cap resultat</h4>" : '<h4>'.sizeof($data['usuaris']). ' resultat/s </h4>'  ?> </p>
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
										<img class="img-fluid" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $usuari->logo ?>&size=338x201&crop=0&trim=1" alt="<?php echo $usuari->empresa ?>">
                                        <?php } else { ?>
                                            <img class="fluid" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=338x201&crop=0&trim=1" alt="<?php echo $usuari->empresa ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="details">
                                        <div class="tc_content">
                                            <h4><?php echo $usuari->empresa ?></h4>
                                            <p class="text-thm"><?php echo $usuari->nom_cognoms ?></p>
                                            <ul class="prop_details mb0">
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->direccio ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->poblacio ?> - <?php echo $usuari->codi_postal ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->telefon ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->email ?></a></li>
                                                <li><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $usuari->id?>"><?php echo $usuari->web ?></a></li>
                                            </ul>
                                        </div>
                                        <div class="fp_footer">
                                            <div class="fp_pdate float-right text-thm"> Veure immobles <i class="fa fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-lg-12 mt20">
                            <div class="mbp_pagination">
                                <ul class="page_navigation">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">29</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>