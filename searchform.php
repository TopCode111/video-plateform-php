<!-- Start SearchForm -->
<form method="get" class="search-form" role="search" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder','myprofile' ); ?>" class="form-control">
    <span> 
	<button class="lnr lnr-magnifier" type="submit"></button>
	</span>
	
</form>
<!-- End SearchForm -->