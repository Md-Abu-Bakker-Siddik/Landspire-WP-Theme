<div class="<?php echo esc_attr( $hidden_class ); ?>">
	<a href="#" class="top-nav-search-btn" data-target="<?php echo esc_attr($holder_id)?>"><i class="search-icon <?php echo landspire_get_redux_option( 'header-settings-navigation-menu-search-icon-code', 'fa fa-search' ); ?>"></i></a>
	<?php
		landspire_add_nav_search_holder_id( $holder_id );
	?>
</div>