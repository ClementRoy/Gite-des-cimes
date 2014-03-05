<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



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
        <div class="col-md-6">

            <h3><a href="#" class="trigger"><i class="big-icon icon-plane"></i></a> <?=$sejour->name; ?></h3>

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

        <div class="col-md-6 text-right">

        </div>
    </div>
</div>

<div class="content <?=($sejour->archived)?' archived':' ';?>">


    <div class="row">
        <div class="col-md-9">
            <p>Séjour du <?=strftime('%d %B %Y', $date_from->getTimestamp()) ?> au <?=strftime('%d %B %Y', $date_to->getTimestamp()) ?></p>
            
                <div class="pull-right">
                    <a href="/inscriptions/ajouter/sejour/<?=$sejour->id; ?>" class="btn-flat primary"><span>+</span> Ajouter un enfant à ce séjour</a>
                </div>

            <ul class="nav nav-tabs">
            <?php for ($i=1; $i <= $nb_weeks; $i++) : ?>
               <li <?php if($i == 1): ?>class="active"<?php endif; ?>><a href="#week-<?=$i ?>"><?php if($date_from->diff($date_to)->format('%d') == 2): ?>Week-end<?php else: ?>Semaine <?=$i ?><?php endif; ?></a></li>
            <?php endfor; ?>
            </ul>
                      

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
                <div class="col-md-10">
                <h4>Capacité du séjour du au </h4>
                <ul>
                    <li>capacité min : <?=$sejour->capacity_min ?></li>
                    <li>capacité max : <?=$sejour->capacity_max ?></li>
                </ul>
                </div>

                <div class="col-md-2">
                <br />
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


                <h6><?=count($inscriptions) ?> Enfants inscrits à ce séjour <?php if($date_from->diff($date_to)->format('%d') != 2): ?> pour la semaine <?=$i ?> <?php endif; ?></h6>

                <?php if(count($inscriptions) > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    id
                                </th>
                                <th class="col-md-3">
                                    Prénom
                                </th>
                                <th class="col-md-3">
                                    <span class="line"></span>
                                    Nom
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Dates
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inscriptions as $key => $inscription): ?>
                                <?php $enfant = enfant::get($inscription->ref_enfant); ?>
                                <tr>
                                    <td>
                                        <a href="/inscriptions/infos/id/<?=$inscription->id; ?>">#<?=$key+1 ?></a>
                                        <div class="pop-dialog tr">
                                            <div class="pointer">
                                                <div class="arrow"></div>
                                                <div class="arrow_border"></div>
                                            </div>
                                            <div class="body">
                                                <div class="menu">
                                                    <a href="/inscriptions/infos/id/<?=$inscription->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                                    <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                                    <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <em>Aucune inscription pour le moment</em>
                <?php endif; ?>
                </div>
            
            <?php endfor; ?>
            </div>

    </div>




<div class="col-md-3 address">
    <?php if(isset($hebergement )): ?>
        <h6>Coordonnées</h6>
        <?php $geo = tool::getLatLng($hebergement->address_number.' '.$hebergement->address_street.' '.$hebergement->address_postal_code.' '.$hebergement->address_city); ?>
        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$geo[0]; ?>,<?=$geo[1]; ?>&zoom=12&size=210x200&scale=2&markers=<?=$geo[0]; ?>,<?=$geo[1]; ?>&sensor=false" width="100%" alt="">
        <ul>
            <li><strong>Adresse</strong></li>
            <li><?=$hebergement->address_number; ?> <?=$hebergement->address_street; ?></li>
            <li><?=$hebergement->address_postal_code; ?> <?=$hebergement->address_city; ?></li>
        </ul>
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