<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function formationpro_customizer_css() {

?>

	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/<?php echo esc_attr(strtolower( get_theme_mod( 'formationpro_color_scheme', 'red' ) ) ); ?>.css" type="text/css" media="screen">

<?php 

	if( get_theme_mod('formationpro_custom_main_color_bool') ){

	?>

		<style>	
			.main-navigation li:hover > a,
			.main-navigation li.current_page_item a,
			.main-navigation li.current-menu-item a,
			.main-navigation li.current_page_ancestor a,
			.main-navigation > li > a, 
			.main-small-navigation li:hover > a,
			.main-small-navigation li.current_page_item a,
			.main-small-navigation li.current-menu-item a,
			.main-small-navigation ul ul a:hover,
			.entry-meta a,
			.socialIcons a,
			.social-media a:hover, 
			.socialIcons a:visited,
			.authorLinks a,
			.entry-content a, 
			.entry-content a:visited, 
			.entry-summary a, 
			.entry-summary a:visited {

				color: <?php echo get_theme_mod('formationpro_custom_main_color'); ?>;

			}

			.main-navigation li:hover > a,
			.main-navigation li.current_page_item a,
			.main-navigation li.current-menu-item a,
			.main-navigation > li > a,
			.main-navigation li.current_page_ancestor > a,
			.main-navigation ul ul,
			.widget-title,
			.featuretext_middle,
			.tagcloud a {

				border-color: <?php echo get_theme_mod('formationpro_custom_main_color'); ?>;

			}

			.flex-caption-title,
			.thumbs-more-link a,
			.more-link,
			.grid-more-link,
			#smoothup:hover,
			.reply,
			.featuretext_button a,
			.tagcloud a:hover { 

				background-color: <?php echo get_theme_mod('formationpro_custom_main_color'); ?>;

			}
			.grid-more-link a{
				color: #fff!important;
			}

		</style>
		
	<?php

	}
}
add_action( 'wp_head', 'formationpro_customizer_css' ); 