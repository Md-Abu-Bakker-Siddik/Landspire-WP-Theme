<?php

if (!function_exists('landspire_sidebar_padding')) {
	/**
	 * Generate CSS codes for Sidebar Padding
	 */
	function landspire_sidebar_padding() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-padding';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		//added padding into the container.
		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name]['padding-top'] != "" ) {
			$declaration['padding-top'] = $landspire_redux_theme_opt[$var_name]['padding-top'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-right'] != "" ) {
			$declaration['padding-right'] = $landspire_redux_theme_opt[$var_name]['padding-right'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-bottom'] != "" ) {
			$declaration['padding-bottom'] = $landspire_redux_theme_opt[$var_name]['padding-bottom'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-left'] != "" ) {
			$declaration['padding-left'] = $landspire_redux_theme_opt[$var_name]['padding-left'];
		}
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_padding');
}


if (!function_exists('landspire_sidebar_bg_color')) {
	/**
	 * Generate CSS codes for Sidebar Background Color
	 */
	function landspire_sidebar_bg_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-bg-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_bg_color');
}


if (!function_exists('landspire_sidebar_text_align')) {
	/**
	 * Generate CSS codes for Sidebar Text Alignment
	 */
	function landspire_sidebar_text_align() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-text-align';
		$declaration = array();
		$selector = array(
			'.sidebar-area'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['text-align'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_text_align');
}





if (!function_exists('landspire_sidebar_title_padding')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Padding
	 */
	function landspire_sidebar_title_padding() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-padding';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		//added padding into the container.
		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name]['padding-top'] != "" ) {
			$declaration['padding-top'] = $landspire_redux_theme_opt[$var_name]['padding-top'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-right'] != "" ) {
			$declaration['padding-right'] = $landspire_redux_theme_opt[$var_name]['padding-right'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-bottom'] != "" ) {
			$declaration['padding-bottom'] = $landspire_redux_theme_opt[$var_name]['padding-bottom'];
		}
		if( $landspire_redux_theme_opt[$var_name]['padding-left'] != "" ) {
			$declaration['padding-left'] = $landspire_redux_theme_opt[$var_name]['padding-left'];
		}
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_title_padding');
}


if (!function_exists('landspire_sidebar_title_bg_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Background Color
	 */
	function landspire_sidebar_title_bg_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-bg-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_title_bg_color');
}


if (!function_exists('landspire_sidebar_title_text_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Text Color
	 */
	function landspire_sidebar_title_text_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-text-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_title_text_color');
}


if (!function_exists('landspire_sidebar_title_font_size')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Font Size
	 */
	function landspire_sidebar_title_font_size() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-font-size';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title'
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['font-size'] = $landspire_redux_theme_opt[$var_name] . 'px';
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_title_font_size');
}


if (!function_exists('landspire_sidebar_title_line_bottom_color')) {
	/**
	 * Generate CSS codes for Sidebar Widget Title Line Bottom Color
	 */
	function landspire_sidebar_title_line_bottom_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'sidebar-settings-sidebar-title-line-bottom-color';
		$declaration = array();
		$selector = array(
			'.sidebar-area .widget .widget-title.widget-title-line-bottom:after'
		);

		if( !landspire_get_redux_option( 'sidebar-settings-sidebar-title-show-line-bottom' ) ) {
			return;
		}

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_sidebar_title_line_bottom_color');
}