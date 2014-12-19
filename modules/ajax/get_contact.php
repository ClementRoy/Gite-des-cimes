<?php  
	$id = $_GET['id'];
	global $db;
	$contacts = contact::getByStructure($id);

	if(count($contacts) > 0){
		foreach ($contacts as $key => $contact) {
			echo $contact->civility.' '.$contact->lastname.' '.$contact->firstname.'|'.$contact->id;
			if(count($contacts) > 1 && $key+1 != count($contacts)){
				echo '#';
			}
		}
	}
?>