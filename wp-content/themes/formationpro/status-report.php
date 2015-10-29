<?php

/*
Template Name: Status

*/

$centro_status = aw_centro_status();

get_header(); ?>

<div id="primary_home" class="content-area">
	<div id="content" class="fullwidth" role="main">
    
	<div class="request-from-area" style="max-height: 500px; overflow-y: scroll;">
		<table class="request-sheet" cellpadding="10">
			<thead>
									<tr>
										<th class="row1">Requestor</th>
										<th class="row1">Total</th>
										<th class="row1">Current Week</th>
										<th class="row1">Last Week</th>
										<th class="row1">2 Weeks Ago</th>
										<th class="row1">3 Weeks Ago</th>
										<th class="row1">4 Weeks Ago</th>
										<th class="row1">5 Weeks Ago</th>
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

<?php echo $centro_status; ?>

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