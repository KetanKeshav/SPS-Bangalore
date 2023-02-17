<?php
/**
 * Social Share
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Outputs lists of social media platforms to share the current page on.
 */
 
if (!function_exists('d2_share')) {
	function d2_share($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type' => '',
			'color' => '',
			'block' => '',
			'href' => '',
			'css' => ''
		), $atts));
		
		global $post;
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		if (isset($css_params[0])) {
			$output = '<div class="social-share" style="'.$css_params[0].'">';
		} else {
			$output = '<div class="social-share">';
		}
		
		$output .= '<h4>Share this article</h4><div class="row">';
		
		
		
		$output .= '
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a target="_blank" href="https://twitter.com/home?status='.get_the_permalink($post->ID).'">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink($post->ID).'">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url='.get_the_permalink($post->ID).'&title='.get_the_title($post->ID).'&summary=&source=">
							<i class="fa fa-linkedin" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a target="_blank" href="http://www.addthis.com/bookmark.php">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
						</a>
					</div>
				   ';
		
		$output .= '</div></div>';		
		
		return $output;		
	}
}
add_shortcode('ieee_share', 'd2_share');
?>