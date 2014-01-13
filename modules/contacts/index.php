    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
		<div id="pad-wrapper">
            <div class="row header">
                <div class="col-md-3">
                    <h3>Les contacts</h3>
                </div>
                <div class="col-md-9 text-right">
                    <input type="text" id="table-enfant-search" class="col-md-5 search" data-search="contact" placeholder="Tapez le nom d'un contact..." autofocus="autofocus">
                    <a href="/contacts/ajouter" class="btn-flat primary"><span>+</span>
                        Ajouter un contact</a>
                </div>
            </div>

            <?php $contacts = contact::getList(); ?>


            <div class="row">
                <div class="col-md-12">
                    <table id="table-enfant" data-search="contact" class="table table-hover tablesorter extendlink">
                        <thead data-spy="affix" data-offset-top="60" data-offset-bottom="200">
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable"><span class="line"></span>Prénom</th>
                                <th class="sortable"><span class="line"></span>Email</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- row -->

                        <?php foreach($contacts as $key => $contact): ?>
                        <tr>
                            <td>
                                <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->lastname; ?></a>
                            </td>
                            <td>
                                 <a href="/contacts/infos/id/<?=$contact->id; ?>"><?=$contact->firstname; ?></a>
                            </td>
                            <td>
                               <a href="mailto:<?=$contact->email; ?>"><?=$contact->email; ?></a>
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
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>



