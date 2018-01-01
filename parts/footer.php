
            </div>
        </div>
    </div>

    <?php if (APP_VERSION != 'dev'): ?>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script  src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script src="//cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

        <script src="/assets/js/gitedescimes.min.js"></script>
    <?php else: ?>

        <script src="/assets/libs/jquery/jquery.js"></script>
        <!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
        <script src="/assets/libs/bootstrap/dist/js/bootstrap.js"></script>
        
        <!-- <script class="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->
        <!-- <script src="/assets/libs/datatables/media/js/jquery.daTatables.js"></script> -->
        <!-- <script src="/assets/js/libs/datatables-bootstrap-adapter.js"></script> -->
        <!-- <script src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script> -->
        
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script src="//cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

        <!-- <script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script> -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script> -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

        <script src="/assets/js/libs/datatables-french.js"></script>
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script> -->

        <script src="/assets/libs/jquery.gritter/js/jquery.gritter.js"></script>
        
        <script src="/assets/libs/bootstrap-file-input/bootstrap.file-input.js"></script>
        <script src="/assets/libs/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/assets/libs/jquery-icheck/icheck.min.js"></script>
        <script src="/assets/libs/parsleyjs/dist/parsley.min.js"></script>
        <script src="/assets/libs/parsleyjs/src/extra/validator/comparison.js"></script>
        <script src="/assets/libs/parsleyjs/src/i18n/fr.js"></script>

        <script src="/assets/libs/jquery-maskedinput/dist/jquery.maskedinput.min.js"></script>
        <script src="/assets/libs/jquery-stickytabs/jquery.stickytabs.js"></script>

        <script src="/assets/libs/fullcalendar/fullcalendar.min.js"></script>
        <script src="/assets/js/libs/fullcalendar.year.js"></script>

        <script src="/assets/js/libs/flatdream-core.js"></script>

        <script src="/assets/js/app.js"></script>
    <?php endif; ?>

    <?php 
    if (!empty($scripts) && isset($scripts))
        echo $scripts;
    ?>
</body>
</html>