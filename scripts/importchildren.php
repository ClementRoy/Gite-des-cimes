<?php  

// Load classes
include('../config/mysql.php');
include('../classes/db.class.php');
include('../classes/tool.class.php');
include('../classes/csv.class.php');
include('../classes/enfant.class.php');
include('../classes/user.class.php');

$db = new DB();

$datas = CSV::parse('enfants_complements.csv');

echo '<pre>';

foreach ($datas as $key => $data) {
	tool::output($data);

        $enfant = enfant::getByName($data[0]);
        //tool::output($enfant);

    if(isset($enfant) && !empty($enfant)){


                $datasql = array(                
                    ':father_phone_home' => $data[1]
                    );                              
        $result = enfant::updateByName($datasql, $data[0]);
        echo $data['0']." imported \n";
    }
    else {
        echo $data['0']." NOT imported \n";
    }

	if(!empty($data['3'])){

        $metadata = array(
                            ':created' => $data[3],
                            ':edited' => $data[4],
                            ':creator' => '1', 
                            ':editor' => '1', 
                            ':archived' => 0
                        );

                $datasql = array(                
                    ':firstname' => $data['firstname'],
                    ':lastname' => $data['lastname'],
                    ':birthdate' => $data['birthdate'],
                    ':sex' => $data['sex'],
                    ':registration_by' => $data['registration_by'],
                    ':organization' => $data['organization'],
                    ':contact' => $data['contact'],
                    ':guardian' => $data['guardian'],
                    ':father_name' => $data['father_name'],
                    ':father_phone_home' => $data['father_phone'],
                    ':mother_name' => $data['mother_name'],
                    ':mother_phone_home' => $data['mother_phone'],
                    ':guardian_name' => $data['guardian_name'],
                    ':guardian_phone_home' => $data['guardian_phone'],
                    ':guardian_address_number' => $data['guardian_address_number'],
                    ':guardian_address_street' => $data['guardian_address_street'],
                    ':guardian_address_postal_code' => $data['guardian_address_postal_code'],
                    ':guardian_address_city' => $data['guardian_address_city'],
                    ':emergency_name' => $data['emergency_name'],
                    ':emergency_phone' => $data['emergency_phone'],
                    ':domiciliation' => $data['domiciliation'],
                    ':host_family_name' => $data['host_family_name'],
                    ':host_family_phone_home' => $data['host_family_phone'],
                    ':host_family_address_number' => $data['host_family_address_number'],
                    ':host_family_address_street' => $data['host_family_address_street'],
                    ':host_family_address_postal_code' => $data['host_family_address_postal_code'],
                    ':host_family_address_city' => $data['host_family_address_city'],
                    ':image_rights' => $data['image_rights'],
                    ':medicals_treatments' => $data['medicals_treatments'],
                    ':allergies' => $data['allergies'],
                    ':number_ss' => $data['number_ss'],
                    ':self_assurance' => $data['self_assurance'],
                    ':self_assurance_expiration_date' => $data['self_assurance_expiration_date'],
                    ':cpam_attestation' => $data['cpam_attestation'],
                    ':vaccination' => $data['vaccination'],
                    ':health_record' => $data['health_record'],
                    ':stay_record' => $data['stay_record'],
                    ':note' => $data['42']
                    );
		// $sql = 'INSERT INTO enfant (created, edited, firstname, lastname, birthdate, number_ss, note, father_name, mother_name, father_phone) 
		// 					value (:created, :edited, :firstname, :lastname, :birthdate, :number_ss, :note, :father_name, :mother_name, :father_phone)';
		// $db->insert($sql, $datasql);
		//$result = enfant::add($datasql, $metadata);
		//tool::output($datasql);
		echo $data['0']." imported \n";
	}
}



?>