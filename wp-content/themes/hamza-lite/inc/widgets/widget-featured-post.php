<?php
/**
 * Feautured Post
 *
 * @package Hamza Lite
 */

add_action( 'widgets_init', 'register_featured_post_widget' );

function register_featured_post_widget() {
    register_widget( 'hamza_lite_featured_post' );
}

class Hamza_Lite_Featured_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'hamza_lite_featured_post',
			'8D : Hamza Lite Featured Post',
			array(
				'description'	=> __( 'A widget that shows featued post.', 'hamza_lite' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(			
            'post_list' => array (
				'hamza_lite_widgets_name'			=> 'post_list',
				'hamza_lite_widgets_title'			=> __( 'Post', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'selectpost',
			),
            'read_more_text' => array (
				'hamza_lite_widgets_name'			=> 'read_more_text',
				'hamza_lite_widgets_title'			=> __( 'Read More Text', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'text'
			),
            'excerpt_character' => array (
				'hamza_lite_widgets_name'			=> 'excerpt_character',
				'hamza_lite_widgets_title'			=> __( 'Excerpt Character', 'hamza_lite' ),
				'hamza_lite_widgets_field_type'		=> 'numbertext'
			),
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
        $id   = intval($instance['post_list']);		
        $read_more	= $instance['read_more_text'];
        $excerpt_char = absint($instance['excerpt_character']);                                      
        
        $qry = new WP_Query( "p=$id" );
        if($qry->have_posts()){
            echo $before_widget;
           
            while($qry->have_posts()){
                $qry->the_post();
            ?>
            <div class="hamza-lite-featured clearfix">                
                <div class="hamza-lite-featured-content">
                    <?php echo $before_title . apply_filters('the_title', get_the_title()) . $after_title; ?>                    
                    <div class="hamza_lite-featured-excerpt"><?php echo hamza_lite_excerpt( get_the_content(), $excerpt_char );?></div>
                    <?php if($read_more){ ?>
                    <div class="hamza_lite-featured-readmore">
                        <a href="<?php the_permalink();?>" class="bttn" title="<?php the_title(); ?>"><?php echo $read_more; ?></a>
                    </div>
                    <?php } ?>
                </div>
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
	 * @uses	hamza_lite_widgets_show_widget_field()		defined in widget-fields.php
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