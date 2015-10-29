<?php

/*
Template Name: History

*/

$centro_history = aw_centro_history();

get_header(); ?>

<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">
            
	<div class="request-from-area" style="max-height: 500px; overflow-y: scroll;">
		<table class="request-sheet" cellpadding="10">
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

<?php echo $centro_history; ?>

								</tbody>
							</table>
					</div>
					<div class="request-from-area">
							<div class="user-info-area">
								<div class="support-message"><br /><br /><br /><br />
									<center><a class="button-red" href="/menu">MAIN MENU</a></center>
								</div>
								<div class="support-message"><br /><br />
									<p>&nbsp;<br/>For support contact <a href="mailto:centro@emailautonomy.com">centro@emailautonomy.com</a></p><br /><br />

								</div>
							</div>
					</div>
			</div>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>