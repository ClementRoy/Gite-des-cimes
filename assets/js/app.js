$(function () {

	$('input:checkbox, input:radio').uniform();

	$('.select2').select2();

	$('.input-datepicker').datepicker().on('changeDate', function () {
		$(this).datepicker('hide');
	});

	$('[data-toggle="tooltip"]').each(function (index, el) {
		$(el).tooltip({
			placement: $(this).data("placement") || 'right'
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

});