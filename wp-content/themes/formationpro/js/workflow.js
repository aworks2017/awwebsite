jQuery(document).ready(function(e) {
	show_job({name:'momo'});
	jQuery("#autonomyworks-home").on("click","#get-workflow,#no-tasks",function(){
		jQuery(this).attr("disabled","disabled");
		jQuery.post(workflow.ajax_url,
					{action:'get_workflow'},
					function(data){
						if(data==='0' || data==="null" || data===null) {
							jQuery("#autonomyworks-home").html('<a id="no-tasks" href="#" class="link yellow">NO TASKS ASSIGNED</a>');
						}else{
							jQuery("#autonomyworks-home").html('<a id="start-workflow" href="#" class="link green" job='+data+'>START</a>');
						}
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
		var output = '<div class="row" style="display: block;margin: 0 auto;width: 530px;">';
		output += '<div class="col-md-3"><strong>Reason: </strong></div>';
		output += '<div class="col-md-9"><input type="radio" name="reason" value="Completed">Completed ';
		output += '<input type="radio" name="reason" value=" In Progress"> In Progress ';
		output += '<input type="radio" name="reason" value="Issue">Issue ';
		output += '<input type="radio" name="reason" value="QA Check">QA Check</div>';
		output += '<div class="col-md-3"><strong>More info: </strong></div>';
		output += '<div class="col-md-9"><input type="text" id="more-info" style="width:100%"></div>';
		output += '<div class="col-md-12"><a id="end-stop-workflow" href="#" class="link grey" job="'+jobId+'">OK</a></div>';
		output += '</div>';
		jQuery("#autonomyworks-home").html(output);
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
						console.log(data);
						if(data==='0' || data==="null"  || data===null) {
							jQuery("#autonomyworks-home").html('<a id="no-tasks" href="#" class="link yellow">NO TASKS ASSIGNED</a>');
						}else{
							jQuery("#autonomyworks-home").html('<a id="start-workflow" href="#" class="link green" job='+data+'>START</a>');
						}
					});
		
	});
	
});

function show_job(data){
	var output = '<div>';
	output += '<div class="left col2" style="text-align:left"><strong>Current Job : </strong>'+data.name+'<br><strong>Parameter 1 : </strong>'+data.parameter_1+'<br><strong>Parameter 2 : </strong>'+data.parameter_2+'</div>';
	output += '<div class="right col2" style="text-align:left"><strong>Started : </strong>'+data.estimated_start+'<br><strong>Estimated Finish : </strong>'+data.estimated_finish+'<br><strong>Activity Driver : </strong>'+data.activity_driver+' - '+data.activity_count+'</div>';
	output += '<br><div class="row"><a id="stop-workflow" href="#" class="link red" job="'+data.job_id+'">STOP</a></div>';
	output += '</div>';
	jQuery("#autonomyworks-home").html(output);

}