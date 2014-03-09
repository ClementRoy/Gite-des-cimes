<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>



<div class="title">
    <div class="row header">
        <div class="col-md-12">
            <h1>Corbeille</h1>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#enfants">Enfants</a></li>
                <li class=""><a href="#structures">Structures</a></li>
                <li class=""><a href="#contacts">Contacts</a></li>
                <li class=""><a href="#sejours">Séjours</a></li>
                <li class=""><a href="#utilisateurs">Utilisateurs</a></li>
            </ul>
        </div>
    </div>
</div>






<?php 

// Action de réactivation
//tool::output($_POST);
extract($_POST);

if( isset($active) ){
    if($type == 'enfant'){enfant::unarchive($id);}
    elseif($type == 'structure'){structure::unarchive($id);}
    elseif($type == 'contact'){contact::unarchive($id);}
    elseif($type == 'utilisateur'){utilisateur::unarchive($id);} 
    elseif($type == 'sejour'){sejour::unarchive($id);}
    ?>

    <div class="alert alert-success">
        <i class="icon-ok-sign"></i> 
        L'élément a bien été réactivé
    </div>


    <?php

}


// Action de suppression

if( isset($remove) ){
    if($type == 'enfant'){enfant::delete($id);}    
    elseif($type == 'structure'){structure::delete($id);}
    elseif($type == 'contact'){contact::delete($id);}
    elseif($type == 'utilisateur'){utilisateur::delete($id);} 
    elseif($type == 'sejour'){sejour::delete($id);}
    ?>

    <div class="alert alert-danger">
        <i class="icon-remove-sign"></i> 
        L'élément a bien été supprimé
    </div>

    <?php

}



?>
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

<div class="content content-table">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="enfants">
                <?php if(count($enfants)): ?>
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Date de suppression</th>
                                <th class="sortable">Action</th>
                            </thead>
                            <tbody>

                                <?php foreach($enfants as $key => $enfant): ?>
                                <?php $archived_by = user::get($enfant->editor); ?>
                                <?php $archived_on = new DateTime($enfant->created); ?>
                                <tr>
                                    <td>
                                        <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                                    </td>
                                    <td>
                                        Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <a href="/utilisateurs/infos/id/<?=$archived_by->id; ?>"><?=$archived_by->firstname; ?> <?=$archived_by->lastname; ?></a>
                                    </td>   
                                    <td>
                                        <form action="" method="post" class="pull-roght">
                                            <input type="hidden" name="id" value="<?=$enfant->id; ?>">
                                            <input type="hidden" name="type" value="enfant">
                                            <a href="/enfants/infos/id/<?=$enfant->id; ?>" class="btn"><i class="icon-share"></i></a>
                                            <button class="btn" name="active"><i class="icon-ok"></i></button>
                                            <button class="btn" name="remove"><i class="icon-trash"></i></button>
                                            <?php //data-toggle="tooltip" data-placement="top" title="" data-original-title="Supprimer définitivement" ?>
                                        </form>
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
                <table class="datatable">
                    <thead>
                        <tr>
                            <th class="sortable">Date de suppression</th>
                            <th class="sortable">Action</th>
                        </thead>
                        <tbody>

                            <?php foreach($structures as $key => $structure): ?>
                            <?php $archived_by = user::get($structure->editor); ?>
                            <?php $archived_on = new DateTime($structure->created); ?>
                            <tr>
                                <td>
                                    <a href="/structures/infos/id/<?=$structure->id; ?>"><?=$structure->name; ?></a>
                                </td>
                                <td>
                                    Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <a href="/utilisateurs/infos/id/<?=$archived_by->id; ?>"><?=$archived_by->firstname; ?> <?=$archived_by->lastname; ?></a>
                                </td>
                                <td>
                                    <form action="#structures" method="post" class="pull-roght">
                                        <input type="hidden" name="id" value="<?=$structure->id; ?>">
                                        <input type="hidden" name="type" value="structure">
                                        <a href="/structures/infos/id/<?=$structure->id; ?>" class="btn"><i class="icon-share"></i></a>
                                        <button class="btn" name="active"><i class="icon-ok"></i></button>
                                        <button class="btn" name="remove"><i class="icon-trash"></i></button>
                                    </form>                                        
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
                <table class="datatable">
                    <thead>
                        <tr>
                            <th class="sortable">Nom</th>
                            <th class="sortable">Date de suppression</th>
                            <th class="sortable">Action</th>
                        </thead>
                        <tbody>

                            <?php foreach($contacts as $key => $contact): ?>
                            <?php $archived_by = user::get($contact->editor); ?>
                            <?php $archived_on = new DateTime($contact->created); ?>
                            <tr>
                                <td>
                                    <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->civility; ?> <?=$contact->lastname; ?> <?=$contact->firstname; ?></a>
                                </td>
                                <td>
                                    Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                </td>   
                                <td>
                                    <form action="" method="post" class="pull-roght">
                                        <input type="hidden" name="id" value="<?=$contact->id; ?>">
                                        <input type="hidden" name="type" value="enfant">
                                        <a href="/contacts/infos/id/<?=$contact->id; ?>" class="btn"><i class="icon-share"></i></a>
                                        <button class="btn" name="active"><i class="icon-ok"></i></button>
                                        <button class="btn" name="remove"><i class="icon-trash"></i></button>
                                    </form>                                        
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
                <table class="datatable">
                    <thead>
                        <tr>
                            <th class="sortable">Nom</th>
                            <th class="sortable">Date de suppression</th>
                            <th class="sortable">Action</th>
                        </thead>
                        <tbody>

                            <?php foreach($sejours as $key => $sejour): ?>
                            <?php $archived_by = user::get($sejour->editor); ?>
                            <?php $archived_on = new DateTime($sejour->created); ?>
                            <tr>
                                <td>
                                    <a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a>
                                </td>
                                <td>
                                    Supprimé le <?=strftime('%d %B %Y', $archived_on->getTimestamp()); ?> par <?=$archived_by->firstname; ?>
                                </td>   
                                <td>
                                    <form action="" method="post" class="pull-roght">
                                        <input type="hidden" name="id" value="<?=$sejour->id; ?>">
                                        <input type="hidden" name="type" value="enfant">
                                        <a href="/sejours/infos/id/<?=$sejour->id; ?>" class="btn"><i class="icon-share"></i></a>
                                        <button class="btn" name="active"><i class="icon-ok"></i></button>
                                        <button class="btn" name="remove"><i class="icon-trash"></i></button>
                                    </form>
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
                    <table class="datatable">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Date de suppression</th>
                                <th>Action</th>
                            </thead>
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
                                            <form action="" method="post" class="pull-roght">
                                                <input type="hidden" name="id" value="<?=$utilisateur->id; ?>">
                                                <input type="hidden" name="type" value="utilisateur">
                                                <a href="/utilisateurs/infos/id/<?=$utilisateur->id; ?>" class="btn"><i class="icon-share"></i></a>
                                                <button class="btn" name="active"><i class="icon-ok"></i></button>
                                                <button class="btn" name="remove"><i class="icon-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p><em>Cette corbeille est vide</em></p>
                    <?php endif; ?>                            
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
</div>

                    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>