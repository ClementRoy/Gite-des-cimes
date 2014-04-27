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


<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h1>
                <a href="#" class="trigger"><i class="big-icon icon-user"></i></a>
                <?=$accompagnateur->firstname; ?> <strong><?=$accompagnateur->lastname; ?></strong>
                <?php /* ?><small><?php if ($accompagnateur->rank == 1): ?>Utilisateur<?php elseif ($accompagnateur->rank == 3): ?>Gestionnaire<?php elseif ($accompagnateur->rank == 5): ?>Administrateur<?php endif; ?></small><?php */ ?>
            </h1>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/accompagnateurs/editer/id/<?=$accompagnateur->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/accompagnateurs/supprimer/id/<?=$accompagnateur->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 text-right">
            <div class="col-md-4 text-right pull-right">
                <i class="icon-cog"></i>
            </div>
        </div>
    </div>
</div>

<div class="content <?=($accompagnateur->archived)?' archived':' ';?>">



<!-- Modal -->
<div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h6 class="modal-title" id="myModalLabel">Supprimer cette fiche</h6>
            </div>
            <div class="modal-body">
                <p>Vous êtes sur le point de supprimer l'accompagnateur de <strong><?=$accompagnateur->firstname; ?> <?=$accompagnateur->lastname; ?></strong>.<br />
                    Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <a class="btn-flat white" data-dismiss="modal">Annuler</a>
                    <a href="/utilisateurs/supprimer/id/<?=$utilisateur->id; ?>/confirm/true" class="btn-flat danger"><i class="icon-remove"></i> Supprimer</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="row">
        <div class="col-md-6">
            <dl>
                <dt>Nom :</dt> <dd><?=$accompagnateur->lastname; ?></dd>
            </dl>
            <dl>
                <dt>Prénom :</dt> <dd><?=$accompagnateur->firstname; ?></dd>
            </dl>
        </div>
        <div class="col-md-6">
            <dl>
                <dt>Téléphone :</dt>
                <dd>
                    <?php if(!empty($accompagnateur->tel)): ?>
                        <?=tool::formatTel($accompagnateur->tel); ?>
                    <?php else: ?>
                        NC
                    <?php endif; ?>
                </dd>
            </dl>
            <dl>
                <dt>Email :</dt>
                <dd>
                    <?php if(!empty($accompagnateur->email)): ?>
                        <a href="mailto:<?=$accompagnateur->email;?>" target="_blank"><?=$accompagnateur->email;?></a>
                    <?php else: ?>
                        NC
                    <?php endif; ?>
                </dd>
            </dl>
        </div>
    </div>

    <?php //tool::output($accompagnateur); ?>

    <!-- <small class="metadata pull-right">Créé par <?=$creator->firstname; ?> le <?=strftime('%d %B %Y', $date_created->getTimestamp()); ?>, modifié par <?=$editor->firstname ?> le <?=strftime('%d %B %Y', $date_edited->getTimestamp()); ?> </small> -->
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>

