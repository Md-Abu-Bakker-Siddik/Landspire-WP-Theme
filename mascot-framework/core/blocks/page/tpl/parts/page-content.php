<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="page-content">
			<?php
				landspire_get_blog_single_post_thumbnail();
			?>
			<?php
				/**
				* landspire_before_page_content hook.
				*
				*/
				do_action( 'landspire_before_page_content' );
			?>
			<?php
				the_content();
			?>
			<?php
				/**
				* landspire_after_page_content hook.
				*
				*/
				do_action( 'landspire_after_page_content' );
			?>

			<?php landspire_get_post_wp_link_pages(); ?>

			<?php
				if( landspire_get_redux_option( 'page-settings-show-share' ) ) {
					landspire_get_social_share_links();
				}
			?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php
	if( $page_show_comments ) {
		landspire_show_comments();
	}
?>
