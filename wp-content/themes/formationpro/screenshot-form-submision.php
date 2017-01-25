<?php

/*
Template Name: Screenshot-FormSubmission

*/
 get_header('centro'); 
 if($_REQUEST['not_sent']==1){
	 echo "<b><font color='red'>Email not sent on Form Submission</font></b>";
 }
 if($_REQUEST['form_submission_id']){
	 echo '<b><font color="red">Form Submission ID is '.$_REQUEST['form_submission_id'].'</font></b>';
 }
 ?>

<?php get_footer('centro'); ?>