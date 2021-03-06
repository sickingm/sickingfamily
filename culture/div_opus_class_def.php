<?php
identifier_comment("BEGIN ".__FILE__);
class divIndex {

	private $divs;
	private $opus;
	private $headers;
	private $script;
	private $body;
	private $footers;
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	public function __construct(){
		$this->divs = array(); // Stores a list of div names 
		$this->opus = array();  //Stores a list of opuses consisting of divPtr, title, and urlRef
		$this->body = "";  //Initialize $body to null string.  Will be created based on file input

		// Create page header string
		$this->headers = "";
		
		// Create page footer string
		$this->footers = "";
	}
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function render(){
		// Renders the entire culture index page.
		
		// create the blankall and displayIt javascripts inside the page header
		$this->build_js_script();
		$this->body();
		
		// Stick the script into the $headers variable
		$this->headers = str_replace("SCRIPT GOES HERE",$this->script,$this->headers);
		
		echo $this->headers;
		echo $this->body;
		echo $this->footers;		
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function add_opus($div, $title, $ref, $date, $author){
		
		// Remember the Author's name in the $divs array
		// Note that this will be defined more than once;  Last def wins
		$this->divs[$div] = trim($author);
		
		// Now add an array to the opus array containing all of the opus specific details
		// Title, url link, date
		// For each div/author there can be multiple opera 
		$this->opus[$div][] = array("title"=>trim($title), "ref"=>trim($ref), "date"=>trim($date));
	}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	private function build_js_script() {
		// builds the culture.js source file based on the $div array
		// There's probably a better way to do this in javascript by cycling though all of the divs
		// under the parent div (Index)
		//
		// The resultant string will be substituted for the "SCRIPT GOES HERE" string 
		// in the $headers variable.
		
		$this->script = <<<EndOfScript1

      var names = [
EndOfScript1;
		$not_first = false;
		foreach($this->divs as $d=>$div){
			if($not_first)$this->script .= ",";
			$not_first = true;
			$this->script .= "\n         '$d'";
		}
		$this->script .= <<<EndOfScript2
\n      ];

     function blankAll() {
        for (i=0; i<names.length; i++) {
           n =  document.getElementById(names[i]);
           nh = document.getElementById(names[i]+"_header");
    
           n.style.display="none";

           nh.setAttribute("class", "inactive_author");
/*         nh.setAttribute("className", "inactive_author"); */


      }
      parent.culture_main.location.href = 'culture_main.htm';
   }

   function displayIt(id){
      blankAll();
      n = document.getElementById(id);
      nh = document.getElementById(id+"_header");

      n.style.display="block";
      nh.setAttribute("class", "active_author"); 
  }

EndOfScript2;
	}
	
//***********************************************************************************	

	private function body(){
	// $b will hold the innards of the index webpage, 
	// and ultimately will load it into $this->body
		$b = '<body>';

// Cycle thru divs and create the Index div entries
foreach($this->divs as $d=>$author) { //$d is the div name, $div contains the author's name'
    $b .=  "\n
    <div class='index'>
        <p onmouseover='this.style.cursor=\"pointer\";' onclick='displayIt(\"$d\");' id='{$d}_header'	>$author</p>";
    $b .= "
        <div id='$d' class='opus'>";
//Cycle Through divs 
    foreach($this->opus[$d] as $o) {
        $b .= "
            <a href='culture.php?opus=$d/{$o['ref']}.htm'>{$o['title']}</a>
            <br /><span class='date'>{$o['date']}</span><br />";			
    }   	
    $b .= "___________</div>
    </div>";
    $this->body = $b;		
}

}

}


identifier_comment("END ".__FILE__);