<?php  

die();

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/tool.class.php');
include('../classes/csv.class.php');
include('../classes/enfant.class.php');
include('../classes/structure.class.php');
include('../classes/contact.class.php');

echo '<html><body style="background:#000;color:#fff">';

$db = new DB();

$datas = CSV::parse('contacts.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	//print_r($data);
	if(!empty($data['0'])){

		// Structure reference
		$structure = structure::getByName($data['3']);
		$structure_id = '';
		if($structure)
			$structure_id = $structure->id;

        $metadata = array(
                            ':created' => tool::currentTime(),
                            ':edited' => tool::currentTime(),
                            ':creator' => '1', 
                            ':editor' => '1', 
                        );
        $datas = array(
	            ':ref_structure' => $structure_id,
	            ':civility' => $data['2'],
	            ':lastname' => utf8_encode($data['0']),
	            ':firstname' => utf8_encode($data['1']),
	            ':title' => utf8_encode($data['9']),
	            ':fax' => $data['7'],
	            ':email' => $data['4'],
	            ':mobile_phone' => $data['5'],
	            ':phone' => $data['6'],
	            ':fax' => $data['5'],
	            ':note' => utf8_encode($data['8'])
        	);


		if(contact::add($datas, $metadata)){
			echo $data['0']." imported \n";
		}
		else {
			echo $data['0']." NOT imported \n";
		}
		
	}
}


echo '</body></html>';

?>