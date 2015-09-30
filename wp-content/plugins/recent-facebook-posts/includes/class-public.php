<?php

if( ! defined( 'RFBP_VERSION' ) ) {
	exit;
}

class RFBP_Public {

	/**
	 * @var array
	 */
	protected $options;

	/**
	 * @var
	 */
	protected static $instance;

	/**
	 * @return RFBP_Public
	 */
	public static function instance() {
		if( ! self::$instance ) {
			self::$instance = new RFBP_Public();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->options = rfbp_get_settings();
	}

	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_shortcode( 'recent_facebook_posts', array( $this, 'output' ) );
		add_shortcode( 'recent-facebook-posts', array( $this, 'output' ) );

		if ( $this->options['load_css'] ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'load_css' ) );
		}

		add_filter( 'rfbp_content', 'wptexturize' ) ;
		add_filter( 'rfbp_content', 'convert_smilies' );
		add_filter( 'rfbp_content', 'convert_chars' );
		add_filter( 'rfbp_content', 'wpautop' );
	}

	/**
	 * Load CSS
	 */
	public function load_css() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_style( 'recent-facebook-posts-css', plugins_url( 'recent-facebook-posts/assets/css/default' . $suffix . '.css' ), array(), RFBP_VERSION );
		wp_enqueue_style( 'recent-facebook-posts-css' );
	}

	/**
	 * Get posts
	 *
	 * @return array
	 */
	public function get_posts() {

		// try to get posts from cache
		$posts = json_decode( get_transient( 'rfbp_posts' ), true );
		if ( is_array( $posts ) ) {
			return $posts;
		}

		// fetch posts from FB API
		$api = rfbp_get_api();
		$posts = $api->get_posts();

		if( is_array( $posts ) ) {

			// API call succeeded, store posts in cache
			// JSON encode posts before storing
			$encoded_posts = json_encode( $posts );
			set_transient( 'rfbp_posts', $encoded_posts, apply_filters( 'rfbp_cache_time', 3600 ) ); // user set cache time
			set_transient( 'rfbp_posts_fallback', $encoded_posts, 2629744 ); // 1 month

			return $posts;
		}

		// API call failed, get posts from fallback transient
		$posts = json_decode( get_transient( 'rfbp_posts_fallback' ), true );

		// If fallback also failed, return empty array
		if( is_array( $posts ) ) {
			return $posts;
		}

		return array();

	}

	/**
	 * Outputs the HTML with the facebook posts
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	public function output( $atts = array() ) {

		$opts = $this->options;
		$posts = $this->get_posts();

		// upgrade from old `show_link` parameter.
		if ( isset( $atts['show_link'] ) ) {
			$atts['show_page_link'] = $atts['show_link'];
		}

		$defaults = array(
			'number' => '5',
			'likes' => 1,
			'comments' => 1,
			'excerpt_length' => 140,
			'el' => 'div',
			'origin' => 'shortcode',
			'show_page_link' => false,
			'show_link_previews' => $opts['load_css']
		);

		$atts = shortcode_atts( $defaults, $atts );

		ob_start();
?>
		<!-- Recent Facebook Posts v<?php echo RFBP_VERSION; ?> - https://wordpress.org/plugins/recent-facebook-posts/ -->
		<div class="recent-facebook-posts rfbp rfbp-container rfbp-<?php echo $atts['origin']; ?>">
			<?php

		if ( $posts && ! empty( $posts ) ) {

			if ( $atts['el'] == 'li' ) { echo '<ul class="rfbp-posts-wrap">'; }

			$posts = array_slice( $posts, 0, $atts['number'] );
			$link_target = ( $opts['link_new_window'] ) ? "_blank" : '';

			foreach ( $posts as $p ) {

				$shortened = false;
				$content = $p['content'];

				// shorten content if it exceed the set excerpt length
				if ( strlen( $content ) > $atts['excerpt_length'] ) {
					$limit = strpos( $content, ' ', $atts['excerpt_length'] );
					if ( $limit ) {
						$content = substr( $content, 0, $limit );
						$shortened = true;
					}
				}
?>

					<<?php echo $atts['el']; ?> class="rfbp-post">
					<h4 class="rfbp-heading"><a class="rfbp-link" href="<?php echo $p['post_link']; ?>" rel="external nofollow" target="<?php echo $link_target; ?>">
						<?php echo $p['name']; ?>
					</a></h4>
					<div class="rfbp-text">

						<?php
				$content = make_clickable( $content, $link_target );
				$content = ( $shortened ) ? $content . apply_filters( 'rfbp_read_more', '..', $p['url'] ) : $content;
				$content = apply_filters( 'rfbp_content', $content, $p['url'] );

				echo $content; ?>

					</div>

					<?php if ( $atts['show_link_previews'] && isset( $p['link_url'] ) && !empty( $p['link_url'] ) && !empty( $p['link_name'] ) ) { ?>

					<p class="rfbp-link-wrap">
						<a class="rfbp-link" href="<?php echo $p['link_url']; ?>" rel="external nofollow" target="<?php echo $link_target; ?>">
							<?php if ( !empty( $p['link_image'] ) && ( apply_filters( 'rfbp_show_link_images', true ) !== false ) ) { ?>
							<span class="rfbp-link-image-wrap">
								<img class="rfbp-link-image" src="<?php echo esc_attr( $p['link_image'] ); ?>" width="114" />
							</span>
							<?php } ?>

							<span class="rfbp-link-text-wrap">
								<span class="rfbp-link-name"><?php echo esc_html( $p['link_name'] ); ?></span>
								<?php if ( isset( $p['link_caption'] ) ) { ?><span class="rfbp-link-caption"><?php echo esc_html( $p['link_caption'] ); ?></span><?php } ?>
								<?php if ( isset( $p['link_description'] ) && !empty( $p['link_description'] ) ) { ?><span class="rfbp-link-description"><?php echo esc_html( $p['link_description'] ); ?></span><?php } ?>
							</span>
						</a>
					</p>

					<?php } ?>

					<?php if ( $opts['img_size'] !== 'dont_show' && isset( $p['image'] ) && ! empty( $p['image'] ) ) {

					// grab bigger video thumbnail (hacky)
					if ( $p['type'] === 'video' && $opts['img_size'] == 'normal' ) {
						$p['image'] = str_ireplace( array( "_s.jpg", "_s.png" ), array( "_n.jpg", "_n.png" ), $p['image'] );
					}

					?>
					<p class="rfbp-image-wrap">
						<a class="rfbp-image-link" target="<?php echo $link_target; ?>" href="<?php echo $p['url']; ?>" rel="external nofollow">
							<?php $max_img_width = ( ! empty( $opts['img_width'] ) ) ? $opts['img_width'].'px' : '100%'; $max_img_height = ( !empty( $opts['img_height'] ) ) ? $opts['img_height'].'px' : 'none'; ?>
							<img class="rfbp-image" src="<?php echo $p['image']; ?>" style="<?php echo esc_attr( "max-width: {$max_img_width}; max-height: {$max_img_height}" ); ?>" alt="" />
						</a>
						<?php if ( $p['type'] === 'video' ) { ?>
						<span class="rfbp-video-link"></span>
						<?php } ?>
					</p>
					<?php } ?>
					<p class="rfbp-post-link-wrap">
						<a target="<?php echo $link_target; ?>" class="rfbp-post-link" href="<?php echo esc_url( $p['url'] ); ?>" rel="external nofolloW">
							<?php if ( $atts['likes'] ) { ?><span class="rfbp-like-count"><?php echo absint( $p['like_count'] ); ?> <span><?php _e( "likes", 'recent-facebook-posts' ); ?><?php if ( $atts['comments'] ) { ?>, <?php } ?></span></span><?php } ?>
							<?php if ( $atts['comments'] ) { ?><span class="rfbp-comment-count"><?php echo absint( $p['comment_count'] ); ?> <span><?php _e( "comments", 'recent-facebook-posts' ); ?></span></span><?php } ?>
							<?php if ( $atts['likes'] || $atts['comments'] ) { ?> &sdot; <?php } ?>
							<span class="rfbp-timestamp" title="<?php printf( __( '%1$s at %2$s', 'recent-facebook-posts' ), date( 'l, F j, Y', $p['timestamp'] ), date( 'G:i', $p['timestamp'] ) ); ?>"><?php echo rfbp_time_ago( $p['timestamp'] ); ?></span>
						</a>
					</p>
					</<?php echo $atts['el']; ?>>
				<?php

			} // end foreach $posts

			// close list
			if ( $atts['el'] === 'li' ) {
				echo '</ul>';
			}

		} else {
			?><p><?php _e( "No recent Facebook posts to show", 'recent-facebook-posts' ); ?></p><?php
			if ( current_user_can( 'manage_options' ) ) {
				?><p><strong><?php _e( "Admins only notice", 'recent-facebook-posts' ); ?>:</strong> <?php printf( __( 'Did you <a href="%s">configure the plugin</a> properly?', 'recent-facebook-posts' ), admin_url( 'options-general.php?page=rfbp' ) ); ?></p><?php
			}
		} ?>

			<?php if ( $atts['show_page_link'] ) { ?>
				<p class="rfbp-page-link-wrap"><a class="rfbp-page-link" href="<?php echo esc_url( 'https://www.facebook.com/' . $opts['fb_id'] . '/' ); ?>" rel="external nofollow" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $opts['page_link_text'] ); ?></a></p>
			<?php } ?>

			</div>
			<!-- / Recent Facebook Posts -->
			<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}
