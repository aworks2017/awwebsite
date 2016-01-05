<?php

/*
Template Name: AutonomyWorks Change pass
*/

//load scripts
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'workflow-js', get_template_directory_uri() . '/js/workflow.js', array('jquery'), '1.0.0' );
	wp_localize_script( 'workflow-js', 'workflow', array('ajax_url' => admin_url( 'admin-ajax.php' )) );
} );

get_header('autonomyworks'); 
$changed = NULL ;
if(isset($_POST['change']) and isset($_POST['pass'])){
		global $wpc_client;
		$ID = $wpc_client->current_plugin_page['client_id'] ;
		if(is_numeric($ID) && $ID>0) {
			$pass = $_POST['pass'] ; 
			$userdata = array( 
				'ID' => esc_attr($ID),
				'user_pass' => $pass 
			);
			$changed = $wpc_client->cc_client_update_func( $userdata );
			die($changed);
		}
}

?>

		<div id="primary_home" class="content-area">
        <form method="post" action="#">
		<input type="text" id="pass" />
        <input type="submit" id="xxpass" value="change meee" />
        <div id="change_pass">Change pass</div> 
        </form>
               
<?php get_footer('centro'); ?>