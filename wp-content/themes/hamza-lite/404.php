<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Hamza Lite
 */

get_header(); ?>
<div class="ak-container">
		<main id="main" class="site-main">

			<section class="not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'hamza_lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="error-404 clearfix">
                <span class="breeze-404"><?php _e('404' , 'hamza_lite' ); ?></span> 
                <span class="breeze-error"><?php _e('error' , 'hamza_lite' ); ?></span>   
                </div>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location.', 'hamza_lite' ); ?></p>
				</div><!-- .page-content -->
           
			</section><!-- .error-404 -->

		</main><!-- #main -->
</div>
<?php get_footer(); ?>