<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

   <?php if(isset($_POST['submit-add'])): ?>
        <?php  

        extract($_POST);

        $datas = array(
            ':finished' => $form_inscription_option,
            ':ref_enfant' => $form_inscription_enfant,
            ':ref_structure_payer' => $form_inscription_structure,
            ':structure_payer' => $form_inscription_structure_name,
            ':supported' => $form_inscription_supported,
            ':note' => $form_inscription_note,
            ':place' => $form_inscription_lieu,
            ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
            ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
            ':pique_nique' => $form_inscription_pique_nique,
            ':sac' => $form_inscription_sac
        );

        $result = dossier::update($datas, $_GET['id']);

        foreach($form_inscription_sejour as $key => $inscription_entry){

            $dates = explode('#', $dates[$key]);
            $form_inscription_date_debut = tool::generateDatetime($dates[0]);
            $form_inscription_date_fin = tool::generateDatetime($dates[1]);
            $datas = array(
                ':ref_enfant' => $form_inscription_enfant,
                ':ref_sejour' => $form_inscription_sejour[$key],
                ':ref_dossier' => $id,
                ':date_from' => $form_inscription_date_debut,
                ':date_to' => $form_inscription_date_fin
            );
            $result = inscription::add($datas);
        }

        ?>
        <?php //tool::output($_POST); ?>
        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        L'inscription de <strong><?=$form_inscription_enfant; ?></strong> au séjour <strong></strong> a bien été ajoutée
                    </div>
                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant la création de l'inscription, veuillez réessayer
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>



    <?php if(isset($_POST['submit-update'])): ?>
        <?php  
//tool::output($_POST);
        extract($_POST);
        $form_inscription_date_debut = tool::generateDatetime($form_inscription_date_debut);
        $form_inscription_date_fin = tool::generateDatetime($form_inscription_date_fin);

        $datas = array(
            ':ref_sejour' => $form_inscription_sejour,
            ':finished' => $form_inscription_option,
            ':ref_enfant' => $form_inscription_enfant,
            ':date_from' => $form_inscription_date_debut,
            ':date_to' => $form_inscription_date_fin,
            ':ref_structure_payer' => $form_inscription_structure,
            ':structure_payer' => $form_inscription_structure_name,
            ':supported' => $form_inscription_supported,
            ':note' => $form_inscription_note,
            ':place' => $form_inscription_lieu,
            ':hour_departure' => $form_inscription_heure_aller.'h'.$form_inscription_min_aller,
            ':hour_return' => $form_inscription_heure_retour.'h'.$form_inscription_min_retour,
            ':pique_nique' => $form_inscription_pique_nique,
            ':sac' => $form_inscription_sac
            );

        $result = dossier::update($datas, $_GET['id']);

        ?>
        <?php //tool::output($_POST); ?>
        <?php if($result): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> 
                        Le dossier d'inscription de <strong><?=$form_inscription_enfant; ?></strong> au séjour <strong></strong> a bien été modifiée
                    </div>
                    <a href="/folders/">Retourner à la liste des dossiers d'inscription</a>
                </div>
            </div>

        <?php else: ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i> 
                        Une erreur s'est produite durant la modification de l'inscription, veuillez réessayer
                    </div>
                    <a href="/folders/edit/id/<?=$inscription->id ?>">Retourner au formulaire de modification</a>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>


    <?php $dossier = dossier::get($_GET['id']); ?>
    <?php tool::output($dossier); ?>
    <?php $creator = user::get($dossier->creator); ?>
    <?php $editor = user::get($dossier->editor); ?>
    <?php $date_created = new DateTime($dossier->created); ?>
    <?php $date_edited = new DateTime($dossier->edited); ?>



    <div class="title">
        <div class="row header">
            <div class="col-md-9">

                <h3><a href="#" class="trigger"><i class="big-icon icon-folder-open"></i></a>
                    Inscription <strong>n°<?=$dossier->id; ?></strong>
                </h3>
                <ul>
                    <li> éditer le contrat, </li>
                    <li>le dossier d'inscription </li>
                    <li>et la convocation.</li>
                </ul>

<?php // Get enfantInfos by inscription id, (on a déjà l'id de l'enfant) ?>
                <hr />
<h2>Dossier d'inscription</h2>

<pre>

Adressé à : <?=$inscription->name; ?>  
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
<a href="/pdf/generate/id/<?=$dossier->id?>/type/contrat/">Contrat</a>
<a href="/pdf/generate/id/<?=$dossier->id?>/type/convocation/">Convocation</a>
<a href="/pdf/generate/id/<?=$dossier->id?>/type/dossier/">Dossier d'inscription</a>

            </div>

            <div class="col-md-3 address">

            </div>
        </div>
    </div>



<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>