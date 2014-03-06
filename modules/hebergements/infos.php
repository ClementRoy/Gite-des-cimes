<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



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

<?php $sejours_current = sejour::getListByHebergement(); ?>
<?php $sejours_past = sejour::getListByHebergement(); ?>





<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h3>
                <a href="#" class="trigger"><i class="big-icon icon-globe"></i></a>
                <?=$hebergement->name; ?>
            </h3>

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

<div class="content<?=($hebergement->archived)?' archived':' ';?>">

    <div class="row">

        <div class="col-md-9">
            <div class="profile-box">
                <?php tool::output($hebergement); ?>
                <?php if(!empty($hebergement->note)): ?>
                    <div class="">
                        <h6>Description</h6>
                        <p><?=$hebergement->note; ?></p>
                    </div>
                <?php endif; ?>
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
            </div>
        </div>

        <div class="col-md-3">
            <h6>Coordonnées</h6>
            <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
            <?php if($geo[0]): ?>
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            <?php endif; ?>
            <ul>
                <li><strong>Adresse</strong></li>
                <li><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></li>
                <li><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></li>              
            </ul>

        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>