<?php
/**
 *
 * Hide Breadcrumbs
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes When checked will hide the page title
 */

function hide_breadcrumbs_add_custom_box() {
    $screens = array('page');
    foreach ( $screens as $screen ) {
        add_meta_box(
            'hide_breadcrumbs',
            __('Hide Breadcrumbs', 'ieee-dci'),
            'hide_breadcrumbs_inner_custom_box',
            $screen,
			'side',
			'high'
        );
    }
}
add_action( 'add_meta_boxes', 'hide_breadcrumbs_add_custom_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function hide_breadcrumbs_inner_custom_box( $post ) {
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'hide_breadcrumbs_inner_custom_box', 'hide_breadcrumbs_inner_custom_box_nonce' );
	
	/*
	* Use get_post_meta() to retrieve an existing value
	* from the database and use the value for the form.
	*/
	$hide_breadcrumbs = esc_attr(get_post_meta( $post->ID, '_hide_breadcrumbs', true ));
	?>
    <input type="checkbox" name="hide_breadcrumbs_value" <?php if ($hide_breadcrumbs) { ?>checked<?php } ?>> Yes, please hide them on this page.
	
<?php }

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function hide_breadcrumbs_save_postdata( $post_id ) {
  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['hide_breadcrumbs_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['hide_breadcrumbs_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'hide_breadcrumbs_inner_custom_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;  
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['hide_breadcrumbs_value'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_hide_breadcrumbs', $mydata );
}
add_action( 'save_post', 'hide_breadcrumbs_save_postdata' );
?>