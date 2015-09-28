<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Hamza Lite
 */

$hamza_lite_social_link_footer = get_theme_mod('hamza_lite_social_link_footer');
$hamza_lite_footer_copyright = get_theme_mod( 'hamza_lite_footer_text', get_bloginfo('name') );
?>
	</div><!-- #content -->

	<footer id="colophon">
	<?php 
		if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
		<div id="top-footer">
		<div class="ak-container">
			<div class="footer1 footer">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer2 footer">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>	
			</div>

			<div class="clearfix hide"></div>

			<div class="footer3 footer">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer4 footer">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php endif; ?>	
			</div>
		</div>
		</div>
		<?php endif; ?>

		
    <div id="left-footer">
    	<div class="ak-container">
        	<div id="middle-footer" class="footer-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'depth' => -1) ); 	?>
				<div class="copyright">
					<?php _e('Copyright', 'hamza_lite'); ?> &copy; <?php echo date('Y') ?> 
					<a href="<?php echo home_url(); ?>">
					<?php if(!empty($hamza_lite_footer_copyright)){
						echo $hamza_lite_footer_copyright; 
						}else{
							echo bloginfo('name');
						} ?>
					</a>. <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>"><?php printf( __( 'Powered by %s', 'hamza_lite' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php _e( 'Theme:', 'hamza_lite' ) ?> <a href="<?php echo esc_url('http://8degreethemes.com/');?>" title="8Degree Themes" target="_blank">Hamza Lite</a>
				</div><!-- .copyright -->
			</div>
			<?php if($hamza_lite_social_link_footer != 1){?>
			<div class="footer-socials clearfix">
	            <?php
					do_action( 'hamza_lite_social_links' ); 
				?>
			</div>
			<?php } ?>
		</div>
   </div>
			
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>