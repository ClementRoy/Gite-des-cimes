<?php  

extract($_GET);

if($type == 1){
// Récapitulatif mineur
	$sejour = sejour::get($id);
	$inscriptions = inscription::getBySejour($id);

	$datas = array();
	foreach ($inscriptions as $key => $inscription) {
		$enfant = enfant::get($inscription->ref_enfant);
		$birthdate = new DateTime($enfant->birthdate);
		$datas[] = array(
				'Nom' => utf8_decode($enfant->lastname),
				utf8_decode('Prénom') => utf8_decode($enfant->firstname),
				'Date de naissance' => $birthdate->format('j F Y'),
				'Age' => tool::getAgeDetailFromDate($enfant->birthdate)
			);
	}
	//tool::output($datas);
	
	$date_from = new DateTime($sejour->date_from);
	$date_to = new DateTime($sejour->date_to);
	$headline = utf8_decode('Récapitulatif mineurs par age - '.$sejour->name.' du '.$date_from->format('j F Y').' au '.$date_to->format('j F Y'));
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