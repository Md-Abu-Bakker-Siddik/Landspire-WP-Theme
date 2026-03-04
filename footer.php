<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .main-content div and #wrapper
 *
 */
?>


	<?php landspire_get_footer_top_callout(); ?>


	<?php
		/**
		 * landspire_main_content_end hook.
		 *
		 */
		do_action( 'landspire_main_content_end' );
	?>
	</div>
	<!-- main-content end -->
	<?php
		/**
		 * landspire_after_main_content hook.
		 *
		 */
		do_action( 'landspire_after_main_content' );
	?>


	<?php if( apply_filters('landspire_filter_show_footer', true) ): ?>
	<?php landspire_get_footer_parts(); ?>
	<?php endif; ?>

	<?php
		/**
		 * landspire_wrapper_end hook.
		 *
		 */
		do_action( 'landspire_wrapper_end' );
	?>
</div>
<!-- wrapper end -->
<?php
	/**
	 * landspire_body_tag_end hook.
	 *
	 */
	do_action( 'landspire_body_tag_end' );
?>
<?php
	/**
	 * nav_search_icon_popup_html hook.
	 *
	 */
	do_action( 'landspire_nav_search_icon_popup_html');
	landspire_floating_cart_sidebar();
?>
<?php wp_footer(); ?>
</body>
</html>
