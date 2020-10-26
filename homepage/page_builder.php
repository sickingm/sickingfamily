<?php
/*
 **************************************************
 * page_builder.php
 *  contains
 *    Site class
 *    menu_builder
 *    tag 
 *
 **************************************************
 */
 
    class Site {
// defines the Site class consiting of headers, body and footers.

        private $headers; //$headers[type - "text" or "file"][text]
        private $footers;
        private $page;
        
        public function __construct() {
            // $headers and $footers have the same structure
            // they are a list of arrays each with two values, type and content
            // type may be either "text" or "file" depending on whether the header information
            // is provided literally (the "text" option) or within a file (the "file" option)
            // initialize each with blank text
            
            echo ".....constructing site<br />";

            $this->clear_headers();
            $this->clear_footers();
            $this->clear_page();
        }
        
        public function clear_headers(){
            $this->headers = array(array("text","")); 
        }
        
        public function clear_footers(){
            $this->footers = array(array("text","")); 
        }
        
        public function clear_page(){
            $this->page = ""; 
        }
        
        public function __destruct() {
            unset($this->headers);
            unset($this->footers);
        }
        
        public function add_header($type,$contents){
            $this->headers[]=array($type,$contents);
        }
        
        public function add_footer($type,$contents){
            $this->footers[]=array($type,$contents);
        }
        
        public function render_site() {
            echo "\n.....rendering site<br />";
            $this->render_hf($this->headers);
            echo $this->page;
            $this->render_hf($this->footers);
        }            
        
        private function render_hf($hfs){
            echo "\n.....rendering header or footer<br />";
            foreach ($hfs as $hf) {
                if ($hf[0]=="text") {
                    echo "\n".$hf[1];
                } elseif ($hf[0]=="file") {
                    echo "\n";
                    include $hf[1];
                } else "\n<br /> UNKNOWN TYPE FOR HEADER OR FOOTER VECTOR<br />";
            }
        }
    }
//
//***********************************************************************************
//
    $div_tag = new Tag("div", "indent");
    $ol_tag= new Tag("ol", "indent");
    $li_tag1=new Tag("li", "indent");
    $li_tag2=new Tag("li", "indent");
    $li_tag3=new Tag("li", "indent");
    $br_tag=new Tag("br","short");
    $li_tag1->add_contents("Coffee");
    $li_tag2->add_contents("tea");
    $li_tag3->add_contents("Milk");
    $ol_tag->add_contents($li_tag1->get_tag());
    $ol_tag->add_contents($li_tag2->get_tag());
    $ol_tag->add_contents($br_tag->get_tag());
    $ol_tag->add_contents($li_tag3->get_tag());
    $div_tag->add_contents($ol_tag->get_tag());
    echo $div_tag->get_tag();

    class Tag {
        //provides for creation of generic html tags
        
        private $tag;
        private $type;
        private $contents;
        
        public function __construct ($tag, $type="long"){
            $this->tag = $tag;
            $this->type=strtolower($type);
            if (!in_array($type, array("indent","inline","short"))) {
                trigger_error("The tag type must be either 'inline','indent' or 'short'. A type of '$type' is not allowed.", E_USER_ERROR);
            };
            $this->contents[]="";            
        }
        public function add_contents($c) {
            $this->contents[]=$c;
        }
        public function get_tag(){
            $separator = $this->type=="indent" ? "\n\t" : "";
            $format = Array(
                "indent"=>"<%1\$s>\n\t</%1\$s>",
                "inline"=>"<%1\$s>%2\$s</%1\$s>",
                "short"=>"<%s %s>"
            );
            $c="";
            foreach ($this->contents as $x) {
                $c.=$x;
            }
                            
            $tag = sprintf($format[$this->type],$this->tag, $c);
            return $tag;
        }
    }    
    
