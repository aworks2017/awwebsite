var get_workflow_interval;

jQuery(document).ready(function(e) {
    // Hub page
    jQuery("#autonomyworks-home").on("click", "#start-Task", function() {
        jQuery(this).attr("disabled", "disabled");
        jQuery.post(workflow.ajax_url, {
                action: 'get_workflow'
            },
            function(data) {
                tasks_button(data);
            }
        );
    });

	jQuery("#autonomyworks-home").on("click", "#no-tasks", function() {
        jQuery(this).attr("disabled", "disabled");
        jQuery.post(workflow.ajax_url, {
                action: 'get_workflow'
            },
            function(data) {
                tasks_button2(data);
            }
        );
    });

    jQuery("#autonomyworks-home").on("change", "input[type=radio][name=action_stop]", function() {
        var action_stop = jQuery(this).val();
        if (action_stop == 'Issue' || action_stop == 'In Progress') {
            jQuery("#end-stop-workflow").attr('require', 'action_info');
            if (jQuery("#action_info").val().trim() == '') {
                jQuery("#end-stop-workflow").css("opacity", "0.5");
                jQuery("#action_info").focus();
            } else jQuery("#end-stop-workflow").css("opacity", "1");
        } else {
            jQuery("#end-stop-workflow").removeAttr('require').css("opacity", "1");
        }
        jQuery("#end-stop-workflow").fadeIn();
    });

    jQuery("#autonomyworks-home").on("keyup", "#action_info", function() {
        var action_info = jQuery(this).val();
        if (jQuery("#end-stop-workflow").attr('require') == 'action_info') {
            if (action_info != '') {
                jQuery("#end-stop-workflow").css("opacity", "1");
            } else {
                jQuery("#end-stop-workflow").css("opacity", "0.5");
            }
        }
    });



    jQuery("#autonomyworks-home").on("click", "#end-stop-workflow", function() {
        var require = jQuery(this).attr("require");
        if (require && jQuery("#" + require).val().trim() == '') {
            jQuery("#" + require).focus();
            return;
        }
        jQuery(this).attr("disabled", "disabled");
        var jobId = jQuery("#job_id").val();
        var action_stop = jQuery('input[name="action_stop"]:checked').val();
        if (action_stop === "undefined") return false;
        var action_info = jQuery('#action_info').val();
        jQuery.post(workflow.ajax_url, {
                action: 'end_job',
                jobId: jobId,
                action_stop: action_stop,
                action_info: action_info
            },
            function(data) {
                show_hub_page();
            });
    });

    jQuery("#autonomyworks-home").on("click", "#update_act", function() {
        var button = jQuery(this);
        var act_count = jQuery("#act_count").val();
        var jobId = jQuery("#job_id").val();
        if (jQuery.isNumeric(act_count) && act_count >= 0 && act_count <= 9999) {
            button.attr("disabled", "disabled");
            button.css("opacity", "0.5");
            button.html("Updating...");
            jQuery.post(workflow.ajax_url, {
                    action: 'update_count',
                    jobId: jobId,
                    new_count: act_count
                },
                function(data) {
                    var new_val = Number(data.replace(/\"/g, ''));
                    if (new_val != 'NaN') {
                        jQuery("#act_count").html(new_val);
                        button.fadeOut("fast", function() {
                            button.removeAttr("disabled");
                            button.css("opacity", "1");
                            button.html("Update");
                        });
                    } else {
                        button.removeAttr("disabled");
                        button.css("opacity", "1");
                    }
                });
        } else {
            jQuery("#act_count").val('0');
        }
    });

    jQuery("#autonomyworks-home").on("keyup change", "#act_count", function() {
        var oldVal = Number(jQuery(this).attr("oldval"));
        var newVal = Number(jQuery(this).val());
        if (newVal != 'NaN' && newVal !== oldVal) {
            if (!(newVal >= 0 && newVal <= 9999)) {
                newVal = oldVal;
            } else {
                jQuery("#update_act").fadeIn("fast");
                jQuery(this).attr("oldval", newVal);
            }
            jQuery(this).val(newVal);
        }
    });

	jQuery("#autonomyworks-home").on("keypress", "#action_info", function() {
		var val = jQuery(this).val();
		if(val.length>=150) return false;
	});

});

function show_job(data) {
	jQuery("#logout-btn").hide();
    if (typeof(data.activity_driver) === 'undefined' || data.activity_driver === '' || data.activity_driver === 'null' || data.activity_driver === null) data.activity_driver = 'N/A';
    var task_output = '';
    var notes_output = '';
    var stop_output_left = '';
    var stop_output_right = '';
    task_output += '<input type="hidden" id="job_id" value="' + data.job_id + '"/>';
	task_output += '<div id="top_bloc_1">';
    task_output += (data.account_name) ? '<div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Client:</b></div><div class="col-xs-12 col-sm-8">' + data.account_name + '<br> </div></div>' : '';

    task_output += (data.deliverable_name) ? '<div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Deliverable:</b></div><div class="col-xs-12 col-sm-8">' + data.deliverable_name +'</div></div>' : '';

    task_output += (data.name) ? '<div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Task:</b></div><div class="col-xs-12 col-sm-8">' + data.name + '</div></div>' : '';
    task_output += (data.account_name||data.deliverable_name||data.name) ?'<hr style="width:100%">':'';
	task_output += '</div>';
    task_output += (data.parameter_1) ? '<br/><div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Parameter 1:</b></div><div id="copy1_text" class="col-xs-12 col-sm-6">' + data.parameter_1 + '</div><div class="col-xs-12 col-sm-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy1_text">Copy 1</button></div></div>' : '';
    task_output += (data.parameter_2) ? '<div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Parameter 2:</b></div><div id="copy2_text" class="col-xs-12 col-sm-6">' + data.parameter_2 + '</div><div class="col-xs-12 col-sm-2"><button class="btn" data-clipboard-action="copy" data-clipboard-target="#copy2_text">Copy 2</button></div></div>' : '';
    task_output += '<div class="col-md-12 form-group"><div class="col-xs-12 col-sm-4"><b>Activity Driver:</b></div><div class="col-xs-12 col-sm-6"><span id="act_driver">' + ((data.activity_driver) ? data.activity_driver : 'null') + '</span> - <input id="act_count" type="number" min="0" max="9999" style="width: 55px;text-align: center;border: none;" value="' + ((data.activity_count) ? data.activity_count : '') + '" oldval="' + ((data.activity_count) ? data.activity_count : '') + '"></div><div class="col-xs-12 col-sm-2"><button class="btn" id="update_act">Update</button></div></div>';
    jQuery("#task-bloc").html(task_output);

	notes_output += '<div id="top_bloc_2" class="col-md-12">';
    notes_output += (data.stopping_point) ? '<div class="col-md-12"><b>Associate Notes:</b><br/> ' + data.stopping_point+'</div>'  : '';
	notes_output += '</div>';
    notes_output += (data.production_notes) ? '<div class="col-md-12"><div class="col-md-12"><br/><b>Production Notes:</b><p>' + data.production_notes + '</p></div></div>' : '';

    jQuery("#notes-bloc").html(notes_output);
	var max_top_bloc = (jQuery("#top_bloc_1").height()>jQuery("#top_bloc_2").height())?jQuery("#top_bloc_1").height():jQuery("#top_bloc_2").height();
	jQuery("#top_bloc_1").height(max_top_bloc);
	jQuery("#top_bloc_2").height(max_top_bloc);

    var status_checks = '<input type="radio" name="action_stop" value="Completed"> Completed<br/><input type="radio" name="action_stop" value="In Progress"> In Progress<br/><input type="radio" name="action_stop" value="Issue"> Issue';
    stop_output_left += '<div class="col-md-12 form-group"><div class="col-md-5"><b>Status:</b></div><div class="col-md-7">' + status_checks + '</div></div>';

    jQuery("#stop-bloc .left").html(stop_output_left);

    stop_output_right += '<div class="col-md-12 form-group"><div class="col-md-12"><b>Associate Notes:</b></div><div class="col-md-12"><textarea id="action_info"></textarea></div></div>';
    stop_output_right += '<div class="col-md-12 form-group"><a id="end-stop-workflow"  class="link grey" style="display:none;">Submit</a></div>';

    jQuery("#stop-bloc .right").html(stop_output_right);
    jQuery("#action-bloc").html('<hr class="hr2">');

    new Clipboard('.btn');
}


function tasks_button(job) {
    clearInterval(get_workflow_interval);
	if(job === '"ONCALL"'){
		show_on_call();
	}
    else
	if (job === '0' || job === "null" ||  job === null) {
        jQuery.post(workflow.ajax_url, {
                action: 'on_call'
            },
            function(data) {
                show_on_call();
            }
        );

    } else {
        start_job(job);
    }
}

function tasks_button2(job) {
    clearInterval(get_workflow_interval);
	if(job === '"ONCALL"'){
		show_on_call();
	}
    else
	if (job === '0' || job === "null" ||  job === null) {
        jQuery.post(workflow.ajax_url, {
                action: 'on_call'
            },
            function(data) {
                show_on_call();
            }
        );

    } else {
        show_hub_page();
    }
}

function start_job(job) {
    jQuery.post(workflow.ajax_url, {
            action: 'get_job',
            jobId: job
        },
        function(workflow_data) {
            show_job(workflow_data);
        }, "json");
}

function show_on_call() {
	jQuery("#logout-btn").show();
    jQuery("#action-bloc").html('<hr><div id="no-tasks" class="grey_btn">Refresh</div>');
    jQuery("#notes-bloc").html(empty_notes_bloc);
    jQuery("#task-bloc").html(empty_task_bloc);
    jQuery("#stop-bloc").html('<div class="col-md-6 left"></div><div class="col-md-6 right">');
    get_workflow_interval = setTimeout(function() {
        jQuery("#no-tasks").click();
    }, 300000);
}

function show_hub_page() {
	jQuery("#logout-btn").show();
    jQuery("#task-bloc").html('');
    jQuery("#notes-bloc").html('');
    jQuery("#action-bloc").html('<div id="start-Task" class="grey_btn">Start Task</div>');
    jQuery("#stop-bloc").html('<div class="col-md-6 left"></div><div class="col-md-6 right"> </div>');
}

var start_notes_bloc = '<h3>ATTENTION</h3><p>You have a <b>new</b> task waiting.<br>Click the Start button when you are ready to begin.</p>';
var empty_notes_bloc = '<h3>Production Notes:</h3><p><b>IMPORTANT:</b> Please send an IM to confirm that you are on call.</p>';
var empty_task_bloc = '<div class="col-md-12"><div class="col-md-4"><b>Task:</b></div><div class="col-md-6">On Call</div></div>';