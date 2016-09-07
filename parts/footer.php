
            </div>
        </div> 
    </div>

    <?php if (APP_VERSION != 'dev'): ?>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="/assets/js/gitedescimes.min.js"></script>
    <?php else: ?>

        <script src="/assets/libs/jquery/jquery.js"></script>
        <script src="/assets/libs/bootstrap/dist/js/bootstrap.js"></script>

        <script src="/assets/libs/datatables/media/js/jquery.daTatables.js"></script>
        <script src="/assets/js/libs/datatables-bootstrap-adapter.js"></script>
        <script src="/assets/js/libs/datatables-french.js"></script>
        <!-- <script src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script> -->

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