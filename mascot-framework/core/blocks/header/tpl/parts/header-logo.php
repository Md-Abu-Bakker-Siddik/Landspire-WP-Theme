
			<a class="menuzord-brand site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if( !$use_logo ): ?>
				<?php echo esc_html( $site_brand ); ?>
				<?php else: ?>
					<?php if( !$use_switchable_logo ): ?>
					<img class="logo-default" src="<?php echo esc_url( $logo_default ); ?>" alt="<?php esc_attr_e( 'Landspire Logo', 'landspire' ); ?>">
					<img class="logo-mobile-version" src="<?php echo esc_url( $logo_mobile_version ); ?>" alt="<?php esc_attr_e( 'Landspire Logo', 'landspire' ); ?>">
					<?php else: ?>
					<img class="logo-primary" src="<?php echo esc_url( $logo_light ); ?>" alt="<?php esc_attr_e( 'Landspire Logo Light', 'landspire' ); ?>">
					<img class="logo-on-sticky" src="<?php echo esc_url( $logo_dark ); ?>" alt="<?php esc_attr_e( 'Landspire Logo Dark', 'landspire' ); ?>">
					<?php endif; ?>
				<?php endif; ?>
			</a>