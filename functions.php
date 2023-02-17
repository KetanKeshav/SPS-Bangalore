<?php
/**
 * Functions
 *
 * Adds custom functions to the WordPress install
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */ 

/*******************************
  Check if required plugins are installed
********************************/
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ieee_dci_register_required_plugins' );

function ieee_dci_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'               => 'WPBakery Page Builder', // The plugin name.
			'slug'               => 'js_composer', // The plugin slug (typically the folder name).
			'source'             => 'js_composer.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => 'Master Slider – Responsive Touch Slider',
			'slug'      => 'master-slider',
			'required'  => false,
		),
		array(
			'name'      => 'Team Members',
			'slug'      => 'team-members',
			'required'  => false,
		),
		array(
			'name'      => 'The Events Calendar',
			'slug'      => 'the-events-calendar',
			'required'  => false,
		),
		array(
			'name'      => 'WP SEO Structured Data Schema',
			'slug'      => 'wp-seo-structured-data-schema',
			'required'  => false,
		),
		array(
			'name'      => 'Yoast SEO',
			'slug'      => 'wordpress-seo',
			'required'  => false,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'ieee-dci',              // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => get_template_directory() . '/libs/plugins/', // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => 'The following plugins are recommended for use with this theme. If you decide not to use them, the packaged templates may not function as intended.', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '<p>The following plugins are recommended for use with this theme. If you decide not to use them, the packaged templates may not function as intended.</p>',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*******************************
  Insert page builder templates
********************************/
add_action( 'vc_load_default_templates_action','my_custom_template_for_vc' ); // Hook in
function my_custom_template_for_vc() {
  $data = array(); // Create new array
  $data['name'] = __( 'Home Page Template', 'ieee-dci' ); // Assign name for your custom template
  $data['weight'] = 0; // Weight of your template in the template list
  //$data['image_path'] = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) ); // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
  //$data['custom_class'] = ''; // CSS class name
  $data['content']  = <<<CONTENT
  [vc_row full_width="stretch_row_content_no_spaces" el_id="no-top-space"][vc_column][ieee_slideshow autoplay="Yes"][ieee_slide href="url:%23|title:Register%20Now||" position="top center" overlay="true" title="Register Today for Our Next Meeting" subheading="December 12th at 8pm, ABC Hall"][ieee_slide href="url:%23|title:Submit%20Now||" overlay="true" title="Submit Your Abstracts Today" subheading="Submission Deadline is January 2nd!"][/ieee_slideshow][/vc_column][/vc_row][vc_row][vc_column][ieee_posts title="Featured" layout="tiled3" posts_per_page="3" post_type="post" category_name="" tag="" read_more_link="|||" css=".vc_custom_1543441341901{margin-top: 40px !important;margin-bottom: 40px !important;}"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][ieee_posts title="News" layout="simple" show_date="true" show_category="true" posts_per_page="3" post_type="post" category_name="" tag="" read_more_link="url:%2Fcategory%2Fnews%2F|||" css=".vc_custom_1543443309388{margin-bottom: 60px !important;}"][ieee_promoted title="Save the Date! Next Meeting: January 15, 2019" background="true" css=".vc_custom_1548268167620{margin-bottom: 60px !important;}"][/vc_column][vc_column width="1/3"][ieee_heading text="Membership" heading="h3" type="boxed" css=".vc_custom_1538603213023{margin-bottom: 30px !important;}"][vc_row_inner el_class="gradient"][vc_column_inner][ieee_heading text="Become a Member" heading="h4"][vc_column_text el_class="small"]Sign up today to get involved in the State PES Chapter.[/vc_column_text][ieee_button color="btn-yellow" block="true" href="url:https%3A%2F%2Fwww.google.com|title:Join%20Our%20Chapter|target:%20_blank|rel:nofollow" text="Join Our Chapter" link="url:https%3A%2F%2Fwww.google.com||target:%20_blank|rel:nofollow" css=".vc_custom_1538758582854{margin-bottom: 45px !important;}"][/vc_column_inner][/vc_row_inner][ieee_heading text="Newsletter" heading="h3" type="boxed" css=".vc_custom_1538758424945{margin-bottom: 30px !important;}"][vc_row_inner el_class="gradient"][vc_column_inner][ieee_heading text="Subscribe to our Newsletter" heading="h4"][vc_column_text el_class="small"]Sign up to receive our monthly email newsletter.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
  
  vc_add_default_templates( $data );
  
  $data = array(); // Create new array
  $data['name'] = __( 'Home Page Template Alt', 'ieee-dci' ); // Assign name for your custom template
  $data['weight'] = 0; // Weight of your template in the template list
  //$data['image_path'] = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) ); // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
  //$data['custom_class'] = ''; // CSS class name
  $data['content']  = <<<CONTENT
  [vc_row full_width="stretch_row_content_no_spaces" el_id="no-top-space"][vc_column][ieee_slideshow css=".vc_custom_1539007084460{margin-bottom: 60px !important;}"][ieee_slide orientation="right" color="black" href="url:%23|title:Reserve%20Your%20Spot||" overlay="true" title="Register Today for the Next Meeting" subheading="January 12th at 7pm, ABC Hall. Light Refreshments to be Served"][/ieee_slideshow][/vc_column][/vc_row][vc_row][vc_column width="2/3"][ieee_posts title="Featured" layout="tiled2" posts_per_page="4" post_type="post" category_name="" tag=""][/vc_column][vc_column width="1/3"][ieee_heading text="Membership" heading="h3" type="boxed"][vc_row_inner el_class="gradient"][vc_column_inner][ieee_heading text="Become a Member" heading="h4" css=".vc_custom_1544106927372{margin-top: 30px !important;}"][vc_column_text el_class="small"]Sign up today to get involved in the State PES Chapter.[/vc_column_text][ieee_button color="btn-yellow" block="true" href="url:%23|title:Join%20IEEE||" type="a" css=".vc_custom_1539006926157{margin-bottom: 45px !important;}"][/vc_column_inner][/vc_row_inner][ieee_heading text="Get The Newsletter" heading="h3" type="boxed"][vc_row_inner el_class="gradient"][vc_column_inner][ieee_heading text="Subscribe to our Newsletter" heading="h4" css=".vc_custom_1539008491184{margin-top: 30px !important;}"][vc_column_text el_class="small"]Sign up to receive our monthly email newsletter.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][ieee_events posts_per_page="3" layout="triple" href="url:%23%23%23|||" css=".vc_custom_1539017780563{margin-top: 30px !important;margin-bottom: 60px !important;}"][ieee_posts title="News" layout="simple" show_category="true" posts_per_page="5" post_type="post" category_name="Featured,News" tag="" read_more_link="url:%23|||" css=".vc_custom_1539017465648{margin-bottom: 30px !important;}"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][ieee_heading text="Chapters" heading="h3" type="boxed" css=".vc_custom_1539017488235{margin-bottom: 30px !important;}"][ieee_heading text="Branches" heading="h3" type="boxed" css=".vc_custom_1539017658933{margin-top: 50px !important;margin-bottom: 30px !important;}"][/vc_column][vc_column width="1/3"][ieee_heading text="Leadership" heading="h3" type="boxed" css=".vc_custom_1539016100323{margin-bottom: 30px !important;}"][ieee_button color="btn-primary" block="true" href="url:%23|title:More%20About%20Leadership||" type="a" css=".vc_custom_1539016153592{margin-top: 30px !important;margin-bottom: 20px !important;}"][ieee_button color="btn-primary" block="true" href="url:%23|title:Vote%20on%20Leadership||" type="a"][ieee_heading text="Affinity Groups" heading="h3" type="boxed" css=".vc_custom_1539017403797{margin-top: 60px !important;margin-bottom: 10px !important;}"][vc_column_text el_class="gradient"]</p>
<ul>
<li>Circuitry Affinity Group</li>
<li>Robotics Affinity Group</li>
<li>Section Young Professionals</li>
</ul>
<p>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
  
  vc_add_default_templates( $data );
  
  $data = array(); // Create new array
  $data['name'] = __( 'Content Template', 'ieee-dci' ); // Assign name for your custom template
  $data['weight'] = 0; // Weight of your template in the template list
  //$data['image_path'] = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) ); // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
  //$data['custom_class'] = ''; // CSS class name
  $data['content']  = <<<CONTENT
  [vc_row][vc_column width="1/4"][/vc_column][vc_column width="3/4"][ieee_heading text="Suspendisse rhoncus tellis interdum velit." heading="h2"][vc_column_text]Felis imperdiet proin fermentum leo. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Vel facilisis volutpat est velit egestas dui. At tellus at urna condimentum mattis pellentesque id. Eget magna fermentum iaculis eu non diam.

Adipiscing at in tellus integer feugiat scelerisque varius morbi. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum a. Luctus venenatis lectus magna fringilla. Habitasse platea dictumst vestibulum rhoncus est pellentesque. Aliquam etiam erat velit scelerisque in. Eu sem integer vitae justo. Convallis tellus id interdum velit laoreet. In pellentesque massa placerat duis ultricies lacus sed. Volutpat diam ut venenatis tellus in. Sed cras ornare arcu dui vivamus arcu felis. Id ornare arcu odio ut sem nulla pharetra diam. Et magnis dis parturient montes nascetur.

Ut venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Turpis egestas maecenas pharetra convallis posuere morbi leo urna molestie. Nunc aliquet bibendum enim facilisis gravida neque convallis a. Suspendisse potenti nullam ac tortor. Enim neque volutpat ac tincidunt vitae semper quis lectus nulla. Dictum non consectetur a erat nam. Sem et tortor consequat id porta nibh. Nisi quis eleifend quam adipiscing. Arcu odio ut sem nulla pharetra diam sit. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][ieee_heading text="A Message from the President" heading="h2"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="1/6"][vc_single_image img_size="full" css=".vc_custom_1538407926550{margin-bottom: 25px !important;}"][ieee_heading text="Marie Alvarado" heading="h4" class="text-right primary"][vc_column_text el_class="small text-right"]<strong>University of Missouri</strong>[/vc_column_text][/vc_column][vc_column width="2/3"][vc_column_text]Felis imperdiet proin fermentum leo. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing.

Vel facilisis volutpat est velit egestas dui. At tellus at urna condimentum mattis pellentesque id. Eget magna fermentum iaculis eu non diam.

Adipiscing at in tellus integer feugiat scelerisque varius morbi. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum a. Luctus venenatis lectus magna fringilla. Habitasse platea dictumst vestibulum rhoncus est pellentesque. Aliquam etiam erat velit scelerisque in. Eu sem integer vitae justo. Convallis tellus id interdum velit laoreet. In pellentesque massa placerat duis ultricies lacus sed. Volutpat diam ut venenatis tellus in.[/vc_column_text][/vc_column][/vc_row][vc_row content_placement="middle" css=".vc_custom_1538417558502{margin-top: 32px !important;margin-bottom: 55px !important;}" el_class="border-top border-bottom"][vc_column width="1/4"][vc_icon icon_fontawesome="fa fa-map-o" size="xs" css=".vc_custom_1538598838316{padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 20px !important;padding-left: 10px !important;}"][ieee_heading text="Nokia Bell Labs" heading="h4"][vc_column_text el_class="small"]600 Mountain Ave,
New Providence, NJ 07974[/vc_column_text][vc_icon icon_fontawesome="fa fa-phone" size="xs" css=".vc_custom_1538598841988{padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 20px !important;padding-left: 10px !important;}"][vc_column_text el_class="small"]+1 732 562 6820[/vc_column_text][vc_icon icon_fontawesome="fa fa-envelope-open-o" size="xs" css=".vc_custom_1538598846096{padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 20px !important;padding-left: 10px !important;}"][vc_column_text el_class="small"]<a href="mailto:pes-northjersey@ieee.org">pes-northjersey@ieee.org</a>[/vc_column_text][/vc_column][vc_column width="3/4"][vc_single_image img_size="full" css=".vc_custom_1538422082951{margin-right: -15px !important;}"][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces"][vc_column][vc_column_text css=".vc_custom_1538762736712{margin-top: 60px !important;}"][masterslider id="1"][/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][vc_separator][/vc_column][/vc_row][vc_row][vc_column width="2/3"][ieee_heading text="Suspendisse rhoncus tellis interdum velit" heading="h2"][vc_column_text]Felis imperdiet proin fermentum leo. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Vel facilisis volutpat est velit egestas dui. At tellus at urna condimentum mattis pellentesque id. Eget magna fermentum iaculis eu non diam.

Adipiscing at in tellus integer feugiat scelerisque varius morbi. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum a. Luctus venenatis lectus magna fringilla. Habitasse platea dictumst vestibulum rhoncus est pellentesque. Aliquam etiam erat velit scelerisque in. Eu sem integer vitae justo. Convallis tellus id interdum velit laoreet. In pellentesque massa placerat duis ultricies lacus sed. Volutpat diam ut venenatis tellus in. Sed cras ornare arcu dui vivamus arcu felis. Id ornare arcu odio ut sem nulla pharetra diam. Et magnis dis parturient montes nascetur.

Ut venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Turpis egestas maecenas pharetra convallis posuere morbi leo urna molestie. Nunc aliquet bibendum enim facilisis gravida neque convallis a. Suspendisse potenti nullam ac tortor. Enim neque volutpat ac tincidunt vitae semper quis lectus nulla. Dictum non consectetur a erat nam. Sem et tortor consequat id porta nibh. Nisi quis eleifend quam adipiscing. Arcu odio ut sem nulla pharetra diam sit. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt.[/vc_column_text][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="1/4" el_class="sidebar sidebar-right"][ieee_heading text="Sidebar" heading="h3" css=".vc_custom_1539024858782{margin-bottom: 20px !important;}"][vc_column_text]<a href="#">Augue ut lectus arcu bibendum</a>

<a href="#">Purus in massa tempor nec feugiat nisl pretium fusce</a>[/vc_column_text][/vc_column][/vc_row]
CONTENT;
  
  vc_add_default_templates( $data );
}


 
/*******************************
  Disable some VC elements
********************************/
add_action( 'vc_before_init', 'ieee_dci_vcSetAsTheme' );
function ieee_dci_vcSetAsTheme() {
  vc_set_as_theme();
}

add_action( 'vc_after_init', 'vc_after_init_actions' ); 
function vc_after_init_actions() {     
    // Remove VC Elements
    if( function_exists('vc_remove_element') ){          
        // Remove VC Button Element
        vc_remove_element( 'vc_btn' ); 
		// Remove VC Custom Heading
        vc_remove_element( 'vc_custom_heading' );
		// Remove VC Facebook
        vc_remove_element( 'vc_facebook' );
		// Remove VC Tweetmeme
        vc_remove_element( 'vc_tweetmeme' );
		// Remove VC google plus
        vc_remove_element( 'vc_googleplus' );
		// Remove VC Pinterest
        vc_remove_element( 'vc_pinterest' );
		// Remove VC Progress Bar
        vc_remove_element( 'vc_progress_bar' );
		// Remove VC Flickr
        vc_remove_element( 'vc_flickr' );	
    }     
}
 
/*******************************
  Add shortcodes to VC
********************************/
if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {	
	// Create multi dropdown param type
	vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
	function dropdown_multi_settings_field( $param, $value ) {
	   $param_line = '';
	   $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
	   foreach ( $param['value'] as $text_val => $val ) {
		   if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
						$text_val = $val;
					}
					$text_val = __($text_val, "js_composer");
					$selected = '';
	
					if(!is_array($value)) {
						$param_value_arr = explode(',',$value);
					} else {
						$param_value_arr = $value;
					}
	
					if ($value!=='' && in_array($val, $param_value_arr)) {
						$selected = ' selected="selected"';
					}
					$param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
				}
	   $param_line .= '</select>';
	
	   return  $param_line;
	}	
	add_action( 'init', 'shortcodes_integrateWithVC' );
	function shortcodes_integrateWithVC() {
		$categories_array = array();
		$categories = get_categories();
		foreach( $categories as $category ){
		  $categories_array[] = $category->name;
		}
		
		$tags_array = array();
		$tags = get_tags();
		foreach( $tags as $tag ){
		  $tags_array[] = $tag->name;
		}
		
		vc_map( array(
			"name" => __("Social Share", "ieee-dci"),
			"base" => "ieee_share",
			"category" => __( "IEEE Elements", "ieee-dci"),
			"description" => __( "Add a a social share block.", "ieee-dci" ),
			"show_settings_on_create" => false,
			"custom_markup" => "Social Share",
			"params" => array(
				array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
				),
			)
		) );
		
		vc_map( array(
			"name" => __("Recents Events", "ieee-dci"),
			"base" => "ieee_events",
			"class" => "ieee-vc",
			"category" => __( "IEEE Elements", "ieee-dci"),
			"description" => __( "Add a list of recent events.", "ieee-dci" ),
			"custom_markup" => "<strong>Recent Events</strong>",
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of Posts", "ieee-dci" ),
					"param_name" => "posts_per_page",
					"value" => __( "", "ieee-dci" ),
					"description" => __( "Example: 3, 5, 20", "ieee-dci" )
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", "ieee-dci" ),
					"param_name" => "layout",
					"value" => "single",
					'value' => array(
						__( '',  "ieee-dci"  ) => '',
						__( '1 Column',  "ieee-dci"  ) => 'single',
						__( '2 Column',  "ieee-dci"  ) => 'double',
						__( '3 Column',  "ieee-dci"  ) => 'triple'
					),
					"description" => __( "", "ieee-dci" )
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS', 'ieee-dci' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'ieee-dci' ),
				),
				array(
					"type" => "vc_link",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link", "ieee-dci" ),
					"param_name" => "href",
					"value" => __( "", "ieee-dci" ),
					"description" => __( "Provide the text on the button and the URL where the button will go.", "ieee-dci" )
				)
			)
		) );
	
		vc_map( array(
			"name" => __("Slideshow", "ieee-dci"),
			"base" => "ieee_slideshow",
			"class" => "ieee-vc",
			"category" => __( "IEEE Elements", "ieee-dci"),
			"description" => __( "Add a slideshow.", "ieee-dci" ),
			"as_parent" => array('only' => 'ieee_slide'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"is_container" => true,
			"js_view" => 'VcColumnView',
			//"custom_markup" => "Slideshow",
			"params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", "ieee-dci" ),
					"param_name" => "autoplay",
					'value' => array(
						__( 'No',  "ieee-dci"  ) => 'No',
						__( 'Yes',  "ieee-dci"  ) => 'Yes'
					  ),
					"description" => __( "Would you like the slideshow to autplay?", "ieee-dci" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Milliseconds between slides", "ieee-dci" ),
					"param_name" => "timeout",
					"description" => __( "Defaults to 10000 (10 seconds)", "ieee-dci" )
				),
				array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
				),
			)
		) );
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_Ieee_Slideshow extends WPBakeryShortCodesContainer {
			}
		}
		
		vc_map( array(
			"name" => __("Slideshow Slide", "ieee-dci"),
			"base" => "ieee_slide",
			"class" => "ieee-vc",
			"content_element" => true,
			//"custom_markup" => "Slideshow Slide",
			"as_child" => array('only' => 'ieee_slideshow'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Orientation", "ieee-dci" ),
					"param_name" => "orientation",
					'value' => array(
						__( '',  "ieee-dci"  ) => '',
						__( 'Left',  "ieee-dci"  ) => 'left',
						__( 'Right',  "ieee-dci"  ) => 'right'
					  ),
					"description" => __( "What side would you like the content to be on?", "ieee-dci" )
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Font Color", "ieee-dci" ),
					"param_name" => "color",
					'value' => array(
						__( '',  "ieee-dci"  ) => '',
						__( 'White',  "ieee-dci"  ) => 'white',
						__( 'Black',  "ieee-dci"  ) => 'black'
					  ),
					"description" => __( "", "ieee-dci" )
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "my-text-domain"),
					"param_name" => "title",
					"description" => __("Add the title of the slide", "ieee-dci")
				),
				array(
					"type" => "textfield",
					"heading" => __("Subheading", "my-text-domain"),
					"param_name" => "subheading",
					"description" => __("Add the subheading of the slide", "ieee-dci")
				),
				array(
					"type" => "vc_link",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link", "ieee-dci" ),
					"param_name" => "href",
					"value" => __( "", "ieee-dci" ),
					"description" => __( "Provide the text on the button and the URL where the button will go.", "ieee-dci" )
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Image", "ieee-dci" ),
					"param_name" => "background",
					"value" => __( "", "ieee-dci" ),
					"description" => __( "Choose an image used in the background of the slide.", "ieee-dci" )
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Position", "ieee-dci" ),
					"param_name" => "position",
					'value' => array(
						__( '',  "ieee-dci"  ) => '',
						__( 'Center Center',  "ieee-dci"  ) => 'center center',
						__( 'Top Center',  "ieee-dci"  ) => 'top center',
						__( 'Bottom Center',  "ieee-dci"  ) => 'bottom center',
						__( 'Top Left',  "ieee-dci"  ) => 'top left',
						__( 'Top Right',  "ieee-dci"  ) => 'top right',
						__( 'Bottom Left',  "ieee-dci"  ) => 'bottom left',
						__( 'Bottom Right',  "ieee-dci"  ) => 'bottom right'
					  ),
					"description" => __( "", "ieee-dci" )
				),
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Color", "ieee-dci" ),
					"param_name" => "overlay",
					"value" => __( "", "ieee-dci" ),
					"description" => __( "Do you want the content area to have a primary color background to it?", "ieee-dci" )
				),
			)
		) );
		
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Slideshow_Slide extends WPBakeryShortCode {
			}
		}
		
		vc_map( array(
		  "name" => __( "Heading", "ieee-dci" ),
		  "admin_enqueue_css" => get_template_directory_uri()."/css/styles.css",
		  "base" => "ieee_heading",
		  "class" => "ieee-vc",
		  "icon" => "",
		  "category" => __( "IEEE Elements", "ieee-dci"),
		  "description" => __( "Display a heading.", "ieee-dci" ),
		  //"custom_markup" => "Heading",
		  "params" => array(
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Heading Text", "ieee-dci" ),
				"param_name" => "text",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "The text you want displayed in the heading.", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Heading", "ieee-dci" ),
				"param_name" => "heading",
				'value' => array(
					__( 'H1',  "ieee-dci"  ) => 'h1',
					__( 'H2',  "ieee-dci"  ) => 'h2',
					__( 'H3',  "ieee-dci"  ) => 'h3',
					__( 'H4',  "ieee-dci"  ) => 'h4',
				  ),
				"description" => __( "", "ieee-dci" )
			 ),
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Class", "ieee-dci" ),
				"param_name" => "class",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Add additional classes. Example: text-right", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Type", "ieee-dci" ),
				"param_name" => "type",
				'value' => array(
					__( '',  "ieee-dci"  ) => '',
					__( 'Boxed',  "ieee-dci"  ) => 'boxed'
				  ),
				"description" => __( "The boxed options will put a blue border around it. Only works with H3 heading.", "ieee-dci" )
			 ),
			 array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
			 ),
		  )
		) );
		
		vc_map( array(
		  "name" => __( "Button", "ieee-dci" ),
		  "base" => "ieee_button",
		  "class" => "ieee-vc",
		  "icon" => "",
		  "category" => __( "IEEE Elements", "ieee-dci"),
		  "description" => __( "Display a button link.", "ieee-dci" ),
		  //"custom_markup" => "Button",
		  "params" => array(
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Color", "ieee-dci" ),
				"param_name" => "color",
				'value' => array(
					__( '',  "ieee-dci"  ) => '',
					__( 'Primary',  "ieee-dci"  ) => 'btn-primary',
					__( 'Yellow',  "ieee-dci"  ) => 'btn-yellow'
				  ),
				"description" => __( "", "ieee-dci" )
			 ),
			 array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Full-Width", "ieee-dci" ),
				"param_name" => "block",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Do you want the button to fill up the area?", "ieee-dci" )
			 ),
			 array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Link", "ieee-dci" ),
				"param_name" => "href",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Provide the text on the button and the URL where the button will go.", "ieee-dci" )
			 ),
			 array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
			 ),
		  )
		) );
		
		vc_map( array(
		  "name" => __( "Promoted", "ieee-dci" ),
		  "base" => "ieee_promoted",
		  "class" => "ieee-vc",
		  "icon" => "",
		  "category" => __( "IEEE Elements", "ieee-dci"),
		  "description" => __( "Display a promoted block of content.", "ieee-dci" ),
		  //"custom_markup" => "Promoted",
		  "params" => array(
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Content", "ieee-dci" ),
				"param_name" => "title",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "", "ieee-dci" )
			 ),
			 array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Image", "ieee-dci" ),
				"param_name" => "image",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Choose an image used in the background of the promoted block.", "ieee-dci" )
			 ),
			 array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Overlay", "ieee-dci" ),
				"param_name" => "background",
				"value" => __( "Yes", "ieee-dci" ),
				"description" => __( "Would you like to have a background on the text?", "ieee-dci" )
			 ),
			 array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
			 ),
		  )
		) );
		
		vc_map( array(
		  "name" => __( "Recent Posts", "ieee-dci" ),
		  "base" => "ieee_posts",
		  "class" => "ieee-vc",
		  "icon" => "",
		  "category" => __( "IEEE Elements", "ieee-dci"),
		  "description" => __( "Display list of recent posts.", "ieee-dci" ),
		  //"custom_markup" => "Recent Posts",
		  "params" => array(
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "ieee-dci" ),
				"param_name" => "title",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Example: News, Featured", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Layout", "ieee-dci" ),
				"param_name" => "layout",
				"value" => "simple",
				'value' => array(
					__( '',  "ieee-dci"  ) => '',
					__( 'Simple',  "ieee-dci"  ) => 'simple',
					__( 'Tiled 3 Column',  "ieee-dci"  ) => 'tiled3',
					__( 'Tiled 2 Column',  "ieee-dci"  ) => 'tiled2'
	
				),
				"description" => __( "", "ieee-dci" )
			 ),
			 array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Show Date", "ieee-dci" ),
				"param_name" => "show_date",
				"value" => __( "Yes", "ieee-dci" ),
				"description" => __( "Only shown in the 'Simple' layout.", "ieee-dci" )
			 ),
			 array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Show Category", "ieee-dci" ),
				"param_name" => "show_category",
				"value" => __( "Yes", "ieee-dci" ),
				"description" => __( "Only shown in the 'Simple' layout.", "ieee-dci" )
			 ),
			 array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Show Excerpt", "ieee-dci" ),
				"param_name" => "show_excerpt",
				"value" => __( "Yes", "ieee-dci" ),
				"description" => __( "Only shown in the 'Simple' layout and if category is not shown.", "ieee-dci" )
			 ),
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Number of Posts", "ieee-dci" ),
				"param_name" => "posts_per_page",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Example: 3, 5, 20", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Order By", "ieee-dci" ),
				"param_name" => "order",
				'value' => array(
					__( 'DESC',  "ieee-dci"  ) => 'DESC',
					__( 'ASC',  "ieee-dci"  ) => 'ASC',
				  ),
				"description" => __( "Choose to show most recent or oldest first.", "ieee-dci" )
			 ),
			 array(
				"type" => "posttypes",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Post Type", "ieee-dci" ),
				"param_name" => "post_type",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown_multi",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Categories", "ieee-dci" ),
				"param_name" => "category_name",
				"value" => $categories_array,
				"description" => __( "Choose the categories you would like to show posts from.", "ieee-dci" )
			 ),
			 array(
				"type" => "dropdown_multi",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Tags", "ieee-dci" ),
				"param_name" => "tag",
				"value" => $tags_array,
				"description" => __( "Choose the tags you would like to show posts from.", "ieee-dci" )
			 ),
			 array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Link", "ieee-dci" ),
				"param_name" => "read_more_link",
				"value" => __( "", "ieee-dci" ),
				"description" => __( "Provide the URL where the 'See All' button will go.", "ieee-dci" )
			 ),
			 array(
				'type' => 'css_editor',
				'heading' => __( 'CSS', 'ieee-dci' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'ieee-dci' ),
			 ),
		  )
		) );
	}
}


 
/*******************************
  Change FROM email
********************************/	
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');

function new_mail_from($old) {
 return 'noreply@d2creative.com';
}
function new_mail_from_name($old) {
 return 'noreply@d2creative.com';
}

/*******************************
  Configure title tag
********************************/	
function d2_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ieee-dci' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'd2_wp_title', 10, 2 );

/*******************************
  Move scripts to footer
********************************/	
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
   
 
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
} 
//add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

/*******************************
  Add classes to the next and previous post links
********************************/ 
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn-default btn-block show-more"';
}
 
/*******************************
  Allow .svg uploads in media manager
********************************/ 
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
 
/*******************************
  Hide the admin bar
********************************/ 
//show_admin_bar(false);
 
/*******************************
  Localization
********************************/ 
load_theme_textdomain('ieee-dci', get_template_directory() . '/languages');
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if(is_readable($locale_file)) require_once($locale_file); 
 
/*******************************
  Theme Information
********************************/
$themename = get_option('current_theme'); // Theme Name
$dirname = strtolower(str_replace(' ', '-', get_option('current_theme'))); // Directory Name

/*******************************
  File Directories
********************************/
define("d2", get_template_directory() . '/');
define("d2_inc", get_template_directory() . '/includes/');
define("d2_scripts", get_template_directory() . '/js/');
define("d2_admin", get_template_directory() . '/admin/');
define("D2_THEME_URL", get_template_directory_uri());

/*******************************
  Additional Function
********************************/
//meta options
require_once(d2_admin.'theme-meta-options.php');
//sidebars
require_once(d2_admin.'theme-sidebars.php');
//widget
require_once(d2_admin.'theme-widgets.php');
//shortcodes
require_once(d2_admin.'theme-shortcodes.php');

/*******************************
  Enqueue Styles
********************************/
function d2_enqueue_styles() { 
	if(!is_admin()){
		global $dirname;
		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Open+Sans:400,700');
		wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/libs/bootstrap.min.css');
		wp_enqueue_style('bootstrap-theme', get_template_directory_uri().'/css/libs/bootstrap-theme.min.css');
		//if (is_front_page()) {
			wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/libs/font-awesome.min.css');
		//}
		wp_enqueue_style('slick', get_template_directory_uri().'/css/libs/slick.css');
		//wp_enqueue_style('bootstrap-select', get_template_directory_uri().'/css/libs/bootstrap-select.css');
		wp_enqueue_style('style', get_template_directory_uri().'/style.css');
		wp_enqueue_style('styles', get_template_directory_uri().'/css/styles.css','','1.3','');
		$theme_chooser = get_theme_mod( 'ieee-dci_theme_chooser' );
		if ($theme_chooser['color_scheme'] == 'green') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/green.css');
		}
		if ($theme_chooser['color_scheme'] == 'midnight') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/midnight.css');
		}
		if ($theme_chooser['color_scheme'] == 'magenta') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/magenta.css');
		}
		if ($theme_chooser['color_scheme'] == 'turqouise') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/turqouise.css');
		}
		if ($theme_chooser['color_scheme'] == 'red') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/red.css');
		}
		if ($theme_chooser['color_scheme'] == 'orange') {
			wp_enqueue_style('theme-styles', get_template_directory_uri().'/css/orange.css');
		}
		
		if ($theme_chooser['style_scheme'] == 'style_a') {
			//wp_enqueue_style('theme-styles-style', get_template_directory_uri().'/css/style-a.css');
			add_filter( 'body_class', function( $classes ) {
				return array_merge( $classes, array( 'style-a' ) );
			} );
		}		
		if ($theme_chooser['style_scheme'] == 'style_b') {
			//wp_enqueue_style('theme-styles-style', get_template_directory_uri().'/css/style-b.css');
			add_filter( 'body_class', function( $classes ) {
				return array_merge( $classes, array( 'style-b' ) );
			} );
		}		
		if ($theme_chooser['style_scheme'] == 'style_c') {
			//wp_enqueue_style('theme-styles-style', get_template_directory_uri().'/css/style-c.css');
			add_filter( 'body_class', function( $classes ) {
				return array_merge( $classes, array( 'style-c' ) );
			} );
		}
	}
}
add_action('wp_enqueue_scripts', 'd2_enqueue_styles');

/*******************************
  Enqueue Scripts
********************************/
function d2_enqueue_scripts() { 
	if(!is_admin()){
		global $dirname;
		//wp_enqueue_script('bootstrap-select', get_template_directory_uri().'/js/libs/bootstrap-select.js',array('jquery'),'',true);
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/libs/bootstrap.min.js',array('jquery'),'',true);
		wp_enqueue_script('slick', get_template_directory_uri().'/js/libs/slick.min.js',array('jquery'),'',true);
		wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js',array('jquery'),'1',true);
		wp_enqueue_script('retina', get_template_directory_uri().'/js/libs/retina.min.js',array('jquery'),'',true);
	}
	
	/*if (is_admin()) {
		wp_enqueue_script( 'admin-scripts', get_template_directory_uri() . '/admin/js/scripts.js', array('jquery'), '1.0' );
	}*/
}
add_action('wp_enqueue_scripts', 'd2_enqueue_scripts');

function enqueue_admin_script() {
	wp_enqueue_script( 'admin-scripts', get_template_directory_uri() . '/admin/js/scripts.js', array('jquery'), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_script' );

/*******************************
  Move the JavaScript to footer, unqueue WP's jQuery and register Google's CDN
********************************/
if (!is_admin()) {
	function my_jquery_enqueue() {
		wp_enqueue_script('jquery');
	}
	//add_action('wp_enqueue_scripts', 'my_jquery_enqueue', 11);
}

/*******************************
  WP Header Hooks
********************************/
function d2_wp_header() {
	global $post, $dirname;
	
	if (get_option($dirname.'_apple_icon')) {
		echo '<link rel="apple-touch-icon" href="'.get_option($dirname.'_apple_icon').'" />';
	}
	
	$theme_chooser = get_theme_mod( 'ieee-dci_theme_chooser' );
	if ($theme_chooser['color_scheme']) {
		echo '
			<style>
				header#header #main-nav #social-links-mobile a.ico-collabratec {
					background: url('.get_template_directory_uri().'/images/ft-ct-'.$theme_chooser['color_scheme'].'-logo.png) no-repeat 0 0;
				}
			</style>
		 ';
	}
	if ($theme_chooser['style_scheme'] == 'style_a') {
		if ($theme_chooser['color_scheme']) {
			echo '
					<style>
						header#header {
							background-image: url('.get_template_directory_uri().'/images/style-a/header-bkg-'.$theme_chooser['color_scheme'].'.png);
							background-repeat: repeat-x;
							background-position: 100% center;
						}
						footer#colophon {
							background-image: url('.get_template_directory_uri().'/images/style-a/footer-bkg-white.png);
							background-repeat:  no-repeat;
							background-position: 100% center;	
						}
					</style>
				 ';
		}
	}		
	if ($theme_chooser['style_scheme'] == 'style_b') {
		if ($theme_chooser['color_scheme']) {
			echo '
					<style>
						header#header {
							background-image: url('.get_template_directory_uri().'/images/style-b/header-bkg-'.$theme_chooser['color_scheme'].'.png);
							background-repeat: repeat-x;
							background-position: 100% center;
						}
						footer#colophon {
							background-image: url('.get_template_directory_uri().'/images/style-b/footer-bkg-white.png);
							background-repeat:  no-repeat;
							background-position: 100% center;	
						}
					</style>
				 ';
		}
	}		
	if ($theme_chooser['style_scheme'] == 'style_c') {
		if ($theme_chooser['color_scheme']) {
			echo '
					<style>
						header#header {
							background-image: url('.get_template_directory_uri().'/images/style-c/header-bkg-'.$theme_chooser['color_scheme'].'.png);
							background-repeat: repeat-x;
							background-position: 100% center;
						}
						footer#colophon {
							background-image: url('.get_template_directory_uri().'/images/style-c/footer-bkg-white.png);
							background-repeat:  no-repeat;
							background-position: 100% center;	
						}
					</style>
				 ';
		}
	}
	
	echo stripslashes(get_option($dirname.'_scripts'));
}
add_action('wp_head', 'd2_wp_header');

function new_nav_menu_items($nav, $args) {
	if( $args->theme_location == 'primary' ) {
		$homelink = '<li class="home visible-sm visible-xs"><a href="/">Home</a></li>';
		$nav = $homelink . $nav;
		return $nav;
	} else {
		return $nav;	
	}
}
//add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10 ,2 );

/** Tell WordPress to run d2_setup() when the 'after_setup_theme' hook is run. */
if (!function_exists( 'd2_setup')) {
	function d2_setup() {	
		$defaults = array(
			'width'                  => 300,
			'height'                 => 62,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => false,
			'default-text-color'     => '#000000',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
			'default-image' => get_template_directory_uri() . '/images/logo-ieee.svg'
		);
		add_theme_support('custom-header', $defaults);
		add_theme_support('title-tag');	
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		// This theme uses post thumbnails
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(150, 150, true);
		// Background customizer
		//add_theme_support('custom-background');
		// Add default posts and comments RSS feed links to <head>.
		add_theme_support('automatic-feed-links');
		// Add support for HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'yoast-seo-breadcrumbs' );
		// Set the content width based on the theme's design and stylesheet.
		if(!isset($content_width)) $content_width = 1170;
		// Declare the menus
		register_nav_menus( array(
			'primary' => __('Primary Navigation', 'ieee-dci')    
		));		
	}
}
add_action( 'after_setup_theme', 'd2_setup' );

/*******************************
  Customizer
********************************/
function d2_customize_register($wp_customize) {
	//  =============================
    //  = Theme Color               =
    //  =============================
	$wp_customize->add_section('ieee-dci_theme_chooser', array(
        'title'    => __('Theme Chooser', 'ieee-dci'),
        'description' => 'You can choose which color scheme your site will use. The default color is blue.',
        'priority' => 120,
    ));
	
    $wp_customize->add_setting('ieee-dci_theme_chooser[color_scheme]', array(
        'default'        => 'blue',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
 
    $wp_customize->add_control('ieee-dci_color_scheme', array(
        'label'      => __('Color Scheme', 'ieee-dci'),
        'section'    => 'ieee-dci_theme_chooser',
        'settings'   => 'ieee-dci_theme_chooser[color_scheme]',
        'type'       => 'radio',
        'choices'    => array(
												'blue' => 'Blue',
												'green' => 'Green',
												'midnight' => 'Midnight',
												'magenta' => 'Magenta',
												'orange' => 'Orange',
												'red' => 'Red',
												'turqouise' => 'Turqouise'
        ),
    ));
	
	$wp_customize->add_setting('ieee-dci_theme_chooser[style_scheme]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
 
    $wp_customize->add_control('ieee-dci_style_scheme', array(
        'label'      => __('Style', 'ieee-dci'),
        'section'    => 'ieee-dci_theme_chooser',
        'settings'   => 'ieee-dci_theme_chooser[style_scheme]',
        'type'       => 'radio',
        'choices'    => array(
            '' => 'No Style',
            'style_a' => 'Orbital',
            'style_b' => 'Constellations',
			'style_c' => 'Circuits'
        ),
    ));
	
	$wp_customize->add_setting('ieee-dci_theme_chooser[style_breadcrumbs]', array(
        'default'        => 'no',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_style_breadcrumbs', array(
        'label'      => __('Breadcrumbs', 'ieee-dci'),
        'section'    => 'ieee-dci_theme_chooser',
        'settings'   => 'ieee-dci_theme_chooser[style_breadcrumbs]',
        'type'       => 'radio',
		'description' => 'Please make sure you have YOAST SEO plug-in installed with <a target="_blank" href="/wp-admin/admin.php?page=wpseo_titles#top#breadcrumbs">breadcrumbs</a> activated.',
        'choices'    => array(
            'yes' => 'Yes',
            'no' => 'No'
        ),
    ));
	
	//  =============================
    //  = Social Media              =
    //  =============================
	
	$wp_customize->add_section('ieee-dci_social_media', array(
        'title'    => __('Social Media', 'ieee-dci'),
        'description' => 'When you provide the links to your respective social media accounts, the icons will display in the footer.',
        'priority' => 120,
    ));	
	
    $wp_customize->add_setting('ieee-dci_social_media[twitter]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_twitter', array(
        'label'      => __('Twitter', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[twitter]',
    ));
	
	$wp_customize->add_setting('ieee-dci_social_media[facebook]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_facebook', array(
        'label'      => __('Facebook', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[facebook]',
    ));
	
	$wp_customize->add_setting('ieee-dci_social_media[linkedin]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_linkedin', array(
        'label'      => __('LinkedIn', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[linkedin]',
    ));
	
	$wp_customize->add_setting('ieee-dci_social_media[youtube]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_youtube', array(
        'label'      => __('YouTube', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[youtube]',
    ));
	
	$wp_customize->add_setting('ieee-dci_social_media[instagram]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_instagram', array(
        'label'      => __('Instagram', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[instagram]',
    ));
	
	$wp_customize->add_control('ieee-dci_social_media_googleplus', array(
        'label'      => __('Google+', 'ieee-dci'),
        'section'    => 'ieee-dci_social_media',
        'settings'   => 'ieee-dci_social_media[googleplus]',
    ));
	
	//  =============================
    //  = Footer Links              =
    //  =============================
	
	$wp_customize->add_section('ieee-dci_footer_links', array(
        'title'    => __('Footer Links', 'ieee-dci'),
        'description' => 'When you provide the links to your respective social media accounts, the icons will display in the footer.',
        'priority' => 120,
    ));	
	
    $wp_customize->add_setting('ieee-dci_footer_links[sitemap]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_footer_links_sitemap', array(
        'label'      => __('Sitemap', 'ieee-dci'),
        'section'    => 'ieee-dci_footer_links',
        'settings'   => 'ieee-dci_footer_links[sitemap]',
    ));
	
	$wp_customize->add_setting('ieee-dci_footer_links[contact]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_footer_links_contact', array(
        'label'      => __('Contact & Support', 'ieee-dci'),
        'section'    => 'ieee-dci_footer_links',
        'settings'   => 'ieee-dci_footer_links[contact]',
    ));
	
	$wp_customize->add_setting('ieee-dci_footer_links[help]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_footer_links_help', array(
        'label'      => __('Help', 'ieee-dci'),
        'section'    => 'ieee-dci_footer_links',
        'settings'   => 'ieee-dci_footer_links[help]',
    ));
	
	$wp_customize->add_setting('ieee-dci_footer_links[feedback]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_footer_links_feedback', array(
        'label'      => __('Feedback', 'ieee-dci'),
        'section'    => 'ieee-dci_footer_links',
        'settings'   => 'ieee-dci_footer_links[feedback]',
    ));
		
	$wp_customize->add_setting('ieee-dci_footer_links[join]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));
	
	$wp_customize->add_control('ieee-dci_footer_links_join', array(
        'label'      => __('Join Button', 'ieee-dci'),
        'section'    => 'ieee-dci_footer_links',
        'settings'   => 'ieee-dci_footer_links[join]',
				'type'       => 'radio',
        'choices'    => array(
            '' => 'No',
            'style_a' => 'Yes'
				),
    ));
}
add_action('customize_register', 'd2_customize_register');

/*******************************
  Load Jetpack compatibility file
********************************/
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

/*******************************
  Excerpts
********************************/
// Character Length
function new_excerpt_length($length) {
	return 10000;
}
add_filter('excerpt_length', 'new_excerpt_length');

function excerpt($count, $ellipsis = '...') {
	$excerpt = get_the_excerpt();
	$excerpt = strip_tags($excerpt);
	if(function_exists('mb_strlen') && function_exists('mb_substr')) { 
		if(mb_strlen($excerpt) > $count) {
			$excerpt = mb_substr($excerpt, 0, $count).$ellipsis;
		}
	} else {
		if(strlen($excerpt) > $count) {
			$excerpt = substr($excerpt, 0, $count).$ellipsis;
		}	
	}
	return $excerpt;
}

// Replace Excerpt Ellipsis
function new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Content More Text
function new_more_link($more_link, $more_link_text) {
	return str_replace('more-link', 'more-link read-more', $more_link);
}
add_filter('the_content_more_link', 'new_more_link', 10, 2);

/*******************************
  Add excerpt support to pages
********************************/
add_action('init', 'my_add_excerpts_to_pages');
function my_add_excerpts_to_pages() {
   add_post_type_support('page', 'excerpt');
}

/*******************************
  Title Length
********************************/
function the_title_limit($count, $ellipsis = '...') {
	$title = the_title('','',FALSE);
	$title = strip_tags($title);
	if(function_exists('mb_strlen') && function_exists('mb_substr')) { 
		if(mb_strlen($title) > $count) {
			$title = mb_substr($title, 0, $count).$ellipsis;
		}
	} else {
		if(strlen($title) > $count) {
			$title = substr($title, 0, $count).$ellipsis;
		}
	}
	return $title;
}

/*******************************
  Page Navigation
********************************/
function d2_pagination($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  
     global $paged;
	 if (get_query_var('paged')) {
		 $paged = get_query_var('paged');
	 } else if (get_query_var('page')){
		 $paged = get_query_var('page');
	 } else {
		 $paged = 1;
	 }
	 
     if ($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if (!$pages){
             $pages = 1;
         }
     }   	

     if (1 != $pages){
        echo "<div class='clear'></div><div class='wp-pagenavi cat-navi'>";
		echo '<span class="pages">'.__('Page', 'ieee-dci').' '.$paged.' '.__('of', 'ieee-dci').' '.$pages.'</span>';
         if ($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if ($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
         for ($i=1; $i <= $pages; $i++){
             if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*******************************
  Breadcrumbs
********************************/
function breadcrumbs($theme_location = 'primary-navigation', $separator = '|') {
    $items = wp_get_nav_menu_items($theme_location);
    _wp_menu_item_classes_by_context( $items ); // Set up the class variables, including current-classes
    $crumbs = array();

    foreach($items as $item) {
        if ($item->current_item_ancestor || $item->current) {
            $crumbs[] = "<a href=\"{$item->url}\" title=\"{$item->title}\">{$item->title}</a>";
        }
    }
	echo '<div id="breadcrumbs"><a href="/">Home</a> '.$separator;
    echo implode($separator, $crumbs);
	echo  '</div>';
}

/*******************************
  EXCERPT
********************************/
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'my_custom_excerpt');
function my_custom_excerpt($text) {
	if ( '' == $text ) {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
			$text = strip_tags($text);
			$excerpt_length = 45;
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words) > $excerpt_length) {
					array_pop($words);
					array_push($words, '...');
					$text = implode(' ', $words);
			}
	}
	return $text;
}

/*******************************
  Remove dashboard widgets
********************************/
function remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
 	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

/*******************************
  Shortcode support for Text Widget
********************************/
add_filter('widget_text', 'do_shortcode');

/*******************************
  Shortcode empty paragraph fix
********************************/
// Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
function shortcode_empty_paragraph_fix($content){
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br>' => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	$content = str_replace('<p></p>', '', $content);
	return $content;
}
//add_filter('the_content', 'shortcode_empty_paragraph_fix');

/*******************************
  Removes mismatched </p> and <p> tags from a string
********************************/
function d2_remove_markup($string) {
    $patterns = array(
        '#^\s*</p>#',
        '#<p>\s*$#'
    );
	$string = str_replace('<p></p>', '', $string);
	//$string = str_replace('<br />', '', $string);
	//$string = str_replace('<br>', '', $string);
    return preg_replace($patterns, '', $string);
}
//add_filter('the_content', 'd2_remove_markup');

//remove_filter('the_content', 'wpautop');
?>