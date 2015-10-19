<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package formationpro
 * @since formationpro 1.0
 */
?>

</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">

	<?php if(! get_theme_mod('hide_footer_widgets')): ?>
		<div class="footer_container">
			<div class="section group">

				<div class="col span_1_of_3">
					<?php if ( is_active_sidebar( 'left_column' ) && dynamic_sidebar('left_column') ) : else : ?>
						<div class="widget">
						</div>
					<?php endif; ?>
				</div>

				<div class="col span_1_of_3">
					<?php if ( is_active_sidebar( 'center_column' ) && dynamic_sidebar('center_column') ) : else : ?>
						<div class="widget">
						</div>
					<?php endif; ?>
				</div>

				<div class="col span_1_of_3">
					<?php if ( is_active_sidebar( 'right_column' ) && dynamic_sidebar('right_column') ) : else : ?>
						<div class="widget">
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div><!-- footer container -->
	<?php endif; ?>

        <?php if(! get_theme_mod('hide_copyright')): ?>

	        <div class="site-info">
					<?php if ( is_active_sidebar( 'bottom_footer' ) && dynamic_sidebar('bottom_footer') ) : else : ?>
						<div class="widget">
						</div>
					<?php endif; ?>
			</div><!-- .site-info -->

		<?php endif; ?>

	</footer><!-- #colophon .site-footer -->

    <a href="#top" id="smoothup"></a>

</div><!-- #page .hfeed .site -->
</div><!-- end of wrapper -->
<?php wp_footer(); ?>

</body>
</html>