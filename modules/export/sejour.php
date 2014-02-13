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
		$datas[] = array(
				'Nom' => utf8_decode($enfant->lastname),
				utf8_decode('Prénom') => utf8_decode($enfant->firstname),
				'Date de naissance' => utf8_decode(strftime('%d %B %Y', $birthdate->getTimestamp())),
				'Age' => tool::getAgeDetailFromDate($enfant->birthdate)
			);
	}
	//tool::output($datas);
	$headline = utf8_decode('Récapitulatif mineurs par age - '.$sejour->name.' du '.strftime('%d %B %Y', $date_from_query->getTimestamp()).' au '.strftime('%d %B %Y', $date_to_query->getTimestamp()));
	$filename = 'Récapitulatif mineurs par age - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);

}
elseif($type == 2){
//Suivi sanitaire
/*
Nom	
Prénom	
Date de naissance	
N° sécurité sociale	
Carnet de vaccination (oui/non)	
Traitement médical	
Contre indications	
Fiche sanitaire (oui/non)
*/
	$inscriptions = inscription::getBySejourBetweenDates($id, $date_from_query, $date_to_query);

	tool::output($inscriptions);

}
elseif($type == 3){
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