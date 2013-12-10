<?php

class JSON{

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    static function export($datas,$filename,$download = true){
       
        header('Content-Type: application/json; charset=utf-8');
        if($download){
            header('Content-Disposition: attachment; filename="'.$filename.'.json"');
        }
        json_encode($datas);
    }

    /**
     * desc
     *
     * @note 
     *
     * @param datas
     * @param filename
     * @param path
     */
    static function create(){}
 

     /**
     * desc
     *
     * @note 
     *
     * @param datas
     * @param filename
     * @param path
     */
    static function upload(){}

     /**
     * desc
     *
     * @note 
     *
     * @param datas
     * @param filename
     * @param path
     */
    static function get($file)
    {
        $json = file_get_contents($file);
        $result = json_decode($json, false);
        return $result;
        // $content = file($file);
        // $headers = NULL;
        // if($head)
        // {
        //     $headers = array_shift($content);
        //     $headers = explode($sep, $headers);
        // }
        // foreach($content as $k => $v)
        // {
        //     $content[$k] = explode($sep, $v);
        //     if($head) foreach($content[$k] as $num_col => $value)
        //         $content[$k][$headers[$num_col]] = $value;
        // }
        // return $content;
    }

}



?>