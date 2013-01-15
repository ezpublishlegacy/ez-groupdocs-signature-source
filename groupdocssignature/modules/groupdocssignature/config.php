<?php
/**
* File containing the eZ Publish view implementation.
*
* @copyright Pavel Teplitskiy
* @version 1.0
* @extention groupdocssignature
*/
/*

*/
///////////////////////////////////////// FORM STARTED /////////////////////////////////////////
// take copy of global object 
$db = eZDB::instance(); 
$http = eZHTTPTool::instance (); 

		 // Create mysql table if not exist
		if(!isset($_SESSION['gdsigcreatetable']) || !$_SESSION['gdsigcreatetable']){
			$query = 'CREATE TABLE IF NOT EXISTS `gdsig` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `file_id` varchar(250) NOT NULL,
						  `file_hook` varchar(250) NOT NULL,
						  `width` int(5) NOT NULL,
						  `height` int(5) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM;'; 
			$db -> query( $query );
			$_SESSION['gdsigcreatetable'] = 1;
		}

include_once( 'extension/groupdocssignature/classes/groupdocssignature.php' );
$module = $Params['Module'];

// If the variable 'name' is sent by GET or POST, show variable 
$value = '';

// DELETE GroupDocs File ID 
if( $http->hasVariable('del_id') )  {
    $del_id = $http->variable ('del_id');
	$query = 'DELETE FROM gdsig WHERE id='.(int)$del_id; 
	$db -> arrayQuery( $query );
	return $module->redirectTo('/groupdocssignature/config');
}

// SAVE GroupDocs File ID
if( $http->hasVariable('file_id') )  {
    $file_id = $http->variable ('file_id');
    $width = (int)$http->variable ('width');
	$height = (int)$http->variable ('height');

if( $file_id != '' ) 
{

		// assign hook_id
		$HookId = GroupDocsSignature::getMaxId();
		$hook = '#gdsignature'.($HookId+1).'#';// as no records show zero
		// generate new data object 
		$GDObject = GroupDocsSignature::create( $file_id, $hook, $width, $height);
		eZDebug::writeDebug( '1.'.print_r( $GDObject, true ), 
							 'GDObject before saving: ID not set' ) ;
	 
		// save object in database 
		$GDObject->store();
		eZDebug::writeDebug( '2.'.print_r( $GDObject, true ), 
							 'GDObject after saving: ID set' ) ;
	 
		// ask for the ID of the new created object 
		$id = $GDObject->attribute( 'id' );
	 
		// investigate the amount of data existing 
		$count = GroupDocsSignature::getListCount(); 
		$statusMessage = 'File ID: >>'. $file_id .
                     '<< Hook:  >>'. $hook.
                     '<< In database with ID >>'. $id.
                     '<< saved!New ammount = '. $count ;

		return $module->redirectTo('/groupdocssignature/config');
	}else 
		$statusMessage = 'Please insert data';
	 
	// initialize Templateobject 
	$tpl = eZTemplate::factory();

	$tpl->setVariable( 'status_message', $statusMessage ); 
	// Write variable $statusMessage in the file eZ Debug Output / Log 
	// here the 4 different types: Notice, Debug, Warning, Error 
	eZDebug::writeNotice( $statusMessage, 'groupdocssignature:groupdocssignature/config.php' ); 
	eZDebug::writeDebug( $statusMessage, 'groupdocssignature:groupdocssignature/config.php' ); 
	eZDebug::writeWarning( $statusMessage, 'groupdocssignature:groupdocssignature/config.php' ); 
	eZDebug::writeError( $statusMessage, 'groupdocssignature:groupdocssignature/config.php' );
}
/////////////////////////////////////////// form ended ////////////////////////////////////////////////
// Get list of file from DB
$dataArray = array();
$query = 'SELECT * FROM gdsig'; 
$rows = $db -> arrayQuery( $query );
if($rows) foreach($rows as $row){
	if($row['width']==='0') $row['width'] = '';
	if($row['height']==='0') $row['height'] = '';
	$dataArray[$row['id']] = array( $row['file_id'], $row['file_hook'], $row['width'], $row['height'] );
}
// initialize Templateobject
$tpl = eZTemplate::factory();
 
// create example Array in the template => {$data_array}
$tpl->setVariable( 'data_array', $dataArray );
/////////////////////////////////// inistialization ended ///////////////////////////////////////

//carry out internal processing here, none required in this case.
// setting up what to render to the user:
$Result = array();

//$t = $tpl->compileTemplateFile('design:groupdocssignature/config.tpl');
$t = $tpl->fetch('design:groupdocssignature/config.tpl');

$Result['content'] = $t; //main tpl file to display the output

$Result['left_menu'] = "design:groupdocssignature/leftmenu.tpl"; 

$Result['path'] = array( array( 
	'url' => 'groupdocssignature/config',
	'text' => 'Groupdocs Signature' 
) ); //what to show in the Title bar for this URL


// read variable GdsDebug of INI block [GDSExtensionSettings] 
// of INI file jacextension.ini  

$groupdocssignatureINI = eZINI::instance( 'groupdocssignature.ini' ); 
 
$gdsDebug = $groupdocssignatureINI->variable( 'GDSIGExtensionSetting','JacDebug' ); 
 
// If Debug is activated do something 
if( $gdsDebug === 'enabled' ) 
    echo 'groupdocssignature.ini: [GDSIGExtensionSetting] GdsigDebug=enabled';

?>