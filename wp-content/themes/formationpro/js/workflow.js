jQuery(document).ready(function(e) {
    jQuery("#get-workflow").click(function(){
		jQuery.post(workflow.ajax_url,
					{action:'get_workflow'},
					function(data){
						if(data==='0') {
							jQuery("#centro-home").html('<a id="no-tasks" href="#" class="link">NO TASKS ASSIGNED</a>');
						}else{
							jQuery("#centro-home").html('<a id="start-workflow" href="#" class="link">START</a>');
						}
					}
					);
	});
});