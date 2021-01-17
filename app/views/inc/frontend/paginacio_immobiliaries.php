<?php if($data['totalPages'] > 1) { ?>
    <!-- http://www.phpeasystep.com/phptu/29.html -->
    
    <div class="col-lg-12 mt20">
        <div class="mbp_pagination">
            <ul class="page_navigation">
                <li class="page-item <?php if($data['page'] <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($data['page'] <= 1){ echo '#'; } else { echo URLROOT. "/immobiliaries/".$data['nomPagina']."/" . $data['prev']; } ?>" tabindex="-1" aria-disabled="true"> <span class="fa fa-chevron-left"></span></a>
                </li>

                <?php 
                if ($data['totalPages'] < 7 + ($data['adjacents'] * 2))	//not enough pages to bother breaking it up
                {	
                    for ($i = 1; $i <= $data['totalPages']; $i++)
                    {
                ?>
                        <li class="page-item <?php if($data['page'] == $i) {echo 'active'; } ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $i; ?>"> <?= $i; ?> </a>
                        </li>
                <?php
                    }
                } elseif($data['totalPages'] > 5 + ($data['adjacents'] * 2)) { //enough pages to hide some
                    //close to beginning; only hide later pages
                    if($data['page'] < 1 + ($data['adjacents'] * 2))		
                    {
                        for ($i = 1; $i < 4 + ($data['adjacents'] * 2); $i++)
                        {
                ?>
                            <li class="page-item <?php if($data['page'] == $i) {echo 'active'; } ?>">
                                <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $i; ?>"> <?= $i; ?> </a>
                            </li>
                <?php 
                        }
                ?>
                        <li class="page-item">
                            ...
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $data['totalPagesMinus1']; ?>"> <?= $data['totalPagesMinus1']; ?> </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $data['totalPages']; ?>"> <?= $data['totalPages']; ?> </a>
                        </li>
                <?php
                    }
                    //in middle; hide some front and some back
                    elseif($data['totalPages'] - ($data['adjacents'] * 2) > $data['page'] && $data['page'] > ($data['adjacents'] * 2))
                    {
                ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/2">2</a>
                        </li>
                <?php 
                        for ($i = $data['page'] - $data['adjacents']; $i <= $data['page'] + $data['adjacents']; $i++)
                        {
                ?>
                            <li class="page-item <?php if($data['page'] == $i) {echo 'active'; } ?>">
                                <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $i; ?>"> <?= $i; ?> </a>
                            </li>
                <?php 
                        }
                ?>
                        <li class="page-item">
                            ...
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $data['totalPagesMinus1']; ?>"> <?= $data['totalPagesMinus1']; ?> </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $data['totalPages']; ?>"> <?= $data['totalPages']; ?> </a>
                        </li>
                <?php 
                    }
                    //close to end; only hide early pages
                    else
                    {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/2">2</a>
                    </li>
                    <li class="page-item">
                        ...
                    </li>
                <?php
                        for ($i = $data['totalPages'] - (2 + ($data['adjacents'] * 2)); $i <= $data['totalPages']; $i++)
                        {
                ?>
                            <li class="page-item <?php if($data['page'] == $i) {echo 'active'; } ?>">
                                <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $i; ?>"> <?= $i; ?> </a>
                            </li>
                <?php
                        }
                    }
                }
                ?>
                
                <!-- <?php for($i = 1; $i <= $data['totalPages']; $i++ ): ?>
                    <li class="page-item <?php if($data['page'] == $i) {echo 'active'; } ?>">
                        <a class="page-link" href="<?php echo URLROOT; ?>/immobiliaries/<?php echo $data['nomPagina'] ?>/<?= $i; ?>"> <?= $i; ?> </a>
                    </li>
                <?php endfor; ?> -->

                <li class="page-item  <?php if($data['page'] >= $data['totalPages']) { echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($data['page'] >= $data['totalPages']){ echo '#'; } else {echo URLROOT. "/immobiliaries/".$data['nomPagina']."/" . $data['next']; } ?>"><span class="fa fa-chevron-right"></span></a>
                </li>
            </ul>
        </div>
    </div>

<?php } else { ?>

    <div class="col-lg-12 mt20" style="visibility: hidden">
        <div class="mbp_pagination">
            <ul class="page_navigation">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Immobiliàries en xarxa</a>
                </li>
            </ul>
        </div>
    </div>

<?php } ?>