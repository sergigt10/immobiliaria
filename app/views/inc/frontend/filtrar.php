<div class="row">
    <div class="col-sm-12">
        <div class="listing_sidebar">
            <div class="sidebar_content_details style3">
                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                <div class="sidebar_listing_list style2 mb0">
                    <div class="sidebar_advanced_search_widget">
                        <h4 class="mb25">Buscador avançat <a class="filter_closed_btn float-right" href="#"><small>Tancar</small> <span class="flaticon-close"></span></a></h4>
                        <form method="post" action="<?php echo URLROOT; ?>/immobles/filtrar">
                            <ul class="sasw_list style2 mb0">
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="operacio" id="operacio" class="buscador w100">
                                                <?php foreach($data['operacions'] as $operacio) : ?>
                                                    <option value="<?php echo $operacio->id; ?>" <?php echo (2) == $operacio->id ? 'selected' : ''; ?> ><?php echo $operacio->nom_cat; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="categoria" id="categoria" class="buscador w100">
                                                <?php foreach($data['categories'] as $categoria) : ?>
                                                    <option value="<?php echo $categoria->id; ?>" <?php echo (1) == $categoria->id ? 'selected' : ''; ?> ><?php echo $categoria->nom_cat; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="provincia" id="provincia" class="buscador w100">
                                                <?php foreach($data['provincies'] as $provincia) : ?>
                                                    <option value="<?php echo $provincia->id; ?>" <?php echo (8) == $provincia->id ? 'selected' : ''; ?> ><?php echo $provincia->nom_cat; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="poblacio" id="poblacio" class="buscador w100">
                                                <?php foreach($data['poblacions'] as $poblacio) : ?>
                                                    <option value="<?php echo $poblacio->id; ?>" <?php echo (881) == $poblacio->id ? 'selected' : ''; ?> ><?php echo $poblacio->nom_cat; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="preu_minim" id="preu_minim" class="buscador preu_minim w100">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="preu_maxim" id="preu_maxim" class="buscador preu_maxim w100">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="habitacions" id="habitacions" class="buscador habitacions w100">
                                                <option></option>
                                                <option value="Indiferent">Indiferent</option>
                                                <option value="1">+ 1</option>
                                                <option value="2">+ 2</option>
                                                <option value="3">+ 3</option>
                                                <option value="4">+ 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="banys" id="banys" class="buscador banys w100">
                                                <option></option>
                                                <option value="Indiferent">Indiferent</option>
                                                <option value="1">+ 1</option>
                                                <option value="2">+ 2</option>
                                                <option value="3">+ 3</option>
                                                <option value="4">+ 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="superficies_minim" id="superficies_minim" class="buscador superficies_minim w100">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="superficies_maxim" id="superficies_maxim" class="buscador superficies_maxim w100">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div id="accordion" class="panel-group">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i>Característiques</a>
                                                </h4>
                                            </div>
                                            <div id="panelBodyRating" class="panel-collapse collapse">
                                                <div class="panel-body row">
                                                    
                                                    <?php 
                                                        if( !empty($data['caracteristiques']) ){
                                                            $numberOfColumns = 2;
                                                            $bootstrapColWidth = 12 / $numberOfColumns ;
                
                                                            $arrayChunks = array_chunk( $data['caracteristiques'] , 8);
                                                            foreach($arrayChunks as $caracteristiques) {
                                                                echo '<div class="col-sm-12 col-md-6 col-lg-'.$bootstrapColWidth.'">';
                                                                    echo '<ul class="ui_kit_checkbox selectable-list float-left fn-400">';
                                                                        foreach($caracteristiques as $caracteristica) {
                                                                            echo '<div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck'.$caracteristica->id .'" name="caracteristica_id[]" value="'. $caracteristica->id. '">
                                                                            <label style="cursor: pointer;" class="custom-control-label" for="customCheck'. $caracteristica->id. '">'. $caracteristica->nom_cat. '</label>
                                                                        </div>';
                                                                        }
                                                                    echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_button">
                                        <button type="submit" class="btn btn-block btn-thm">Cercar</button>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>