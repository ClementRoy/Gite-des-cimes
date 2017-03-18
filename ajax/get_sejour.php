<?php 


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');

$app = new app();

$app->start();

//tool::output($_POST);
//echo json_encode($_POST);

extract($_GET);

//$sections = section::getByCP(substr($dept,0, 2));


if(isset($_GET['id']) && !empty($_GET['id'])){
	
	header('Content-Type: application/json; charset=utf-8');
	//echo $_GET['cp'];
	$id = $_GET['id'];

	$sejour = sejour::get($id);
	if(isset($sejour->hours_departure)){
		echo json_encode(array(
			'hours_departure' => unserialize($sejour->hours_departure),
			'hours_return' => unserialize($sejour->hours_return),
			'hours_intermediate_departure' => unserialize($sejour->hours_intermediate_return),
			'hours_intermediate_return' => unserialize($sejour->hours_intermediate_return),
			)) ;
	}
	else {
		echo '';
	}
	
}
// 	$data = array();
// 	//tool::output($deputes);
// 	foreach($sections as $section) {
// 		//echo $depute->firstname.'|'.$depute->lastname.'#';
// 		$data[] = array('id' => $section->id, 'name' => $section->name);
// 	}
// 	echo json_encode($data);
// }



?>