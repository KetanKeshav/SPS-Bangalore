<?php
/**
 * The header for our theme.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
global $themename, $dirname;
$theme_chooser = get_theme_mod( 'ieee-dci_theme_chooser' );
$social_links = get_theme_mod( 'ieee-dci_social_media' );
if ($social_links['twitter']) {
	$twitter = $social_links['twitter'];
} else {
	$twitter = 'https://twitter.com/IEEEorg';	
}
if ($social_links['facebook']) {
	$facebook = $social_links['facebook'];
} else {
	$facebook = 'https://www.facebook.com/IEEE.org/';	
}
if ($social_links['linkedin']) {
	$linkedin = $social_links['linkedin'];
} else {
	$linkedin = 'https://www.linkedin.com/company/ieee';	
}
if ($social_links['youtube']) {
	$youtube = $social_links['youtube'];
} else {
	$youtube = 'https://www.youtube.com/user/IEEEorg';	
}
if ($social_links['instagram']) {
	$instagram = $social_links['instagram'];
} else {
	$instagram = 'https://www.instagram.com/ieeeorg/';	
}
if ($social_links['googleplus']) {
	$googleplus = $social_links['googleplus'];
} else {
	$googleplus = 'https://plus.google.com/110847308612303935604';	
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
    <script src="https://s3-us-west-2.amazonaws.com/ieeeshutpages/gdpr/settings.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
     window.cookieconsent.initialise(json)
    });
    </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ieee-dci' ); ?></a>

	<?php //start #header ?>
    <header id="header" class="site-header" role="banner">
        <div id="meta-nav" class="hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul id="meta">
                            <li><a href="https://www.ieee.org/" target="_blank">IEEE.org</a></li>
                            <li><a href="http://ieeexplore.ieee.org/" target="_blank">IEEE <em>Xplore</em> Digital Library</a>
                            <li><a href="http://standards.ieee.org/" target="_blank">IEEE Standards</a>
                            <li><a href="http://spectrum.ieee.org/" target="_blank">IEEE Spectrum</a>
                            <li><a href="https://www.ieee.org/sitemap.html" target="_blank">More Sites</a>
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
        <div class="container">
            <div class="row" id="logo-search">
            	<div id="mobile-menu" class="col-sm-2 col-xs-2 visible-sm visible-xs">
                	<button><i class="fa fa-bars" aria-hidden="true"<?php if ($theme_chooser['color_scheme'] == 'midnight') { ?> style="color: #fff !important;"<?php } ?>></i> <span>MENU</span></button>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8" id="logo" role="logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                    	<?php if ( has_header_image() ) { ?>
                        	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" class="img-responsive" />
                        <?php } else { ?>
													<?php if (strlen(get_bloginfo()) > 30) { ?>
                              <h1 class="sm"><?php bloginfo('name'); ?></h1>
                          <?php } else { ?>
                              <h1><?php bloginfo('name'); ?></h1>
                          <?php } ?>
                        <?php } ?>
                    </a>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-right hidden-sm hidden-xs" id="search">
                	<div class="row search-block">
                    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 search-form-block">
                        	<?php get_search_form(); ?>
                    		<button id="toggle-search" class="hidden-sm hidden-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 logo-ieee-block">
                        	<?php if ($theme_chooser['color_scheme'] == 'midnight') { ?>
                            	<a href="https://www.ieee.org/" target="_blank" id="logo-ieee"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-ieee-white.svg" alt="IEEE"></a>
                            <?php } else { ?>
                       			<a href="https://www.ieee.org/" target="_blank" id="logo-ieee"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-ieee.svg" alt="IEEE"></a>
                            <?php } ?>
                        </div> 
                    </div>
                </div>
                <div id="mobile-search" class="col-sm-2 col-xs-2 visible-sm visible-xs text-right">
                	<button class="toggle-search"><span>SEARCH</span> <i class="fa fa-search" aria-hidden="true"<?php if ($theme_chooser['color_scheme'] == 'midnight') { ?> style="color: #fff !important;"<?php } ?>></i></button>
                </div>
             </div>
        </div>
        
        <div id="main-nav" class="hidden-sm hidden-xs">
        	<div class="container">
            	<div class="row">
                    <div class="col-xs-12" role="navigation">
                    	<button class="close-menu visible-sm visible-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
                        <?php if ( has_nav_menu('primary') ) {
                            wp_nav_menu(array('theme_location' => 'primary', 'sort_column' => 'menu_order', 'container' => 'ul', 'fallback_cb' => 'null', 'depth' => '2', 'menu_id' => 'nav', 'menu_class' => 'justify-content-center align-items-center')); 
                        } ?>
                        <a href="https://www.ieee.org/" target="_blank" class="ieee-logo visible-sm visible-xs"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-ieee.svg"></a>
                        <div id="social-links-mobile" class="visible-sm visible-xs">
                            <a class="ico-collabratec visible-sm visible-xs" href="https://ieee-collabratec.ieee.org/" target="_blank"></a>
                            <?php if ($twitter) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if ($facebook) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if ($linkedin) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if ($youtube) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if ($instagram) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if ($googleplus) { ?>
                                <a class="visible-sm visible-xs" href="<?php echo $googleplus; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <?php } ?>
                            <a class="visible-sm visible-xs" href="https://www.addthis.com/bookmark.php" target="_blank"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </header>
    <?php //end #header ?>
	
    <?php //start #content ?>
    <div id="content" class="site-content">