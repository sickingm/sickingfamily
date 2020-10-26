<?php

/**
 * @author Matthew Sicking
 * @copyright 2009
 * 
 * Processes the culture_index.dat file which is a csv file with these ordered fields:
 *  div [name of div to be used for the particular poet's index of work]
 *  title [title of the cultural work]
 *  ref [html reference (without the trainling .htm) to the cultural work]
 *  date [publish date of the cultural work]
 * 
 * and creates:
 *  - An author entry for each unique author (where author is th ediv name capitalized))
 *  - A div in the culture index page for each unique div
 * 	- An entry in the names array in the culture.js file for each unique div
 */

$author_names = array();
$handle = fopen("culture_list.dat", "r") or die("<br><b>Cannot open culture_list.dat<br>");
$linno = 0;
while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    $linno++;
    $num = count($data);
    if ($num < 4 or $num > 5) {
        trigger_error("Line $linno in culture_list.dat has $num fields.  4 or 5 are required.", E_USER_ERROR);
        break;
    } else {
    	$d = trim($data[0]);
        $div[] = $d; // First field is div name;  We will use that as the index of authors
        
        if (empty($author[$d]))         	        	
			$author[$d] = ucfirst( (count($data)>4) ? trim($data[4]) : $d); //If author's name is missing use a capitalized version of div
                
        $title[$d][] = trim($data[1]); // Second field is the title. Saved in the $title array
        $ref[$d][] = trim($data[2]); // Third field is the url reference to the work of art itself.  Saved in $ref array
    }
}
fclose($handle);
echo "<pre>";
echo "<br><br>div array:<br>";print_r ($div);
echo "<br><br>author array:<br>";print_r($author);
echo "<br><br>title array:<br>";print_r($title);
echo "<br><br>ref array:<br>";print_r($ref);
echo "<br><br>date array:<br>";print_r($date);
echo "</pre>";