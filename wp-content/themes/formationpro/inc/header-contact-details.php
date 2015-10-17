<?php
	
	/*
	 * Header contact Details
	 */	

	$list_contact_options = array(
		'telnumber'			=> __( 'Telephone Number', 'formationpro'),
		'mobile'			=> __( 'Mobile Number', 'formationpro'),
		'email'				=> __( 'Email Address', 'formationpro'),
		'address'			=> __( 'Address', 'formationpro'),
	);

	echo "<div class='topbar_content_left'>";

	foreach( $list_contact_options as $key => $value){
		if( get_theme_mod( $key . '_textbox_header_one' ) ){
			echo '<div class="contact">' . get_theme_mod( $key . '_textbox_header_one' ) . '</div>';
		}
	}

	echo "</div>";


	
