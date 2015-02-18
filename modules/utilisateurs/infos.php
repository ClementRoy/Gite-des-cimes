<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-add'])): ?>

    <?php 
            extract($_POST);
            $datas = array(
                ':identifier' => $form_utilisateur_identifiant,
                ':firstname' => $form_utilisateur_prenom,
                ':lastname' => $form_utilisateur_nom,
                ':password' => md5($form_utilisateur_password),
                ':email' => $form_utilisateur_mail,
                ':rank' => $form_utilisateur_lvl
                );

            $result = user::update($datas, $_GET['id']);

     ?>
        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        L'utilisateur <?=$form_utilisateur_prenom; ?> <?=$form_utilisateur_nom; ?> a bien été ajouté
                    </div>
                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant l'ajout de l'enfant, veuillez réessayer
                    </div>
                </div>
            </div>
        <?php endif; ?>
<?php endif; ?>

<?php if(isset($_POST['submit-update'])): ?>
    <?php  
    extract($_POST);
    $datas = array(
        ':firstname' => $form_utilisateur_prenom,
        ':lastname' => $form_utilisateur_nom,
        ':email' => $form_utilisateur_mail,
        ':rank' => $form_utilisateur_lvl,
    );

    $result = user::update($datas, $_GET['id']);

    ?>
    <?php if($result): ?>

        <div class="row">
            <div class="col-md-12">

                <div class="alert alert-info">
                    <i class="icon-exclamation-sign"></i>
                    L'utilisateur <strong><?=$form_utilisateur_prenom; ?> <?=$form_utilisateur_nom; ?></strong> a bien été modifié.
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>


<?php
    $utilisateur = user::get($_GET['id']);
    $creator = user::get($utilisateur->creator);
    $editor = user::get($utilisateur->editor);
    $date_created = new DateTime($utilisateur->created);
    $date_edited = new DateTime($utilisateur->edited);
?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-user"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/utilisateurs/editer/id/<?=$utilisateur->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
               <?=$utilisateur->firstname; ?> <strong><?=$utilisateur->lastname; ?></strong><br />
                <small class="area"><?php if ($utilisateur->rank == 1): ?>Utilisateur<?php elseif ($utilisateur->rank == 3): ?>Gestionnaire<?php elseif ($utilisateur->rank == 5): ?>Administrateur<?php endif; ?></small>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/utilisateurs/editer/id/<?=$utilisateur->id; ?>" class="btn btn-primary btn-rad">Modifier l'utilisateur</a>
        </div>
    </div>
</div>





<?php if(isset($_POST['activate'])):
    enfant::unarchive($_GET['id']); ?>
    <div class="alert alert-success">
        <i class="icon-ok-sign"></i>
        Cette fiche a bien été réactivée !
    </div>
<?php endif; ?>



<div class="row">
    <div class="col-sm-12">
        <div class="block-flat">
            <table class="no-border no-strip information">
                <tbody class="no-border-x no-border-y">
                    <tr>
                        <td style="width:19%;" class="category"><strong>Informations</strong></td>
                        <td>
                            <table class="no-border no-strip skills">
                                <tbody class="no-border-x no-border-y">

                                    <tr>
                                        <td style="width: 20%;">Identifiant</td>
                                        <td><?=(!empty($utilisateur->identifier)) ? $utilisateur->identifier : EMPTYVAL; ?></td>
                                    </tr>

                                    <tr>
                                        <td style="width: 20%;">Rôle</td>
                                        <td>
                                            <?php if ($utilisateur->rank == 1): ?>
                                                Utilisateur
                                            <?php elseif ($utilisateur->rank == 3): ?>
                                                Gestionnaire
                                            <?php elseif ($utilisateur->rank == 5): ?>
                                                Administrateur
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 20%;">Email</td>
                                        <td><?=(!empty($utilisateur->email)) ? '<a href="mailto:'.$utilisateur->email.'">'.$utilisateur->email.'</a>' : EMPTYVAL; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-warning"></i></div>
                    <h4>Attention !</h4>
                    <p>
                        Vous êtes sur le point de supprimer l'utilisateur <strong><?=$utilisateur->firstname ?> <?=$utilisateur->lastname ?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-utilisateur" action="/utilisateurs/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$utilisateur->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer l'utilisateur">
                </form>
            </div>
        </div>
    </div>
</div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>