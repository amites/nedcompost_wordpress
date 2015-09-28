<?php
/**
 * The front page file.
 * @package Hamza Lite
 */

get_header(); ?>
	<?php
		if ( 'page' == get_option( 'show_on_front' ) ) {
		    get_template_part( 'page' );
		} else {
			get_template_part( 'index', 'one' ); 
		}
	?>	
<?php get_footer(); ?>
