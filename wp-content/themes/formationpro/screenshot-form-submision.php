<?php

/*
Template Name: Screenshot-FormSubmission

*/
 get_header('centro'); 
 if($_REQUEST['not_sent']==1){
	 echo "<b><font color='red'>The email couldn't be sent to respectived email address. Please contact to your administrator.</font></b>";
 }
 if($_REQUEST['form_submission_id']){
	 echo '<b><font color="red">Form submission '.$_REQUEST['form_submission_id'].' successful</font></b>';
 }
 ?>

<?php get_footer('centro'); ?>