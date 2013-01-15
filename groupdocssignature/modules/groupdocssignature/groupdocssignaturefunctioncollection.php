<?php
 include_once( 'extension/groupdocssignature/classes/groupdocssignature.php' );
/*
class GroupdocsSignatureFunctionCollection
{

function GroupdocsSignatureFunctionCollection()
{
}

function &fetchList( $offset, $limit )
{
$parameters = array( 'offset' => $offset,
'limit' => $limit );
$lista =& GroupdocsSignature( $parameters );

return array( 'result' => &$lista );
}

}
*/
class GroupdocsSignatureFunctionCollection
{ 
    public function __construct() 
    {
        // ...
    }
 
    /*
     * Is opened by('modul1', 'list', hash('as_object', $bool ) ) fetch
     * @param bool $asObject
     */ 
    public static function fetchList( $asObject ) 
    { 
        return array( 'result' => GroupDocsSignature::fetchList( $asObject ) ); 
    }
 
    /*
     * Is opened by('modul1', 'count', hash() ) fetch
     */
    public static function fetchJacExtensionDataListCount()
    { 
        return array( 'result' => GroupDocsSignature::getListCount() ); 
    } 
} 
?>