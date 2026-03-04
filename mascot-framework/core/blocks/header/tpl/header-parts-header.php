	<!-- Header -->
	<?php
		/**
		* landspire_before_header hook.
		*
		*/
		do_action( 'landspire_before_header' );
	?>
	<header id="header" class="header <?php echo esc_attr(implode(' ', $header_classes)); ?>" <?php if( $params['header_layout_type'] == 'header-vertical-nav' ) { ?> style="<?php echo esc_attr( $vertical_nav_bgcolor ); ?> <?php echo esc_attr( $vertical_nav_bgimg ); ?>" <?php } ?>>
		<?php
			/**
			* landspire_header_start hook.
			*
			*/
			do_action( 'landspire_header_start' );
		?>
		<?php
			/**
			* landspire_header_top_area hook.
			*
			* @hooked landspire_get_header_top
			*/
			do_action( 'landspire_header_top_area' );
		?>
		<?php
			landspire_get_header_layout_type();
		?>

		<?php
			/**
			* landspire_header_end hook.
			*
			*/
			do_action( 'landspire_header_end' );
		?>
	</header>
	<?php
		/**
		* landspire_after_header hook.
		*
		*/
		do_action( 'landspire_after_header' );
	?>