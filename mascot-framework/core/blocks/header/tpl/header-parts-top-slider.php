
	<?php
	/**
	* landspire_before_top_sliders_container hook.
	*
	*/
	do_action( 'landspire_before_top_sliders_container' );
	?>
	<div class="top-sliders-container">
		<?php
			/**
			* landspire_top_sliders_container_start hook.
			*
			*/
			do_action( 'landspire_top_sliders_container_start' );
		?>

		<?php
			echo landspire_get_top_main_slider();
		?>

		<?php
			/**
			* landspire_top_sliders_container_end hook.
			*
			*/
			do_action( 'landspire_top_sliders_container_end' );
		?>
	</div>
	<?php
	/**
	* landspire_after_top_sliders_container hook.
	*
	*/
	do_action( 'landspire_after_top_sliders_container' );
	?>
