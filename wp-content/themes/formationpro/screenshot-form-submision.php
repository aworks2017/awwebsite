<?php

/*
Template Name: Screenshot-FormSubmission

*/
 get_header('centro'); 
 if($_REQUEST['not_sent']==1){
	 echo "<center><b><font color='red'>The email couldn't be sent to respectived email address. Please contact to your administrator.</font></b>
			<p><a href='?p=1233'>Click here to return</a></p></center>";
 }
 if($_REQUEST['form_submission_id']){
	 echo '<center><b><font color="red">Form submission '.$_REQUEST['form_submission_id'].' successful</font></b>
	 <p><a href="?p=1233">Click here to enter another request</a></p>
	 </center>';
 }
 ?>

<?php get_footer('centro'); ?>