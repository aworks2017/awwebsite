jQuery(document).ready(function(e) {
    jQuery("#get-workflow").click(function(){
		jQuery.post(workflow.ajax_url,
					{action:'get_workflow'},
					function(data){
						if(data==='0') {
							jQuery("#autonomyworks-home").html('<a id="no-tasks" href="#" class="link yellow">NO TASKS ASSIGNED</a>');
						}else{
							jQuery("#autonomyworks-home").html('<a id="start-workflow" href="#" class="link green" job='+data+'>START</a>');
						}
					}
					);
	});
	
	jQuery("#autonomyworks-home").on("click","#start-workflow",function(){
		var jobId = jQuery(this).attr("job");
		jQuery.post(workflow.ajax_url,
					{action:'get_job', jobId:jobId},
					function(data){
						console.log(data);
						show_job(data);
					},"json");
	});
	
});

function show_job(data){
	var output = '<div>';
	output += '<div class="left col2" style="text-align:left"><strong>Current Job : </strong>'+data.name+'<br><strong>Parameter 1 : </strong>'+data.parameter_1+'<br><strong>Parameter 2 : </strong>'+data.parameter_2+'</div>';
	output += '<div class="right col2" style="text-align:left"><strong>Started :</strong>'+data.estimated_start+'<br><strong>Estimated Finish : </strong>'+data.estimated_finish+'<br><strong>Activity Driver : </strong>'+data.activity_driver+' - '+data.activity_count+'</div>';
	output += '<br><div class="row"><a id="stop-workflow" href="#" class="link red">STOP</a></div>';
	jQuery("#autonomyworks-home").html(output);

}