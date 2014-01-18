    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-4">
                    <h3>Les enfants</h3>
                </div>
                <div class="col-md-8 text-right">
                    <input type="text" id="table-enfant-search" data-search="enfant" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">
                </div>
            </div>

            <?php $enfants = enfant::getFromTrash(); ?>
            <?php $sejours = sejour::getFromTrash(); ?>
            <?php $structures = structure::getFromTrash(); ?>
            <?php $contacts = contact::getFromTrash(); ?>
            <?php $utilisateurs = user::getFromTrash(); ?>


            <!--
            <div class="alert alert-success">
                <i class="icon-ok-sign"></i> Your order has been placed.
            </div>
            <div class="alert alert-info">
                <i class="icon-exclamation-sign"></i>
                Do you want to get these resources for as little as $0.70 each?
            </div>
            <div class="alert alert-danger">
                <i class="icon-remove-sign"></i>
                Unexpected error. Please try again later.
            </div>
            -->
                      

            <div class="row">
                <div class="col-md-12">

                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#enfants">Enfants</a></li>
                      <li class=""><a href="#structures">Structures</a></li>
                      <li class=""><a href="#contacts">Contacts</a></li>
                      <li class=""><a href="#sejours">Séjours</a></li>
                      <li class=""><a href="#utilisateurs">Utilisateurs</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="enfants">
                        <?php if(count($enfants)): ?>
                        <table id="" data-search="" class="table table-hover tablesorter extendlink">
                            <thead>
                                <tr>
                                    <th class="sortable">Nom</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($enfants as $key => $enfant): ?>
                                    <tr>
                                        <td>
                                            <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                                        </td>                                       
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="structures">
                        <?php if(count($structures)): ?>

                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="contacts">
                        <?php if(count($contacts)): ?>

                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="sejours">
                        <?php if(count($sejours)): ?>

                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="utilisateurs">
                        <?php if(count($utilisateurs)): ?>

                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                    </div>

                    <script>
                    $(function () {
                        $('.nav-tabs a').click(function (e) {
                            e.preventDefault();
                            $(this).tab('show');
                        });
                    });
                    </script>

<div class="panel panel-default">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
    Panel content
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>


                </div>                
            </div>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



