<?php
/*
 * Template Name: Grid sidebar
 * Description: Grid with right sidebar
*/

get_header(); ?>

	<header class="entry-header">
		<h1 class="page-title"><?php the_title(); ?><span class="breadcrumbs"><?php if (function_exists('formationpro_breadcrumbs')) formationpro_breadcrumbs(); ?></span></h1>
	</header><!-- .entry-header -->
  	<div id="primary_wrap">
		<div id="primary-left" class="content-area">
			<div id="content-right" class="site-content" role="main">

	 <?php 
	 	global $section_pages;
	 	$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			'hierarchical' => 0,
			'child_of' => $wp_query->post->ID,
			'parent' => $page_id,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$section_pages = get_pages($args);
		
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('showposts=6' . '&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <div class="gridblock">
	 <div class="hentry">
    <div class="blog-image">
				<?php
			if ( has_post_thumbnail() ) {
    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'recent' );
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

		
		<?php edit_post_link( __( 'Edit', 'formationpro' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<div class="entry-content">
        <?php
global $more;
$more = 0;
?>
		<?php the_excerpt(); ?><div class="grid-more-link"><a href="<?php the_permalink() ?>"> <?php echo __('Read More', 'formationpro'); ?></a></div>
        
	</div><!-- .entry-content -->
   		</div><!-- .hentry -->
        </div>
		
	<?php endwhile; ?>
    <?php formationpro_content_nav( 'nav-below' ); ?>
 <?php $wp_query = $temp;?>
	</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
	<aside id="sidebar-right">
	 <?php if ( is_active_sidebar( 'sidebar-right' ) && dynamic_sidebar('sidebar-right') ) : else : ?>
			<?php echo '<h4>' . __('Widget Ready', 'formationpro') . '</h4>'; ?>
            <?php echo '<p>' . __('This right column is widget ready! Add one in the admin panel.', 'formationpro') . '</p>'; ?>     
	<?php endif; ?>  
	</aside>

	</div><!-- #primary wrap -->
<?php //get_footer(); ?>