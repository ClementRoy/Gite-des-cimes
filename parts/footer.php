	<div class="container" role="contentinfo">
		<p>Conçu et développé avec tout l'♥ du monde par <a href="https://twitter.com/C_Beghin">@C_Beghin</a> and <a href="https://twitter.com/ClementRoy">@ClementRoy</a> - version <?=app::VERSION?>.</p>
	</div>
	
	<!-- Communs -->
    <?php //<script src="/assets/js/wysihtml5-0.3.0.js"></script> ?>
   
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Ajouter -->
    <script src="/assets/js/jquery-ui-1.10.2.custom.min.js"></script>
  	<script src="/assets/js/bootstrap.datepicker.js"></script>
    <script src="/assets/js/jquery.uniform.min.js"></script>
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/jquery.dataTables.js"></script>
    
     <!-- <script src="/assets/js/jquery.steps.js"></script>
    <script src="/assets/js/additional-methods.js"></script> -->
    <script src="/assets/js/parsley.js"></script>
    <script src="/assets/js/parsley.extend.js"></script>

    <!-- TABLE -->
    <script src="/assets/js/jquery.tablesorter.js"></script>

    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/ajax.js"></script>

    <script>
        $(document).ready(function(){
            $('#form-enfant-structure-select').trigger('change');
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

            $('.datatable').dataTable({
                "sPaginationType": "full_numbers",
                "iDisplayLength": 25,
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
                }
            });

          $(".header").each(function (index, el) {
            var $el = $(el);
            var $dialog = $el.find(".pop-dialog");
            var $trigger = $el.find(".trigger");
            
            $dialog.click(function (e) {
                e.stopPropagation()
            });
            $("body").click(function () {
              $dialog.removeClass("is-visible");
              $trigger.removeClass("active");
            });

            $trigger.click(function (e) {
              e.preventDefault();
              e.stopPropagation();

              $dialog.toggleClass("is-visible");

              if ($dialog.hasClass("is-visible")) {
                $(this).addClass("active");
              } else {
                $(this).removeClass("active");
              }

            });
          });

          $('.tooltip').tooltip();


            // Handle right click on table row to open contextual menu
            $("table").on("contextmenu", "tr", function(e){
                var offset = $(this).offset();
                var $posX = e.pageX - offset.left - 20;
                var $posY = e.pageY - offset.top + 10;
                //console.log(e.pageX + " Y: " + e.pageY);
                //console.log(e.clientX + " Y: " + e.clientY);
                var $dialog = $(this).find(".pop-dialog");
                $dialog.css({top:$posY,left:$posX});
                $dialog.click(function (e) {
                    e.stopPropagation();
                });
                $("body").click(function () {
                  $dialog.removeClass("is-visible");
                  $("table tr").removeClass("active");
                });
              
                $("table tr").removeClass("active");               
                $(".pop-dialog").each(function (index, el) {
                    $(el).removeClass("is-visible");
                });
                $dialog.toggleClass("is-visible");

                if ($dialog.hasClass("is-visible")) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }
              e.preventDefault();
              e.stopPropagation();
            });
    
    
        });
    </script>
    <?php // TODO: create a dalyed system, with obtstart ?>
                                        
<body>
</html>