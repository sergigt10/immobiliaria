<?php foreach($data['immobles'] as $immoble) : ?>
    <div class="col-md-6 col-lg-4">
        <div class="feat_property home7 style4">
            <div class="thumb">
                <div class="fp_single_item_slider">

                    <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                        <?php if( !empty($immoble->imatge_1) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_1 ) ){ ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_1 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } else { ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } ?>
                    </div>
                    <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                        <?php if( !empty($immoble->imatge_2) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_2 ) ){ ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_2 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } else { ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } ?>
                    </div>
                    <div class="item" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                        <?php if( !empty($immoble->imatge_3) && file_exists( '../../admin-web/public/images/img-xarxa/immoble/'.$immoble->imatge_3 ) ){ ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../<?php echo $immoble->imatge_3 ?>&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } else { ?>
                            <img class="img-whp" src="<?php echo URLROOT; ?>/public/images/img-xarxa/immoble/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=360x230&crop=1&trim=1" alt="<?php echo $immoble->$titolImmoble ?>">
                        <?php } ?>
                    </div>
                    
                </div>
                <div class="thmb_cntnt style2" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                    <ul class="tag mb0">
                        <li class="list-inline-item"><a href="#"><?php echo $immoble->$operacioImmoble ?></a></li>
                        <li class="list-inline-item"><a href="#"><?php echo $immoble->$categoriaImmoble ?></a></li>
                    </ul>
                </div>
                <div class="thmb_cntnt style3">
                    <a class="fp_price" href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>">
                        <script>
                            correctPrice(<?php echo $immoble->preu ?>);
                        </script>
                    </a>
                </div>
            </div>
            <div class="details">
                <div class="tc_content" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>'">
                    <h4><script>document.write(tallarText("<?php echo $immoble->$titolImmoble ?>", 50))</script></h4>
                    <p><span class="flaticon-placeholder"></span> <?php echo $immoble->poblacio ?>, <?php echo $immoble->provincia ?></p>
                    <ul class="prop_details mb0">
                        <li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->habitacio) == 0 ? " -" : $immoble->habitacio ?> <?php echo HABITACIONS; ?></a></li>
                        <li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->banys) == 0 ? " -" : $immoble->banys ?> <?php echo BANYS; ?></a></li>
                        <li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobles/detall/<?php echo $immoble->id_immoble ?>"><?php echo ($immoble->tamany) == 0 ? " -" : $immoble->tamany ?> m²</a></li>
                    </ul>
                </div>
                <div class="fp_footer" onclick="javascript:location.href='<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $immoble->id_usuari?>'">
                    <ul class="fp_meta float-left mb0">
                        <li class="list-inline-item">
                            <?php if( !empty($immoble->logo) && file_exists( '../../admin-web/public/images/img-xarxa/usuari/'.$immoble->logo ) ){ ?>
                                <img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../<?php echo $immoble->logo ?>&size=40x40&crop=0&trim=0" alt="<?php echo $immoble->empresa ?>">
                            <?php } else { ?>
                                <img class="mr-3" src="<?php echo URLROOT; ?>/public/images/img-xarxa/usuari/thumb_img/thumb.php?src=../imatge-no-disponible.jpg&size=40x40&crop=0&trim=0" alt="<?php echo $immoble->empresa ?>">
                            <?php } ?>
                        </li>
                        <li class="list-inline-item"><a href="<?php echo URLROOT; ?>/immobiliaries/immobles/<?php echo $immoble->id_usuari?>"><?php echo $immoble->empresa ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>