<?php
	/**
	* landspire_before_page_section hook.
	*
	*/
	do_action( 'landspire_before_page_section' );
?>
<section class="main-content-section-wrapper">
	<div class="<?php echo esc_attr( $container_type ); ?>">
		<?php
			/**
			* landspire_page_container_start hook.
			*
			*/
			do_action( 'landspire_page_container_start' );
		?>

		<?php
			if ( have_posts() ) :
			// Start the Loop.
			while ( have_posts() ) : the_post();
				landspire_get_page_sidebar_layout( $page_layout );
			endwhile;
			endif;
		?>

		<?php
			/**
			* landspire_page_container_end hook.
			*
			*/
			do_action( 'landspire_page_container_end' );
		?>
	</div>
</section>
<?php
	/**
	* landspire_after_page_section hook.
	*
	*/
	do_action( 'landspire_after_page_section' );
?>