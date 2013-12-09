    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    <?php $utilisateur = user::get($id); ?>

    <?php if(isset($validate)): ?>
        <?php  
        $datas = array(
            'firstname' => $form_utilisateur_prenom,
            'lastname' => $form_utilisateur_nom,
            'email' => $form_utilisateur_mail,
            'rank' => $form_utilisateur_lvl,
            'id' => $id
            );

        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, rank = :rank WHERE id=:id';
        user::update($sql, $datas);

        ?>
        <div class="content">
            <div id="pad-wrapper" class="action-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Modifier un utilisateur</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>L'utilisateur <strong><?=$form_utilisateur_prenom; ?> <?=$form_utilisateur_nom; ?></strong> a bien été modifié.</p>
                        <a href="/utilisateurs/">Retourner à la liste des utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
      <?php else: ?>
        <div class="content">
            <div id="pad-wrapper" class="form-page">
                <div class="row header">
                    <div class="col-md-12">
                        <h3>Modifier un utilisateur</h3>
                    </div>
                </div>

                <form id="form-add-children" method="post" parsley-validate>
                 <!--  <h2>Informations sur l'utilisateur</h2> -->
                 <div class="row form-wrapper">
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-prenom">Prénom</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-prenom" name="form_utilisateur_prenom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le prénom de l'utilisateur." parsley-required="true" value="<?=$utilisateur->firstname; ?>">
                        </div>                            
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-nom">Nom</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-nom" name="form_utilisateur_nom" class="form-control" type="text" data-toggle="tooltip" title="Renseignez le nom de l'utilisateur." parsley-required="true" value="<?=$utilisateur->lastname; ?>">
                        </div>                            
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-identifiant">Identifiant</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-identifiant" name="form_utilisateur_identifiant" class="form-control" type="text" data-toggle="tooltip" title="Renseignez l'identifiant de l'utilisateur." disabled parsley-required="true" value="<?=$utilisateur->identifier; ?>">
                        </div>                            
                    </div>                        
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-password">Mot de passe</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-password" name="form_utilisateur_password" class="form-control" type="password" data-toggle="tooltip" title="Renseignez le mot de passe de l'utilisateur." disabled parsley-required="true"  value="password">
                        </div>                            
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2" for="form-utilisateur-mail">Adresse e-mail</label>
                        <div class="col-md-5">
                            <input id="form-utilisateur-mail" name="form_utilisateur_mail" class="form-control" type="email" data-toggle="tooltip" title="Renseignez l'adresse e-mail de l'utilisateur." parsley-required="true"  value="<?=$utilisateur->email; ?>">
                        </div>                            
                    </div>
                    <div class="field-box row">
                        <label class="col-md-2">Niveau</label>
                        <div class="col-md-5" data-toggle="tooltip" title="Précisez le niveau d'administration de l'utilisateur">
                            <label class="radio" for="form-utilisateur-lvl-1">
                                <div class="radio" id="uniform-form-utilisateur-lvl-1">
                                    <span class="checked">
                                        <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-1" value="1" <?php if($utilisateur->rank == '1') echo 'checked' ?>>
                                    </span>
                                </div>
                                Utilisateur
                            </label>
                            <label class="radio" for="form-utilisateur-lvl-2">
                                <div class="radio" id="uniform-form-utilisateur-lvl-2">
                                    <span>
                                        <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-2" value="3" <?php if($utilisateur->rank == '3') echo 'checked' ?>>
                                    </span>
                                </div>
                                Gestionnaire
                            </label>
                            <label class="radio" for="form-utilisateur-lvl-3">
                                <div class="radio" id="uniform-form-utilisateur-lvl-3">
                                    <span>
                                        <input type="radio" name="form_utilisateur_lvl" id="form-utilisateur-lvl-3" value="5" <?php if($utilisateur->rank == '5') echo 'checked' ?>>
                                    </span>
                                </div>
                                Administrateur
                            </label>
                        </div>                            
                    </div>

                    <input type="submit" class="btn-flat primary" name="validate" value="Valider">
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>