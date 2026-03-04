<?php

if (!function_exists('landspire_get_footer_parts_wpb_shortcodes_custom_css')) {
	/**
	 * Add VC inline css to body
	 */
	function landspire_get_footer_parts_wpb_shortcodes_custom_css() {
		$current_page_id = landspire_get_page_id();

		//Footer Widget Area
		//check if meta value is provided for this page or then get it from theme options
		$temp_meta_value = landspire_get_rwmb_group( 'landspire_' . "page_mb_footer_settings", 'footer_widget_area', $current_page_id );
		if( ! landspire_metabox_opt_val_is_empty( $temp_meta_value ) && $temp_meta_value != "inherit" ) {
			$params['footer_widget_area'] = $temp_meta_value;
		} else {
			$params['footer_widget_area'] = landspire_get_redux_option( 'footer-settings-choose-footer-widget-area', 'default' );
		}


		//VC Custom CSS
		$shortcodes_custom_css = get_post_meta( $params['footer_widget_area'], '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			wp_add_inline_style( 'landspire-dynamic-style', $shortcodes_custom_css );
		}


	}
	add_action( 'wp_enqueue_scripts', 'landspire_get_footer_parts_wpb_shortcodes_custom_css' );
}



if (!function_exists('landspire_footer_bottom_background_color')) {
	/**
	 * Generate CSS codes for Footer Bottom Background Color
	 */
	function landspire_footer_bottom_background_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-bg-color';
		$declaration = array();
		$selector = array(
			'footer#footer',
			'footer#footer.footer-inverted',
		);

		//if empty then return
		if( !array_key_exists( $var_name, $landspire_redux_theme_opt ) ) {
			return;
		}

		if( $landspire_redux_theme_opt[$var_name] == '' ) {
			return;
		}

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		echo landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_bottom_background_color');
}




if (!function_exists('landspire_footer_widget_title_line_bottom_color')) {
	/**
	 * Generate CSS codes for Footer Top Widget Title Custom Line Bottom Color
	 */
	function landspire_footer_widget_title_line_bottom_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-widget-title-line-bottom-custom-color';
		//If Make Line Bottom Theme Colored?
		if( $landspire_redux_theme_opt['footer-settings-footer-widget-title-line-bottom-theme-colored'] != '' ) {
			return;
		}

		$declaration = array();
		$selector = array(
			'footer#footer .footer-widget-area .widget .widget-title.widget-title-line-bottom:after',
			'footer#footer.footer-inverted .footer-widget-area  .widget .widget-title.widget-title-line-bottom:after'
		);

		$declaration['background-color'] = $landspire_redux_theme_opt[$var_name];
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_widget_title_line_bottom_color');
}











if (!function_exists('landspire_footer_widget_title_typography')) {
	/**
	 * Generate CSS codes for Footer Top Widget Title Typography
	 */
	function landspire_footer_widget_title_typography() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-top-widget-title-typography';
		$declaration = array();
		$selector = array(
			'footer#footer .footer-widget-area .widget .widget-title',
			//'footer#footer.footer-inverted .footer-widget-area .widget .widget-title'
		);

		$declaration = landspire_redux_option_field_typography( $var_name );
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_widget_title_typography');
}

if (!function_exists('landspire_footer_widget_text_typography')) {
	/**
	 * Generate CSS codes for Footer Top Widget Text Typography
	 */
	function landspire_footer_widget_text_typography() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-top-widget-text-typography';
		$declaration = array();
		$selector = array(
			'footer#footer .footer-widget-area',
			//'footer#footer.footer-inverted .footer-widget-area'
		);

		$declaration = landspire_redux_option_field_typography( $var_name );
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_widget_text_typography');
}

if (!function_exists('landspire_footer_widget_link_typography')) {
	/**
	 * Generate CSS codes for Footer Top Widget Link Typography
	 */
	function landspire_footer_widget_link_typography() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-top-widget-link-typography';
		$declaration = array();
		$selector = array(
			'footer#footer .footer-widget-area a',
			//'footer#footer.footer-inverted .footer-widget-area a'
		);

		$declaration = landspire_redux_option_field_typography( $var_name );
		landspire_dynamic_css_generator($selector, $declaration);
	}
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_widget_link_typography');
}

if (!function_exists('landspire_footer_widget_link_hover_color')) {
	/**
	 * Generate CSS codes for Footer Top Widget Link Hover Color
	 */
	function landspire_footer_widget_link_hover_color() {
		global $landspire_redux_theme_opt;
		$var_name = 'footer-settings-footer-top-widget-link-hover-color';
		$declaration = array();
		$selector = array(
			'footer#footer .footer-widget-area a:hover',
			//'footer#footer.footer-inverted .footer-widget-area a:hover'
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
	add_action('landspire_dynamic_css_generator_action', 'landspire_footer_widget_link_hover_color');
}