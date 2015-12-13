jQuery(document).ready(function(e) {
    jQuery("#get-workflow").click(function(){
		jQuery.post(workflow.ajax_url,
					{action:'get_workflow'},
					function(data){
						if(data==='0') {
							jQuery("#autonomyworks-home").html('<a id="no-tasks" href="#" class="link yellow">NO TASKS ASSIGNED</a>');
						}else{
							jQuery("#autonomyworks-home").html('<a id="start-workflow" href="#" class="link green">START</a>');
						}
					}
					);
	});
});