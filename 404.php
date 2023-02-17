<?php
/**
 * The template for displaying 404 pages.
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
        	<?php //start article ?>
    		<article role="article">
                <div id="post-0" class="post error404 not-found">
                	<div class="entry-container">
                        <header class="article-header">
                            <h1 class="page-title" itemprop="headline">Uh oh, there's nothing here</h1>
                        </header>
                        <section class="entry-content clearfix"> 
                            <h2><?php _e( 'Not Found', 'ieee-dci' ); ?></h2>
                            <p><?php _e( 'Apologies, but the page you requested could not be found.', 'ieee-dci' ); ?></p>
                        </section>
                    </div>
                </div>
    		</article>
    		<?php //end article ?>              
        </div>  
    </div>   
</div>
<?php //end .container ?>

<?php get_footer(); ?>