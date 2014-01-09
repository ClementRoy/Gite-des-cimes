$(function () {

	$('input:checkbox, input:radio').uniform();
	$('.select2').select2();

	$('.input-datepicker').datepicker({
		format : "dd/mm/yyyy",
		startView : "decade"
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
	if ($('input[name="form_enfant_responsable"]:checked').val() != 'tuteur') {
		$('[data-responsable="parents"]').show();
		if ($('input[name="form_enfant_responsable"]:checked').val() == 'mere') {
			$('[data-responsable="mere"]').show();
		} else if ($('input[name="form_enfant_responsable"]:checked').val() == 'pere') {
			$('[data-responsable="pere"]').show();
		} else {
			$('[data-responsable="mere"]').show();
			$('[data-responsable="pere"]').show();
		}
	} else {
		$('[data-responsable="tuteur"]').show();
	}

	if ($('input[name="form_enfant_domiciliation"]:checked').val() != 'famille') {
		$('[data-domiciliation="famille"]').hide();
	}

	if ($('input[name="form_enfant_assurance"]:checked').val() != 1) {
		$('[data-assurance="oui"]').hide();
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
					$(this).attr('value', '');
				}
			});
		$('[data-responsable="parents"]').show();
		if ($(this).val() === 'parents') {
			$('[data-responsable="parents"] [data-responsable]')
				.fadeIn(300)
				.find('input[type="text"]').each(function () {
					$(this).val($(this).data('original-value'));
				});
		} else {
			$('[data-responsable="'+ $(this).val() +'"]')
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
	$('#form-add-children').find('input[type="text"]').on('keypress', function () {
		$(this).attr('data-original-value', $(this).val());
	});
	$('#form-edit-children').find('input[type="text"]').on('keypress', function () {
		$(this).attr('data-original-value', $(this).val());
	});


	// SORT FOR TABLE

    $('.tablesorter').tablesorter();
    //$('#table-enfant').extendlink();
    //$('#table-enfant').tablefilter();

    $('.extendlink tbody tr').on('click', function() {
		var href = $(this).find('td:first-child a').attr('href');
		window.location=href;
    });

    $('input[data-search]').on('keyup', function () {
		var pattern = $(this).val().toLowerCase();
		var dataSearch = $(this).data('search');
		if (pattern === '') {
			$('table[data-search="' + dataSearch + '"] tbody tr').show();
		} else {
			$('table[data-search="' + dataSearch + '"] tbody tr').each(function () {
				var nb = $(this).text().toLowerCase().search(pattern);
				if (nb <= 0) {
					$(this).hide();
				} else{
					$(this).show();
				}
			});
		}
    });


  // sidebar menu dropdown toggle
  $("#dashboard-menu .dropdown-toggle").click(function (e) {
    e.preventDefault();
    var $item = $(this).parent();
    $item.toggleClass("active");
    if ($item.hasClass("active")) {
      $item.find(".submenu").slideDown("fast");
    } else {
      $item.find(".submenu").slideUp("fast");
    }
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
});