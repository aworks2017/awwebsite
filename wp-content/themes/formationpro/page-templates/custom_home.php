<?php
/*
 * Template Name: Custom Home Page
 * Description: A home page with featured slider and widgets.
 *
 * @package formationpro
 * @since formationpro 1.0
 */

get_header(); ?>

      <?php if(! get_theme_mod('homepage_slider_hide')): ?>

        <?php

          $featured_cat   =   get_theme_mod( 'homepage_slider_cat' );
		  
          $number         =   get_theme_mod( 'homepage_slider_slide_no' );
		  
		  $slider_arg = array(
			  	'post_type'=>array('post','page'),
                'showposts' => $number,
				'meta_key'=>'slider',
              );

          $the_query     =   new WP_Query($slider_arg);
          
        ?>
            
        <div class="flex-container">
          <div class="flexslider">
            <ul class="slides">
              <?php  while ($the_query -> have_posts()) : $the_query ->the_post(); ?>
                <li>
                  <?php the_post_thumbnail(); ?>
                  <div class="caption_wrap">
                    <div class="flex-caption">
                      <div class="flex-caption-title">
                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                      </div>
                      <p><?php $slide_desc = get_post_meta(get_the_ID(),'description',true); echo get_the_ID();echo ($slide_desc)?substr(trim($post_desc),0,250):esc_html(get_slider_excerpt()); ?> <a href="<?php the_permalink() ?>">...</a></p>
                    </div>
                  </div>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>

      <?php endif; ?>

    


      
      <?php if(! get_theme_mod('homepage_service_bool')): ?>

        <div class="section_services group">
          <div class="featuretext_middle animated" data-fx="fadeInUp">

             <?php if (class_exists('FormationPlus')) : ?>

              <div class="service-box">        
                <div class="featuretext">
                  <?php if ( get_theme_mod( 'header-one-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'header_one_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-one-file-upload' ) ); ?>"  alt="feature one"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                  <h3><a href="<?php echo esc_url( get_theme_mod( 'header_one_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_one' ) ); ?></a></h3>
                  <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_one' ) ); ?></p>
                </div>
              </div>

              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-two-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_two_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-two-file-upload' ) ); ?>"  alt="feature two"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_two_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_two' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_two' ) ); ?></p>
                </div>
              </div>

              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-three-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_three_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-three-file-upload' ) ); ?>"  alt="feature three"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_three_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_three' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_three' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-four-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_four_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-four-file-upload' ) ); ?>"  alt="feature four"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_four_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_four' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_four' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-five-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_five_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-five-file-upload' ) ); ?>"  alt="feature five"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_five_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_five' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_five' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-six-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_six_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-six-file-upload' ) ); ?>"  alt="feature six"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_six_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_six' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_six' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-seven-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_seven_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-seven-file-upload' ) ); ?>"  alt="feature seven"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_seven_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_seven' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_seven' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-eight-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_eight_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-eight-file-upload' ) ); ?>"  alt="feature eight"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_eight_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_eight' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_eight' ) ); ?></p>
                </div>
              </div>
              
              <div class="service-box">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-nine-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_nine_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-nine-file-upload' ) ); ?>"  alt="feature nine"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_nine_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_nine' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_nine' ) ); ?></p>
                </div>
              </div>


          <?php else: ?>

            <div class="section group">

              <div class="col span_1_of_3 box-1">        
                <div class="featuretext">
                  <?php if ( get_theme_mod( 'header-one-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'header_one_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-one-file-upload' ) ); ?>"  alt="feature one"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                  <h3><a href="<?php echo esc_url( get_theme_mod( 'header_one_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_one' ) ); ?></a></h3>
                  <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_one' ) ); ?><br><a class="home_read_more" href="<?php echo esc_url( get_theme_mod( 'header_one_url' ) ); ?>">Learn More</a></p>
                </div>
              </div>

              <div class="col span_1_of_3 box-2">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-two-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_two_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-two-file-upload' ) ); ?>"  alt="feature two"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_two_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_two' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_two' ) ); ?><br><a class="home_read_more" href="<?php echo esc_url( get_theme_mod( 'header_two_url' ) ); ?>">Learn More</a></p>
                </div>
              </div>

              <div class="col span_1_of_3 box-3">         
                <div class="featuretext">
                <?php if ( get_theme_mod( 'header-three-file-upload' ) ) : ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'header_three_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'header-three-file-upload' ) ); ?>"  alt="feature three"></a>
                <?php else : ?>
                  <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                <?php endif; ?>
                <h3><a href="<?php echo esc_url( get_theme_mod( 'header_three_url' ) ); ?>"><?php echo esc_html(get_theme_mod( 'featured_textbox_header_three' ) ); ?></a></h3>
                <p><?php echo esc_html(get_theme_mod( 'featured_textbox_text_three' ) ); ?><br><a class="home_read_more" href="<?php echo esc_url( get_theme_mod( 'header_three_url' ) ); ?>">Learn More</a></p>
                </div>
              </div>

            </div>

          <?php endif; ?>

        </div> 
      </div> 

    <?php endif; ?>





    <?php if(! get_theme_mod('homepage_promotional_bool')): ?>

      <div class="featuretext_top">

        <h3 class="animated" data-fx="slideInLeft"><?php if( get_theme_mod( 'featured_textbox' ) ){ echo esc_html(get_theme_mod( 'featured_textbox' ) ); } else { _e( 'Promotional Bar', 'formationpro' ); } ?></h3>
        
        <?php if(get_theme_mod( 'featured_button_txt' )): ?>

          <div class="featuretext_button animated" data-fx="slideInRight">
            <a href="<?php echo esc_url( get_theme_mod( 'featured_button_url' ) ); ?>"><?php echo esc_attr(get_theme_mod( 'featured_button_txt' )); ?></a>
          </div>  

        <?php endif; ?>

      </div>

    <?php endif; ?>


    <div id="primary_home" class="content-area">

      <div id="content" class="fullwidth" role="main">

      
        <?php if(! get_theme_mod('homepage_recent_bool')): ?>

          <div class="section_thumbnails group animated" data-fx="fadeInUp">

            <?php $the_query = new WP_Query(
              array(
			  	'post_type'=>array('post','page'),
                'showposts' => 4,
				'meta_key'=>'homepost',
              ));
            ?>

            <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

              <div class="col span_1_of_4">
                <article class="recent">
                  <h2 class="recent_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <div class="view third-effect">
                    <?php
                      if ( has_post_thumbnail() ) {
                        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'recent' );
                        echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
                      }
                    ?>
                    <div class="mask">  
                      <a href="<?php the_permalink(); ?>" class="info">Full Image</a>  
                    </div>
                  </div>
                  <!-- <div class="recent_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div> -->
                  <p><?php 
				  $post_desc = get_post_meta(get_the_ID(),'description',true);
				  echo ($post_desc)?substr(trim($post_desc),0,250):formationpro_get_recentposts_excerpt(); 
				 	?></p>
                  <div class="thumbs-more-link">
                    <a href="<?php the_permalink() ?>"> <?php $call2action=get_post_meta($post->ID,'call2action',true);if(!$call2action)$call2action='Read More';  echo __($call2action, 'formationpro'); ?></a>
                  </div>
                </article>
              </div>	

            <?php endwhile; ?>

          </div>

        <?php endif; ?>



        <?php if(! get_theme_mod('homepage_testimonials_bool')): ?>

          <div class="testimonial_home animated" data-fx="fadeInUp">

            <?php if(! get_theme_mod('homepage_testimonials_title_bool')): ?>
              <h3><?php 
                if( get_theme_mod('testimonials_title') ){
                  echo esc_attr( get_theme_mod('testimonials_title') );
                } else {
                  _e( 'Customer Testimonial', 'formationpro' );
                } 
              ?></h3>
            <?php endif; ?>
            
            <?php echo do_shortcode('[testimonial posts_per_page="1" orderby="none" testimonial_id="' . get_theme_mod('testimonials_id') . '"]'); ?>

          </div>

        <?php endif; ?>



        <?php if(! get_theme_mod('homepage_partners_bool')): ?> 

          <div class="section_clients group">
            <div class="client animated" data-fx="fadeInUp">

              <h3><?php if(get_theme_mod('homepage_partners_title')){ echo esc_html( get_theme_mod( 'homepage_partners_title' ) ); } else { _e('Partners', 'formationpro'); } ?></h3>

              <div class="unity-separator"></div>
              
              <div class="col span_1_of_4">
                <div class="client_recent">
                  <?php if ( get_theme_mod( 'logo-one-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'logo_one_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'logo-one-file-upload' ) ); ?>"  alt="logo one"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col span_1_of_4">
                <div class="client_recent">
                  <?php if ( get_theme_mod( 'logo-two-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'logo_two_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'logo-two-file-upload' ) ); ?>"  alt="logo two"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col span_1_of_4">
                <div class="client_recent">
                  <?php if ( get_theme_mod( 'logo-three-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'logo_three_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'logo-three-file-upload' ) ); ?>"  alt="logo three"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col span_1_of_4">
                <div class="client_recent">
                  <?php if ( get_theme_mod( 'logo-four-file-upload' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'logo_four_url' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'logo-four-file-upload' ) ); ?>"  alt="logo four"></a>
                  <?php else : ?>
                    <?php echo '<h4>' . __('Insert Image', 'formationpro') . '</h4>'; ?>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </div>

        <?php endif; ?>

      </div><!-- #content .site-content -->

    </div><!-- #primary .content-area -->

    <?php if (class_exists('FormationPlus')) : ?>
      <style>
        .service-box{
          width:25%;
          float:left;
          margin: 0;
        }
        @media only screen and (max-width: 600px) {
          .service-box{
            width:50%;
          }
        }
        @media only screen and (max-width: 480px) {
          .service-box{
            width:100%;
          }
        }
      </style>
    <?php endif; ?>

<?php get_footer(); ?>