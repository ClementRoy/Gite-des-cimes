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
			utf8_decode('Nom') => utf8_decode($enfant->lastname),
			utf8_decode('Prénom') => utf8_decode($enfant->firstname),
			utf8_decode('Date de naissance') => $birthdate_string,
			utf8_decode("Adresse de l'enfant") => utf8_decode($address),
			utf8_decode("Famille d'accueil") => utf8_decode($enfant->host_family_name).(isset($address_host))?utf8_decode($address_host):'',
			utf8_decode('Structure') => (isset($organization->name))?utf8_decode($organization->name):'',
			utf8_decode('Nom Contact') => (!empty($contact))?utf8_decode($contact->civility).' '.utf8_decode($contact->lastname).' '.utf8_decode($contact->firstname):'',
			utf8_decode('Tél structure') => (isset($organization->phone))?utf8_decode($organization->phone):'',
			utf8_decode('Père') => utf8_decode($enfant->father_name),
			utf8_decode('Tél père') => $tel_father,
			utf8_decode('Mère') => utf8_decode($enfant->mother_name),
			utf8_decode('Tél Mère') => $tel_mother,
		);


	}

	$headline = utf8_decode('Registre des mineurs - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	//tool::output($datas);
	//tool::output($inscriptions);
	$filename = 'Registre des mineurs - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);
// Registre des mineurs

}

?>