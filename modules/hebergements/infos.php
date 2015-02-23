<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<?php if(isset($_POST['submit-add'])): ?>
    <?php //tool::output($_POST); ?>
    <?php //tool::output($_SESSION); ?>
    <?php 
        extract($_POST);
        $datas = array(
            ':name' => $form_hebergement_name,
            ':address_number' => $form_hebergement_adresse_numero,
            ':address_street' => $form_hebergement_adresse_voirie,
            ':address_postal_code' => $form_hebergement_adresse_code_postal,
            ':address_city' => $form_hebergement_adresse_code_ville,
            ':note' => $form_hebergement_note
            );

        $result = hebergement::update($datas, $_GET['id']);
    ?>
    <?php if($result): ?>



        <div class="alert alert-success rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-sign"></i>
            L'hébergement <?=$form_hebergement_name; ?> a bien été ajoutée
        </div>

    <?php else: ?>

        <div class="alert alert-danger rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-sign"></i>
            Une erreur s'est produite durant l'ajout de l'hébergement, veuillez réessayer
        </div>

    <?php endif; ?>



<?php endif; ?>



<?php if(isset($_POST['submit-update'])): ?>
    <?php 
    extract($_POST);
    $datas = array(
        ':name' => $form_hebergement_name,
        ':address_number' => $form_hebergement_adresse_numero,
        ':address_street' => $form_hebergement_adresse_voirie,
        ':address_postal_code' => $form_hebergement_adresse_code_postal,
        ':address_city' => $form_hebergement_adresse_code_ville,
        ':note' => $form_hebergement_note
        );

    $result = hebergement::update($datas,  $_GET['id']);
        //tool::output($result);
    ?>

    <?php if($result): ?>

        <div class="alert alert-success rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-sign"></i>
            L'hébergement <strong><?=$form_hebergement_name; ?></strong> a bien été modifée
            <a href="/hebergements/">Retourner à la liste des hebergements</a>
        </div>

    <?php else: ?>


        <div class="alert alert-danger rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check-sign"></i>
            Une erreur s'est produite durant la modification de l'hébergement, veuillez réessayer
            <a href="/hebergements/editer/<?=$hebergement->id ?>">Retourner au formulaire d'édition</a>
        </div>

    <?php endif; ?>



<?php endif; ?>


<?php // TODO : ne pas oublier de lister les contacts associés  ?>
<?php $hebergement = hebergement::get($_GET['id']); ?>
<?php $creator = user::get($hebergement->creator); ?>
<?php $editor = user::get($hebergement->editor); ?>
<?php $date_created = new DateTime($hebergement->created); ?>
<?php $date_edited = new DateTime($hebergement->edited); ?>

<?php //$sejours_current = sejour::getListByHebergement(); ?>
<?php //$sejours_past = sejour::getListByHebergement(); ?>






<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                    <i class="fa big-icon fa-globe"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1><?=$hebergement->name; ?></h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="btn btn-primary btn-rad">Modifier cette fiche</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        <div class="block-flat">
            <?php if(!empty($hebergement->note)): ?>
                <?=$hebergement->note; ?>
            <?php endif; ?>
            <?php if(empty($hebergement->note) ): ?>
                <em>Aucune information au sujet de cet hébergement pour le moment</em>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-sm-3">

        <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
        <div class="block-flat bars-widget">
            <div class="gmap-sm">
                <a href="https://www.google.fr/maps/place/<?=$hebergement->address_number; ?>+<?=$hebergement->address_street; ?>,+<?=$hebergement->address_postal_code; ?>+<?=$hebergement->address_city; ?>/">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
                </a>
            </div>

            <address>
                <strong><?=$hebergement->name; ?></strong>
                <?php if ( !empty($hebergement->address_number) OR !empty($hebergement->address_street) ): ?>
                    <br><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?>
                    <br><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?>
                <?php endif; ?>
            </address>
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
                        Vous êtes sur le point de supprimer l'hébergement <strong><?=$hebergement->name?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-children" action="/hebergements/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$hebergement->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer l'hébergement">
                </form>
            </div>
        </div>
    </div>
</div>




<?php ob_start(); ?>
<script>
    $(function () {

        $('[data-toggle=popover]').popover({
            trigger:"click",
            html: true,
            placement: 'top',
            container: 'body',
            content: '<div class="popover-form clearfix"><form action="" method="post"><div class="form-group"><textarea class="form-control" name="note_message" cols="50" rows="5" placeholder="Entrez un commentaire"></textarea></div> <div class="pull-right"><a href="#" class="btn btn-default btn-sm btn-close">Annuler</a><button type="submit" name="submit-note" class="btn btn-primary btn-sm sumbit-comment">Enregistrer</button></div></form></div>'
        });
        $('[data-toggle=popover]').on('show.bs.popover', function () {
            var note = $(this).data('note');
            var note_id = $(this).data('note-id');
            var ref_sejour = $(this).data('ref-sejour');
            var ref_enfant = $(this).data('ref-enfant');
            setTimeout(function() {
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_sejour" value="'+ref_sejour+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_ref_enfant" value="'+ref_enfant+'">');
                $('body').find('.popover:last-child').find('form').prepend('<input type="hidden" name="note_id" value="'+note_id+'">');
                $('body').find('.popover:last-child').find('textarea').text(note);
            }, 1);
        });
        $('[data-toggle=popover]').on('click', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').not(this).popover('hide');
        });
        $('body').on('click', '.btn-close', function (e) {
            e.preventDefault();
            $('[data-toggle=popover]').popover('hide');
        });

    });
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>