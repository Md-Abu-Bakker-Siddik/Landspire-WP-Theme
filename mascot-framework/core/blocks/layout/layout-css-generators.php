<?php

if (!function_exists('landspire_layout_settings_boxed_layout_padding_top_bottom')) {
	/**
	 * Generate CSS codes for Boxed Layout - Padding Top & Bottom
	 */
	function landspire_layout_settings_boxed_layout_padding_top_bottom() {
		global $landspire_redux_theme_opt;
		$var_name = 'layout-settings-boxed-layout-padding-top-bottom';
		$declaration = array();
		$selector = array(
			'body.tm-boxed-layout',
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		//if Page Layout boxed
		if( landspire_get_redux_option( 'layout-settings-page-layout' ) == 'boxed' ) {
			$padding_top = $landspire_redux_theme_opt[$var_name]['padding-top'];
			$padding_bottom = $landspire_redux_theme_opt[$var_name]['padding-bottom'];

			if( !empty( $padding_top ) && $padding_top != "" ) {
				$padding_top = landspire_remove_suffix( $padding_top, 'px');
				$declaration['padding-top'] = $padding_top . 'px';
			}
			if( !empty( $padding_bottom ) && $padding_bottom != "" ) {
				$padding_bottom = landspire_remove_suffix( $padding_bottom, 'px');
				$declaration['padding-bottom'] = $padding_bottom . 'px';
			}
		}

		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_layout_settings_boxed_layout_padding_top_bottom');
}


if (!function_exists('landspire_stretched_layout_background_color')) {
	/**
	 * Generate CSS codes for Stretched Layout - Background Color
	 */
	function landspire_stretched_layout_background_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'layout-settings-stretched-layout-bg-bgcolor';
		$declaration = array();
		$selector = array(
			'body.tm-stretched-layout',
		);

		//if empty then return
		if( landspire_get_redux_option( 'layout-settings-page-layout' ) != 'stretched' ) {
			return;
		}
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( landspire_get_redux_option( 'layout-settings-boxed-layout-bg-type' ) == 'bg-color' ) {
			if( $landspire_redux_theme_opt[$var_name] != "" ) {
				$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
			}
			landspire_dynamic_css_generator($selector, $declaration);
		}
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_stretched_layout_background_color');
}


if (!function_exists('landspire_boxed_layout_background_color')) {
	/**
	 * Generate CSS codes for Boxed Layout - Background Color
	 */
	function landspire_boxed_layout_background_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'layout-settings-boxed-layout-bg-type-bgcolor';
		$declaration = array();
		$selector = array(
			'body.tm-boxed-layout',
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( landspire_get_redux_option( 'layout-settings-boxed-layout-bg-type' ) == 'bg-color' ) {
			if( $landspire_redux_theme_opt[$var_name] != "" ) {
				$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
			}
			landspire_dynamic_css_generator($selector, $declaration);
		}
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_boxed_layout_background_color');
}




if (!function_exists('landspire_boxed_layout_background_pattern')) {
	/**
	 * Generate CSS codes for Boxed Layout - Background Pattern
	 */
	function landspire_boxed_layout_background_pattern() {
		global $landspire_redux_theme_opt;
		$var_name = 'layout-settings-boxed-layout-bg-type-pattern';
		$declaration = array();
		$selector = array(
			'body.tm-boxed-layout',
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( landspire_get_redux_option( 'layout-settings-boxed-layout-bg-type' ) == 'bg-patter' ) {
			if( $landspire_redux_theme_opt[$var_name] != "" ) {
				$declaration['background-image'] = 'url('.$landspire_redux_theme_opt[$var_name].')';
			}
			landspire_dynamic_css_generator($selector, $declaration);
		}
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_boxed_layout_background_pattern');
}


if (!function_exists('landspire_boxed_layout_bg')) {
	/**
	 * Generate CSS codes for Widget Footer Background
	 */
	function landspire_boxed_layout_bg() {
		global $landspire_redux_theme_opt;
		$var_name = 'layout-settings-boxed-layout-bg-type-bgimg';
		$declaration = array();
		$selector = array(
			'body.tm-boxed-layout',
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( landspire_get_redux_option( 'layout-settings-boxed-layout-bg-type' ) == 'bg-image' ) {
			$declaration = landspire_redux_option_field_background( $var_name );
			landspire_dynamic_css_generator($selector, $declaration);
		}
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_boxed_layout_bg');
}





if (!function_exists('landspire_dark_layout_background_color')) {
	/**
	 * Generate CSS codes for dark Layout - Background Color
	 */
	function landspire_dark_layout_background_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'general-settings-dark-mode-custom-bgcolor';
		$declaration = array();
		$selector = array(
			'[data-tm-layout="dark"]'
		);

		//if empty then return
		if( landspire_get_redux_option( 'general-settings-enable-dark-mode' ) != '1' ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] != "" ) {
			$declaration['--body-bg'] = $landspire_redux_theme_opt[$var_name] . '!important';
			landspire_dynamic_css_generator($selector, $declaration);
		}
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_dark_layout_background_color');
}