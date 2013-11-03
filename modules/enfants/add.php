    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="form-page">
            <div class="row header">
                <h3>Ajouter un enfant</h3>
            </div>

            <div class="row form-wrapper">
                <!-- left column -->
                <div class="col-md-8 column">

                    <form>
                        <h4>Informations sur l'enfant</h4>
                        <div class="field-box">
                            <label>Prénom :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Nom :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Date de naissance :</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-datepicker" value="01/01/2000">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Sexe de l'enfant :</label>
                            <div class="col-md-7">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""></span></div>
                                    Masculin
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios2"><span><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"></span></div>
                                    Féminin
                                </label>
                            </div>                            
                        </div>

                        <h4>Informations administratives</h4>
                         <div class="field-box">
                            <label>L'enfant est inscrit par :</label>
                            <div class="col-md-7">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios3"><span class="checked"><input type="radio" name="optionsRadios2" id="optionsRadios3" value="option1" checked=""></span></div>
                                    Une structure
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" name="optionsRadios2" id="optionsRadios4" value="option2"></span></div>
                                    Un particulier
                                </label>
                            </div>                            
                        </div>

                    <!-- Si Strucutre coché -->
                        <div class="field-box">
                            <label>Nom de la structure</label>
                            <div class="col-md-7">
                                <div class="ui-select">
                                    <select>
                                        <option selected="">Choisissez une structure</option>
                                        <option>Custom selects</option>
                                        <option>Pure css styles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Nom du contact</label>
                            <div class="col-md-7">
                                <div class="ui-select">
                                    <select>
                                        <option selected="">Choisissez un contact</option>
                                        <option>Custom selects</option>
                                        <option>Pure css styles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <!-- / Si Strucutre coché -->
                    
                    <!-- Si Particulier coché -->
                        <div class="field-box">
                            <label>Responsable légal de l'enfant :</label>
                            <div class="col-md-7">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios3"><span class="checked"><input type="radio" name="optionsRadios3" id="optionsRadios5" value="option1" checked=""></span></div>
                                    Parents
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" name="optionsRadios3" id="optionsRadios6" value="option2"></span></div>
                                    Père
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" name="optionsRadios3" id="optionsRadios7" value="option2"></span></div>
                                    Mère
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" name="optionsRadios3" id="optionsRadios8" value="option2"></span></div>
                                    Tuteur
                                </label>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Nom du père :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Téléphone du père :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Nom de la mère :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Téléphone de la mère :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Nom du tuteur :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Téléphone du tuteur :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Contact d'urgence :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Téléphone d'urgence :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Adresse du responsable légal :</label>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-2"><input class="form-control" type="text" placeholder="N°"></div>
                                    <div class="col-md-10"><input class="form-control" type="text" placeholder="Nom de la voirie"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3"><input class="form-control" type="text" placeholder="Code postal"></div>
                                    <div class="col-md-9"><input class="form-control" type="text" placeholder="Ville"></div>
                                </div>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Domiciliation de l'enfant :</label>
                            <div class="col-md-7">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios3"><span class="checked"><input type="radio" name="optionsRadios4" id="optionsRadios7" value="option1" checked=""></span></div>
                                    Responsable légal
                                </label>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" name="optionsRadios4" id="optionsRadios8" value="option2"></span></div>
                                    Famille d'accueil
                                </label>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Nom de la famille d'accueil :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Téléphone de la famille d'accueil :</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Adresse de la famille d'accueil :</label>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-2"><input class="form-control" type="text" placeholder="N°"></div>
                                    <div class="col-md-10"><input class="form-control" type="text" placeholder="Nom de la voirie"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3"><input class="form-control" type="text" placeholder="Code postal"></div>
                                    <div class="col-md-9"><input class="form-control" type="text" placeholder="Ville"></div>
                                </div>
                            </div>                            
                        </div>
                        
                    <!-- Si Particulier coché -->
                    </form>
                </div>
            </div>

        </div>
    </div><!-- /.container -->

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>