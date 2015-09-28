<?php

/**
 * Hamza Lite Custom Widgets
 *
 * @package Hamza Lite 
 */

function hamza_lite_widgets_updated_field_value( $widget_field, $new_field_value ) {

	extract( $widget_field );

	// Allow only integers in number fields
	if( $hamza_lite_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	// Allow some tags in textareas
	} elseif( $hamza_lite_widgets_field_type == 'numbertext' ){
	   if( intval( $new_field_value ) ){
            return absint( $new_field_value );
        }else{
            return '200';
        }
	   
	}elseif( $hamza_lite_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $hamza_lite_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$hamza_lite_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $hamza_lite_widgets_allowed_tags );
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}
}

/**
 * Include helper functions that display widget fields in the dashboard
 *
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';

/**
 * Register Recent Post Widget
 *
 */
require get_template_directory() . '/inc/widgets/widget-recent-post.php';

/**
 * Register Recent Portfolio Widget
 *
 */
require get_template_directory() . '/inc/widgets/widget-recent-portfolio.php';

/**
 * Register Featured Post Widget
 *
 */
require get_template_directory() . '/inc/widgets/widget-featured-post.php';