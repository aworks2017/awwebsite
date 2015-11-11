<?php

/*
Template Name: Centro Page

<form class="validate-form ajax-form" method="post">
*/



get_header('centro'); ?>

		<div id="primary_home" class="content-area">

			<div id="content" class="fullwidth" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content .site-content -->
			
		</div><!-- #primary .content-area -->

        



<?php get_footer('centro'); ?>