<?php

/*
Template Name: Screenshots

*/

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/dropzone.min.css' );
});
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/dropzone.min.js');
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/jquery.blockUI.js');
 get_header('screenshot'); 
 ?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">

		<head>
		</head>
		<body>
		<form name="screenshotForm"  id="screenshotForm"  action="<?php echo admin_url('file_upload.php');?>" method="post" enctype="multipart/form-data">
		<table border="0" width="500" align="center" class="table">
		<p>For all screenshot requests for your selected advertiser (including screenshots at the launch of a campaign, creative swaps, and new flights), 
		please fill out the information below. Please allow AutonomyWorks 24-48 hours to pull the screenshots upon receiving this email.</p>
		<tr width="80%">
			<td width="30%"> Requester email address:</td>
			<td width="50%"><input type="text" name="requester_email" id="requester_email" maxlength="50"></td>
		</tr>

		<tr>
			<td>Additional screenshot recipients (email addresses):</td>
			<td><input type="text" name="additional_screenshot" style="margin-top: 5px;" maxlength="250"></td>
		</tr>
		<tr>
			<td>Screenshot Due Date:<span style="color: red;">*</span></td>
			<td><input type="date" name="screenshot_due_date" style="margin-top: 5px;">
			<span id="span_screenshot_due_date"  style="color: red; display:none">Field is required</span></td>
		</tr>
		<tr>
			<td>Advertiser:<span style="color: red;">*</span></td>
			<td><input type="text" name="advertiser" style="margin-top: 5px;" maxlength="50">
			<span id="span_advertiser"  style="color: red; display:none">Field is required</span></td>
		</tr>
		<tr>
			<td>Campaign ID:<span  style="color: red;">*</span></td>
			<td><input type="text" name="campaign_id" style="margin-top: 5px;" maxlength="50">
			<span id="span_campaign_id"  style="color: red; display:none">Field is required</span></td>
		</tr>
		<tr>
			<td>Launch Date of Campaign:<span  style="color: red;">*</span></td>
			<td><input type="date" name="last_date_campaign" style="margin-top: 5px;">
			<span id="span_last_date_campaign"  style="color: red; display:none">Field is required</span></td>
		</tr>
		<tr>
			<td>Sites/Networks (please specify any content or geotargeting):</td>
			<td><input type="text" name="site_networks" style="margin-top: 5px;" maxlength="250"></td>
		</tr>
		<tr>
			<td>Number of screenshots/sizes per site:</td>
			<td><input type="text" name="no_of_screenshot" style="margin-top: 5px;" maxlength="250"></td>
		</tr>
		<tr>
			<td>If there is a special PowerPoint template (different from the Centro template), please attach:</td>
			<td><input type="file" name="file_optional" id="file_optional" style="margin-top: 5px;"></td>
		</tr>
		<tr>
			<td>Any special instructions?:<span id="" style="color: red;">*</span></td>
			<td><input type="text" name="special_instruction" maxlength="250">
			<span id="span_special_instruction"  style="color: red; display:none">Field is required</span></td>
		</tr>
		</table>
		Creative files (please attach):
			<div id="dZUpload" class="dropzone">
				 <div class="fallback">
				  <input name="file[]" type="file" multiple />
				 </div>
				   <div class="dz-default dz-message">
				    Drag files here to upload, or click to browse for files.
				   </div>
			</div>		
		<div>
		<br>
		<input type="button" name="submit" id="submit" value="Submit" class="btnRegister" onclick="checkFileUploaded()">
		<span style="color:red;display:none;" id="file_upload_error">Please select atleast one file to upload.</span>
		</div>
		</form>	
	</div>
		<div class="request-from-area">
				<div class="user-info-area">
					<div class="support-message"><br /><br />
						<p>&nbsp;<br/>For support contact <a href="mailto:centro@emailautonomy.com">centro@emailautonomy.com</a></p><br /><br />

					</div>
				</div>
		</div>
</div>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
 <script type="text/javascript">
	function isEmpty(str) {
		return (!str || 0 === str.length);
	} 
	function checkFileUploaded(){
		var inputs_val = $('#screenshotForm :input');
				inputs_val.each(function() {
					var name_field = $(this).attr('name');
					var field_val = $('[name="'+name_field+'"]').val();
					if(isEmpty(field_val)){
						if($("#span_"+name_field)){
							$("#span_"+name_field).show();
							return false;
						}
					}
				});		
		if($(".dz-image-preview").length < 1){
			$("#file_upload_error").show();
		}
	}
	var element = "#dZUpload";
	var myDropzone = new Dropzone(element,{
		url: "<?php echo admin_url('file_upload.php');?>",
        addRemoveLinks: true,
		uploadMultiple: true,
		maxFilesize: 50,
		parallelUploads: 100,
		maxFiles: 100,
		autoProcessQueue: false,
        success: function (file,response) {
		   if((response)){
			   url_redirect = response.replace(/\s/g, '');
				   window.location.href= url_redirect;
		  }else{
				console.log(response);
	     }
  },		
		init: function() {
			dzClosure = this;
			document.getElementById("submit").addEventListener("click", function(e) {
					e.stopImmediatePropagation();
					e.preventDefault();
					e.stopPropagation();
					dzClosure.processQueue();
				// }
				return false;
			});
			//send all the form data along with the files:
			this.on("sendingmultiple", function(data, xhr, formData) {
				var optional_file = $('#file_optional')[0].files[0];
				data.push(optional_file);
				//formData.append($('form').serializeArray());
				var inputs = $('#screenshotForm :input');

				var values = {};
				inputs.each(function() {
					var name = $(this).attr('name');
					var val = $('[name="'+name+'"]').val();
					formData.append(name, val);
				});
			});			
		}
     });
 </script>
<?php get_footer('centro'); ?>