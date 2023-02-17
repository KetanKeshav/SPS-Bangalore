<?php
/**
 * The template for displaying tag archive pages.
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
        	<?php if (!is_front_page() && $theme_chooser['style_breadcrumbs'] == 'yes' && function_exists('yoast_breadcrumb')) { ?>
                <div class="row">
                    <div class="col-lg-12"><?php yoast_breadcrumb( '<div id="breadcrumbs">','</div>'); ?></div>
                </div>
            <?php } ?> 
        	<header class="article-header">
                <h1 class="archive-title page-title" itemprop="headline">
                    <span><?php _e("Posts tagged with:", "ieee-dci"); ?></span> <?php single_tag_title(); ?>
                </h1>                
            </header>     
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php //start article ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix gradient'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting"> 
                    <div class="entry-content">
                        <header class="article-header">            
                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>            
                        </header> 
                        <section class="entry-content clearfix">  
                            <?php the_excerpt(); ?> 
                        </section>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ieee-dci' ), 'after' => '</div>' ) ); ?>
                        <?php //edit_post_link( __( 'Edit', 'ieee-dci' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>  
                    <?php //comments_template( '', true ); ?>	
                </article>
                <?php //end article ?>	
                <?php if(function_exists('wp_pagenavi')) { // if PageNavi is activated ?>  
                    <?php wp_pagenavi(); // Use PageNavi ?>                  
                <?php } else { // Otherwise, use traditional Navigation ?>		
                    <?php
                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous', 'ieee-dci' ),
                        'next_text'          => __( 'Next', 'ieee-dci' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'ieee-dci' ) . ' </span>',
                    ) );
                ?>
                <?php } ?>	
                <?php endwhile; ?>			
                
            <?php else : ?>
				<?php //start article ?>    
                <article id="post-not-found" role="article" >
                    <header class="article-header">
                        <h2><?php _e("Oops, Post Not Found!", "ieee-dci"); ?></h2>
                    </header>
                    <section class="entry-content">
                        <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "ieee-dci"); ?></p>
                    </section>
                </article>  
                <?php //end article ?>  
            <?php endif; ?>
        </div>
   </div>
</div>
<?php //end .container ?>

<?php get_footer(); ?>