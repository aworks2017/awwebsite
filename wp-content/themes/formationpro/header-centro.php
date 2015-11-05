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
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="viewport" content="width=1000">
<meta name="MobileOptimized" content="1000">


<?php if(get_theme_mod('formationpro_global_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('formationpro_global_favicon')); ?>" />
<?php endif; ?>

<?php if(get_theme_mod('formationpro_global_apple_icon')) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('formationpro_global_apple_icon')); ?>">
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />



<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">
		<div id="page" class="hfeed site">

			<?php do_action( 'before' ); ?>

		    <div id="masthead-wrap">

			    <div id="topbar_container" style="min-height: 30px"></div>

				<header id="masthead" class="site-header header_container" role="banner">

						<div class="centro-site-logo" style="float: left;display: block;margin: 30px 0 0 30px;">
							<a href="/clients/portal/centro" title="Centro" rel="home"><img src="http://dev2.autonomyworks.net/wp-content/uploads/2015/11/centro-logo.png" alt="Centro" style="height:30px"></a>
						</div>
                        
					<nav role="navigation" class="site-navigation main-navigation">

                        <div style="max-width:1160px;float: right;line-height: 100px;">
                			<a href="<?php echo wp_logout_url( '/clients' ) ?>" style="margin-right: 15px;font-weight: bold;">LOGOUT</a>
                    	</div>
                        
					</nav><!-- .site-navigation .main-navigation -->

				</header><!-- #masthead .site-header -->

			</div><!-- #masthead-wrap -->
			<hr/>
			<div id="main" class="site-main">