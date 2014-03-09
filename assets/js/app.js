$(function () {

// $('.maped-form .field-box').each(function(index, val) {
// 		var label = $(this).children('label').text();
// 		var anchor = $(this).find('[id^=form-]').attr('id');
// 		$('.form-map').append('<li><a href="#' + anchor + '">' + label + '</a></li>');
// });

//$('body').scrollspy({ target: '.form-map' })


$('.form-nav a').click(function (e) {
    var the_id = $(this).attr("href");  
  
    $('html, body').animate({  
        scrollTop:$(the_id).offset().top - 40 
    }, 'slow');  
    return false;
});



setTimeout(function() {
	$('.animated').removeClass('fadeInUp');
	$('.animated').removeClass('animated');
}, 1000);

$("#form-add-children").scrollspy({target: "#form-nav", offset:50});

$('.metadata').popover();

$('.input-phone').mask('00 00 00 00 00');
$('.input-securite-social').mask('0 00 00 00 000 000 00');

//$('input:checkbox, input:radio').uniform();
$('.select2').select2();

$('.input-datepicker').datepicker({
	format : "dd/mm/yyyy",
	startView : "decade"
}).on('changeDate', function () {
	$(this).datepicker('hide');
});

$('.input-datepicker-light').datepicker({
	format : "dd/mm/yyyy"
}).on('changeDate', function () {
	$(this).datepicker('hide');
});

// SETTINGS TOOLTIPS
$('input[type="text"]').each(function (index, el) {
	$(el).tooltip({
		placement: $(this).data("placement") || 'right',
		trigger: $(this).data("trigger") || 'focus'
	});
});
$('textarea').each(function (index, el) {
	$(el).tooltip({
		placement: $(this).data("placement") || 'right',
		trigger: $(this).data("trigger") || 'focus'
	});
});
$('label.radio').parent('div').each(function (index, el) {
	$(el).tooltip({
		placement: $(this).data("placement") || 'right',
		trigger: $(this).data("trigger") || 'hover'
	});
});
$('label.radio-inline').parent('div').each(function (index, el) {
	$(el).tooltip({
		placement: $(this).data("placement") || 'right',
		trigger: $(this).data("trigger") || 'hover'
	});
});
$('.ui-select').parent('div').each(function (index, el) {
	$(el).tooltip({
		placement: $(this).data("placement") || 'right',
		trigger: $(this).data("trigger") || 'hover'
	});
});

// SETTINGS CONDITIONNALS FORMS
$('[data-group]').hide();
$('[data-group="'+ $('input[name="form_enfant_inscription"]:checked').val() +'"]').show();

$('[data-responsable]').hide();
if ($('input[name="form_enfant_responsable"]:checked').val() === 'structure') {
	$('[data-responsable]').hide();
} else if ($('input[name="form_enfant_responsable"]:checked').val() === 'tuteur') {
	$('[data-responsable="tuteur"]').show();
	$('[data-responsable="adresse"]').show();
} else {
	$('[data-responsable="parents"]').show();
	$('[data-responsable="adresse"]').show();
	if ($('input[name="form_enfant_responsable"]:checked').val() == 'mere') {
		$('[data-responsable="mere"]').show();
	} else if ($('input[name="form_enfant_responsable"]:checked').val() == 'pere') {
		$('[data-responsable="pere"]').show();
	} else {
		$('[data-responsable="mere"]').show();
		$('[data-responsable="pere"]').show();
	}
}

if ($('input[name="form_enfant_domiciliation"]:checked').val() != 'famille') {
	$('[data-domiciliation="famille"]').hide();
}

if ($('input[name="form_enfant_assurance"]:checked').val() != 1) {
	$('[data-assurance="oui"]').hide();
}

if ($('input[name="form_enfant_attestation_cpam"]:checked').val() != 1) {
	$('[data-cpam="oui"]').hide();
}

// HANDLERS CONDITIONNALS FORMS

$('input[name="form_enfant_inscription"]').on('change', function() {
	$('[data-group]')
	.hide()
	.find('input[type="text"]').each(function () {
		if ($(this).val() != '') {
			$(this).attr('data-original-value', $(this).val());
			$(this).attr('value', '');
		}
	});
	$('[data-group="'+ $(this).val() +'"]')
	.fadeIn(300)
	.find('input[type="text"]').each(function () {
		$(this).val($(this).data('original-value'));
	});
});

$('input[name="form_enfant_responsable"]').on('change', function() {
	$('[data-responsable]')
	.hide()
	.find('input[type="text"]').each(function () {
		if ($(this).val() != '') {
			$(this).attr('data-original-value', $(this).val());
		}
	});
	if ($(this).val() === 'tuteur') {
		$('[data-responsable="'+ $(this).val() +'"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
		$('[data-responsable="adresse"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	} else if ($(this).val() === 'parents') {
		$('[data-responsable="parents"]').show();
		$('[data-responsable="parents"] [data-responsable]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
		$('[data-responsable="adresse"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	} else if ($(this).val() === 'pere') {
		$('[data-responsable="parents"]').show();
		$('[data-responsable="pere"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
		$('[data-responsable="adresse"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	} else if ($(this).val() === 'mere') {
		$('[data-responsable="parents"]').show();
		$('[data-responsable="mere"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
		$('[data-responsable="adresse"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	}
});

$('input[name="form_enfant_domiciliation"]').on('change', function() {
	if ($(this).val() != 'famille') {
		$('[data-domiciliation="famille"]')
		.hide()
		.find('input[type="text"]').each(function () {
			if ($(this).val() != '') {
				$(this).attr('data-original-value', $(this).val());
				$(this).attr('value', '');
			}
		});
	} else {
		$('[data-domiciliation="famille"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	}
});

$('input[name="form_enfant_assurance"]').on('change', function() {
	if ($(this).val() != 1) {
		$('[data-assurance="oui"]')
		.hide()
		.find('input[type="text"]').each(function () {
			if ($(this).val() != '') {
				$(this).attr('data-original-value', $(this).val());
				$(this).attr('value', '');
			}
		});
	} else {
		$('[data-assurance="oui"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	}
});

$('input[name="form_enfant_attestation_cpam"]').on('change', function() {
	if ($(this).val() != 1) {
		$('[data-cpam="oui"]')
		.hide()
		.find('input[type="text"]').each(function () {
			if ($(this).val() != '') {
				$(this).attr('data-original-value', $(this).val());
				$(this).attr('value', '');
			}
		});
	} else {
		$('[data-cpam="oui"]')
		.fadeIn(300)
		.find('input[type="text"]').each(function () {
			$(this).val($(this).data('original-value'));
		});
	}
});
$('#form-add-children').find('input[type="text"]').on('keypress', function () {
	$(this).attr('data-original-value', $(this).val());
});
$('#form-edit-children').find('input[type="text"]').on('keypress', function () {
	$(this).attr('data-original-value', $(this).val());
});


// SORT FOR TABLE

//$('.tablesorter').tablesorter({dateFormat : "uk"});
//$('#table-enfant').extendlink();
//$('#table-enfant').tablefilter();

// $('.extendlink tbody tr').on('click', function() {
// 	var href = $(this).find('td:first-child a').attr('href');
// 	window.location=href;
// });

// $('input[data-search]').on('keyup', function () {
// 	var pattern = $(this).val().toLowerCase();
// 	var dataSearch = $(this).data('search');
// 	if (pattern === '') {
// 		$('table[data-search="' + dataSearch + '"] tbody tr').show();
// 	} else {
// 		$('table[data-search="' + dataSearch + '"] tbody tr').each(function () {
// 			var nb = $(this).text().toLowerCase().search(pattern);
// 			if (nb <= 0) {
// 				$(this).hide();
// 			} else{
// 				$(this).show();
// 			}
// 		});
// 	}
// });


$('#sidebar-nav .dropdown-toggle').click( function (e) {
	e.preventDefault();
	var $item = $(this).parent();


	if ($item.hasClass('open')) {
		$item.find(".submenu").slideUp("fast");
		$item.removeClass("open");

	} else {
		$item.addClass("open");
		$item.find(".submenu").slideDown("fast");
	}
	$item.siblings().removeClass('open').find(".submenu").slideUp("fast");
});

// $('#sidebar-nav').on('hover', function () {
// 	$(this).find('li.active .submenu').slideDown("fast");
// });

$('#sidebar-nav').on('mouseleave', function () {
	$(this).find('li.open .submenu').slideUp("fast");
	$(this).find('li.open').removeClass('open');
});

// mobile side-menu slide toggler
var $menu = $("#sidebar-nav");
$("body").click(function () {
	if ($(this).hasClass("menu")) {
		$(this).removeClass("menu");
	}
});

$menu.click(function(e) {
	e.stopPropagation();
});
$("#menu-toggler").click(function (e) {
	e.stopPropagation();
	$("body").toggleClass("menu");
});

$(window).resize(function() { 
	$(this).width() > 769 && $("body.menu").removeClass("menu")
});


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


$("table").on("contextmenu", "tr", function(e){
	var offset = $(this).offset();
	var $posX = e.pageX - offset.left - 20;
	var $posY = e.pageY - offset.top + 10;
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