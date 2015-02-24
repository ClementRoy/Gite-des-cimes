<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php if(isset($_POST['submit-add'])): ?>

    <?php  
        extract($_POST);
        //tool::output($_POST);

        $datas = array(
            ':finished' => $form_inscription_option,
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_structure_payer' => $form_inscription_structure,
            ':structure_payer' => $form_inscription_structure_name,
            ':supported' => $form_inscription_supported,
            ':note' => $form_inscription_note,
            ':place' => (!empty($form_inscription_lieu_custom))?$form_inscription_lieu_custom:$form_inscription_lieu,
            ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
            ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
            ':pique_nique' => $form_inscription_pique_nique,
            ':sac' => $form_inscription_sac
            );
        //tool::output($datas);
        $result = dossier::update($datas, $_GET['id']);

        foreach($dates as $key => $inscription_entry){

            $inscription_entry = explode('#', $inscription_entry);
            $form_inscription_date_debut = tool::generateDatetime($inscription_entry[0]);
            $form_inscription_date_fin = tool::generateDatetime($inscription_entry[1]);
            $datas = array(
                ':ref_enfant' => $form_inscription_enfant,
                ':ref_sejour' => $inscription_entry['2'],
                ':ref_dossier' => $_GET['id'],
                ':date_from' => $form_inscription_date_debut,
                ':date_to' => $form_inscription_date_fin
                );
            //tool::output($datas);
            $result = inscription::add($datas);
        }
    ?>

    <?php if($result): ?>

        <?php tpl::alert('success', 'L\'inscription de <strong>'.$form_inscription_enfant.'</strong> a bien été enregistré. <a href="/dossiers/">Retourner à la liste des dossiers</a>'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', 'Une erreur s\'est produite durant l\'enregistrement de l\'inscription de <strong>'.$form_inscription_enfant.'</strong>. <a href="/dossiers/ajouter/">Retourner au formulaire de création</a>'); ?>

    <?php endif; ?>

<?php endif; ?>

<?php if(isset($_POST['submit-update'])): ?>

    <?php  
        //tool::output($_POST);
        extract($_POST);

        $datas = array(
            ':finished' => $form_inscription_option,
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_structure_payer' => $form_inscription_structure,
            ':structure_payer' => $form_inscription_structure_name,
            ':supported' => $form_inscription_supported,
            ':note' => $form_inscription_note,
            ':place' => (!empty(trim($form_inscription_lieu_custom)))? trim($form_inscription_lieu_custom) : trim($form_inscription_lieu),
            ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
            ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
            ':pique_nique' => $form_inscription_pique_nique,
            ':sac' => $form_inscription_sac
            );
            //tool::output($datas);
        $result = dossier::update($datas, $_GET['id']);

        $inscription = inscription::deleteByDossier($_GET['id']);

            //tool::output($form_inscription_sejour);
        foreach($dates as $key => $inscription_entry){

            $inscription_entry = explode('#', $inscription_entry);
            $form_inscription_date_debut = tool::generateDatetime($inscription_entry[0]);
            $form_inscription_date_fin = tool::generateDatetime($inscription_entry[1]);
            $datas = array(
                ':ref_enfant' => $form_inscription_enfant,
                ':ref_sejour' => $inscription_entry['2'],
                ':ref_dossier' => $_GET['id'],
                ':date_from' => $form_inscription_date_debut,
                ':date_to' => $form_inscription_date_fin
                );
                //tool::output($datas);
            $result = inscription::add($datas);
        }
    ?>

    <?php if($result): ?>

        <?php tpl::alert('success', 'L\'inscription de <strong>'.$form_inscription_enfant.'</strong> a bien été modifié. <a href="/dossiers/">Retourner à la liste des dossiers</a>'); ?>

    <?php else: ?>

        <?php tpl::alert('danger', 'Une erreur s\'est produite durant la modification de l\'inscription de <strong>'.$form_inscription_enfant.'</strong>. <a href="/dossiers/editer/'.$_GET['id'].'">Retourner au formulaire de modification</a>'); ?>
    <?php endif; ?>

<?php endif; ?>



<?php $dossier = dossier::get($_GET['id']); ?>
<?php $creator = user::get($dossier->creator); ?>
<?php $editor = user::get($dossier->editor); ?>
<?php $date_created = new DateTime($dossier->created); ?>
<?php $date_edited = new DateTime($dossier->edited); ?>


<div class="page-head">
    <div class="row">
        <div class="col-md-8">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-folder-open"></i>
            </a>
            <ul class="dropdown-menu animated fadeInDown">
                <li><a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="item"><i class="fa fa-edit"></i> Modifier</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-remove" class="item"><i class="fa fa-remove"></i> Supprimer</a></li>
            </ul>

            <h1>
               Inscription <strong>n°<?=$dossier->id; ?></strong>
            </h1>
        </div>
        <div class="col-md-4 text-right">
            <!-- <a href="#" data-toggle="modal" data-target="#modal-remove" class="item">Supprimer cette fiche</a> -->
            <a href="/dossiers/editer/id/<?=$dossier->id; ?>" class="btn btn-primary btn-rad">Modifier cette fiche</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-container">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#essentiel">L'essentiel</a></li>
                        <li><a data-toggle="tab" href="#complement">Informations complémentaires</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="essentiel" class="tab-pane cont active">


                            <?php if(!$dossier->finished): ?>
                                <div class="alert alert-warning alert-white rounded">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="icon"><i class="fa fa-warning"></i></div>
                                    L'inscription n'a pas encore été finalisée
                                </div>
                            <?php endif; ?>

                            <?php if(!$dossier->supported): ?>
                                <div class="alert alert-warning alert-white rounded">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="icon"><i class="fa fa-warning"></i></div>
                                    L'inscription n'a pas encore été prise en charge
                                </div>
                            <?php endif; ?>


                            <table class="no-border no-strip information">
                                <tbody class="no-border-x no-border-y">

                                    <tr>
                                        <td style="width:19%;padding-top:16px;" class="category"><strong>Les documents</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">

                                                    <?php $inscriptions = inscription::getByDossier($dossier->id); ?>
                                                    <?php if ($dossier->finished): ?>
                                                        <tr>
                                                            <td colspan="2">
                                                                <a href="/pdf/generate/id/<?=$dossier->id?>/type/contrat/" target="_blank" class="btn btn-sm btn-primary">Le contrat</a>
                                                                <a href="/pdf/generate/id/<?=$dossier->id?>/type/convocation/" target="_blank" class="btn btn-sm btn-primary">La convocation</a>
                                                                <a href="/pdf/generate/id/<?=$dossier->id?>/type/dossier/" target="_blank" class="btn btn-sm btn-primary">Le dossier d'inscription</a>
                                                            </td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="2">
                                                               <em>L'inscription doit être finalisé pour pouvoir accéder aux documents.</em>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:19%;" class="category"><strong>L'enfant</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                    <?php $enfant = enfant::get($dossier->ref_enfant); ?>
                                                    <tr>
                                                        <td style="width:20%;">Nom et prénom</td>
                                                        <td><a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></a></td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width: 20%;">Prise en charge :</td>
                                                        <?php $structure_payer = structure::get($dossier->ref_structure_payer); ?>
                                                        <td><?=($dossier->supported) ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 20%;">Centre payeur :</td>
                                                        <?php $structure_payer = structure::get($dossier->ref_structure_payer); ?>
                                                        <td><?=(!empty($structure_payer)) ? '<a href="/structures/infos/id/'.$structure_payer->id.'">'.$structure_payer->name.'</a>':EMPTYVAL; ?></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Le(s) séjour(s)</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">

                                                    <?php foreach($inscriptions as $inscription): ?>
                                                    <?php $sejour = sejour::get($inscription->ref_sejour); ?>
                                                    <?php $date_from = new DateTime($inscription->date_from); ?>
                                                    <?php $date_to = new DateTime($inscription->date_to); ?>
                                                    <tr>
                                                        <td colspan="2"><a href="/sejours/infos/id/<?=$sejour->id; ?>"><?=$sejour->name; ?></a> du <?=strftime("%d %B %Y", $date_from->getTimestamp()) ?> au <?=strftime("%d %B %Y", $date_to->getTimestamp()) ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                            
                        <div id="complement" class="tab-pane cont">
                            <table class="no-border no-strip information">
                                <tbody class="no-border-x no-border-y">

                                    <tr>
                                        <td style="width:19%;" class="category"><strong>Informations</strong></td>
                                        <td>
                                            <table class="no-border no-strip skills">
                                                <tbody class="no-border-x no-border-y">
                                                        <tr>
                                                            <td style="width: 20%;">Pique Nique :</td>
                                                            <td><?=($dossier->pique_nique) ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%;">Sac de couchage :</td>
                                                            <td><?=($dossier->sac) ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>'; ?></td>
                                                        </tr>

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="section-head">
                    <h3>Notes</h3>
                </div>

                <div class="block-flat">
                    <?php $note = trim($dossier->note) ?>
                    <?php if ($dossier->note): ?>
                        <?=$dossier->note; ?>
                    <?php else: ?>
                        <em>Aucune note pour le moment</em>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-3 side-right">

        <div class="block-flat bars-widget">
            <h4>Rendez-vous</h4>
            <address>
                <p><?=$dossier->place; ?></p>
                <strong>Départ :</strong> <?=$dossier->hour_departure; ?> — 
                <strong>Retour </strong>:  <?=$dossier->hour_return; ?>
            </address>
        </div>
    </div>

</div>


<div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-warning"></i></div>
                    <h4>Attention !</h4>
                    <p>
                        Vous êtes sur le point de supprimer le dossier d'inscription <strong>n°<?=$dossier->id?></strong><br>concernant <strong><?=$enfant->firstname; ?> <?=$enfant->lastname; ?></strong>.<br>
                        Êtes-vous sur de vouloir effectuer cette opération ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-remove-dossier" action="/dossiers/" method="post">
                    <a href="#" class="btn btn-default btn-flat" data-dismiss="modal">Annuler</a>
                    <input id="remove-id" type="hidden" name="id" value="<?=$dossier->id;?>">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" class="btn btn-warning btn-flat" value="Supprimer la fiche">
                </form>
            </div>
        </div>
    </div>
</div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>