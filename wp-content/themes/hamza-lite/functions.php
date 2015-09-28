<?php
/**
 * Hamza Lite functions and definitions
 *
 * @package Hamza Lite
 */


if ( ! function_exists( 'hamza_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hamza_lite_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	/**
	 * Global content width.
	 */
	 if (!isset($content_width))
     	$content_width = 750; /* pixels */

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hamza Lite, use a find and replace
	 * to change 'hamza_lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hamza_lite', get_template_directory() . '/languages' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );

	add_image_size( 'hamza-lite-slider-image', 1874, 592, true); //Home page Slider Image
	add_image_size( 'hamza-lite-featured-thumbnail', 229, 229, true); //Featured Image
	add_image_size( 'hamza-lite-blog-thumbnail', 184, 138, true); //Blog thumbnail
    add_image_size( 'hamza-lite-blog-image', 800, 250, true); //Blog Image    		
    add_image_size( 'hamza-lite-testimonial-thumbnail', 88, 88, true); //Testimonial Thumbnail
    add_image_size( 'hamza-lite-recent-post-thumbnail', 65, 56, true); //Recent Post Thumbnail
    add_image_size( 'hamza-lite-portfolio-thumbnail', 77, 54, true); //Portfolio Thumbnail
    add_image_size( 'hamza-lite-portfolio-image', 400, 300, true); //Portfolio Image
    add_image_size( 'hamza-lite-inner-image', 870, 343, true); //Inner page

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hamza_lite' ),
		'secondary' => __( 'Secondary Menu', 'hamza_lite' ),
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hamza_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    add_theme_support( 'title-tag' );
}
endif; // hamza_lite_setup
add_action( 'after_setup_theme', 'hamza_lite_setup' );

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/hamzalite-custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/hamzalite-template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/hamzalite-custom-functions.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/hamzalite-custom-metabox.php';

/**
 * Implement the custom widgets
 */
require get_template_directory() . '/inc/hamzalite-widgets.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/hamzalite-customizer.php';

/**
 * Customizer post listing
 */
require get_template_directory() . '/inc/about-us.php';

require get_template_directory() . '/inc/hamzalite-reveal-ids.php';    