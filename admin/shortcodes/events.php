<?php
/**
 * Events
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Display 'x' number of events.
 */
 
if (!function_exists('d2_events')) {
	function d2_events($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'posts_per_page' => '',
			'layout' => '',
			'href' => '',
			'css' => ''
		), $atts));
		
		$output = '';
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		if ($layout == 'single') {
			$column = 'col-lg-12 single';
		} else if ($layout == 'double') {
			$column = 'col-lg-6 col-md-6 col-sm-12 double';
		} else if ($layout == 'triple') {
			$column = 'col-lg-4 col-md-6 col-sm-12 triple';
		} else {
			$column = '';	
		}
	
		//link construct 
    	$url = ($href=='||') ? '' : $href;
		$url = vc_build_link( $url );
		$a_link = $url['url'];
		$a_title = ($url['title'] == '') ? '' : 'title="'.$url['title'].'"';
		$a_target = ($url['target'] == '') ? '' : 'target="'.$url['target'].'"';
		$a_rel = ($url['rel'] == '') ? '' : 'rel="'.$url['rel'].'"';
		
		$args = array(
			'posts_per_page' => $posts_per_page,
			'order' => 'ASC',
			'post_type' => 'tribe_events',
			'post_status' =>  'publish'
		);
		
		$post_data = new WP_Query( $args );
		if( $post_data->have_posts() ) {
			
			$output .= '<div class="recent-events"><h3 class="boxed"><span>Events</span></h3>';
			$output .= '<ul class="events row">';	
					
			while ( $post_data->have_posts() ) {
				$post_data->the_post();	
				$post_title = get_the_title();				
				$permalink = get_permalink();
				$venu_id = get_post_meta( get_the_ID(), '_EventVenueID', true );
				$venu_name = get_the_title( $venu_id );
				$venu_city = get_post_meta( $venu_id, '_VenueCity', true );
				$venu_country = get_post_meta( $venu_id, '_VenueCountry', true );
				$start_date = get_post_meta( get_the_ID(), '_EventStartDate', true );
				$start_date = new DateTime($start_date);
				$end_date = get_post_meta( get_the_ID(), '_EventEndDate', true );
				$end_date = new DateTime($end_date);
				if (date_format($start_date, 'd') == date_format($end_date, 'd')) {
					$date = date_format($start_date, 'd');
				} else {
					$date = date_format($start_date, 'd') .'-'. date_format($end_date, 'd');
				}	
				$output .= '<li class="'.$column.'">
								<div class="row date-loc">
									<div class="col-xs-1"></div>
									<div class="col-xs-4">
										<i class="fa fa-calendar" aria-hidden="true"></i>
										<div class="dates">'.$date.'</div>
										<div class="month-year">'.date_format($start_date, 'F Y').'</div>
									</div>
									<div class="col-xs-6">
										<i class="fa fa-map-o" aria-hidden="true"></i>
										<div class="name">'.$venu_name.'</div>
										<div class="loc">'.$venu_city.', '.$venu_country.'</div>
									</div>
									<div class="col-xs-1"></div>
								</div>
								<div class="row name">
									<div class="col-xs-1"></div>
									<div class="col-xs-10">
										<a href="'.$permalink.'">'.$post_title.'</a>
									</div>
									<div class="col-xs-1"></div>
								</div>
							</li>';
			}
			
			$output .= '</ul><a class="btn btn-primary btn-block" href="'.$a_link. '" '.$a_title.' '.$a_target.' '.$a_rel.'>See All Events</a></div>';
		}
		
		if (isset($css_params[0])) {
			return '<div class="posts" style="'.$css_params[0].'">'.$output.'</div>';
		} else {
			return '<div class="posts">'.$output.'</div>';
		}
		
		wp_reset_postdata();
		wp_die();
	}
}
add_shortcode('ieee_events', 'd2_events');
?>