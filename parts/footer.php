</div>
</div>
<div class="footer" role="contentinfo">
    <p>Conçu et développé avec tout l'♥ du monde par <a href="https://twitter.com/C_Beghin">@C_Beghin</a> and <a href="https://twitter.com/ClementRoy">@ClementRoy</a> - version <?=app::VERSION?>.</p>
</div>
<?php if (APP_VERSION != 'dev'): ?>
    <script src="/assets/dist/js/s.js"></script>
<?php else: ?>

    <!-- Communs -->
    <?php //<script src="/assets/js/wysihtml5-0.3.0.js"></script> ?>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.datepicker.js"></script>

    <!-- Ajouter
    <script src="/assets/js/jquery-ui-1.10.2.custom.min.js"></script> -->

    <script src="/assets/js/select2.js"></script>
    <!-- <script src="/assets/js/jquery.uniform.min.js"></script>-->
    <script src="/assets/js/jquery.mask.js"></script>

    <!-- <script src="/assets/js/jquery.steps.js"></script>
    <script src="/assets/js/additional-methods.js"></script> -->
    <script src="/assets/js/parsley.js"></script>
    <script src="/assets/js/parsley.extend.js"></script>

    <!-- TABLE -->
    <script src="/assets/js/jquery.dataTables.js"></script>
    
    <!--
    <script src='/assets/js/fullcalendar.js'></script>-->
    <script src='/assets/js/fullcalendar.year.js'></script>
    <script src="/assets/js/odometer.min.js"></script>


     <script src="/assets/js/mustache.js"></script>

    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/ajax.js"></script>

<?php endif; ?>

<body>
    </html>