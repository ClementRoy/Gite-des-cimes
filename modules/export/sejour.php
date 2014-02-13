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

		$datas[] = array(
			'Nom' => utf8_decode($enfant->lastname),
			utf8_decode('Prénom') => utf8_decode($enfant->firstname),
			'Date de naissance' => $birthdate_string,
			"Adresse de l'enfant" => utf8_decode($enfant->firstname),
			utf8_decode("Famille d'accueil") => utf8_decode($enfant->firstname),
			utf8_decode('Structure') => (isset($organization->name))?utf8_decode($organization->name):'',
			utf8_decode('Nom Contact') => (isset($contact->lastname))?utf8_decode($contact->lastname).' '.utf8_decode($contact->firstname):'',
			utf8_decode('Tél structure') => (isset($organization->phone))?utf8_decode($organization->phone):'',
			utf8_decode('Père') => utf8_decode($enfant->father_name),
			utf8_decode('Tél père') => utf8_decode($enfant->father_phone_home).' '.utf8_decode($enfant->father_phone_mobile).' '.utf8_decode($enfant->father_phone_pro),
			utf8_decode('Mère') => utf8_decode($enfant->mother_name),
			utf8_decode('Tél Mère') => utf8_decode($enfant->mother_phone_home).' '.utf8_decode($enfant->mother_phone_mobile).' '.utf8_decode($enfant->mother_phone_pro),
		);


	}

	$headline = utf8_decode('Registre des mineurs - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	// tool::output($datas);
	// tool::output($inscriptions);
	$filename = 'Registre des mineurs - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);
// Registre des mineurs

}

?>