<?php
/**
 * Recent Post with Selected Category
 *
 * @package Hamza Lite
 */

add_action( 'widgets_init', 'register_recent_portfolio_widget' );

function register_recent_portfolio_widget() {
    register_widget( 'hamza_lite_recent_portfolio' );
}

class Hamza_Lite_Recent_Portfolio extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'hamza_lite_recent_portfolio',
			'8D : Hamza Lite Recent Portfolio',
			array(
				'description'	=> __( 'A widget that shows recent portfolio with selected category', 'hamza_lite' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'display_title' => array (
				'hamza_lite_widgets_name'			=> 'display_title',
				'hamza_lite_widgets_title'			=> __( 'Title', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'text'
			),
            'category_list' => array (
				'hamza_lite_widgets_name'			=> 'category_list',
				'hamza_lite_widgets_title'			=> __( 'Category', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'selectcat',
			),
            'number_of_post' => array (
				'hamza_lite_widgets_name'			=> 'number_of_post',
				'hamza_lite_widgets_title'			=> __( 'Number of Posts', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'number',
			)
		);
		return $fields;
	 }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$number_of_post		= ( $instance['number_of_post'] > 0 ) ? $instance['number_of_post'] : 3;
		$display_title		= $instance['display_title'];
        $category           = intval($instance['category_list']);
		$category           = ($category == 0) ? 1 : $category;
                              
        $recent_arg = array(
            'post_type'     => 'post',
            'cat'           => $category,
            'post_status'   => 'publish',
            'posts_per_page'=> $number_of_post
        );        
        $recent_qry = new WP_Query( $recent_arg );
        if($recent_qry->have_posts()){
            echo $before_widget;
            // Check if title needs to be shown
            if( isset( $display_title ) ){
                echo $before_title . $display_title . $after_title;
            }
            while($recent_qry->have_posts()){
                $recent_qry->the_post();
                $m_img_id = get_post_thumbnail_id();
                $m_img_url = wp_get_attachment_image_src( $m_img_id, 'hamza-lite-portfolio-thumbnail', true );
            ?>
            <div class="hamza_lite-recent-rightdivs clearfix">
                <?php if( has_post_thumbnail()){ ?>
                <div class="hamza_lite-recent-rightbar-img">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $m_img_url[0]; ?>" alt="<?php the_title();?>" /></a>
                </div>    
                <?php }else{ ?>
                <div class="hamza_lite-recent-rightbar-img">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri().'/images/image77by54.jpg'; ?>" alt="<?php the_title();?>" /></a>
                </div>
                <?php } ?>
            </div>            
            <?php
            }            
            echo $after_widget;            
        }
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	hamza_lite_widgets_updated_field_value()		defined in hamzalite-widget.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			extract( $widget_field );
			// Use helper function to get updated field values
			$instance[$hamza_lite_widgets_name] = hamza_lite_widgets_updated_field_value( $widget_field, $new_instance[$hamza_lite_widgets_name] );
			echo $instance[$hamza_lite_widgets_name];
		}
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	hamza_lite_widgets_show_widget_field() defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();
		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			// Make array elements available as variables
			extract( $widget_field );
			$hamza_lite_widgets_field_value = isset( $instance[$hamza_lite_widgets_name] ) ? esc_attr( $instance[$hamza_lite_widgets_name] ) : '';
			hamza_lite_widgets_show_widget_field( $this, $widget_field, $hamza_lite_widgets_field_value );
		}	
	}
}