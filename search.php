<?php 
/**
 * This template is used to display the search results.
 * 
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
get_header(); ?>

<?php //start .container ?>
<div class="container">
	<div class="row">
    	<div class="col-lg-12">
            <header class="article-header">        	
                <h1 class="page-title">Search Results for "<?php echo esc_html($_GET['s']); ?>"</h1>            
            </header> 
            <section class="entry-content clearfix">  
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>            
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix gradient'); ?> role="article">
                    <div class="entry-container">        
                        <header class="article-header">            
                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>        
                        </header>
                        <section class="clearfix">
                            <?php the_excerpt(); ?>
                        </section>
                    </div>       
                    <?php //comments_template(); // uncomment if you want to use them ?>
                </article>
            <?php endwhile; ?>
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
            <?php else : ?>    
                <article id="post-not-found" role="article" >
                    <header class="article-header">
                        <h1><?php _e("No results.", "ieee-dci"); ?></h1>
                    </header>
                    <section class="clearfix">
                        <p><?php _e("Try searching for something else.", "ieee-dci"); ?></p>
                    </section>
                </article>
            <?php endif; ?>
            </section>           
        </div>  
    </div>   
</div>
<?php //end .container ?>		

<?php get_footer(); ?>