<?php  

extract($_GET);

if($type == 1){

	$sejour = sejour::get($id);
	$inscriptions = inscription::getBySejour($id);

	$datas = array();
	foreach ($inscriptions as $key => $inscription) {
		$enfant = enfant::get($inscription->ref_enfant);
		$birthdate = new DateTime($enfant->birthdate);
		$datas[] = array(
				'Nom' => $enfant->lastname,
				utf8_decode('Prénom') => $enfant->firstname,
				'Date de naissance' => strftime('%d %B %Y', $birthdate->getTimestamp()),
				'Age' => tool::getAgeFromDate($enfant->birthdate)
			);
	}
	//tool::output($datas);
	$headline = utf8_decode('Récapitulatif mineurs par age - '.$sejour->name.' du '.$sejour->date_from.' au '.$sejour->date_to);
	$filename = 'Récapitulatif mineurs par age - '.$sejour->name.' - ';
	CSV::export($datas, $filename, $headline);

}
elseif($type == 2){

}
elseif($type == 3){

}

?>