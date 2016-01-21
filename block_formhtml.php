<?php
class block_formhtml extends block_base {
    public function init() {
        $this->title = get_string('formhtml', 'block_formhtml');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.
	
	public function get_content() {
		if ($this->content !== null) {
		  return $this->content;
		}
	 
		$this->content         =  new stdClass;
		global $DB;
		$movies = $DB->get_records('block_formhtml',array('blockid'=>$this->instance->id));		
		$textMovies = '';
		foreach($movies as $movie){
			$textMovies .= '<p>Title '.$movie->title.'</p>';
			$textMovies .= '<p>Description '.$movie->description.'</p>';
			$textMovies .= '<p>Link <a href="'.$movie->link.'">'.$movie->link.'</a></p>';
			$textMovies .= '<br>';
		}
		$this->content->text   = $textMovies;
		global $COURSE;
 
		// The other code.
		 
		$url = new moodle_url('/blocks/formhtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
		$this->content->footer = html_writer::link($url, get_string('addpage', 'block_formhtml'));	 
		return $this->content;
	  }
	  
	public function instance_allow_multiple() {
	  return true;
	}	  
	  
}   // Here's the closing bracket for the class definition