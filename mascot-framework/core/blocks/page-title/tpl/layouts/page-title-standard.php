<div class="row">
  <div class="col-md-12 sm-text-center title-content">
	<?php do_action( 'landspire_page_title_content_start' ); ?>
	<?php if( $title_area_show_title ) { landspire_get_title_area_title(); } ?>
	<?php if( $title_area_show_breadcrumb ) { landspire_display_breadcrumbs(); } ?>
	<?php if( $title_area_show_subtitle ) { landspire_get_title_area_subtitle(); } ?>
	<?php do_action( 'landspire_page_title_content_end' ); ?>
  </div>
</div>