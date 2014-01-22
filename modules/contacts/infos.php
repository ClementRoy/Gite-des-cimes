    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>

    
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


  

    <!-- main container -->
    <div class="content">
      <div id="pad-wrapper" class="users-profil">
        <div class="row header icon">
            <div class="col-md-5">
                <a href="#" class="trigger"><i class="big-icon icon-comments"></i></a>
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
                <h3><?=$contact->civility; ?> <?=$contact->firstname; ?> <?=$contact->lastname; ?><small><?=$contact->title ?></small></h3>
            </div>
            <div class="col-md-5 text-right pull-right">
       
            </div>
        </div>
  

        <?php //tool::output($contact); ?>

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

</div>
</div><!-- /.container -->

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>