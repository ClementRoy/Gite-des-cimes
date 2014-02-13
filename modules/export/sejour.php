<?php  

extract($_GET);
$sejour = sejour::get($id);

$date_from = new DateTime($sejour->date_from);
$date_from_2 = new DateTime($sejour->date_from);
$date_to = new DateTime($sejour->date_to);

if($week == 3){
	$date_from_query = $date_from->modify('+14 days');
	$date_to_query =  $date_from_2->modify('+21 days');
}elseif($week == 2){
	$date_from_query = $date_from->modify('+7 days');
	$date_to_query = $date_from_2->modify('+14 days');
}else {
	$date_from_query = $date_from;
	$date_to_query = $date_from_2->modify('+7 days');
}	

if($type == 1){
// Récapitulatif mineur

	$inscriptions = inscription::getBySejourBetweenDates($id, $date_from_query, $date_to_query);


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
	CSV::export($datas, $filename, $headline);

}
elseif($type == 2){

	$inscriptions = inscription::getBySejourBetweenDates($id, $date_from_query, $date_to_query);

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
	CSV::export($datas, $filename, $headline);
	//tool::output($datas);

}
elseif($type == 3){

	$inscriptions = inscription::getBySejourBetweenDates($id, $date_from_query, $date_to_query);
	$datas = array();

	foreach ($inscriptions as $key => $inscription) {


	}

	$headline = utf8_decode('Suivi sanitaire - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	tool::output($datas);
// Registre des mineurs
/*
Nom	
Prénom	
Date Naissance	
Adresse de l'enfant	
Famille d'accueil (le cas échéant)	
Structure	
Nom Contact	
Tél structure	
Père	
Tél père	
Mère	
Tél Mère
*/

}

?>