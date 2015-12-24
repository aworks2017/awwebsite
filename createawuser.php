<?php

define('WP_USE_THEMES', false);
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require('wp-load.php');


sugarCRM_hook_new_user();
function sugarCRM_hook_new_user(){
	global $wpc_client;
	if(
		isset($_GET['api_key']) and
		isset($_GET['user_type']) and
		isset($_GET['user_name']) and
		isset($_GET['pswd'])
	){
		if($_GET['api_key'] !== get_option('api_key')){
			die('Invalid key');
		}
		
		$groups = $wpc_client->cc_get_groups();
		$group_id = NULL;
		foreach($groups as $i=>$group){
			if(strcasecmp($group['group_name'], $_GET['user_type']) == 0){
				$group_id = $group['group_id'];
				break;
			}
		}
		
		if($group_id==NULL) die('0');
		
		$user_name = esc_attr( trim( $_GET['user_name'] ) );
		if ( username_exists( $user_name ) ) die('0');
		
		$userdata = array( 
			'user_pass' => $_GET['pswd'] , 
			'user_login' => $user_name , 
			'display_name' => $user_name , 
			'role' => 'wpc_client',
			'client_circles' =>array($group_id)
		);
		$client_id = $wpc_client->cc_client_update_func( $userdata );
		if($client_id>0) die('1');
		else die('0');
	}else die('0');
}