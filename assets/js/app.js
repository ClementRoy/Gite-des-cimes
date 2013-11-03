$(function () {

// add uniform plugin styles to html elements
$('input:checkbox, input:radio').uniform();

// select2 plugin for select elements
$('.select2').select2();

// datepicker plugin
$('.input-datepicker').datepicker().on('changeDate', function () {
    $(this).datepicker('hide');
});



// build all tooltips from data-attributes
$('[data-toggle="tooltip"]').each(function (index, el) {
    $(el).tooltip({
        placement: $(this).data("placement") || 'right'
    });
});


});