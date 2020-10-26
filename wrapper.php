<?php

////////////////////////////////////////////////////////////
//                                                        //
//                    w r a p p e r                       //
//                                                        //
//  Defines a close used to wrap html code within block   //
//  containers like div's, p's, etc.                      //
//                                                        //
////////////////////////////////////////////////////////////

class wrapper {
       
    public function __construct ($tag='div' , $add_on='') { //html_type may be any block level container tag

        $this->tag = $tag;
        $this->add_on = $add_on;
        $this->contents = '';  // Initialize contents
    } 

    public function append($code){
        $this->contents .= ($code); //Append code to end of current contents
    }
    
    public function prepend ($code) {
        $this->contents = $code . $this->contents; //append new code to beginning of current contents
    }
    
    public function spew () {
        $comment = !empty($this->add_on) ? ' <!-- Close '. $this->add_on . ' -->' : '';
        return (
            sprintf(
    '
    <%1$s %2$s>
        %3$s
    </%1$s> %4$s
    ',
                $this->tag, $this->add_on, $this->contents, $comment, "XXX???XXX"
            )
        );        
    }
    
    public function clear(){
        $this->contents = '';
    }
    
    private function tagit($text) {
        return "<$text>";
    }
}

?>