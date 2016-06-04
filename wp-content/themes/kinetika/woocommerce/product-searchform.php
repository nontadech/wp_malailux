<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-field right" />
	<button id="searchbutton" title="<?php esc_attr_e('Search','mthemelocal');?>" type="submit"><i class="fa fa-search"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>
