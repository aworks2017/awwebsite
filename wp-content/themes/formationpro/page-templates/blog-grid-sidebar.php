<?php
/*
 * Template Name: Grid sidebar
 * Description: Grid with right sidebar
*/

get_header(); ?>
<?php 
global $section_page,$section_pages; 
$section_page = $wp_query->post ;
?>
<header class="entry-header">
	<h1 class="page-title"><?php echo $section_page->post_title ?><span class="breadcrumbs"><?php if (function_exists('formationpro_breadcrumbs')) formationpro_breadcrumbs(); ?></span>
    </h1>
</header><!-- .entry-header -->

<div id="primary_wrap">
	<div id="primary-left" class="content-area">
		<div id="content-right" class="site-content" role="main">
        <article class="page type-page hentry">
        	<?php echo $wp_query->post->post_content?>
        </article>
		<?php 
	 	$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			'hierarchical' => 0,
			'child_of' => $wp_query->post->ID,
			'parent' => $wp_query->post->ID,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$section_pages = get_pages($args);
		
		foreach($section_pages as $page) : ?>
        <div class="gridblock">
	 		<div class="hentry">
    			<div class="blog-image">
				<?php
				if ( has_post_thumbnail($page->ID) ) {
    				$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID),'recent' );
     				echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
}
  				?>
    			</div>
            	<h1 class="entry-title"><a href="<?php echo get_permalink($page->ID); ?>"><?php echo $page->post_title; ?></a>
                </h1>
				<div class="entry-content">
					<?php echo substr($page->post_content, 0, 187) ?>...<div class="grid-more-link"><a href="<?php echo get_permalink($page->ID) ?>"> <?php echo __('Read More', 'formationpro'); ?></a></div>
        
				</div><!-- .entry-content -->
   			</div><!-- .hentry -->
        </div>
		<?php endforeach; ?>
        
    	<?php formationpro_content_nav( 'nav-below' ); ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<aside id="sidebar-right">
	<?php if ( is_active_sidebar( 'sidebar-right' ) && dynamic_sidebar('sidebar-right') ) : else : ?>
	<?php echo '<h4>' . __('Widget Ready', 'formationpro') . '</h4>'; ?>
	<?php echo '<p>' . __('This right column is widget ready! Add one in the admin panel.', 'formationpro') . '</p>'; ?>     
	<?php endif; ?>  
</aside>

</div><!-- #primary wrap -->
<?php get_footer(); ?>