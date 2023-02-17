<?php 
/**
 * This is used on pages such as the blog index.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
get_header(); ?>

<?php //start .container ?>
<div class="container">
	<div class="row">
    	<div class="col-md-8">    
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php //start article ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting"> 
                    <div class="entry-content">
                        <header class="article-header">
                            <h1 class="page-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        </header>
                        <section class="entry-content clearfix">  
                            <?php the_content(); ?>
                        </section>
                        <footer class="article-footer">
                            <p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'ieee-dci') . '</span> ', ', ', ''); ?></p>
                        </footer>
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
        <div class="col-md-4">       
			<?php 
            //start sidebar
            get_sidebar();
            //end sidebar
            ?>
        </div>
   </div>
</div>
<?php //end .container ?>		

<?php get_footer(); ?>