<?php

class media
{
    private static $table = 'medias';

    
    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
	function __construct()
	{
		# code...
	}



    /**
     * Get an object from its id
     *
     * @param int id of the object
     * @return object result of the query
     */
    public static function get($id){
        global $db;
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM '.self::$table.' WHERE id=:id';
        $result = $db->row($sql, $params);
        return $result;
    }



    /**
     * desc
     *
     * @note 
     *
     * @param
     * @return
     */
    public static function getList($limit = false, $offset = 0){
        global $db;
        if(!empty($limit)){
            $data = array();
            $result = $db->query('SELECT * FROM '.self::$table.' LIMIT 5 OFFSET 0', $data);
        }
        else {
            $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 0 ORDER BY title');
        }
        return $result;
    }


    public static function getListByHebergement(){
        return false;
    }

    public static function getFromTrash(){
        global $db;
        $result = $db->query('SELECT * FROM '.self::$table.' WHERE archived = 1 ORDER BY title');
        return $result;
    }

    
    /**
     * Count the number of entries in the database table
     *
     * @return int number of the entries in the table
     */
    public static function countAll(){
        global $db;
        $result = $db->row('SELECT COUNT(*) FROM '.self::$table.'');
        return $result;
    }


    /**
     * Insert a new object into the database
     *
     * @param array data to insert
     * @param array override the metadata
     * @return boolean query result
     */
    public static function add($data = array(), $metadata = false){
        global $db;

        // Handle Metadata infos
        // if(!$metadata) {
        //     $metadata = array(
        //                         ':created' => tool::currentTime(),
        //                         ':edited' => tool::currentTime(),
        //                         ':creator' => user::getCurrentUser(), 
        //                         ':editor' => user::getCurrentUser(), 
        //                     );
        // }

        // // Merge the data and metadatas arrays
        // $data = array_merge($metadata, $data);

        // Build the Query, be careful, vars must be prefixed with ":"
        $bind = implode(', ', array_keys($data)); 
        $entries = '';
        foreach (array_keys($data) as $key => $name) {
            if($key !=0)
                $entries .= ',';
            $entries .=  substr($name, 1);
        }    
        $sql = 'INSERT INTO '.self::$table.' (' . $entries . ') ' . 'values (' . $bind . ')';

        $result = $db->insert($sql, $data);
        
        return $result;
    }



    public static function getLastID(){
        global $db;
        return $db->lastInsertId('id');
    }



    public static function upload($file = false){
        //tool::output($file);
        
        if($file){
            /*
            $datas_file = array(
                        ':file_name' => $file['name'],
                        ':file_type' => $file['type'],
                        ':file_size' => $file['size'],
                        ':file_tmp_name' => $file['tmp_name'],
                        );
            */

            if(is_dir(UPLOAD_FOLDER) == false){
                mkdir(UPLOAD_FOLDER, 0700); // Create directory if it does not exist
            }

            if(is_dir(UPLOAD_FOLDER.$file['name']) == false){
                move_uploaded_file($file['tmp_name'],UPLOAD_FOLDER.$file['name']);
            }
            else {                                  //rename the file if another one exist
                $file['name'] =  $file['name'].time();
                $new_dir = UPLOAD_FOLDER.$file['name'];
                rename($file['tmp_name'],$new_dir) ;               
            }
            $datas_file = array(
                        ':file_name' => $file['name'],
                        ':file_type' => $file['type'],
                        ':file_size' => $file['size'],
                        ':file_tmp_name' => $file['tmp_name'],
                        );
            $result = media::add($datas_file);
            return media::getLastID();

        }
    }

    /**
     * Update the object
     *
     * @param array data to update
     * @param int id of the object to update
     * @param array override the metadata
     * @return boolean query result
     */
    public static function update($data = array(), $id, $metadata = false){
        global $db;

        // Handle the metadatas
        // if(!$metadata) {
        //     $metadata = array(
        //                         ':edited' => tool::currentTime(),
        //                         ':editor' => user::getCurrentUser(), 
        //                     );
        // }

        // // Merge the data and metadatas arrays
        // $data = array_merge($metadata, $data);

        // Build the Query, be careful, vars must be prefixed with ":"
        $entries = '';
        foreach (array_keys($data) as $key => $name) {
            if($key !=0)
                $entries .= ',';
            $entries .=  substr($name, 1).' = '.$name;
        }
        $sql = 'UPDATE '.self::$table.' SET '.$entries.' WHERE id='.$id;

        $result = $db->update($sql, $data);

        return $result;
    }

    /**
     * Remove object
     *
     * @param id of the object
     * @return boolean
     */
    public static function remove($id){
        global $db;
        // $data = array(':id' => $id);
        // $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        // $result = $db->delete($sql, $data);
        $result = self::archive($id);
        return $result;
    }

    public static function archive($id){
        $data = array(
            ':archived' => 1,
            ':archived_on' => tool::currentTime(),
            ':archived_by' => user::getCurrentUser() 
        ); 
        $result = self::update($data, $id);
        return $result;       
    }

    public static function unarchive($id){
        $data = array(
            ':archived' => 0,
            ':archived_on' => '',
            ':archived_by' => ''
        ); 
        $result = self::update($data, $id);
        return $result;       
    }

    public static function delete($id){
        global $db;
        $data = array(':id' => $id);
        $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
        $result = $db->delete($sql, $data);
        //$result = self::archive($id);
        return $result;
    }
    
}

?>