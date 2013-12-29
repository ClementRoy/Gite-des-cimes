<?php  

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/csv.class.php');


$db = new DB();

$datas = CSV::parse('sejours.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	//print_r($data);
	if(!empty($data['1'])){
		$datasql = array( 'name' => utf8_encode($data['nom']), 
		 			  	'date_from' => utf8_encode($data['date_debut']),
						'date_to' => utf8_encode($data['date_fin']),
						'created' => time(),
						'place' => utf8_encode($data['lieu']),
						'capacity_max' => utf8_encode($data['nb_min']),
						'capacity_min' =>utf8_encode($data['5'])
		 			);
		$sql = 'INSERT INTO sejour (name, date_from, date_to, created, place, capacity_max, capacity_min) value (:name, :date_from, :date_to, :created, :place, :capacity_max, :capacity_min)';
		$db->insert($sql, $datasql);
		echo $data['1']."imported \n";
	}
}






?>