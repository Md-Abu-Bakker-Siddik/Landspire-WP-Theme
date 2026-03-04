<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
$header_return_true_false = ( landspire_get_redux_option( '404-page-settings-show-header', true ) == true ) ? 'landspire_return_true' : 'landspire_return_false';
add_filter( 'landspire_filter_show_header', $header_return_true_false );

$footer_return_true_false = ( landspire_get_redux_option( '404-page-settings-show-footer', true ) == true ) ? 'landspire_return_true' : 'landspire_return_false';
add_filter( 'landspire_filter_show_footer', $footer_return_true_false );

get_header();

landspire_get_title_area_parts();

landspire_get_404_parts();

get_footer();
