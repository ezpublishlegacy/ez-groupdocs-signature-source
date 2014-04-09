<?php
/*
CREATE TABLE gdsig ( 
    id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
    file_id VARCHAR( 250 ) NOT NULL,  
    file_hook VARCHAR( 250 ) NOT NULL 
) ENGINE = MYISAM ;
*/
include_once( 'kernel/classes/ezpersistentobject.php' );
class GroupDocsSignature extends eZPersistentObject
{ 
    /** 
     * Constructor 
     *
     * @param array $row Hash of attributes for new GroupDocsViewer object
     */ 
    public function __construct( array $row )
    { 
        parent::eZPersistentObject( $row ); 
    }
 
    /*
     * Definition of the data object structure /of the structure of the database table 
     *
     * @return array Hash with table definition for this persistent object
     */ 
    public static function definition()
    { 
        return array( 'fields' => array( 'id' => array( 'name' => 'ID', 
                                                        'datatype' => 'integer', 
                                                        'default' => 0, 
                                                        'required' => true ),
 
                                        'file_id' => array( 'name' => 'FileID', 
                                                            'datatype' => 'string', 
                                                            'default' => '', 
                                                            'required' => true ),
 
                                        'file_hook' => array( 'name' => 'FileHook', 
                                                            'datatype' => 'string', 
                                                            'default' => '', 
                                                            'required' => true ),

                                        'width' => array( 'name' => 'Width', 
                                                            'datatype' => 'int', 
                                                            'default' => '', 
                                                            'required' => true ),

                                        'height' => array( 'name' => 'Height', 
                                                            'datatype' => 'int', 
                                                            'default' => '', 
                                                            'required' => true ),
                                        ), 
                      'keys'=> array( 'id' ), 
                      'function_attributes' => array( 'file_id_object' => 'getFileIdObject' ), // accessing to attribute "user_object" will trigger getUserObject() method
                      'increment_key' => 'id', 
                      'class_name' => 'GroupDocsSignature', 
                      'name' => 'gdsig'
                      ); 
    }
 
    /** 
     * Help function will open in attribute function 
     * @param bool $asObject
     */ 
    public function getFileIdObject( $asObject = true )
    { 
        $file_id = $this->attribute('file_id');

        //$file_id_Ob = eZUser::fetch($file_id, $asObject); 
        //return $file_id_Ob; 
		print 'Function getFileIdObject() not in use :)';
    }
 
    /**
     * Creates a new object of type GroupDocsSignature and shows it
     * @param int $user_id
     * @param string $value
     * @return GroupDocsSignature
     */
    public static function create( $file_id, $file_hook, $width, $height )
    { 
        $row = array( 'id'      => null, 
                      'file_id' => $file_id, 
                      'file_hook'   => $file_hook, 
					  'width'   => $width, 
					  'height'   => $height, 
                      ); 
        return new self( $row ); 
    }
 
    /**
     * Shows the data as GroupDocsSignature with given id
     * @param int $id of File ID
     * @param bool $asObject
     * @return GroupDocsSignature
     */ 
    public static function fetchByID( $id , $asObject = true)
    { 
        $result = eZPersistentObject::fetchObject( 
                                                    self::definition(), 
                                                    null, 
                                                    array( 'id' => $id ), 
                                                    $asObject, 
                                                    null, 
                                                    null ); 
 
        if ( $result instanceof GroupDocsSignature ) 
            return $result; 
        else 
            return false; 
    }
 
    /**
     * Shows all the objects GroupDocsSignature as object or array
     * @param int $asObject
     * @return array( GroupDocsSignature )
     */ 
    public static function fetchList( $asObject = true )
    { 
        $result = eZPersistentObject::fetchObjectList( 
                                                        self::definition(), 
                                                        null,null,null,null, 
                                                        $asObject, 
                                                        false,null ); 
        return $result; 
    }
 
    /**
     * Shows the amount of data
     * @return int 
     */ 
    public static function getListCount() 
    { 
        $db = eZDB::instance(); 
        $query = 'SELECT COUNT(id) AS count FROM gdsig'; 
        $rows = $db -> arrayQuery( $query ); 
        return $rows[0]['count'];
    } 

    public static function getMaxId() 
    { 
        $db = eZDB::instance(); 
        $query = 'SELECT MAX(id) AS mid FROM gdsig'; 
        $rows = $db -> arrayQuery( $query ); 
        return $rows[0]['mid'];
    } 
 
    // -- member variables-- 
    protected $ID;
    protected $FileID; 
    protected $FileHook; 
 
} 
?>