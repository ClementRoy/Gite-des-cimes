<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    <?php if(isset($_POST['submit-add'])): ?>

        <?php 
                extract($_POST);
                $datas = array(
                    ':lastname' => $form_accompagnateur_nom,
                    ':firstname' => $form_accompagnateur_prenom,
                    ':tel' => $form_accompagnateur_tel,
                    ':email' => $form_accompagnateur_email,
                );

                $result = accompagnateur::update($datas, $_GET['id']);

         ?>
            <?php if($result): ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="icon-ok-sign"></i> 
                            L'accompagnateur <?=$form_accompagnateur_prenom; ?> <?=$form_accompagnateur_nom; ?> a bien été ajouté
                        </div>
                    </div>
                </div>

            <?php else: ?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i> 
                            Une erreur s'est produite durant l'ajout de l'accompagnateur, veuillez réessayer
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    <?php endif; ?>


   <?php if(isset($_POST['submit-update'])): ?>
        <?php  
        extract($_POST);
        $datas = array(
            ':firstname' => $form_accompagnateur_prenom,
            ':lastname' => $form_accompagnateur_nom,
            ':tel' => $form_accompagnateur_tel,
            ':email' => $form_accompagnateur_email,
        );

        $result = accompagnateur::update($datas, $_GET['id']);

        ?>
        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">

                    <div class="alert alert-info">
                        <i class="icon-exclamation-sign"></i>
                        L'accompagnateur <strong><?=$form_accompagnateur_prenom; ?> <?=$form_accompagnateur_nom; ?></strong> a bien été modifié.
                    </div>
                </div>
            </div>
        <?php else: ?>

        <?php endif; ?>

    <?php endif; ?>


<?php $accompagnateur = accompagnateur::get($_GET['id']); ?>
<?php $creator = accompagnateur::get($accompagnateur->creator); ?>
<?php $editor = accompagnateur::get($accompagnateur->editor); ?>
<?php $date_created = new DateTime($accompagnateur->created); ?>
<?php $date_edited = new DateTime($accompagnateur->edited); ?>




<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-user"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/accompagnateurs/editer/id/<?=$accompagnateur->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
                <?=$accompagnateur->firstname; ?> <strong><?=$accompagnateur->lastname; ?></strong>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/accompagnateurs/editer/id/<?=$accompagnateur->id; ?>" class="btn btn-primary btn-rad">Modifier ce contact</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        

        <div class="block-flat">

            <table class="no-border no-strip information">
                <tbody class="no-border-x no-border-y">
                    <tr>
                        <td style="width:19%;" class="category"><strong>Informations</strong></td>
                        <td>
                            <table class="no-border no-strip skills">
                                <tbody class="no-border-x no-border-y">

                                    <tr>
                                        <td style="width: 20%;">Email</td>
                                        <td><?=(!empty($accompagnateur->email)) ? '<a href="mailto:'.$accompagnateur->email.'">'.$accompagnateur->email.'</a>' : EMPTYVAL; ?></td>
                                    </tr>


                                    <tr>
                                        <td style="width: 20%;">Téléphone</td>
                                        <td><?=(!empty($accompagnateur->tel)) ? tool::formatTel($accompagnateur->tel) : EMPTYVAL; ?></td>
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
                        Vous êtes sur le point de supprimer la fiche de l'accompagnateur <strong><?=$accompagnateur->firstname; ?> <?=$accompagnateur->lastname; ?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-accompagnateur" action="/accompagnateurs/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$accompagnateur->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer le contact">
                </form>
            </div>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>

