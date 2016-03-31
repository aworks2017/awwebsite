<?php
/**
 * formationpro functions and definitions
 *
 * @package formationpro
 * @since formationpro 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since formationpro 1.0
 */
 
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'formationpro_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since formationpro 1.0
 */
function formationpro_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Code for setting up Custom Post type - Testimonials
	 */
	require( get_template_directory() . '/inc/testimonial-setup.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on formationpro, use a find and replace
	 * to change 'formationpro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'formationpro', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'formationpro' ),
	) );
	
	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size( 100, 300, true);
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'recent', 700, 400, true );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	// Display Title in theme
	add_theme_support( 'title-tag' );

	// Add background support
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	// link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans' );
	add_editor_style( array('style.css', 'css/editor-style.css', $font_url) );

}
endif; // formationpro_setup
add_action( 'after_setup_theme', 'formationpro_setup' );

/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */
function prefix_theme_updater() {
	require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'prefix_theme_updater' );




/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since formationpro 1.0
 */
function formationpro_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'formationpro' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'formationpro' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Left Sidebar', 'formationpro' ),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'formationpro' ),
		'id' => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar(array(
			'name' => 'Left Footer Column',
			'id'   => 'left_column',
			'description'   => 'Widget area for footer left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Center  Footer Column',
			'id'   => 'center_column',
			'description'   => 'Widget area for footer center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Footer Column',
			'id'   => 'right_column',
			'description'   => 'Widget area for footer right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'bottom Footer',
			'id'   => 'bottom_footer',
			'description'   => 'Widget area for Bottom footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', 'formationpro_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function formationpro_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri(), '', '2.0.2' );

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', '2.0');

	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.min.css', '', '2.0');

    wp_enqueue_style('flexslider', get_template_directory_uri().'/js/flexslider.css', '', '2.0');


	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '2.0', false );
	
	wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '2.0' );
	
	wp_enqueue_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );

	wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/Inview.js', array('jquery'));
	
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/animate.js', array('jquery', 'inview'));
	    
	wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'));
    
    wp_enqueue_script('flexslider-init', get_template_directory_uri().'/js/flexslider-init.js', array('jquery', 'flexslider'));
	
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '',  true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

	if ( is_singular() && wp_attachment_is_image() ) {

		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	
	}

}
add_action( 'wp_enqueue_scripts', 'formationpro_scripts' );


/**
 * Implement excerpt for homepage slider
 */
function get_slider_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 150);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

/**
 * Implement excerpt for homepage recent posts
 */
function formationpro_get_recentposts_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 250);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}


// Theme Options
include('functions/customizer_controller.php');
include('functions/customizer_settings.php');
include('functions/customizer_styles.php');


/**
 * Implement excerpt for homepage thumbnails
 */
function content($limit) {

  $content = explode(' ', get_the_content(), $limit);

  if (count($content)>=$limit) {

    array_pop($content);

    $content = implode(" ",$content).'...';

  } else {

    $content = implode(" ",$content);
  }	

  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  
  return $content;

}


/*
 * //////// Custom CSS //////////////
 */

function custom_css_scripts( $hook ) {
    if ( 'appearance_page_custom_css_admin_page_content' == $hook ) {
        wp_enqueue_script( 'ace_code_highlighter_js', get_template_directory_uri() . '/ace/ace.js', '', '1.0.0', true );
        wp_enqueue_script( 'ace_mode_js', get_template_directory_uri() . '/ace/mode-css.js', array( 'ace_code_highlighter_js' ), '1.0.0', true );
        wp_enqueue_script( 'custom_css_js', get_template_directory_uri() . '/custom-css.js', array( 'jquery', 'ace_code_highlighter_js' ), '1.0.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'custom_css_scripts' );

function register_custom_css_setting() {
    register_setting( 'custom_css', 'custom_css',  'custom_css_validation');
}
add_action( 'admin_init', 'register_custom_css_setting' );
 
function custom_css_admin_page() {
    add_theme_page( 'Custom CSS',  __( 'Custom CSS', 'formationpro' ), 'edit_theme_options', 'custom_css_admin_page_content', 'custom_css_admin_page_content' );
}
add_action( 'admin_menu', 'custom_css_admin_page' );

function custom_css_admin_page_content() {
    // The default message that will appear
    $custom_css_default = __( '/*
Welcome to the Custom CSS editor!
 
Please add all your custom CSS here and avoid modifying the core theme files, since that\'ll make upgrading the theme problematic. Your custom CSS will be loaded after the theme\'s stylesheets, which means that your rules will take precedence. Just add your CSS here for what you want to change, you don\'t need to copy all the theme\'s style.css content.
*/' );
    $custom_css = get_option( 'custom_css', $custom_css_default );
    ?>
	    <div class="wrap">
	        <div id="icon-themes" class="icon32"></div>
	        <h2><?php _e( 'Custom CSS', 'formationpro' ); ?></h2>
	        <?php if ( ! empty( $_GET['settings-updated'] ) ) echo '<div id="message" class="updated"><p><strong>' . __( 'Custom CSS updated.', 'formationpro' ) . '</strong></p></div>'; ?>
	 
	        <form id="custom_css_form" method="post" action="options.php" style="margin-top: 15px;">
	 
	            <?php settings_fields( 'custom_css' ); ?>
	 
	            <div id="custom_css_container">
	                <div name="custom_css" id="custom_css" style="border: 1px solid #DFDFDF; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; width: 100%; height: 400px; position: relative;"></div>
	            </div>
	 
	            <textarea id="custom_css_textarea" name="custom_css" style="display: none;"><?php echo $custom_css; ?></textarea>
	            <p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'formationpro' ) ?>" /></p>
	        </form>
	    </div>
	<?php
}

function custom_css_validation( $input ) {
    if ( ! empty( $input['custom_css'] ) )
        $input['custom_css'] = trim( $input['custom_css'] );
    return $input;
}

function display_custom_css() {
  $custom_css = get_option( 'custom_css' );
  if ( ! empty( $custom_css ) ) 
       { 
         echo "<style type='text/css'>";
         echo '/* Custom CSS */' . "\n";
         echo $custom_css . "\n";
         echo "</style>";
       }
}
add_action( 'wp_head', 'display_custom_css' );

/**
 * Breadcrumbs
 *
 * This functions displays page breadcrumbs
 */
function formationpro_breadcrumbs() {
 
	/* === OPTIONS === */
	$text['home']     = __('Home','formationpro'); // text for the 'Home' link
	$text['category'] = __('Archive by Category "%s"','formationpro'); // text for a category page
	$text['search']   = __('Search Results for "%s" Query','Formation'); // text for a search results page
	$text['tag']      = __('Posts Tagged "%s"','formationpro'); // text for a tag page
	$text['author']   = __('Articles Posted by %s','formationpro'); // text for an author page
	$text['404']      = __('Error 404','formationpro'); // text for the 404 page
 
	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' / '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
 
	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');
 
	if (is_home() || is_front_page()) {
 
		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
 
	} else {
 
		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}
 
		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 
		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
 
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
 
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
 
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
 
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}
 
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
 
		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
 
		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;
 
		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}
 
		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}
 
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page', 'formationpro') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
 
		echo '</div><!-- .breadcrumbs -->';
 
	}
} // end formationpro_breadcrumbs()


/**
 * Social Media Links on Contributors template
 */
function author_social_media( $socialmedialinks ) {

	$socialmedialinks['alternate_image']	= __('Alternate Profile Image Url', 'formationpro');
    $socialmedialinks['google_profile'] 	= 'Google+ URL';
    $socialmedialinks['twitter_profile'] 	= 'Twitter URL';
    $socialmedialinks['facebook_profile'] 	= 'Facebook URL';
    $socialmedialinks['linkedin_profile'] 	= 'Linkedin URL';

 	return $socialmedialinks;

}
add_filter( 'user_contactmethods', 'author_social_media', 10, 1);

/**
 * Custom "more" link format
 */
function new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



// Changing the Fonts of Your Theme
// thanks to tutorial by Fouad Matin
// http://wp.tutsplus.com/tutorials/changing-the-fonts-of-your-wordpress-site-part-2-theme-integration/
add_action( 'admin_menu', 'formationpro_fonts' );
function formationpro_fonts() {
    add_theme_page( 'Fonts', 'Fonts', 'edit_theme_options', 'fonts', 'fonts' );
}
function fonts() {
?>
    <div class="wrap">
        <div><br></div>
        <h2>Fonts</h2>
 
        <form method="post" action="options.php">
            <?php wp_nonce_field( 'update-fonts' ); ?>
            <?php settings_fields( 'fonts' ); ?>
            <?php do_settings_sections( 'fonts' ); ?>
            <?php submit_button(); ?>
            </form>
        <img style="float:right; border:0;" src="http://i.imgur.com/1qqJG.png" />
    </div>
<?php
}
 
add_action( 'admin_init', 'formationpro_register_admin_settings' );
function formationpro_register_admin_settings() {
    register_setting( 'fonts', 'fonts' );
    add_settings_section( 'font_section', 'Font Options', 'font_description', 'fonts' );
    add_settings_field( 'body-font', 'Body Font', 'body_font_field', 'fonts', 'font_section' );
    add_settings_field( 'h1-font', 'Header 1 Font', 'h1_font_field', 'fonts', 'font_section' );
    add_settings_field( 'nav-font', 'Main Nav Font', 'nav_font_field', 'fonts', 'font_section' );
}
function font_description() {
    echo __( 'Use the form below to change fonts of your theme.', 'formationpro' );
}
function get_fonts() {
    $fonts = array(
        'titillium' => array(
            'name' 		=> __( 'Titillium', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Titillium+Web:400,700);',
            'css' 		=> "font-family: Titillium Web, sans-serif;"
        ),
        'ubuntu' => array(
            'name' 		=> __( 'Ubuntu', 'formationpro' ),
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,700);',
            'css' 		=> "font-family: 'Ubuntu', sans-serif;"
        ),
        'lobster' => array(
            'name' 		=> __( 'Lobster', 'formationpro' ),
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Lobster:400,700);',
            'css' 		=> "font-family: 'Lobster', cursive;"
        ),
		'arial' => array(  
            'name' 		=> __( 'Arial', 'formationpro' ), 
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Lobster:400,700);',  
            'css' 		=> "font-family: Arial, sans-serif;"  
        ),
		'Carrois Gothic SC' => array(  
            'name' 		=> __( 'Carrois Gothis SC', 'formationpro' ),  
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic+SC);',  
            'css' 		=> "font-family: Carrois Gothic SC, sans-serif;"  
        ),  
        'Port Lligat Slab' => array(  
            'name' 		=> __( 'Port Lligat Slab', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Port+Lligat+Slab:400,700);',  
            'css' 		=> " font-family: 'Port Lligat Slab', serif;"  
        ),
		'Hammersmith One' => array(  
            'name' 		=> __( 'Hammersmith One', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Hammersmith+One);',  
            'css' 		=> " font-family: 'Hammersmith One', serif;"  
        ),
        'Roboto' => array(  
            'name' 		=> __( 'Roboto', 'formationpro' ),  
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Roboto:400,700);',  
            'css' 		=> "font-family: 'Roboto', sans-serif;"  
        ),
		'Open Sans' => array(  
            'name' 		=> __( 'Open Sans', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);',  
            'css' 		=> "font-family: 'Open Sans', sans-serif;"  
        ),
		'Source Sans Pro' => array(  
            'name' 		=> __( 'Source Sans Pro', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700);',  
            'css' 		=> "font-family: 'Source Sans Pro', sans-serif;"  
        ),
		'Montserrat' => array(  
            'name' 		=> __( 'Montserrat', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Montserrat:400,700);',  
            'css' 		=> "font-family: 'Montserrat', sans-serif;"  
        ),
		'Domine' => array(  
            'name' 		=> __( 'Domine', 'formationpro' ), 
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Domine:400,700);',  
            'css' 		=> "font-family: 'Domine', sans-serif;"  
        ),
		'Oswald' => array(  
            'name' 		=> __( 'Oswald', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Oswald:400,700);',  
            'css' 		=> "font-family: 'Oswald', sans-serif;"  
        ),
		'Rokkitt' => array(  
            'name' 		=> __( 'Rokkitt', 'formationpro' ), 
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Rokkitt:400,700);',  
            'css' 		=> "font-family: 'Rokkitt', sans-serif;"  
        ),
		'Rosario' => array(  
            'name' 		=> __( 'Rosario', 'formationpro' ),
            'font' 		=> '@import url(http://fonts.googleapis.com/css?family=Rosario:400,700);',  
            'css' 		=> "font-family: 'Rosario', sans-serif;"
      )             
    );
 
    return apply_filters( 'get_fonts', $fonts );
}
function body_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'Open Sans';
 
    if ( isset( $options['body-font'] ) )
        $current = $options['body-font'];
    ?>
        <select name="fonts[body-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}
function h1_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'Open Sans';
 
    if ( isset( $options['h1-font'] ) )
        $current = $options['h1-font'];
 
    ?>
        <select name="fonts[h1-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}
function nav_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'Open Sans';
 
    if ( isset( $options['nav-font'] ) )
        $current = $options['nav-font'];
 
    ?>
        <select name="fonts[nav-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}
 
add_action( 'wp_head', 'font_head' );
function font_head() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
	
    $body_key = 'Open Sans';
 
    if ( isset( $options['body-font'] ) )
        $body_key = $options['body-font'];
 
    if ( isset( $fonts[ $body_key ] ) ) {
        $body_font = $fonts[ $body_key ];
 
        echo '<style>';
        echo $body_font['font'];
        echo 'body  { ' . $body_font['css'] . ' } ';
        echo '</style>';
    }
 
    $h1_key = 'Open Sans';
 
    if ( isset( $options['h1-font'] ) )
        $h1_key = $options['h1-font'];
 
    if ( isset( $fonts[ $h1_key ] ) ) {
        $h1_key = $fonts[ $h1_key ];
 
        echo '<style>';
        echo $h1_key['font'];
        echo 'h1  { ' . $h1_key['css'] . ' } ';
        echo '</style>';
    }

    $nav_key = 'Open Sans';
 
    if ( isset( $options['nav-font'] ) )
        $nav_key = $options['nav-font'];
 
    if ( isset( $fonts[ $nav_key ] ) ) {
        $nav_key = $fonts[ $nav_key ];
 
        echo '<style>';
        echo $nav_key['font'];
        echo '.main-navigation  { ' . $nav_key['css'] . ' } ';
        echo '</style>';
    }
}

/**
 * Implement the Custom Header feature
 */
add_theme_support( 'custom-header' );
function formationpro_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '222',
		'width'                  => 2000,
		'height'                 => 500,
		'flex-height'            => true,
		'wp-head-callback'       => 'formationpro_header_style',
		'admin-head-callback'    => 'formationpro_admin_header_style',
		'admin-preview-callback' => 'formationpro_admin_header_image',
	);

	$args = apply_filters( 'formationpro_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	}
}
add_action( 'after_setup_theme', 'formationpro_custom_header_setup' );

if ( ! function_exists( 'formationpro_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see formationpro_custom_header_setup().
 *
 * @since formationpro 1.0
 */
function formationpro_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		.site-header img {
			display: block;
			margin: 0.5em auto 0;
		}
	<?php endif;

		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		.site-header hgroup {
			background: none;
			padding: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // formationpro_header_style

if ( ! function_exists( 'formationpro_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see formationpro_custom_header_setup().
 *
 * @since formationpro 1.0
 */
function formationpro_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		background: #FFF;
		border: none;
		min-height: 200px;
	}
	#headimg h1 {
		font-size: 20px;
		font-family: 'open_sansbold', sans-serif;
		font-weight: normal;
		padding: 0.8em 0.5em 0;
	}
	#desc {
		padding: 0 2em 2em;
	}
	#headimg h1 a,
	#desc {
		color: #222;
		text-decoration: none;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // formationpro_admin_header_style

if ( ! function_exists( 'formationpro_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see formationpro_custom_header_setup().
 *
 * @since formationpro 1.0
 */
function formationpro_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // formationpro_admin_header_image


/* momo custom code start */
//adding header search form
add_filter( 'wp_nav_menu_items', function($items,$arg){	
	if($arg->theme_location!='primary') return $items;
	$search_form_content = '<!-- search form -->
                        <li><form method="get" id="header_searchform" action="/" role="search">
                            <input type="text" class="field" name="s" value="" class="s" placeholder="Search …">
                        </form></li><li id="submit_header_search" class="fa fa-search"></li>
                        <!-- end search form -->';
	return $items.$search_form_content;
	
}, 1, 2 );


/************************
							Centro functions
											*********************/
											
function aw_centro_status() {

    global $wpdb;

    $sql = "SELECT requestor, week(curdate( )) as this_week, count(*) as total
		FROM ".$wpdb->prefix."centro
		WHERE date_entered >= DATE_SUB( CURDATE( ) , INTERVAL 6 WEEK )
		group BY requestor, week(CURDATE( ))";
    $results = $wpdb->get_results($sql) or die(mysql_error());

    $status = "";
    $i=0;

    foreach( $results as $result ) {

	$wk1 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", $result->this_week, $result->requestor));

	$wk2 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", ($result->this_week - 1), $result->requestor));

	$wk3 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", ($result->this_week - 2), $result->requestor));

	$wk4 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", ($result->this_week - 3), $result->requestor));

	$wk5 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", ($result->this_week - 4), $result->requestor));

	$wk6 = $wpdb->get_row($wpdb->prepare("SELECT count(*) as total FROM ".$wpdb->prefix."centro WHERE week(date_entered) = %d and requestor = %s", ($result->this_week - 5), $result->requestor));
    	
		$status .= '<tr class="d'.($i%2).'"><td class="td0">' .$result->requestor. '</td><td><center>' .$result->total. '</center></td><td><center>' .$wk1->total. '</center></td><td><center>' .$wk2->total . '</center></td><td><center>' .$wk3->total . '</center></td><td><center>' .$wk4->total . '</center></td><td><center>' .$wk5->total . '</center></td><td><center>' .$wk6->total . '</center></td></tr>';

		$i += 1;
	

    }

    return $status;
}

add_shortcode('aw_centro_status_sc', 'aw_centro_status');


function aw_centro_history() {

    global $wpdb;

    $sql = "SELECT DATE_ADD(date_entered, INTERVAL 2 HOUR) as date_entered, campaign_id, report_type, notes, requestor
		FROM ".$wpdb->prefix."centro
		WHERE date_entered >= DATE_SUB( CURDATE( ) , INTERVAL 8 DAY )
		ORDER BY requestor, campaign_id, date_entered";
    $results = $wpdb->get_results($sql) or die(mysql_error());

    $history = "";
    $i=0;

    foreach( $results as $result ) {

	$history .= '<tr class="d'.($i%2).'"><td class="td0">' .$result->requestor. '</td><td class="td0">' .$result->campaign_id. '</td><td><center>' .$result->report_type . '</center></td><td><center>' .$result->notes . '</center></td><td><center>' .$result->date_entered . '</center></td></tr>';

	$i += 1;
    }

    return $history;
}

add_shortcode('aw_centro_history_sc', 'aw_centro_history');



//centro form submit by momo
add_action( 'wp_ajax_centro_form_submit', 'centro_form_submit' );

function centro_form_submit() {

    global $wpdb;

    $i = 1;
	do {

		//need to limit strings here based on database field lengths
		$campaign = sanitize_text_field($_POST["campaign$i"]);
		$requestor = sanitize_email($_POST["requestor$i"]);
		$note = sanitize_text_field($_POST["note$i"]);

		$reports = array('launch', 'pacing', 'final');
		$report = $reports[$_POST["report$i"]];

		if (!empty($campaign)) {


$wpdb->insert(
	$wpdb->prefix.'centro',
	array(
		'campaign_id' => $campaign,
		'report_type' => $report,
		'requestor' => $requestor,
		'notes' => $note
	),
	array(
		'%s',
		'%s',
		'%s',
		'%s'
	)
);



		}

		$i += 1;

	} while ($i <= 20);

	die(1);
}



function login_form_submit() {

        global $email;
        $email      =   strtolower(sanitize_email( $_POST['login_email'] ));
        $exists = email_exists($email);

	if ( !$exists ) {

	   if (substr($email, -11) !== "@centro.net") {
	      wp_redirect( get_site_url() . '/invalid-login');
	      exit;
	   }

	   $user_id = wp_create_user($email, 'aw2015', $email);
	   
	   //do not show Wordpress toolbar to logged in users
	   update_user_meta($user_id, 'show_admin_bar_front', false);    

   	} else {
	   $user_id = $exists;
	}

   
	//log user in
	$user = get_user_by( 'id', $user_id );
	if( $user ) {
    	    wp_set_current_user( $user_id, $user->user_login );
	    wp_set_auth_cookie( $user_id );
	    do_action( 'wp_login', $user->user_login );
	}
	


	wp_safe_redirect( get_site_url() . '/menu');
	exit;

}


add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}


function login_redirect( $redirect_to, $request, $user ){
    return home_url('menu');
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );


function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Centro Client Portal';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// Custom shortcode by momo
add_shortcode('start_task_button', 'start_task_button');
function start_task_button($atts, $content ){
	$ip = $_SERVER['REMOTE_ADDR'];
	$workflow_ip = get_option('workflow_ip','1');
	$restrict_workflow_ip = get_option('restrict_workflow_ip',false);
	$return = '';
	if($restrict_workflow_ip=='0') {
		//$return .="Your IP : $ip <br> Allowed ip : $workflow_ip <br>";
	}
	if(($workflow_ip and $ip and $ip == $workflow_ip) or $restrict_workflow_ip=='0') {
		$return .='<div id="start-Task" class="grey_btn">Start Task</div>';
	}
	return $return;
}
add_shortcode('portal_login_button', 'portal_login_button');
function portal_login_button($atts, $content = "Client Login" ){
	if(isset($atts['link'])) $link = $atts['link']; else $link = '/clients/portal';
	if(isset($atts['src'])) $link .= '?src='.$atts['src'];
	return '<a href="'.$link.'" ><div class="portal_login_button grey_btn">'.$content.'</div></a>';
}


//workflow functions by momo
add_action( 'wp_ajax_get_workflow', 'get_workflow' );
add_action( 'wp_ajax_on_call', 'on_call' );
add_action( 'wp_ajax_get_job', 'get_job' );
add_action( 'wp_ajax_end_job', 'end_job' );
add_action( 'wp_ajax_update_count', 'update_count' );

function get_workflow() {
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->user_login ;
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=get_task&key=".$api_key."&user=".$user;
	$response =   wp_remote_get( $url );
	if(is_wp_error($response)) echo '0';
	else echo $response['body'];
	wp_die();
}

function on_call() {
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->user_login ;
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=on_call&key=".$api_key."&user=".$user;
	$response =   wp_remote_get( $url );
	if(is_wp_error($response)) echo '0';
	else echo $response['body'];
	wp_die();
}

function get_job() {
	$jobid = htmlspecialchars(str_replace('\"', "", $_POST['jobId']));
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=start&key=".$api_key."&job=".$jobid;
	echo $url;
	$response =   wp_remote_get( $url );
	$data = json_decode($response['body'],true);
	if(isset($data['estimated_start'])) {
		$datetime = new DateTime($data['estimated_start']);
		$la_time = new DateTimeZone('America/Chicago');
		$datetime->setTimezone($la_time);
		$data['estimated_start'] = $datetime->format('Y-m-d h:i A');
	}
	if(isset($data['estimated_finish'])) {
		$datetime = new DateTime($data['estimated_finish']);
		$la_time = new DateTimeZone('America/Chicago');
		$datetime->setTimezone($la_time);
		$data['estimated_finish'] = $datetime->format('Y-m-d h:i A');
	}
	if(is_wp_error($response)) echo '0';
	else echo json_encode($data);
	wp_die();
}

function end_job() {
	$jobid = htmlspecialchars($_POST['jobId']);
	$action_stop = urlencode($_POST['action_stop']);
	$action_info = urlencode($_POST['action_info']);
	$action_stopping_point = urlencode($_POST['action_stopping_point']);
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=stop&key=".$api_key."&job=".$jobid."&action_stop=".$action_stop."&action_info=".$action_info ."&action_stopping_point=".$action_stopping_point;
	$response =   wp_remote_get( $url );
	if(is_wp_error($response)) echo '0';
	else echo $response['body'];
	wp_die();
}

function update_count() {
	$jobid = htmlspecialchars($_POST['jobId']);
	$new_count = (int)($_POST['new_count']);
	$api_server = get_option('api_server');
	$api_key = get_option('api_key');
	$url = "http://".$api_server.".autonomyworks.net/WorkFlowPortal.php?action=update&key=".$api_key."&job=".$jobid."&new_count=".$new_count ;
	$response =   wp_remote_get( $url );
	if(is_wp_error($response)) echo '0';
	else echo $response['body'];
	wp_die();
}

/*add_action( 'init', 'change_pass' );
function change_pass(){
	if(isset($_POST['pass'])){
		global $wpc_client;
		$ID = $wpc_client->current_plugin_page['client_id'] ;
		 echo ' id : '.$ID ;
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
				$res = $wpc_client->cc_client_update_func( $userdata );
				ob_clean ();
				if($res){
					die($res);
				} else die('0');
			}
		} else { die('0'); }
	}
	 
}*/