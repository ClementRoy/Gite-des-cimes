<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php sejour::cleanEmpty(); ?>



<?php //tool::output($sejours); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-4">
            <h1>Les séjours</h1>

        </div>
        <div class="col-md-8 text-right">
            <a href="/sejours/ajouter" class="btn btn-primary"><span>+</span>
                Ajouter un séjour</a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">


                <div id='calendar'></div>




            </div>
        </div>                
    </div>

    <!-- end users table -->
</div>

<?php $sejours = sejour::getList(); ?>
<?php $nb_sejours = count($sejours); ?>
<?php $i = 0; ?>

<script>
    $(function($) {
        $('#calendar').fullCalendar({
            firstDay: 1,
            dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
            monthNames: ['Janvier','Février','Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            eventSources: [{
                events: [
                <?php foreach($sejours as $key => $sejour): ?>
                <?php
                $inscriptions = inscription::getBySejour($sejour->id);

                $date_from = new DateTime($sejour->date_from);
                if ($date_from->getTimestamp() != '-62169987600') {
                    $date_from1 = strftime("%Y-%m-%d", $date_from->getTimestamp());
                    $date_from2 = strftime("%d %B %Y", $date_from->getTimestamp());
                }

                $date_to = new DateTime($sejour->date_to);
                if ($date_to->getTimestamp() != '-62169987600') {
                    $date_to1 = strftime("%Y-%m-%d", $date_to->getTimestamp());
                    $date_to2 = strftime("%d %B %Y", $date_to->getTimestamp());
                }

                if ($sejour->ref_hebergement) {
                    $hebergement = hebergement::get($sejour->ref_hebergement);
                    $hebergement = $hebergement->name;
                } else {
                    $hebergement = EMPTYVAL;
                }

                $i++;

                $nb_weeks = tool::getNbWeeks(new DateTime($sejour->date_from), new DateTime($sejour->date_to));
                if ($nb_weeks < 1) {
                    $nb_weeks = 'un week-end';
                } else if ($nb_weeks == 1) {
                    $nb_weeks = '1 semaine';
                } else {
                    $nb_weeks = $nb_weeks.' semaines';
                }
                $type = '';
                if ($nb_weeks < 1) {
                    $type = 'week-end';
                } else {
                    $type = 'semaine';
                }
                ?>
                {
                    title       : '<?=addslashes($sejour->name)?>',
                    url         : '/sejours/infos/id/<?=$sejour->id?>',
                    start       : '<?=$date_from1?>',
                    end         : '<?=$date_to1?>',
                    description : '<p><span class="plabel"><i class="icon-calendar icon"></i> :</span> <span class="pcontent"><?=$date_from2?> au <?=$date_to2?></span></p><p><span class="plabel"><i class="icon-map-marker icon"></i> :</span> <span class="pcontent"><?=addslashes($hebergement)?></span></p><p><span class="plabel"><i class="icon-group icon"></i> :</span> <span class="pcontent"><?=count($inscriptions)?> <?=(count($inscriptions) > 1)?"enfants":"enfant";?> inscrits <br />sur <?=$nb_weeks?></span></p><p><span class="plabel"><i class="icon-tag icon"></i> :</span> <span class="pcontent"><?=$sejour->price?> €/<small><?=$type?></small></span></p>'
                    
                }<?=($i < $nb_sejours) ? ',' : '' ; ?>
            <?php endforeach; ?>

            ]
        }],
        eventRender: function (event, element) {
            element.popover({
                title: event.title,
                placement: 'top',
                trigger: 'hover',
                container: '.wrapper',
                html: 'true',
                content: event.description
            });
        }

    });
});
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>