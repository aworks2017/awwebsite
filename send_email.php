<?php
	if ( defined('ABSPATH') )
		require_once(ABSPATH . '/vendor/autoload.php');
	else
	require_once(dirname( __FILE__ )  . '/vendor/autoload.php' );
	$targetfolder = "dropzone/files/saeed@helfertech/";
	$mail = new PHPMailer;
	//Enable SMTP debugging. 
	$mail->SMTPDebug = 3;                               
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = "smtp.gmail.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = "ht.test7@gmail";                 
	$mail->Password = ".ht237!!";                           
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";                           
	//Set TCP port to connect to 
	$mail->Port = 587;                                   

	$mail->From = "ht.test7@gmail";
	$mail->FromName = "autonomyworks";

	$mail->addAddress("amir.khan@helfertech", "amir khan");
	$mail->addAttachment($targetfolder, "my-archive.zip");
	$mail->isHTML(true);

	$mail->Subject = "Subject Text";
	$mail->Body = "<i>Mail body in HTML</i>";
	$mail->AltBody = "This is the plain text version of the email content";

	if(!$mail->send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Message has been sent successfully";
	}