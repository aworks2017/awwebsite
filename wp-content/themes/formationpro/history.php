<?php

/*
Template Name: History

*/

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/css/history.css' );
});

get_header('centro'); ?>

<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">
            
	<div class="request-from-area" style="max-height: 500px; overflow-y: scroll;">
		<table class="request-sheet" cellpadding="10">
        	<colgroup">
        		<col style="width: 15%;">
        		<col style="width: 10%;">
  				<col style="width: 30%;">
  				<col style="width: 15%;">
			</colgroup>
			<thead>
									<tr>
										<th class="row1">Requestor</th>
										<th class="row1">Campaign ID</th>
										<th class="row1">Report Type</th>
										<th class="row3" style="width:30%">Notes</th>
										<th class="row1" style="width:30%">Date Requested</th>
									</tr>
								</thead>
								<tbody>
								<style type="text/css">
								tr.d0 td {
									background-color: #fffdf7; color: black;
								}
								tr.d1 td {
									background-color: #e5e5e5; color: black;
								}
</style>

<?php echo aw_centro_history(); ?>

								</tbody>
							</table>
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

<?php get_footer('centro'); ?>