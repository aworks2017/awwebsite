<?php

/*
Template Name: Centro Page

<form class="validate-form ajax-form" method="post">
*/



get_header('centro'); ?>

		<div id="primary_home" class="content-area">

			<div id="content" class="fullwidth" role="main">
            	<?php
				if ( is_user_logged_in() ) {
					do_shortcode('[wpc_client_loginf no_redirect="true" no_redirect_text="" /]');
				}
				else{
					while ( have_posts() ) {
						the_post(); 		 		       							
						get_template_part( 'content', 'page' ); 
					}
				}
				?>
			</div><!-- #content .site-content -->

		</div><!-- #primary .content-area -->



<?php get_footer('centro'); ?>