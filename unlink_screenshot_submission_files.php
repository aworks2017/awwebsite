<?php
require_once('wp-load.php');
global $wpdb;
$squantial_number = $wpdb->get_results("SELECT files_path FROM ".$wpdb->prefix."screenshot_form_submission");
foreach($squantial_number as $file_path){
	deleteOldFiles('wp-admin/'.$file_path->files_path);
}
echo "All screen shot submitted files before saven days were successfully  deleted.";
function deleteOldFiles($targetfolder) {
	$hours =168;
	if (is_dir($targetfolder)){
		$filelastmodified = filemtime($targetfolder);
		if((time()-$filelastmodified) > $hours*3600)
		{
		  if ($dht = opendir($targetfolder)){
			while (($file = readdir($dht)) !== false){
				if($file=='..' || $file=='.'){
					continue;
				}
					unlink($targetfolder.$file);
			}
			closedir($dht);
		  }
		   rmdir($targetfolder);
		}				
	}	
}