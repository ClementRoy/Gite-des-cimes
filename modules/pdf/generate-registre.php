<?php  

extract($_GET);
$sejour = sejour::get($id);


/*
$timestamp = strtotime('Mon, 12 Dec 2011 21:17:52 +0000');
$dt = new DateTime();
$dt->setTimestamp($timestamp);
*/

$date_from_query = new DateTime();
$date_from_query->setTimestamp($datefrom);
$date_to_query = new DateTime();
$date_to_query->setTimestamp($dateto);

ob_start();

?>

<?php if($type == 1):
// Récapitulatif mineur

	$inscriptions = inscription::getBySejourBetweenDatesFinished($id, $date_from_query, $date_to_query);


	$datas = array();
	foreach ($inscriptions as $key => $inscription) {
		$enfant = enfant::get($inscription->ref_enfant);
		$birthdate = new DateTime($enfant->birthdate);
		if( $enfant->birthdate != '0000-00-00 00:00:00') {
			$birthdate_string = utf8_decode(strftime('%d %B %Y', $birthdate->getTimestamp()));
		}
		else {
			$birthdate_string = ' ';
		}
		
		
		$datas[] = array(
			'Nom' => utf8_decode($enfant->lastname),
			utf8_decode('Prénom') => utf8_decode($enfant->firstname),
			'Date de naissance' => $birthdate_string,
			'Age' => tool::getAgeDetailFromDate($enfant->birthdate)
			);
	}
	//tool::output($datas);
	$headline = utf8_decode('Récapitulatif mineurs par âge - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	$filename = 'Récapitulatif mineurs par age - '.$sejour->name.' - ';


	?>
<?php elseif($type == 2):

	$inscriptions = inscription::getBySejourBetweenDatesFinished($id, $date_from_query, $date_to_query);

	$datas = array();



	foreach ($inscriptions as $key => $inscription) {
		$enfant = enfant::get($inscription->ref_enfant);
		$birthdate = new DateTime($enfant->birthdate);
		if( $enfant->birthdate != '0000-00-00 00:00:00') {
			$birthdate_string = utf8_decode(strftime('%d %B %Y', $birthdate->getTimestamp()));
		}
		else {
			$birthdate_string = ' ';
		}

		$datas[] = array(
			'Nom' => utf8_decode($enfant->lastname),
			utf8_decode('Prénom') => utf8_decode($enfant->firstname),
			'Date de naissance' => $birthdate_string,
			utf8_decode('N° sécurité sociale') => utf8_decode($enfant->number_ss),
			'Carnet de vaccination' => ($enfant->vaccination > 0)?'oui':'non',
			utf8_decode('Traitement médical') => ($enfant->medicals_treatments > 0)?'oui':'non',
			'Contre indications' => utf8_decode($enfant->allergies),
			'Fiche sanitaire' => ($enfant->health_record > 0)?'oui':'non'
			);
	}


	$headline = utf8_decode('Suivi sanitaire - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	$filename = 'Suivi sanitaire - '.$sejour->name.' - ';
	

	?>

<?php elseif($type == 3):

	$inscriptions = inscription::getBySejourBetweenDatesFinished($id, $date_from_query, $date_to_query);
	$datas = array();

	foreach ($inscriptions as $key => $inscription) {
		$enfant = enfant::get($inscription->ref_enfant);
		$birthdate = new DateTime($enfant->birthdate);
		$organization = structure::get($enfant->organization);
		$contact = contact::get($enfant->contact);
		if( $enfant->birthdate != '0000-00-00 00:00:00') {
			$birthdate_string = utf8_decode(strftime('%d %B %Y', $birthdate->getTimestamp()));
		}
		else {
			$birthdate_string = ' ';
		}
		$address_host = '';
		if(!empty($enfant->father_address_number)){
			$address = $enfant->father_address_number.' '.$enfant->father_address_street.' '.$enfant->father_address_postal_code.' '.$enfant->father_address_city;
		}elseif(!empty($enfant->mother_address_postal_code)){
			$address = $enfant->mother_address_number.' '.$enfant->mother_address_street.' '.$enfant->mother_address_postal_code.' '.$enfant->mother_address_city;
		}elseif(!empty($enfant->guardian_address_street)){
			$address = $enfant->guardian_address_number.' '.$enfant->guardian_address_street.' '.$enfant->guardian_address_postal_code.' '.$enfant->guardian_address_city;
		}elseif(!empty($enfant->host_family_address_street)){
			$address = $enfant->host_family_address_number.' '.$enfant->host_family_address_street.' '.$enfant->host_family_address_postal_code.' '.$enfant->host_family_address_city;
			$address_host = $enfant->host_family_address_number.' '.$enfant->host_family_address_street.' '.$enfant->host_family_address_postal_code.' '.$enfant->host_family_address_city;
		}else{
			$address = '';
		}


// (isset($organization->father_phone_home))?'tel : '.utf8_decode($enfant->father_phone_home)."\n ".:''.(isset($organization->father_phone_mobile))?"mobile : ".utf8_decode($enfant->father_phone_mobile)."\n":''.(isset($organization->father_phone_pro))?" pro : ".utf8_decode($enfant->father_phone_pro):'',
		$tel_father = '';
		if(isset($enfant->father_phone_home) && !empty($enfant->father_phone_home)){
			$tel_father .= 'tel : '.$enfant->father_phone_home."\n";
		}
		if(isset($enfant->father_phone_mobile) && !empty($enfant->father_phone_mobile)){
			$tel_father .= 'mobile : '.$enfant->father_phone_mobile."\n";
		}
		if(isset($enfant->father_phone_pro) && !empty($enfant->father_phone_pro)){
			$tel_father .= 'pro : '.$enfant->father_phone_pro."\n";
		}

		$tel_mother = '';

		if(isset($enfant->mother_phone_home) && !empty($enfant->mother_phone_home)){
			$tel_mother .= 'tel : '.$enfant->mother_phone_home."\n";
		}
		if(isset($enfant->mother_phone_mobile) && !empty($enfant->mother_phone_mobile)){
			$tel_mother .= 'mobile : '.$enfant->mother_phone_mobile."\n";
		}
		if(isset($enfant->mother_phone_pro) && !empty($enfant->mother_phone_pro)){
			$tel_mother .= 'pro : '.$enfant->mother_phone_pro."\n";
		}

// 'tel : '.utf8_decode($enfant->mother_phone_home)."\n mobile : ".utf8_decode($enfant->mother_phone_mobile)."\n pro : ".utf8_decode($enfant->mother_phone_pro),
		$datas[] = array(
			utf8_decode($enfant->lastname),
			utf8_decode($enfant->firstname),
			$birthdate_string,
			utf8_decode($address),
			utf8_decode($enfant->host_family_name).(isset($address_host))?utf8_decode($address_host):'',
			(isset($organization->name))?utf8_decode($organization->name):'',
			(!empty($contact))?utf8_decode($contact->civility).' '.utf8_decode($contact->lastname).' '.utf8_decode($contact->firstname):'',
			(isset($organization->phone))?utf8_decode($organization->phone):'',
			utf8_decode($enfant->father_name),
			$tel_father,
			utf8_decode($enfant->mother_name),
			$tel_mother,
			);


	}

	$headline = utf8_decode('Registre des mineurs - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));

	$filename = 'Registre des mineurs - '.$sejour->name.' - ';
	?>


	<style type="text/css">
		table {
			width: 100%;
			font-size: 9px;
			vertical-align: top;
			border: 1px solid black;

			border-collapse:collapse;
		}
		th,
		td {
			border: 1px solid #999;
			padding: 5px;
			line-height: 10px;
		}
	</style>
	<page backtop="6mm" backleft="10mm" backright="10mm" backbottom="0mm">

	<h1>Recapitulatif</h1>
		<table style="width:100%;">
			<?php 
			?>
			<thead>
				  <tr style="background:#ccc; color: black;">
					    <th>Nom</th>
					    <th>Prénom</th>
					<th >Date de naissance</th>
					<th>Adresse de l'enfant</th>
					<th>Famille d'accueil</th>
					<th>Structure</th>
					<th>Nom du contact</th>
					<th>Tél structure</th>
					<th>Père</th>
					<th>Tél père</th>
					<th>Mère</th>
					<th>Tél mère</th>
				  </tr>
			</thead>
			<tbody>
				<?php foreach($datas as $key => $data): ?>
					<?php if($key%2 == 0): ?>
						<tr style="background:#fff;">
					<?php else: ?>
						<tr style="background:#eee;">
					<?php endif; ?>
					
						<td style="font-weight:bold;"><?=$data['0'] ?></td>
						<td><?=$data['1'] ?></td>
						<td><?=$data['2'] ?></td>
						<td  style="width:100px;"><?=$data['3'] ?></td>
						<td><?=$data['4'] ?></td>
						<td style="width:50px;"><?=$data['5'] ?></td>
						<td style="width:50px;"><?=$data['6'] ?></td>
						<td><?=tool::formatTel($data['7']) ?></td>
						<td style="width:50px;"><?=$data['8'] ?></td>
						<td><?=$data['9'] ?></td>
						<td style="width:50px;"><?=$data['10'] ?></td>
						<td><?=$data['11'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</page>






<?php endif; ?>

<?php

$content = ob_get_clean(); 
//echo $content;
try{
	$pdf = new HTML2PDF('L', 'A4', 'fr');
	$pdf->writeHTML($content);
	//$pdf->Output($type.'_'.$id.'.pdf');
	$pdf->Output($type.'_'.$id.'.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}

?>