<?php

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
	    
	    $header = $from_mail."\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	    $header .= "This is a multi-part message in MIME format.\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	    $header .= $message."\r\n\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
	    $header .= "Content-Transfer-Encoding: base64\r\n";
	    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	    $header .= $content."\r\n\r\n";
	    $header .= "--".$uid."--";
	    // Messages for testing only, nobody will see them unless this script URL is visited manually
	    if (mail($mailto, $subject, "", $header)) {
	        return "Yes";
	    } else {
	        return "No";
	    }
	    
	}