<?php 


require($_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php');

$app = new app();

$app->start();

//tool::output($_POST);
//echo json_encode($_POST);

extract($_GET);

//$sections = section::getByCP(substr($dept,0, 2));


if(isset($_GET['sejour_id']) && !empty($_GET['sejour_id']) && !empty($_GET['enfant_id']) ){
	
	header('Content-Type: application/json; charset=utf-8');
	//echo $_GET['cp'];
	$enfant_id = $_GET['enfant_id'];
	$sejour_id = $_GET['sejour_id'];

	$result = inscription::getBySejourAndEnfant($sejour_id, $enfant_id);

	//echo json_encode($result) ;

	if(count($result) > 0){
		echo 'true';
	}
	else {
		echo 'false';
	}
	
}

?>