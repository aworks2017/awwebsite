<?php

/*
Template Name: AutonomyWorks Hub

<form class="validate-form ajax-form" method="post">
*/


//load scripts
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'autonomyworks-css', get_template_directory_uri() . '/css/autonomyworks.css' );
	wp_enqueue_script( 'workflow-js', get_template_directory_uri() . '/js/workflow.js', array('jquery'), '1.0.0' );
	wp_enqueue_script( 'clipboard-js', get_template_directory_uri() . '/js/clipboard.js', array('jquery'), '1.0.0' );
	wp_localize_script( 'workflow-js', 'workflow', array('ajax_url' => admin_url( 'admin-ajax.php' )) );
	
} );


get_header('autonomyworks'); ?>

		<div id="primary_home" class="content-area">
			<div id="content" class="fullwidth" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content .site-content -->

		</div><!-- #primary .content-area -->



<?php get_footer('centro'); ?>