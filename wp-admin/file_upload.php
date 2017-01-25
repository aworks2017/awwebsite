<?php
if ( defined('ABSPATH') )
	require_once(ABSPATH . 'wp-load.php');
else
	require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );
function my_custom_email_content_type( $content_type ) {
	return 'text/html';
}
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
	 $sent_response = mail_attachment('my-archive.zip', $targetfolder, $_POST[ 'userEmail' ], 'ht.test7@gmail.com', 'autonomyworks', 'saeed@helfertech.com', 'Test Form Email', $message);
	  if($sent_response){
		  echo $sent_response;die;
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