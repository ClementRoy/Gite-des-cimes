<?php 


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');

$app = new app();

$app->start();

//tool::output($_POST);
//echo json_encode($_POST);

extract($_GET);

//$sections = section::getByCP(substr($dept,0, 2));


if (isset($_GET['sejour_id']) && !empty($_GET['sejour_id'])) {
	
	header('Content-Type: application/json; charset=utf-8');
	//echo $_GET['cp'];
	$sejour_id = $_GET['sejour_id'];

	$result = inscription::getBySejour($sejour_id);

	$sejour = sejour::get($sejour_id);

	if ( count($result) >= $sejour->capacity_max ){
		echo 'true';
	}
	else {
		echo 'false';
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