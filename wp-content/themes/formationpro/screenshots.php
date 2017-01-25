<?php

/*
Template Name: Screenshots

*/

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/dropzone.min.css' );
});
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/dropzone.min.js');
 wp_enqueue_script( 'script', get_template_directory_uri() . '/js/jquery.blockUI.js');
 get_header('centro'); 
 ?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">

		<head>
		</head>
		<body>
		<form name="screenshotForm"  id="screenshotForm" onSubmit=window.location='http://google.com' action="<?php echo admin_url('file_upload.php');?>" method="post" enctype="multipart/form-data">
		<table border="0" width="500" align="center" class="table">
		<tr>
		<td> Name:</td>
		<td><input type="text" class="InputBox" name="Name" value=""></td>
		</tr>

		<tr>
		<td>Email:</td>
		<td><input type="text" class="InputBox" name="userEmail" value="" style="margin-top: 5px;"></td>
		</tr>
		<tr>
		<td>Due Date:</td>
		<td><input type="date" name="date_entered"></td>
		</tr>
		</table>
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
		<span style="color:red;display:none;" id="file_upload_error">Please select atleast on file to upload.</span>
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
	function checkFileUploaded(){
		if($(".dz-image-preview").length < 1){
			$("#file_upload_error").show();
		}else{
			$.blockUI({ message: '<h1>Your form is submitting. Please wait...</h1>', baseZ: 10000, });
		}
	}
	var element = "#dZUpload";
	var myDropzone = new Dropzone(element,{
		url: "<?php echo admin_url('file_upload.php');?>",
        addRemoveLinks: true,
		uploadMultiple: true,
		parallelUploads: 25,
		maxFiles: 25,
		autoProcessQueue: false,
        success: function (file, response) {
            var imgName = response;
		   if((response)){
				var myArray = JSON.parse(response);
				if(myArray['return_url']){
				 window.location.href= myArray['return_url'];
				}
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