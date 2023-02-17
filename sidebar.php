<?php
/**
 * Thie template is used for the sidebar.
 *
 * @package WordPress
 * @subpackage IEEE DCI
 * @since IEEE DCI 1.0
 */
?>

<?php //start #sidebar ?>
<div id="sidebar">    	
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Right Sidebar') ) : else : ?><?php endif; ?>
</div>
<?php //end #sidebar ?>