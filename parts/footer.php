
            </div>
        </div> 
    </div>

    <script type="text/javascript" src="/assets/libs/jquery.js"></script>
    <?php if (APP_VERSION != 'dev'): ?>
    <script src="/assets/dist/js/s.js"></script>
    <?php else: ?>
    <script type="text/javascript" src="/assets/libs/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.datatables/jquery.datatables.min.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.datatables/i18n/french.js"></script>


    <script type="text/javascript" src="/assets/libs/jquery.pushmenu/js/jPushMenu.js"></script>
    <script type="text/javascript" src="/assets/libs/bootstrap.slider/js/bootstrap-slider.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.select2/select2.min.js"></script>
    <script type="text/javascript" src="/assets/libs/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/assets/libs/bootstrap-file-input/bootstrap.file-input.js"></script>
    <script type="text/javascript" src="/assets/libs/jquery.icheck/icheck.min.js"></script>
    <script type="text/javascript" src="/assets/libs/behaviour/core.js"></script>

    <script type="text/javascript" src="/assets/js/bootstrap.datepicker.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.sticky-tabs.js"></script>

    <script type="text/javascript" src="/assets/js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="/assets/js/fullcalendar.year.js"></script>

    <!-- <script type="text/javascript" src="/assets/js/app.js"></script> -->
    <?php endif; ?>

    <script>
    $(function() {
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
    });
    </script>
    <?php 
    if (!empty($scripts) && isset($scripts))
        echo $scripts;
    ?>
</body>
</html>