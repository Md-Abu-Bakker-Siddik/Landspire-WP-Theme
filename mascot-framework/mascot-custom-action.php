<?php

// Custom Action for this theme
add_action('after_setup_theme', 'landspire_custom_action_init', 0);

function landspire_custom_action_init() {

	do_action('landspire_before_custom_action');

	do_action('landspire_custom_action');

	do_action('landspire_after_custom_action');
}