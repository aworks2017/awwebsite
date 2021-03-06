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
            
            foreach($section_pages as $page) :?>
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
					<?php $page_content =get_post_meta ($page->ID,'description', true ) ; 
					if(!$page_content){
						$page_content = $page->post_content;
					}
					$page_content = htmlspecialchars(substr($page_content, 0, 190));
					?>
                        <?php echo $page_content; ?>...<div class="grid-more-link"><a href="<?php echo get_permalink($page->ID) ?>"> <?php $call2action = get_post_meta ($page->ID,'call2action', true ); if(!$call2action)$call2action="Read More";  echo __($call2action, 'formationpro'); ?></a></div><!-- .grid-more-link -->
                    </div><!-- .entry-content -->
                </div><!-- .hentry -->
            </div><!-- .gridblock -->
            <?php  endforeach; ?>
        
    	

		</div><!-- #content-right -->
        <?php formationpro_content_nav( 'nav-below' ); ?>
	</div><!-- #primary-left -->
</div><!-- #primary wrap -->

<aside id="sidebar-right">
	<?php if ( is_active_sidebar( 'sidebar-right' ) && dynamic_sidebar('sidebar-right') ) : else : ?>
	<?php echo '<h4>' . __('Widget Ready', 'formationpro') . '</h4>'; ?>
	<?php echo '<p>' . __('This right column is widget ready! Add one in the admin panel.', 'formationpro') . '</p>'; ?>     
	<?php endif; ?>  
</aside>

<?php get_footer(); ?>