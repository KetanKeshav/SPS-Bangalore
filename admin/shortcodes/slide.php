<?php
/**
 * Slide
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes The slide used in the slideshow
 */
 
if (!function_exists('d2_slide')) {
	function d2_slide($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'orientation' => '',
			'title' => '',
			'subheading' => '',
			'href' => '',
			'background' => '',
			'position' => '',
			'color' => '',
			'overlay' => ''
		), $atts));
		
		if (!$background) {
			$image = 'http://fpoimg.com/1440x545';	
		} else {
			$image = wp_get_attachment_image_src( $background, 'full' );
			$image = $image[0];
		}
		
		//link construct 
    	$url = ($href=='||') ? '' : $href;
		$url = vc_build_link( $url );
		$a_link = $url['url'];
		$a_title = ($url['title'] == '') ? '' : 'title="'.$url['title'].'"';
		$a_target = ($url['target'] == '') ? '' : 'target="'.$url['target'].'"';
		$a_rel = ($url['rel'] == '') ? '' : 'rel="'.$url['rel'].'"';
		
		if (!$color) {
			$color = 'white';
		}
		
		if ($overlay == 'true') {
			$overlay_text = ' overlay';
		} else {
			$overlay_text = '';	
		}
		
		if (!$position) {
			$position = 'center center';
		}
		
		$button = $a_link ? '<a class="btn btn-primary" href="'.$a_link. '" '.$a_title.' '.$a_target.' '.$a_rel.'>'.$url['title'].'</a>' : '';
		
		if ($orientation == 'left' || $orientation == '') {
			$output = '<div class="slide '.$color.'" style="background-image: url('.$image.'); background-position: '.$position.'">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 content'.$overlay_text.'">
								<div class="inner-content">
									<h1>'.$title.'</h1>
									<h2>'.$subheading.'</h2>
									'.$button.'
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								
							</div>
						</div>
					</div>
				   </div>';
		} else {
			$output = '<div class="slide '.$color.'" style="background-image: url('.$image.');">
					<div class="container">
						<div class="col-lg-6 col-md-6 col-sm-12">
							
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 content'.$overlay_text.'">
								<div class="inner-content">
									<h1>'.$title.'</h1>
									<h2>'.$subheading.'</h2>
									'.$button.'
								</div>
							</div>
						</div>
					</div>
				   </div>';
		}
		
		return $output;		
	}
}
add_shortcode('ieee_slide', 'd2_slide');
?>