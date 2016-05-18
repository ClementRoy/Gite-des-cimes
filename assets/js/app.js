function debounce(callback, delay){
    var timer;
    return function(){
        var args = arguments;
        var context = this;
        clearTimeout(timer);
        timer = setTimeout(function(){
            callback.apply(context, args);
        }, delay);
    };
}

function throttle(callback, delay) {
    var last;
    var timer;
    return function () {
        var context = this;
        var now = +new Date();
        var args = arguments;
        if (last && now < last + delay) {
            // le délai n'est pas écoulé on reset le timer
            clearTimeout(timer);
            timer = setTimeout(function () {
                last = now;
                callback.apply(context, args);
            }, delay);
        } else {
            last = now;
            callback.apply(context, args);
        }
    };
}

function testing(testingString) {
    var $form = $('form');

    $form.find('input[type="text"]').val(testingString);
    $form.find('textarea').val(testingString);
    $form.find('select').each(function(index, el) {
        var value = $(el).find('option').eq(testingString).val()
        $(el).val(value);
    });
    $form.find('input.input-datepicker').val(testingString + testingString + '/' + '1' + '1' + '/20' + testingString + testingString);
    $form.find('input.input-phone').val('0' + testingString + ' ' + testingString + testingString + ' ' + testingString + testingString + ' ' + testingString + testingString + ' ' + testingString + testingString);
    $form.find('input.input-hour, input.input-minute').val(testingString + testingString);

    var inputRadio = [],
        inputName = '';
    $form.find('input[type="radio"]').each(function() {

        if (inputName != $(this).attr('name')) {
            inputRadio.push($(this).attr('name'));
            inputName = $(this).attr('name');
        }
    });
    $.each(inputRadio, function(index, val) {
        $form.find('input[type="radio"][name="' + val + '"]').iCheck('uncheck').eq(testingString-1).iCheck('check');
    });
}


function neoAffix(elem, marginTop, marginBottom, breakpoint) {

    var $elem = elem,
        offsetTop = $elem.offset().top,
        elemHeight = $elem.outerHeight(),
        elemWidth = $elem.outerWidth(),
        documentHeight = $(document).height(),
        $window = $(window);

    if (typeof $elem.data('width') !== undefined) {
        $elem.attr('data-width', elemWidth);
    }


    var windowHeight = $(window).height(),
        otherElemHeight = 0,
        uselessHeight = elemHeight - $('#form-nav').outerHeight();

    $('#form-nav').css('height', windowHeight - 60 - uselessHeight);


    function neoProcessing(){
        var scrollTop = $window.scrollTop();

        if ($window.width() <= breakpoint) { return false; }

        if (scrollTop >= offsetTop - marginTop) {
            var nearBottom = elemHeight + marginTop +  scrollTop + marginBottom;
            if ( nearBottom >= documentHeight ) {
                $elem.removeClass('neoaffix').addClass('neoaffix-bottom').css('width', elemWidth);
            } else {
                $elem.removeClass('neoaffix-top neoaffix-bottom').addClass('neoaffix').css('width', elemWidth);
            }
        } else {
            $elem.removeClass('neoaffix').addClass('neoaffix-top');
        }            
    }

    $window.scroll(function () {
        neoProcessing();
    });

    neoProcessing();

    $window.resize(function(event) {
        $elem.removeAttr('style').removeClass('neoaffix-top neoaffix');
        elemWidth = $elem.outerWidth();
        $elem.attr('data-width', elemWidth);

        windowHeight = $(window).height(),
        otherElemHeight = 0,
        uselessHeight = elemHeight - $('#form-nav').outerHeight();

        $('#form-nav').css('height', windowHeight - 60 - uselessHeight);

        neoProcessing();
    });
}


$(function() {

    $('#form-nav').on('click', 'a', function (event) {
        event.preventDefault();

        var href = $(this).attr('href'),
            pos = $(href).offset().top - 200;

        $("html, body").stop().animate({
            scrollTop: pos
        });

        $(href).focus();
        return false;
    });
    
    if ($('#neo-affix').length > 0) {
        neoAffix($('#neo-affix'), 30, 98, 992);
    }
    $('#allias-submit').on('click', 'button', function(event) {
        event.preventDefault();
        $('.block-flat form').submit();
    });

    window.ParsleyValidator.setLocale('fr');
    if($('form').length > 0) {   
        $('form').parsley();

        $(".input-datepicker").mask("99/99/9999");
        $.mask.definitions['z'] = '[0]';
        $(".input-phone").mask("z9 99 99 99 99");
        $.mask.definitions['g'] = '[1-2]';
        $(".input-securite-social").mask("g 99 99 99 999 999 99");
         $(".input-hour, .input-minute").mask("99");
    }

    $('input[type="text"]').tooltip({
        placement: 'top',
        container: 'body',
        trigger: 'hover'
    });
    $('select').tooltip({
        placement: 'top',
        container: 'body',
        trigger: 'hover'
    });
    $('.nav-tabs').stickyTabs();
    $("table").on("contextmenu", "tr", function (event) {
        event.preventDefault();
        
        var offset = $(this).offset(),
            $menus = $('.dropdown-menu.is-visible');
            $posX = event.pageX - offset.left - 20,
            $posY = event.pageY - offset.top + 10,
            $menu = $(this).find('.dropdown-menu');

        $menus.stop().fadeOut(50);
        $menu.addClass('is-visible').css({
            top: $posY,
            left: $posX,
        }).stop().fadeIn(150);
    });
    $('body').on('click', function () {
        if ($('.dropdown-menu.is-visible').length > 0) {
            $('.dropdown-menu.is-visible').css('display', 'none');
        }
    });
    $('input[type=file]')
        .attr('title', 'Choisissez un fichier')
        .bootstrapFileInput();

        
    /*Return to top*/
    var offset = 220,
        duration = 500,
        button = $('<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>');
    
    button.appendTo("body");

    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_flat-purple',
        radioClass: 'iradio_flat-purple'
    });
});