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

/*
    [0] => ASE BEAUMONT
    [1] => 
    [2] => 
    [3] => x
    [4] => 0
    [5] => x
    [6] => 01 34 70 97 63
    [7] => 01 30 34 03 41
    [8] => 
    [9] => 
    [Structure] => ASE BEAUMONT
    [Service] => 
    [numero] => 
    [AdresseStructure] => x
    [CPStructure] => 0
    [VilleStructure] => x
    [FaxStructure] => 01 34 70 97 63
    [TelStructure] => 01 30 34 03 41
    [Observations] => 
    [email

*/


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