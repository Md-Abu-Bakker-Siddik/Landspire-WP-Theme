<?php
/*
*
*	Core Actions
*	---------------------------------------
*	Mascot Framework v1.0
* 	Copyright ThemeMascot 2017 - http://www.thememascot.com
*
*/


if(!function_exists('landspire_action_widgets_init')) {
	/**
	 * Init Widgets
	 */
	function landspire_action_widgets_init() {
	}
}


if(!function_exists('landspire_action_wp_head')) {
	/**
	 * Head Action
	 */
	function landspire_action_wp_head() {
		landspire_head_pingback();
		landspire_head_responsive_viewport();
		landspire_head_favicon();
		landspire_head_apple_touch_icons();
	}
}


if(!function_exists('landspire_head_pingback')) {
	/**
	 * link pingback
	 */
	function landspire_head_pingback() {
		if ( is_singular() && pings_open( get_queried_object() ) ) :?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php endif;
	}
}


if(!function_exists('landspire_head_responsive_viewport')) {
	/**
	 * Enable Responsive
	 */
	function landspire_head_responsive_viewport() {
		if( landspire_get_redux_option( 'general-settings-enable-responsive', true ) ) { ?>
			<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php } else { ?>
			<meta name="viewport" content="width=1140, user-scalable=yes">
		<?php }
	}
}


if(!function_exists('landspire_head_favicon')) {
	/**
	 * Add Favicon
	 */
	function landspire_head_favicon() {
		// Stop here if and icon was added via the customizer.
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			return;
		}

		if( landspire_get_redux_option( 'general-settings-favicon', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( landspire_get_redux_option( 'general-settings-favicon', false, 'url' ) ); ?>" rel="shortcut icon">
		<?php } else { ?>
			<link href="<?php echo esc_url( LANDSPIRE_ASSETS_URI . '/images/logo/favicon.png') ?>" rel="shortcut icon" type="image/png">
		<?php }
	}
}


if(!function_exists('landspire_head_apple_touch_icons')) {
	/**
	 * Add Apple Touch Icons 144x144, 114x114, 72x72, 32x32
	 */
	function landspire_head_apple_touch_icons() {
		//apple-touch-icon
		if( landspire_get_redux_option( 'general-settings-apple-touch-32', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( landspire_get_redux_option( 'general-settings-apple-touch-32', false, 'url' ) ); ?>" rel="apple-touch-icon">
		<?php } else { ?>
			<link href="<?php echo esc_url( LANDSPIRE_ASSETS_URI . '/images/apple-touch-icon.png') ?>" rel="apple-touch-icon">
		<?php }

		//apple-touch-icon-72x72
		if( landspire_get_redux_option( 'general-settings-apple-touch-72', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( landspire_get_redux_option( 'general-settings-apple-touch-72', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="72x72">
		<?php } else { ?>
			<link href="<?php echo esc_url( LANDSPIRE_ASSETS_URI . '/images/apple-touch-icon-72x72.png') ?>" rel="apple-touch-icon" sizes="72x72">
		<?php }

		//apple-touch-icon-114x114
		if( landspire_get_redux_option( 'general-settings-apple-touch-114', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( landspire_get_redux_option( 'general-settings-apple-touch-114', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="114x114">
		<?php } else { ?>
			<link href="<?php echo esc_url( LANDSPIRE_ASSETS_URI . '/images/apple-touch-icon-114x114.png') ?>" rel="apple-touch-icon" sizes="114x114">
		<?php }

		//apple-touch-icon-144x144
		if( landspire_get_redux_option( 'general-settings-apple-touch-144', false, 'url' ) ) { ?>
			<link href="<?php echo esc_url( landspire_get_redux_option( 'general-settings-apple-touch-144', false, 'url' ) ); ?>" rel="apple-touch-icon" sizes="144x144">
		<?php } else { ?>
			<link href="<?php echo esc_url( LANDSPIRE_ASSETS_URI . '/images/apple-touch-icon-144x144.png') ?>" rel="apple-touch-icon" sizes="144x144">
		<?php }
	}
}


if(!function_exists('landspire_action_wp_head_at_the_end')) {
	/**
	 * Head Action put code at the end
	 */
	function landspire_action_wp_head_at_the_end() {
		landspire_header_custom_html_js();
	}
}


if(!function_exists('landspire_header_custom_html_js')) {
	/**
	 * Custom HTML/JS Code (in Footer)
	 */
	function landspire_header_custom_html_js() {
		if( landspire_get_redux_option( 'custom-codes-custom-html-script-header' ) ) {
			echo "\n";
			echo landspire_get_redux_option( 'custom-codes-custom-html-script-header' );
			echo "\n";
		}
	}
}


if(!function_exists('landspire_action_wp_footer')) {
	/**
	 * Footer Action
	 */
	function landspire_action_wp_footer() {
		landspire_footer_enable_smooth_scroll();
		landspire_footer_enable_backtotop();
		landspire_footer_custom_html_js();
	}
}


if(!function_exists('landspire_footer_enable_smooth_scroll')) {
	/**
	 * Enable Smooth Scrolling
	 */
	function landspire_footer_enable_smooth_scroll() {
		if( landspire_get_redux_option( 'general-settings-smooth-scroll' ) ) {
			wp_enqueue_script( 'tm-bundled-lenis' );
		}
	}
}

if(!function_exists('landspire_smooth_localscroll_add_class_to_body')) {
	/**
	 * Function add class localscroll to bg when lenis not enabled
	 */
	function landspire_smooth_localscroll_add_class_to_body ( $classes ) {
		$classes[] = '';
		if( ! landspire_get_redux_option( 'general-settings-smooth-scroll' ) ) {
			$classes[] = 'tm-enable-localscroll';
		}
		return $classes;
	}
	add_filter( 'body_class', 'landspire_smooth_localscroll_add_class_to_body' );
}


if(!function_exists('landspire_footer_enable_backtotop')) {
	/**
	 * Enable Back To Top
	 */
	function landspire_footer_enable_backtotop() {
		if( landspire_get_redux_option( 'general-settings-enable-backtotop' ) ) { ?>
			<div class="scroll-to-top"><a class="scroll-link" href="<?php echo esc_url( '#' )?>"><i class="lnr-icon-arrow-up"></i></a></div>
		<?php }
	}
}


if(!function_exists('landspire_footer_custom_html_js')) {
	/**
	 * Custom HTML/JS Code (in Footer)
	 */
	function landspire_footer_custom_html_js() {
		if( landspire_get_redux_option( 'custom-codes-custom-html-script-footer' ) ) {
			echo "\n";
			echo landspire_get_redux_option( 'custom-codes-custom-html-script-footer' );
			echo "\n";
		}
	}
}


if (!function_exists( 'landspire_require_core_plugin_message')) {
	/**
	 * Prints a mesasge in the admin if user hides TGMPA plugin activation message
	 */
	function landspire_require_core_plugin_message() {
		if ( get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_tgmpa', true ) && !mascot_core_landspire_plugin_installed() ) {
			$class = 'notice notice-error';
			$message = sprintf( esc_html__( 'For proper theme functioning, the %s plugins are required', 'landspire' ),
				"<strong>Mascot Core</strong>"
			);
			$message .= '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '">' . esc_html__( 'install', 'landspire' ) . '</a>';
			$message .= esc_html__( ' and activate the plugins.', 'landspire' );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
		}
	}
	add_action( 'admin_notices', 'landspire_require_core_plugin_message' );
}


if(!function_exists('landspire_add_theme_page')) {
	/**
	 * Add Theme Page
	 */
	function landspire_add_theme_page() {
		$theme_name = LandspireThemeInfo::get_instance()->get_name();
		add_menu_page(
			$theme_name,
			$theme_name,
			'manage_options',
			'mascot-about',
			'landspire_theme_page_about',
			'dashicons-admin-generic',
			4
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'Support & Help', 'landspire' ),
			esc_html__( 'Support & Help', 'landspire' ),
			'manage_options',
			'mascot-docs',
			'landspire_theme_page_docs'
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'FAQ', 'landspire' ),
			esc_html__( 'FAQ', 'landspire' ),
			'manage_options',
			'mascot-faq',
			'landspire_theme_page_faq'
		);
		add_submenu_page(
			'mascot-about',
			esc_html__( 'System Status', 'landspire' ),
			esc_html__( 'System Status', 'landspire' ),
			'manage_options',
			'mascot-system-status',
			'landspire_theme_page_system_status'
		);
		if ( mascot_core_landspire_plugin_installed() ) {
			add_submenu_page(
				'mascot-about',
				esc_html__( 'System Status', 'landspire' ),
				esc_html__( 'System Status', 'landspire' ),
				'manage_options',
				'mascot-system-status',
				'landspire_theme_page_system_status'
			);
		}
	}
	add_action('admin_menu', 'landspire_add_theme_page');
}

if(!function_exists('landspire_theme_page_about')) {
	function landspire_theme_page_about() {
		get_template_part( 'admin/admin-tpl/mascot-about' );
	}
}

if(!function_exists('landspire_theme_page_docs')) {
	function landspire_theme_page_docs() {
		get_template_part( 'admin/admin-tpl/mascot-docs' );
	}
}

if(!function_exists('landspire_theme_page_faq')) {
	function landspire_theme_page_faq() {
		get_template_part( 'admin/admin-tpl/mascot-faq' );
	}
}

if(!function_exists('landspire_theme_page_system_status')) {
	function landspire_theme_page_system_status() {
		get_template_part( 'admin/admin-tpl/mascot-system-status' );
	}
}
