<?php 
if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	echo 'Erreur, pas d\'ID';
}
if(isset($_GET['type'])){
	$type = $_GET['type'];
} else {
	echo 'Erreur, pas de type';
	die();
}

$inscription = inscription::getDetails($id);
ob_start(); ?>



<?php if($type == 'contrat'): ?>

	<?php //tool::output($inscription);?>
	<style type="text/css">
		table {
			width: 100%;
			font-size: 14px;
			vertical-align: top;
		}
		td {width: 100%;}
		tr {width: 100%;}
		.title {
			font-weight: bold;
			text-transform: uppercase;
		}
		h1,h2,h3,h4 {
			margin: 0 0 10px;
		}
		h1 {
			margin-bottom: 0;
		}
		h2 {
			font-size: 20px;
			margin-top: 5px;
		}
		h3 {
			margin-top: 20px;
			font-size: 16px;
			margin-bottom: 5px;
		}
		table.special p {
			margin: 5px 0;
		}
		p {
			margin: 7px 0;
		}
		ul {
			margin: 0;
			padding-left: 0;
		}
		ul li {
			margin: 0;
			padding-left: 20px;
		}
	</style>
	<page backtop="2mm" backleft="6mm" backright="6mm" backbottom="0mm">
		<table style="width:100%;">
			<tr style="text-align:center;">
				<td>
					<h1>Gite des cimes - Contrat</h1>
					<h2>Au Séjour de Vacances</h2>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						Madame, Monsieur,<br>
						Nous avons le plaisir de vous faire parvenir ce contrat d’inscription :
					</p>
				</td>
			</tr>
		</table>
		<table class="special" bordercolor="#000000" border="1" CELLPADDING="10" CELLSPACING="0" style="margin-top:5px; height:40px;">
			<tr>
				<td style="width:50%;padding:15px 15px 0;" border="1">
					<h4>GITE DES CIMES / N° organisateur : 060ORG0292</h4>

					<p>
						607 rue du Château d’eau<br>
						60123 Bonneuil en Valois
					</p>
					<p>03 44 88 51 13</p>
					<p>gite.cimes@orange.fr</p>

					<p>Directeur : Marie Christine Behlouli 06 50 31 22 88</p>

					<p>N° d’enregistrement du séjour Multi­activités : 0600292SV001413</p>
				</td>

				<td style="width:50%;padding:15px;" border="1">
					<h4>LE RESPONSABLE LEGAL EFFECTUANT L’INSCRIPTION</h4>
					<p style="width:50%;"><strong>Père :</strong>
						<span style="color:#333;"></span>
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Mère :</strong>
						<span style="color:#333;"></span>
					</p>
					<p><strong>Tuteur :</strong><span style="color:#333;"></span></p>

					<p><strong>NOM, Prénom :</strong><span style="color:#333;"></span></p>

					<p><strong>Adresse :</strong><span style="color:#333;"></span></p>
					<p>

					</p>

					<p><strong>Tél. domicile :</strong><span style="color:#333;"></span></p>
					<p style="margin-bottom:0;"><strong>Structure interlocutrice :</strong><span style="color:#333;"> </span></p>
				</td>
			</tr>
		</table>

		<table style="margin-top:0;">
			<tr>
				<td style="text-align:center;">
					<h3>ENFANT PARTICIPANT AU SEJOUR</h3>
				</td>

			</tr>
			<tr>
				<td>
					<p>
						<strong>NOM : </strong><span style="color:#333;">. . . . . . . . . . . . . . . . . . . . . . . . .</span>
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Prénom : </strong><span style="color:#333;">. . . . . . . . . . . . . . . . . . . . . . . . .</span>
					</p>
					<p>
						<strong>Sexe : M/F</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Né (e) le :</strong><span style="color:#333;">&nbsp;&nbsp; . . . . / . . . . / . . . . . .</span>
					</p>

				</td>

			</tr>
			<tr>
				<td style="text-align:center;">
					<h3>DUREE DU SEJOUR et PRIX</h3>
				</td>

			</tr>
			<tr>
				<td>
					<p style="margin-top:2px;">
						•&nbsp;&nbsp;Séjour Multi-activités au Gite de Bonneuil en Valois : Du 15 au 22/02/2014 - Prix : 440 € / semaine<br>
						•&nbsp;&nbsp;Prix total des séjours : 440 € (quatre cent quarante euro)<br>
						•&nbsp;&nbsp;Renseignements sur l'organisation des départs – retours : Se reporter à la convocation jointe.<br>
					</p>
				</td>


			</tr>

			<tr>
				<td style="text-align:center;">
					<h3>MODALITES DE RESERVATION :</h3>
				</td>
			</tr>
		</table>
		<table bordercolor="#000000" border="1" CELLPADDING="10" CELLSPACING="0" style="margin-top:5px;padding:5px 15px 15px;">
			<tr>
				<td border="0">
					<p><strong>•&nbsp;&nbsp;Afin d’effectuer la réservation, nous devons avoir reçu avant le départ une prise en charge financière ou un acompte de 30% avec un solde au plus tard 15 jours avant le départ,</strong> 1 exemplaire signé du présent contrat, accompagné de tous les documents demandés (cf. article 2 du présent contrat).</p>
					<p><strong>•&nbsp;&nbsp;Vous devez avoir impérativement complété le dossier d’inscription</strong> de l'enfant par <span style="text-decoration:underline;">TOUTES</span> les pièces listées à l’article 2 de ce contrat. En l’absence de l’une de ces pièces, le contrat pourra être considéré comme annulé à l’initiative du responsable légal de l'enfant (cf. article 3­1).</p>
					<p><strong>•&nbsp;&nbsp;Le prix du séjour sera réglé par : </strong><span style="color:#333;">. . . . . . . . . . . . . . .</span></p>
				</td>
			</tr>
		</table>
		<table style="margin-top:3px;">
			<tr>
				<td colspan="2">
					<p>Je soussigné(e)<span style="color:#333;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</span> , responsable légal, agissant tant pour moi­même que pour le compte du ou des enfant(s) inscrit(s),<br>
						<strong>Certifie avoir pris connaissance de l’ensemble des conditions générales d’inscription figurant au présent contrat, du projet pédagogique et de la fiche descriptive consultables sur le site internet : <a href="http://www.gite-des-cimes.com/">www.gite-des-cimes.com</a> et les accepter sans réserve.</strong>

					</p>
				</td>
			</tr>
			<tr>
				<td style="width:60%;padding-top:15px;">
					<p>
						<span style="text-decoration:underline;">Signature du responsable légale du (des) mineur(s)</span><br>
						Précédée de la mention manuscrite "lu et approuvé"
					</p>
					<p>Fait à : <span style="color:#333;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span></p>
					<p>Le : <span style="color:#333;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</span></p>
				</td>
				<td style="width:40%;padding-top:15px;">
					<p><span style="text-decoration:underline;">Signature du responsable du séjour</span></p>
					<p>Fait à : Bonneuil-en-Valois</p>
					<p>Le : 11/01/2014</p>
				</td>
			</tr>
		</table>
	</page>
<?php elseif($type == 'dossier'): ?>

	<style type="text/css">
		table {
			width: 100%;
			font-size: 16px;
			vertical-align: top;
		}
		td {width: 100%;}
		tr {width: 100%;}
		.title {
			font-weight: bold;
			text-transform: uppercase;
		}
		h1,h2,h3,h4 {
			margin: 0 0 10px;
		}
		h1 {
			margin-bottom: 0;
			font-size: 30px;
		}
		h2 {
			font-size: 20px;
			margin-top: 5px;
		}
		h3 {
			margin-top: 20px;
			font-size: 16px;
			margin-bottom: 5px;
		}
		table.special p {
			margin: 5px 0;
		}
		p {
			margin: 7px 0;
		}
		ul {
			margin: 0;
			padding-left: 0;
		}
		ul li {
			margin: 0;
			padding-left: 20px;
		}
	</style>
	<page backtop="6mm" backleft="6mm" backright="6mm" backbottom="0mm">
		<table style="width:100%;">
			<tr style="text-align:right;">
				<td>
					<p>
						Adressé à : <br>
						A l'attention de :
					</p>
				</td>
			</tr>
			<tr style="text-align:center;">
				<td>
					<h1 style="margin-top:100px;">Dossier d'inscription</h1>
					<h2>Pour prénom nom</h2>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:40px;">
						Madame, Monsieur,
					</p>
					<p>
						Nous avons le plaisir de vous présenter ce dossier d’inscription pour un séjour organisé par le Gîte des Cimes.
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:40px;">
						<strong>Il comprend :</strong>
					</p>
					<div style="padding-left:30px;">
						<p>•&nbsp;&nbsp;Le contrat de séjour</p>

						<p>•&nbsp;&nbsp;La fiche de séjour</p>

						<p>•&nbsp;&nbsp;La fiche sanitaire</p>

						<p>•&nbsp;&nbsp;L'autorisation parentale</p>

						<p>•&nbsp;&nbsp;Un exemple de trousseau</p>

						<p>•&nbsp;&nbsp;Recommandations</p>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:40px;">
						<strong>Vous devez <span style="text-decoration:underline;">impérativement</span> fournir les documents ci-dessous :</strong>
					</p>

					<div style="padding-left:30px;">

						<p>•&nbsp;&nbsp;Le contrat de séjour accompagné de l’acompte (ou une prise en charge financière)</p>

						<p>•&nbsp;&nbsp;La fiche de séjour complétée et signée</p>
						<p>•&nbsp;&nbsp;La fiche sanitaire remplie et la copie du carnet de vaccinations</p>

						<p>•&nbsp;&nbsp;L'autorisation parentale signée</p>

						<p>•&nbsp;&nbsp;Une attestation d’assurance responsabilité civile.</p>

						<p>•&nbsp;&nbsp;La copie de l'attestation de CPAM</p>

					</div>

				</td>
			</tr>
		</table>
	</page>

<?php elseif($type == 'convocation'): ?>


	<style type="text/css">
		table {
			width: 100%;
			font-size: 16px;
			vertical-align: top;
		}
		td {width: 100%;}
		tr {width: 100%;}
		.title {
			font-weight: bold;
			text-transform: uppercase;
		}
		h1,h2,h3,h4 {
			margin: 0 0 10px;
		}
		h1 {
			margin-bottom: 0;
			font-size: 30px;
		}
		h2 {
			font-size: 20px;
			margin-top: 5px;
		}
		h3 {
			margin-top: 20px;
			font-size: 16px;
			margin-bottom: 5px;
		}
		table.special p {
			margin: 5px 0;
		}
		p {
			margin: 15px 0;
			line-height: 20px;
		}
		ul {
			margin: 0;
			padding-left: 0;
		}
		ul li {
			margin: 0;
			padding-left: 20px;
		}
		hr {
			border: 1px dashed lightgrey;
			margin: 20px 0;
		}
	</style>
	<page backtop="6mm" backleft="6mm" backright="6mm" backbottom="0mm">
		<table style="width:100%;">
			<tr style="text-align:right;">
				<td>
					<p>
						Adressé à : <br>
						A l'attention de :
					</p>
				</td>
			</tr>
			<tr style="text-align:center;">
				<td>
					<h1 style="margin-top:80px;">Convocation</h1>
					<h2>Pour prénom nom</h2>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:60px;">


						<strong>Nom de l’Enfant :</strong><br>
						Rachid AGUERCIF
					</p>
					<p>
						<strong>Inscrit au Séjour :</strong><br>
						Glisses Vosgiennes — <strong>à</strong> : Cornimont — <strong>du</strong> : 15 au 01/03/2014
					</p>
					<p>
						<strong>Est attendu par notre équipe d’animation :</strong><br>
						Date de départ : 15/02/2014<br>
						Lieu : Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle<br>
						Heure : 8h30
					</p>
					<p>
						<strong>Petit rappel :</strong><br>
						Prévoir le pique nique et amener un sac de couchage
					</p>
					<p>
						<strong>Date de retour :</strong> 01/03/2014<br>
						Lieu : Aulnay sous Bois, au RER, Dépôt Minute, Place du Général de Gaulle<br>
						Heure : 12h
					</p>
					<hr>
					<p style="margin-top:30px;">
						Nous restons à votre disposition pour tous renseignements complémentaires.<br>
						Au plaisir de ces prochaines vacances !<br>
						L’équipe du Gite des Cimes
					</p>
				</td>
			</tr>
		</table>
	</page>
<?php endif; ?>
<?php

$content = ob_get_clean(); 
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->writeHTML($content);
	$pdf->Output('test.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>