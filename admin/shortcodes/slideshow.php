<?php
/**
 * Slideshow
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes The container for the slides in the slideshow
 */
 
if (!function_exists('d2_slideshow')) {
	function d2_slideshow($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'css' => '',
			'autoplay' => '',
			'timeout' => ''
		), $atts));
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
		} else {
			$css_params = '';	
		}
		
		if (!$autoplay) {
			$autoplay1 = 'false';
			$play_status = ' inactive';
			$pause_status = ' active';
		} else {
			$autoplay1 = 'true';
			$play_status = ' active';
			$pause_status = ' inactive';
		}
		
		if (!$timeout) {
			$timeout = '10000';
		} 
		
		$output = '<div class="slideshow-container">';
		
		if (isset($css_params[0])) {
			$output .= '<div class="slideshow" data-slick=\'{"autoplay": '.$autoplay1.', "autoplaySpeed": '.$timeout.'}\' style="'.$css_params[0].'">'.do_shortcode($content).'</div>';
		} else {
			$output .= '<div class="slideshow" data-slick=\'{"autoplay": '.$autoplay1.', "autoplaySpeed": '.$timeout.'}\'>'.do_shortcode($content).'</div>';
		}	
		
		$output .= '<div class="buttons"><button class="play'.$play_status.'"><i class="fa fa-play" aria-hidden="true"></i></button><button class="pause'.$pause_status.'"><i class="fa fa-pause" aria-hidden="true"></i></button></div>';
		
		$output .= '</div>';
		
		return $output;		
	}
}
add_shortcode('ieee_slideshow', 'd2_slideshow');
?>