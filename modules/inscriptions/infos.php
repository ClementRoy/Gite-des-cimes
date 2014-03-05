<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

    <?php $inscription = inscription::get($_GET['id']); ?>
    <?php //tool::output($sejour); ?>
    <?php $creator = user::get($inscription->creator); ?>
    <?php $editor = user::get($inscription->editor); ?>
    <?php $date_created = new DateTime($inscription->created); ?>
    <?php $date_edited = new DateTime($inscription->edited); ?>



    <div class="title">
        <div class="row header">
            <div class="col-md-9">

                <h3><a href="#" class="trigger"><i class="big-icon icon-folder-open"></i></a>
                    Inscription <strong>n°<?=$inscription->id; ?></strong>
                </h3>
                <ul>
                    <li> éditer le contrat, </li>
                    <li>le dossier d'inscription </li>
                    <li>et la convocation.</li>
                </ul>


                <hr />
<h2>Dossier d'inscription</h2>
<pre>

Adressé à : <Structure>  
A l'attention de <NomContact>




DOSSIER D’INSCRIPTION
POUR  NomEnfant PrénomEnfant
 
Madame, Monsieur,
 
Nous avons le plaisir de vous présenter ce dossier d’inscription pour un séjour organisé par le Gîte des Cimes.
Il comprend :
q  Le contrat de séjour
q  La fiche de séjour
q  La fiche sanitaire
q  L'autorisation parentale
q  Un exemple de trousseau
q  Recommandations
 
Ä  Vous devez impérativement fournir les documents ci-dessous :
q  Le contrat de séjour accompagné de l’acompte (ou une prise en charge      financière)
q  La fiche de séjour complétée et signée
q  La fiche sanitaire remplie et la copie du carnet de vaccinations
q  L'autorisation parentale signée
q   Une attestation d’assurance responsabilité civile.
q  La  copie  de l'attestation de CPAM


</pre>


                <hr />
<h2>Contrat d'inscription</h2>
<pre>
    
GITE DES CIMES – CONTRAT D’INSCRIPTION 
Au Séjour de Vacances
Madame, Monsieur,
Nous avons le plaisir de vous faire parvenir ce contrat d’inscription :
GITE DES CIMES / N° organisateur : 060ORG0292
607 rue du Château d’eau - 60123 Bonneuil en Valois  03 44 88 51 13 / gite.cimes@orange.fr

Directeur : Marie Christine Behlouli 06 50 31 22 88
N° d’enregistrement du séjour Multi-activités : 0600292SV001413

LE RESPONSABLE LEGAL EFFECTUANT L’INSCRIPTION
Père                              Mère                         Tuteur     
NOM, Prénom 
Adresse. 

Tel.Dom. 
Structure interlocutrice : Structure - NomContact

ENFANT PARTICIPANT AU SEJOUR
NOM, Prénom. NomEnfant PrénomEnfant
Sexe : M/F    Né (e) le : DateNaissance
DUREE DU SEJOUR et PRIX 
    •   séjour Multi-activités au Gite de Bonneuil en Valois  : Du 15 au 22/02/2014 - Prix  : 440 € / semaine
    •   Prix total des séjours  :  440 € (quatre cent quarante euro)
    •   
    •   Renseignements sur l'organisation des départs – retours : Se reporter à la convocation jointe.
    •   
MODALITES DE RESERVATION :
 Afin d’effectuer la réservation, nous devons avoir reçu avant le départ une prise en charge financière ou un acompte de 30% avec un solde au plus tard 15 jours avant le départ, 1 exemplaire signé du présent contrat, accompagné de tous les documents demandés (cf. article 2 du présent contrat) .

 Vous devez avoir impérativement complété le dossier d’inscription de l'enfant par TOUTES les pièces listées à l’article 2 de ce contrat. En l’absence de l’une de ces pièces, le contrat pourra être considéré comme annulé à l’initiative du responsable légal de l'enfant (cf. article 3-1).

 Le prix du séjour sera réglé par : .


Je soussigné(e) ….............................................................................., Responsable légal, agissant tant pour moi-même que pour le compte du ou des enfant(s) inscrit(s),
Certifie avoir pris connaissance de l’ensemble des conditions générales d’inscription figurant au présent contrat, du projet pédagogique et de la fiche descriptive consultables sur le site internet : www.gite-des-cimes.com et les accepter sans réserve.
Signature du responsable légale du (des) mineur(s)                      Signature du responsable du séjour
Précédée de la mention manuscrite ‘’lu et approuvé’’ 
Fait à .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .                    Fait à . Bonneuil en Valois
Le.   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .                       Le .11/01/2014



</pre>


                <hr />



                    <!--
                    <h4>Capacité du séjour</h4>

                <div class="pop-dialog">
                    <div class="pointer">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <div class="menu">
                            <a href="/inscriptions/editer/id/<?=$inscription->id; ?>" class="item"><i class="icon-edit"></i> Modifier</a>
                            <a href="/inscriptions/supprimer/id/<?=$inscription->id; ?>" class="item" data-toggle="modal"><i class="icon-remove"></i> Supprimer</a>
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

    <div class="content <?=($structure->archived)?' archived':' ';?>">



        <div class="row">
            <div class="col-md-9 bio">

                <!--
                <h4>Capacité du séjour</h4>

                <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="10" style="width: 30%;">
                <span>3</span>
                </div>
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7" style="width: 10%">
                <span>1</span>
                </div>
                <span>10</span>
                </div>
                <div class="row">
                <div class="col-md-6">
                <h4>Enfants participants à ce séjour</h4>
                </div>
                <div class="col-md-6 text-right">
                </div>

                </div>
                -->




            </div>

            <div class="col-md-3 address">

            </div>
        </div>
    </div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>