<?php

/*
Template Name: AutonomyWorks Hub

<form class="validate-form ajax-form" method="post">
*/


//load scripts
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'workflow', get_template_directory_uri() . '/js/workflow.js', array('jquery'), '1.0.0' );
} );


get_header('autonomyworks'); ?>

		<div id="primary_home" class="content-area">
			<?php echo 'momo : '.get_option('api_server');?><br>
            <?php echo 'momo : '.get_option('api_key');?>
            <?php
			global $current_user;
      get_currentuserinfo();

      echo 'Username: ' . $current_user->user_login . "\n";
	  ?>
			<div id="content" class="fullwidth" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content .site-content -->

		</div><!-- #primary .content-area -->



<?php get_footer('centro'); ?>