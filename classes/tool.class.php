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
        

    public static function getNbWeeks($fromDate, $toDate){
        if($fromDate->diff($toDate)->format('%d') > 21){
            return 4;
        }
        elseif($fromDate->diff($toDate)->format('%d') > 14){
            return 3;
        }
        elseif($fromDate->diff($toDate)->format('%d') > 7){
            return 2;
        }
        elseif($fromDate->diff($toDate)->format('%d') > 6){
            return 1;
        }
        else {
            return 0;
        }
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

    public static function formatTel($tel){
        $tel = str_replace(' ', '', $tel);
        $tel = chunk_split($tel, 2, " ");
        return $tel;
    }

    public static function RemoveSpaces($string){
        $string = str_replace(' ', '', $string);
        return $string;
    }

    public static function check($data){
        if(isset($data) && !empty($data)){
            return $data;
        }
        else{
            return false;
        }
    }


    public static function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

}

?>