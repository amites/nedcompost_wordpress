<?php
/**
 * Hamza Lite Post Meta Box
 *
 * @package Hamza Lite
 */

function hamza_lite_metabox_scripts(){
    wp_enqueue_style( 'hamza_lite_style', get_template_directory_uri() . '/inc/css/admin.css' );
    wp_enqueue_script( 'hamza_lite_custom_js', get_template_directory_uri() . '/inc/js/custom.js', array( 'jquery' ) );
}
//script actions with page detection
add_action( 'admin_print_scripts-post.php', 'hamza_lite_metabox_scripts' );
add_action( 'admin_print_scripts-post-new.php', 'hamza_lite_metabox_scripts' );

add_action('add_meta_boxes', 'hamza_lite_add_sidebar_layout_box');

function hamza_lite_add_sidebar_layout_box()
{
    add_meta_box(
                 'hamza_lite_testimonail_designation', // $id
                 __('Testimonial Designation', 'hamza_lite'), // $title
                 'hamza_lite_testimonail_designation_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority
                 
    add_meta_box(
                 'hamza_lite_sidebar_layout', // $id
                 __('Sidebar Layout', 'hamza_lite' ), // $title
                 'hamza_lite_sidebar_layout_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'hamza_lite_sidebar_layout', // $id
                 __('Sidebar Layout', 'hamza_lite'), // $title
                 'hamza_lite_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority    
}


$hamza_lite_sidebar_layout = array(
        'left-sidebar' => array(
                        'value'     => 'left-sidebar',
                        'label'     => __( 'Left sidebar', 'hamza_lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'label' => __( 'Right sidebar<br/>(default)', 'hamza_lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                    ),
        'both-sidebar' => array(
                        'value'     => 'both-sidebar',
                        'label'     => __( 'Both Sidebar', 'hamza_lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/both-sidebar.png'
                    ),
       
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'label'     => __( 'No sidebar', 'hamza_lite' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                    )   

    );

function hamza_lite_sidebar_layout_callback()
{ 
global $post , $hamza_lite_sidebar_layout;
wp_nonce_field( basename( __FILE__ ), 'hamza_lite_sidebar_layout_nonce' ); 
?>

<table class="form-table">
<tr>
<td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template', 'hamza_lite'); ?></em></td>
</tr>

<tr>
<td>
<?php  
   foreach ($hamza_lite_sidebar_layout as $field) {  
                $hamza_lite_sidebar_metalayout = get_post_meta( $post->ID, 'hamza_lite_sidebar_layout', true ); ?>

                <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
                <input type="radio" name="hamza_lite_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $hamza_lite_sidebar_metalayout ); if(empty($hamza_lite_sidebar_metalayout) && $field['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>&nbsp;<?php echo $field['label']; ?>
                </label>
                </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
</td>
</tr>
</table>

<?php } 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function hamza_lite_save_sidebar_layout( $post_id ) { 
    global $hamza_lite_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'hamza_lite_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'hamza_lite_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach ($hamza_lite_sidebar_layout as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'hamza_lite_sidebar_layout', true); 
        $new = sanitize_text_field($_POST['hamza_lite_sidebar_layout']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'hamza_lite_sidebar_layout', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'hamza_lite_sidebar_layout', $old);  
        } 
     } // end foreach   
     
}
add_action('save_post', 'hamza_lite_save_sidebar_layout');

function hamza_lite_testimonail_designation_callback(){
    global $post;
    
    $cat_id = get_theme_mod('hamza_lite_testimonial_category');
        
    wp_nonce_field( basename( __FILE__ ), 'hamza_lite_testimonail_designation_nonce' ); 
    
    $hamza_lite_testimonail_designation = get_post_meta ( $post->ID, 'hamza_lite_testimonail_designation', true );
    ?>
    <input type="hidden" id="cat_id" value="<?php echo $cat_id; ?>" />
    <table class="form-table">
        <tr>
            <td ><?php _e('Add Designation', 'hamza_lite'); ?></td>
            <td><input type="text" size="50" name="hamza_lite_testimonail_designation" value="<?php echo $hamza_lite_testimonail_designation; ?>" /></td>
        </tr>
    
    </table>    
    <?php    
}

function hamza_lite_save_testimonail_designation( $post_id ){
    // Check if our nonce is set.
	if ( ! isset( $_POST['hamza_lite_testimonail_designation_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['hamza_lite_testimonail_designation_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

    // Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

    // Make sure that it is set.
	if ( ! isset( $_POST['hamza_lite_testimonail_designation'] ) ) {
		return;
	}

    

    // Sanitize user input.    
    $hamza_lite_testimonail_designation = sanitize_text_field( $_POST['hamza_lite_testimonail_designation'] );

	// Update the meta field in the database.
    update_post_meta( $post_id, 'hamza_lite_testimonail_designation', $hamza_lite_testimonail_designation );

}

add_action( 'save_post', 'hamza_lite_save_testimonail_designation' ); 