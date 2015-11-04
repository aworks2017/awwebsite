<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package formationpro
 * @since formationpro 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<?php if(get_theme_mod('formationpro_global_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('formationpro_global_favicon')); ?>" />
<?php endif; ?>

<?php if(get_theme_mod('formationpro_global_apple_icon')) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('formationpro_global_apple_icon')); ?>">
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrap">
		<div id="page" class="hfeed site">

			<?php do_action( 'before' ); ?>

		    <div id="masthead-wrap">

			    <div id="topbar_container" style="min-height: 30px">
                	<div style="max-width:1160px;margin:0 auto;">
                		<a href="<?php echo wp_logout_url( '/clients' ) ?>" style="float: right;color: white;margin-right: 20px;font-weight: bold;">LOGOUT</a>
                    </div>
                </div>

				<header id="masthead" class="site-header header_container" role="banner">

						<div class="centro-site-logo" style="float: left;display: block;margin: 30px 0 0 30px;">
							<a href="/clients/portal/centro" title="Centro" rel="home"><img src="http://dev2.autonomyworks.net/wp-content/uploads/2015/11/centro-logo.png" alt="Centro" style="height:30px"></a>
						</div>
                        
					<nav role="navigation" class="site-navigation main-navigation">

						<h1 class="assistive-text"><a href="#" title="<?php _e('Navigation Toggle', 'formationpro'); ?>"><?php _e( 'Menu', 'formationpro' ); ?></a></h1>

						<div class="assistive-text skip-link">
							<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'formationpro' ); ?>"><?php _e( 'Skip to content', 'formationpro' ); ?></a>
						</div>

						<?php wp_nav_menu( array( 'menu'=>'centro' ) ); ?>
                        
					</nav><!-- .site-navigation .main-navigation -->

				</header><!-- #masthead .site-header -->

			</div><!-- #masthead-wrap -->
			<hr/>
			<div id="main" class="site-main">