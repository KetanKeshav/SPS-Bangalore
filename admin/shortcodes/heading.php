<?php
/**
 * Heading
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Provides options to display a promoted call out box
 */
 
if (!function_exists('d2_heading')) {
	function d2_heading($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type' => '',
			'heading' => '',
			'text' => '',
			'class' => '',
			'css' => ''
		), $atts));
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		if (!$heading) {
			$heading = 'h1';
		}
		
		if (isset($css_params[0])) {
			$output = '<'.$heading.' class="'.$type.' '.$class.'" style="'.$css_params[0].'"><span>'.$text.'</span></'.$heading.'>';
		} else {
			$output = '<'.$heading.' class="'.$type.' '.$class.'"><span>'.$text.'</span></'.$heading.'>';
		}
		
		return $output;		
	}
}
add_shortcode('ieee_heading', 'd2_heading');
?>