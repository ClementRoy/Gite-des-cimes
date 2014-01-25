    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">

            <div class="row header">
                <div class="col-md-4">
                    <h3>Les enfants</h3>
                </div>
                <div class="col-md-8 text-right">
                    <a href="/enfants/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter un enfant</a>
                </div>
            </div>

            <?php $enfants = enfant::getList(); ?>                      

            <div class="row">
                <div class="col-md-12">

                   <table class="datatable">
                        <thead>
                            <tr>
                                <th tabindex="0" rowspan="1" colspan="1">Prénom</th>
                                <th tabindex="0" rowspan="1" colspan="1">Nom</th>
                                <th tabindex="0" rowspan="1" colspan="1">Sexe</th>
                                <th tabindex="0" rowspan="1" colspan="1">Statut de la fiche</th>
                                <th tabindex="0" rowspan="1" colspan="1">Date de naissance</th>
                                <th tabindex="0" rowspan="1" colspan="1">Age</th>
                            </tr>

                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th tabindex="0" rowspan="1" colspan="1">Prénom</th>
                                <th tabindex="0" rowspan="1" colspan="1">Nom</th>
                                <th tabindex="0" rowspan="1" colspan="1">Sexe</th>
                                <th tabindex="0" rowspan="1" colspan="1">Statut de la fiche</th>
                                <th tabindex="0" rowspan="1" colspan="1">Date de naissance</th>
                                <th tabindex="0" rowspan="1" colspan="1">Age</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($enfants as $key => $enfant): ?>
                        <tr class="">
                                <td>
                                    <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->firstname; ?></a>
                                <div class="pop-dialog tr">
                                    <div class="pointer">
                                        <div class="arrow"></div>
                                        <div class="arrow_border"></div>
                                    </div>
                                    <div class="body">
                                        <div class="menu">
                                            <a href="/enfants/infos/id/<?=$enfant->id; ?>" class="item"><i class="icon-share"></i> Voir la fiche</a>
                                            <a href="/enfants/editer/id/<?=$enfant->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                                            <a href="/enfants/supprimer/id/<?=$enfant->id; ?>" class="item"><i class="icon-remove"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </div>                                     
                                </td>
                                <td>
                                     <a href="/enfants/infos/id/<?=$enfant->id; ?>"><?=$enfant->lastname; ?></a>
                                </td>
                                <td>
                                    <?=($enfant->sex == 'féminin') ? '<i class="icon-female"></i> Féminin' : '<i class="icon-male"></i> Masculin'; ?>
                                </td>
                                <td>  
                                    <?php if( !empty($enfant->number_ss) && !empty($enfant->self_assurance) && !empty($enfant->cpam_attestation) && !empty($enfant->self_assurance_expiration_date) && !empty($enfant->health_record) && !empty($enfant->vaccination) ): ?>
                                    <span class="label label-success">Complète</span> 
                                    <?php else: ?>
                                    <span class="label label-warning">Incomplète</span> 
                                    <?php endif; ?>  
                                </td>
                                <td>
                                    <?php 
                                        // http://net.tutsplus.com/tutorials/php/dates-and-time-the-oop-way/?search_index=27
                                        $birthdate = new DateTime($enfant->birthdate); 
                                    ?>
                                    <?php if($birthdate->getTimestamp() != '-62169984561'): ?>
                                        <?=strftime('%d/%m/%Y', $birthdate->getTimestamp()); ?>
                                    <?php else: ?>
                                        <?php echo EMPTYVAL; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($birthdate->getTimestamp() != '-62169984561'): ?>
                                        <?=tool::getAgeFromDate($enfant->birthdate); ?> ans
                                    <?php else: ?>
                                        <?php echo EMPTYVAL; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>                
            </div>

            <!-- end users table -->
        </div>
    </div><!-- /.container -->

    <script>
        $(document).ready(function(){


        });
    </script>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



