<?php

/*
 * Template Name: Blog Left Sidebar
 * Description: Blog with Left Sidebar
*/

get_header(); ?>

	<header class="entry-header">
		<h1 class="page-title"><?php the_title(); ?><span class="breadcrumbs"><?php if (function_exists('formationpro_breadcrumbs')) formationpro_breadcrumbs(); ?></span></h1>
		</header><!-- .entry-header -->
		<div id="primary_wrap">
		<div id="primary-right" class="content-area">
			<div id="content-right" class="site-content" role="main">

	 <?php 
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	 <div class="hentry">
    <div class="blog-image">
				<?php
			if ( has_post_thumbnail() ) {
    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'featured' );
     echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
}
  			?>
    </div>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <div class="entry-meta">
			<?php formationpro_posted_on(); ?>
         <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'formationpro' ) );
				if ( $categories_list && formationpro_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'formationpro' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'formationpro' ) );
				if ( $tags_list ) :
			?>
			
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'formationpro' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'formationpro' ), __( '1 Comment', 'formationpro' ), __( '% Comments', 'formationpro' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'formationpro' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<div class="entry-content">
        <?php
global $more;
$more = 0;
?>
		<?php the_content( __( 'Read More', 'formationpro' ) ); ?>
	</div><!-- .entry-content -->
   		</div><!-- .hentry -->
		
	<?php endwhile; ?>
    <?php formationpro_content_nav( 'nav-below' ); ?>
 
	</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
        <aside id="sidebar-left">
	 <?php if ( is_active_sidebar( 'sidebar-3' ) && dynamic_sidebar('sidebar-3') ) : else : ?>
			<?php echo '<h4>' . __('Widget Ready', 'formationpro') . '</h4>'; ?>
            <?php echo '<p>' . __('This left column is widget ready! Add one in the admin panel.', 'formationpro') . '</p>'; ?>     
	<?php endif; ?>  
</aside>


	</div><!-- #primary wrap -->
<?php get_footer(); ?>