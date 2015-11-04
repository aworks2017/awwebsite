<?php

/*
 * Template Name: Clients
 * Description: Client page template.
 *
 * @package formationpro
 * @since formationpro 1.0
 */



get_header(); ?>

		<header class="entry-header">
		<h1 class="page-title"><?php the_title(); ?><span class="breadcrumbs"><?php if (function_exists('formationpro_breadcrumbs')) formationpro_breadcrumbs(); ?></span></h1>
		</header><!-- .entry-header -->

		<div id="primary_home" class="content-area">

			<div id="content" class="fullwidth" role="main">



				<?php while ( have_posts() ) : the_post(); ?>



					<?php get_template_part( 'content', 'page' ); ?>



					<?php comments_template( '', true ); ?>



				<?php endwhile; // end of the loop. ?>


			<?php
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				if($feat_image) :
			?>
            <div style="width:100%; text-align:center">
            	<img src="<?php echo $feat_image?>" width="85%"/>
            </div>
            <?php endif;?>
            
			<div style="width: 100%;text-align: center;margin: 50px auto;"><a href="portal" style="background-color: #343234;color: white;padding: 14px 30px;border-radius: 10px;cursor: pointer;">Client Login</a></div>
			</div><!-- #content .site-content -->

		</div><!-- #primary .content-area -->



<?php get_footer(); ?>