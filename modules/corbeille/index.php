<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
            <h1>Corbeille</h1>
        </div>
    </div>
</div>



<?php extract($_POST); ?>

<?php if( isset($active) ): ?>
    <?php
        if($type == 'enfant'){ enfant::unarchive($id); }
        elseif($type == 'structure'){ structure::unarchive($id); }
        elseif($type == 'contact'){ contact::unarchive($id); }
        elseif($type == 'utilisateur'){ user::unarchive($id); }
        elseif($type == 'sejour'){ sejour::unarchive($id); }
        elseif($type == 'accompagnateur'){ accompagnateur::unarchive($id); }
    ?>

    <?php tpl::alert('success', 'L\'élément a bien été réactivé.'); ?>

<?php endif; ?>


<?php if( isset($remove) ): ?>
    <?php 
        if($type == 'enfant'){ enfant::delete($id); }    
        elseif($type == 'structure'){ structure::delete($id); }
        elseif($type == 'contact'){ contact::delete($id); }
        elseif($type == 'utilisateur'){ user::delete($id); } 
        elseif($type == 'sejour'){ sejour::delete($id); }
        elseif($type == 'accompagnateur'){ accompagnateur::delete($id); }
    ?>
    
    <?php tpl::alert('success', 'L\'élément a bien été supprimé.'); ?>

<?php endif; ?>

<?php
    $enfants = enfant::getFromTrash();
    $sejours = sejour::getFromTrash();
    $structures = structure::getFromTrash();
    $contacts = contact::getFromTrash();
    $utilisateurs = user::getFromTrash();
    $accompagnateurs = accompagnateur::getFromTrash();
?>


<div class="tab-container">
    <ul class="nav nav-tabs">

        <?php if(count($enfants)): ?>
            <li class="active"><a href="#enfants">Enfants</a></li>
        <?php endif; ?>
    
        <?php if(count($structures)): ?>
            <li<?php if(!count($enfants)): ?> class="active"<?php endif; ?>><a href="#structures">Structures</a></li>
        <?php endif; ?>

        <?php if(count($contacts)): ?>
            <li<?php if(!count($enfants) && !count($structures)): ?> class="active"<?php endif; ?>><a href="#contacts">Contacts</a></li>
        <?php endif; ?>

        <?php if(count($sejours)): ?>
            <li<?php if(!count($enfants) && !count($structures) && !count($contacts)): ?> class="active"<?php endif; ?>><a href="#sejours">Séjours</a></li>
        <?php endif; ?>

        <?php if(count($utilisateurs)): ?>
            <li<?php if(!count($enfants) && !count($structures) && !count($contacts) && !count($sejours)): ?> class="active"<?php endif; ?>><a href="#utilisateurs">Utilisateurs</a></li>
        <?php endif; ?>

        <?php if(count($accompagnateurs)): ?>
            <li<?php if(!count($enfants) && !count($structures) && !count($contacts) && !count($utilisateurs)): ?> class="active"<?php endif; ?>><a href="#accompagnateurs">Accompagnateurs</a></li>
        <?php endif; ?>

    </ul>
    <div class="tab-content tb-special">

        <?php if(count($enfants)): ?>
            <div id="enfants" class="tab-pane cont active">
                <div class="table-responsive">
                    <table id="datatable-enfants" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom & prénom</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($enfants as $key => $enfant) {
                                    $archived_by = user::get($enfant->editor);
                                    $archived_on = new DateTime($enfant->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$enfant->id.'">
                                                <input type="hidden" name="type" value="enfant">
                                                <li><a href="/enfants/infos/id/'.$enfant->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/enfants/infos/id/'.$enfant->id.'">'.trim($enfant->firstname).' '.trim($enfant->lastname).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/utilisateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var enfants_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        enfants_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-enfants').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   enfants_datas[0]
                    });
                    </script>
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($structures)): ?>
            <div id="structures" class="tab-pane">
                <div class="table-responsive">
                    <table id="datatable-structures" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($structures as $key => $structure) {
                                    $archived_by = user::get($structure->editor);
                                    $archived_on = new DateTime($structure->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$structure->id.'">
                                                <input type="hidden" name="type" value="structure">
                                                <li><a href="/structures/infos/id/'.$structure->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/structures/infos/id/'.$structure->id.'">'.trim($structure->name).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/utilisateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                            
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var structures_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        structures_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-structures').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   structures_datas[0]
                    });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($contacts)): ?>
            <div id="contacts" class="tab-pane">
                <div class="table-responsive">
                    <table id="datatable-contacts" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date de suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($contacts as $key => $contact) {
                                    $archived_by = user::get($contact->editor);
                                    $archived_on = new DateTime($contact->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$contact->id.'">
                                                <input type="hidden" name="type" value="contact">
                                                <li><a href="/contacts/infos/id/'.$contact->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/contacts/infos/id/'.$contact->id.'">'.trim($contact->civility).' '.trim($contact->lastname).' '.trim($contact->firstname).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/utilisateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var contacts_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        contacts_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-contacts').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   contacts_datas[0]
                    });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($sejours)): ?>
            <div id="sejours" class="tab-pane">
                <div class="table-responsive">
                    <table id="datatable-sejours" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom du séjour</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($sejours as $key => $sejour) {
                                    $archived_by = user::get($sejour->editor);
                                    $archived_on = new DateTime($sejour->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$sejour->id.'">
                                                <input type="hidden" name="type" value="sejour">
                                                <li><a href="/sejours/infos/id/'.$sejour->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/sejours/infos/id/'.$sejour->id.'">'.trim($sejour->name).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/utilisateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var sejours_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        sejours_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-sejours').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   sejours_datas[0]
                    });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($utilisateurs)): ?>
            <div id="utilisateurs" class="tab-pane">
                <div class="table-responsive">
                    <table id="datatable-utilisateurs" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom & prénom</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($utilisateurs as $key => $utilisateur) {
                                    $archived_by = user::get($utilisateur->editor);
                                    $archived_on = new DateTime($utilisateur->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$utilisateur->id.'">
                                                <input type="hidden" name="type" value="utilisateur">
                                                <li><a href="/utilisateurs/infos/id/'.$utilisateur->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/utilisateurs/infos/id/'.$utilisateur->id.'">'.trim($utilisateur->firstname).' '.trim($utilisateur->lastname).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/utilisateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var utilisateurs_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        utilisateurs_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-utilisateurs').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   utilisateurs_datas[0]
                    });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(count($accompagnateurs)): ?>
            <div id="accompagnateurs" class="tab-pane">
                <div class="table-responsive">
                    <table id="datatable-accompagnateurs" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom & prénom</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $the_json = array();
                                $the_datas = array();

                                foreach($accompagnateurs as $key => $accompagnateur) {
                                    $archived_by = user::get($accompagnateur->editor);
                                    $archived_on = new DateTime($accompagnateur->created);

                                    $popup = '
                                        <ul class="dropdown-menu">
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="'.$accompagnateur->id.'">
                                                <input type="hidden" name="type" value="accompagnateur">
                                                <li><a href="/accompagnateurs/infos/id/'.$accompagnateur->id.'" class="item"><i class="fa fa-share"></i> Voir la fiche</a></li>
                                                <li><button name="active" class="item"><i class="fa fa-edit"></i> Réactiver la fiche</button></li>
                                                <li><button name="remove" class="item"><i class="fa fa-trash"></i> Supprimer la fiche</button></li>
                                            </form>
                                        </ul>';


                                    $the_data = ['
                                        <a href="/accompagnateurs/infos/id/'.$accompagnateur->id.'">'.trim($accompagnateur->firstname).' '.trim($accompagnateur->lastname).'</a>'.$popup,
                                        'Supprimé le '.strftime('%d %B %Y', $archived_on->getTimestamp()).' par <a href="/accompagnateurs/infos/id/'.$archived_by->id.'">'.$archived_by->firstname.' '.$archived_by->lastname.'</a>',
                                    ];
                                    array_push($the_datas, $the_data);
                                }
                                array_push($the_json, $the_datas);
                            ?>
                        </tbody>
                    </table>
                    <?php ob_start(); ?>
                    <script>
                    var accompagnateurs_datas = [];
                    <?php foreach ($the_json as $key => $value): ?>
                        accompagnateurs_datas.push(<?=json_encode($the_json[$key]);?>);
                    <?php endforeach; ?>

                    $('#datatable-accompagnateurs').dataTable({
                        "bProcessing": true,
                        "bDeferRender": true,
                        "bStateSave": true,
                        "aaData":   accompagnateurs_datas[0]
                    });
                    </script>
                    <?php $scripts .= ob_get_contents();
                    ob_end_clean(); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>