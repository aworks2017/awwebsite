<?php

/*
Template Name: Screenshot-FormSubmission

*/
 get_header('screenshot'); 
 if($_REQUEST['not_sent']==1){
	 echo "<center><b><font color='red'>The email could not be sent to the email address entered. Please contact your administrator.</font></b>
			<p><a href='/forms/clients/centro-screenshots/'>Click here to return</a></p></center>";
 }
 if($_REQUEST['form_submission_id']){
	 echo '<center><b><font color="red">Form submission '.$_REQUEST['form_submission_id'].' successful</font></b>
	 <p><a href="/forms/clients/centro-screenshots/">Click here to enter another request</a></p>
	 </center>';
 }
 ?>

<?php get_footer('centro'); ?>