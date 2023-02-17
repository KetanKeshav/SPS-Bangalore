<?php
/**
 * Promoted
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Provides options to display a promoted call out box
 */
 
if (!function_exists('d2_promoted')) {
	function d2_promoted($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'title' => '',
			'background' => '',
			'image' => '',
			'css' => ''
		), $atts));
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		if ($background == 'true') {
			$overlay = ' overlay';
		} else {
			$overlay = '';	
		}
		
		if (!$image) {
			$bg_image = 'http://fpoimg.com/770x555';	
		} else {
			$bg_image = wp_get_attachment_image_src( $image, 'full' );	
			$bg_image = $bg_image[0];
		}
		
		if (isset($css_params[0])) {
			$output = '<div class="promoted'.$overlay.'" style="'.$css_params[0].'"><h3 class="boxed"><span>Promoted</span></h3><div class="promoted-content"><h5 class="title">'.$title.'</h5><img class="img-responsive" src="'.$bg_image.'"></div></div>';
		} else {
			$output = '<div class="promoted'.$overlay.'"><h3 class="boxed"><span>Promoted</span></h3><div class="promoted-content"><h5 class="title">'.$title.'</h5><img class="img-responsive" src="'.$bg_image.'"></div></div>';
		}
		
		
		
		return $output;		
	}
}
add_shortcode('ieee_promoted', 'd2_promoted');
?>