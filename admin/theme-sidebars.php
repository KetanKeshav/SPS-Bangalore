<?php
/**
 * Theme Sidebars
 *
 * Adds theme sidebars
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
function d2_register_sidebars() {
	register_sidebar(array(
		'name' => __('Sidebar', 'ieee-dci'),
		'id'=> 'sidebar',
		'description' => 'Displayed on the side.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>')
	);
}
add_action( 'widgets_init', 'd2_register_sidebars' );
?>