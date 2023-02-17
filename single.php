<?php 
/**
 * The template for displaying posts.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
get_header();
$theme_chooser = get_theme_mod( 'ieee-dci_theme_chooser' );
?>

<?php //start .container ?>
<div class="container">
	<div class="row">
    	<div class="col-lg-12">      
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php //start article ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting"> 
                    <div class="entry-content">
                    	<?php if (!is_front_page() && $theme_chooser['style_breadcrumbs'] == 'yes' && function_exists('yoast_breadcrumb')) { ?>
                            <div class="row">
                                <div class="col-lg-12"><?php yoast_breadcrumb( '<div id="breadcrumbs">','</div>'); ?></div>
                            </div>
                        <?php } ?> 
                    	<header class="article-header">
                            <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
                           	<div class="author">By <?php echo get_the_author(); ?></div>
                            <?php the_date('m F, Y', '<div class="date">', '</div>'); ?>
                        </header>
                        <section class="post-content clearfix">  
                            <?php the_content(); ?>
                        </section>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ieee-dci' ), 'after' => '</div>' ) ); ?>
                        <?php //edit_post_link( __( 'Edit', 'ieee-dci' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php //comments_template( '', true ); ?>	
                </article>
                <?php //end article ?>		
                <?php endwhile; ?>	
            <?php else : ?>
				<?php //start article ?>    
                <article id="post-not-found" role="article" >
                	<div class="entry-content">
                        <header class="article-header">
                            <h1><?php _e("Oops, Post Not Found!", "ieee-dci"); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "ieee-dci"); ?></p>
                        </section>
                    </div>
                </article>  
                <?php //end article ?>  
            <?php endif; ?>
        </div>
   </div>
</div>
<?php //end .container ?>

<?php get_footer(); ?>