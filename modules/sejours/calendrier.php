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

    <div class="content content-table">
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
                    $date_from = strftime("%Y-%m-%d", $date_from->getTimestamp());
                }

                $date_to = new DateTime($sejour->date_to);
                if ($date_to->getTimestamp() != '-62169987600') {
                    $date_to = strftime("%Y-%m-%d", $date_to->getTimestamp());
                }

                if ($sejour->ref_hebergement) {
                    $hebergement = hebergement::get($sejour->ref_hebergement);
                    $hebergement = $hebergement->name;
                } else {
                    $hebergement = EMPTYVAL;
                }

                $i++;

                ?>
                {
                    title       : '<?=addslashes($sejour->name)?>',
                    url         : '/sejours/infos/id/<?=$sejour->id?>',
                    start       : '<?=$date_from?>',
                    end         : '<?=$date_to?>',
                    description : 'test'
                    
                }<?=($i < $nb_sejours) ? ',' : '' ; ?>
                <?php endforeach; ?>

            ]
        }],
        eventRender: function (event, element) {
            console.log(element.text());
            console.log(event);

            element.popover({
                title: event.title,
                placement: 'left',
                trigger: 'hover',
                container: '.wrapper',
                html: 'true',
                content: '<br />Start: ' + event.start + '<br />End: ' + event.ends + '<br />Description: '
            });
        }

    });
});
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>