<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/navbar.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php //require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>

<?php 

	$facture_id = $_GET['id'];
	$facture = facture::get($facture_id);

	if (!empty($facture) && $facture->status == 0):
?>

	<?php
		$year = $facture->year;
		$season_id = $facture->ref_season;
		$structure_id = $facture->ref_orga;
		// $datetime_now = new DateTime();


		$season = saison::get($season_id);
		$enfants = facture::getInscriptionsByStructureAndSeason($structure_id, $season_id, $year);
		$alreadyFactured = facture::getAlreadyFactured($structure_id, $season_id, $year);

		$factureItems = facture_item::getByFacture($facture_id);


		$factureItemsIds = array();
		foreach ($factureItems as $factureItem) {
			array_push($factureItemsIds, $factureItem->ref_inscription);
		}

		// tool::output( $factureItemsIds );

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
						<h3>À facturer</h3>
					</div>
					<div class="content">
						<table class="table table-form" id="js-table-available">
							<?php foreach ($enfants as $key => $enfant): ?>
								<?php
									$inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year );
								 	foreach ($inscriptions as $key => $inscription):
								?>

									<tr id="available-<?php echo $inscription->id; ?>"<?php if (in_array($inscription->id, $factureItemsIds)): ?> class="selected"<?php elseif (in_array($inscription->id, $alreadyFactured)): ?> class="disabled"<?php endif; ?>>
										<td>
											<div class="title"><?php echo $enfant->lastname.' '.$enfant->firstname; ?></div>
											<?php
												$date_from = new DateTime($inscription->date_from);
												$date_to = new DateTime($inscription->date_to);
											?>
											<div><?php echo $inscription->name; ?> du <?php echo strftime('%d %B', $date_from->getTimestamp()) ?> au <?php echo strftime('%d %B', $date_to->getTimestamp()) ?></div>
										</td>
										<td class="options">
											<?php if (!in_array($inscription->id, $factureItemsIds) && in_array($inscription->id, $alreadyFactured)): ?>
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
					<form id="form-factures" action="/factures/infos/annee/<?php echo $facture->year; ?>/season/<?php echo $facture->ref_season; ?>/structure/<?php echo $facture->ref_orga; ?>" method="POST">
						<input type="hidden" name="update_facture" value="1">
						<input type="hidden" name="facture_id" value="<?php echo $facture->id; ?>">
						<div class="header">							
							<h3>Facture en cours</h3>
						</div>
						<div class="content">

							<table class="table table-form table-bon-commande">
								<tr>
									<td class="form">
										<label for="purchase_order">N° de bon de commande (facultatif) : </label>&nbsp;
										<input name="purchase_order" id="purchase_order" type="text" class="form-control input-sm bon-de-commande" value="<?php echo $facture->purchase_order; ?>">
									</td>
								</tr>
							</table>
							
							<div class="placeholder-form hide">
								Ajouter des éléments pour créer votre facture
							</div>

							<table class="table table-form" id="js-table-selected">

								<?php foreach ($enfants as $key => $enfant): ?>
									<?php
										$inscriptions = facture::getInscriptionByChildBySeason($enfant->id, $season_id, $year );
									 	foreach ($inscriptions as $key => $inscription): ?>
										<?php if (in_array($inscription->id, $factureItemsIds)): ?>
											<?php $selectedFactureItem = facture_item::getByInscription($inscription->id); ?>
											<tr id="selected-<?php echo $inscription->id; ?>">
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
													<input name="payed_amount[]" id="tarif-<?php echo $inscription->id; ?>" type="text" class="form-control input-sm tarif" value="<?php echo $selectedFactureItem->payed_amount; ?>" data-init-tarif="<?php echo $inscription->price; ?>">
													/ <?php echo $inscription->price; ?>
													<input disabled="disabled" type="hidden" class="solde" value="0">
													<input name="amount[]" type="hidden" class="amount" value="<?php echo $inscription->price; ?>">
													<input name="inscription_id[]" type="hidden" class="inscription_id" value="<?php echo $inscription->id; ?>">
												</td>
												<td class="options">
													<button class="btn btn-default btn-sm btn-remove" data-id="<?php echo $inscription->id; ?>">Retirer</button>
												</td>
											</tr>
										<?php elseif (!in_array($inscription->id, $alreadyFactured)): ?>
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
							<div id="selected-reliquats"<?php if ($facture->total_amount == $facture->total_amount_facture): ?> class="hide"<?php endif; ?>>
								<h4>Reliquats</h4>

								<table class="table table-form table-reliquats">
									<?php if (!empty($facture->amount_family) && $facture->amount_family > 0): ?>
										<?php $structureFamily = facture::getByParentFacture($facture->id); ?>
										<tr>
											<td>
												<label for="family_name">Famille : </label>&nbsp;
												<input name="family_name" id="family_name" type="text" class="form-control input-sm tarif" placeholder="Nom de famille" value="<?php echo $structureFamily->family_name; ?>" style="text-align:left;width: 170px;">
											</td>
											<td class="form">
												<label for="amount_family">Reliquat : </label>&nbsp;
												<input name="amount_family" id="amount_family" type="text" class="form-control input-sm tarif" value="<?php echo $facture->amount_family; ?>"<?php if ($facture->total_amount > $facture->total_amount_facture): ?> data-total-reliquats="<?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?>"<?php endif; ?>>
												/ <span class="selected-reliquat-amount"><?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?></span>
											</td>
										</tr>
									<?php else: ?>
										<tr>
											<td>
												<label for="family_name">Famille : </label>&nbsp;
												<input disabled="disabled" name="family_name" id="family_name" type="text" class="form-control input-sm tarif" placeholder="Nom de famille" style="text-align:left;width: 170px;">
											</td>
											<td class="form">
												<label for="amount_family">Reliquat : </label>&nbsp;
												<input disabled="disabled" name="amount_family" id="amount_family" type="text" class="form-control input-sm tarif" value="0"<?php if ($facture->total_amount > $facture->total_amount_facture): ?> data-total-reliquats="<?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?>"<?php endif; ?>>
												/ <span class="selected-reliquat-amount"><?php if ($facture->total_amount > $facture->total_amount_facture): ?><?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?><?php else: ?>0<?php endif; ?></span>
											</td>
										</tr>
									<?php endif; ?>
									
									<?php if (!empty($facture->amount_caf) && $facture->amount_caf > 0): ?>
										<tr>
											<td>
												<label>Bon CAF</label>
											</td>
											<td class="form">
												<label for="amount_caf">Reliquat : </label>&nbsp;
												<input name="amount_caf" id="amount_caf" type="text" class="form-control input-sm tarif" value="<?php echo $facture->amount_caf; ?>"<?php if ($facture->total_amount > $facture->total_amount_facture): ?> data-total-reliquats="<?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?>"<?php endif; ?>>
												/ <span class="selected-reliquat-amount"><?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?></span>
											</td>
										</tr>
									<?php else: ?>
										<tr>
											<td>
												<label>Bon CAF</label>
											</td>
											<td class="form">
												<label for="amount_caf">Reliquat : </label>&nbsp;
												<input name="amount_caf" id="amount_caf" type="text" class="form-control input-sm tarif" value="0"<?php if ($facture->total_amount > $facture->total_amount_facture): ?> data-total-reliquats="<?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?>"<?php endif; ?>>
												/ <span class="selected-reliquat-amount"><?php if ($facture->total_amount > $facture->total_amount_facture): ?><?php echo ($facture->total_amount * 1) - ($facture->total_amount_facture * 1); ?><?php else: ?>0<?php endif; ?></span>
											</td>
										</tr>

									<?php endif; ?>
								</table>
							</div>

						</div>
					    <div class="footer footer-form | text-right">
					    	<input type="submit" class="btn btn-primary" id="js-btn-confirm" value="Modifier la facture">
					    </div>
				    </form>
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
			$familleAmount = $('#amount_family'),
			$familleName = $('#family_name'),
			$cafAmount = $('#amount_caf'),
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



	});
	</script>
	<?php $scripts .= ob_get_contents();
	ob_end_clean(); ?>

<?php endif; ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>