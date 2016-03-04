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
	<?php 
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->user_login ;
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=login&key=".$api_key."&user=".$user;
	$response =   wp_remote_get( $url );
	if(is_wp_error($response)) : ?>
    	<a id="no-tasks" class="link yellow">ON CALL</a>
    <?php else: //show workfloww ?>
    <div class="col-md-12">
    	<div id="task-bloc" class="col-md-6">
        	<?php $data = json_decode ($response, true); ?> 
            <div class="col-md-12">
            	<div class="col-md-4">Deliverable:</div>
            	<div class="col-md-6"><?php echo $data['estimated_start'].'<br>'.$data['estimated_finish']?></div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-4">Task:</div>
            	<div class="col-md-6"><?php echo $data['name']?></div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-4">Parameter 1:</div>
            	<div class="col-md-6"><?php echo $data['parameter_1']?></div>
                <div class="col-md-2">copy</div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-4">Parameter 2:</div>
            	<div class="col-md-6"><?php echo $data['parameter_2']?></div>
                <div class="col-md-2">copy</div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-4">[Activity Driver]:</div>
            	<div class="col-md-6"><input type="text"/ value"<?php echo $data['parameter_2']?>"></div>
            </div>
         </div>
         <div id="notes-bloc" class="col-md-6">
         	<div class="col-md-12">
            	<div class="col-md-12">Previous Stopping Point:</div>
            	<div class="col-md-12">3.2.1</div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-12">Production Notes:</div>
            	<div class="col-md-12">Skip records marked “issue”</div>
            </div>
         </div>
    </div>
    <?php endif;?> 
               
</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->



<?php get_footer('centro'); ?>