<?php

if (!function_exists('landspire_sidebar_widget_title_line_bottom_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Custom Line Bottom Color
	 */
	function landspire_sidebar_widget_title_line_bottom_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-line-bottom-custom-color';
		//If Make Line Bottom Theme Colored?
		if( $landspire_redux_theme_opt['sidebar-settings-sidebar-title-line-bottom-theme-colored'] != '' ) {
			return;
		}

		$declaration = array();
		$selector = array(
			'.widget .widget-title.widget-title-line-bottom:after'
		);

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_widget_title_line_bottom_color');
}