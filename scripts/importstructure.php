<?php  

die();

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/tool.class.php');
include('../classes/csv.class.php');
include('../classes/user.class.php');
include('../classes/structure.class.php');

echo '<html><body style="background:#000;color:#fff">';
$db = new DB();

$datas = CSV::parse('structures.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	//print_r($data);
	if(!empty($data['0'])){

        $metadata = array(
                            ':created' => tool::currentTime(),
                            ':edited' => tool::currentTime(),
                            ':creator' => '1', 
                            ':editor' => '1', 
                        );

	    $datas = array(
	            ':name' => $data['0'],
	            ':service' => $data['1'],
	            ':payer' => '0',
	            ':email' => $data['9'],
	            ':phone' => $data['7'],
	            ':fax' => $data['6'],
	            ':address_number' => $data['2'],
	            ':address_street' => $data['3'],
	            ':address_postal_code' => $data['4'],
	            ':address_city' => $data['5'],
	            ':note' => $data['8']
	            );

		structure::add($datas, $metadata);
		echo $data['0']." imported \n";
	}
}


echo '</body></html>';

?>