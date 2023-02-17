<?php
/**
 * Posts
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 * @notes Provides options to display 'x' number of posts in different formats.
 */
 
if (!function_exists('d2_posts')) {
	function d2_posts($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'title' => '',
			'layout' => '',
			'show_date' => '',
			'show_category' => '',
			'show_excerpt' => '',
			'posts_per_page' => '',
			'order' => '',
			'post_type' => '',
			'category_name' => '',
			'tag' => '',
			'read_more_link' => '',
			'css' => ''
		), $atts));
		
		$output = '';
		
		if ($css) {
			preg_match_all('~\{([^}]*)\}~', $css, $matches);
			$css_params = $matches[1];
			
		} else {
			$css_params = '';	
		}
		
		if ($title) {
			if ($layout == 'simple') {
				$output .= '<h3 class="boxed simple"><span>'.$title .'</span></h3>';
			} else if ($layout == 'tiled3' || $layout == 'tiled2') {
				$output .= '<h3 class="boxed tiled"><span>'.$title .'</span>'.$tag.'</h3>';
			} else {
				$output .= '<h3 class="boxed"><span>'.$title .'</span></h3>';
			}
			
		}
		
		//link construct 
    	$url = ($read_more_link=='||') ? '' : $read_more_link;
		$url = vc_build_link( $url );
		$a_link = $url['url'];
		$a_title = ($url['title'] == '') ? '' : 'title="'.$url['title'].'"';
		$a_target = ($url['target'] == '') ? '' : 'target="'.$url['target'].'"';
		$a_rel = ($url['rel'] == '') ? '' : 'rel="'.$url['rel'].'"';
		
		$args = array(
			'posts_per_page' => $posts_per_page,
			'order' => $order,
			'post_type' => $post_type,
			'category_name' => $category_name,
			'tag' => $tag,
			'post_status' =>  'publish'
		);
		
		$post_data = new WP_Query( $args );
		if( $post_data->have_posts() ) {
			if ($layout == 'simple') {
				$output .= '<ul class="simple">';
			} else if ($layout == 'tiled2') {
				$output .= '<ul class="tiled row tiled-2">';	
			} else if ($layout == 'tiled3') {
				$output .= '<ul class="tiled row tiled-3">';	
			} else {
				$output .= '<ul>';	
			}			
			while ( $post_data->have_posts() ) {
				$post_data->the_post();	
				$post_title = get_the_title();
				if ($show_date == 'true') {
					$post_date = '<div class="date">'.get_the_date('d F Y').'</div>';
				} else {
					$post_date = '';	
				}
				if (has_post_thumbnail( get_the_ID() ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					$featured_image = $image[0];
				} else {
					$featured_image = 'http://fpoimg.com/370x278';	
				}
				$permalink = get_permalink();
				
				if ($layout == 'simple') {
					if ($show_category == 'true') {
						$categories = get_the_category( get_the_ID() );
						$separator = ', ';
						$category_list = '';
						if ( $categories ) {
							foreach( $categories as $category ) {
								$category_list .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
							}
						}	
						$output .= '<li><a href="'.$permalink.'">'.$post_title.'</a>'.$post_date.' <span class="category">'.trim( $category_list, $separator ).'</span></a></li>';
					} else if ($show_excerpt == 'true' && $show_category == '') {
						$excerpt = get_the_excerpt( get_the_ID() );
						$output .= '<li>
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-12">
												<a href="'.$permalink.'">'.$post_title.'</a>'.$post_date.'</a>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12">
												<p class="excerpt">'.$excerpt.'</p>
											</div>
										</div>
									</li>';
					} else {
						$output .= '<li><a href="'.$permalink.'">'.$post_title.'</a>'.$post_date.'</li>';
					}
				} else if ($layout == 'tiled3') {
					$posttags = get_the_tags();
					$tags = '';
					$count=0;;
					if ($posttags) {
						$tags .= '<ul class="tags">';
						foreach($posttags as $tag) {
							$count++;
							$tags .= '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
					$sep = ', ';
							if( $count > 1 ) break; //change the number to adjust the count
						}
						$tags .= '</ul>';
					}
					
					$output .= '<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="featured-image" style="background-image: url('.$featured_image.');">
										<div class="title">
											'.$tags.'
											<h4><a href="'.$permalink.'">'.$post_title.'</a></h4>
										</div>
									</div>
								</li>';	
				} else if ($layout == 'tiled2') {
					$posttags = get_the_tags();
					$tags = '';
					$count=0;;
					if ($posttags) {
						$tags .= '<ul class="tags">';
						foreach($posttags as $tag) {
							$count++;
							$tags .= '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
					$sep = ', ';
							if( $count > 1 ) break; //change the number to adjust the count
						}
						$tags .= '</ul>';
					}
					$output .= '<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="featured-image" style="background-image: url('.$featured_image.');">
										<div class="title">
											'.$tags.'
											<h4><a href="'.$permalink.'">'.$post_title.'</a></h4>
										</div>
									</div>
								</li>';	
				}
			}
			$output .= '</ul>';
			if ($a_link) {
				$output .= '<a href='.$a_link.' '.$a_title.' '.$a_target.' '.$a_rel.'" class="btn btn-primary btn-block more">See All '.$title.'</a>';	
			}
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
add_shortcode('ieee_posts', 'd2_posts');
?>