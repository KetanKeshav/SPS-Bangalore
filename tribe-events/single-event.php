<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices() ?>
    
    <?php while ( have_posts() ) :  the_post(); ?>
    	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
            	<div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>
                    <div class="tribe-events-schedule tribe-clearfix">
                        <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
                        <?php if ( tribe_get_cost() ) : ?>
                            <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
                        <?php endif; ?>
                        <?php
						echo tribe_get_event_categories(
							get_the_id(), array(
								'before'       => '',
								'sep'          => ', ',
								'after'        => '',
								'label'        => null, // An appropriate plural/singular label will be provided
								'label_before' => '<dt class="tribe-events-event-categories-label">',
								'label_after'  => '</dt>',
								'wrap_before'  => '<dd class="tribe-events-event-categories">',
								'wrap_after'   => '</dd>',
							)
						);
						?>
                    </div>
                    <!-- Event content -->
                    <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
                    <div class="tribe-events-single-event-description tribe-events-content">
                        <?php the_content(); ?>
                    </div>
                    <!-- .tribe-events-single-event-description -->
					<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
                    <!-- Event meta -->
                    <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
                    <?php tribe_get_template_part( 'modules/meta' ); ?>
                    <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
            </div>
			
			
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</div><!-- #tribe-events-content -->
