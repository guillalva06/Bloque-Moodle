<?php

	require_once("{$CFG->libdir}/formslib.php");
	 
	class formhtml_form extends moodleform {
	 
		function definition() {
	 
			$mform =& $this->_form;
			$mform->addElement('header','displayinfo', get_string('textfields', 'block_formhtml'));
			
			 
			// add form title element.
			$mform->addElement('text', 'title', get_string('formtitle', 'block_formhtml'));
			$mform->addRule('title', null, 'required', null, 'client');

			// add form description element.
			$mform->addElement('text', 'description', get_string('formdescription', 'block_formhtml'));
			$mform->addRule('description', null, 'required', null, 'client');			
										 			
			// add form link element.
			$mform->addElement('text', 'link', get_string('formlink', 'block_formhtml'));
			$mform->addRule('link', null, 'required', null, 'server');			
			
			
			//hidden elements
			$mform->addElement('hidden','blockid');
			$mform->addElement('hidden','courseid');						
			
			$this->add_action_buttons();			
		}
		
		function validation($data, $files){
			$errors = array();
			$website = $data['link'];
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
			  $errors['link'] = "Invalid URL"; 
			}			
			return $errors;
		}
		
	}