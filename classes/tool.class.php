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
	public static function getAgeFromDate($date){
        $today = new DateTime();
        $diff = $today->diff(new DateTime($date));
		return $diff->format('%Y');
	}


    public static function getAgeDetailFromDate($date){
        if($date != '0000-00-00 00:00:00'){
            $today = new DateTime();
            $diff = $today->diff(new DateTime($date));
            return $diff->format('%Y ans %m mois');        
        }else {
            return '';
        }

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

    public static function currentTime($time = NULL ) {
        if(isset($time)){
            return date("Y-m-d H:i:s", $time);
        }
        else {
            return date("Y-m-d H:i:s");
        }
    }

    public static function generateDatetime($date){
        $date = explode('/', $date);
        if(isset($date['2'])){
            
            return self::currentTime(mktime(0,0,0,$date['1'],$date['0'],$date['2']));
        }
        else{
            return false;
        }
        
    }

    public static function getDatefromDatetime($datetime){
         $date = explode(' ', $datetime);
         $date = explode('-', $date['0']);
         if($date['0'] != '0000'){
            $date = $date['2'].'/'.$date['1'].'/'.$date['0'];
         }
         else {
            $date = '';
         }
         return $date;
    }
        

    public static function getCurrentUser(){
        return $_SESSION['Auth']['id'];
    }


    public static function getLatLng($address) {

        $uri = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&region=FR";
        $url = file_get_contents($uri);
        $response = json_decode($url);
        if(count($response->results) > 0){
            $lat = $response->results[0]->geometry->location->lat;
            $lng = $response->results[0]->geometry->location->lng; 
        }else {
            $lat = false;
            $lng = false;
        }

        return array($lat, $lng);
    }
}

?>