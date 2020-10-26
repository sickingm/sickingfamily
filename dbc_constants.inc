<?php
//////////////////////////////////////////////////
//                                              //
// S F D C / d b c _ c o n s t a n t s . p h p  //
//                                              //
//////////////////////////////////////////////////
identifier_comment("BEGIN ".__FILE__);
connect_and_select();
$result = do_query("SELECT * FROM dbc_constants");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   $DBC[$row['name']] = $row['value'];; // create the dbc variable
}

identifier_comment("END ".__FILE__);

