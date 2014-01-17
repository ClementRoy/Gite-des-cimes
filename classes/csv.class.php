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
 
    static function parse($file, $head = true, $delimiter = ';')
    {
        $content = file($file);
        $headers = NULL;
        if($head)
        {
            $headers = array_shift($content);
            $headers = explode($delimiter, $headers);
        }
        foreach($content as $k => $v)
        {
            $content[$k] = explode($delimiter, $v);
            if($head) foreach($content[$k] as $num_col => $value)
                $content[$k][$headers[$num_col]] = $value;
        }
        return $content;
    }

}



?>