<?php  

	$id = $_GET['id'];
	global $db;
	// Query
	$datas = array(
			':id' => $id
		);
	$contacts = contact::getByStructure($id);

	foreach ($contacts as $contact) {
		echo $contact->lastname;
	}
	//tool::output($contacts);

	// if(isset($contacts[0])){
	// 	if(count($contacts) > 1){
	// 		foreach ($contacts as $contact) {
	// 			echo  "|".$contact["firstname"];
	// 		}
	// 	} else{
	// 		echo $contacts[0]["firstname"];
	// 	}
	// } else{
	// 	echo "no_result";
	// }


?>

