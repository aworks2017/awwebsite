<?php

/*
Template Name: Screenshot Email Template

*/
function get_screenshot_mail_template()
{
ob_start();
$string='
<p>Please find attached data and files you submitted. The form submission ID is form_submission_id </p>
<p>
	<ul>
		<li><b>Requester email address:&nbsp;</b> $requester_email </li> 
		<li><b>Additional screenshot recipients:&nbsp;</b> $additional_screenshot </li>
		<li><b>Screenshot Due Date:&nbsp;</b> $screenshot_due_date </li> 
		<li><b>Advertiser:&nbsp;</b> $advertiser </li>
		<li><b>Campaign ID(s):&nbsp;</b> $campaign_id </li>
		<li><b>Launch Date of Campaign:&nbsp;</b> $last_date_campaign </li>
		<li><b>End Date of Campaign:&nbsp;</b> $end_date_of_campaign </li>
		<li><b>Sites/Networks (please specify any content or geotargeting):&nbsp;</b> $site_networks </li> 
		<li><b>Number of screenshots/sizes per site:&nbsp;</b> $no_of_screenshot </li>
		<li><b>Any special instructions:&nbsp;</b> $special_instruction </li>
	</ul>
</p>';
return $string; } ?>
  