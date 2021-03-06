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

$dossier = dossier::getDetails($id);
$inscriptions = inscription::getByDossier($id);
ob_start(); ?>



<?php if($type == 'contrat'): ?>
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
		<table class="special" bordercolor="#000000" border="1" cellpadding="0" cellspacing="0" style="margin-top:5px; height:40px;">
			<tr>
				<td style="width:50%;padding:15px 15px 0;" cellpadding="0" border="1">
					<h4><!-- GITE DES CIMES /  -->N° organisateur : 060ORG0292</h4>

					<p style="margin:5px 0;">
						607 rue du Château d’eau<br>
						60123 Bonneuil en Valois
					</p>
					<p style="margin:5px 0;"><strong>Contact :</strong> 03 44 88 51 13 - <a href="mailto:gite.cimes@orange.fr">gite.cimes@orange.fr</a></p>
					
					<?php $directors = array(); ?>
					<p><strong>Directeur(s) de séjour(s) :</strong><br />
					<?php foreach ($inscriptions as $key => $inscription): ?>
						<?php $ref_accompagnateur = accompagnateur::getBySejour($inscription->ref_sejour); ?>
						<?php if(!empty($ref_accompagnateur) && !in_array($ref_accompagnateur->ref_accompagnateur, $directors)): ?>
							<?php $directors[] = $ref_accompagnateur->ref_accompagnateur; ?>
							<?php if(!empty($ref_accompagnateur)): ?>
								<?php $accompagnateur = accompagnateur::get($ref_accompagnateur->ref_accompagnateur); ?>
								<?=$accompagnateur->lastname ?> <?=$accompagnateur->firstname ?> - <?=tool::formatTel($accompagnateur->tel) ?><br />
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach ?>
					</p>

					<p style="margin-bottom:0;">
					<strong>N° d’enregistrement du ou des séjours :</strong></p>
					<?php $numero_sejour = ''; ?>
					<?php $hebergement_sejour = ''; ?>
					<?php foreach ($inscriptions as $key => $inscription): ?>
						<?php $sejour = sejour::get($inscription->ref_sejour); ?>
						<?php $hebergement = hebergement::get($sejour->ref_hebergement); ?>

						<?php if ( $sejour->ref_hebergement !== $hebergement_sejour || $sejour->numero !== $numero_sejour ): ?>
								<?php $hebergement = hebergement::get($sejour->ref_hebergement); ?>
								<p style="margin:3px 0 0;">
								<?php echo $sejour->numero; ?> - <?php echo $hebergement->name.', '.$hebergement->address_postal_code.' '.$hebergement->address_city; ?>
								</p>
							<?php $numero_sejour = $sejour->numero; ?>
							<?php $hebergement_sejour = $sejour->ref_hebergement; ?>
						<?php endif; ?>
					<?php endforeach ?>
				</td>
				<td style="width:50%;padding:15px 15px 5px;" border="1">
					<h4>LE RESPONSABLE LEGAL EFFECTUANT L’INSCRIPTION</h4>
					
					<?php if ($dossier->guardian == 'parents'): ?>
						<p><strong>Responsable légal : </strong> Parents </p>
						<p>
							<strong>NOM, Prénom : </strong> <?=$dossier->mother_name; ?><br>
							<strong>NOM, Prénom : </strong> <?=$dossier->father_name; ?>
						</p>
						<p>
							<strong>Adresse : </strong>
							<?=$dossier->father_address_number; ?>
							<?=$dossier->father_address_street; ?>,<br>
							<?=$dossier->father_address_postal_code; ?>
							<?=$dossier->father_address_city; ?>
						</p>
						<p><strong>Tél. domicile : </strong><?=tool::formatTel($dossier->father_phone_home); ?></p>
					<?php elseif ($dossier->guardian == 'mere'): ?>
						<p><strong>Responsable légal : </strong> Mère </p>
						<p><strong>NOM, Prénom : </strong> <?=$dossier->mother_name; ?></p>
						<p>
							<strong>Adresse : </strong>
							<?=$dossier->mother_address_number; ?>
							<?=$dossier->mother_address_street; ?>,<br>
							<?=$dossier->mother_address_postal_code; ?>
							<?=$dossier->mother_address_city; ?>
						</p>
						<p><strong>Tél. domicile : </strong><?=tool::formatTel($dossier->mother_phone_home); ?></p>
					<?php elseif ($dossier->guardian == 'pere'): ?>
						<p><strong>Responsable légal : </strong> Père </p>
						<p><strong>NOM, Prénom : </strong> <?=$dossier->father_name; ?></p>
						<p>
							<strong>Adresse : </strong>
							<?=$dossier->father_address_number; ?>
							<?=$dossier->father_address_street; ?>,<br>
							<?=$dossier->father_address_postal_code; ?>
							<?=$dossier->father_address_city; ?>
						</p>
						<p><strong>Tél. domicile : </strong><?=tool::formatTel($dossier->father_phone_home); ?></p>
					<?php elseif ($dossier->guardian == 'structure'): ?>
						<?php 
						$structure = structure::get($dossier->organization);
						$contact = contact::get($dossier->contact);
						?>
						<?php if(tool::check($structure)): ?>
							<p><strong>Responsable légal : </strong> Structure </p>
							<p><strong>NOM : </strong> <?=$structure->name; ?></p>
							<p>
								<strong>Adresse : </strong>
								<?=$structure->address_number; ?>
								<?=$structure->address_street; ?>,<br>
								<?php if (!empty($structure->address_comp)): ?>
									<?=$structure->address_comp; ?><br>
								<?php endif; ?>
								<?=$structure->address_postal_code; ?>
								<?=$structure->address_city; ?>
							</p>
							<p><strong>Tél. domicile : </strong><?=tool::formatTel($structure->phone); ?></p>
						<?php else: ?>
							<p><strong>Responsable légal : </strong> Structure </p>
							<p><strong>NOM : </strong></p>
							<p>
								<strong>Adresse : </strong>
								<br>
							</p>
							<p><strong>Tél. domicile :</strong></p>
						<?php endif; ?>
					<?php elseif ($dossier->guardian == 'tuteur'): ?>
						<p><strong>Responsable légal : </strong> Tuteur </p>
						<p><strong>NOM, Prénom : </strong> <?=$dossier->guardian_name; ?></p>
						<p>
							<strong>Adresse : </strong>
							<?=$dossier->guardian_address_number; ?>
							<?=$dossier->guardian_address_street; ?>,<br>
							<?=$dossier->guardian_address_postal_code; ?>
							<?=$dossier->guardian_address_city; ?>
						</p>
						<p><strong>Tél. domicile : </strong><?=tool::formatTel($dossier->guardian_phone_home); ?></p>

					<?php else: ?>

						<p><strong>Responsable légal : </strong></p>
						<p>
							<strong>NOM, Prénom :</strong> <br>
						</p>
						<p>
							<strong>Adresse : </strong>
							<br>
							<br>
						</p>
						<p><strong>Tél. domicile : </strong></p>

					<?php endif; ?>
					<?php 
						$structure = structure::get($dossier->organization);
						$contact = contact::get($dossier->contact);
					?>
					<p style="margin-bottom:0;">
					<strong>Structure interlocutrice : </strong><br>
					<?php if (!empty($structure->name)): ?>
					<?=$structure->name; ?> - <?=$contact->civility; ?> <?=$contact->lastname; ?> <?=$contact->firstname; ?>
					<?php endif ?>
					</p>
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

					<table style="width:100%;">
						<tr>
							<td style="width:50%;"><strong>NOM, Prénom : </strong> <?=$dossier->lastname; ?> <?=$dossier->firstname; ?></td>
							<td style="width:20%;"><strong>Sexe : </strong><?=ucfirst($dossier->sex); ?></td>
							<td style="width:30%;">
								<strong>Né (e) le : </strong>
						<?php $birthdate = new DateTime($dossier->birthdate); ?>
						<?php if($birthdate->getTimestamp() > '-62169984560'): ?>
							<?=strftime('%d %B %Y', $birthdate->getTimestamp()); ?>
						<?php endif; ?>
							</td>
						</tr>
					</table>




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
					<?php $price = 0; ?>
					<?php $sejours_temp = array(); ?>
					<?php $sejour_index = 0; ?>
					<?php foreach ($inscriptions as $key => $inscription):
						$sejour = sejour::get($inscription->ref_sejour);

						$hebergement = hebergement::get($sejour->ref_hebergement);
						$price = $price+$sejour->price;
						
						$date_from = new DateTime($inscription->date_from);
						if($date_from->getTimestamp() != '-62169987600'):
							$date_from = strftime('%d/%m/%Y', $date_from->getTimestamp());
						endif;

						$date_to = new DateTime($inscription->date_to);
						if($date_to->getTimestamp() != '-62169987600'):
							$date_to = strftime('%d/%m/%Y', $date_to->getTimestamp());
						endif; 

						$temp = array($sejour->numero, $sejour->name, $hebergement->name, $hebergement->address_postal_code, $hebergement->address_city, $date_from, $date_to, $sejour->price );

						if ( !empty( $sejours_temp ) ) {
							if ( $sejours_temp[$sejour_index-1][0] == $temp[0] && $sejours_temp[$sejour_index-1][6] == $temp[5] && $sejours_temp[$sejour_index-1][1] == $temp[1] ) {
								$sejours_temp[$sejour_index-1] = array( $sejour->numero, $sejour->name, $hebergement->name, $hebergement->address_postal_code, $hebergement->address_city, $sejours_temp[$sejour_index-1][5], $date_to, $sejour->price+$sejours_temp[$sejour_index-1][7] );
							} else {
								array_push( $sejours_temp, $temp );
								$sejour_index++;
							}
						} else {
							array_push( $sejours_temp, $temp );
							$sejour_index++;
						}

						
						
					
					?>
					<?php endforeach; ?>
					<?php foreach ($sejours_temp as $key => $sejour_temp): ?>
					•&nbsp;&nbsp;Séjour <?=($sejour_temp[1] == 'Séjours courts') ? 'court' : $sejour_temp[1] ; ?> - <?=$sejour_temp[2];?> <!--(<?=$sejour_temp[3];?> <?=$sejour_temp[4];?>) -->: Du <?=$sejour_temp[5];?> au <?=$sejour_temp[6];?> - Prix&nbsp;: <?=$sejour_temp[7];?>&nbsp;€<br> 
					<?php endforeach; ?>

					•&nbsp;&nbsp;Prix total des séjours : <?=$price ?> €<br>
					•&nbsp;&nbsp;Renseignements sur l'organisation des départs – retours : Se reporter à la convocation jointe.<br>

				</p>
			</td>


		</tr>

		<tr>
			<td style="text-align:center;">
				<h3>MODALITES DE RESERVATION : </h3>
			</td>
		</tr>
	</table>
	<table bordercolor="#000000" border="1" CELLPADDING="10" CELLSPACING="0" style="margin-top:5px;padding:5px 15px 15px;">
		<tr>
			<td border="0">
				<p><strong>•&nbsp;&nbsp;Afin d’effectuer la réservation, nous devons avoir reçu avant le départ une prise en charge financière ou un acompte de 30% avec un solde au plus tard 15 jours avant le départ,</strong> 1 exemplaire signé du présent contrat, accompagné de tous les documents demandés (cf. article 2 du présent contrat).</p>
				<p><strong>•&nbsp;&nbsp;Vous devez avoir impérativement complété le dossier d’inscription</strong> de l'enfant par <span style="text-decoration:underline;">TOUTES</span> les pièces listées à l’article 2 de ce contrat. En l’absence de l’une de ces pièces, le contrat pourra être considéré comme annulé à l’initiative du responsable légal de l'enfant (cf. article 3­.1).</p>
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
				<p>Le : 
					<?php $date = new DateTime(); ?>
					<?php if($date->getTimestamp() != '-62169987600'): ?>
						<?=strftime('%d/%m/%Y', $date->getTimestamp()); ?>
					<?php endif; ?>
				</p>
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
	<page backtop="6mm" backleft="12mm" backright="12mm" backbottom="0mm">
		
		<?php $structure = structure::get($dossier->organization); ?>
		<?php $contact = contact::get($dossier->contact); ?>
		<table style="width:100%;">
			<tr style="text-align:right;">
				<td>
					<?php if ($dossier->registration_by == 'structure'): ?>
						<?php if(tool::check($structure)): ?>
						<p>
							<strong>Adressé à :</strong> <?=$structure->name; ?><br>
							<strong>A l'attention de :</strong> <?=$contact->civility; ?> <?=$contact->lastname; ?> <?=$contact->firstname; ?><br>
							<strong>Fax :</strong> <?=tool::formatTel($structure->fax); ?>
						</p>
						<?php endif; ?>
					<?php else: ?>

						<?php if ($dossier->guardian == 'parents'): ?>
							<p>
								A l'attention de : <?=$dossier->mother_name; ?> & <?=$dossier->father_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'mere'): ?>
							<p>
								A l'attention de : <?=$dossier->mother_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'father'): ?>
							<p>
								A l'attention de : <?=$dossier->father_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'tuteur'): ?>
							<p>
								A l'attention de : <?=$dossier->guardian_name; ?>
							</p>
						<?php endif; ?>

					<?php endif ?>
				</td>
			</tr>
			<tr style="text-align:center;">
				<td>
					<h1 style="margin-top:100px;">Dossier d'inscription</h1>
					<h2>Pour <?=$dossier->firstname;?> <?=$dossier->lastname;?></h2>
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
						<strong>Il comprend : </strong>
					</p>
					<div style="padding-left:30px;">
						<p>•&nbsp;&nbsp;Le contrat de séjour</p>
						<p>•&nbsp;&nbsp;La convocation</p>
						<?php if (!$dossier->stay_record): ?>
							<p>•&nbsp;&nbsp;La fiche de séjour</p>
						<?php endif ?>
						<?php if (!$dossier->health_record): ?>
							<p>•&nbsp;&nbsp;La fiche sanitaire</p>
						<?php endif ?>
						<?php if (!$dossier->image_rights): ?>
						<p>•&nbsp;&nbsp;L'autorisation parentale</p>
						<?php endif ?>

						<p>•&nbsp;&nbsp;Un exemple de trousseau</p>

						<p>•&nbsp;&nbsp;Recommandations</p>

					</div>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:40px;">
						<strong>Vous devez <span style="text-decoration:underline;">impérativement</span> fournir les documents ci-dessous : </strong>
					</p>

					<div style="padding-left:30px;">

						<p>•&nbsp;&nbsp;Le contrat de séjour accompagné de l’acompte (ou une prise en charge financière)</p>
						
						<?php if (!$dossier->stay_record): ?>
							<p>•&nbsp;&nbsp;La fiche de séjour complétée et signée</p>
						<?php endif ?>

						<?php if (!$dossier->health_record): ?>
							<p>•&nbsp;&nbsp;La fiche sanitaire remplie</p>
						<?php endif ?>

						<?php if (!$dossier->vaccination): ?>
							<p>•&nbsp;&nbsp;La copie du carnet de vaccination</p>
						<?php endif ?>

						<?php if (!$dossier->image_rights): ?>
							<p>•&nbsp;&nbsp;L'autorisation parentale signée</p>
						<?php endif ?>


						<?php $self_assurance_expiration_date = new DateTime($dossier->self_assurance_expiration_date); ?>
						<?php $self_assurance_expiration_date = $self_assurance_expiration_date->getTimestamp(); ?>

						<?php $date = new DateTime(); ?>
						<?php $date = $date->getTimestamp(); ?>

						<?php $inscriptions = inscription::getByDossier($id); ?>
						<?php $date_max_inscription = 0; ?>

						<?php foreach ($inscriptions as $key => $inscription) {
							$date_to = new DateTime($inscription->date_to);
							$date_to = $date_to->getTimestamp();

							if ($date_to > $date_max_inscription) {
								$date_max_inscription = $date_to;
							}
						} ?>

						<?php if ($dossier->self_assurance != 1 || $self_assurance_expiration_date < $date_max_inscription): ?>
							<p>•&nbsp;&nbsp;Une attestation d’assurance responsabilité civile.</p>
						<?php endif ?>

						<?php $cpam_attestation_expiration_date = new DateTime($dossier->cpam_attestation_expiration_date); ?>
						<?php $cpam_attestation_expiration_date = $cpam_attestation_expiration_date->getTimestamp(); ?>


						<?php if ($dossier->cpam_attestation != 1 || $cpam_attestation_expiration_date < $date_max_inscription): ?>
							<p>•&nbsp;&nbsp;La copie de l'attestation de CPAM</p>
						<?php endif ?>

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
	<page backtop="6mm" backleft="12mm" backright="12mm" backbottom="0mm">
		<?php $structure = structure::get($dossier->organization); ?>
		<?php $contact = contact::get($dossier->contact); ?>
		<table style="width:100%;">
			<tr style="text-align:right;">
				<td>
					<?php if ($dossier->registration_by == 'structure'): ?>
						<?php if(tool::check($structure)): ?>
						<p>
							<strong>Adressé à :</strong> <?=$structure->name; ?><br>
							<strong>A l'attention de :</strong> <?=$contact->civility; ?> <?=$contact->lastname; ?> <?=$contact->firstname; ?><br>
							<strong>Fax :</strong> <?=tool::formatTel($structure->fax); ?>
						</p>
						<?php endif; ?>
					<?php else: ?>

						<?php if ($dossier->guardian == 'parents'): ?>
							<p>
								A l'attention de : <?=$dossier->mother_name; ?> & <?=$dossier->father_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'mere'): ?>
							<p>
								A l'attention de : <?=$dossier->mother_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'father'): ?>
							<p>
								A l'attention de : <?=$dossier->father_name; ?>
							</p>
						<?php elseif ($dossier->guardian == 'tuteur'): ?>
							<p>
								A l'attention de : <?=$dossier->guardian_name; ?>
							</p>
						<?php endif; ?>

					<?php endif ?>
				</td>
			</tr>
			<tr style="text-align:center;">
				<td>
					<h1 style="margin-top:80px;">Convocation</h1>
					<h2>Pour <?=$dossier->firstname;?> <?=$dossier->lastname;?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<p style="margin-top:60px;">
						<strong>Inscrit au(x) Séjour(s) : </strong><br>

						<?php $sejours_temp = array(); ?>
						<?php $sejour_index = 0; ?>

						<?php foreach ($inscriptions as $key => $inscription):
							$sejour = sejour::get($inscription->ref_sejour);

							$hebergement = hebergement::get($sejour->ref_hebergement);
							
							$date_from = new DateTime($inscription->date_from);
								if($date_from->getTimestamp() != '-62169987600'):
								$date_from = strftime('%d/%m/%Y', $date_from->getTimestamp());
							endif;

							$date_to = new DateTime($inscription->date_to);
								if($date_to->getTimestamp() != '-62169987600'):
								$date_to = strftime('%d/%m/%Y', $date_to->getTimestamp());
							endif; 

							$temp = array($sejour->numero, $sejour->name, $hebergement->name, $hebergement->address_postal_code, $hebergement->address_city, $date_from, $date_to);							

							if (!empty($sejours_temp)) {
								if ($sejours_temp[$sejour_index-1][0] == $temp[0] && $sejours_temp[$sejour_index-1][6] == $temp[5]) {
									$sejours_temp[$sejour_index-1] = array($sejour->numero, $sejour->name, $hebergement->name, $hebergement->address_postal_code, $hebergement->address_city, $sejours_temp[$sejour_index-1][5], $date_to);
								} else {
									array_push($sejours_temp, $temp);
									$sejour_index++;
								}
							} else {
								array_push($sejours_temp, $temp);
								$sejour_index++;
							}
							
						
							?>
						<?php endforeach; ?>
						<?php //tool::output($sejours_temp); ?>
					<?php foreach ($sejours_temp as $key => $sejour_temp): ?>
							<?=ucfirst($sejour_temp[1]);?> - <?=$sejour_temp[3];?> <?=$sejour_temp[4];?>, <?=$sejour_temp[2];?> - <strong>du</strong> : <?=$sejour_temp[5];?> au <?=$sejour_temp[6];?><br>
					<?php endforeach; ?>


				</p>
					
						<p>
						<?php if($sejours_temp[0][1] == 'Séjours courts'): ?>
							<?php $dates_depart = inscription::getDatesDeparture($id); ?>
							<strong>Dates de départ :</strong> les vendredis
							<?php foreach($dates_depart as $key => $date_depart): ?>
								<?php $date_depart = new DateTime($date_depart->date_from); ?>
									 <?=strftime('%d/%m/%Y', $date_depart->getTimestamp()); ?>
									 <?php if($key < count($dates_depart)-1): ?>
									 <?=($key < count($dates_depart)-2 )?',':'et'; ?>
									<?php endif; ?>
							<?php endforeach; ?>
							<br>
						<?php else: ?>
							<?php $date_depart = inscription::getDateDeparture($id); ?>
							<?php $date_depart = new DateTime($date_depart->date_departure); ?>
							<?php if($date_depart->getTimestamp() != '-62169987600'): ?>
								<?php $date_depart = strftime('%d/%m/%Y', $date_depart->getTimestamp()); ?>
							<?php endif; ?>
							<strong>Date de départ :</strong> <?=$date_depart; ?><br>
						<?php endif; ?>
						Lieu : <?=$dossier->place; ?><br>
						Heure : <?=$dossier->hour_departure; ?>
						</p>

					<?php if ($dossier->pique_nique || $dossier->sac): ?>
					<p>
						<strong>Petit rappel : </strong><br>
						<?php if ($dossier->pique_nique): ?>
							•&nbsp;&nbsp;Prévoir le pique nique.<br>
						<?php endif ?>
						<?php if ($dossier->sac): ?>
							•&nbsp;&nbsp;Amener un sac de couchage.
						<?php endif ?>
					</p>
					<?php endif ?>

						<p>
						<?php if($sejours_temp[0][1] == 'Séjours courts'): ?>
							<?php $dates_retour = inscription::getDatesReturn($id); ?>

							<strong>Dates de retour :</strong> les dimanches
							<?php foreach($dates_retour as $key => $date_retour): ?>
								<?php $date_retour = new DateTime($date_retour->date_to); ?>
									 <?=strftime('%d/%m/%Y', $date_retour->getTimestamp()); ?>
									 <?php if($key < count($dates_retour)-1): ?>
									 	<?=($key < count($dates_retour)-2 )?',':'et'; ?>
									<?php endif; ?>
							<?php endforeach; ?>
							<br>
						<?php else: ?>
							<?php $date_retour = inscription::getDateReturn($id); ?>
							<?php $date_retour = new DateTime($date_retour->date_return); ?>
							<?php if($date_retour->getTimestamp() != '-62169987600'): ?>
							<?php $date_retour = strftime('%d/%m/%Y', $date_retour->getTimestamp()); ?>
							<?php endif; ?>
							
							<strong>Date de retour :</strong> <?=$date_retour; ?><br>
						<?php endif; ?>
						Lieu : <?=$dossier->place; ?><br>
						Heure : <?=$dossier->hour_return; ?>
						</p>



					<hr>
					<p style="margin-top:30px;margin-bottom:0;font-size:15px;">
						Nous restons à votre disposition pour tous renseignements complémentaires au 03 44 88 51 13.<br></p>
						<p>
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
// echo utf8_decode($content);
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->writeHTML($content);

	$pdf->Output($type.'_'.$id.'.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>