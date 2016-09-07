<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php 

	$year = $_GET['annee'];
	$season_id = $_GET['season'];
	$structure_id = $_GET['structure'];
	$datetime_now = new DateTime();

// $facture = facture::get(43);
// $structure = structure::get($facture->ref_orga);
// $facture_items = facture_item::getByFacture($facture->id);

// $items = array();
// foreach ($facture_items as $facture_item) {
// 	$inscription = inscription::get( $facture_item->ref_inscription );
// 	$sejour = sejour::get( $inscription->ref_sejour );
// 	$enfant = enfant::get( $inscription->ref_enfant );
		
// 	if ( isset( $items[$enfant->id] ) ) {
// 		if ( end( $items[$enfant->id]['inscriptions'] )['ref_sejour'] == $sejour->id  && $inscription->date_from == end( $items[$enfant->id]['inscriptions'] )['date_to'] ) {

// 			$i = count($items[$enfant->id]['inscriptions']);
// 			$items[$enfant->id]['inscriptions'][$i - 1]['date_to'] = $inscription->date_to;
// 			$items[$enfant->id]['inscriptions'][$i - 1]['weeks'] = $items[$enfant->id]['inscriptions'][$i - 1]['weeks'] + 1;
// 			$items[$enfant->id]['inscriptions'][$i - 1]['payed_amount'] = $facture_item->payed_amount;

// 		} else {
// 			$items[$enfant->id]['inscriptions'][] = array(
// 		        'ref_sejour' => $sejour->id,
// 		        'name' => $sejour->name,
// 		        'date_from' => $inscription->date_from,
// 		        'date_to' => $inscription->date_to,
// 		        'weeks' => 1,
// 		        'payed_amount' => $facture_item->payed_amount
// 			);
// 		}
// 	} else {
// 		$items[$enfant->id] = array(
// 			'firstname' => $enfant->firstname,
// 			'lastname' => $enfant->lastname,
//			'birthday' => $enfant->birthday,
// 			);
// 		$items[$enfant->id]['inscriptions'][] = array(
// 	        'ref_sejour' => $sejour->id,
// 	        'name' => $sejour->name,
// 	        'date_from' => $inscription->date_from,
// 	        'date_to' => $inscription->date_to,
// 	        'weeks' => 1,
// 	        'payed_amount' => $facture_item->payed_amount
// 		);
// 	}
// }

// tool::output( $items );


	$season = saison::get($season_id);

	$enfants = facture::getInscriptionsByStructureAndSeason($structure_id, $season_id, $year);
	// tool::output( $enfants );


	if ( isset( $_POST['add_facture'] ) ) {

		$last_number_id = facture::getLastNumberIdfromYear($datetime_now->format( 'Y' ));
		$new_number_id = $last_number_id + 1;
		
		extract($_POST);

		$result = false;
		$total_amount = 0;
		foreach ($_POST['amount'] as $amount) {
			$total_amount += $amount;
		}
		$payed_amount = 0;
		foreach ($_POST['payed_amount'] as $amount) {
			$payed_amount += $amount;
		}

		$datas = array(
			':number' => 'F'.$datetime_now->format( 'y' ).'-'.$datetime_now->format( 'm' ).'-'.sprintf("%03d", $new_number_id).'-'.$season->code,
			':number_year' => $datetime_now->format( 'Y' ),
			':number_month' => $datetime_now->format( 'm' ),
			':number_id' => $new_number_id,
			':number_season' => $season->code,
			':ref_orga' => $structure_id,
			':status' => 0,
			':total_amount' => $total_amount,
			':total_amount_facture' => $payed_amount,
			':ref_season' => $season_id,
			':year' => $year,
			':amount_caf' => ( isset( $amount_caf ) ) ? $amount_caf : 0,
			':status_caf' => ( isset( $amount_caf ) ) ? 0 : null,
			':amount_family' => ( isset( $amount_family ) ) ? $amount_family : 0,
			// ':ref_parent_facture' => ( isset( $ref_parent_facture ) ) ? $ref_parent_facture : null,
			// ':family_name' => ( isset( $family_name ) ) ? $family_name : null,
			':purchase_order' => ( isset( $purchase_order ) ) ? $purchase_order : null,
		);

		$result .= facture::add($datas);
		$facture_id = facture::getLastID();

		foreach ($_POST['inscription_id'] as $key => $inscription_id) {

			$datas = array(
				':ref_facture' => $facture_id,
				':ref_inscription' => $inscription_id,
				':amount' => $_POST['amount'][$key],
				':payed_amount' => $_POST['payed_amount'][$key],
			);

			$result .= facture_item::add($datas);

		}


		// Si un reliquat famille est indiqué lors de la soumission
		if (isset($amount_family) && !empty($amount_family) && $amount_family > 0) {

			$last_number_id = facture::getLastNumberIdfromYear($datetime_now->format( 'Y' ));
			$new_number_id = $last_number_id + 1;

			$datas = array(
				':number' => 'F'.$datetime_now->format( 'y' ).'-'.$datetime_now->format( 'm' ).'-'.sprintf("%03d", $new_number_id).'-'.$season->code,
				':number_year' => $datetime_now->format( 'Y' ),
				':number_month' => $datetime_now->format( 'm' ),
				':number_id' => $new_number_id,
				':number_season' => $season->code,
				':ref_orga' => $structure_id,
				':status' => 0,
				':total_amount' => $total_amount,
				':total_amount_facture' => $amount_family,
				':ref_season' => $season_id,
				':year' => $year,
				// ':amount_caf' => ( isset( $amount_caf ) ) ? $amount_caf : 0,
				// ':amount_family' => ( isset( $amount_family ) ) ? $amount_family : 0,
				':ref_parent_facture' => $facture_id,
				':family_name' => ( isset( $family_name ) ) ? $family_name : null,
				// ':purchase_order' => ( isset( $purchase_order ) ) ? $purchase_order : null,
			);

			$result .= facture::add($datas);

			$facture_familly_id = facture::getLastID();

			$datas = array(
				':ref_facture' => $facture_familly_id,
				// ':ref_inscription' => $item,
				':amount' => $total_amount,
				':payed_amount' => $amount_family,
			);

			$result .= facture_item::add($datas);

		}



		if ($result) {

			facture::generate($facture_id);

			if (isset($facture_familly_id)) {
				facture::generate($facture_familly_id);
			}

        	tpl::alert('success', 'La facture a bien été enregistré.');
		} else {
			tpl::alert('danger', 'Une erreur s\'est produite durant l\'enregistrement de la facture =(.');
		}

	}


	if ( isset( $_POST['update_facture'] ) ) {

		extract($_POST);


		$result = false;
		$total_amount = 0;
		foreach ($_POST['amount'] as $amount) {
			$total_amount += $amount;
		}
		$payed_amount = 0;
		foreach ($_POST['payed_amount'] as $amount) {
			$payed_amount += $amount;
		}


		$facture = facture::get($facture_id);

		$old_factureItems = facture_item::getByFacture($facture_id);
		foreach ($old_factureItems as $key => $old_factureItem) {
			facture_item::delete($old_factureItem->id);
		}





		$datas = array(
			':status' => 0,
			':total_amount' => $total_amount,
			':total_amount_facture' => $payed_amount,
			':amount_caf' => ( isset( $amount_caf ) ) ? $amount_caf : 0,
			':status_caf' => ( isset( $amount_caf ) ) ? 0 : null,
			':amount_family' => ( isset( $amount_family ) ) ? $amount_family : 0,
			// ':ref_parent_facture' => ( isset( $ref_parent_facture ) ) ? $ref_parent_facture : null,
			// ':family_name' => ( isset( $family_name ) ) ? $family_name : null,
			':purchase_order' => ( isset( $purchase_order ) ) ? $purchase_order : null,
		);

		$result .= facture::update($datas, $facture_id);

		foreach ($_POST['inscription_id'] as $key => $inscription_id) {
			tool::output( $inscription_id );
			$datas = array(
				':ref_facture' => $facture_id,
				':ref_inscription' => $inscription_id,
				':amount' => $_POST['amount'][$key],
				':payed_amount' => $_POST['payed_amount'][$key],
			);

			$result .= facture_item::add($datas);

		}


		$facture_family = facture::getByParentFacture($facture->id);

		// Si il n'y a plus de facture famille alors qu'il y en avait une avant
		if ( (!isset($amount_family) || $amount_family < 1) && !empty($facture_family) ) {

			// Il faut supprimer l'entrée dans la BDD et le fichier
			$old_familyFactureItems = facture_item::getByFacture($facture_family->id);
			foreach ($old_familyFactureItems as $key => $old_familyFactureItem) {
				facture_item::delete($old_familyFactureItem->id);
			}

			facture::delete($facture_family->id);
			unlink($_SERVER["DOCUMENT_ROOT"].'/uploads/'.$facture_family->number . '.pdf');

		} elseif ( (isset($amount_family) && $amount_family > 1) && empty($facture_family) ) {
			// il faut créer la facture famille

			$last_number_id = facture::getLastNumberIdfromYear($datetime_now->format( 'Y' ));
			$new_number_id = $last_number_id + 1;

			$datas = array(
				':number' => 'F'.$datetime_now->format( 'y' ).'-'.$datetime_now->format( 'm' ).'-'.sprintf("%03d", $new_number_id).'-'.$season->code,
				':number_year' => $datetime_now->format( 'Y' ),
				':number_month' => $datetime_now->format( 'm' ),
				':number_id' => $new_number_id,
				':number_season' => $season->code,
				':ref_orga' => $structure_id,
				':status' => 0,
				':total_amount' => $total_amount,
				':total_amount_facture' => $amount_family,
				':ref_season' => $season_id,
				':year' => $year,
				':ref_parent_facture' => $facture_id,
				':family_name' => ( isset( $family_name ) ) ? $family_name : null,
			);

			$result .= facture::add($datas);

			$facture_familly_id = facture::getLastID();

			$datas = array(
				':ref_facture' => $facture_familly_id,
				':amount' => $total_amount,
				':payed_amount' => $amount_family,
			);

			$result .= facture_item::add($datas);


		} elseif ( (isset($amount_family) || $amount_family > 0) && !empty($facture_family) ) {

			// Si elle existait avant et maintenant également, on met à jour la BDD et on écrase le fichier
			$old_familyFactureItems = facture_item::getByFacture($facture_family->id);
			foreach ($old_familyFactureItems as $key => $old_familyFactureItem) {
				facture_item::delete($old_familyFactureItem->id);
			}

			$facture_familly_id = $facture_family->id;

			$datas = array(
				':status' => 0,
				':total_amount' => $total_amount,
				':total_amount_facture' => $amount_family,
				':ref_parent_facture' => $facture_id,
				':family_name' => ( isset( $family_name ) ) ? $family_name : null,
			);

			$result .= facture::update($datas, $facture_family->id);

			$datas = array(
				':ref_facture' => $facture_familly_id,
				':amount' => $total_amount,
				':payed_amount' => $amount_family,
			);

			$result .= facture_item::add($datas);

		}


		if ($result) {

			facture::generate($facture_id);

			if (isset($facture_familly_id)) {
				facture::generate($facture_familly_id);
			}

        	tpl::alert('success', 'La facture a bien été mise à jour.');
		} else {
			tpl::alert('danger', 'Une erreur s\'est produite durant la mise à jour de la facture =(.');
		}

	}


	$alreadyFactured = facture::getAlreadyFactured($structure_id, $season_id, $year);
	// tool::output( $alreadyFactured );
 ?>

<div class="page-head">
    <div class="row">
        <div class="col-xs-12">
             <a href="#" class="trigger dropdown-toggle" data-toggle="dropdown">
                <i class="fa big-icon fa-file-text-o"></i>
            </a>

            <h1>
            	<?php $structure = structure::get($structure_id); ?>
               <?php echo $structure->name; ?> - <strong><?php echo $season->name; ?> <?php echo $year; ?></strong>
            </h1>
        </div>
    </div>
</div>

<div class="col-xs-12">
	<div class="row">
		<div class="col-xs-6">
			<div class="block-flat">
				<div class="header">
					<div class="row">
						<div class="col-xs-12 col-md-7">
							<h3>À facturer</h3>
						</div>
						<div class="col-xs-12 col-md-5">
							<input type="text" id="js-search-available" class="form-control input-sm" placeholder="Rechercher un enfant...">
						</div>
					</div>
				</div>
				<div class="content">
					<table class="table table-form" id="js-table-available">
						<?php foreach ($enfants as $key => $enfant): ?>
							<?php $inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year ); ?>
							 <?php foreach ($inscriptions as $key => $inscription): ?>
								<?php if (!in_array($inscription->id, $alreadyFactured)): ?>
								<tr id="available-<?php echo $inscription->id; ?>">
									<td>
										<div class="title"><?php echo $enfant->lastname.' '.$enfant->firstname; ?></div>
										<?php
											$date_from = new DateTime($inscription->date_from);
											$date_to = new DateTime($inscription->date_to);
										?>
										<div><?php echo $inscription->name; ?> du <?php echo strftime('%d %B', $date_from->getTimestamp()) ?> au <?php echo strftime('%d %B', $date_to->getTimestamp()) ?></div>
									</td>
									<td class="options">
										<span class="label label-success">Ajouté</span>
										<button class="btn btn-default btn-sm btn-add" data-id="<?php echo $inscription->id; ?>" data-tarif="<?php echo $inscription->price; ?>">Ajouter</button>
									</td>
								</tr>
								<?php endif; ?>
							<?php endforeach; ?>

						<?php endforeach; ?>
						<?php foreach ($enfants as $key => $enfant): ?>
							<?php $inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year ); ?>

							<?php foreach ($inscriptions as $key => $inscription): ?>
								<?php if (in_array($inscription->id, $alreadyFactured)): ?>
								<tr id="available-<?php echo $inscription->id; ?>" class="disabled">
									<td>
										<div class="title"><?php echo $enfant->lastname.' '.$enfant->firstname; ?></div>
										<?php
											$date_from = new DateTime($inscription->date_from);
											$date_to = new DateTime($inscription->date_to);
										?>
										<div><?php echo $inscription->name; ?> du <?php echo strftime('%d %B', $date_from->getTimestamp()) ?> au <?php echo strftime('%d %B', $date_to->getTimestamp()) ?></div>
									</td>
									<td class="options">
										<span class="label label-primary">Déja facturé</span>
									</td>
								</tr>
								<?php endif; ?>
							<?php endforeach; ?>

						<?php endforeach; ?>
					</table>						
				</div>
			</div>
		</div>

		<div class="col-xs-6">
			<div class="block-flat">
				<form id="form-factures" action="" method="POST">
					<input type="hidden" name="add_facture" value="1">
					<div class="header">							
						<h3>Facture en cours</h3>
					</div>
					<div class="content">

						<table class="table table-form table-bon-commande">
							<tr>
								<td class="form">
									<label for="purchase_order">N° de bon de commande (facultatif) : </label>&nbsp;
									<input name="purchase_order" id="purchase_order" type="text" class="form-control input-sm bon-de-commande">
								</td>
							</tr>
						</table>

						<div class="placeholder-form">
							Ajouter des éléments pour créer votre facture
						</div>

						<table class="table table-form" id="js-table-selected">

							<?php foreach ($enfants as $key => $enfant): ?>
								<?php
									$inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year );
								 	foreach ($inscriptions as $key => $inscription): ?>
									<?php if (!in_array($inscription->id, $alreadyFactured)): ?>
										<tr id="selected-<?php echo $inscription->id; ?>" class="hide">
											<td>
												<div class="title"><?php echo $enfant->lastname.' '.$enfant->firstname; ?></div>
												<?php
													$date_from = new DateTime($inscription->date_from);
													$date_to = new DateTime($inscription->date_to);
												?>
												<div><?php echo $inscription->name; ?> du <?php echo strftime('%d %B', $date_from->getTimestamp()) ?> au <?php echo strftime('%d %B', $date_to->getTimestamp()) ?></div>
											</td>
											<td class="form">
												<label for="tarif-<?php echo $inscription->id; ?>">Tarif : </label>&nbsp;
												<input disabled="disabled" name="payed_amount[]" id="tarif-<?php echo $inscription->id; ?>" type="text" class="form-control input-sm tarif" value="<?php echo $inscription->price; ?>" data-init-tarif="<?php echo $inscription->price; ?>">
												/ <?php echo $inscription->price; ?>
												<input disabled="disabled" type="hidden" class="solde" value="0">
												<input disabled="disabled" name="amount[]" type="hidden" class="amount" value="<?php echo $inscription->price; ?>">
												<input disabled="disabled" name="inscription_id[]" type="hidden" class="inscription_id" value="<?php echo $inscription->id; ?>">
											</td>
											<td class="options">
												<button class="btn btn-default btn-sm btn-remove" data-id="<?php echo $inscription->id; ?>">Retirer</button>
											</td>
										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endforeach; ?>

						</table>

						<div id="selected-reliquats" class="hide">
							<h4>Reliquats</h4>

							<table class="table table-form table-reliquats">
								<tr>
									<td>
										<label for="family_name">Famille : </label>&nbsp;
										<input disabled="disabled" name="family_name" id="family_name" type="text" class="form-control input-sm tarif" placeholder="Nom de famille" style="text-align:left;width: 170px;">
									</td>
									<td class="form">
										<label for="amount_family">Reliquat : </label>&nbsp;
										<input disabled="disabled" name="amount_family" id="amount_family" type="text" class="form-control input-sm tarif" value="0">
										/ <span class="selected-reliquat-amount">0</span>
									</td>
								</tr>

								<tr>
									<td>
										<label>Bon CAF</label>
									</td>
									<td class="form">
										<label for="amount_caf">Reliquat : </label>&nbsp;
										<input name="amount_caf" id="amount_caf" type="text" class="form-control input-sm tarif" value="0">
										/ <span class="selected-reliquat-amount">0</span>
									</td>
								</tr>
							</table>
						</div>

					</div>
				    <div class="footer footer-form | text-right">
				    	<button class="btn btn-default" id="js-btn-reset" disabled="disabled">Réinitialiser</button>
				    	<input type="submit" class="btn btn-primary" id="js-btn-confirm" disabled="disabled" value="Créer une facture">
				    </div>
			    </form>
			</div>
		</div>
		
	</div>

	<?php $factures = facture::getByStructureAndSeason($structure_id, $season_id, $year); ?>

	<?php if (!empty($factures)): ?>
			
		<div class="row">
			<div class="col-xs-12 col-md-8">

			    <div class="section-head">
			        <div class="row">
			            <div class="col-xs-12 col-md-8">
			                <h3>Factures</h3>
			            </div>
			        </div>
			    </div>

			    <div id="factures-list" class="block-flat tb-special tb-no-options tb-factures">
			        <div class="content">
			            <div class="table-responsive">
			                <table class="table table-bordered">
			                    <thead>
			                        <tr>
			                            <th style="min-width:150px;">Numéro de facture</th>
			                            <th style="width: 80px;padding-right: 15px;">Afficher</th>
			                            <th style="width: 85px;padding-right: 15px;">Modifier</th>
			                            <th style="width: 115px;padding-right: 15px;">Mettre à jour</th>
			                            <th style="width:78px;padding-right: 15px;">Statut</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<?php foreach ($factures as $key => $facture): ?>
			                    		<?php if ( empty($facture->ref_parent_facture) ): ?>
					                    	<tr id="tr-facture-<?php echo $facture->id; ?>">
					                    		<td><strong><?php echo $facture->number; ?></strong></td>
					                    			
					                    		<td>
					                    			<a href="/uploads/<?php echo $facture->number; ?>.pdf" target="_blank" class="btn btn-default btn-xs" title="">Afficher</a>
					                    		</td>
					                    		<td>
					                    			<?php if ( $facture->status == 0 ): ?>
					                    				<?php $facture_family = facture::getByParentFacture($facture->id); ?>
					                    				<?php if (empty($facture_family) || $facture_family->status == 0): ?>
						                    				<a href="/factures/editer/id/<?php echo $facture->id; ?>" class="btn btn-default btn-xs btn-update" title="">Modifer</a>
					                    				<?php endif; ?>
					                    			<?php endif; ?>
					                    		</td>
					                    		<td style="width: 100px;">
					                    			<?php if ( $facture->status == 0 ): ?>
					                    				<a href="/uploads/<?php echo $facture->number; ?>.pdf" target="_blank" class="btn btn-default btn-xs js-update-facture" data-id="<?php echo $facture->id; ?>">Valider</a>
					                    			<?php endif; ?>
					                            </td>
					                    		<td style="width: 100px;">
					                    			<?php if ($facture->status == 0): ?>
					                    				<span class="label label-warning">En attente d'édition</span>
					                    			<?php else: ?>
					                    				<span class="label label-success">Édité</span>
					                    			<?php endif; ?>
					                            </td>
					                    	</tr>
			                    		
					                    	<?php if ( !empty($facture->amount_caf) ): ?>
						                    	<tr class="child">
						                    		<td><span class="chariot">↳</span> CAF : <?php echo $facture->total_amount - $facture->total_amount_facture; ?> €</td>
						                    		<td></td>
						                    		<td></td>
						                    		<td>
						                    			<?php if ( $facture->status_caf == 0 ): ?>
						                    				<button class="btn btn-default btn-xs js-update-caf" data-id="<?php echo $facture->id; ?>">Envoyé</button>
						                    			<?php endif; ?>
						                    		</td>
						                    		<td>
						                    			<?php if ($facture->status_caf == 0): ?>
						                    				<span class="label label-warning">En attente d'envoi</span>
						                    			<?php else: ?>
						                    				<span class="label label-success">Envoyé</span>
						                    			<?php endif; ?>
						                    		</td>
						                    	</tr>
					                    	<?php endif; ?>

				                    	<?php else: ?>
					                    	<tr id="tr-facture-<?php echo $facture->id; ?>" class="child" data-facture-parent="<?php echo $facture->ref_parent_facture; ?>">
					                    		<td><span class="chariot">↳</span> Famille : <?php echo $facture->number; ?></td>
					                    		<td>
					                    			<a href="/uploads/<?php echo $facture->number; ?>.pdf" target="_blank" class="btn btn-default btn-xs" title="">Afficher</a>
					                    		</td>
					                    		<td></td>
					                    		<td style="width: 100px;">
					                    			<?php if ($facture->status == 0): ?>
					                    				<a href="/uploads/<?php echo $facture->number; ?>.pdf" target="_blank" class="btn btn-default btn-xs js-update-facture" data-id="<?php echo $facture->id; ?>">Valider</a>
					                    		<?php endif; ?>
					                            </td>
					                    		<td style="width: 100px;">
					                    			<?php if ($facture->status == 0): ?>
					                    				<span class="label label-warning">En attente d'édition</span>
					                    			<?php else: ?>
					                    				<span class="label label-success">Édité</span>
					                    			<?php endif; ?>
					                            </td>
					                    	</tr>
			                    		<?php endif; ?>
			                    	<?php endforeach; ?>
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    </div>

			</div>
		</div>

	<?php endif; ?>
</div>

<?php ob_start(); ?>
<script>

$(function() {
	


	var $available = $('#js-table-available'),
		$searchAvailable = $('#js-search-available'),
		$selected = $('#js-table-selected'),
		$reliquats = $('#selected-reliquats'),
		$familleAmount = $('#amount_family'),
		$familleName = $('#family_name'),
		$cafAmount = $('#amount_caf'),
		$btnReset = $('#js-btn-reset'),
		$btnConfirm = $('#js-btn-confirm');

	$searchAvailable.on('keyup', debounce(function(e){
		var val = $(this).val().toLowerCase();
		$available.find('tr').show();

		if (val.length > 1) {
			$available.find('.title').each(function(index, el) {
				var $el = $(el),
					text = $el.text().toLowerCase();
				if (text.indexOf(val) == -1) {
					$el.parents('tr').hide();
				}
			});
		}
	}, 100));

	function checkVisible() {
		if( $selected.find('tr:visible').length ) {
			$selected.parents('.block-flat').addClass('active');
			$btnReset.removeAttr('disabled');
			$btnConfirm.removeAttr('disabled');
		} else {
			$selected.parents('.block-flat').removeClass('active');
			$btnReset.attr('disabled', 'disabled');
			$btnConfirm.attr('disabled', 'disabled');

			$reliquats.addClass('hide').find('.selected-reliquat-amount').text('0');
			$('#family_name, #amount_family, #amount_caf').attr('disabled', 'disabled');
			$('#amount_family').removeAttr('value');
		}
	}


	//
	// WHEN RESET FORM
	//
	$btnReset.on('click', function(event) {
		event.preventDefault();
		$available.find('tr').removeClass('selected');
		$selected.find('tr').addClass('hide');
		$('#family_name').removeAttr('value');
		$reliquats.addClass('hide').find('.selected-reliquat-amount').text('0');
		$('#family_name, #amount_family, #amount_caf').attr('disabled', 'disabled');
		$('#amount_family').val('');
		$('#number_commande').val('');
		checkVisible();
	});


	//
	// WHEN ADD ELEMENT TO SELECTED
	//
	$available.on('click', '.btn-add', function(event) {
		event.preventDefault();

		var $this = $(this),
			id = $this.data('id'),
			tarif = $this.data('tarif');

		$this
			.parents('tr').addClass('selected');

		$selected
			.find('#selected-' + id).removeClass('hide')
			.find('.tarif').val(tarif)
			.siblings('.solde').val(0);

		$selected.find('#selected-' + id).find('.tarif, .amount, .inscription_id').removeAttr('disabled');

		checkVisible();
	});


	//
	// WHEN REMOVE ELEMENT FROM SELECTED
	//
	$selected.on('click', '.btn-remove', function(event) {
		event.preventDefault();

		var $this = $(this),
			id = $this.data('id');
			$tarif = $this.parents('tr').find('.tarif');

			if ($tarif.val() < $tarif.data('init-tarif')) {
				
				$tarif.val($tarif.data('init-tarif'));

				$this
					.parents('tr').addClass('hide')
					.find('.tarif, .amount, .inscription_id').attr('disabled', 'disabled');

				var reliquats = 0;
				$selected.find('.tarif').each(function(index, el) {
					reliquats += ($(el).data('init-tarif') * 1) - ($(el).val() * 1);
				});

				if (reliquats === 0) {
					$reliquats.addClass('hide').find('.selected-reliquat-amount').text(0);
					$familleAmount.data('total-reliquats', '').val(0);
					$cafAmount.data('total-reliquats', '').val(0);
					$('#family_name, #amount_family, #amount_caf').attr('disabled', 'disabled');
				} else {
					$reliquats.removeClass('hide').find('.selected-reliquat-amount').text(reliquats);
					$('#family_name, #amount_family, #amount_caf').removeAttr('disabled');
					$familleAmount.val(reliquats).attr('data-total-reliquats', reliquats);
					$cafAmount.val(0).attr('data-total-reliquats', reliquats);
				}

				console.log($familleAmount.data('total-reliquats') );
			} else {

				$this
					.parents('tr').addClass('hide')
					.find('.tarif, .amount, .inscription_id').attr('disabled', 'disabled');
			}


			$available.find('#available-' + id).removeClass('selected');



		checkVisible();
	});


	//
	// WHEN CHANGE TARIF
	//
	$selected.on('keyup', '.tarif', debounce(function(e){
		var $this = $(this),
			initTarif = $this.data('init-tarif'),
			newTarif = $this.val();

			if(newTarif > initTarif) {
				$this.addClass('error');

				$('#selected-famille, #selected-caf').removeClass('hide')
					.find('.tarif, .amount, .inscription_id').removeAttr('disabled');


			} else {
				$this.removeClass('error');

				$('#selected-famille, #selected-caf').removeClass('hide')
					.find('.tarif, .amount, .inscription_id').removeAttr('disabled');
			}

			if (newTarif < initTarif) {
				var reliquats = 0;
				$selected.find('.tarif').each(function(index, el) {
					reliquats += ($(el).data('init-tarif') * 1) - ($(el).val() * 1);
				});
				$reliquats.removeClass('hide').find('.selected-reliquat-amount').text(reliquats);
				$('#family_name, #amount_family, #amount_caf').removeAttr('disabled');
				$familleAmount.val(reliquats).data('total-reliquats', reliquats);
				$cafAmount.val(0).data('total-reliquats', reliquats);

			} else {
				$reliquats.addClass('hide').find('.selected-reliquat-amount').text('0');
				$('#family_name, #amount_family, #amount_caf').attr('disabled', 'disabled');
				$('#amount_family').removeAttr('value');
			}

		$this.siblings('.solde').val( initTarif * 1 - newTarif * 1 );
	}, 150));


	//
	// WHEN CHANGE FAMILLE SOLDE
	//
	$familleAmount.on('keyup', debounce(function(e){
		var $this = $(this),
			val = $this.val(),
			totalVal = $this.data('total-reliquats');

		if (val < totalVal) {
			$cafAmount.val(totalVal * 1 - val * 1);
		} else if (val > totalVal) {
			$this.val(totalVal);
			$cafAmount.val(0);
		} else {
			$cafAmount.val(0);
		}
	}, 150));


	//
	// WHEN CHANGE CAF SOLDE
	//
	$cafAmount.on('keyup', debounce(function(e){
		var $this = $(this),
			val = $this.val(),
			totalVal = $this.data('total-reliquats');

		if (val < totalVal) {
			$familleAmount.val(totalVal * 1 - val * 1);
		} else if (val > totalVal) {
			$this.val(totalVal);
			$familleAmount.val(0);
		} else {
			$familleAmount.val(0);
		}
	}, 150));


	$familleName.on('keyup', debounce(function(e){
		if ($(this).val() !== '') {
			$(this).removeClass('error');
		}
	}, 150));


	//
	// WHEN SUBMIT FORM
	//
	$btnConfirm.on('click', function(event) {
		event.preventDefault();

		var error = 0;
		
		$selected.find('tr:visible').find('.tarif').each(function(index, el) {
			var $el = $(el),
				initTarif = $el.data('init-tarif'),
				newTarif = $el.val();

			if(newTarif > initTarif) {
				alert('Vous ne pouvez pas avoir de montant supérieur au tarif initial');
				error = error + 1;
			}

		});

		if( $familleAmount.val() * 1 > 0) {
			if ( $familleName.val() === '' ) {
				error = error + 1;
				$familleName.addClass('error');
			}
		}

		if (error) {
			return false;
		} else {
			$('#form-factures').submit();
		}
	});



	// AJAX statut

	var $facturesList = $('#factures-list'),
		$updateFactureStatus = $facturesList.find('.js-update-facture'),
		$updateCafStatus = $facturesList.find('.js-update-caf');

	$updateFactureStatus.on('click', function(event) {
		event.preventDefault();
		var $this = $(this),
			facture_id = $this.data('id'),
			$row = $this.closest('tr');

		$.ajax({
            type: 'GET',
            url: '/ajax/update_status_facture/id/' + facture_id + '/status/1',
		})
		.done(function() {
			$this.remove();
			$row.find('.btn-update').remove();
			var $tdLabel = $row.find('.label').parent();
			$tdLabel.find('.label').remove();
			$tdLabel.html('<span class="label label-success">Édité</span>');

			if (typeof $row.data('facture-parent') !== 'undefined' ) {
				$('#tr-facture-' + $row.data('facture-parent')).find('.btn-update').remove();
			}
		})
		.fail(function() {
			alert('Un erreur est survenue lors de la mise à jour de cette facture. Merci de réessayer ultérieurement.');
		})
		.always(function() {
			// console.log("complete");
		});
		
	});

	$updateCafStatus.on('click', function(event) {
		event.preventDefault();

		var $this = $(this),
			facture_id = $this.data('id'),
			$row = $this.closest('tr');


		$.ajax({
            type: 'GET',
            url: '/ajax/update_status_facture/id/' + facture_id + '/status/1/type/caf',
		})
		.done(function() {
			$this.remove();
			var $tdLabel = $row.find('.label').parent();
			$tdLabel.find('.label').remove();
			$tdLabel.html('<span class="label label-success">Envoyé</span>');
		})
		.fail(function() {
			alert('Un erreur est survenue lors de la mise à jour de cet élément. Merci de réessayer ultérieurement.')
		})
		.always(function() {
			// console.log("complete");
		});
		
	});


});
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>