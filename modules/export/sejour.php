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
$inscriptions = inscription::getBySejourBetweenDatesFinished($id, $date_from_query, $date_to_query);

if($type == 1) {
	foreach ($inscriptions as $key => $inscription) {
	$enfant = enfant::get($inscription->ref_enfant);
	$birthdate = new DateTime($enfant->birthdate);
	if( $enfant->birthdate != '0000-00-00 00:00:00') {
	$birthdate_string = strftime('%d/%m/%Y', $birthdate->getTimestamp());
	}
	else {
	$birthdate_string = ' ';
	}
	
		
		$datas[] = array(
	utf8_decode('Nom') => utf8_decode($enfant->lastname),
	utf8_decode('Prénom') => utf8_decode($enfant->firstname),
	utf8_decode('Date de naissance') => utf8_decode($birthdate_string),
	utf8_decode('Age') => utf8_decode(tool::getAgeDetailFromDate($enfant->birthdate))
			);
	}
	//tool::output($datas);
	$headline = utf8_decode('Récapitulatif mineurs par âge - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	$filename = 'Récapitulatif mineurs par age - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);
} elseif($type == 2) {


	$datas = array();

	foreach ($inscriptions as $key => $inscription) {
                                $enfant = enfant::get($inscription->ref_enfant);
                                $birthdate = new DateTime($enfant->birthdate);
                                if( $enfant->birthdate != '0000-00-00 00:00:00') {
                                    $birthdate_string = strftime('%d/%m/%Y', $birthdate->getTimestamp());
                                }
                                else {
                                    $birthdate_string = ' ';
                                }

		$datas[] = array(

			 utf8_decode('Nom') => utf8_decode($enfant->lastname),
                                    utf8_decode('Prénom') => utf8_decode($enfant->firstname),
                                    utf8_decode('Date de naissance') => utf8_decode($birthdate_string),
                                    utf8_decode('N° sécurité sociale') => utf8_decode($enfant->number_ss),
                                    utf8_decode('Carnet de vaccination') => utf8_decode(($enfant->vaccination > 0)?'oui':'non'),
                                    utf8_decode('Traitement médical') => utf8_decode(($enfant->medicals_treatments > 0)?'oui':'non'),
                                    utf8_decode('Contre indications') => utf8_decode($enfant->allergies),
                                    utf8_decode('Fiche sanitaire') => utf8_decode(($enfant->health_record > 0)?'oui':'non')
		);
	}

	$headline = utf8_decode('Suivi sanitaire - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	$filename = 'Suivi sanitaire - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);
	//tool::output($datas);

} elseif($type == 3) {

	$datas = array();

	foreach ($inscriptions as $key => $inscription) {
$enfant = enfant::get($inscription->ref_enfant);
                                $birthdate = new DateTime($enfant->birthdate);
                                if( $enfant->birthdate != '0000-00-00 00:00:00') {
                                    $birthdate_string = strftime('%d/%m/%Y', $birthdate->getTimestamp());
                                }
                                else {
                                    $birthdate_string = ' ';
                                }
                                $address_host = '';
                                if(tool::check($enfant->father_address_number)){
                                    $address = $enfant->father_address_number." ".$enfant->father_address_street."\r"."\n".$enfant->father_address_postal_code." ".$enfant->father_address_city;
                                }elseif(tool::check($enfant->mother_address_postal_code)){
                                    $address = $enfant->mother_address_number." ".$enfant->mother_address_street."\r"."\n".$enfant->mother_address_postal_code." ".$enfant->mother_address_city;
                                }elseif(tool::check($enfant->guardian_address_street)){
                                    $address = $enfant->guardian_address_number." ".$enfant->guardian_address_street."\r"."\n".$enfant->guardian_address_postal_code." ".$enfant->guardian_address_city;
                                }else{
                                    $address = '';
                                }
                                $tel_father = '';
                                if(tool::check($enfant->father_phone_home)){
                                    $tel_father .= "\r"."\n".'Fixe : '.tool::formatTel($enfant->father_phone_home);
                                }
                                if(tool::check($enfant->father_phone_mobile)){
                                    $tel_father .= "\r"."\n".'Mobile : '.tool::formatTel($enfant->father_phone_mobile);
                                }
                                if(tool::check($enfant->father_phone_pro)){
                                    $tel_father .= "\r"."\n".'Pro : '.tool::formatTel($enfant->father_phone_pro);
                                }

                                $tel_mother = '';
                                if(tool::check($enfant->mother_phone_home)){
                                    $tel_mother .= "\r"."\n".'Fixe : '.tool::formatTel($enfant->mother_phone_home);
                                }
                                if(tool::check($enfant->mother_phone_mobile)){
                                    $tel_mother .= "\r"."\n".'Mobile : '.tool::formatTel($enfant->mother_phone_mobile);
                                }
                                if(tool::check($enfant->mother_phone_pro)){
                                    $tel_mother .= "\r"."\n".'Pro : '.tool::formatTel($enfant->mother_phone_pro);
                                }

                                $tel_host_family = '';
                                if(tool::check($enfant->host_family_phone_home)){
                                    $tel_host_family .= "\r"."\n".'Fixe : '.tool::formatTel($enfant->host_family_phone_home);
                                }
                                if(tool::check($enfant->host_family_phone_mobile)){
                                    $tel_host_family .= "\r"."\n".'Mobile : '.tool::formatTel($enfant->host_family_phone_mobile);
                                }
                                if(tool::check($enfant->host_family_phone_pro)){
                                    $tel_host_family .= "\r"."\n".'Pro : '.tool::formatTel($enfant->host_family_phone_pro);
                                }
                                $organization = structure::get($enfant->organization);
                                $contact = contact::get($enfant->contact);
		$datas[] = array(

                                    utf8_decode('Nom') => utf8_decode($enfant->lastname),
                                    utf8_decode('Prénom') => utf8_decode($enfant->firstname),
                                    utf8_decode('Date de naissance') => utf8_decode($birthdate_string),
                                    utf8_decode('Adresse') => utf8_decode($address),
                                    utf8_decode('Famille d\'accueil') => utf8_decode($enfant->host_family_name."\r"."\n".$tel_host_family),
                                    utf8_decode('Structure') => utf8_decode((tool::check($organization))?$organization->name:''),
                                    utf8_decode('Contact') => utf8_decode((tool::check($contact))?$contact->civility.' '.$contact->lastname.' '.$contact->firstname:''),
                                    utf8_decode('Tél contact') => utf8_decode((tool::check($organization))?tool::formatTel($organization->phone):''),
                                    utf8_decode('Père') => utf8_decode($enfant->father_name),
                                    utf8_decode('Tél père') => utf8_decode($tel_father),
                                    utf8_decode('Mère') => utf8_decode($enfant->mother_name),
                                    utf8_decode('Tél mère') => utf8_decode($tel_mother)
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