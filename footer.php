<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
global $themename, $dirname;
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
$footer_links = get_theme_mod( 'ieee-dci_footer_links' );
if ($footer_links['sitemap']) {
	$sitemap = $footer_links['sitemap'];
} else {
	$sitemap = 'http://www.ieee.org/sitemap.html';	
}
if ($footer_links['contact']) {
	$contact = $footer_links['contact'];
} else {
	$contact = '';	
}
if ($footer_links['help']) {
	$help = $footer_links['help'];
} else {
	$help = '';	
}
if ($footer_links['feedback']) {
	$feedback = $footer_links['feedback'];
} else {
	$feedback = '';	
}
if ($footer_links['join']) {
	$join = '<div id="join-btn-footer" class="text-center"><a class="btn btn-primary" target="_blank" href="https://www.ieee.org/membership/join/index.html?WT.mc_id=hc_join">Join IEEE</a></div>';
} else {
	$join = '';
}
?>

	</div>
    <?php //end #content ?>

	<?php //start #footer ?>
    <footer id="colophon" class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-md-12 col-sm-12 col-xs-12">
            <ul id="menu-footer-navigation" class="menu">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><a target="_blank" href="<?php echo $sitemap; ?>">Sitemap</a></li>
                <?php if ($contact) { ?>
                  <li><a href="<?php echo $contact; ?>">Contact &amp; Support</a></li>
                <?php } ?>                            
                <li><a target="_blank" href="https://www.ieee.org/accessibility-statement.html">Accessibility</a></li>
                <li><a target="_blank" href="https://www.ieee.org/about/corporate/governance/p9-26.html">Nondiscrimination Policy</a></li>
                <li><a href="http://www.ieee.org/site_terms_conditions.html">Terms and Conditions</a></li>
                <li><a target="_blank" href="https://www.ieee.org/security_privacy.html">IEEE Privacy Policy</a></li>
                <?php if ($help) { ?>
                  <li><a href="<?php echo $help; ?>">Help</a></li>
                <?php } ?>
                <?php if ($feedback) { ?>
                  <li><a href="<?php echo $contact; ?>">Site Feedback Form</a></li>
                <?php } ?>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                <p>&copy; Copyright <?php echo date('Y'); ?> IEEE – All rights reserved. Use of this website signifies your agreement to the IEEE Terms and Conditions.<br />A not-for-profit organization, IEEE is the world’s largest technical professional organization dedicated to advancing technology for the benefit of humanity.</p>
            </div>
            <div id="social-links" class="col-lg-4 col-md-5 col-sm-12 col-xs-12 text-center">
              <?php echo $join; ?>
              <a class="ico-collabratec" href="https://ieee-collabratec.ieee.org/" target="_blank"></a>
              <?php if ($twitter) { ?>
                <a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if ($facebook) { ?>
                <a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if ($linkedin) { ?>
                <a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if ($youtube) { ?>
                <a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
              <?php } ?>
              <?php if ($instagram) { ?>
                <a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
              <?php } ?>
              <a href="https://www.addthis.com/bookmark.php" target="_blank"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
            </div>
        </div>
      </div>
    </footer>
    <?php //end #footer ?>
    
    <span id="top-link-block" class="hidden">
        <a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
        </a>
    </span>
</div>
<?php //end #page ?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>