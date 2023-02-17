<?php
/**
 * Button
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Provides options to display a promoted call out box
 */
 
if (!function_exists('d2_button')) {
	function d2_button($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type' => '',
			'color' => '',
			'block' => '',
			'href' => '',
			'css' => ''
		), $atts));
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		/*if ($type == 'button') {
			$action = 'button';
		} else {*/
			$action = 'a';
		//}
		
		if ($block) {
			$full_width = ' btn-block';	
		} else {
			$full_width = '';	
		}
		
		//link construct 
    	$url = ($href=='||') ? '' : $href;
		$url = vc_build_link( $url );
		$a_link = $url['url'];
		$a_title = ($url['title'] == '') ? '' : 'title="'.$url['title'].'"';
		$a_target = ($url['target'] == '') ? '' : 'target="'.$url['target'].'"';
		$a_rel = ($url['rel'] == '') ? '' : 'rel="'.$url['rel'].'"';
		
		if (isset($css_params[0])) {
			$output = $a_link ? '<'.$action.' class="btn '.$color.''.$full_width.'" href="'.$a_link. '" '.$a_title.' '.$a_target.' '.$a_rel.' style="'.$css_params[0].'">'.$url['title'].'</'.$action.'>' : '';
		} else {
			$output = $a_link ? '<'.$action.' class="btn '.$color.''.$full_width.'" href="'.$a_link. '" '.$a_title.' '.$a_target.' '.$a_rel.'>'.$url['title'].'</'.$action.'>' : '';
		}		
		
		return $output;		
	}
}
add_shortcode('ieee_button', 'd2_button');
?>