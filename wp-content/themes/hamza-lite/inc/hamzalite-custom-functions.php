<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Hamza Lite
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function hamza_lite_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hamza_lite_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hamza_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'hamza_lite_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function hamza_lite_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'inventory' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'hamza_lite_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function hamza_lite_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'hamza_lite_render_title' );
endif;


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function hamza_lite_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'hamza_lite_setup_author' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function hamza_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'hamza_lite' ),
		'id'            => 'left-sidebar',
		'description'   => __( 'Display items in the Left Sidebar of the inner pages', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'hamza_lite' ),
		'id'            => 'right-sidebar',
		'description'   => __( 'Display items in the Right Sidebar of the inner pages', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'hamza_lite' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'Display items in the Right Sidebar of the inner pages for Woocommerce', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer One', 'hamza_lite' ),
		'id'            => 'footer-1',
		'description'   => __( 'Display items in First Footer Area', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Two', 'hamza_lite' ),
		'id'            => 'footer-2',
		'description'   => __( 'Display items in Second Footer Area', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Three', 'hamza_lite' ),
		'id'            => 'footer-3',
		'description'   => __( 'Display items in Third Footer Area', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Four', 'hamza_lite' ),
		'id'            => 'footer-4',
		'description'   => __( 'Display items in Fourth Footer Area', 'hamza_lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'hamza_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hamza_lite_scripts() {	
	$query_args = array(
		'family' => 'Open+Sans:400,400italic,300italic,300,600,600italic|Lato:400,100,300,700|Josefin+Slab:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic|Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic',
	);
	wp_enqueue_style( 'hamza-lite-font-css', get_template_directory_uri() . '/css/fonts.css' );
	wp_enqueue_style( 'hamza-lite-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
	wp_enqueue_style( 'hamza-lite-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'hamza-lite-fancybox-css', get_template_directory_uri() . '/css/nivo-lightbox.css' );
	wp_enqueue_style( 'hamza-lite-bx-slider-style', get_template_directory_uri() . '/css/jquery.bxslider.css' );
	wp_enqueue_style( 'hamza-lite-style', get_stylesheet_uri(), array(), '1.0' );

	wp_enqueue_script( 'hamza-lite-bx-slider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '4.1', true );
	wp_enqueue_script( 'hamza-lite-fancybox', get_template_directory_uri() . '/js/nivo-lightbox.min.js', array('jquery'), '2.1', true );
	wp_enqueue_script( 'hamza-lite-jquery-actual', get_template_directory_uri() . '/js/jquery.actual.min.js', array('jquery'), '1.0.16', true );
	wp_enqueue_script( 'hamza-lite--skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'hamza-lite-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

/**
* Loads up responsive css if it is not disabled
*/
	if ( get_theme_mod( 'hamza_lite_disable_responsive_design' ) != 1 ) {	
		wp_enqueue_style( 'hamza-lite-responsive', get_template_directory_uri() . '/css/responsive.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'hamza_lite_scripts' );

/**
* Loads up favicon
*/
function hamza_lite_add_favicon(){
	$hamza_lite_favicon = get_theme_mod('hamza_lite_favicon_image');	
	if( !empty($hamza_lite_favicon)){
	   echo '<link rel="shortcut icon" type="image/png" href="'. esc_url($hamza_lite_favicon).'"/>';
	}
}
add_action('wp_head', 'hamza_lite_add_favicon');


function hamza_lite_social_cb(){
    $hamza_lite_facebook = get_theme_mod('hamza_lite_facebook');
    $hamza_lite_twitter = get_theme_mod('hamza_lite_twitter');
    $hamza_lite_google_plus = get_theme_mod('hamza_lite_google_plus');
    $hamza_lite_linkedin = get_theme_mod('hamza_lite_linkedin');
    $hamza_lite_youtube = get_theme_mod('hamza_lite_youtube');
	?>
	<div class="socials">
	<?php if(!empty($hamza_lite_facebook)){ ?>
	<a href="<?php echo esc_url($hamza_lite_facebook); ?>" class="facebook" title="Facebook" target="_blank"><span class="font-icon-social-facebook"></span></a>
	<?php } ?>

	<?php if(!empty($hamza_lite_twitter)){ ?>
	<a href="<?php echo esc_url($hamza_lite_twitter); ?>" class="twitter" title="Twitter" target="_blank"><span class="font-icon-social-twitter"></span></a>
	<?php } ?>

	<?php if(!empty($hamza_lite_google_plus)){ ?>
	<a href="<?php echo esc_url($hamza_lite_google_plus); ?>" class="gplus" title="Google Plus" target="_blank"><span class="font-icon-social-google-plus"></span></a>
	<?php } ?>

	<?php if(!empty($hamza_lite_linkedin)){ ?>
	<a href="<?php echo esc_url($hamza_lite_linkedin); ?>" class="linkedin" title="Linkedin" target="_blank"><span class="font-icon-social-linkedin"></span></a>
	<?php } ?>
    
    <?php if(!empty($hamza_lite_youtube)){ ?>
	<a href="<?php echo esc_url($hamza_lite_youtube); ?>" class="youtube" title="Youtube" target="_blank"><span class="font-icon-social-youtube"></span></a>
	<?php } ?>
    
	</div>
<?php } 

add_action( 'hamza_lite_social_links', 'hamza_lite_social_cb', 10 );	


function hamza_lite_featured_text_cb(){	
	$hamza_lite_featured_text = get_theme_mod('hamza_lite_featured_content', 'Featured Text');
	if(!empty($hamza_lite_featured_text)){
	echo '<div class="header-text">'.esc_html(wpautop($hamza_lite_featured_text)).'</div>';
	}
}

add_action('hamza_lite_featured_text','hamza_lite_featured_text_cb', 10);

function hamza_lite_logo_alignment_cb(){
	
	$hamza_lite_logo_alignment = get_theme_mod( 'hamza_lite_logo_alignment', 'left' );
	if($hamza_lite_logo_alignment =="left"){
		$hamza_lite_alignment_class="logo-left";
	}elseif($hamza_lite_logo_alignment == "center"){
		$hamza_lite_alignment_class="logo-center";
	}else{
		$hamza_lite_alignment_class="";
	}
	echo esc_attr($hamza_lite_alignment_class);
}

add_action('hamza_lite_logo_alignment','hamza_lite_logo_alignment_cb', 10);


function hamza_lite_excerpt( $hamza_lite_content , $hamza_lite_letter_count ){
	$hamza_lite_striped_content = strip_shortcodes($hamza_lite_content);
	$hamza_lite_striped_content = strip_tags($hamza_lite_striped_content);
	$hamza_lite_excerpt = mb_substr($hamza_lite_striped_content, 0, $hamza_lite_letter_count );
	if($hamza_lite_striped_content > $hamza_lite_excerpt){
		$hamza_lite_excerpt .= "...";
	}
	return $hamza_lite_excerpt;
}


function hamza_lite_bxslidercb(){
	global $post;
	
    $hamza_lite_slider_type = get_theme_mod('hamza_lite_slider_type', 'single_post_slider');
    $hamza_lite_slider_one = get_theme_mod('hamza_lite_slider_one');
    $hamza_lite_slider_two = get_theme_mod('hamza_lite_slider_two');
    $hamza_lite_slider_three = get_theme_mod('hamza_lite_slider_three');
    $hamza_lite_slider_four = get_theme_mod('hamza_lite_slider_four');
    $hamza_lite_slider_category = get_theme_mod('hamza_lite_slider_category');
    $hamza_lite_slider_option = get_theme_mod('hamza_lite_slider_option', 'show');    
    $hamza_lite_slider_control_option = get_theme_mod('hamza_lite_slider_control_option', 'true');
    $hamza_lite_slider_transition = get_theme_mod('hamza_lite_slider_transition', 'horizontal');    
    $hamza_lite_slider_auto_transition = get_theme_mod('hamza_lite_slider_auto_transition', 'true');
    $hamza_lite_slider_speed = get_theme_mod('hamza_lite_slider_speed', '500');
    $hamza_lite_slider_pause = get_theme_mod('hamza_lite_slider_pause', '4000');
	empty($hamza_lite_slider_pause) ? ($e ='4000') : ($e = esc_attr($hamza_lite_slider_pause));
    $hamza_lite_slider_captions = get_theme_mod('hamza_lite_slider_captions', 'show');
    
	if( $hamza_lite_slider_option == 'show') { 
	if((isset($hamza_lite_slider_one) && !empty($hamza_lite_slider_one)) 
		|| (isset($hamza_lite_slider_two) && !empty($hamza_lite_slider_two)) 
		|| (isset($hamza_lite_slider_three) && !empty($hamza_lite_slider_three))
		|| (isset($hamza_lite_slider_four) && !empty($hamza_lite_slider_four)) 
		|| (isset($hamza_lite_slider_category) && !empty($hamza_lite_slider_category))
	){

	?>
		<script type="text/javascript">
        jQuery(function(){
			jQuery('.bx-slider').bxSlider({				
				mode:'<?php echo esc_attr($hamza_lite_slider_transition); ?>',
				speed:'<?php echo esc_attr($hamza_lite_slider_speed); ?>',				
                pager:false,
				controls:<?php echo esc_attr($hamza_lite_slider_control_option); ?>,				
				auto :<?php echo esc_attr($hamza_lite_slider_auto_transition); ?>,
				pause: '<?php echo esc_attr($e); ?>'				
			});
		});
    </script>
    <?php 

        if($hamza_lite_slider_type == 'single_post_slider'){
        	if(!empty($hamza_lite_slider_one) || !empty($hamza_lite_slider_two) || !empty($hamza_lite_slider_three) || !empty($hamza_lite_slider_four)){
        		$sliders = array($hamza_lite_slider_one,$hamza_lite_slider_two,$hamza_lite_slider_three,$hamza_lite_slider_four);
				$remove = array(0);
			    $sliders = array_diff($sliders, $remove);  ?>

			    <div class="bx-slider">
			    <?php
			    foreach ($sliders as $slider){
				$args = array (
				'p' => $slider
				);

					$loop = new WP_query( $args );
					if($loop->have_posts()){ 
					while($loop->have_posts()) : $loop-> the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-slider-image', false ); 
					?>
					<div class="slides">
						
							<img src="<?php echo esc_url($image[0]); ?>" />
							
							<?php if( $hamza_lite_slider_captions == 'show' ):?>
							<div class="slider-caption">
								<div class="ak-container">
									<div class="slider-caption-container">
                                        <h1 class="caption-title"><?php the_title();?></h1>
                                        <h2 class="caption-description"><?php echo hamza_lite_excerpt( get_the_content(), 100 );?></h2>
                                        <a href="<?php the_permalink();?>"><?php _e('Read More','hamza_lite'); ?></a>
                                    </div>
								</div>
							</div>
							<?php  endif; ?>
			
		            </div>
					<?php endwhile;
					}
				} ?>
			    </div>
        	<?php
        	}

        }elseif ($hamza_lite_slider_type == 'cat_post_slider') { ?>
        	<div class="bx-slider">
			<?php
			$loop = new WP_Query(array(
					'cat' => $hamza_lite_slider_category,
					'posts_per_page' => -1
				));
				if($loop->have_posts()){ 
				while($loop->have_posts()) : $loop-> the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hamza-lite-slider-image', false ); 
				?>
				<div class="slides">
						
						<img src="<?php echo esc_url($image[0]); ?>" />
							
						<?php if( $hamza_lite_slider_captions == 'show' ):?>
						<div class="slider-caption">
							<div class="ak-container">
                                <div class="slider-caption-container">
								    <h1 class="caption-title"><?php the_title();?></h1>
								    <h2 class="caption-description"><?php echo hamza_lite_excerpt( get_the_content(), 100 );?></h2>
                                    <a href="<?php the_permalink(); ?>"><?php _e('Read More','hamza_lite'); ?></a>
                                </div>
							</div>
						</div>
						<?php  endif; ?>
			
		        </div>
				<?php endwhile;
				} ?>
			</div>
        <?php
    	}
      }
   }
}

add_action('hamza_lite_bxslider','hamza_lite_bxslidercb', 10);

function hamza_lite_layout_class($classes){
	global $post;
	if( is_404()){
	   $classes[] = ' ';
    }elseif(is_singular()){
	   $post_class = get_post_meta( $post -> ID, 'hamza_lite_sidebar_layout', true );
	   $classes[] = $post_class;
    }else{
	   $classes[] = 'right-sidebar';	
	}
	return $classes;
}

add_filter( 'body_class', 'hamza_lite_layout_class' );

function hamza_lite_web_layout($classes){    
    $weblayout = get_theme_mod('hamza_lite_webpage_layout_choose' , 'fullwidth');
    if($weblayout =='boxed'){
        $classes[]= 'boxed-layout';
    }
    return $classes;
}

add_filter( 'body_class', 'hamza_lite_web_layout' );

function hamza_lite_custom_css(){	
	$hamza_lite_custom_css = get_theme_mod('hamza_lite_custom_css');
	echo '<style type="text/css">';
		echo esc_attr($hamza_lite_custom_css);
	echo '</style>';
}

add_action('wp_head','hamza_lite_custom_css');

/** Function to list only blog category post in author archive */
function hamza_lite_exclude_cat_from_blog($query) {

    $hamza_lite_blog_cat = get_theme_mod('hamza_lite_blog_category');
    
    if(!empty($hamza_lite_blog_cat)){
        if ( !is_admin() && $query->is_main_query() ) {
            if( $query->is_author() ){
                $query->set( 'category__in', array ( $hamza_lite_blog_cat ) );
            }
        }
        return $query;
    }
}
add_filter('pre_get_posts', 'hamza_lite_exclude_cat_from_blog');

function hamza_lite_register_required_plugins() {

    $plugins = array(        
        array(
            'name'      => 'AccessPress Twitter Feed',
            'slug'      => 'accesspress-twitter-feed',
            'required'  => false,
        ),        
        array(
            'name'      => 'AccessPress Social Counter',
            'slug'      => 'accesspress-social-counter',
            'required'  => false,
        ),        
        array(
            'name'      => 'Newsletter',
            'slug'      => 'newsletter',
            'required'  => false,
        )
    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'hamza_lite' ),
            'menu_title'                      => __( 'Install Plugins', 'hamza_lite' ),
            'installing'                      => __( 'Installing Plugin: %s', 'hamza_lite' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'hamza_lite' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                'hamza_lite'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'hamza_lite'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'hamza_lite'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'hamza_lite'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'hamza_lite' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'hamza_lite' ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', 'hamza_lite' ),
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'hamza_lite' ),  // %1$s = plugin name(s).
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'hamza_lite' ),  // %1$s = plugin name(s).
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'hamza_lite' ), // %s = dashboard link.
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'hamza_lite_register_required_plugins' );

add_filter('widget_text', 'do_shortcode');

/** Function to add span in the title */
function hamza_lite_get_title( $post_id ){
    $title = get_the_title( $post_id );
    $e_title = '';
    $arr = explode(' ', $title);
    $count = count($arr);
    if( $count > 1 ){
        for($i=0;$i<$count;$i++){
            if($i == ($count-1)){
                $e_title .= '<span>';
            }
            $e_title .= $arr[$i];
            if($i < $count){
                $e_title .= ' ';
            }                        
            if($i == ($count-1)){
                $e_title .= '</span>';
            }
        }
        echo apply_filters('the_title', $e_title);
    }else{
        echo apply_filters('the_title', $title);
    }
}

//* Exclude Categories from Category Widget
function hamza_lite_custom_category_widget($args) {
	$cat_ids = get_theme_mod('hamza_lite_exclude_categories');
    //$exclude = "1,2"; // Category IDs to be excluded
	$args["exclude"] = $cat_ids;
	return $args;
}
add_filter( "widget_categories_args", "hamza_lite_custom_category_widget" );
add_filter( "widget_categories_dropdown_args", "hamza_lite_custom_category_widget" );

/** 
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 */
function hamza_lite_truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
 if ($considerHtml) {
  // if the plain text is shorter than the maximum length, return the whole text
  if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
   return $text;
  }

  // splits all html-tags to scanable lines
  preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

  $total_length = strlen($ending);
  $open_tags = array();
  $truncate = '';

  foreach ($lines as $line_matchings) {
   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
   if (!empty($line_matchings[1])) {
    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
    // do nothing
    // if tag is a closing tag (f.e.)
    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
     // delete tag from $open_tags list
     $pos = array_search($tag_matchings[1], $open_tags);
     if ($pos !== false) {
      unset($open_tags[$pos]);
     }
     // if tag is an opening tag (f.e. )
    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
     // add tag to the beginning of $open_tags list
     array_unshift($open_tags, strtolower($tag_matchings[1]));
    }
    // add html-tag to $truncate’d text
    $truncate .= $line_matchings[1];
   }

   // calculate the length of the plain text part of the line; handle entities as one character
   $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
   if ($total_length+$content_length > $length) {
    // the number of characters which are left
    $left = $length - $total_length;
    $entities_length = 0;
    // search for html entities
    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
     // calculate the real length of all entities in the legal range
     foreach ($entities[0] as $entity) {
      if ($entity[1]+1-$entities_length <= $left) {
       $left--;
       $entities_length += strlen($entity[0]);
      } else {
       // no more characters left
       break;
      }
     }
    }
    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
    // maximum lenght is reached, so get off the loop
    break;
   } else {
    $truncate .= $line_matchings[2];
    $total_length += $content_length;
   }

   // if the maximum length is reached, get off the loop
   if($total_length >= $length) {
    break;
   }
  }
 } else {
  if (strlen($text) <= $length) {
   return $text;
  } else {
   $truncate = substr($text, 0, $length - strlen($ending));
  }
 }

 // if the words shouldn't be cut in the middle...
 if (!$exact) {
  // ...search the last occurance of a space...
  $spacepos = strrpos($truncate, ' ');
  if (isset($spacepos)) {
   // ...and cut the text in this position
   $truncate = substr($truncate, 0, $spacepos);
  }
 }

 // add the defined ending to the text
 $truncate .= $ending;

 if($considerHtml) {
  // close all unclosed html-tags
  foreach ($open_tags as $tag) {
   $truncate .= '';
  }
 }

return $truncate;

}

/* Add Typograpy and Google web fonts */
function hamza_lite_googlefont_cb(){    
    $http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
    $un_bodytype = get_theme_mod('hamza_lite_body_text', 'Raleway');
    $un_headtype = get_theme_mod('hamza_lite_header_font', 'Raleway');
    $bodytype = str_replace(' ' , '+', $un_bodytype);
    $headtype = str_replace(' ' , '+', $un_headtype);
    $font_var = '300,400,600,700,900,300italic,400italic,600italic,700italic,900italic';
    $heading_font_weight = get_theme_mod('hamza_lite_header_font_weight', '700');
    $body_font_weight = get_theme_mod('hamza_lite_body_text_weight', '400');
	$h1_font_size = get_theme_mod('hamza_lite_h1_font_size', '26');
	$h1_text_transform = get_theme_mod('hamza_lite_h1_text_transform', 'uppercase');
	$h1_font_color = get_theme_mod('hamza_lite_h1_color', '#333333');
	$h2_font_size = get_theme_mod('hamza_lite_h2_font_size', '24');
	$h2_text_transform = get_theme_mod('hamza_lite_h2_text_transform', 'uppercase');
	$h2_font_color = get_theme_mod('hamza_lite_h2_color', '#4b4b4b');
	$h3_font_size = get_theme_mod('hamza_lite_h3_font_size', '22');
	$h3_text_transform = get_theme_mod('hamza_lite_h3_text_transform', 'none');
	$h3_font_color = get_theme_mod('hamza_lite_h3_color', '#333333');
	$h4_font_size = get_theme_mod('hamza_lite_h4_font_size', '20');
	$h4_text_transform = get_theme_mod('hamza_lite_h4_text_transform', 'none');
	$h4_font_color = get_theme_mod('hamza_lite_h4_color', '#333333');
	$h5_font_size = get_theme_mod('hamza_lite_h5_font_size', '18');
	$h5_text_transform = get_theme_mod('hamza_lite_h5_text_transform', 'uppercase');
	$h5_font_color = get_theme_mod('hamza_lite_h5_color', '#333333');
	$h6_font_size = get_theme_mod('hamza_lite_h6_font_size', '16');
	$h6_text_transform = get_theme_mod('hamza_lite_h6_text_transform', 'none');
	$h6_font_color = get_theme_mod('hamza_lite_h6_color', '#333333');
	$body_font_size = get_theme_mod('hamza_lite_body_font_size', '14');
	$body_font_color = get_theme_mod('hamza_lite_body_color', '#212121');

    if ( $bodytype != "" ){
		echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $bodytype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
    }

    if ($headtype != ""){
		echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $headtype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
    }
    ?>
    
    <?php echo "<style type='text/css' media='all'>"; ?>
    body { font-family: <?php echo $un_bodytype; ?>; font-weight:<?php echo $body_font_weight; ?>; }
	h1,h2,h3,h4,h5,h6 { font-family: <?php echo $un_headtype; ?>; font-weight:<?php echo $heading_font_weight; ?>; }
	h1{font-size:<?php echo $h1_font_size; ?>px;text-transform:<?php echo $h1_text_transform; ?>;color:<?php echo $h1_font_color; ?>;}
	h2{font-size:<?php echo $h2_font_size; ?>px;text-transform:<?php echo $h2_text_transform; ?>;color:<?php echo $h2_font_color; ?>;}
	h3{font-size:<?php echo $h3_font_size; ?>px;text-transform:<?php echo $h3_text_transform; ?>;color:<?php echo $h3_font_color; ?>;}
	h4{font-size:<?php echo $h4_font_size; ?>px;text-transform:<?php echo $h4_text_transform; ?>;color:<?php echo $h4_font_color; ?>;}
	h5{font-size:<?php echo $h5_font_size; ?>px;text-transform:<?php echo $h5_text_transform; ?>;color:<?php echo $h5_font_color; ?>;}
	h6{font-size:<?php echo $h6_font_size; ?>px;text-transform:<?php echo $h6_text_transform; ?>;color:<?php echo $h6_font_color; ?>;}
	body{font-size:<?php echo $body_font_size; ?>px;color:<?php echo $body_font_color; ?>;}	
	<?php echo "</style>"; ?>
	
	<?php }
add_action('wp_head','hamza_lite_googlefont_cb');

/** Hook to remove default breadcrumbs of WooCommerce */
add_action( 'init', 'hamza_lite_remove_wc_breadcrumbs' );
function hamza_lite_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}