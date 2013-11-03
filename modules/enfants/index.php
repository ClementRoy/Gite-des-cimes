    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
    <?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
    <?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">

            <h2>Les enfants</h2>

            <div class="table-wrapper orders-table">


                <div class="row filter-block">
                    <div class="pull-right">
                        <div class="ui-select">
                            <select>
                                <option>Filter users</option>
                                <option>Signed last 30 days</option>
                                <option>Active users</option>
                            </select>
                        </div>
                        <input type="text" id="query" class="search order-search" placeholder="Tapez votre recherche ici..." onkeyup="sorter.search('query')">
                    </div>
                </div>





                <div class="row">
                    <table id="children" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="asc">Prénom <i class="pull-right icon-sort"></i></th>
                                <th class="head">Nom <i class="pull-right icon-sort"></i></th>
                                <th class="head">Sexe <i class="pull-right icon-sort"></i></th>
                                <th class="head">Date de naissance <i class="icon-sort"></i></th>
                                <th class="head">Age <i class="icon-sort"></i></th>
                                <th class="head">Structure/Tuteur <i class="icon-sort"></i></th>
                                <th class="unsort">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Christophe</td>
                                <td>Béghin</td>
                                <td><i class="icon-male"></i> Garçon</td>
                                <td>02/01/1990</td>
                                <td>23 ans</td>
                                <td>-</td>
                                <td>actions...</td>
                            </tr>
                            <tr>
                                <td>Clément</td>
                                <td>Roy</td>
                                <td><i class="icon-male"></i> Garçon</td>
                                <td>02/05/1990</td>
                                <td>23 ans</td>
                                <td>-</td>
                                <td>actions...</td>
                            </tr>
                            <tr>
                                <td>Nedjma</td>
                                <td>Behlouli</td>
                                <td><i class="icon-female"></i> Fille</td>
                                <td>01/12/1989</td>
                                <td>23 ans</td>
                                <td>-</td>
                                <td>actions...</td>
                            </tr>
                            <tr>
                                <td>Coraline</td>
                                <td>Assimon</td>
                                <td><i class="icon-female"></i> Fille</td>
                                <td>23/04/1989</td>
                                <td>24 ans</td>
                                <td>-</td>
                                <td>actions...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div><!-- /.container -->
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/scripts.php'); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>