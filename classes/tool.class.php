<?php

class tool
{


	
	function __construct()
	{
		# code...
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function getAgeFromDate(){
		return '28';
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function getRandomProfile() {
		$genders = array('men', 'women');
		$gender = array_rand($genders);
		$id = rand(1,50);
		return 'http://api.randomuser.me/0.2/portraits/'.$genders[$gender].'/'.$id.'.jpg';
	}


    public static function cleanInput($var){
        return stripcslashes(trim($var));
    }

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function getRandomImage() {
		return '';
	}

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	public static function output($var) {
		echo '<hr />';
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

    public static function currentTime() {
        return date("Y-m-d H:i:s");
    }

}

?>