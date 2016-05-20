<?php  
	$id = $_GET['id'];
	$status = $_GET['status'];
	global $db;

	if (isset($_GET['type']) && $_GET['type'] == 'caf') {

		$datas = array(
			':status_caf' => $status,
		);

		$result = facture::update($datas, $id);

	} else {
		$datas = array(
			':status' => $status,
		);

		$result = facture::update($datas, $id);
	}


	echo true;
?>