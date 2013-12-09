<?php  

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/csv.class.php');
include('../classes/enfant.class.php');


$db = new DB();

$datas = CSV::parse('enfants.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	//print_r($data);
	if(!empty($data['1'])){
		$datasql = array( 'firstname' => utf8_encode($data['2']), 
					  'lastname' => utf8_encode($data['1'])
					);
		$sql = 'INSERT INTO enfant (firstname, lastname) value (:firstname, :lastname)';
		$db->insert($sql, $datasql);
		echo $data['1']."imported \n";
	}
}



?>