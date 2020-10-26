<!--
//
//  ++++++++++++++++++++++++++++++++++++++
//  | h o m e p a g e _ m a i n . p h p  |
//  ++++++++++++++++++++++++++++++++++++++
//
//	NAME:	homepage_main.php
//
//	CALLED BY:
//			homepage.htm (via frameset)
//
//	CALLS or INCLUDES:
//			address_book/address_book.php
//			birthday_today.php	
//			dbc/_dbc.php
//			enhancements.htm
//			events.php
//			family_outline.htm
//			random_thoughts.php
//			upcoming_birthdays.php
//			user_admin/_user_admin.php
//stuff
//	USES STYLES:
//			homepage.css
//			master.css
//			
//	This is the main page of the sickingfamily.com website.
//	It is normally called indirectly via index.php 
//	(invoked by default when www.sickingfamily.com is entered)
//	table
--> 

<?php
	identifier_comment("BEGIN ".__FILE__);
    identifier_comment("This top level div required to allow centering of rest of the page.");
    require_once "../dbc_constants.inc";
?>
<div id="homepage-container">
    <div id="homepage-div">
    	<p class='dbc dbcbig' >The Sicking Family</p>
    	<p><a target="_blank" href="trophy.htm">(Winners of the 2007 Heidemann Family Reunion Competition)</a></p>	

<?php include "birthday_today.php"; 
    echo '<img src="../images/family_tree.jpg" alt=""  style="border: none; max-width:70%; height:auto;"/>';
        require '../../trick_fusion/trick_fusion_random.inc'; 

        require '../events/events_main.inc';
        
    	require "dbc_stuff.php"; 
    	?>
        
    	<hr />
    	<table class='bday'>
    	<tr>
    	<?php
    	    include "random_thoughts.php";
    	    include "upcoming_birthdays.php";
    	?>
    	</tr>
    	</table>
    	<hr />
    </div>
</div>
<?php     identifier_comment("END ".__FILE__); ?>