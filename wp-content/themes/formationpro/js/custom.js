jQuery(document).ready(function($){
	$("#submit_header_search").click(function(){
		if($("#header_searchform input").val()!="")
        $('#header_searchform').submit();
    });
});