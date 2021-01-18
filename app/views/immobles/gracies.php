<!-- META TAGS title, desc., keyword -->
<?php meta_tags('Immobiliàries en xarxa','"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non accumsan mi. Quisque sed nunc nec risus vestibulum porta. Praesent venenatis dignissim sem id commodo."','"Immobiliàries en xarxa"') ?>
<!-- -->
<?php require APPROOT . '/views/inc/frontend/header.php'; ?>
    <section class="our-error">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="error_page footer_apps_widget">
                        <div class="erro_code"><h2>Missatge enviat correctament!</h2></div>
                        <h5>En breu ens posarem en contacte amb vostè. Gràcies</h5>
                    </div>
                    <a class="btn btn_error btn-thm" href="<?php echo URLROOT; ?>/immobles/index">Inici</a>
                </div>
            </div>
        </div>
    </section>
<?php require APPROOT . '/views/inc/frontend/footer.php'; ?>