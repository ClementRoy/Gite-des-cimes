<?php 
if(isset($facture_id)){
	$id = $facture_id;
} else {
	echo 'Erreur, pas d\'ID';
}

$facture = facture::get($id);
$structure = structure::get($facture->ref_orga);

if ( empty($facture->ref_parent_facture) ) {
	$facture_items = facture_item::getByFacture($facture->id);
} else {
	$facture_items = facture_item::getByFacture($facture->ref_parent_facture);
}
$saison = saison::getByYear($facture->ref_season, $facture->year);


$sejours = array();
foreach ($facture_items as $key => $facture_item) {
	$inscription = inscription::get($facture_item->ref_inscription);
	$sejour = sejour::get( $inscription->ref_sejour );
	$sejours[$sejour->name] = $sejour->price;
}


$sorted_items = array();
foreach ($facture_items as $facture_item) {
	$inscription = inscription::get( $facture_item->ref_inscription );
	$sejour = sejour::get( $inscription->ref_sejour );
	$enfant = enfant::get( $inscription->ref_enfant );
		
	if ( isset( $sorted_items[$enfant->id] ) ) {
		if ( end( $sorted_items[$enfant->id]['inscriptions'] )['ref_sejour'] == $sejour->id  && $inscription->date_from == end( $sorted_items[$enfant->id]['inscriptions'] )['date_to'] ) {

			$i = count($sorted_items[$enfant->id]['inscriptions']);
			$sorted_items[$enfant->id]['inscriptions'][$i - 1]['date_to'] = $inscription->date_to;
			$sorted_items[$enfant->id]['inscriptions'][$i - 1]['weeks'] = $sorted_items[$enfant->id]['inscriptions'][$i - 1]['weeks'] + 1;
			$sorted_items[$enfant->id]['inscriptions'][$i - 1]['payed_amount'] = $facture_item->payed_amount;

		} else {
			$sorted_items[$enfant->id]['inscriptions'][] = array(
		        'ref_sejour' => $sejour->id,
		        'name' => $sejour->name,
		        'date_from' => $inscription->date_from,
		        'date_to' => $inscription->date_to,
		        'weeks' => 1,
		        'payed_amount' => $facture_item->payed_amount
			);
		}
	} else {
		$sorted_items[$enfant->id] = array(
			'firstname' => $enfant->firstname,
			'lastname' => $enfant->lastname,
			'birthdate' => $enfant->birthdate,
			);
		$sorted_items[$enfant->id]['inscriptions'][] = array(
	        'ref_sejour' => $sejour->id,
	        'name' => $sejour->name,
	        'date_from' => $inscription->date_from,
	        'date_to' => $inscription->date_to,
	        'weeks' => 1,
	        'payed_amount' => $facture_item->payed_amount
		);
	}
}

?>

<style type="text/css">
	table {
		width: 100%;
		font-size: 13px;
		vertical-align: top;
		line-height: 16px;
	}
	/*td {width: 100%;}*/
	/*tr {width: 100%;}*/
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
	table.special {
		border-collapse: collapse;
		font-size: 12px;
		/*border: 1px solid #000;*/
		/*border-collapse: separate;*/
	}
	table.special th,
	table.special td {
		padding: 7px 7px 10px;
	}
	table.special thead th,
	table.special tfoot td {
		padding: 4px 7px;
	}
	table.special tr th {
		border: 1px solid #555;
		text-align: right;
	}
	table.special tr td {
		border: 1px solid #555;
		border-collapse: separate;
		text-align: right;
		vertical-align: top;
	}
	table.special tbody tr td {
		/*border-top: none;*/
		border-bottom: none;
	}
	table.special tbody tr.last td {
		border-bottom: 1px solid #555;
	}
	table.special tfoot tr td,
	table.special tr.tfoot td {
		padding: 7px;
		border-top: 1px solid #555;
	}
	table.special-example tr td {
		padding: 6px 7px;
		font-weight: bold;
		color: #A448B2;
		background-color: #FEF0FF;
	}
	.purple {
		color: #A448B2;
	}


	table.table-main {
		font-size: 12px;
		border-collapse: collapse;
	}
	table.table-main thead tr th,
	table.table-main tr td {
		padding: 4px 7px;
		text-align: center;
		border: 1px solid #555;
		border-collapse: collapse;
	}
	table.table-main tr td {
		padding-top: 20px;
		padding-bottom: 2px;
		border-top: none;
		border-bottom: none;
	}
	table.table-main tr.table-main-child td {
		padding-top: 7px;
	}
/*	table.table-main tbody tr td {
		border-top: none;
		border-bottom: none;
	}*/
	table.table-main tbody tr.last td {
		padding-bottom: 24px;
		border-bottom: 1px solid #555;
	}
	table.table-main tbody tr.tfoot td {
		padding-top: 4px;
		padding-bottom: 4px;
		border-top: 1px solid #555;
		border-bottom: 1px solid #555;
	}

</style>

<?php if ( $structure->id == 227 ): ?>
	<page backtop="1mm" backleft="6mm" backright="6mm" backbottom="1mm">

		<table bordercolor="#000000" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:50%;line-height: 18px;">
					<p><strong>GITE DES CÎMES<br>
						607 RUE DU CHÂTEAU D'EAU<br>
						60123 BONNEUIL EN VALOIS</strong>
					</p>
					<p>
						<strong>N° du Tiers IGDA : 108501</strong>
					</p>
					<p>
						Tél : 03 44 88 51 13<br>
						Fax : 03 44 87 57 68<br>
						Port : 06 50 31 22 88<br>
						Email : gite.cimes@orange.fr
					</p>
					<p>
						SIRET : 530 369 982 00018<br>
						APE : 5520Z
					</p>

				</td>
				<td style="width:50%;">
					<table bordercolor="#000000" border="0" cellpadding="0" cellspacing="0">
						
						<tr>
							<td style="width:100%;padding:0 0 10px 50px;">
								<table style="border: 1px solid #666;background-color: #eaeaea;border-radius: 5px;line-height: 20px;">
									<tr>
										<td style="padding: 7px 10px;width: 100%;">
											<strong>FACTURE N° <?php echo $facture->number; ?></strong>
											<br>
											<?php $date = new DateTime($facture->created) ?>
											DATE : <?php echo $date->format("d/m/Y"); ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td style="width:100%;padding:0 0 30px 0;">
								<table style="border: 1px solid #666;background-color: #eaeaea;border-radius: 5px;line-height: 18px;">
									<tr>
										<td style="padding: 7px 0 7px 10px;width: 100%;">
											N°engagement : 2018-002416<br>
											Prestation : Hébérgement<br>
											Type d'accueil : Colonie
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td style="width:100%;padding:0 0 15px 0;">
								<table style="border: 1px solid #666;background-color: #eaeaea;line-height: 18px;border-radius: 5px;">
									<tr>
										<td style="padding: 7px 10px;width: 100%;">
										<?php if ($facture->ref_orga == 235): ?>
											<?php if ($enfant->guardian == 'mere'): ?>
												<?php echo $enfant->mother_name; ?><br>
												<?php echo $enfant->mother_address_number; ?> <?php echo $enfant->mother_address_street; ?><br>
												<?php echo $enfant->mother_address_postal_code; ?> <?php echo $enfant->mother_address_city; ?>
											<?php elseif ($enfant->guardian == 'pere'): ?>
												<?php echo $enfant->father_name; ?><br>
												<?php echo $enfant->father_address_number; ?> <?php echo $enfant->father_address_street; ?><br>
												<?php echo $enfant->father_address_postal_code; ?> <?php echo $enfant->father_address_city; ?>
											<?php elseif ($enfant->guardian == 'parents'): ?>

												<?php if (!empty($enfant->father_name) && !empty($enfant->mother_name)): ?>
													<?php echo $enfant->father_name; ?> et <?php echo $enfant->mother_name; ?><br>
												<?php else: ?>
													<?php if (!empty($enfant->father_name)): ?>
														<?php echo $enfant->father_name; ?><br>
													<?php else: ?>
														<?php echo $enfant->mother_name; ?><br>
													<?php endif; ?>
												<?php endif ?>

												<?php if ( !empty($enfant->father_address_number) ||
															!empty($enfant->father_address_street) ||
															!empty($enfant->father_address_postal_code) ||
															!empty($enfant->father_address_city) ): ?>

												<?php echo $enfant->father_address_number; ?> <?php echo $enfant->father_address_street; ?><br>
												<?php echo $enfant->father_address_postal_code; ?> <?php echo $enfant->father_address_city; ?>

												<?php elseif ( !empty($enfant->mother_address_number) ||
															!empty($enfant->mother_address_street) ||
															!empty($enfant->mother_address_postal_code) ||
															!empty($enfant->mother_address_city) ): ?>

												<?php echo $enfant->mother_address_number; ?> <?php echo $enfant->mother_address_street; ?><br>
												<?php echo $enfant->mother_address_postal_code; ?> <?php echo $enfant->mother_address_city; ?>

												<?php else: ?>
													<br>
													<br>
												<?php endif ?>

											<?php else: ?>
													<br>
													<br>
													<br>
											<?php endif; ?>


										<?php else: ?>
											<?php if ( empty($facture->ref_parent_facture) ): ?>
											
												DEF/ASE/Bureau de la comptabilité<br>
												Conseil Départemental de la Seine-saint-Denis<br>
												Hôtel du département<br>
												93006 Bobigny cedex<br>
												N°CDR : 62<br>
												Groupe comptable: DEF ASE2

											<?php else: ?>

												<?php echo $facture->family_name; ?><br>
												<br>
												<br>

											<?php endif; ?>
										<?php endif; ?>

										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<br>

		<?php if ( !empty($facture->purchase_order) ): ?>
			<strong>Numéro de bon de commande : <?php echo $facture->purchase_order; ?></strong>
			<br>
			<br>
		<?php else: ?>
		<br>
		<?php endif ?>


		<?php if ( empty($facture->ref_parent_facture) ): ?>

			<table class="special special-example" bordercolor="#666" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 82%;text-align: left;">Pour la période du : <?php echo $saison['name']; ?> <?php echo $facture->year; ?></th>
						<th style="width: 18%;">Prix semaine</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $i = 1; ?>
					<?php foreach ($sejours as $name => $price): ?>
						<tr<?php if(count($sejours) <= $i): ?> class="last"<?php endif; ?>>
							<td style="text-align: left;"><?php echo $name; ?></td>
							<td><?php echo $price; ?></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>

				</tbody>
			</table>

		<?php else: ?>

			<table class="special special-example" bordercolor="#666" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 100%;text-align: left;">Pour la période du : <?php echo $saison['name']; ?> <?php echo $facture->year; ?></th>
					</tr>
				</thead>

				<tbody>
					
					<?php $i = 1; ?>
					<?php foreach ($sejours as $name => $price): ?>
						<tr<?php if(count($sejours) <= $i): ?> class="last"<?php endif; ?>>
							<td style="text-align: left;"><?php echo $name; ?></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>

				</tbody>
			</table>

		<?php endif; ?>

		<br>
		<br>

		<?php if ( empty($facture->ref_parent_facture) ): ?>

			<table class="table-main" bordercolor="#666666" border="0" cellspacing="0" style="border-color:#666;">
				<thead>
					<tr class="head">
						<th style="width: 54%;text-align: left;">Enfants</th>
						<th style="width: 16%;">Prix semaine</th>
						<th style="width: 12%;">Nombre</th>
						<th style="width: 18%;">Montant euros</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $o = 1; ?>
					<?php foreach ($sorted_items as $sorted_item): ?>

						<tr>
							<?php $birthdate = new DateTime($sorted_item['birthdate']) ?>
							<td style="text-align: left;"><strong><?php echo $sorted_item['lastname'] ?> <?php echo $sorted_item['firstname']; ?></strong> - né le <?php echo $birthdate->format("d/m/Y"); ?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php $i = 1; ?>
						<?php foreach ($sorted_item['inscriptions'] as $inscription): ?>
							<?php $date_from = new DateTime($inscription['date_from']) ?>
							<?php $date_to = new DateTime($inscription['date_to']) ?>
							<?php if (count($sorted_item['inscriptions']) == $i && count($sorted_items) == $o): ?>
							<tr class="table-main-child last">	
							<?php else: ?>
							<tr class="table-main-child">
							<?php endif; ?>
								<td style="text-align: left;"><strong class="purple"><?php echo $inscription['name']; ?></strong> <span class="purple">du <?php echo $date_from->format("d/m"); ?> au <?php echo $date_to->format("d/m/Y"); ?></span></td>
								<td><?php echo $inscription['payed_amount']; ?></td>
								<td><?php echo $inscription['weeks']; ?></td>
								<td><?php echo ($inscription['payed_amount'] * $inscription['weeks']); ?></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>

						<?php $o++; ?>
					<?php endforeach; ?>

					<tr class="tfoot">
						<td style="text-align: left;">
							<strong>NET À PAYER EN EURO</strong>
						</td>
						<td></td>
						<td></td>
						<td style="background-color: #eaeaea;"><strong><?php echo $facture->total_amount_facture; ?></strong></td>
					</tr>
				</tbody>
			</table>

		<?php else: ?>

			<table class="table-main" bordercolor="#666666" border="0" cellspacing="0" style="border-color:#666;">
				<thead>
					<tr class="head">
						<th style="width: 82%;text-align: left;">Enfants</th>
						<th style="width: 18%;">Montant euros</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $o = 1; ?>
					<?php foreach ($sorted_items as $sorted_item): ?>

						<tr>
							<?php $birthdate = new DateTime($sorted_item['birthdate']) ?>
							<td style="text-align: left;"><strong><?php echo $sorted_item['lastname'] ?> <?php echo $sorted_item['firstname']; ?></strong> - né le <?php echo $birthdate->format("d/m/Y"); ?></td>
							<td></td>
						</tr>
						
						<?php $i = 1; ?>
						<?php foreach ($sorted_item['inscriptions'] as $inscription): ?>
							<?php $date_from = new DateTime($inscription['date_from']) ?>
							<?php $date_to = new DateTime($inscription['date_to']) ?>
							<?php if (count($sorted_item['inscriptions']) == $i && count($sorted_items) == $o): ?>
							<tr class="table-main-child last">	
							<?php else: ?>
							<tr class="table-main-child">
							<?php endif; ?>
								<td style="text-align: left;"><strong class="purple"><?php echo $inscription['name']; ?></strong> <span class="purple">du <?php echo $date_from->format("d/m"); ?> au <?php echo $date_to->format("d/m/Y"); ?></span></td>
								<td></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>

						<?php $o++; ?>
					<?php endforeach; ?>

					<tr class="tfoot">
						<td style="text-align: left;">
							<strong>NET À PAYER EN EURO</strong>
						</td>
						<td style="background-color: #eaeaea;"><strong><?php echo $facture->total_amount_facture; ?></strong></td>
					</tr>
				</tbody>
			</table>

		<?php endif; ?>

		<br>
		<br>

		<table style="border-collapse:collapse;padding:0;border:none;">
			<tr>
				<td style="width: 48%;">

					<table class="special" bordercolor="#666" border="1" cellspacing="0" style="max-width:100%;">
						<tr style="width:100%;">
							<td style="text-align:center;padding: 12px 7px 2px;border-bottom:none;">
								<strong style="font-size: 14px;">Facture payable par virement</strong>
							</td>
						</tr>
						<tr>
							<td style="text-align: left;padding: 12px 7px;width:100%;line-height: 18px;">
								<strong style="font-size: 13px;">Compte ouvert au nom : Gite des Cimes</strong><br>
								<span style="color:#C92626;">IBAN : FR35 3000 2084 3400 0011 7192 K15</span><br>
								<span style="color:#C92626;">BIC : CRLYFRPP</span><br>
								<br>
								<strong style="color:#8B3636;">Réf à rappeler impérativement lors du paiement : <?php echo $facture->number; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;width:100%;">
								Facture non assujettie à la TVA<br>
								Art 293 du Code des Impôts
							</td>
						</tr>
					</table>

				</td>
				<td style="width: 4%;">
				</td>
				<td style="width: 48%;">

					<?php if ( empty($facture->ref_parent_facture) ): ?>
						<table class="special" border="0" cellspacing="0" style="max-width:100%;border: none;">
							<tr>
								<td style="width:100%;text-align:left;font-size: 14px;border: none;line-height: 20px;">
									Certifié exact le présent état s'élevant à la somme de :
									<?php
										$a = new chiffreEnLettre();
										echo $a->ConvNumberLetter( $facture->total_amount_facture, 1, 0);
									?>
								</td>
							</tr>
							<tr>
								<td style="width:100%;text-align:left;font-size: 14px;border: none;padding-top: 20px;line-height: 20px;">
										À Bonneuil-en-Valois, le <?php echo date("d/m/Y"); ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>
					
				</td>
			</tr>
		</table>

	</page>

<?php else: ?>
	<page backtop="1mm" backleft="6mm" backright="6mm" backbottom="1mm">

		<table bordercolor="#000000" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:50%;">
					<p><strong>GITE DES CÎMES<br>
						607 RUE DU CHÂTEAU D'EAU<br>
						60123 BONNEUIL EN VALOIS</strong>
					</p>
					
					<p>
						Tél : 03 44 88 51 13<br>
						<strong>Fax : 03 44 87 57 68</strong> <span style="margin-left: 20px;">Port : 06 50 31 22 88</span><br>
						<strong>n° siret : 530 369 982 00018</strong>
					</p>

				</td>
				<td style="width:50%;padding:0 0 0 50px;">
					<table style="border: 1px solid #000;background-color: #eaeaea;">
						<tr>
							<td style="padding: 7px 10px;width: 100%;">
								FACTURE N° <?php echo $facture->number; ?>
								<br>
								<br>
								<br>
								<?php $date = new DateTime($facture->created) ?>
								DATE : <?php echo $date->format("d/m/Y"); ?>
								<br>
								<br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<br>

		<table bordercolor="#000000" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:45%;">
				</td>
				<td style="width:55%;">
					<table style="border: 1px solid #000;background-color: #eaeaea;line-height: 18px;">
						<tr>
							<td style="padding: 7px 10px;width: 100%;">
							<?php if ($facture->ref_orga == 235): ?>
								<?php if ($enfant->guardian == 'mere'): ?>
									<?php echo $enfant->mother_name; ?><br>
									<?php echo $enfant->mother_address_number; ?> <?php echo $enfant->mother_address_street; ?><br>
									<?php echo $enfant->mother_address_postal_code; ?> <?php echo $enfant->mother_address_city; ?>
								<?php elseif ($enfant->guardian == 'pere'): ?>
									<?php echo $enfant->father_name; ?><br>
									<?php echo $enfant->father_address_number; ?> <?php echo $enfant->father_address_street; ?><br>
									<?php echo $enfant->father_address_postal_code; ?> <?php echo $enfant->father_address_city; ?>
								<?php elseif ($enfant->guardian == 'parents'): ?>

									<?php if (!empty($enfant->father_name) && !empty($enfant->mother_name)): ?>
										<?php echo $enfant->father_name; ?> et <?php echo $enfant->mother_name; ?><br>
									<?php else: ?>
										<?php if (!empty($enfant->father_name)): ?>
											<?php echo $enfant->father_name; ?><br>
										<?php else: ?>
											<?php echo $enfant->mother_name; ?><br>
										<?php endif; ?>
									<?php endif ?>

									<?php if ( !empty($enfant->father_address_number) ||
												!empty($enfant->father_address_street) ||
												!empty($enfant->father_address_postal_code) ||
												!empty($enfant->father_address_city) ): ?>

									<?php echo $enfant->father_address_number; ?> <?php echo $enfant->father_address_street; ?><br>
									<?php echo $enfant->father_address_postal_code; ?> <?php echo $enfant->father_address_city; ?>

									<?php elseif ( !empty($enfant->mother_address_number) ||
												!empty($enfant->mother_address_street) ||
												!empty($enfant->mother_address_postal_code) ||
												!empty($enfant->mother_address_city) ): ?>

									<?php echo $enfant->mother_address_number; ?> <?php echo $enfant->mother_address_street; ?><br>
									<?php echo $enfant->mother_address_postal_code; ?> <?php echo $enfant->mother_address_city; ?>

									<?php else: ?>
										<br>
										<br>
									<?php endif ?>

								<?php else: ?>
										<br>
										<br>
										<br>
								<?php endif; ?>


							<?php else: ?>
								<?php if ( empty($facture->ref_parent_facture) ): ?>
									
									<?php echo $structure->name; ?><br>
									<?php if(!empty( $structure->service ) ): ?>
									<?php echo $structure->service; ?><br>
									<?php endif; ?>
									<?php echo $structure->address_number; ?> <?php echo $structure->address_street; ?><br>
									<?php if (!empty($structure->address_comp)): ?>
										<?php echo $structure->address_comp; ?><br>
									<?php endif; ?>
									<?php echo $structure->address_postal_code; ?> <?php echo $structure->address_city; ?>
								<?php else: ?>

									<?php echo $facture->family_name; ?><br>
									<br>
									<br>

								<?php endif; ?>
							<?php endif; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		<br>

		<?php if ( !empty($facture->purchase_order) ): ?>
			<strong>Numéro de bon de commande : <?php echo $facture->purchase_order; ?></strong>
			<br>
			<br>
		<?php else: ?>
		<br>
		<?php endif ?>


		<?php if ( empty($facture->ref_parent_facture) ): ?>

			<table class="special special-example" bordercolor="#000000" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 82%;text-align: left;">Pour la période du : <?php echo $saison['name']; ?> <?php echo $facture->year; ?></th>
						<th style="width: 18%;">Prix semaine</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $i = 1; ?>
					<?php foreach ($sejours as $name => $price): ?>
						<tr<?php if(count($sejours) <= $i): ?> class="last"<?php endif; ?>>
							<td style="text-align: left;"><?php echo $name; ?></td>
							<td><?php echo $price; ?></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>

				</tbody>
			</table>

		<?php else: ?>

			<table class="special special-example" bordercolor="#000000" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 100%;text-align: left;">Pour la période du : <?php echo $saison['name']; ?> <?php echo $facture->year; ?></th>
					</tr>
				</thead>

				<tbody>
					
					<?php $i = 1; ?>
					<?php foreach ($sejours as $name => $price): ?>
						<tr<?php if(count($sejours) <= $i): ?> class="last"<?php endif; ?>>
							<td style="text-align: left;"><?php echo $name; ?></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>

				</tbody>
			</table>

		<?php endif; ?>

		<br>
		<br>

		<?php if ( empty($facture->ref_parent_facture) ): ?>

			<table class="table-main" bordercolor="#000000" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 54%;text-align: left;">Enfants</th>
						<th style="width: 16%;">Prix semaine</th>
						<th style="width: 12%;">Nombre</th>
						<th style="width: 18%;">Montant euros</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $o = 1; ?>
					<?php foreach ($sorted_items as $sorted_item): ?>

						<tr>
							<?php $birthdate = new DateTime($sorted_item['birthdate']) ?>
							<td style="text-align: left;"><strong><?php echo $sorted_item['lastname'] ?> <?php echo $sorted_item['firstname']; ?></strong> - né le <?php echo $birthdate->format("d/m/Y"); ?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php $i = 1; ?>
						<?php foreach ($sorted_item['inscriptions'] as $inscription): ?>
							<?php $date_from = new DateTime($inscription['date_from']) ?>
							<?php $date_to = new DateTime($inscription['date_to']) ?>
							<?php if (count($sorted_item['inscriptions']) == $i && count($sorted_items) == $o): ?>
							<tr class="table-main-child last">	
							<?php else: ?>
							<tr class="table-main-child">
							<?php endif; ?>
								<td style="text-align: left;"><strong class="purple"><?php echo $inscription['name']; ?></strong> <span class="purple">du <?php echo $date_from->format("d/m"); ?> au <?php echo $date_to->format("d/m/Y"); ?></span></td>
								<td><?php echo $inscription['payed_amount']; ?></td>
								<td><?php echo $inscription['weeks']; ?></td>
								<td><?php echo ($inscription['payed_amount'] * $inscription['weeks']); ?></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>

						<?php $o++; ?>
					<?php endforeach; ?>

					<tr class="tfoot">
						<td style="text-align: left;">
							<strong>NET À PAYER EN EURO</strong>
						</td>
						<td></td>
						<td></td>
						<td style="background-color: #eaeaea;"><strong><?php echo $facture->total_amount_facture; ?></strong></td>
					</tr>
				</tbody>
			</table>

		<?php else: ?>

			<table class="table-main" bordercolor="#000000" border="0" cellspacing="0">
				<thead>
					<tr class="head">
						<th style="width: 82%;text-align: left;">Enfants</th>
						<th style="width: 18%;">Montant euros</th>
					</tr>
				</thead>

				<tbody>
					
					<?php $o = 1; ?>
					<?php foreach ($sorted_items as $sorted_item): ?>

						<tr>
							<?php $birthdate = new DateTime($sorted_item['birthdate']) ?>
							<td style="text-align: left;"><strong><?php echo $sorted_item['lastname'] ?> <?php echo $sorted_item['firstname']; ?></strong> - né le <?php echo $birthdate->format("d/m/Y"); ?></td>
							<td></td>
						</tr>
						
						<?php $i = 1; ?>
						<?php foreach ($sorted_item['inscriptions'] as $inscription): ?>
							<?php $date_from = new DateTime($inscription['date_from']) ?>
							<?php $date_to = new DateTime($inscription['date_to']) ?>
							<?php if (count($sorted_item['inscriptions']) == $i && count($sorted_items) == $o): ?>
							<tr class="table-main-child last">	
							<?php else: ?>
							<tr class="table-main-child">
							<?php endif; ?>
								<td style="text-align: left;"><strong class="purple"><?php echo $inscription['name']; ?></strong> <span class="purple">du <?php echo $date_from->format("d/m"); ?> au <?php echo $date_to->format("d/m/Y"); ?></span></td>
								<td></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>

						<?php $o++; ?>
					<?php endforeach; ?>

					<tr class="tfoot">
						<td style="text-align: left;">
							<strong>NET À PAYER EN EURO</strong>
						</td>
						<td style="background-color: #eaeaea;"><strong><?php echo $facture->total_amount_facture; ?></strong></td>
					</tr>
				</tbody>
			</table>

		<?php endif; ?>

		<br>
		<br>

		<table style="border-collapse:collapse;padding:0;border:none;">
			<tr>
				<td style="width: 48%;">

					<table class="special" bordercolor="#000000" border="1" cellspacing="0" style="max-width:100%;">
						<tr style="width:100%;">
							<td style="text-align: center;padding: 12px 7px 2px;border-bottom:none;">
								<strong style="font-size: 14px;">Facture payable par virement</strong>
							</td>
						</tr>
						<tr>
							<td style="text-align: left;padding: 12px 7px;width:100%;">
								<strong style="font-size: 13px;">Compte ouvert au nom : Gite des Cimes</strong><br>
								LCL<br>
								Code banque : <span style="margin-left: 15px;">30002</span> <span style="margin-left: 40px;">Code guichet :</span> <span style="margin-left: 15px;">08434</span><br>
								N° de cpte : <span style="margin-left: 15px;">0000117192K</span> <span style="margin-left: 40px;">Clé :</span> <span style="margin-left: 15px;">15</span><br>
								<br>
								<span style="color:#C92626;">IBAN : FR35 3000 2084 3400 0011 7192 K15</span><br>
								<br>
								<strong style="color:#8B3636;">Réf à rappeler impérativement lors du paiement : <?php echo $facture->number; ?></strong>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;width:100%;">
								Facture non assujettie à la TVA<br>
								Art 293 du Code des Impôts
							</td>
						</tr>
					</table>

				</td>
				<td style="width: 4%;">
				</td>
				<td style="width: 48%;">

					<?php if ( ($structure->id == 226 || $structure->id == 227) && empty($facture->ref_parent_facture)): ?>
						<table class="special" bordercolor="#000000" border="1" cellspacing="0" style="max-width:100%;">
								<?php if ($structure->id == 226 || $structure->id == 227): ?>
								<tr>
									<td style="text-align: center;width:100%;height:20px;padding:14px 7px;text-transform:uppercase;font-size: 12px;<?php if ($structure->id == 227): ?>border-bottom: none;padding-bottom:4px;<?php endif; ?>">			
										<?php if ($structure->id == 227): ?>
											DOIT LE DEPARTEMENT DE LA SEINE SAINT DENIS AIDE SOCIALE A L'ENFANCE LA SOMME DE : 
										<?php elseif($structure->id == 226): ?>
											DOIT LE DEPARTEMENT DU VAL D'OISE, DIRECTION DEPARTEMENTALE ADJOINTE CHARGEE DE LA SOLIDARITE
										<?php endif; ?>
									</td>
								</tr>
								<?php endif; ?>
								<?php if ($structure->id == 227): ?>
								<tr>
									<td style="width:100%;text-align:center;padding-top: 0;text-transform:uppercase;text-align:center;font-size:13px;font-style:italic;border-top: 0;padding-bottom:14px;">
											<strong><?php
												$a = new chiffreEnLettre();
												echo $a->ConvNumberLetter( $facture->total_amount_facture, 1, 0);
											?>
											</strong>
									</td>
								</tr>
								<?php endif ?>
						</table>
					<?php endif; ?>
					
				</td>
			</tr>
		</table>

	</page>
<?php endif; ?>