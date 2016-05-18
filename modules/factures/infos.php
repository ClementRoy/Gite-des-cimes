<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php 

	$year = $_GET['annee'];
	$season_id = $_GET['season'];
	$structure_id = $_GET['structure'];


// $facture = facture::get(43);
// $structure = structure::get($facture->ref_orga);
// $facture_items = factureItem::getByFacture($facture->id);

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
		
		$result = false;
		$total_amount = 0;
		foreach ($_POST['amount'] as $amount) {
			$total_amount += $amount;
		}
		$payed_amount = 0;
		foreach ($_POST['payed_amount'] as $amount) {
			$payed_amount += $amount;
		}
		$data = array(
			':number' => uniqid(),
			':ref_orga' => $structure_id,
			':status' => 'en attente',
			':total_amount' => $total_amount,
			':total_amount_facture' => $payed_amount,
			':ref_season' => $season_id,
			':year' => $year,
		);

		$result .= facture::add($data);
		$facture_id = facture::getLastID();

		foreach ($_POST['inscription_id'] as $key => $item) {

			$data = array(
				':ref_facture' => $facture_id,
				':ref_inscription' => $item,
				':amount' => $_POST['amount'][$key],
				':payed_amount' => $_POST['payed_amount'][$key],
			);

			$result .= factureItem::add($data);

		}

		if ($result) {

			facture::generate($facture_id);

        	tpl::alert('success', 'La facture a bien été enregistré.');
		} else {
			tpl::alert('danger', 'Une erreur s\'est produite durant l\'enregistrement de la facture =(.');
		}

	}


	$alreadyFactured = facture::getAlreadyFactured($structure_id, $season_id, $year);

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

<div class="well">
<ul>
	
	<li>Quels sont les différents statuts possibles pour les factures ?</li>
	<li>Quels sont les différents statuts possibles pour les soldes ?</li>
	<li>Concernant l'organisme "famille", il n'y a pas d'adresse</li>
	<li>Notion de dossier confirmé qui peuvent être facturé alors qu'ils n'ont pas eu lieu. Doit-on les bloquer ?</li>
</ul>
</div>

<div class="col-xs-12">
	<div class="row">
		<div class="col-xs-6">
			<div class="block-flat">
				<div class="header">							
					<h3>À facturer</h3>
				</div>
				<div class="content">
					<table class="table table-form" id="js-table-available">
						<?php foreach ($enfants as $key => $enfant): ?>
							<?php
								$inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year );
							 	foreach ($inscriptions as $key => $inscription):
							?>
								<tr id="available-<?php echo $inscription->id; ?>"<?php if (in_array($inscription->id, $alreadyFactured)): ?> class="disabled"<?php endif; ?>>
									<td>
										<div class="title"><?php echo $enfant->lastname.' '.$enfant->firstname; ?></div>
										<?php
											$date_from = new DateTime($inscription->date_from);
											$date_to = new DateTime($inscription->date_to);
										?>
										<div><?php echo $inscription->name; ?> du <?php echo strftime('%d %B', $date_from->getTimestamp()) ?> au <?php echo strftime('%d %B', $date_to->getTimestamp()) ?></div>
									</td>
									<td class="options">
										<?php if (in_array($inscription->id, $alreadyFactured)): ?>
											<span class="label label-primary">Déja facturé</span>
										<?php else: ?>
											<span class="label label-success">Ajouté</span>
										<?php endif; ?>
										<button class="btn btn-default btn-sm btn-add" data-id="<?php echo $inscription->id; ?>" data-tarif="<?php echo $inscription->price; ?>">Ajouter</button>
									</td>
								</tr>
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
									<label for="number_commande">N° de bon de commande (facultatif) : </label>&nbsp;
									<input name="number_commande" id="number_commande" type="text" class="form-control input-sm bon-de-commande">
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
										<label for="famille_name">Famille : </label>&nbsp;
										<input disabled="disabled" name="famille_name" id="famille_name" type="text" class="form-control input-sm tarif" placeholder="Nom de famille" style="text-align:left;width: 170px;">
									</td>
									<td class="form">
										<label for="famille_amount">Reliquat : </label>&nbsp;
										<input disabled="disabled" name="famille_amount" id="famille_amount" type="text" class="form-control input-sm tarif" value="0">
										/ <span class="selected-reliquat-amount">0</span>
									</td>
								</tr>

								<tr>
									<td>
										<label>Bon CAF</label>
									</td>
									<td class="form">
										<label for="caf_amount">Reliquat : </label>&nbsp;
										<input name="caf_amount" id="caf_amount" type="text" class="form-control input-sm tarif" value="0">
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
	<div class="row">
		<div class="col-xs-12 col-md-8">

		    <div class="section-head">
		        <div class="row">
		            <div class="col-xs-12 col-md-8">
		                <h3>Factures</h3>
		            </div>
		        </div>
		    </div>

		    <div class="block-flat tb-special tb-no-options tb-factures">
		        <div class="content">
		            <div class="table-responsive">
		                <table class="table table-bordered">
		                    <thead>
		                        <tr>
		                            <th style="min-width:150px;">Numéro de facture</th>
		                            <th></th>
		                            <th></th>
		                            <th style="width:78px">Statut</th>
		                            <th>Action</th>
		                        </tr>
		                    </thead>
		                    <tbody>
								<?php $factures = facture::getByStructureAndSeason($structure_id, $season_id, $year); ?>
		                    	<?php foreach ($factures as $key => $facture): ?>
			                    	<tr>
			                    		<td><?php echo $facture->number; ?></td>
			                    		<td>
			                    			<a href="" target="_blank" class="btn btn-default btn-xs" title="">Modifer</a>
			                    		</td>
			                    		<td>
			                    			<a href="/uploads/<?php echo $facture->number; ?>.pdf" target="_blank" class="btn btn-default btn-xs" title="">Voir la facture</a>
			                    		</td>
			                    		<td style="width: 100px;">
			                    			<?php if ($facture->status == 'en attente'): ?>
			                    				<span class="label label-warning">En attente d'édition</span>
			                    			<?php else: ?>
			                    				<span class="label label-success">Édité</span>
			                    			<?php endif ?>
			                            </td>
			                    		<td style="width: 100px;">
			                    			<a class="btn btn-default btn-xs" title="">Éditer</a>
			                            </td>
			                    	</tr>
			                    	<?php if ($facture->total_amount > $facture->total_amount_facture): ?>
				                    	<tr class="child">
				                    		<td><i class="fa fa-arrow-right"></i> Solde : <?php echo $facture->total_amount - $facture->total_amount_facture; ?> €</td>
				                    		<td></td>
				                    		<td></td>
				                    		<td>
				                    			<span class="label label-warning">En attente</span>
				                    			<?php /*<span class="label label-success">Soldée</span>*/ ?>
				                    		</td>
				                    		<td><a class="btn btn-default btn-xs" title=""> Soldé</a></td>
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
</div>

<?php ob_start(); ?>
<script>

$(function() {
	
	var $available = $('#js-table-available'),
		$selected = $('#js-table-selected'),
		$reliquats = $('#selected-reliquats'),
		$familleAmount = $('#famille_amount'),
		$familleName = $('#famille_name'),
		$cafAmount = $('#caf_amount'),
		$btnReset = $('#js-btn-reset'),
		$btnConfirm = $('#js-btn-confirm');



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
			$('#famille_name, #famille_amount, #caf_amount').attr('disabled', 'disabled');
			$('#famille_amount').removeAttr('value');
		}
	}


	//
	// WHEN RESET FORM
	//
	$btnReset.on('click', function(event) {
		event.preventDefault();
		$available.find('tr').removeClass('selected');
		$selected.find('tr').addClass('hide');
		$('#famille_name').removeAttr('value');
		$reliquats.addClass('hide').find('.selected-reliquat-amount').text('0');
		$('#famille_name, #famille_amount, #caf_amount').attr('disabled', 'disabled');
		$('#famille_amount').val('');
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

		$this
			.parents('tr').addClass('hide')
			.find('.tarif, .amount, .inscription_id').attr('disabled', 'disabled');

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
					reliquats += ($(el).data('init-tarif') * 1 - $(el).val() * 1);
				});
				$reliquats.removeClass('hide').find('.selected-reliquat-amount').text(reliquats);
				$('#famille_name, #famille_amount, #caf_amount').removeAttr('disabled');
				$familleAmount.val(reliquats).attr('data-total-reliquats', reliquats);
				$cafAmount.val(0).attr('data-total-reliquats', reliquats);

			} else {
				$reliquats.addClass('hide').find('.selected-reliquat-amount').text('0');
				$('#famille_name, #famille_amount, #caf_amount').attr('disabled', 'disabled');
				$('#famille_amount').removeAttr('value');
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


});
</script>
<?php $scripts .= ob_get_contents();
ob_end_clean(); ?>


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>