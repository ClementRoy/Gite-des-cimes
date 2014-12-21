<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Corbeille</h1>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#2014">2014</a></li>

            </ul>
        </div>
    </div>
</div>



<div class="content content-table">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="2014">
  
            </div>

                <script>
                    $(function () {
                        $('.nav-tabs a').click(function (e) {
                            e.preventDefault();
                            $(this).tab('show');
                        });
                    });
                </script>

        </div>
    </div>
</div>

                    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>