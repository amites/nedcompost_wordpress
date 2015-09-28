<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Hamza Lite
 */
?><!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalabe=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.min.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
<header id="masthead" class="site-header">
    <div id="top-header">
		<div class="ak-container">

			<div class="header-wrap clearfix <?php do_action( 'hamza_lite_logo_alignment' ); ?>">
				<div class="site-branding main-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">				
					<?php if ( get_header_image() ) { ?>
						<img src="<?php header_image(); ?>" alt="<?php bloginfo('name') ?>">
					<?php }else{ ?>
						<h1 class="site-title"><?php echo bloginfo('title'); ?></h1>
						<div class="tagline site-description"><?php echo bloginfo('description'); ?></div>
					<?php } ?>		
					</a>		
				</div><!-- .site-branding -->
                <div class="right-header-top">
                <?php if( get_theme_mod('hamza_lite_social_link_header') != 1){?>
                    <div class="footer-socials">
                        <?php do_action( 'hamza_lite_social_links' ); ?>
                    </div>
                <?php } ?>
                
                <?php if( get_theme_mod('hamza_lite_search_box_header', '1') == 1){ ?>
				    <div class="ak-search">
				        <?php get_search_form(); ?>
				    </div>				    
				<?php } ?>        		
                </div>

				<nav id="site-navigation" class="main-navigation<?php if( (get_theme_mod('hamza_lite_social_link_header') == 1) && (get_theme_mod('hamza_lite_search_box_header') != 1) ) {echo ' nav-without-social-search';}?>">
					<h1 class="menu-toggle"><?php _e( '', 'hamza_lite' ); ?></h1>

						<?php 
						wp_nav_menu( array( 
						'theme_location' => 'primary' , 
						'container_class' => 'menu',
						'items_wrap'      => '<ul class="clearfix" id="%1$s">%3$s</ul>',
						) ); 
                        ?>

				</nav><!-- #site-navigation -->
			</div><!-- .header-wrap -->

		</div><!-- .ak-container -->
  </div><!-- #top-header -->
</header><!-- #masthead -->

<section id="slider-banner">	
	<div class="slider-wrap">
		<?php 
		if(is_home() || is_front_page() ){
			do_action( 'hamza_lite_bxslider' ); 
		} ?>
	</div>
</section><!-- #slider-banner -->

	
<?php
if((is_home() || is_front_page()) && 'page' == get_option( 'show_on_front' )){	
	$hamza_lite_content_id = "content";	
}elseif(is_home() || is_front_page() ){
	$hamza_lite_content_id = "home-content";
}else{
	$hamza_lite_content_id ="content";
} ?>

<div id="<?php echo $hamza_lite_content_id; ?>" class="site-content">
