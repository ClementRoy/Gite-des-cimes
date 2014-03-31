<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


<?php enfant::cleanEmpty(); ?>


<div class="title">
    <div class="row header">
        <div class="col-md-4">
            <h1>Les enfants</h1>
        </div>
        <div class="col-md-8 text-right">
            <a href="/enfants/ajouter" class="btn btn-primary"><span>+</span>
                Ajouter un enfant</a>
            </div>
        </div>
    </div>
    <div class="content content-table">
        <div class="row">
            <div class="col-md-12">
             <table class="datatable">
                <thead>
                    <tr>
                        <th tabindex="0" rowspan="1" colspan="1">Nom</th>
                        <th tabindex="0" rowspan="1" colspan="1">Prénom</th>
                        <th tabindex="0" rowspan="1" colspan="1">Sexe</th>
                        <th tabindex="0" rowspan="1" colspan="1">Statut de la fiche</th>
                        <th tabindex="0" rowspan="1" colspan="1">Date de naissance</th>
                        <th tabindex="0" rowspan="1" colspan="1">Age</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>                
    </div>
</div>

<?php 
$enfants = enfant::getDisplayedList();   
$the_datas = array();
foreach($enfants as $key => $enfant) {
    if( $enfant->number_ss != 0 && $enfant->self_assurance > 0 && $enfant->cpam_attestation > 0 && !empty($enfant->self_assurance_expiration_date) && $enfant->health_record > 0 && $enfant->vaccination > 0 ) {
        $complete = '<span class="label label-success">Complète</span>';
    } else {
        $complete = '<span class="label label-warning">Incomplète</span> ';
    }

    $birthdate = new DateTime($enfant->birthdate); 

    if($birthdate->getTimestamp() != '-62169984561') {
        $birth = strftime('%d %B %Y', $birthdate->getTimestamp());
    } else {
        $birth = EMPTYVAL;
    }

    if($birthdate->getTimestamp() != '-62169984561') {
        $age = tool::getAgeFromDate($enfant->birthdate);
        $age .= ' ans';
    } else {
        $age = EMPTYVAL;
    }
    $sex = '';
    if($enfant->sex == 'féminin') {
        $sex = '<i class="icon-female"></i> Féminin';
    } else {
        $sex = '<i class="icon-male"></i> Masculin';
    }
    $the_data = ['<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->lastname.'</a>', '<a href="/enfants/infos/id/'.$enfant->id.'">'.$enfant->firstname.'</a>', $sex, $complete, $birth, $age];
    $the_datas[] = $the_data;
}
?>
<script>
    $(function(){
        var the_datas = <?=json_encode($the_datas);?>;
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "date-uk-pre": function ( a ) {
                var ukDatea = a.split('/');
                return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
            },

            "date-uk-asc": function ( a, b ) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },

            "date-uk-desc": function ( a, b ) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        } );

        if($('.datatable').data('sort') != undefined ){
            var col_sort = $('.datatable').data('sort');
        }
        else {
            var col_sort = '0';
        }
        $('.datatable').dataTable({
            "aaSorting": [[col_sort,'asc']],
            "sPaginationType": "full_numbers",
            "iDisplayLength": 100,
            "oLanguage": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                }
            },
            "bProcessing": true,
            "bDeferRender": true,
            "aaData": the_datas
        });
        $('#DataTables_Table_0_filter').find('input').focus();
});
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>