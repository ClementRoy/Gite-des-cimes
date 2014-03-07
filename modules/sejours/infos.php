<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-add'])): ?>
    <?php  
    extract($_POST);
    $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
    $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);

    $datas = array(
        ':name' => $form_sejour_name,
        ':date_from' => $form_sejour_date_debut,
        ':date_to' => $form_sejour_date_fin,
        ':ref_hebergement' => $form_sejour_hebergement,
        ':capacity_max' => $form_sejour_capacite_max,
        ':capacity_min' => $form_sejour_capacite_min,
        ':numero' => $form_sejour_numero,
        ':price' => $form_sejour_prix
        );

    $result = sejour::update($datas, $_GET['id']);

    ?>

    <?php //tool::output($_POST); ?>

    <?php if($result): ?>

        <div class="title">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>
        </div>
        <div class="content action-page">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        Le séjour <strong><?=$form_sejour_name; ?></strong> a bien été ajouté
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="title">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Ajouter un séjour</h3>
                </div>
            </div>
        </div>
        <div class="content action-page">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant l'ajout du séjour, veuillez réessayer
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>


<?php if(isset($_POST['submit-update'])): ?>
    <?php  

    extract($_POST);
    $form_sejour_date_debut = tool::generateDatetime($form_sejour_date_debut);
    $form_sejour_date_fin = tool::generateDatetime($form_sejour_date_fin);

    $datas = array(
        ':name' => $form_sejour_name,
        ':date_from' => $form_sejour_date_debut,
        ':date_to' => $form_sejour_date_fin,
        ':ref_hebergement' => $form_sejour_hebergement,
        ':capacity_max' => $form_sejour_capacite_max,
        ':capacity_min' => $form_sejour_capacite_min,
        ':numero' => $form_sejour_numero,
        ':price' => $form_sejour_prix
        );

    $result = sejour::update($datas, $_GET['id']);

    ?>
    <?php if($result): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <i class="icon-exclamation-sign"></i>
                    Le séjour <strong><?=$form_sejour_name; ?></strong> a bien été modifié.
                </div>
                <a href="/sejours/">Retourner à la liste des séjours</a>

            </div>
        </div>
    <?php else: ?>

    <?php endif; ?>
<?php endif; ?>


<?php $sejour = sejour::get($_GET['id']); ?>
<?php //tool::output($sejour); ?>
<?php 
if($sejour->ref_hebergement && $sejour->ref_hebergement != 0) {
    $hebergement = hebergement::get($sejour->ref_hebergement);
}
?>
<?php $creator = user::get($sejour->creator); ?>
<?php $editor = user::get($sejour->editor); ?>
<?php $date_created = new DateTime($sejour->created); ?>
<?php $date_edited = new DateTime($sejour->edited); ?>

<?php $date_from = new DateTime($sejour->date_from); ?>
<?php $date_to = new DateTime($sejour->date_to); ?>

<?php $nb_weeks = tool::getNbWeeks($date_from, $date_to); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h3>
                <a href="#" class="trigger"><i class="big-icon icon-plane"></i></a> <?=$sejour->name; ?>
                <small><i class="icon icon-calendar"></i> Du <?=strftime('%d %B %Y', $date_from->getTimestamp()) ?> au <?=strftime('%d %B %Y', $date_to->getTimestamp()) ?></small>
            </h3>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/sejours/editer/id/<?=$sejour->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/sejours/supprimer/id/<?=$sejour->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-3 text-right">
            <a href="/inscriptions/ajouter/sejour/<?=$sejour->id; ?>" class="btn btn-primary"><span>+</span> Ajouter un enfant à ce séjour</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>
                <li <?php if($i == 1): ?>class="active"<?php endif; ?>><a href="#week-<?=$i ?>"><?php if($date_from->diff($date_to)->format('%d') == 2): ?>Week-end<?php else: ?>Semaine <?=$i ?><?php endif; ?></a></li>
            <?php endfor; ?>
        </ul>
        <div class="content<?=($sejour->archived)?' archived':' ';?>">


            <div class="row">


                <div class="tab-content">
                    <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>


                        <?php 
/*
$i donne la semaine de la recherche
on recherche toujours de +$i-1 week à +$i week
*/

$date_from_query = new DateTime($sejour->date_from);
$date_to_query = new DateTime($sejour->date_from);
$diff_date_from = $i-1;
$date_from_query->modify("+$diff_date_from weeks");
$date_to_query->modify("+$i weeks");
?>


<?php $inscriptions = inscription::getBySejourBetweenDates($sejour->id, $date_from_query, $date_to_query); ?>

<div class="tab-pane <?php if($i == 1): ?>active<?php endif; ?>" id="week-<?=$i ?>">


    <div class="row">
        <div class="col-md-9">
            <!-- <h4>Capacité du séjour du au </h4> -->
            <h6><strong><?=count($inscriptions) ?></strong> Enfants inscrits à ce séjour <?php if($date_from->diff($date_to)->format('%d') != 2): ?> pour la semaine <?=$i ?> <?php endif; ?>
                (min : <?=$sejour->capacity_min ?> -  max : <?=$sejour->capacity_max ?>)
            </h6>



        </div>

        <div class="col-md-3 text-right">
            <div class="btn-group">
                <button class="btn glow"><i class="icon-download-alt"></i></button>
                <button class="btn glow dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="/export/sejour/type/1/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp() ?>">Récapitulatif mineurs</a></li>
                    <li><a href="/export/sejour/type/2/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp() ?>">Suivi sanitaire</a></li>
                    <li><a href="/export/sejour/type/3/id/<?=$sejour->id ?>/datefrom/<?=$date_from_query->getTimestamp() ?>/dateto/<?=$date_to_query->getTimestamp() ?>">Registre des mineurs</a></li>
                </ul>
            </div> 
        </div>
    </div>


    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?=min($sejour->capacity_min,count($inscriptions)) ?>" aria-valuemin="0" aria-valuemax="<?=$sejour->capacity_min ?>" style="width: <?php echo (min($sejour->capacity_min,count($inscriptions))/$sejour->capacity_max)*100; ?>%;">
            <span><?=min($sejour->capacity_min,count($inscriptions)) ?></span>
        </div>
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=count($inscriptions) ?>" aria-valuemin="0" aria-valuemax="7" style="width: <?php echo (min($sejour->capacity_max,count($inscriptions))/$sejour->capacity_max)*100-(min($sejour->capacity_min,count($inscriptions))/$sejour->capacity_max)*100; ?>%;">
            <span><?=count($inscriptions) ?></span>
        </div>
        <span><?=$sejour->capacity_max ?></span>
    </div>

    <?php if(count($inscriptions) > 0): ?>
        <div class="content-table">
            <table class="datatable">
                <thead>
                    <tr>
                        <th>
                            id
                        </th>
                        <th >
                            Prénom
                        </th>
                        <th >
                            <span class="line"></span>
                            Nom
                        </th>
                        <th >
                            <span class="line"></span>
                            Dates
                        </th>
                        <th>
                            Statut
                        </th>
                        <th >
                            Prise en charge
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inscriptions as $key => $inscription): ?>
                        <?php $enfant = enfant::get($inscription->ref_enfant); ?>
                        <tr>
                            <td>
                                <a href="/inscriptions/infos/id/<?=$inscription->inscription_id; ?>">#<?=$key+1 ?></a>
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/inscriptions/infos/id/<?=$inscription->inscription_id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/inscriptions/editer/id/<?=$inscription->inscription_id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/inscriptions/supprimer/id/<?=$inscription->inscription_id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->lastname ?></a>
                            </td>
                            <td>
                                <?php $date_from = new DateTime($inscription->date_from); ?>
                                <?php $date_to = new DateTime($inscription->date_to); ?>
                                du <?=strftime('%d %B %Y', $date_from->getTimestamp()); ?>  au <?=strftime('%d %B %Y', $date_to->getTimestamp()); ?> 
                            </td>
                            <td>
                                <?php if($inscription->finished): ?>
                                    <span class="label label-success">Confirmé</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non confirmé</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($inscription->supported): ?>
                                    <span class="label label-success">Oui</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <em>Aucune inscription pour le moment</em>
    <?php endif; ?>
</div>

<?php endfor; ?>
</div>

</div>
</div>
</div>




<div class="col-md-3 address">
    <?php if(isset($hebergement )): ?>

        <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
        <div class="contact">
            <h6><strong><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></strong></h6>
            <p>        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
            </p>
            <?php if( !empty($hebergement->address_number) OR !empty($hebergement->address_street) ): ?>
                <p><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</div>
</div>

<script>
    $(function () {
        $('.nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>