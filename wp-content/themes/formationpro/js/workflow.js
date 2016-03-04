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
	
	jQuery("#autonomyworks-home").on("click","#start-workflow",function(){
		jQuery(this).attr("disabled","disabled");
		var jobId = jQuery(this).attr("job");
		jQuery.post(workflow.ajax_url,
					{action:'get_job', jobId:jobId},
					function(data){
						console.log(data);
						show_job(data);
					},"json");
	});
	
	jQuery("#autonomyworks-home").on("click","#stop-workflow",function(){
		jQuery(this).attr("disabled","disabled");
		var jobId = jQuery(this).attr("job");
		var output = '<div class="row" style="display: block;margin: 0 auto;width: 760px;">';
		output += '<div class="row">';
		output += '<div class="col-md-3"><strong>Reason : </strong></div>';
		output += '<div class="col-md-9"><div class="col-md-3"><input type="radio" name="reason" value="Completed"> Completed</div>';
		output += '<div class="col-md-3"><input type="radio" name="reason" value="In Progress"> In Progress</div>';
		output += '<div class="col-md-3"><input type="radio" name="reason" value="Issue"> Issue</div>';
		output += '<div class="col-md-3"><input type="radio" name="reason" value="QA Check"> QA Check</div></div>';
		output += '</div>';
		output += '<div class="row">';
		output += '<div class="col-md-3"><strong>More info : </strong></div>';
		output += '<div class="col-md-9"><input type="text" id="more-info" style="width:100%"></div>';
		output += '</div>';
		output += '<div class="row"><a id="end-stop-workflow"  class="link grey" job="'+jobId+'" style="display:none;">OK</a></div>';
		output += '</div>';
		jQuery("#autonomyworks-home").html(output);
	});
	
	jQuery("#autonomyworks-home").on("change","input[type=radio][name=reason]",function(){
		jQuery("#end-stop-workflow").fadeIn();
	});
		
	jQuery("#autonomyworks-home").on("click","#end-stop-workflow",function(){
		jQuery(this).attr("disabled","disabled");
		var jobId = jQuery(this).attr("job");
		var  reason = jQuery('input[name="reason"]:checked').val();
		if(reason==="undefined") return false;
		var  more_info = jQuery('#more-info').val();
		jQuery.post(workflow.ajax_url,
					{action:'end_job', jobId:jobId,reason:reason,more_info:more_info},
					function(data){
						tasks_button(data);
		});
	});
	
	jQuery("#autonomyworks-home").on("click","#update_act",function(){
		var button = jQuery(this) ;
		var act_count = jQuery("#act_count").val();
		var jobId = button.attr("job");
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
	task_output +='<div class="col-md-12"><div class="col-md-4"><b>Deliverable:</b></div><div class="col-md-6">data.estimated_start<br>data.estimated_finish</div></div>';
	task_output +='<div class="col-md-12"><div class="col-md-4"><b>Task:</b></div><div class="col-md-6">data.name</div></div>';
	task_output +='<div class="col-md-12"><div class="col-md-4"><b>Parameter 1:</b></div><div id="copy1_text" class="col-md-6">data.parameter_1</div><div class="col-md-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy1_text">Copy 1</button></div></div>';
	task_output +='<div class="col-md-12"><div class="col-md-4"><b>Parameter 1:</b></div><div id="copy1_text" class="col-md-6">data.parameter_2</div><div class="col-md-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy2_text">Copy 2</button></div></div>';
	task_output+='<div class="col-md-12"><div class="col-md-4">[Activity Driver]:</div><div class="col-md-4"><span id="act_driver">data.activity_driver</span> - <input id="act_count" type="number" min="0" max="9999" style="width: 55px;text-align: center;border: none;" value="data.activity_count" oldval="data.activity_count"></div><div class="col-md-2"><input type="button" id="update_act" value="Update" job="data.job_id"></div></div>';
	jQuery("#task-bloc").html(task_output);
	
	notes_output += '<h3><b>Previous Stopping Point:</b></h3>';
	notes_output += '<p>3.2.1</p>';
	notes_output += '<h3><b>Production Notes:</b></h3>';
	notes_output += '<p>Skip records marked "issue"</p>';
	
	jQuery("#notes-bloc").html(task_output);
	
	new Clipboard('.btn');
}

function tasks_button(job){
	console.log(job);
	clearInterval(get_workflow_interval);
	if(job==='0' || job==="null" || job===null) {
		jQuery("#action-bloc").html('<div id="no-tasks" class="grey_btn">Refresh</div>');
		jQuery("#notes-bloc").html(empty_notes_bloc);
		jQuery("#task-bloc").html(empty_task_bloc);
		jQuery("#stop-bloc").html('<hr>');
		get_workflow_interval = setTimeout(function(){jQuery("#no-tasks").click()},300000);
	}else{
		jQuery.post(workflow.ajax_url,
					{action:'get_job', jobId:job},
					function(workflow_data){
						show_job(workflow_data);
					},"json");
		//jQuery("#autonomyworks-home").html('<a id="start-workflow"  class="link green" job='+data+'>START</a>');
	}
}

var empty_notes_bloc = '<h3>Production Notes:</h3><p><b>IMPORTANT:</b> Check back every 5 minutes to see if you have a new task.</p><p>Some things you may do while you are on call:<ul><li>Professional Development</li><li>Use the Restroom</li><li>Stretch</li><li>Read</li><li>Other quiet activities</li></ul></p>';
var empty_task_bloc = '<div class="col-md-12"><div class="col-md-4"><b>Task:</b></div><div class="col-md-6">On Call</div></div>';