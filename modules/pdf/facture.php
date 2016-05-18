<?php 
if(isset($facture_id)){
	$id = $facture_id;
} else {
	echo 'Erreur, pas d\'ID';
}

$facture = facture::get($id);
$structure = structure::get($facture->ref_orga);
$facture_items = factureItem::getByFacture($facture->id);
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
		border: 1px solid #000;
		text-align: right;
	}
	table.special tr td {
		border: 1px solid #000;
		border-collapse: separate;
		text-align: right;
		vertical-align: bottom;
	}
	table.special tbody tr td {
		/*border-top: none;*/
		border-bottom: none;
	}
	table.special tbody tr.last td {
		border-bottom: 1px solid #000;
	}
	table.special tfoot tr td {
		padding: 7px;
		border-top: 1px solid #000;
	}
	table.special table.special-child td {
		padding: 4px 0 0;
		text-align: left;
		font-size: 12px;
		border: none;
		border-bottom: none;
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
</style>
<page backtop="1mm" backleft="6mm" backright="6mm" backbottom="1mm">

	<table bordercolor="#000000" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="width:50%;">
				<p><strong>GITE DES CÎMES<br>
					607 RUE DU CHÂTEAU D'EAU<br>
					60123 BONNEUIL EN VALOIS</strong>
				</p>
				
				<p>
					Tél : 03.44.88.51.13<br>
					<strong>Fax : 03.44.87.57.68</strong> <span style="margin-left: 20px;">Port : 06.50.31.22.88</span><br>
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
							<?php echo $structure->name; ?><br>
							<?php echo $structure->address_number; ?> <?php echo $structure->address_street; ?><br>
							<?php if (!empty($structure->address_comp)): ?>
								<?php echo $structure->address_comp; ?><br>
							<?php endif; ?>
							<?php echo $structure->address_postal_code; ?> <?php echo $structure->address_city; ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<br>
	<br>

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

	<br>
	<br>

	<table class="special" bordercolor="#000000" border="0" cellspacing="0">
		<thead>
			<tr class="head">
				<th style="width: 54%;text-align: left;">Enfants</th>
				<th style="width: 16%;">Prix semaine</th>
				<th style="width: 12%;">Semaines</th>
				<th style="width: 18%;">Montant euros</th>
			</tr>
		</thead>

		<tbody>
			
			<?php $o = 1; ?>
			<?php foreach ($sorted_items as $sorted_item): ?>

				<tr>
					<?php $birthdate = new DateTime($sorted_item['birthdate']) ?>
					<td colspan=2><strong><?php echo $sorted_item['lastname'] ?> <?php echo $sorted_item['firstname']; ?></strong> - né le <?php echo $birthdate->format("d/m/Y"); ?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

				<?php foreach ($sorted_item['inscriptions'] as $inscription): ?>
					<tr>
						<td style="width: 140px;"><strong class="purple"><?php echo $inscription['name']; ?></strong></td>
						<?php $date_from = new DateTime($inscription['date_from']) ?>
						<?php $date_to = new DateTime($inscription['date_to']) ?>
						<td><span class="purple">du <?php echo $date_from->format("d/m"); ?> au <?php echo $date_to->format("d/m/Y"); ?></span></td>
						<td><?php echo $inscription['payed_amount']; ?></td>
						<td><?php echo $inscription['weeks']; ?></td>
						<td><?php echo ($inscription['payed_amount'] * $inscription['weeks']); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php $o++; ?>
			<?php endforeach; ?>

		</tbody>

		<tfoot>
			<tr>
				<td style="text-align: left;">
					<strong>NET À PAYER EN EURO</strong>
				</td>
				<td></td>
				<td></td>
				<td style="background-color: #eaeaea;"><strong><?php echo $facture->total_amount_facture; ?></strong></td>
			</tr>
		</tfoot>
	</table>

	<br>
	<br>

	<table class="special" bordercolor="#000000" border="1" cellspacing="0">
		<tr>
			<td style="width: 54%;text-align: center;">
				<strong>Facture payable par virement</strong>
				<?php if ($structure->id == 226 || $structure->id == 227): ?>
					<br>
					<span style="text-transform:uppercase;">
						doit le <?php echo trim($structure->name); ?>, <?php echo trim($structure->service); ?>
					</span>
				<?php endif ?>

				<?php if ($structure->id == 227): ?>
					<br>
					<strong style="text-transform:uppercase;">
						<?php
							$a = new chiffreEnLettre();
							echo $a->ConvNumberLetter( $facture->total_amount_facture, 1, 0);
						?>
					</strong>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td style="width: 54%;text-align: left;padding: 12px 7px;">
				<strong style="font-size: 13px;">Compte ouvert au nom : Gite des Cimes</strong><br>
				LCL<br>
				Code banque : <span style="margin-left: 15px;">30002</span> <span style="margin-left: 40px;">Code guichet :</span> <span style="margin-left: 15px;">08434</span><br>
				N° de cpte : <span style="margin-left: 15px;">0000117192K</span> <span style="margin-left: 40px;">Clé :</span> <span style="margin-left: 15px;">15</span><br>
				<br>
				<span style="color:#C92626;">IBAN : FR35 3000 2084 3400 0011 7192 K15</span><br>
				<br>
				<strong style="color:#8B3636;">Réf à rappeler impérativement lors du paiement : F 15.07.101</strong>
			</td>
		</tr>
		<tr>
			<td style="width: 54%;text-align: center;">
				Facture non assujettie à la TVA<br>
				Art 293 du Code des Impôts
			</td>
		</tr>
	</table>

</page>