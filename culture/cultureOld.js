/**
 * This is the origianl javascript file.  It used to be that the names array had to be updqated
 * every time a new author was added.  Now this file is built automatically by div_opus_class_def.php
 */

var names = 
    [
        "nancy"		,
        "mark"		,
        "matt"		,
        "paul"		,
        "janet"		,
        "regie"		,
        "elaine"	,
        "clare"		,
        "julie"		,
        "laura"		,
        "maureen"	,
        "faith"		,
        "libby"	, 
        "tori",
        "wil"
    ];

function blankAll() {
    for (i=0; i<names.length; i++) {
        n =  document.getElementById(names[i]);
        nh = document.getElementById(names[i]+"_header");
        
    	n.style.display="none";
        nh.setAttribute("class", "inactive_author");
        nh.setAttribute("className", "inactive_author"); 
    }
    parent.culture_main.location.href = 'culture_main.htm';
}

function displayIt(id){
	blankAll();
    n = document.getElementById(id);
    nh = document.getElementById(id+"_header");
    
 	n.style.display="block";
    nh.setAttribute("class", "active_author");
    nh.setAttribute("className", "active_author"); 
}
