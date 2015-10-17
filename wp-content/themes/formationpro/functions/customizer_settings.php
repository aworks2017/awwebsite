<?php
/**
 * Customizer - Add Custom Styling
 */
function formationpro_customizer_style()
{
	wp_enqueue_style('formationpro-customizer', get_template_directory_uri() . '/functions/css/customizer.css');
}
add_action('customize_controls_print_styles', 'formationpro_customizer_style');

/**
 * Customizer - Live Preview
 */
function formationpro_customizer_live_preview() {
	wp_enqueue_script( 
		'formationpro-theme-customizer', 
		get_template_directory_uri() . '/js/theme-customizer.js', 
		array( 'customize-preview' ), 
		rand(),  
		true 
	);
}
add_action( 'customize_preview_init', 'formationpro_customizer_live_preview' );

/**
 * Customizer - Panels, Sections, Settings & Controls
 */
function formationpro_register_theme_customizer( $wp_customize ) {

	//  List Arrays
	$list_social_channels = array( // 1
		'twitter'			=> __( 'Twitter url', 'formationpro' ),
		'facebook'			=> __( 'Facebook url', 'formationpro' ),
		'googleplus'		=> __( 'Google + url', 'formationpro' ),
		'linkedin'			=> __( 'LinkedIn url', 'formationpro' ),
		'flickr'			=> __( 'Flickr url', 'formationpro' ),
		'pinterest'			=> __( 'Pinterest url', 'formationpro' ),
		'youtube'			=> __( 'YouTube url', 'formationpro' ),
		'vimeo'				=> __( 'Vimeo url', 'formationpro' ),
		'tumblr'			=> __( 'Tumblr url', 'formationpro' ),
		'dribble'			=> __( 'Dribbble url', 'formationpro' ),
		'github'			=> __( 'Github url', 'formationpro' ),
		'instagram'			=> __( 'Instagram url', 'formationpro' ),
		'xing'				=> __( 'Xing url', 'formationpro'),
	);

	$list_contact_options = array(
		'telnumber'			=> __( 'Telephone Number', 'formationpro'),
		'mobile'			=> __( 'Mobile Number', 'formationpro'),
		'email'				=> __( 'Email Address', 'formationpro'),
		'address'			=> __( 'Address', 'formationpro'),
	);

	$list_featured_text_boxes = array(
		array('one', __('One', 'formationpro'), __('Service Box One', 'formationpro')),
		array('two', __('Two', 'formationpro'), __('Service Box Two', 'formationpro')),
		array('three', __('Three', 'formationpro'), __('Service Box Three', 'formationpro')),
	);

	$list_partners_text_boxes = array(
		array('one', __('One', 'formationpro'), __('Partners logo 1', 'formationpro')),
		array('two', __('Two', 'formationpro'), __('Partners logo 2', 'formationpro')),
		array('three', __('Three', 'formationpro'), __('Partners logo 3', 'formationpro')),
		array('four', __('Four', 'formationpro'), __('Partners logo 4', 'formationpro')),
	);



	/*
	* //////////////////// Panels ////////////////////////////
	*/

	$priority = 10;

	if(method_exists('WP_Customize_Manager', 'add_panel')){
		
		$wp_customize->add_panel('formationpro_header_panel', array(
			'title'		=> __('Site Settings', 'formationpro'),
			'priority'	=> $priority++,
		));

		$wp_customize->add_panel('formationpro_homepage_panel', array(
			'title'		=> __('Homepage Settings', 'formationpro'),
			'priority'	=> $priority++,
		));

	}
		

	/*
	* //////////////////// Sections ////////////////////////////
	*/

	$priority = 2;

	$wp_customize->add_section( 'formationpro_logo_section' , array(
		'title'       		=> __( 'Site Logo', 'formationpro' ),
		'description' 		=> __( 'Upload a logo to replace the default site name and description in the header', 'formationpro' ),
		'panel'				=> 'formationpro_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'formationpro_favicons' , array(
		'title'     		=> __('Favicon & App Icons', 'formationpro'),
		'panel'		 		=> 'formationpro_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'telnumber_section_one', array(
		'title'       		=> __( 'Header Contact Details', 'formationpro' ),
		'description' 		=> __( 'Add contact details that will appear in the header of your site.', 'formationpro' ),
		'panel'				=> 'formationpro_header_panel',
		'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'formationpro_social_section', array(
		'title'				=> __('Social Media Accounts', 'formationpro'),
		'description' 		=> __( 'Setup your social media accounts here.', 'formationpro' ),
		'panel'				=> 'formationpro_header_panel',
		'priority'			=> $priority++,
	));

	$wp_customize->add_section( 'footer_settings', array(
	    'title'       		=> __( 'Footer Settings', 'formationpro' ),
	    'description' 		=> __( "Change/hide content in the footer.", 'formationpro' ),
	    'panel'				=> 'formationpro_header_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'formationpro_color_scheme_settings', array(
		'title'       		=> __( 'Color Scheme', 'formationpro' ),
		'description' 		=> __( 'Click on a color for a preview of a color scheme', 'formationpro' ),
		'panel'				=> 'formationpro_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'homepage_slider', array(
	    'title'       		=> __( 'Homepage Slider', 'formationpro' ),
	    'description' 		=> __( 'Control the homepage slider', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'service_section_settings', array(
	    'title'       		=> __( 'Service Section Settings', 'formationpro' ),
	    'description' 		=> __( 'Change the title and control the display.', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_section( 'featured_section_' . $list_featured_text_boxes[$row][0], array(
			    'title' 			=> $list_featured_text_boxes[$row][2],
			    'description' 		=> __( 'This is a settings section to change the custom homepage services box.', 'formationpro' ),
			    'panel'				=> 'formationpro_homepage_panel',
			    'priority' 			=> $priority++,
	        )
	    );	
	}
	
	$wp_customize->add_section( 'featured_section_top', array(
	    'title'       		=> __( 'Featured Promo Bar', 'formationpro' ),
	    'description' 		=> __( 'Create a eye catching "call to action"', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'recent_posts_section_settings', array(
	    'title'       		=> __( 'Recent Posts Section Settings', 'formationpro' ),
	    'description' 		=> __( 'Change the title and control the display.', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

    $wp_customize->add_section( 'testimonials_section_settings', array(
	    'title'       		=> __( 'Testimonials Section Settings', 'formationpro' ),
	    'description' 		=> __( 'Change the title and control the display.', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

    $wp_customize->add_section( 'partners_section_settings', array(
	    'title'       		=> __( 'Partners Section Settings', 'formationpro' ),
	    'description' 		=> __( 'Change the title and control the display.', 'formationpro' ),
	    'panel'				=> 'formationpro_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {
	 	$wp_customize->add_section( 'logo_section_' . $list_partners_text_boxes[$row][0], array(
		    'title' 			=> $list_partners_text_boxes[$row][2],
		    'description' 		=> __( 'This is a settings section to change the Custom Homepage Partners logo 1.', 'formationpro' ),
		    'panel'				=> 'formationpro_homepage_panel',
		    'priority'		 	=> $priority++,
	        )
	    );
	}

	$wp_customize->add_section( 'authors_template_settings', array(
	    'title'       		=> __( 'Authors Template Settings', 'formationpro' ),
	    'description' 		=> __( "Paste user Id's seperated by commas to display user profiles.", 'formationpro' ),
	    'priority'			=> $priority++,
    ));




	/*
	* //////////////////// Settings ////////////////////////////
	*/

	$wp_customize->add_setting('formationpro_global_favicon', array(
		'sanitize_callback'	=> 'formationpro_sanitize_url',
	));

	$wp_customize->add_setting('formationpro_global_apple_icon', array(
		'sanitize_callback'	=> 'formationpro_sanitize_url',
	));

	foreach ($list_contact_options as $key => $value){

		$wp_customize->add_setting( $key . '_textbox_header_one', array(
				'sanitize_callback' => 'formationpro_sanitize_text',
			)
		);

	}

	foreach ($list_social_channels as $key => $value) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => 'formationpro_sanitize_url',
		));

	}

	$wp_customize->add_setting( 'formationpro_logo', array(
			'sanitize_callback' => 'formationpro_sanitize_url',
		)
	);

	$wp_customize->add_setting('formationpro_retina_logo', array(
			'sanitize_callback' => 'formationpro_sanitize_url',
	));

	$wp_customize->add_setting( 'formationpro_color_scheme', array(
			'default'        	=> 'blue',
			'sanitize_callback' => 'formationpro_sanitize_text',
		) 
	);

	$wp_customize->add_setting( 'formationpro_custom_main_color_bool', array(
			'default'        	=> false,
			'sanitize_callback' => 'formationpro_sanitize_checkbox',
		) 
	);

	$wp_customize->add_setting( 'formationpro_custom_main_color', array(
			'default'        	=> '#d72d00',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_color',
		) 
	);

	$wp_customize->add_setting( 'homepage_slider_hide', array(
			'default' 			=> false,
			'sanitize_callback' => 'formationpro_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_setting( 'homepage_slider_cat', array(
			'default'			=> 'featured',
			'sanitize_callback'	=> 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'homepage_slider_slide_no', array(
	        'default'     		=> '3',
			'sanitize_callback'	=> 'formationpro_sanitize_integer',
    	)
	); 

	$wp_customize->add_setting( 'homepage_promotional_bool', array(
			'default' 			=> false,
			'sanitize_callback' => 'formationpro_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting( 'featured_textbox', array(
			'default' 			=> __( 'Default Featured Text', 'formationpro' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'featured_button_txt', array(
			'sanitize_callback' => 'formationpro_sanitize_text',
			'transport'			=> 'postMessage',
			'default'			=> 'Find Out More',
		)
	);

	$wp_customize->add_setting( 'featured_button_url', array(
			'sanitize_callback' => 'formationpro_sanitize_url',
		)
	);

	$wp_customize->add_setting('homepage_service_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_setting( 'header-' . $list_featured_text_boxes[$row][0] . '-file-upload', array(
				'sanitize_callback' => 'formationpro_sanitize_url',
			)
		);

		$wp_customize->add_setting( 'featured_textbox_header_' . $list_featured_text_boxes[$row][0], array(
	        	'default' 			=> __( 'Default featured text Header', 'formationpro' ),
	        	'transport'			=> 'postMessage',
				'sanitize_callback' => 'formationpro_sanitize_text',
	    	)
		);

		$wp_customize->add_setting( 'header_' . $list_featured_text_boxes[$row][0] . '_url', array(
	        	'default' 			=> __( 'Header Link', 'formationpro' ),
				'sanitize_callback' => 'formationpro_sanitize_url',
	    	) 
		);

		$wp_customize->add_setting( 'featured_textbox_text_' . $list_featured_text_boxes[$row][0], array(
				'default' 			=> __( 'Default featured text', 'formationpro' ),
				'transport'			=> 'postMessage',
				'sanitize_callback' => 'formationpro_sanitize_text',
			)
		);

	}

	$wp_customize->add_setting('homepage_recent_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_recent_title', array(
			'default'			=> __( 'Recent Posts', 'formationpro' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting('homepage_testimonials_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting('homepage_testimonials_title_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'testimonials_title', array(
			'default'			=> __( 'Customer Testimonial', 'formationpro' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_text',
	));

	$wp_customize->add_setting( 'testimonials_id', array(
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting('homepage_partners_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_partners_title', array(
			'default'			=> __( 'Partners', 'formationpro' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_setting( 'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload', array(
			'sanitize_callback' => 'formationpro_sanitize_url',
		));

		$wp_customize->add_setting( 'logo_' . $list_partners_text_boxes[$row][0] . '_url', array(
	        'default' 			=> __( 'Link', 'formationpro' ),
			'sanitize_callback' => 'formationpro_sanitize_url',
	    ));

	}

	$wp_customize->add_setting( 'copyright_text', array(
			'default'			=> __( '', 'formationpro' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting('hide_copyright', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting('hide_footer_widgets', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'authors_ids', array(
			'sanitize_callback' => 'formationpro_sanitize_text',
		)
	);

	$wp_customize->add_setting('authors_hide_content', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));

	$wp_customize->add_setting('authors_content_below', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'formationpro_sanitize_checkbox',
	));
 
	/* 
	* //////////////////// Controls ////////////////////////////
	*/

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'formationpro_global_favicon',
			array(
				'label'      	=> __('Upload Favicon', 'formationpro'),
				'section'    	=> 'formationpro_favicons',
				'settings'   	=> 'formationpro_global_favicon',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'formationpro_global_apple_icon',
			array(
				'label'      	=> __('Upload Apple App Icon', 'formationpro'),
				'section'    	=> 'formationpro_favicons',
				'settings'   	=> 'formationpro_global_apple_icon',
				'priority'	 	=> $priority++,
			)
		)
	);

	foreach ($list_contact_options as $key => $value){

		$wp_customize->add_control( $key . '_textbox_header_one', array(
				'label'			=> $value,
				'section' 		=> 'telnumber_section_one',
			)
		);

	}

	foreach ($list_social_channels as $key => $value) {
		
		$wp_customize->add_control( $key, array(
			'label'   => $value,
			'section' => 'formationpro_social_section',
			'type'    => 'url',
		) );

	}

	$wp_customize->add_control( new WP_Customize_Image_Control( 
		$wp_customize, 'formationpro_logo', array(
				'label'    => __( 'Logo', 'formationpro' ),
				'section'  => 'formationpro_logo_section',
				'settings' => 'formationpro_logo',
			) 
		) 
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( 
		$wp_customize, 'formationpro_retina_logo', array(
				'label'    => __( 'Retina Logo', 'formationpro' ),
				'section'  => 'formationpro_logo_section',
				'settings' => 'formationpro_logo',
			) 
		) 
	);

	$wp_customize->add_control( 'formationpro_color_scheme', array(
		'label'   		=> __( 'Choose a color scheme', 'formationpro' ),
		'section' 		=> 'formationpro_color_scheme_settings',
		'type'       	=> 'radio',
		'choices'    	=> array(
			__( 'Black', 'formationpro' ) 		=> 'black',
			__( 'Red', 'formationpro' ) 		=> 'red',
			__( 'Blue', 'formationpro' ) 		=> 'blue',
			__( 'Green', 'formationpro' ) 		=> 'green',
			__( 'Orange', 'formationpro' ) 		=> 'orange',
			__( 'Pink', 'formationpro' ) 		=> 'pink',
		),
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'formationpro_custom_main_color_bool',
			array(
				'label'      	=> __('Override pre-built color schemes with color below.', 'formationpro'),
				'section'    	=> 'colors',
				'settings'   	=> 'formationpro_custom_main_color_bool',
				'priority'	 	=> $priority++,
				'type'		 	=> 'checkbox',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'formationpro_custom_main_color',
			array(
				'label'      => __('Main Color', 'formationpro'),
				'section'    => 'colors',
				'settings'   => 'formationpro_custom_main_color',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_slider_hide_control',
			array(
				'label'      => __('Hide Homepage Slider', 'formationpro'),
				'section'    => 'homepage_slider',
				'settings'   => 'homepage_slider_hide',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'homepage_slider_cat_control',
			array(
				'label'    		=> __('Select Featured Category', 'formationpro'),
				'section'  		=> 'homepage_slider',
				'settings'		=> 'homepage_slider_cat',
				'priority'	 	=> $priority++,
			)
		)
	);	

	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'homepage_slider_slide_no_control',
			array(
				'label'      => __('Amount of slides to display', 'formationpro'),
				'section'    => 'homepage_slider',
				'settings'   => 'homepage_slider_slide_no',
				'type'		 => 'number',
				'priority'	 => $priority++,
			)
		)
	);



	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'featured_hide_bar',
			array(
				'label'      	=> __('Hide Promotional Bar', 'formationpro'),
				'section'    	=> 'featured_section_top',
				'settings'   	=> 'homepage_promotional_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'featured_textbox', array(
		    'label'    		=> __( 'Featured Text Header', 'formationpro' ),
		    'section' 		=> 'featured_section_top',
		    'settings'  	=> 'featured_textbox',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'featured_button_txt_control', array(
		    'label'    	=> __( 'Change Button Text', 'formationpro' ),
		    'section' 	=> 'featured_section_top',
		    'settings'	=> 'featured_button_txt',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'featured_button_url', array(
			'label'    	=> __( 'Featured Button url', 'formationpro' ),
			'section' 	=> 'featured_section_top',
			'priority'	 	=> $priority++,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_services_section_control',
			array(
				'label'      	=> __('Hide Services Section', 'formationpro'),
				'section'    	=> 'service_section_settings',
				'settings'   	=> 'homepage_service_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_control( 
			new WP_Customize_Upload_Control(
		        $wp_customize,
		        'header-' . $list_featured_text_boxes[$row][0] . '-file-upload',
		        array(
		            'label' 	=> __( 'Header Image File Upload', 'formationpro' ),
		            'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
		            'settings' 	=> 'header-' . $list_featured_text_boxes[$row][0] . '-file-upload'
		        )
		    )
		);

		$wp_customize->add_control( 'featured_textbox_header_' . $list_featured_text_boxes[$row][0], array(
				'label' 	=> __( 'Featured Header Text', 'formationpro' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings'	=> 'featured_textbox_header_' . $list_featured_text_boxes[$row][0],
			)
		);

		$wp_customize->add_control( 'header_' . $list_featured_text_boxes[$row][0] . '_url', array(
				'label'    	=> __( 'Header url', 'formationpro' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings'	=> 'header_' . $list_featured_text_boxes[$row][0] . '_url',
			)
		);
		
		$wp_customize->add_control( 'featured_textbox_text_' . $list_featured_text_boxes[$row][0], array(
				'label' 	=> __( 'Featured text', 'formationpro' ),
				'section' 	=> 'featured_section_' . $list_featured_text_boxes[$row][0],
				'settings' 	=> 'featured_textbox_text_' . $list_featured_text_boxes[$row][0]
			)
		);

	}

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_recent_section_control',
			array(
				'label'      	=> __('Hide Recent Posts Section', 'formationpro'),
				'section'    	=> 'recent_posts_section_settings',
				'settings'   	=> 'homepage_recent_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'recent_section_title_control', array(
        'label'   		=> __('Change Title', 'formationpro'),
        'section' 		=> 'recent_posts_section_settings',
        'settings'   	=> 'homepage_recent_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_testimonials_section_control',
			array(
				'label'      	=> __('Hide Testimonials Section', 'formationpro'),
				'section'    	=> 'testimonials_section_settings',
				'settings'   	=> 'homepage_testimonials_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_testimonials_title_section_control',
			array(
				'label'      	=> __('Hide Testimonials Title', 'formationpro'),
				'section'    	=> 'testimonials_section_settings',
				'settings'   	=> 'homepage_testimonials_title_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'testimonials_title_control', array(
        'label'   		=> __('Change the Testimonial section title', 'formationpro'),
        'section' 		=> 'testimonials_section_settings',
        'settings'   	=> 'testimonials_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

	$wp_customize->add_control( 'testimonials_id_control', array(
        'label'   		=> __('Id of Testimonial you want to display', 'formationpro'),
        'section' 		=> 'testimonials_section_settings',
        'settings'   	=> 'testimonials_id',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_partners_section_control',
			array(
				'label'      	=> __('Hide Partners Section', 'formationpro'),
				'section'    	=> 'partners_section_settings',
				'settings'   	=> 'homepage_partners_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'partners_section_title_control', array(
        'label'   		=> __('Change Title', 'formationpro'),
        'section' 		=> 'partners_section_settings',
        'settings'   	=> 'homepage_partners_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );


    $arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_control(
		    new WP_Customize_Upload_Control(
		        $wp_customize,
		        'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload',
		        array(
		            'label' 		=> __( 'Client logo File Upload', 'formationpro' ),
		            'section' 		=> 'logo_section_' . $list_partners_text_boxes[$row][0],
		            'settings' 		=> 'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload',
		            'priority'	 	=> $priority++,
		        )
		    )
		);
		
		$wp_customize->add_control( 'logo_' . $list_partners_text_boxes[$row][0] . '_url', array(
				'label'    		=> __( 'Client logo url', 'formationpro' ),
				'section' 		=> 'logo_section_' . $list_partners_text_boxes[$row][0],
				'priority'	 	=> $priority++,
		));

	}

	$wp_customize->add_control( 'copyright_text_control', array(
        'label'   		=> __( "Change Copyright Text", 'formationpro'),
        'section' 		=> 'footer_settings',
        'settings'   	=> 'copyright_text',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_copyright_control',
			array(
				'label'      	=> __('Hide Copyright Bar', 'formationpro'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_copyright',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_footer_widgets_control',
			array(
				'label'      	=> __('Hide Footer Widgets', 'formationpro'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_footer_widgets',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'authors_ids_control', array(
        'label'   		=> __( "Add User Id's", 'formationpro'),
        'section' 		=> 'authors_template_settings',
        'settings'   	=> 'authors_ids',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'authors_hide_content_control',
			array(
				'label'      	=> __('Hide Page Content', 'formationpro'),
				'section'    	=> 'authors_template_settings',
				'settings'   	=> 'authors_hide_content',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'authors_content_below_control',
			array(
				'label'      	=> __('Display Content below User Profiles', 'formationpro'),
				'section'    	=> 'authors_template_settings',
				'settings'   	=> 'authors_content_below',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	/* 
	* //////////////////// Overrides ////////////////////////////
	*/

	$wp_customize->get_section( 'title_tagline' )->panel 			= 'formationpro_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority 		= 1;
	$wp_customize->get_section( 'header_image' )->panel 			= 'formationpro_header_panel';
	$wp_customize->get_section( 'header_image' )->priority 			= 4;
	$wp_customize->get_section( 'colors' )->panel 					= 'formationpro_header_panel';
	$wp_customize->get_section( 'colors' )->priority 				= 99;

	// Show instant changes for site title and description in the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport        		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 		= 'postMessage';

	// Remove Default settings
	$wp_customize->remove_section('background_image');

}
add_action( 'customize_register', 'formationpro_register_theme_customizer' );


/**
 *  ////////////// SANITIZATION //////////////////////
 */

// Sanitize Text
function formationpro_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize Textarea
function formationpro_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
// Sanitize Checkbox
function formationpro_sanitize_checkbox( $input ) {
	if( $input ):
		$output = '1';
	else:
		$output = false;
	endif;
	return $output;
}
// Sanitize Numbers
function formationpro_sanitize_integer( $input ) {
	$value = (int) $input; // Force the value into integer type.
    return ( 0 < $input ) ? $input : null;
}
function formationpro_sanitize_float( $input ) {
	return floatval( $input );
}

// Sanitize Uploads
function formationpro_sanitize_url($input){
	return esc_url_raw($input);	
}

// Sanitize Colors
function formationpro_sanitize_color($input){
	return maybe_hash_hex_color($input);
}