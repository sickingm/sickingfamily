<?php 
identifier_comment("BEGIN ".__FILE__);

// To add a new author edit the culture_list.dat file.  each entry is comma separated with these 5 fields:
//	div name
//	title of opus
//	url of reference to opus
//	data
//	author (optional, if omitted a capitalized copy of he div name will be used))


?>

<div id="first" class="left collapse-container">
 
      
<?php

//read in the opus data 
$handle = fopen("culture_list.dat", "r") or die("<br><b>Cannot open culture_list.dat<br>");

$first=true;
$last_author = "";
while (($data = fgetcsv($handle, 1000, ",")) !== false) {
	$num = count($data);
    if ($num < 4 or $num > 5) {
        trigger_error("Line $linno in culture_list.dat has $num fields.  4 are required with an optional 5th.", E_USER_ERROR);
        break;
        } else {
            $dir = trim($data[0]);
            $opus = trim($data[1]);
            $fname = trim($data[2]);
            $date = trim($data[3]);
            $author = $num>4 ? $data[4] : ucfirst($dir); 
            if ($author != $last_author){
                if ($first) $first=false; 
                    else echo "
            </div>\n";
                $last_author = $author;
                echo "\n
            <h3>&nbsp;<span class = 'arrow-r'></span>$author</h3>
            <div style='line-height:100%' >";
            }
            echo "
             <a  class='opus' href='#' onclick='$(\"#culture-contents\").load(\"$dir/$fname.htm\")'>$opus</a>
             <br /><span class = 'opus-date'>$date</span><br />";
        }
}

echo '</div>';
//OLD:      <a class='opus' href='culture.php?opus=$dir/$fname.htm'>$opus</a>
//NEW:      <a class='opus' href='#' onclick='$(\"#culture-contents\").load(\"$dir/$fname.htm\")'>$opus</a>


fclose($handle);

echo "</div> ";

identifier_comment("END ".__FILE__);
?>