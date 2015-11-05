<?php

/*
Template Name: Centro

<form class="validate-form ajax-form" method="post">
*/

$current_user = wp_get_current_user();

function pm_remove_all_scripts() {
    global $wp_scripts;
    $wp_scripts->queue = array();
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/request-form.css' );
	wp_enqueue_script( 'jquery-v65main', get_template_directory_uri() . '/js/jquery-v6.5.main.js', array(), '1.0.0', true );
	$centro_form = array(
	'ajaxurl' => admin_url( 'admin-ajax.php' )
);
wp_localize_script( 'jquery-v65main', 'centro_form', $centro_form );

}
add_action('wp_print_scripts', 'pm_remove_all_scripts', 100);


add_action( 'wp_enqueue_scripts', function(){
	
	
});



get_header('centro'); ?>

<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">
		<div class="table-section inactive">             
			<div class="request-from-area">
						<form class="validate-form ajax-form" action="#" method="post">
							<table class="request-sheet">
								<thead>
									<tr>
										<th class="row1">Campaign ID</th>
										<th class="row1">Requestor</th>
										<th class="row2">Launch <br> Report</th>
										<th class="row2">Pacing <br> Report</th>
										<th class="row2">Final <br> Report</th>
										<th class="row3">Notes</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="row1"><input name="campaign1" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor1" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report1" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report1" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report1" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note1" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign2" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor2" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report2" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report2" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report2" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note2" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign3" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor3" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report3" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report3" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report3" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note3" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign4" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor4" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report4" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report4" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report4" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note4" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign5" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor5" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report5" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report5" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report5" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note5" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign6" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor6" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report6" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report6" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report6" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note6" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign7" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor7" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report7" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report7" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report7" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note7" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign8" type="text" data-rel="edit-field1"></td>
										<td class="row1 add"><input name="requestor8" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report8" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report8" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report8" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note8" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign9" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor9" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report9" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report9" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report9" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note9" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign10" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor10" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report10" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report10" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report10" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note10" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign11" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor11" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report11" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report11" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report11" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note11" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign12" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor12" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report12" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report12" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report12" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note12" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign13" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor13" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report13" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report13" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report13" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note13" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign14" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor14" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report14" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report14" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report14" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note14" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign15" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor15" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report15" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report15" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report15" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note15" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign16" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor16" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report16" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report16" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report16" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note16" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign17" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor17" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report17" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report17" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report17" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note17" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign18" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor18" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report18" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report18" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report18" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note18" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign19" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor19" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report19" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report19" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report19" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note19" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
									<tr>
										<td class="row1"><input name="campaign20" type="text" data-rel="edit-field1" class="clearable"></td>
										<td class="row1 add"><input name="requestor20" type="text" data-rel="edit-field2" data-param="email" class="required-email clearable"></td>
										<td class="row2"><input name="report20" value="0" data-rel="edit-field3" type="radio"></td>
										<td class="row2"><input name="report20" value="1" data-rel="edit-field4" type="radio"></td>
										<td class="row2"><input name="report20" value="2" data-rel="edit-field5" type="radio"></td>
										<td class="row3"><input name="note20" type="text" data-rel="edit-field6" class="clearable"></td>
									</tr>
								</tbody>
							</table>
							<div class="user-info-area">
								<div class="form-block">
									<div class="user-info-holder">
										<div class="field-area validate-row">
											<label for="id">Campaign ID:</label>
											<div class="field-holder">
												<input class="requiredp" type="text" data-rel="edit-field1" name="name" id="id" placeholder="">
											</div>
										</div>
										<div class="field-area">
											<ul class="checkbox-list required-radiop validate-row">
												<li>
													<label for="launch">Launch</label>
													<input type="radio" data-rel="edit-field3" name="name" id="launch">
												</li>
												<li>
													<label for="pacing">Pacing</label>
													<input type="radio" data-rel="edit-field4" name="name" id="pacing">
												</li>
												<li>
													<label for="final">Final</label>
													<input type="radio" data-rel="edit-field5" name="name" id="final">
												</li>
											</ul>
										</div>
										<div class="field-area validate-row">
											<label for="email">Requestor:</label>
											<div class="field-holder">
												<input type="email" data-rel="edit-field2" class="email required-emailp" id="email" placeholder="">
											</div>
										</div>
										<div class="field-area">
											<label for="Note">Notes:</label>
											<div class="field-holder">
											<textarea id="Note" data-rel="edit-field6" placeholder=""></textarea>
											</div>
										</div>
									</div>
									<input class="btn-submit" type="submit" value="SUBMIT">
									<input type="hidden" name="default_email" value="<?php echo $current_user->user_email; ?>">
								</div>
								<div class="error-message">
									<p>&nbsp;<br/>Error - please check areas in red above and resubmit.</p>
								</div>

								<div class="support-message">
									<p>&nbsp;<br/>For support contact <a href="mailto:centro@emailautonomy.com">centro@emailautonomy.com</a></p>

								</div>
							</div>
						</form>
					</div>
				</div>
		</div><!-- .table-section -->
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer('centro'); ?>