<?php
require_once('../phpmailer/class.phpmailer.php');
require_once('../phpmailer/config.php');
require_once('../wp-content/themes/formationpro/screenshot_mail_template.php');
$form_submission_id ='ID'. substr(number_format(time() * rand(),0,'',''),0,6);
$targetfolder = "dropzone/files/".$form_submission_id.'/';
ini_set('display_errors', 0);
error_reporting(0);
if( isset( $_POST[ 'requester_email' ]) && !empty( $_POST[ 'requester_email' ])) {
	$optional_name = basename($_POST['file_optional']);
	$template_html= get_screenshot_mail_template();
	$template_html = str_replace('form_submission_id', $form_submission_id, $template_html);
	$template_html = str_replace('$requester_email', $_POST['requester_email'], $template_html);
	$template_html = str_replace('$additional_screenshot',$_POST['additional_screenshot'], $template_html);
	$template_html = str_replace('$screenshot_due_date',$_POST['screenshot_due_date'], $template_html);
	$template_html = str_replace('$advertiser', $_POST['advertiser'], $template_html);
	$template_html = str_replace('$campaign_id', $_POST['campaign_id'], $template_html);
	$template_html = str_replace('$last_date_campaign',$_POST['last_date_campaign'], $template_html);
	$template_html = str_replace('$site_networks', $_POST['site_networks'], $template_html);		
	$template_html = str_replace('$no_of_screenshot',$_POST['no_of_screenshot'], $template_html);
	$template_html = str_replace('$special_instruction', $_POST['special_instruction_html'], $template_html);
    
	$attachments = array();
	$optional_file='';
	if(isset($_FILES[ 'file' ]) && !empty($_FILES[ 'file' ])){
		$files = $_FILES[ 'file' ];
		if (!file_exists($targetfolder)) {
			mkdir($targetfolder, 0777, true);
		}
		foreach($_FILES['file']['tmp_name'] as $i=>$file){
			move_uploaded_file($file, $targetfolder.basename($_FILES['file']['name'][$i]));
		}
		if (is_dir($targetfolder)){
		  if ($dht = opendir($targetfolder)){
			while (($file = readdir($dht)) !== false){
				if($file=='..' || $file=='.'){
					continue;
				}
				if($file != $optional_name){
					$attachments []= $targetfolder.$file;
				}else{				
					$optional_file = $file;
				}
			}
			closedir($dht);
		  }
		}
		create_zip($attachments, $targetfolder.'centro-form_'.$form_submission_id.'.zip');
	}elseif(isset($_FILES['file_optional']) && !empty($_FILES['file_optional'])){
		if (!file_exists($targetfolder)) {
			mkdir($targetfolder, 0777, true);
		}
		move_uploaded_file($_FILES['file_optional']['tmp_name'], $targetfolder.basename($_FILES['file_optional']['name']));
		$optional_file = $_FILES['file_optional']['name'];
	}
	 
	$mail = new PHPMailer;
	//Enable SMTP debugging. 
	$mail->SMTPDebug = false;
	$mail->do_debug = 0;                             
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = $email_config['host'];
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = $email_config['user_name'];                 
	$mail->Password = $email_config['password'];                           
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = $email_config['smtp'];                           
	//Set TCP port to connect to 
	$mail->Port = $email_config['port'];                                   

	$mail->From = $email_config['from_email'];
	$mail->FromName = $email_config['from_name'];
	if(isset($_FILES['file']) && !empty($_FILES['file'])){
		$mail->addAttachment($targetfolder.'centro-form_'.$form_submission_id.'.zip', 'centro-form_'.$form_submission_id.'.zip');
	}elseif(!empty($optional_file)){
		$mail->addAttachment($targetfolder.$optional_file, $optional_file);
	}
	$mail->Subject = "Centro form data ".$form_submission_id."";
	$mail->isHTML(true);
	$mail->Body = $template_html;
	$mail->AltBody = $template_html;	
	foreach($email_config['userEmail'] as $email){
		$mail->addAddress($email, $email_config['userName']);	
	}
	if($mail->send()){
		rmdir($targetfolder);
		$redirect_url = '?p=1238&form_submission_id='.$form_submission_id;
	} 
	else{
		$redirect_url =  '?p=1238&not_sent=1';
	}
	ob_clean();
	if(isset($_REQUEST['no_attachments_flag']) && $_REQUEST['no_attachments_flag']){
		//header('Location: '.$_SERVER['HTTP_ORIGIN'].'/'.$redirect_url);
		echo '<script type="text/javascript">
				window.location = "'.$_SERVER['HTTP_ORIGIN'].'/'.$redirect_url.'";
			</script>';
	}else{
		echo $redirect_url;
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
			$new_filename = substr($file,strrpos($file,'/') + 1);
			$zip->addFile($file,$new_filename);
		}
		
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