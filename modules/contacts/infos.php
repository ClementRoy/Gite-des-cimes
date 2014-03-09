<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


    <?php if(isset($_POST['submit-add'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
        extract($_POST);
        $datas = array(
            ':firstname' => tool::cleanInput($form_contact_firstname),
            ':lastname' => tool::cleanInput($form_contact_lastname),
            ':title' => tool::cleanInput($form_contact_title),
            ':ref_structure' => $form_contact_structure,
            ':civility' => tool::cleanInput($form_contact_civility),
            ':email' => tool::cleanInput($form_contact_email),
            ':phone' => $form_contact_telephone,
            ':mobile_phone' => $form_contact_mobile_phone,
            ':fax' => $form_contact_fax,
            ':note' => $form_contact_note
            );

        $result = contact::update($datas, $_GET['id']);

        ?>

        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        Le contact <strong><?=$form_contact_firstname; ?> <?=$form_contact_lastname; ?></strong> a bien été ajoutée
                    </div>
                    <a href="/contacts/">Retourner à la liste des contacts</a>

                </div>
            </div>
        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant l'ajout de la contact, veuillez réessayer
                    </div>
                    <a href="/contacts/ajouter">Retourner au formulaire d'ajout</a>
                </div>
            </div>
        <?php endif; ?>



    <?php endif; ?>


   <?php if(isset($_POST['submit-update'])): ?>
        <?php //tool::output($_POST); ?>
        <?php //tool::output($_SESSION); ?>
        <?php 
        extract($_POST);
        $datas = array(
            ':firstname' => $form_contact_firstname,
            ':lastname' => $form_contact_lastname,
            ':title' => $form_contact_title,
            ':ref_structure' => $form_contact_structure,
            ':civility' => $form_contact_civility,
            ':email' => $form_contact_email,
            ':phone' => $form_contact_telephone,
            ':mobile_phone' => $form_contact_mobile_phone,
            ':fax' => $form_contact_fax,
            ':note' => $form_contact_note
            );

        $result = contact::update($datas, $_GET['id']);
//tool::output($result);
        ?>

        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        Le contact <?=$form_contact_firstname; ?> <?=$form_contact_lastname ?> a bien été modifée
                    </div>

                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant la modification du contact, veuillez réessayer
                    </div>
                </div>
            </div>
        <?php endif; ?>



    <?php endif; ?>


<?php $contact = contact::get($_GET['id']); ?>
<?php 
if($contact->ref_structure && $contact->ref_structure != 0) {
    $structure = structure::get($contact->ref_structure);
}
?>
<?php 
$enfants = enfant::getByContact($contact->id);
?>
<?php $creator = user::get($contact->creator); ?>
<?php $editor = user::get($contact->editor); ?>
<?php $date_created = new DateTime($contact->created); ?>
<?php $date_edited = new DateTime($contact->edited); ?>

<div class="title">
    <div class="row header">
        <div class="col-md-9">

            <h3><a href="#" class="trigger"><i class="big-icon icon-comments"></i></a>
                <?=$contact->civility; ?> <?=$contact->firstname; ?> <strong><?=$contact->lastname; ?></strong>
                <small><?=$contact->title ?></small>
            </h3>

            <div class="pop-dialog">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <div class="menu">
                        <a href="/contacts/editer/id/<?=$contact->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                        <a href="/contacts/supprimer/id/<?=$contact->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 text-right">
            <div class="col-md-4 text-right pull-right">
                <i class="icon-cog"></i>
            </div>
        </div>
    </div>
</div>

<div class="content <?=($contact->archived)?' archived':' ';?>">


    <div class="row">

        <div class="col-md-12">

            <?php if( isset($contact->email) && !empty($contact->email) ): ?>
                <p><strong>Email</strong> : <a href="mailto:<?=$contact->email ?>"><?=$contact->email ?></a></p>
            <?php endif; ?>  

            <?php if( isset($contact->phone) && !empty($contact->phone) ): ?>
                <p><strong>Téléphone</strong> : <?=$contact->phone ?></p>
            <?php endif; ?>  

            <?php if( isset($contact->mobile_phone) && !empty($contact->mobile_phone) ): ?>
                <p><strong>Téléphone portable</strong> : <?=$contact->mobile_phone ?></p>
            <?php endif; ?>  

            <?php if( isset($contact->fax) && !empty($contact->fax) ): ?>
                <p><strong>Fax</strong> : <?=$contact->fax ?></p>
            <?php endif; ?>  

            <?php if( isset($contact->note) && !empty($contact->note) ): ?>
                <p><strong>Note</strong> : <?=$contact->note ?></p>
            <?php endif; ?>  

            <?php if( isset($contact->structure) && !empty($contact->structure) ): ?>
                <p><strong>Structure</strong> : <a href="/structures/infos/id/<?=$structure->id ?>"><?=$structure->name ?></a></p>
            <?php endif; ?>                
        </div>


    </div>

    <?php if(count($enfants) > 0): ?>
        <div class="row">
            <h4>Les enfants affiliés</h4>

            <table class="table table-hover extendlink">
                <thead>
                    <tr>
                        <th class="col-md-1">Prénom</th>
                        <th class="col-md-3"><span class="line"></span>Nom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($enfants as $enfant): ?>
                        <tr>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->firstname ?></a>
                            </td>
                            <td>
                                <a href="/enfants/infos/id/<?=$enfant->id ?>"><?=$enfant->lastname ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>



    <?php //tool::output($structure); ?>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>