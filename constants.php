<?php
//////////////////////////////////////////
//                                      //
// S F D C / c o n s t a n t s . p h p  //
//                                      //
//////////////////////////////////////////
identifier_comment("BEGIN ".__FILE__);
connect_and_select();
$result = do_query("SELECT * FROM dbc_constants");

while ($row = $result->fetch_assoc()) {
   extract($row) ;  // Get a name/value pair
   $DBC[$name] = $value; // create the dbc variable
}
identifier_comment("END ".__FILE__);	
?>