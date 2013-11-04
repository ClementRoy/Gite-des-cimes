<?php

class tool
{


	
	function __construct()
	{
		# code...
	}

	public static function getAgeFromDate(){
		return '28';
	}

	public static function getRandomProfile() {
		$genders = array('men', 'women');
		$gender = array_rand($genders);
		$id = rand(1,50);
		return 'http://api.randomuser.me/0.2/portraits/'.$genders[$gender].'/'.$id.'.jpg';
	}

	public static function getRandomImage() {
		return '';
	}


}

?>