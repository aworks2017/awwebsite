<?php

/*
Template Name: AutonomyWorks Change pass
*/
$changed = NULL ;
if(isset($_POST['change']) and isset($_POST['pass'])  and isset($_POST['pass2'])){
		global $wpc_client;
		$ID = $wpc_client->current_plugin_page['client_id'] ;
		if($_POST['pass'] != $_POST['pass2']) {
			$changed = (-1) ;
		}elseif( is_numeric($ID) && $ID > 0 ) {
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

//load scripts
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css' );
} );

get_header('autonomyworks'); 
?>

		<div id="primary_home" class="content-area">
        <div class="row">
        <h1>Change Password</h1>
        <hr/>
        <?php if($changed>0){?>
        <p class="bg-success">Your password has been changed !</p>
		<?php }elseif($changed==(-1)){?>
        <p class="bg-danger">Please verify the new Password !</p>
        <?php }?>
        <form method="post" action="#">
        	
              <div class="form-group col-md-6">
                <label for="pass">New Password</label>
                <input type="password" class="form-control" name="pass">
              </div>
              <div class="form-group  col-md-6">
                <label for="pass2">Repeat New Password</label>
                <input type="password" class="form-control"  name="pass2">
              </div>
              <button type="submit" name="change" class="btn btn-default">Change Password</button>
          	
          
        </form>
        </div>       
<?php get_footer('centro'); ?>