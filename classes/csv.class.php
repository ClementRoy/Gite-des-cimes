<?php

class CSV{

    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    static function export($datas,$filename){
        header('Content-Type: text/csv;');
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        $i = 0;
        foreach($datas as $v){ // pass by $key => $v, avoid $i
            if($i==0){
                echo '"'.implode('";"',array_keys($v)).'"'."\n";
            }
            echo '"'.implode('";"',$v).'"'."\n";
            $i++;
        }
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
    static function create(){

    }
 
}



?>