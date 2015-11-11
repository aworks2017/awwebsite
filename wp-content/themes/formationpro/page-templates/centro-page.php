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
        <form method="post" action="" id="loginform" name="loginform">
                <input type="text" tabindex="10" size="20" value="" class="input" id="user_login" name="log" value="centro_user">
                <input type="password" tabindex="20" size="20" value="" class="input" id="user_pass" name="pwd" value="abc123">
                <input type="submit" tabindex="100" value="Log In" class="button-primary" id="wp-submit" name="wp-submit">
        </form>
        



<?php get_footer('centro'); ?>