<?php

/*
Template Name: Screenshots

*/
ini_set('post_max_size', '1000M');
ini_set('upload_max_filesize', '1000M');
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/dropzone.min.css' );
});
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/dropzone.min.js');
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/jquery.blockUI.js');
 get_header('screenshot'); 
 ?>
 <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> 
<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">

		<head>
		</head>
		<body>
		<form name="screenshotForm"  id="screenshotForm"  action="<?php echo admin_url('screenshots_form.php');?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="no_attachments_flag" id="no_attachments_flag" value="1">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<table border="0" width="500" align="center" class="table">
		<p>For all screenshot requests for your selected advertiser (including screenshots at the launch of a campaign, creative swaps, and new flights), 
		please fill out the information below. Please allow AutonomyWorks 24-48 hours to pull the screenshots upon receiving this email.</p>
		<tr width="80%">
			<td width="30%"> Requester email address:<span style="color: red;">*</span></td>
			<td width="50%"><input type="text" class="required_fields" name="requester_email" id="requester_email">
			<span id="span_requester_email"  style="color: red; display:none">Requester email address is required</span></td>
		</tr>

		<tr>
			<td>Additional screenshot recipients (email addresses):</td>
			<td><input type="text" name="additional_screenshot" id="additional_screenshot" style="margin-top: 5px;"></td>
		</tr>
		<tr>
			<td>Screenshot Due Date:<span style="color: red;">*</span></td>
			<td><input type="text" name="screenshot_due_date" class="required_fields" id="screenshot_due_date" style="margin-top: 5px;">
			<span class="hint">Screenshots required on multiple dates should be submitted as individual requests.</span><span id="span_screenshot_due_date"  style="color: red; display:none">Screenshot Due Date is required</span></td>
		</tr>
		<tr>
			<td>Advertiser:<span style="color: red;">*</span></td>
			<td><input type="text" class="required_fields" name="advertiser" id="advertiser" style="margin-top: 5px;" >
			<span id="span_advertiser"  style="color: red; display:none">Advertiser is required</span></td>
		</tr>
		<tr>
			<td>Campaign ID(s):<span  style="color: red;">*</span></td>
			<td><input type="text" class="required_fields" name="campaign_id"  id="campaign_id" style="margin-top: 5px;" >
			<span id="span_campaign_id"  style="color: red; display:none">Campaign ID is required</span></td>
		</tr>
		<tr>
			<td>Launch Date of Campaign:<span  style="color: red;">*</span></td>
			<td><input type="text"  class="required_fields" name="last_date_campaign" id="last_date_campaign" style="margin-top: 5px;">
			<span id="span_last_date_campaign"  style="color: red; display:none">Launch Date of Campaign is required</span></td>
		</tr>
		<tr>
			<td>End Date of Campaign:</td>
			<td><input type="text" name="end_date_of_campaign" id="end_date_of_campaign" style="margin-top: 5px;">
			</td>
		</tr>
		<tr>
			<td>Sites/Networks (please specify any content or geotargeting):</td>
			<td><input type="text" name="site_networks" id="site_networks" style="margin-top: 5px;"></td>
		</tr>
		<tr>
			<td>Number of screenshots/sizes per site:</td>
			<td><input type="text" name="no_of_screenshot" id="no_of_screenshot" style="margin-top: 5px;"></td>
		</tr>
		<tr>
			<td>If there is a special PowerPoint template (different from the Centro template), please attach:</td>
			<td><input type="file" name="file_optional" id="file_optional" style="margin-top: 5px;">
			<span id="span_file_optional"  style="color: red; display:none">File size is greater than 50MB.</span></td>
		</tr>
		<tr>
			<td>Any special instructions? (Please include any specific brands or placements you would like screenshots for):</td>
			<td><textarea name="special_instruction" id="special_instruction" style="margin: 0px;width: 300px;height: 42px;"></textarea>
			</td>
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
		<input type="submit" name="screenshot_submit" id="screenshot_submit" value="Submit" class="btnRegister" onclick=" return checkFileUploaded();">
		<span id="span_file_size_error"  style="color: red; display:none">File size is greater than 50MB.</span>
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
 <style>
	.hint { display: none; color: gray; font-style: italic; }
	input:focus + .hint { display: inline; }
 </style>
 <script type="text/javascript">
   $(document).ready(function() {
    $("#screenshot_due_date").datepicker({
      dateFormat: 'dd/mm/yy',
	  minDate: 1
});
  });
tinymce.init({
  selector: 'textarea',
  height: 150,
  menubar: false,
  elementpath: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: '//www.tinymce.com/css/codepen.min.css'
}); 
	function isEmpty(str) {
		return (!str || 0 === str.length);
	} 
	function checkFileUploaded(){
		var inputs_val = $('#screenshotForm .required_fields');
		var check = true;
				inputs_val.each(function() {
					var name_field = $(this).attr('name');
					var field_val = $('[name="'+name_field+'"]').val();
					if(isEmpty(field_val)){
						if(typeof ($("#span_"+name_field)) !== 'undefined' && $("#span_"+name_field).length > 0){
							$("#span_"+name_field).show();
							check = false;
						}
					}else{
						$("#span_"+name_field).hide();
					}
				});
		if($('#file_optional').val() !=''){
			if($('#file_optional')[0].files[0].size <= 50*1024*1024){
				 $("#span_file_optional").hide();
			 }else{
				 $("#span_file_optional").show();
				 return false;
				}
		}			
		return check;
	}
	var element = "#dZUpload";
	var myDropzone = new Dropzone(element,{
		url: "<?php echo admin_url('screenshots_form.php');?>",
        addRemoveLinks: true,
		uploadMultiple: true,
		maxFilesize: 51,
		maxThumbnailFilesize: 51,
		createImageThumbnails: true,
		parallelUploads: 100,
		maxFiles: 100,
		autoProcessQueue: false,
        success: function (file,response) {
		   if((response)){
			   url_redirect = response.replace(/\s/g, '');
			  // window.location.href= url_redirect;					   
		  }
  },		
		init: function() {
			dzClosure = this;
			document.getElementById("screenshot_submit").addEventListener("click", function(e) {
				if(checkFileUploaded()){
					if (dzClosure.getQueuedFiles().length > 0) {
						$("#no_attachments_flag").val('0');
						e.stopImmediatePropagation();
						e.preventDefault();
						e.stopPropagation();
						dzClosure.processQueue();
					}			
				}			
			});
			this.on("complete", function(file) {
            if (file.size > 50*1024*1024) {
                this.removeFile(file);
                $("#span_file_size_error").show();
                return false;
            }else{
                $("#span_file_size_error").hide();				
			}
			});					
			//send all the form data along with the files:
			this.on("sendingmultiple", function(data, xhr, formData) {
				if($('#file_optional').val() !=''){
					$('#file_optional')[0].files[0].name = "optional_"+$('#file_optional')[0].files[0];
						var optional_file = $('#file_optional')[0].files[0];
						data.push(optional_file);		
				}
				//formData.append($('form').serializeArray());
				var inputs = $('#screenshotForm :input');
				var values = {};
				inputs.each(function() {
					var name = $(this).attr('name');
					var val = $('[name="'+name+'"]').val();
					formData.append(name, val);
				});
					formData.append("special_instruction", tinyMCE.get('special_instruction').getContent());			
			});			
		}
     });
 </script>
<?php get_footer('centro'); ?>