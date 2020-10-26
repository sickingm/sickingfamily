<?php
identifier_comment("BEGIN ".__FILE__);

    include "dbc_info.php";
?>
	<p align="center" style="margin-top: 0; margin-bottom: 0"><u><b>
	<font face="Monotype Corsiva" size="6">Index</font></b></u></p>
	<p align="center" style="margin-top: 0; margin-bottom: 6px">
<?php
	minutes_index('23',2007,12,10);
	minutes_index('22',2006,12,26);
	minutes_index('21',2006,11,27);
	minutes_index('20',2006,9,19);
	minutes_index('19',2006,8,22);
	minutes_index('18',2006,7,26);
	minutes_index('17',2006,6,23); // Rend Lake
	minutes_index('16',2006,6,6);
	minutes_index('15',2006,4,17);
	minutes_index('14',2006,3,14);
	minutes_index('13',2006,2,28);
	minutes_index('12',2006,1,12); 
	minutes_index('11b',2005,12,22);
	minutes_index('11',2005,12,7);
	minutes_index('10',2005,11,15);
	minutes_index('09',2005,10,18);
	minutes_index('08',2005,9,24);
	minutes_index('07',2005,8,6);
	minutes_index('06',2005,7,12);
	minutes_index('05',2005,6,2);
	minutes_index('04',2005,5,11);
	minutes_index('03',2005,4,13);
	minutes_index('02',2005,3,9);
	minutes_index('01',2005,2,9);
?>	
	&nbsp;<br>
	<img border="0" src="../images/croney.jpg" width="175" height="259" />
	</p><br />
	<p align="center" style="margin-top: 0; margin-bottom: 6px">
	</p>
	
	</body>
	
	</html>
<?php
function minutes_index($mtg_number,$y, $m, $d)
//  Creates the index and links to the dbc minutes files.
//  Always creates a link to the standard file, 
//  and, if it exists, creates a link to the private addenda
//
// The regular minutes link will be underlined to show the presence of private addenda.
//
//	$mtg_number - ordinal number of meeting (Meeting #1, #2, etc.)
//	$y - year of the meeting date in question (may be in 2 or 4 digit format)
//	$m - numberical month of meeting
//	$d - date of the month of meeting
//  
//  The regular minutes are located in "minutes_yymmdd,htm" and
//  the private minutes are at dbc_private/private_yymmdd.htm.
//

{
    $y2=$y%1000;
    $y4=2000+$y2;
	
	$dmy = sprintf("%02u%02u%02u",$y2,$m,$d);
	$private_file="dbc_private/private_$dmy.htm";

	$show_hidden = isset($_SESSION["see_hidden"])
	&& $_SESSION["see_hidden"]==='Y' 
	&& file_exists($private_file);

	$title = sprintf("#%s: ", $mtg_number) . date("F j, Y",mktime(0,0,0,$m,$d,$y4));
	
	if ($show_hidden) 
	{
		echo "\n<a target='dbc_minutes' href='$private_file'>"; 
		echo '<img border="0" src="../images/lock.gif" width="18" height="18"></a>';
		echo "<u>";  // Underscore link to public minutes in order to indicate presence of hidden minutes
	}
	printf("
        <font face='Tahoma'>
        <a href='_dbc.php?minutes_file=minutes_%s_%s.htm'>", 
        $mtg_number,$dmy);
	echo "<font color='#800000' size='2'>$title</font></a></font>\n";
	if ($show_hidden) echo '</u>';
	echo "<br>\n";
}

identifier_comment("END ".__FILE__);
?>