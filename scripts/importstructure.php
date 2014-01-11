<?php  

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/tool.class.php');
include('../classes/csv.class.php');
include('../classes/structure.class.php');

echo '<html><body style="background:#000;color:#fff">';
$db = new DB();

$datas = CSV::parse('structures.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	print_r($data);
	if(!empty($data['1'])){
		// $birthdate = explode('/', $data['2']);
		// $datasql = array( 
		// 				'created' => tool::currentTime(),
		// 				'edited' => tool::currentTime(),
		// 			    'firstname' => utf8_encode($data['1']), 
		// 			    'lastname' => utf8_encode($data['0']),
		// 			    'birthdate' => tool::currentTime( mktime(0, 0, 0, $birthdate['1'], $birthdate['0'], $birthdate['2'] )),
		// 			    'number_ss' => $data['11'],
		// 			    'note' => 'numero caf :'.$data['10']."\n".$data['19']."\n".$data['8'],
		// 			    'father_name' => $data['14'],
		// 			    'mother_name' => $data['15'],
		// 			    'father_phone' => $data['9']
		// 			);
		// $sql = 'INSERT INTO enfant (created, edited, firstname, lastname, birthdate, number_ss, note, father_name, mother_name, father_phone) 
		// 					value (:created, :edited, :firstname, :lastname, :birthdate, :number_ss, :note, :father_name, :mother_name, :father_phone)';
		// $db->insert($sql, $datasql);
		//structure::add($data);
		// echo $data['0']." imported \n";
	}
}


echo '</body></html>';

?>