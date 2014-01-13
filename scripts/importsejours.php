<?php  

die();

// Load classes
// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/tool.class.php');
include('../classes/csv.class.php');
include('../classes/user.class.php');
include('../classes/sejour.class.php');

echo '<html><body style="background:#000;color:#fff">';
$db = new DB();

$datas = CSV::parse('sejours.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	//print_r($data);
	if(!empty($data['1'])){

		$date_from = explode('/', $data['date_from']);
		$date_to = explode('/', $data['date_to']);

        $metadata = array(
                            ':created' => tool::currentTime(),
                            ':edited' => tool::currentTime(),
                            ':creator' => '1', 
                            ':editor' => '1', 
                        );

		$datasql = array( 
						':name' => utf8_encode($data['nom']), 
		 			  	':date_from' => tool::currentTime( mktime(0, 0, 0, $date_from['1'], $date_from['0'], $date_from['2'] )),
						':date_to' => tool::currentTime( mktime(0, 0, 0, $date_to['1'], $date_to['0'], $date_to['2'] )),
						':place' => utf8_encode($data['place']),
						':capacity_max' => $data['min'],
						':capacity_min' =>$data['max'],
						':price' => $data['8']
		 			);

		sejour::add($datasql, $metadata);
		//$db->insert($sql, $datasql);
		echo $data['nom']."imported \n";
	}
}



echo '</body></html>';



?>