<?php

/*
Template Name: AutonomyWorks Change pass
*/


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
		}
}

?>

		<div id="primary_home" class="content-area">
        <?php
		if($changed) {
					echo 'changed !!';
		}
		?>
			<form method="post" action="#">
                <input type="text" name="pass" />
                <input type="hidden" name="change" value="1" />
                <input type="submit" value="change"/>
            </form>
		</div><!-- #primary .content-area -->
        
<?php get_footer('centro'); ?>