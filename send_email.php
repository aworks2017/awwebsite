<?php
if ( defined('ABSPATH') )
	require_once(ABSPATH . 'wp-load.php');
else
	require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );
$targetfolder = "dropzone/files/saeed@helfertech/";
$form_submission_id ='ID'. substr(number_format(time() * rand(),0,'',''),0,6);
$message = 'Hi '.$POST['Name'].'! Please find attachment sent on '.$POST['date_entered'].'
			Form submission ID is '.$form_submission_id.'';
 $sent_response = mail_attachment('my-archive.zip', $targetfolder, 'saeed@helfertech', 'ht.test7@gmail.com', 'autonomyworks', 'saeed@helfertech.com', 'Test Form Email', $message);
  if($sent_response){
	  echo $sent_response;die;
  }
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	$file = $path.$filename;
	$file_size = filesize($file);
	$handle = fopen($file, "r");
	$content = fread($handle, $file_size);
	fclose($handle);

	$content = chunk_split(base64_encode($content));
	$uid = md5(uniqid(time()));
	$name = basename($file);

	$eol = PHP_EOL;

	// Basic headers
	$header = "From: ".$from_name." <".$from_mail.">".$eol;
	$header .= "Reply-To: ".$replyto.$eol;
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

	// Put everything else in $message
	$message = "--".$uid.$eol;
	$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
	$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	$message .= $body.$eol;
	$message .= "--".$uid.$eol;
	$message .= "Content-Type: application/pdf; name=\"".$filename."\"".$eol;
	$message .= "Content-Transfer-Encoding: base64".$eol;
	$message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
	$message .= $content.$eol;
	$message .= "--".$uid."--";

	if (wp_mail($mailto, $subject, $message, $header))
	{
		return "Yes";
	}
	else
	{
		return "No";
	}
	    
}