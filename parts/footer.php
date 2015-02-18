
            </div>
        </div> 
    </div>

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <?php if (APP_VERSION != 'dev'): ?>
        <script src="/assets/js/gitedescimes.min.js"></script>
    <?php else: ?>
        <script src="/assets/libs/datatables/media/js/jquery.daTatables.js"></script>
        <script src="/assets/js/datatables-bootstrap-adapter.js"></script>
        <script src="/assets/js/datatables-french.js"></script>

        <script src="/assets/libs/jquery.gritter/js/jquery.gritter.js"></script>
        
        <script src="/assets/libs/bootstrap-file-input/bootstrap.file-input.js"></script>
        <script src="/assets/libs/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/assets/libs/jquery-icheck/icheck.min.js"></script>

        <script src="/assets/libs/jquery-maskedinput/dist/jquery.maskedinput.min.js"></script>
        <script src="/assets/libs/jquery-stickytabs/jquery.stickytabs.js"></script>

        <script src="/assets/libs/fullcalendar/fullcalendar.min.js"></script>
        <script src="/assets/js/fullcalendar.year.js"></script>

        <script src="/assets/js/flatdream-core.js"></script>

        <!-- <script src="/assets/js/app.js"></script> -->
    <?php endif; ?>

    <script>
    $(function() {
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
            }).stop().fadeIn(300);
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
    </script>
    <?php 
    if (!empty($scripts) && isset($scripts))
        echo $scripts;
    ?>
</body>
</html>