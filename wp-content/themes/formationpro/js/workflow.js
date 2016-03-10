var get_workflow_interval ;

jQuery(document).ready(function(e) {
	jQuery("#autonomyworks-home").on("click","#get-workflow,#no-tasks",function(){
		jQuery(this).attr("disabled","disabled");
		jQuery.post(workflow.ajax_url,
					{action:'get_workflow'},
					function(data){
						tasks_button(data);
					}
					);
	});
	
	jQuery("#autonomyworks-home").on("change","input[type=radio][name=action_stop]",function(){
		var action_stop = jQuery(this).val();
		if(action_stop=='In Progress') {
			jQuery("#end-stop-workflow").attr('require','action_stopping_point');
			if(jQuery("#action_stopping_point").val().trim()=='') {
				jQuery("#end-stop-workflow").css("opacity","0.5");
				jQuery("#action_stopping_point").focus();
			}else jQuery("#end-stop-workflow").css("opacity","1");
			
		}else if(action_stop=='Issue') {
			jQuery("#end-stop-workflow").attr('require','action_info');
			if(jQuery("#action_info").val().trim()=='') {
				jQuery("#end-stop-workflow").css("opacity","0.5");
				jQuery("#action_info").focus();
			}else jQuery("#end-stop-workflow").css("opacity","1");
		}else{
			jQuery("#end-stop-workflow").removeAttr('require').css("opacity","1");
		}
		jQuery("#end-stop-workflow").fadeIn();
	});
	
	jQuery("#autonomyworks-home").on("keyup","#action_stopping_point",function(){
		var action_stopping_point = jQuery(this).val();
		if(jQuery("#end-stop-workflow").attr('require')=='action_stopping_point') {
			if(action_stopping_point!='') {
				jQuery("#end-stop-workflow").css("opacity","1");
			}else{jQuery("#end-stop-workflow").css("opacity","0.5");}
		}
	});
	jQuery("#autonomyworks-home").on("keyup","#action_info",function(){
		var action_info = jQuery(this).val();
		if(jQuery("#end-stop-workflow").attr('require')=='action_info') {
			if(action_info!='') {
				jQuery("#end-stop-workflow").css("opacity","1");
			}else{jQuery("#end-stop-workflow").css("opacity","0.5");}
		}
	});
		
	jQuery("#autonomyworks-home").on("click","#end-stop-workflow",function(){
		jQuery(this).attr("disabled","disabled");
		var jobId = jQuery(this).attr("job");
		var  reason = jQuery('input[name="reason"]:checked').val();
		if(reason==="undefined") return false;
		var  more_info = jQuery('#stop_notes').val();
		var stopping_point = jQuery('#stopping_point').val();
		jQuery.post(workflow.ajax_url,
					{action:'end_job', jobId:jobId,reason:reason,more_info:more_info,},
					function(data){
						tasks_button(data);
		});
	});
	
	jQuery("#autonomyworks-home").on("click","#update_act",function(){
		var button = jQuery(this) ;
		var act_count = jQuery("#act_count").val();
		var jobId = jQuery("#job_id").val();
		if(jQuery.isNumeric(act_count) && act_count>=0  && act_count<=9999) {
			button.attr("disabled","disabled");
			button.css("opacity","0.5");
			button.val("Updating...");
			jQuery.post(workflow.ajax_url,
					{action:'update_count', jobId:jobId, new_count :act_count },
					function(data){
						var new_val = Number(data.replace(/\"/g, '')) ;
						if(new_val!='NaN') {
							jQuery("#act_count").html(new_val);
							button.fadeOut("fast", function(){
								button.removeAttr("disabled");
								button.css("opacity","1");
								button.val("Update");
							});
						}else{
							button.removeAttr("disabled");
							button.css("opacity","1");
						}
					});
		}else{
			jQuery("#act_count").val('0');
		}
	});
	
	jQuery("#autonomyworks-home").on("keyup change","#act_count",function(){
		var oldVal = Number(jQuery(this).attr("oldval"));
		var newVal = Number(jQuery(this).val());
		if(newVal!='NaN' && newVal !==oldVal) {
			if(!(newVal>=0 && newVal<=9999)) {
				newVal=oldVal;
			}else{
				jQuery("#update_act").fadeIn("fast");
				jQuery(this).attr("oldval",newVal);
			}
			jQuery(this).val(newVal);
		}
	});
	
});

function show_job(data){
	if(data.activity_driver===null) data.activity_driver = 'N/A';
	var task_output = '';
	var notes_output = '';
	var stop_output_left = '';
	var stop_output_right = '';
	task_output +='<input type="hidden" id="job_id" value="'+data.job_id+'"/>';
	task_output +='<div class="col-md-12 form-group"><div class="col-md-4"><b>Deliverable:</b></div><div class="col-md-6">'+((data.account_name)?data.account_name:'null')+'<br>'+((data.deliverable_name)?data.deliverable_name:'null')+'</div></div>';
	task_output +='<div class="col-md-12 form-group"><div class="col-md-4"><b>Task:</b></div><div class="col-md-6">'+((data.name)?data.name:'null')+'</div></div>';
	task_output +='<div class="col-md-12 form-group"><div class="col-md-4"><b>Parameter 1:</b></div><div id="copy1_text" class="col-md-6">'+((data.parameter_1)?data.parameter_1:'null')+'</div><div class="col-md-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy1_text">Copy 1</button></div></div>';
	task_output +='<div class="col-md-12 form-group"><div class="col-md-4"><b>Parameter 1:</b></div><div id="copy2_text" class="col-md-6">'+((data.parameter_2)?data.parameter_2:'null')+'</div><div class="col-md-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy2_text">Copy 2</button></div></div>';
	task_output+='<div class="col-md-12 form-group"><div class="col-md-4"><b>[Activity Driver]:</b></div><div class="col-md-6"><span id="act_driver">'+((data.activity_driver)?data.activity_driver:'null')+'</span> - <input id="act_count" type="number" min="0" max="9999" style="width: 55px;text-align: center;border: none;" value="'+((data.activity_count)?data.activity_count:'null')+'" oldval="'+((data.activity_count)?data.activity_count:'null')+'"></div><div class="col-md-2"><input type="button" id="update_act" value="Update"></div></div>';
	jQuery("#task-bloc").html(task_output);
	
	notes_output += '<h4><b>Previous Stopping Point:</b></h4>';
	notes_output += '<p>'+((data.stopping_point)?data.stopping_point:'null')+'</p>';
	notes_output += '<h4><b>Production Notes:</b></h4>';
	notes_output += '<p>'+((data.production_notes)?data.production_notes:'null')+'</p>';
	
	jQuery("#notes-bloc").html(notes_output);
	
	var status_checks = '<input type="radio" name="action_stop" value="Completed"> Completed<br/><input type="radio" name="action_stop" value="In Progress"> In Progress<br/><input type="radio" name="action_stop" value="Issue"> Issue';
	stop_output_left += '<div class="col-md-12 form-group"><div class="col-md-5"><b>Stopping Point:</b></div><div class="col-md-7"><input id="action_stopping_point" type="text"/></div></div>';
	stop_output_left += '<div class="col-md-12 form-group"><div class="col-md-5"><b>Status:</b></div><div class="col-md-7">'+status_checks+'</div></div>';
	
	jQuery("#stop-bloc .left").html(stop_output_left);
	
	stop_output_right += '<div class="col-md-12 form-group"><div class="col-md-2"><b>Notes:</b></div><div class="col-md-10"><textarea id="action_info"></textarea></div></div>';
	stop_output_right += '<div class="col-md-12 form-group"><a id="end-stop-workflow"  class="link grey" job="jobId" style="display:none;">Submit</a></div>';
	
	jQuery("#stop-bloc .right").html(stop_output_right);
	jQuery("#action-bloc").html('<hr>');
	
	new Clipboard('.btn');
}

function tasks_button(job){
	console.log(job);
	clearInterval(get_workflow_interval);
	if(job==='0' || job==="null" || job===null) {
		jQuery("#action-bloc").html('<hr><div id="no-tasks" class="grey_btn">Refresh</div>');
		jQuery("#notes-bloc").html(empty_notes_bloc);
		jQuery("#task-bloc").html(empty_task_bloc);
		jQuery("#stop-bloc").html('<div class="col-md-6 left"></div><div class="col-md-6 right">');
		get_workflow_interval = setTimeout(function(){jQuery("#no-tasks").click()},300000);
	}else{
		jQuery.post(workflow.ajax_url,
					{action:'get_job', jobId:job},
					function(workflow_data){
						show_job(workflow_data);
					},"json");
	}
}

var empty_notes_bloc = '<h3>Production Notes:</h3><p><b>IMPORTANT:</b> Check back every 5 minutes to see if you have a new task.</p><p>Some things you may do while you are on call:<ul><li>Professional Development</li><li>Use the Restroom</li><li>Stretch</li><li>Read</li><li>Other quiet activities</li></ul></p>';
var empty_task_bloc = '<div class="col-md-12"><div class="col-md-4"><b>Task:</b></div><div class="col-md-6">On Call</div></div>';