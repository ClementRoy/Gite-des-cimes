    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-4">
                    <h3>Corbeille</h3>
                </div>
                <div class="col-md-8 text-right">
                    <!--<input type="text" id="table-enfant-search" data-search="enfant" class="col-md-5 search" placeholder="Tapez le nom d'un enfant..." autofocus="autofocus">-->
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
                        <table id="" data-search="" class="table table-hover extendlink">
                            <tfoot>
                                <th>Nom</th>
                                <th><span class="line"></span>Date de suppression</th>
                                <th><span class="line"></span>Action</th>
                            </tfoot>
                            <tbody>

                                <?php foreach($enfants as $key => $enfant): ?>
                                <?php $archived_by = user::get($enfant->editor); ?>
                                <?php $archived_on = new DateTime($enfant->created); ?>
                                    <tr>
                                        <td>
                                            <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                                        </td>
                                        <td>
                                            Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                        </td>   
                                        <td>
                                            <a href="">Réactiver</a> |  <a href="">Supprimer</a>
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
                        <table id="" data-search="" class="table table-hover extendlink">
                            <tfoot>
                                <th>Nom</th>
                                <th><span class="line"></span>Date de suppression</th>
                                <th><span class="line"></span>Action</th>
                            </tfoot>
                            <tbody>

                                <?php foreach($structures as $key => $structure): ?>
                                <?php $archived_by = user::get($structure->editor); ?>
                                <?php $archived_on = new DateTime($structure->created); ?>
                                    <tr>
                                        <td>
                                            <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name; ?></a>
                                        </td>
                                        <td>
                                            Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                        </td>   
                                        <td>
                                            <a href="">Réactiver</a> |  <a href="">Supprimer</a>
                                        </td>                                    
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="contacts">
                        <?php if(count($contacts)): ?>
                        <table id="" data-search="" class="table table-hover extendlink">
                            <tfoot>
                                <th>Nom</th>
                                <th><span class="line"></span>Date de suppression</th>
                                <th><span class="line"></span>Action</th>
                            </tfoot>
                            <tbody>

                                <?php foreach($contacts as $key => $contact): ?>
                                <?php $archived_by = user::get($contact->editor); ?>
                                <?php $archived_on = new DateTime($contact->created); ?>
                                    <tr>
                                        <td>
                                            <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->firstname; ?></a>
                                        </td>
                                        <td>
                                            Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                        </td>   
                                        <td>
                                            <a href="">Réactiver</a> |  <a href="">Supprimer</a>
                                        </td>                                    
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="sejours">
                        <?php if(count($sejours)): ?>
                        <table id="" data-search="" class="table table-hover extendlink">
                            <tfoot>
                                <th>Nom</th>
                                <th><span class="line"></span>Date de suppression</th>
                                <th><span class="line"></span>Action</th>
                            </tfoot>
                            <tbody>

                                <?php foreach($sejours as $key => $sejour): ?>
                                <?php $archived_by = user::get($sejour->editor); ?>
                                <?php $archived_on = new DateTime($sejour->created); ?>
                                    <tr>
                                        <td>
                                            <a href="/enfants/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                                        </td>
                                        <td>
                                            Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                        </td>   
                                        <td>
                                            <a href="">Réactiver</a> |  <a href="">Supprimer</a>
                                        </td>                                    
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p><em>Cette corbeille est vide</em></p>
                        <?php endif; ?>                            
                        </div>
                        <div class="tab-pane" id="utilisateurs">
                        <?php if(count($utilisateurs)): ?>
                        <table id="" data-search="" class="table table-hover extendlink">
                            <tfoot>
                                <th>Nom</th>
                                <th><span class="line"></span>Date de suppression</th>
                                <th><span class="line"></span>Action</th>
                            </tfoot>
                            <tbody>

                                <?php foreach($utilisateurs as $key => $utilisateur): ?>
                                <?php $archived_by = user::get($utilisateur->editor); ?>
                                <?php $archived_on = new DateTime($utilisateur->created); ?>
                                    <tr>
                                        <td>
                                            <a href="/utilisateurs/infos/id/<?=$utilisateur->id; ?>"><?=$utilisateur->firstname; ?></a>
                                        </td>
                                        <td>
                                            Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                        </td>   
                                        <td>
                                            <a href="">Réactiver</a> |  <a href="">Supprimer</a>
                                        </td>                                    
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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



                </div>                
            </div>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



