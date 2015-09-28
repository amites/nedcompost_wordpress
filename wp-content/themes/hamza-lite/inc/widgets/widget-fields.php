<?php
/**
 * Field to be displayed in the wp admin for widget
 * 
 * @package Hamza Lite
 */

function hamza_lite_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	
    // Store Categories in array
    $hamza_lite_catlist[0] = array(
        'value' => 0,
        'label' => '--choose--'
    );
    $args = array(
	   'type'      => 'post',	   
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 0,
	   'taxonomy'                 => 'category',	   
    );
    $hamza_lite_categories = get_categories($args); $j=1;
    foreach( $hamza_lite_categories as $hamza_lite_category ){
        $hamza_lite_catlist[$j] = array(
            'value' => $hamza_lite_category->term_id,
            'label' => $hamza_lite_category->name
        );
        $j++;
    }  
    
    // Store Posts in array
	$hamza_lite_postlist[0] = array(
		'value' => 0,
		'label' => '--choose--'
	);
	$arg = array('posts_per_page'   => -1);
	$hamza_lite_posts = get_posts($arg); $i = 1;
	foreach( $hamza_lite_posts as $hamza_lite_post ){ 
		$hamza_lite_postlist[$hamza_lite_post->ID] = array(
			'value' => $hamza_lite_post->ID,
			'label' => $hamza_lite_post->post_title
		);
		$i++;
	}

	extract( $widget_field );

	switch( $hamza_lite_widgets_field_type ) {
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<input class="widefat" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
            
        // Standard number text field
		case 'numbertext' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<input class="widefat" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>"><?php echo $athm_field_value; ?></textarea>
			</p>
			<?php
			break;

		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?></label>
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo $hamza_lite_widgets_title; 
				echo '<br />';
				foreach( $hamza_lite_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo $instance->get_field_id( $athm_option_name ); ?>"><?php echo $athm_option_title; ?></label>
					<br />
				<?php } ?>
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $hamza_lite_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo $athm_option_title; ?></option>
					<?php } ?>
				</select>
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
        
        // Select Number field
		case 'number' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label><br />
				<input name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

	    // Select Category field
		case 'selectcat' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $hamza_lite_catlist as $hamza_lite_single_cat ) { ?>
						<option value="<?php echo $hamza_lite_single_cat['value']; ?>" id="<?php echo $instance->get_field_id( $hamza_lite_single_cat['label'] ); ?>" <?php selected( $hamza_lite_single_cat['value'], $athm_field_value ); ?>><?php echo $hamza_lite_single_cat['label']; ?></option>
					<?php } ?>
				</select>
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
            
        // Select Post field
		case 'selectpost' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>"><?php echo $hamza_lite_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $hamza_lite_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $hamza_lite_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $hamza_lite_postlist as $hamza_lite_single_post ) { ?>
						<option value="<?php echo $hamza_lite_single_post['value']; ?>" id="<?php echo $instance->get_field_id( $hamza_lite_single_post['label'] ); ?>" <?php selected( $hamza_lite_single_post['value'], $athm_field_value ); ?>><?php echo $hamza_lite_single_post['label']; ?></option>
					<?php } ?>
				</select>
				<?php if( isset( $hamza_lite_widgets_description ) ) { ?>
				<br />
				<small><?php echo $hamza_lite_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
	}
}