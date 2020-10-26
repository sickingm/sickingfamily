<?php

////////////////////////////////////////////
//                                        //
// S F D C / i n i t i a l i z e . p h p  // inSFDC-beta
//                                        //
////////////////////////////////////////////

// Can't call identifier_comment() because utility_functions.php has not yet been loaded


/* Each major application should begin with the following sequence:
	global $site, $db, $db_name, $db_host, $db_user, $db_password; 
	$site='XXXX'; 		// e.g., XXXX could be sickingfamily, bugs, etc. (name of web)
	$db="YYYY";			// e.g., YYYY could be sickingf_ or mcbride67_ (database prefix)
	$db_name="ZZZZ";	// e.g., ZZZZ could be family, bot, bugs, etc. (name of database)
	$db_host="AAAA";	// Generally the host name is blank: ""
	$db_user="BBBB";	// e.g. BBBB could be sickingf_matt or mcbride67_sickingm;
	$db_password="CCCC";// password for the given user
		
Below is an example:
	$site='somesite';
	$db="somesite_";
	$db_name="people";
	$db_host="";
	$db_user="somesite_john";
	$db_password="JB1776%";

	require_once $doc_root."/common/initialize.php";  //Call this routine which is stored in /%root%/common
	[Other statements common to every page of the site go here]

EXCEPTION:  IF THE APPLICATION IS TO BE RUN FROM CRONTAB USE THE FOLLOWING INSTEAD: (This method always works, even if not going o crontab)
	$site='XXXX'; 		// e.g., XXXX could be sickingfamily, bugs, etc. (name of web)
	$db="YYYY";			// e.g., YYYY could be sickingf_ or mcbride67_ (database prefix)
	$db_name="ZZZZ";	// e.g., ZZZZ could be family, bot, bugs, etc. (name of database)
	if(!empty($_SERVER["DOCUMENT_ROOT"]))$doc_root= $_SERVER["DOCUMENT_ROOT"];
	else $doc_root = getcwd()."/public_html";  // Must be running under cron, so use current work directory/public html
	echo "Including $doc_root./common/initialize.php";
	include $doc_root . "/common/initialize.php"; 

 ***********************************************************************************
 ** Caution: When defining pathnames be sure to use forward slashes as separators **
 ** Either sort will work on Windows, but only /'s will work on unix servers      **
 ***********************************************************************************


 This routine does the following:
	1. Checks to make sure a site name (stored in $site) exists
	2. If not set, assumes sickingfamily.
	3. First time through it:
		a. Adds the site to the include path
		b. Adds any site utilities (%root%/site/utilities) to include path
		c. Adds the root directory to include path
		d. Adds /%root%/common to search path
	4. Implements the error handler in /%root%/common/

 $site should be set to 'sickingfamily' or 'bugs'etc.
 If it's not set assume sickingfamily, output a message, and proceed
*/

date_default_timezone_set ('US/Central');
	$site_is_initialized = TRUE;
	global $site, $db, $db_name, $db_fullname, $db_host, $db_user, $db_password, $doc_root;

// make sure a session has been started
	$sid = session_id();
	if(empty($sid)){
	   $hadToStartANewSession = "YES"; 
       session_start();
    } 
    else {$hadToStartANewSession="NO";}

    header('Content-Type:text/html; charset=UTF-8');
    ini_set('default_charset', 'UTF-8');

	if(!empty($_SERVER["DOCUMENT_ROOT"])){
		$doc_root =  $_SERVER["DOCUMENT_ROOT"];
	}
	else if(!empty($_SERVER["PHP_DOCUMENT_ROOT"])){
		$doc_root = $_SERVER["PHP_DOCUMENT_ROOT"];
	}
	else {
		$doc_root = getcwd()."/public_html";  // Must be running under cron, so use current work directory/public html
	}

	require_once "$doc_root/common/utility_functions.php";

//debug_on();

html_comment('LINE ' . __LINE__ . ' in ' . __FILE__ . ' (FUNCTION ' . __FUNCTION__ . ')');

$production=FALSE;

require_once "$doc_root/common/kint.phar";

require_once "$doc_root/common/error_handler.php";
require_once "$doc_root/creds/creds_db.inc";
require_once "../authentication.php";
	require_once "data_base.php";   


connect_and_select();


html_comment('LINE ' . __LINE__ . ' in ' . __FILE__ . ' (FUNCTION ' . __FUNCTION__ . ')');
?>