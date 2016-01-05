<?php

/*
Template Name: AutonomyWorks Change pass
*/

//load scripts

$changed = NULL ;
if(isset($_POST['change']) and isset($_POST['pass'])){
		global $wpc_client;
		$ID = $wpc_client->current_plugin_page['client_id'] ;
		if( is_numeric($ID) && $ID > 0 ) {
			$client_gps = $wpc_client->cc_get_client_groups_id($ID); //array of string
			$allowed_gps = array('3','4'); //allowed groups IDs
			$intersect = array_intersect( $client_gps , $allowed_gps ) ;
			if(!empty($intersect)) {
				$pass = $_POST['pass'] ; 
				$userdata = array( 
					'ID' => esc_attr($ID),
					'user_pass' => $pass 
				);
				$changed = $wpc_client->cc_client_update_func( $userdata );
			}else die('You are not allowed !!');
		} 
}

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css' );
} );

get_header('autonomyworks'); 
?>

		<div id="primary_home" class="content-area">
        <?php if($changed){?>
		<div class="success">Your password has been changed !</div>	
		<?php }?>
        <form method="post" action="#">
		<input type="text" name="pass" id="pass" />
        <input type="submit" name="change" value="change meee" />
        <div id="change_pass">Change pass</div> 
        </form>
               
<?php get_footer('centro'); ?>