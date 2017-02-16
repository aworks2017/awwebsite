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
							<a href="http://clients.autonomyworks.net/menu/" title="Centro" rel="home"><img src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/11/centro-logo.png" alt="Centro" style="height:30px"></a>
						</div>

					<nav role="navigation" class="site-navigation main-navigation">

                        <div style="max-width:1160px;float: right;line-height: 100px;">
                			<span style="float:right;margin-right: 15px;">
                            
                            </span>
                            <?php if($post->post_name!='centro'):?>
                            <span style="float:right;margin-right: 15px;">
                            <a href="http://clients.autonomyworks.net/menu/" style="font-weight: bold;">Main Menu</a>
                            </span>
                            <?php endif;?>
                    	</div>

					</nav><!-- .site-navigation .main-navigation -->

				</header><!-- #masthead .site-header -->

			</div><!-- #masthead-wrap -->
			<hr/>
			<div id="main" class="site-main">
<header class="entry-header">
	<h1 class="page-title" style="padding: 0px;">Requesting Screenshots</h1>
</header>			