<?php 
/**
 * This template is used to display the pages.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
get_header();
$theme_chooser = get_theme_mod( 'ieee-dci_theme_chooser' );
?>
<?php global $dirname; ?>
<?php //start .container ?>
<div class="container">
	<div class="row">
    	<div class="col-lg-12">
			<?php //start article ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?> 
                	<?php $hide_breadcrumbs = esc_attr(get_post_meta( $post->ID, '_hide_breadcrumbs', true )); ?>     
                    <div class="entry-container">
                    	<?php if (!is_front_page() && $theme_chooser['style_breadcrumbs'] == 'yes' && !$hide_breadcrumbs && function_exists('yoast_breadcrumb')) { ?>
                        <div class="row">
                            <div class="col-lg-12"><?php yoast_breadcrumb( '<div id="breadcrumbs">','</div>'); ?></div>
                        </div>
                        <section class="entry-content clearfix">
                        <?php } else { ?>
                        <section class="entry-content clearfix padding"> 
                        <?php } ?>              	
                            <?php the_content(); ?>                                
                        </section>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ieee-dci' ), 'after' => '</div>' ) ); ?>
                        <?php //edit_post_link( __( 'Edit', 'ieee-dci' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php //comments_template( '', true ); ?>    
                <?php endwhile; // end of the loop. ?>  
            </article>
            <?php //end article ?>
        </div>
    </div>  
</div>          
<?php //end .container ?>

<?php get_footer(); ?>