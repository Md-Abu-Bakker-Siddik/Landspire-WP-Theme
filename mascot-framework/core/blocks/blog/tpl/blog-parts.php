<?php
	/**
	* landspire_before_blog_section hook.
	*
	*/
	do_action( 'landspire_before_blog_section' );
?>
<section>
	<div class="<?php echo esc_attr( $container_type ); ?>">
		<?php
			/**
			* landspire_blog_container_start hook.
			*
			*/
			do_action( 'landspire_blog_container_start' );
		?>

		<div class="blog-posts">
			<?php
				landspire_get_blog_sidebar_layout();
			?>
		</div>

	<?php
		/**
		* landspire_blog_container_end hook.
		*
		*/
		do_action( 'landspire_blog_container_end' );
	?>
	</div>
</section>
<?php
	/**
	* landspire_after_blog_section hook.
	*
	*/
	do_action( 'landspire_after_blog_section' );
?>
