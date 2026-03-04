<?php

/* Loads all blocks located in blocks folder
================================================== */
if( !function_exists('landspire_load_all_template_parts') ) {
	function landspire_load_all_template_parts() {
		foreach( glob(LANDSPIRE_FRAMEWORK_DIR.'/core/blocks/*/loader.php') as $each_template_part_loader ) {
			require_once $each_template_part_loader;
		}
	}
	add_action('landspire_before_custom_action', 'landspire_load_all_template_parts');
}