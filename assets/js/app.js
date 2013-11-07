$(function () {

	$("#wizard").steps({
		headerTag: 'h2',
		bodyTag: '.form-wrapper',
		transitionEffect: $.fn.steps.transitionEffect.fade,
		transitionEffectSpeed: 200,
		labels: {
			current: "Etape actuelle :",
			pagination: "Pagination",
			finish: "Valider",
			next: "Suivant",
			previous: "Précédent",
			loading: "Chargement..."
		}
	});

	$('input:checkbox, input:radio').uniform();
	$('.select2').select2();

	$('.input-datepicker').datepicker().on('changeDate', function () {
		$(this).datepicker('hide');
	});



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



	$('[data-group]').hide();
	$('[data-group="structure"').show();
	$('input[name="form-enfant-inscription"]').on('change', function() {
		$('[data-group]').hide();
		$('[data-group="'+ $(this).val() +'"]').fadeIn(300);
	});


	$('[data-responsable]').hide();
	$('[data-responsable="parents"]').show();
	$('[data-responsable="parents"] [data-responsable]').show();
	$('input[name="form-enfant-responsable"]').on('change', function() {
		$('[data-responsable]').hide();
		$('[data-responsable="parents"]').show();
		if ($(this).val() === 'parents') {
			$('[data-responsable="parents"] [data-responsable]').fadeIn(300);
		} else {
			$('[data-responsable="'+ $(this).val() +'"]').fadeIn(300);
		}
	});

	$('[data-domiciliation="famille"]').hide();
	$('input[name="form-enfant-domiciliation"]').on('change', function() {
		if ($(this).val() === 'famille') {
			$('[data-domiciliation="famille"]').fadeIn(300);
		} else {
			$('[data-domiciliation="famille"]').hide();
		}
	});
	$('[data-assurance="oui"]').hide();
	$('input[name="form-enfant-assurance"]').on('change', function() {
		if ($(this).val() === 'oui') {
			$('[data-assurance="oui"]').fadeIn(300);
		} else {
			$('[data-assurance="oui"]').hide();
		}
	});
});