<?php
echo 'test test';
require_once('../phpmailer/PHPMailerAutoload.php');
$targetfolder = "dropzone/files/".$_POST[ 'userEmail' ].'/';
if( isset( $_POST[ 'submit' ] ) && isset( $_POST[ 'userEmail' ]) && !empty( $_POST[ 'userEmail' ])) {

    $files = $_FILES[ 'file' ];
    $upload_overrides = array( 'test_form' => false );

    $attachments = array();
		if (!file_exists($targetfolder)) {
			mkdir($targetfolder, 0777, true);
		}
		move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder.basename($_FILES['file']['name']));
		foreach($_FILES['file']['tmp_name'] as $i=>$file){
			move_uploaded_file($file, $targetfolder.basename($_FILES['file']['name'][$i]));
		}
		$attachments = array();
		if (is_dir($targetfolder)){
		  if ($dht = opendir($targetfolder)){
			while (($file = readdir($dht)) !== false){
				if($file=='..' || $file=='.'){
					continue;
				}
				$attachments []= $targetfolder.$file;
			}
			closedir($dht);
		  }
		}		
	$form_submission_id ='ID'. substr(number_format(time() * rand(),0,'',''),0,6);
	$message = 'Hi '.$POST['Name'].'! Please find attachment sent on '.$POST['date_entered'].'
				Form submission ID is '.$form_submission_id.'';
	 create_zip($attachments,$targetfolder.'my-archive.zip');
	 
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

	$mail->addAddress($_POST[ 'userEmail' ], $_POST[ 'Name' ]);
	$mail->addAttachment($targetfolder."my-archive.zip", "my-archive.zip");
	$mail->isHTML(true);

	$mail->Subject = "Centro Form Data";
	$mail->Body = "Please find attached data and files you submitted. The form submission ID is {$form_submission_id}";
	$mail->AltBody = "Please find attached data and files you submitted. The form submission ID is {$form_submission_id}";
	echo 'thsi is test';
	if(!$mail->send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Message has been sent successfully";
	}	 
} 
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}