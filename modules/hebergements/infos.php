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

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    L'hébergement <?=$form_hebergement_name; ?> a bien été ajoutée
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant l'ajout de l'hébergement, veuillez réessayer
                </div>
            </div>
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

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <i class="icon-ok-sign"></i> 
                    l'hébergement <?=$form_hebergement_name; ?> a bien été modifée
                </div>
                <a href="/hebergements/">Retourner à la liste des hebergements</a>

            </div>
        </div>


    <?php else: ?>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <i class="icon-remove-sign"></i> 
                    Une erreur s'est produite durant la modification de l'hébergement, veuillez réessayer
                </div>
                <a href="/hebergements/editer/<?=$hebergement->id ?>">Retourner au formulaire d'édition</a>
            </div>
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





<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h1>
                <a href="#" class="trigger"><i class="big-icon icon-globe"></i></a>
                <?=$hebergement->name; ?>
            </h1>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/hebergements/editer/id/<?=$hebergement->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/hebergements/supprimer/id/<?=$hebergement->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
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

<div class="row">
    <div class="col-md-9">
        <div class="content<?=($hebergement->archived)?' archived':' ';?>">
            <div class="profile-box">
                <?php //tool::output($hebergement); ?>
                <?php if(!empty($hebergement->note)): ?>
                    <div class="">
                        <h6>Description</h6>
                        <p><?=$hebergement->note; ?></p>
                    </div>
                <?php endif; ?>
                <?php /* ?>
                <?php if($sejours_current): ?>
                    <div class="">
                        <h6>Séjours à venir à cet endroit</h6>
                    </div>
                <?php endif; ?>
                <?php if($sejours_past): ?>
                    <div class="">
                        <h6>Séjours ayant eut lieu à cet endroit</h6>
                    </div>
                <?php endif; ?>
                <?php */ ?>
                <?php if(empty($hebergement->note) ): ?>
                    <p><em>Aucune information au sujet de cet hébergement pour le moment</em></p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="col-md-3 address">
        <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
        <div class="contact">
            <h6><strong><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></strong></h6>
            <p>        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            </p>
            <?php if( !empty($hebergement->address_number) OR !empty($hebergement->address_street) ): ?>
                <p><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>