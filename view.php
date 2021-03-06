<?php
 
require_once('../../config.php');
require_once('formhtml_form.php');
 
global $DB, $OUTPUT, $PAGE;
 
// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
//Navigation breadcrumbs 
$blockid = required_param('blockid', PARAM_INT);
 
// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);


 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_formhtml', $courseid);
}
 
require_login($course);


//set url and header
$PAGE->set_url('/blocks/formhtml/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_formhtml'));

$settingsnode = $PAGE->settingsnav->add(get_string('formhtmlsettings', 'block_formhtml'));
$editurl = new moodle_url('/blocks/formhtml/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_formhtml'), $editurl);
$editnode->make_active();

 
$formhtml = new formhtml_form();

$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$formhtml->set_data($toform);

if($formhtml->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/my');
    redirect($courseurl);
} else if ($fromform = $formhtml->get_data()) {
    // We need to add code to appropriately act on and store the submitted data
    // but for now we will just redirect back to the course main page.
    $courseurl = new moodle_url('/my');    
	//print_object($fromform);
	if(!$DB->insert_record('block_formhtml', $fromform)){
		print_error('inserterror','block_formhtml');
	}
	redirect($courseurl);
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    echo $OUTPUT->header();
    $formhtml->display();
    echo $OUTPUT->footer();
}


?>