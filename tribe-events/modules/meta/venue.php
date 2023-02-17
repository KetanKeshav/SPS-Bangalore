<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();
$event_id = get_the_ID();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-venue">
	<h3 class="boxed tribe-events-single-section-title"><span><?php esc_html_e( tribe_get_venue_label_singular(), 'the-events-calendar' ) ?></span></h3>
    
    <div class="gradient"><div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<dl>
				<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
        		<i class="primary fa fa-map-o" aria-hidden="true"></i>

                <dd class="tribe-venue"><h3><?php echo tribe_get_venue() ?></h3></dd>
        
                <?php if ( tribe_address_exists() ) : ?>
                    <dd class="tribe-venue-location">
                        <address class="tribe-events-address">
                            <?php echo tribe_get_full_address(); ?>
        					<div>
                            <?php if ( tribe_show_google_map_link() ) : ?>
                                <?php echo tribe_get_map_link_html(); ?>
                            <?php endif; ?>
                            </div>
                        </address>
                    </dd>
                <?php endif; ?>
        
                <?php if ( ! empty( $phone ) ): ?>
                    <dt class="tribe-venue-tel-label"> <?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?> </dt>
                    <dd class="tribe-venue-tel"> <?php echo $phone ?> </dd>
                <?php endif ?>
        
                <?php if ( ! empty( $website ) ): ?>
                    <dt class="tribe-venue-url-label"> <?php esc_html_e( 'Website:', 'the-events-calendar' ) ?> </dt>
                    <dd class="tribe-venue-url"> <?php echo $website ?> </dd>
                <?php endif ?>
        
                <?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
            </dl>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
        	<?php
			echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
			tribe_get_template_part( 'modules/meta/map' );
			echo '</div>';
			?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
        </div>
    </div></div>
</div>
