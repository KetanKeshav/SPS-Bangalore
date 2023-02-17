<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url()); ?>">
    <div class="form-group">
    	<label for="search-form" class="screen-reader-text">Email address</label>
    	<input type="search" id="search-form" class="search-field form-control" placeholder="Search <?php bloginfo('name'); ?>" aria-describedby="search-help" value="" name="s" title="Search Terms" />
        <small id="search-help" class="form-text screen-reader-text">What would you like to search for?</small>
    </div>
    <button type="submit" class="btn btn-default">
    	<i class="fa fa-search" aria-hidden="true" title="search"></i>
    </button>
</form>