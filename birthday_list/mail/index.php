<!--
			START		_mail.php
*****************************************************************************-->
<link rel="stylesheet" type="text/css" href="../../styles/address_book.css" />
<?php
////////////////////////////////////////////////////////////////////////////////
//
//  +-------------------+
//  � _ m a i l . p h p �
//  +-------------------+
//
//	NAME:	_mail.php
//
//	CALLED BY:
//			
//
//	CALLS:
//				
//
//	INCLUDES:
//			../../common/initialize.php";
//			
//
//	CONTAINS:
//
//	USES STYLES:
//			master.css
//			
//	Description
//			Generates the complete sickingfamily mail distribution list
//	
////////////////////////////////////////////////////////////////////////////////
//

require_once "$doc_root/common/initialize.php";
require_once "$doc_root/common/utility_functions.php";
 
global $debug;
//debug_on();

connect_and_select();
$query = "SELECT email FROM emails";
$result = do_query($query);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo $row["email"]."; ";
}

?>
<!--
			END		_mail.php
*****************************************************************************-->