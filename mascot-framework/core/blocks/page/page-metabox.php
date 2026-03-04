<?php
add_filter( 'rwmb_meta_boxes', 'landspire_page_metaboxes' );

/**
 * Register meta boxes
 *
 * @param array $meta_boxes
 *
 * @return array
 */
function landspire_page_metaboxes( $meta_boxes ) {
	//list active sidebars
	$active_sidebar_list = array();
	$active_sidebar_list[ 'inherit' ] = esc_html__( 'Inherit from Theme Options', 'landspire' );
	$registered_sidebars = landspire_get_registered_sidebars();
	foreach ( $registered_sidebars as $key => $value ) {
		$active_sidebar_list[ $key ] = $value['name'];
	}

	//get primary thme location menu item
	$theme_locations = get_nav_menu_locations();
	$primary_nav_menu_name = 'none';
	if( array_key_exists('primary', $theme_locations) && !empty($theme_locations['primary']) ) {
		$primary_nav_menu_obj = get_term( $theme_locations['primary'], 'nav_menu' );
		$primary_nav_menu_name = $primary_nav_menu_obj->name;
	}

	//ALL custom post types
	//$post_types = get_post_types();

	//Get a List of All Revolution Slider Aliases
	//revslider version 6
	$list_rev_sliders = array();
	if ( class_exists( 'RevSliderSlider' ) ) {
		$list_rev_sliders[0] = esc_html__( 'Select a Slider', 'landspire' );
		$rev_slider = new RevSliderSlider();
		$all_rev_sliders = $rev_slider->get_sliders();
		foreach ( $all_rev_sliders as $each_slide ) {
			$list_rev_sliders[$each_slide->id] = $each_slide->alias;
		}
	}


	//Get a List of All Layer Slider Aliases
	$list_layer_sliders = array();
	if ( class_exists( 'LS_Sliders' ) ) {
		$list_layer_sliders[0] = esc_html__( 'Select a Slider', 'landspire' );
		$LS_Sliders_list = LS_Sliders::find();
		foreach ( $LS_Sliders_list as $each_slide ) {
			$list_layer_sliders[ $each_slide['id'] ] = $each_slide['name'];
		}
	}


	// Background Patterns Reader
	$sample_patterns_path = LANDSPIRE_ADMIN_ASSETS_DIR . '/images/pattern/';
	$sample_patterns_url  = LANDSPIRE_ADMIN_ASSETS_URI . '/images/pattern/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) {

		if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
			$sample_patterns = array();

			while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

				if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
					$name              = explode( '.', $sample_patterns_file );
					$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
					$sample_patterns[$sample_patterns_url . $sample_patterns_file] = $sample_patterns_url . $sample_patterns_file;
				}
			}
		}
	}


	$text_align_array = array(
		'inherit'			=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
		'text-left flip'	=> esc_html__( 'Left', 'landspire' ),
		'text-center'		=> esc_html__( 'Center', 'landspire' ),
		'text-right flip'	=> esc_html__( 'Right', 'landspire' ),
	);

	// Page Sidebar
	$meta_boxes[] = array(
		'id'			=> 'page_sidebar',
		'title'			=> esc_html__( 'Page Sidebar', 'landspire' ),
		'post_types'	=> array( 'post', 'page', 'portfolio', 'campaign' ),
		'context'		=> 'side',
		'priority'		=> 'low',
		// Sub-fields
		'fields'		=> array(
			array(
				'id'     => 'landspire_' . 'page_mb_sidebar_layout_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// Sub-fields
				'fields' => array(
					array(
						'name'		=> esc_html__( 'Sidebar Layout', 'landspire' ),
						'id'		=> 'sidebar_layout',
						'type'		=> 'image_select',
						'options' 	=> array(
							'inherit'				=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/inherit.png',
							'sidebar-right-25'		=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-right-25.png',
							'sidebar-right-33'		=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-right-33.png',
							'no-sidebar'			=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/no-sidebar.png',
							'sidebar-left-25'		=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-left-25.png',
							'sidebar-left-33'		=> LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-left-33.png',
							'both-sidebar-25-50-25' => LANDSPIRE_ADMIN_ASSETS_URI . '/images/sidebar/both-sidebar-25-50-25.png',
						),
						'std'		=> 'inherit',
					),
					array(
						'name'		=> esc_html__( 'Pick Sidebar Default', 'landspire' ),
						'id'		=> 'sidebar_default',
						'type'		=> 'select',
						'options'	=> $active_sidebar_list,
					),
					array(
						'type' 		=> 'heading',
						'name' 		=> esc_html__( 'Sidebar 2 Settings', 'landspire' ),
						'desc'		=> esc_html__( 'Sidebar 2 will only be used if "Sidebar Both Side" is selected.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Pick Sidebar 2', 'landspire' ),
						'id'		=> 'sidebar_two',
						'type'		=> 'select',
						'options'   => $active_sidebar_list,
					),
					array(
						'name'		=> esc_html__( 'Sidebar 2 Position', 'landspire' ),
						'id'		=> 'sidebar_two_position',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Controls the position of sidebar 2. In that case, sidebar 1 will be shown on opposite side.', 'landspire' ),
						'options'	=> array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'left'		=> esc_html__( 'Left', 'landspire' ),
							'right'	 	=> esc_html__( 'Right', 'landspire' )
						),
					),
				),
			),
		),
	);

	// Meta Box Settings for this Page
	$meta_boxes[] = array(
		'title'	 => esc_html__( 'Page Settings', 'landspire' ),
		'post_types' => array( 'post', 'page', 'portfolio', 'campaign' ),
		'priority'   => 'high',

		// List of tabs, in one of the following formats:
		// 1) key => label
		// 2) key => array( 'label' => Tab label, 'icon' => Tab icon )
		'tabs'		=> array(


			'header'  => array(
				'label' => esc_html__( 'Header', 'landspire' ),
				'icon'  => 'dashicons-arrow-up-alt', // Dashicon
			),
			'theme-color' => array(
				'label' => esc_html__( 'Theme Color Settings', 'landspire' ),
				'icon'  => 'dashicons-art', // Dashicon
			),
			'typography-setting' => array(
				'label' => esc_html__( 'Typography Settings', 'landspire' ),
				'icon'  => 'dashicons-editor-bold', // Dashicon
			),
			'logo' => array(
				'label' => esc_html__( 'Logo', 'landspire' ),
				'icon'  => 'dashicons-palmtree', // Dashicon
			),
			'page-title'		=> array(
				'label' => esc_html__( 'Page Title', 'landspire' ),
				'icon'  => 'dashicons-archive', // Dashicon
			),
			'layout-setings'	=> array(
				'label' => esc_html__( 'Layout Settings', 'landspire' ),
				'icon'  => 'dashicons-editor-table', // Dashicon
			),
			'dark-layouts'	=> array(
				'label' => esc_html__( 'Dark Mode', 'landspire' ),
				'icon'  => 'dashicons-editor-table', // Dashicon
			),
			'footer'	=> array(
				'label' => esc_html__( 'Footer Settings', 'landspire' ),
				'icon'  => 'dashicons-arrow-down-alt', // Dashicon
			),
			'slider' => array(
				'label' => esc_html__( 'Slider Settings', 'landspire' ),
				'icon'  => 'dashicons-update', // Dashicon
			),
			'general' => array(
				'label' => esc_html__( 'General Settings', 'landspire' ),
				'icon'  => 'dashicons-admin-home', // Dashicon
			),
		),

		// Tab style: 'default', 'box' or 'left'. Optional
		'tab_style' => 'left',

		// Show meta box wrapper around tabs? true (default) or false. Optional
		'tab_wrapper' => true,

		'fields'	=> array(


			//Header tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_header_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'header',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Header Visibility', 'landspire' ),
						'id'		=> 'header_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide complete header only for this page.', 'landspire' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'   		=> esc_html__( 'Show', 'landspire' ),
							'0' 		=> esc_html__( 'Hide', 'landspire' ),
						),
					),



					// DIVIDER
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header  (Built with Elementor)', 'landspire' ),
					),

					array(
						'name' => esc_html__( 'Choose Header (Elementor)', 'landspire' ),
						'desc' => sprintf(esc_html__('Made using Elementor. Create your own one from %s', 'landspire'), '<a href="'.admin_url('edit.php?post_type=header-top').'" target="_blank">Dashboard > Parts - Header Top</a>'),
						'id'          => 'headertop_cpt_elementor',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Header', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Or Choose Transparent Header (Elementor)', 'landspire' ),
						'desc' => esc_html__( 'Made From Custom Post Type by using Elementor.', 'landspire' ),
						'id'          => 'headertop_cpt_elementor_transparent',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Header', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Choose Header Sticky (Elementor)', 'landspire' ),
						'desc' => esc_html__( 'It will be shown when you scroll down. Made From Custom Post Type by using Elementor.', 'landspire' ),
						'id'          => 'headertop_cpt_elementor_sticky',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Sticky Header', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Choose Header Mobile/Tab (Elementor)', 'landspire' ),
						'desc' => esc_html__( 'It will be visible on Tab & Mobile devices only. Made From Custom Post Type by using Elementor.', 'landspire' ),
						'id'          => 'headertop_cpt_elementor_mobile',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Sticky Header', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),








					array(
						'type' => 'heading',
						'name' => esc_html__( 'Default Header Navigation Row', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Default Header Nav Row (Show/Hide)', 'landspire' ),
						'id'		=> 'header_nav_row_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide default header nav row only for this page.', 'landspire' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'   		=> esc_html__( 'Show', 'landspire' ),
							'0' 		=> esc_html__( 'Hide', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Primary Navigation Menu', 'landspire' ),
						'id'		=> 'custom_primary_nav_menu',
						'type'		=> 'select',
						'desc'		=> sprintf( esc_html__( 'Select which menu you want to display as primary navigation on this page. Currently set to %1$s%2$s%3$s.', 'landspire' ), '<a target="_blank" href="' . esc_url( admin_url( 'nav-menus.php?action=locations' ) ) . '">', $primary_nav_menu_name, '</a>' ),
						'options'   => landspire_get_registered_menus(),
					),
					array(
						'name'		=> esc_html__( 'Enable One Page Nav Smooth Scrolling Effect', 'landspire' ),
						'id'		=> 'enable_one_page_nav_scrolling_effect',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Check this box in order to enable one page navigation smooth scrollling effect.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Show Custom Button', 'landspire' ),
						'id'		=> 'show_custom_button',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Enabling this option will show Custom Button.', 'landspire' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'   		=> esc_html__( 'Yes', 'landspire' ),
							'0' 		=> esc_html__( 'No', 'landspire' ),
						),
					),
					array(
						'name'		=> 'title',
						'id'		=> 'custom_button_title',
						'type'		=> 'text',
						'visible'   => array(
							array( 'show_custom_button', '=', '1' )
						),
					),
					array(
						'name'		=> 'link',
						'id'		=> 'custom_button_link',
						'type'		=> 'text',
						'visible'   => array(
							array( 'show_custom_button', '=', '1' )
						),
					),
					array(
						'name'		=> esc_html__( 'Main Nav Items Text Color', 'landspire' ),
						'id'		=> 'main_nav_items_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   	=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'white'   	=> esc_html__( 'Text White', 'landspire' ),
							'dark' 	=> esc_html__( 'Text Dark', 'landspire' ),
						),
					),








					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Layout', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Header Layout Type (Built in)', 'landspire' ),
						'id'		=> 'header_layout_type',
						'type'		=> 'select',
						'options'   => array(
							'inherit'						=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'header-current-theme-style1'	=> esc_html__( 'Header Current Theme Style 1', 'landspire' ),
							'header-current-theme-style2'	=> esc_html__( 'Header Current Theme Style 2', 'landspire' ),

							'header-side-panel-nav'			=> esc_html__( 'Side Push Panel Nav', 'landspire' ),
							'header-vertical-nav'			=> esc_html__( 'Vertical Nav', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Header Container', 'landspire' ),
						'id'		=> 'header_container',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'container' 		=> esc_html__( 'Container', 'landspire' ),
							'container-fluid' 	=> esc_html__( 'Container Fluid', 'landspire' )
						),
					),




					// DIVIDER
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Floating Options', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Header Background Shadow (Header Floating)', 'landspire' ),
						'id'		=> 'header_floating_bg_shadow',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'header-bg-no-shadow'		=> esc_html__( 'No Shadow', 'landspire' ),
							'header-bg-dark-shadow'		=> esc_html__( 'Dark Background Shadow', 'landspire' ),
							'header-bg-light-shadow'	=> esc_html__( 'Light Background Shadow', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Text Color (Header Floating)', 'landspire' ),
						'id'		=> 'header_floating_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'header-floating-bg-dark-text-white'	=> esc_html__( 'White Text', 'landspire' ),
							'header-floating-bg-white-text-dark'		=> esc_html__( 'Dark Text', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color (on Header Floating + Sticky)', 'landspire' ),
						'id'		=> 'header_floating_bg_color_sticky',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'header-floating-sticky-bg-white'	=> esc_html__( 'White BG', 'landspire' ),
							'header-floating-sticky-bg-dark'		=> esc_html__( 'Dark BG', 'landspire' ),
						),
					),



					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Layout - Vertical Nav', 'landspire' ),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'landspire' ),
						'id'		=> 'vertical_nav_bgcolor',
						'type'		=> 'color',
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'landspire' ),
						'id'		=> 'vertical_nav_bgimg',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Shadow', 'landspire' ),
						'id'		=> 'vertical_nav_shadow',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Vertical Area Border', 'landspire' ),
						'id'		=> 'vertical_nav_border',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Center Content', 'landspire' ),
						'id'		=> 'vertical_nav_content',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),

				),
			),
			//Header tab ends





			//theme-color tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_theme_color_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'theme-color',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Theme Color Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Change Primary Theme Color', 'landspire' ),
						'id'		=> 'change_primary_theme_color',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'If you want to change primary theme color of this page then check this option.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Primary Theme Color', 'landspire' ),
						'id'		=> 'primary_theme_color',
						'type'		=> 'select',
						'options'   => landspire_metabox_get_list_of_predefined_theme_color_css_files(),
						'visible'   => array(
							array( 'change_primary_theme_color', '=', true )
						),
					),
				),
			),
			//theme-color tab ends





			//typography-setting tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_typography_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'typography-setting',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Typography', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Change Typography', 'landspire' ),
						'id'		=> 'change_typography',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'If you want to change typography of this page then check this option.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Predefined Typography', 'landspire' ),
						'id'		=> 'primary_typography_set',
						'type'		=> 'select',
						'options'   => landspire_metabox_get_list_of_predefined_typography_files(),
						'visible'   => array(
							array( 'change_typography', '=', true )
						),
					),
				),
			),
			//typography-setting tab ends



			//Logo tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_logo_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'logo',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Logo Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Alternative Site Brand', 'landspire' ),
						'id'		=> 'logo_site_brand',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as logo.', 'landspire' ),
						'type'		=> 'text',
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Logo', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Use logo in replace of text?', 'landspire' ),
						'id'		=> 'use_logo',
						'type'		=> 'select',
						'options'   => array(
							'inherit' 	=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Logo (Default)', 'landspire' ),
						'id'		=> 'logo_default',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Logo for Mobile Version', 'landspire' ),
						'id'		=> 'logo_mobile_version',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Switchable logo', 'landspire' ),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Switchable logo(Light/Dark)?', 'landspire' ),
						'id'		=> 'use_switchable_logo',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Logo (Default)', 'landspire' ),
						'id'		=> 'logo_light',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_switchable_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Logo (Sticky Mode)', 'landspire' ),
						'id'		=> 'logo_dark',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_switchable_logo', '!=', '0' ),
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Logo height', 'landspire' ),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Maximum logo height(px)', 'landspire' ),
						'id'		=> 'logo_maximum_height',
						'type'		=> 'slider',
						'desc'		=> esc_html__( 'Enter maximum logo height in px.', 'landspire' ),
						'suffix' => esc_html__( 'px', 'landspire' ),
						'js_options' => array(
							'min'  => 20,
							'max'  => 150,
							'step' => 1,
						),
						// Default value
						'std'		=> 40,
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
),
			),
			//Logo tab ends



			//Page Title tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_page_title_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'page-title',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Page Title', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Enable Page Title', 'landspire' ),
						'id'		=> 'enable_page_title',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),

					array(
						'name' => esc_html__( 'Choose Page Title (Built with Elementor)', 'landspire' ),
						'id'          => 'page_title_widget_area',
						'type'        => 'post',
						'desc'		=> sprintf(esc_html__('Create your own one from %s', 'landspire'), '<a href="'.admin_url('edit.php?post_type=page-title').'" target="_blank">Dashboard > Parts - Page Title</a>'),

						// Post type.
						'post_type'   => 'page-title',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Page Title', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Title & Subtitle', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Page Title Type', 'landspire' ),
						'id'		=> 'page_title_type',
						'type'		=> 'select',
						'options'   => array(
							'page-title'   		=> esc_html__( 'Show This Page Title', 'landspire' ),
							'custom-title'		=> esc_html__( 'Enter Custom Title', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Custom Title Text', 'landspire' ),
						'id'		=> 'custom_page_title_text',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as page title.', 'landspire' ),
						'type'		=> 'text',
						'visible'   => array(
							array( 'page_title_type', '=', 'custom-title' )
						),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Text', 'landspire' ),
						'id'		=> 'page_sub_title_text',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as subtitle.', 'landspire' ),
						'type'		=> 'text',
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Page Title Layout', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Page Title Layout', 'landspire' ),
						'id'		=> 'title_layout',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'standard'  => esc_html__( 'Standard', 'landspire' ),
							'split'	 	=> esc_html__( 'Split', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Container', 'landspire' ),
						'id'		=> 'title_container',
						'type'		=> 'select',
						'options'   => array(
							'inherit'			=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'container'			=> esc_html__( 'Container', 'landspire' ),
							'container-fluid'   => esc_html__( 'Container Fluid', 'landspire' )
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Text Alignment', 'landspire' ),
						'id'		=> 'title_text_align',
						'type'		=> 'select',
						'options'   => $text_align_array,
					),
					array(
						'name'		=> esc_html__( 'Default Text Color', 'landspire' ),
						'id'		=> 'title_default_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'text-light' 	=> esc_html__( 'Light Text', 'landspire' ),
							'text-dark'  	=> esc_html__( 'Dark Text', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Height', 'landspire' ),
						'id'		=> 'title_area_height',
						'type'		=> 'select',
						'options'   => array(
							'inherit'				=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'padding-default'		=> esc_html__( 'Default', 'landspire' ),
							'padding-extra-small'   => esc_html__( 'Extra Small', 'landspire' ),
							'padding-small'			=> esc_html__( 'Small', 'landspire' ),
							'padding-medium'		=> esc_html__( 'Medium', 'landspire' ),
							'padding-large'			=> esc_html__( 'Large', 'landspire' ),
							'padding-extra-large'   => esc_html__( 'Extra Large', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Show Title', 'landspire' ),
						'id'		=> 'title_area_show_title',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Show Breadcrumbs', 'landspire' ),
						'id'		=> 'title_area_show_breadcrumbs',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Page Title Background', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Page Title Background Type', 'landspire' ),
						'id'		=> 'title_area_bg_type',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'bg-color'  => esc_html__( 'Background Color', 'landspire' ),
							'bg-img'	=> esc_html__( 'Background Image', 'landspire' ),
							'bg-video'	=> esc_html__( 'Background Video', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'landspire' ),
						'id'		=> 'title_area_bgcolor',
						'type'		=> 'color',
						'visible'   => array(
							array( 'title_area_bg_type', '=', 'bg-color' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'landspire' ),
						'id'		=> 'title_area_bgimg',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_type', '=', 'bg-img' )
						),
					),



					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Background Overlay', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Add Page Title Background Overlay?', 'landspire' ),
						'id'		=> 'title_area_bg_layer_overlay_status',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Overlay Opacity', 'landspire' ),
						'id'		=> 'title_area_bg_layer_overlay_opacity',
						'type'		=> 'slider',
						'desc'		=> esc_html__( 'Overlay on background image on Page Title.', 'landspire' ),
						'js_options' => array(
							'min'  => 1,
							'max'  => 9,
							'step' => 1,
						),
						// Default value
						'std'		=> 7,
						'visible'   => array(
							array( 'title_area_bg_layer_overlay_status', '=', '1' )
						),
					),
					array(
						'name'		=> esc_html__( 'Overlay Color', 'landspire' ),
						'id'		=> 'title_area_bg_layer_overlay_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'dark'  	=> esc_html__( 'Dark', 'landspire' ),
							'white' 	=> esc_html__( 'White', 'landspire' )
						),
						'visible'   => array(
							array( 'title_area_bg_layer_overlay_status', '=', '1' )
						),
					),



					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Animation Effect', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Title Animation Effect', 'landspire' ),
						'id'		=> 'title_animation_effect',
						'type'		=> 'select_advanced',
						'options'   => mascot_core_landspire_animate_css_animation_list(),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Animation Effect', 'landspire' ),
						'id'		=> 'subtitle_animation_effect',
						'type'		=> 'select_advanced',
						'options'   => mascot_core_landspire_animate_css_animation_list(),
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Typography', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Title Tag', 'landspire' ),
						'id'		=> 'title_tag',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'h1'		=> 'h1',
							'h2'		=> 'h2',
							'h3'		=> 'h3',
							'h4'		=> 'h4',
							'h5'		=> 'h5',
							'h6'		=> 'h6',
						),
					),
					array(
						'name'		=> esc_html__( 'Title Color', 'landspire' ),
						'id'		=> 'title_color',
						'type'		=> 'color',
					),
					array(
						'name'		=> esc_html__( 'Subtitle Tag', 'landspire' ),
						'id'		=> 'subtitle_tag',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'h1'		=> 'h1',
							'h2'		=> 'h2',
							'h3'		=> 'h3',
							'h4'		=> 'h4',
							'h5'		=> 'h5',
							'h6'		=> 'h6',
						),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Color', 'landspire' ),
						'id'		=> 'subtitle_color',
						'type'		=> 'color',
					),
				),
			),
			//Page Title tab ends



			//Layout tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_layout_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'layout-setings',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Layout Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Page Layout', 'landspire' ),
						'id'		=> 'page_layout',
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'boxed'			=> esc_html__( 'Boxed', 'landspire' ),
							'stretched'	 	=> esc_html__( 'Stretched', 'landspire' )
						),
					),


					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Content Width Setting', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Content Width', 'landspire' ),
						'id'		=> 'content_width',
						'desc'		=> esc_html__( 'Select content width. You can use any width by using custom CSS.', 'landspire' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'				=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'container-970px'	 	=> esc_html__( '970px', 'landspire' ),
							'container-default'		=> esc_html__( '1170px (Bootstrap Default)', 'landspire' ),
							'container-1230px'		=> esc_html__( '1230px (Wide)', 'landspire' ),
							'container-1300px'		=> esc_html__( '1300px (Wider)', 'landspire' ),
							'container-1340px'		=> esc_html__( '1340px (Wider)', 'landspire' ),
							'container-1440px'		=> esc_html__( '1440px (Wider)', 'landspire' ),
							'container-1500px'		=> esc_html__( '1500px (Wider)', 'landspire' ),
							'container-1600px'		=> esc_html__( '1600px (Wider)', 'landspire' ),
							'container-100pr'	 	=> esc_html__( 'Fullwidth 100%', 'landspire' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Solid Color(For Stretched Mode)', 'landspire' ),
						'id'		=> 'stretched_layout_bg_color',
						'type'		=> 'color',
					),


					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Boxed Layout Settings', 'landspire' ),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),
					array(
						'name'		=> esc_html__( 'Padding Top(px)', 'landspire' ),
						'id'		=> 'boxed_layout_padding_top',
						'desc'		=> esc_html__( 'Please put only integer value. Because the unit \'px\' will be automatically added at the end of the value.', 'landspire' ),
						'type'		=> 'number',
						'visible'   => array(
							array( 'page_layout', '!=', 'stretched' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Padding Bottom(px)', 'landspire' ),
						'id'		=> 'boxed_layout_padding_bottom',
						'desc'		=> esc_html__( 'Please put only integer value. Because the unit \'px\' will be automatically added at the end of the value.', 'landspire' ),
						'type'		=> 'number',
						'visible'   => array(
							array( 'page_layout', '!=', 'stretched' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Container Shadow?', 'landspire' ),
						'id'		=> 'boxed_layout_container_shadow',
						'desc'		=> esc_html__( 'Add shadow around the container.', 'landspire' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),


					array(
						'name'		=> esc_html__( 'Background Type', 'landspire' ),
						'id'		=> 'boxed_layout_bg_type',
						'desc'		=> esc_html__( 'You can use patterns, image or solid color as a background.', 'landspire' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'bg-color'	 	=> esc_html__( 'Solid Color', 'landspire' ),
							'bg-pattern'	=> esc_html__( 'Patterns from Theme Library', 'landspire' ),
							'bg-image'	 	=> esc_html__( 'Upload Own Image', 'landspire' ),
						),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'landspire' ),
						'id'		=> 'boxed_layout_bg_type_color',
						'type'		=> 'color',
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-color' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Pattern from Theme Library', 'landspire' ),
						'id'		=> 'boxed_layout_bg_type_pattern',
						'type'		=> 'image_select',
						// Array of 'value' => 'Image Source' pairs
						'options'   => $sample_patterns,
						'std'		=> $sample_patterns[key($sample_patterns)],
						// Allow to select multiple values? Default is false
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-pattern' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'landspire' ),
						'id'		=> 'boxed_layout_bg_type_img',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-image' )
						),
					),
				),
			),
			//Layout tab ends



			//dark layout tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_dark_layouts_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'dark-layouts',
				// Sub-fields
				'fields' => array(
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Dark Mode Settings', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Enable Dark Layout Mode', 'landspire' ),
						'id'		=> 'enable_dark_layout_mode',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Check this box to enable dark layout mode.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Custom Dark Background Color', 'landspire' ),
						'id'		=> 'dark_layout_mode_bg_color',
						'type'		=> 'color',
						'desc'		=> esc_html__( 'You can choose custom Background Color. Otherwise it will come from style css file.', 'landspire' ),
					),
				),
			),
			//Layout tab ends


			//footer tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_footer_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'footer',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Footer Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Footer Visibility', 'landspire' ),
						'id'		=> 'footer_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide footer only for this page.', 'landspire' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Show', 'landspire' ),
							'0'			=> esc_html__( 'Hide', 'landspire' ),
						),
					),
					array(
						'name' => esc_html__( 'Choose Footer (Built with Elementor)', 'landspire' ),
						'id'          => 'footer_widget_area',
						'type'        => 'post',
						'desc'		=> sprintf(esc_html__('Create your own one from %s', 'landspire'), '<a href="'.admin_url('edit.php?post_type=footer').'" target="_blank">Dashboard > Parts - Footer</a>'),

						// Post type.
						'post_type'   => 'footer',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Footer', 'landspire' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),
					array(
						'name'		=> esc_html__( 'Fixed Footer Bottom Effect', 'landspire' ),
						'id'		=> 'footer_fixed_footer_bottom',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Enabling this option will make Footer gradually appear on scroll. This is popular for OnePage Websites.', 'landspire' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),
				),
			),
			//footer tab ends




			//slider tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_slider_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'slider',
				// Sub-fields
				'fields' => array(
					//slider tab starts
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Slider Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Slider Type', 'landspire' ),
						'id'		=> 'slider_type',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the type of slider you want to display.', 'landspire' ),
						'options'   => array(
							'no-slider'			=> esc_html__( 'No Slider', 'landspire' ),
							'rev-slider'		=> esc_html__( 'Slider Revolution', 'landspire' ),
							'layer-slider'		=> esc_html__( 'Layer Slider', 'landspire' ),
						),
						'std'		=> 'no-slider',
					),
					array(
						'name'		=> esc_html__( 'Choose Revolution Slider', 'landspire' ),
						'id'		=> 'select_rev_slider',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the name(alias) of the revolution slider you want to display.', 'landspire' ),
						'options'   => $list_rev_sliders,
						'visible'   => array( 'slider_type', '=', 'rev-slider' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Layer Slider', 'landspire' ),
						'id'		=> 'select_layer_slider',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the name(alias) of the revolution slider you want to display.', 'landspire' ),
						'options'   => $list_layer_sliders,
						'visible'   => array( 'slider_type', '=', 'layer-slider' ),
					),
					array(
						'name'		=> esc_html__( 'Slider Position', 'landspire' ),
						'id'		=> 'slider_position',
						'type'		=> 'select',
						'desc' => esc_html__( 'Choose position of the slider you want to display. You can put it below or above the header.', 'landspire' ),
						'options'   => array(
							'default'		=> esc_html__( 'Default', 'landspire' ),
							'below-header'	=> esc_html__( 'Below Header', 'landspire' ),
							'above-header'	=> esc_html__( 'Above Header', 'landspire' ),
						),
						'std'		=> 'default',
						'visible'   => array( 'slider_position', '!=', 'no-slider' ),
					),
					//slider tab ends


				),
			),
			//slider tab ends


			//general tab starts
			array(
				'id'     => 'landspire_' . 'page_mb_general_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'general',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'General Settings', 'landspire' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Hide Featured Image', 'landspire' ),
						'id'		=> 'hide_featured_image',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide Featured Image in blog page.', 'landspire' ),
					),
					array(
						'name'		=> esc_html__( 'Show Comments', 'landspire' ),
						'id'		=> 'show_comments',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'landspire' ),
							'1'			=> esc_html__( 'Yes', 'landspire' ),
							'0'			=> esc_html__( 'No', 'landspire' ),
						),
					),
				),
			),
			//general tab ends


		),
	);


	return $meta_boxes;
}
