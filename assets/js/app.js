$(function () {

	// SORT FOR TABLE

    $('.tablesorter').tablesorter();
    //$('#table-enfant').extendlink();
    //$('#table-enfant').tablefilter();

    $('.extendlink tbody tr').on('click', function() {
    	var href = $(this).find('td:first-child a').attr('href');
    	window.location=href;
    });

    $('#table-enfant-search').on('keyup', function () {
		var pattern = $(this).val().toLowerCase();
		if (pattern === '') {
			$('#table-enfant tbody tr').show();
		} else {
			$('#table-enfant tbody tr').each(function () {
				var nb = $(this).text().toLowerCase().search(pattern);
				if (nb <= 0) {
					$(this).hide();
				} else{
					$(this).show();
				}
			});
		}
    });

	$('input:checkbox, input:radio').uniform();
	$('.select2').select2();

	$('.input-datepicker').datepicker().on('changeDate', function () {
		$(this).datepicker('hide');
	});



	// TOOLTIPS

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


	// SHOW/HIDE FORMS

	$('[data-group]').hide();
	$('[data-group="structure"').show();
	$('input[name="form_enfant_inscription"]').on('change', function() {
		$('[data-group]').hide();
		$('[data-group="'+ $(this).val() +'"]').fadeIn(300);
	});


	$('[data-responsable]').hide();
	$('[data-responsable="parents"]').show();
	$('[data-responsable="parents"] [data-responsable]').show();
	$('input[name="form_enfant_responsable"]').on('change', function() {
		$('[data-responsable]').hide();
		$('[data-responsable="parents"]').show();
		if ($(this).val() === 'parents') {
			$('[data-responsable="parents"] [data-responsable]').fadeIn(300);
		} else {
			$('[data-responsable="'+ $(this).val() +'"]').fadeIn(300);
		}
	});

	$('[data-domiciliation="famille"]').hide();
	$('input[name="form_enfant_domiciliation"]').on('change', function() {
		if ($(this).val() === 'famille') {
			$('[data-domiciliation="famille"]').fadeIn(300);
		} else {
			$('[data-domiciliation="famille"]').hide();
		}
	});
	$('[data-assurance="oui"]').hide();
	$('input[name="form_enfant_assurance"]').on('change', function() {
		if ($(this).val() === 'oui') {
			$('[data-assurance="oui"]').fadeIn(300);
		} else {
			$('[data-assurance="oui"]').hide();
		}
	});

});