<?php

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'landspire_dequeue_styles' );
function landspire_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_filter('woocommerce_product_additional_information_heading', '__return_null');
add_filter('woocommerce_product_description_heading', '__return_null');

//woo cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 9 );
if (!function_exists('landspire_shop_woocommerce_cart_totals_clearfix')) {
	/**
	 * custom after main content
	 */
	function landspire_shop_woocommerce_cart_totals_clearfix() {
		?>
		<div class="clearfix"></div>
		<?php
	}
	add_action( 'woocommerce_cart_collaterals', 'landspire_shop_woocommerce_cart_totals_clearfix', 9 );
}

if (!function_exists('landspire_shop_archive_before_main_content_page_title')) {
	/**
	 * show page title
	 */
	function landspire_shop_archive_before_main_content_page_title() {
		landspire_get_title_area_parts();
	}
	add_action( 'woocommerce_before_main_content', 'landspire_shop_archive_before_main_content_page_title', 10 );
}



if (!function_exists('landspire_shop_archive_wrapper_start')) {
	/**
	 * custom before main content
	 */
	function landspire_shop_archive_wrapper_start() {
		$container = false;

		if( is_product() ) {
			$container = landspire_get_redux_option( 'shop-single-product-settings-fullwidth' );
		} else if ( is_shop() || is_product_category() || is_product_tag() ) {
			$container = landspire_get_redux_option( 'shop-archive-settings-fullwidth' );
		}

		if( $container ) {
			$container = 'container-fluid';
		} else {
			$container = 'container';
		}
		?>
		<section><div class="<?php echo esc_attr($container) ?>">
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'landspire_shop_archive_wrapper_start', 10 );
}



if (!function_exists('landspire_shop_archive_wrapper_end')) {
	/**
	 * custom after main content
	 */
	function landspire_shop_archive_wrapper_end() {
		?>
		</div></section>
		<?php
	}
	add_action( 'woocommerce_after_main_content', 'landspire_shop_archive_wrapper_end', 10 );
}



if (!function_exists('landspire_woo_hide_page_title')) {
	/**
	 * remove page title
	 */
	function landspire_woo_hide_page_title() {
		return false;
	}
	add_filter( 'woocommerce_show_page_title' , 'landspire_woo_hide_page_title' );
}



if (!function_exists('landspire_shop_archive_sidebar_position_before')) {
	/**
	 * shop sidebar
	 */
	function landspire_shop_archive_sidebar_position_before() {
		if( is_product() ) {
			return;
		}
		$sidebar_position = landspire_get_redux_option( 'shop-archive-settings-sidebar-position' );
		$sidebar_layout = landspire_get_redux_option( 'shop-archive-settings-sidebar-layout' );
		switch ( $sidebar_position ) {
			case 'left':
			case 'right':
				# code...
			?>
			<div class="row tm-blog-sidebar-row tm-shop-sidebar-row">
				<div class="col-lg-8 col-xl-<?php echo esc_attr( 12-$sidebar_layout );?> <?php if( $sidebar_position == 'left' ) echo esc_attr( 'order-lg-1' ); ?>">
					<div class="main-content-area">
			<?php
				break;

			default:
				# code...
			?>
			<div class="row tm-blog-sidebar-row tm-shop-sidebar-row">
				<div class="col-lg-12">
					<div class="main-content-area">
			<?php
				break;
		}
	}
	add_action( 'woocommerce_before_main_content', 'landspire_shop_archive_sidebar_position_before', 11 );
}



if (!function_exists('landspire_shop_archive_sidebar_position_after')) {
	/**
	 * shop sidebar
	 */
	function landspire_shop_archive_sidebar_position_after() {
		if( is_product() ) {
			return;
		}
		$sidebar_position = landspire_get_redux_option( 'shop-archive-settings-sidebar-position' );
		$sidebar_layout = landspire_get_redux_option( 'shop-archive-settings-sidebar-layout' );
		switch ( $sidebar_position ) {
			case 'left':
			case 'right':
				# code...
			?>
					</div>
				</div>
				<div class="col-lg-4 col-xl-<?php echo esc_attr( $sidebar_layout ) ?>">
					<div class="sidebar-area tm-sidebar-area sidebar-left shop-sidebar">
						<div class="sidebar-area-inner">
							<?php get_sidebar( 'shop' ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				break;

			default:
				# code...
			?>
					</div>
				</div>
			</div>
			<?php
				break;
		}
	}
	add_action( 'woocommerce_after_main_content', 'landspire_shop_archive_sidebar_position_after', 9 );
}


if (!function_exists('landspire_woocommerce_product_per_page_select')) {
	/**
	 * Add a Products Per Page Dropdown
	 */
	function landspire_woocommerce_product_per_page_select() {
		$per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);

		$dropdown_options = landspire_get_redux_option( 'shop-archive-settings-products-per-page-dropdown-options', false );
		if( empty($dropdown_options) ) {
			return false;
		}
		$dropdown_options = explode( ' ', $dropdown_options );

		?>
		<div class="woocommerce-perpage">
			<select onchange="if (this.value) window.location.href=this.value" class="perpage">
			<?php

			$products_per_page = landspire_get_redux_option( 'shop-archive-settings-products-per-page', '8' );
			$orderby_options = array(
				$products_per_page => esc_html__( 'Select Products Per Page', 'landspire' ),
			);

			foreach ($dropdown_options as $value) {
				if( !empty($value) ) {
					$orderby_options[ $value ] = $value . esc_html__( ' Products Per Page', 'landspire' );
				}
			}


			foreach( $orderby_options as $value => $label ) {
				if( !empty($value) ) {
					?>
					<option <?php echo esc_attr( selected( $per_page, $value ) ) ?> value='?perpage=<?php echo esc_attr( $value ) ?>'><?php echo esc_html( $label ) ?></option>
					<?php
				}
			}
			?>
			</select>
		</div>
		<?php
	}
	add_action( 'woocommerce_before_shop_loop', 'landspire_woocommerce_product_per_page_select', 25 );
}


if (!function_exists('landspire_woocommerce_product_per_page_select_query')) {
	/**
	 * Add a Products Per Page Dropdown Query
	 */
	function landspire_woocommerce_product_per_page_select_query( $query ) {
		$per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
		if( isset($per_page) && !empty($per_page) && $query->is_main_query() && !is_admin() && is_post_type_archive( 'product' ) ) {
			$query->set( 'posts_per_page', $per_page );
		}
	}
	add_action( 'pre_get_posts', 'landspire_woocommerce_product_per_page_select_query' );
}


if ( ! function_exists( 'landspire_get_shop_isotope_holder_ID' ) ) {
	/**
	 * Returns Shop Isotope Holder ID
	 *
	 */
	function landspire_get_shop_isotope_holder_ID() {
		$random_number = wp_rand( 111111, 999999 );
		$holder_id = 'isotope-holder-' . $random_number;
		return $holder_id;
	}
}


if ( ! function_exists( 'landspire_get_shop_catalog_layout' ) ) {
	/**
	 * Returns Shop Catalog Layout Type
	 *
	 */
	function landspire_get_shop_catalog_layout() {
		$params = array();

		$params['shop_catalog_layout'] = landspire_get_redux_option( 'shop-layout-settings-select-shop-catalog-layout', 'default' );


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters)
		$html = landspire_get_woocommerce_template_part( 'shop-catalog-layout', $params['shop_catalog_layout'], 'tpl/catalog-layout', $params );

		return $html;
	}
	add_action( 'woocommerce_init', 'landspire_get_shop_catalog_layout', 1000 );
}


if (!function_exists('landspire_shop_archive_register_shop_sidebar')) {
	/**
	 * Register Shop Sidebar
	 */
	function landspire_shop_archive_register_shop_sidebar() {
		$title_line_bottom_class = '';

		if( landspire_get_redux_option( 'sidebar-settings-sidebar-title-show-line-bottom', 1 ) ) {
			$title_line_bottom_class = 'widget-title-line-bottom';
		}
		$line_bottom_theme_colored = landspire_get_redux_option( 'sidebar-settings-sidebar-title-line-bottom-theme-colored', 1 );
		if( $line_bottom_theme_colored != '' ) {
			$title_line_bottom_class .= ' line-bottom-theme-colored' . $line_bottom_theme_colored;
		}

		// Page Default Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Shop Sidebar', 'landspire' ),
			'id'			=> 'shop_sidebar',
			'description'   => esc_html__( 'This is a default sidebar for page. Widgets in this area will be shown on sidebar of page. Drag and drop your widgets here.', 'landspire' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title ' . esc_attr( $title_line_bottom_class ) . '">',
			'after_title'   => '</h5>',
		) );
	}
	add_action( 'widgets_init', 'landspire_shop_archive_register_shop_sidebar', 1000 );
}


if (!function_exists('landspire_woocommerce_checkout_form_field_args')) {
	/**
	 * Add Bootstrap form control class to woocommerce address fields
	 */
	function landspire_woocommerce_checkout_form_field_args($args, $key, $value) {
		$args['input_class'] = array( 'form-control' );
		return $args;
	}
	add_filter('woocommerce_form_field_args',  'landspire_woocommerce_checkout_form_field_args',10,3);
}



if (!function_exists('landspire_woocommerce_breadcrumbs')) {
	/**
	 * Customize the WooCommerce breadcrumb
	 */
	function landspire_woocommerce_breadcrumbs() {
		return array(
			'delimiter'   => ' <i class="fa fa-angle-right"></i> ',
			'wrap_before' => '<nav class="woocommerce-breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'		=> '',
			'after'		=> '',
			'home'		=> _x( 'Home', 'breadcrumb', 'landspire' ),
		);
	}
	add_filter( 'woocommerce_breadcrumb_defaults', 'landspire_woocommerce_breadcrumbs' );
}


/**
 * Override WooCommerce Function - Get the product thumbnail for the loop.
 */
function woocommerce_template_loop_product_thumbnail() {
	$products_thumb_type = landspire_get_redux_option( 'shop-archive-settings-products-thumb-type', 'image-featured' );

	switch ( $products_thumb_type ) {
		case 'image-featured':
			# code...
			global $product;
			echo '<a href="'.get_permalink($product->get_id()).'">'.woocommerce_get_product_thumbnail() . '</a>';

			break;

		case 'image-swap':
			# code...
			global $product;
			echo '<a href="'.get_permalink($product->get_id()).'">'.woocommerce_get_product_thumbnail() . '</a>';

			$shop_catalog = wc_get_image_size( 'woocommerce_thumbnail' );

			$attachment_ids = $product->get_gallery_image_ids();
			if( !empty($attachment_ids) ) {
				$first_gallery_image = $attachment_ids[0];
			} else {
				//otherwise get featured image
				$first_gallery_image = get_post_thumbnail_id();
			}

			if( !empty($first_gallery_image) ) {
				$image_link = wp_get_attachment_url( $first_gallery_image );
				$resized_image = mascot_core_landspire_matthewruddy_image_resize( $image_link, $shop_catalog['width'], $shop_catalog['height'], true );
				?>
				<a href="<?php echo get_permalink($product->get_id()) ?>"><img src="<?php echo esc_url( $resized_image['url'] ) ?>" alt="<?php echo the_title_attribute( 'echo=0' ) ?>" class="product-hover-image" title="<?php echo the_title_attribute( 'echo=0' ) ?>"></a>
				<?php
			}

			break;

		case 'image-gallery':
			# code...
			global $product;
			$shop_catalog = wc_get_image_size( 'woocommerce_thumbnail' );
			$output = '';

			$attachment_id = get_post_thumbnail_id();
			$attachment_ids = $product->get_gallery_image_ids();
			$attachment_ids[] = $attachment_id;
			$attachment_ids = array_unique($attachment_ids);
			landspire_enqueue_script_owl_carousel();

			if( !empty($attachment_ids) ) {
				?>
				<div class="tm-owl-carousel-1col" data-dots="false" data-nav="true">
				<?php
				foreach( $attachment_ids as $attachment_id ) {
				?>
					<div class="item">
				<?php
					$image_link = wp_get_attachment_url( $attachment_id );
					$resized_image = mascot_core_landspire_matthewruddy_image_resize( $image_link, $shop_catalog['width'], $shop_catalog['height'], true );
					?>
						<img src="<?php echo esc_url( $resized_image['url'] ) ?>" alt="<?php echo the_title_attribute( 'echo=0' ) ?>" class="product-hover-image" title="<?php echo the_title_attribute( 'echo=0' ) ?>">
					<?php
					?>
					</div>
					<?php
				}
				?>
				</div>
				<?php
			}

			break;

		default:
			# code...
			break;
	}
}







/** ===============================
 * Product Single
 * ================================ */

if (!function_exists('landspire_shop_single_product_gallery_add_theme_support')) {
	/**
	 * Single Product Gallery Add Theme Support
	 */
	function landspire_shop_single_product_gallery_add_theme_support() {
		$single_product_catalog_layout = landspire_get_redux_option( 'shop-single-product-settings-select-single-catalog-layout' );
		if( $single_product_catalog_layout == 'image-with-thumb' ) {
			if( landspire_get_redux_option( 'shop-single-product-settings-enable-gallery-slider' ) ) {
				add_theme_support( 'wc-product-gallery-slider' );
			}
		} else if( $single_product_catalog_layout == 'plain-image' || $single_product_catalog_layout == 'sticky-side-text' ) {
			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
				$single_image_size = wc_get_image_size('woocommerce_single');
				if( !is_numeric($single_image_size['width']) ) {
					$single_image_size['width']= 0;
				}
				if( !is_numeric($single_image_size['height']) ) {
					$single_image_size['height']= 0;
				}
				if( !is_numeric($single_image_size['crop']) ) {
					$single_image_size['crop']= 0;
				}
				return array(
					'width' => $single_image_size['width'],
					'height' => $single_image_size['height'],
					'crop' => $single_image_size['crop'],
				);
			} );
		}

		if( landspire_get_redux_option( 'shop-single-product-settings-enable-gallery-lightbox' ) ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
		if( landspire_get_redux_option( 'shop-single-product-settings-enable-gallery-zoom' ) ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}

		/**/
	}
	add_action( 'woocommerce_init', 'landspire_shop_single_product_gallery_add_theme_support' );
}



//review gravatar size
function woocommerce_review_display_gravatar( $comment ) {
	echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '', false, array( 'class' => 'media-object' ) );
}
/**
* Change number of related products output
*/
add_filter( 'woocommerce_output_related_products_args', 'landspire_shop_single_product_related_products_args' );
function landspire_shop_single_product_related_products_args( $args ) {
	$args['posts_per_page'] = landspire_get_redux_option( 'shop-single-product-settings-related-products-count', 8 ); // 4 related products
	$args['columns'] = landspire_get_redux_option( 'shop-single-product-settings-related-products-per-row', 4 ); // arranged in 2 columns
	return $args;
}


if (!function_exists('landspire_shop_single_product_sidebar_position_before')) {
	/**
	 * Shop Single Product Sidebar Before
	 */
	function landspire_shop_single_product_sidebar_position_before() {
		$sidebar_position = landspire_get_redux_option( 'shop-single-product-settings-sidebar-position' );
		switch ( $sidebar_position ) {
			case 'left':
			case 'right':
				# code...
			?>
			<div class="row tm-blog-sidebar-row tm-shop-sidebar-row">
				<div class="col-lg-8 col-xl-8 main-content-area <?php if( $sidebar_position == 'left' ) echo esc_attr( 'order-lg-1' ); ?>">
			<?php
				break;

			default:
				# code...
			?>
			<div class="row tm-blog-sidebar-row tm-shop-sidebar-row">
				<div class="col-lg-12 main-content-area">
			<?php
				break;
		}
	}
	add_action( 'woocommerce_before_single_product', 'landspire_shop_single_product_sidebar_position_before', 1 );
}


if (!function_exists('landspire_shop_single_product_sidebar_position_after')) {
	/**
	 * Shop Single Product Sidebar After
	 */
	function landspire_shop_single_product_sidebar_position_after() {
		$sidebar_position = landspire_get_redux_option( 'shop-single-product-settings-sidebar-position' );
		$sidebar_layout = landspire_get_redux_option( 'shop-single-settings-sidebar-layout' );
		switch ( $sidebar_position ) {
			case 'left':
			case 'right':
				# code...
			?>
				</div>
				<div class="col-lg-4 col-xl-<?php echo esc_attr( $sidebar_layout ) ?>">
					<div class="shop-sidebar sidebar-area tm-sidebar-area">
						<div class="sidebar-area-inner">
							<?php get_sidebar( 'shop' ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				break;

			default:
				# code...
			?>
				</div>
			</div>
			<?php
				break;
		}
	}
	add_action( 'woocommerce_after_single_product', 'landspire_shop_single_product_sidebar_position_after' );
}



if (!function_exists('landspire_shop_single_product_images_column_width_before')) {
	/**
	 * Shop Single Product Images Column Width
	 */
	function landspire_shop_single_product_images_column_width_before() {
		$images_column_width = landspire_get_redux_option( 'shop-single-product-settings-product-images-column-width', 6 );
		$images_align = landspire_get_redux_option( 'shop-single-product-settings-product-images-align' );
		?>
		<div class="row product-details">
			<div class="col-md-<?php echo esc_attr($images_column_width);?> <?php if ( $images_align == 'right' ) echo esc_attr( 'order-md-1' ); ?>">
				<div class="single-image-wrapper">
		<?php
	}
	add_action( 'woocommerce_before_single_product_summary', 'landspire_shop_single_product_images_column_width_before', 1 );
}

if (!function_exists('landspire_shop_single_product_images_column_width_middle')) {
	/**
	 * Shop Single Product Images Column Width
	 */
	function landspire_shop_single_product_images_column_width_middle() {
		$images_column_width = landspire_get_redux_option( 'shop-single-product-settings-product-images-column-width', 6 );
		?>		</div>
			</div>
			<div class="col-md-<?php echo esc_attr( 12-$images_column_width );?>">
		<?php
	}
	add_action( 'woocommerce_before_single_product_summary', 'landspire_shop_single_product_images_column_width_middle', 30 );
}

if (!function_exists('landspire_shop_single_product_images_column_width_after')) {
	/**
	 * Shop Single Product Images Column Width
	 */
	function landspire_shop_single_product_images_column_width_after() {
		?>
			</div>
		</div>
		<?php
	}
	add_action( 'woocommerce_after_single_product_summary', 'landspire_shop_single_product_images_column_width_after', 1 );
}


if (!function_exists('landspire_shop_single_product_enable_product_meta')) {
	/**
	 * Enable Product Meta
	 */
	function landspire_shop_single_product_enable_product_meta() {
		$single_product_enable_product_meta = landspire_get_redux_option( 'shop-single-product-settings-enable-product-meta', true );
		if( !$single_product_enable_product_meta ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
	}
	add_action( 'woocommerce_init', 'landspire_shop_single_product_enable_product_meta' );
}


if (!function_exists('landspire_shop_single_product_enable_product_sharing')) {
	/**
	 * Enable Product Sharing
	 */
	function landspire_shop_single_product_enable_product_sharing() {
		$single_product_enable_sharing = landspire_get_redux_option( 'shop-single-product-settings-enable-sharing' );
		if( $single_product_enable_sharing ) {
			add_action( 'woocommerce_single_product_summary', 'landspire_get_social_share_links', 49 );
		}
	}
	add_action( 'woocommerce_init', 'landspire_shop_single_product_enable_product_sharing' );
}


/**
 * Show the subcategory title in the product loop.
 *
 * @param object $category
 */
function woocommerce_template_loop_category_title( $category ) {
	?>
	<h4 class="woocommerce-loop-category__title">
		<?php
			echo esc_html( $category->name );

			if ( $category->count > 0 ) {
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $category->count ) . ')</mark>', $category );
			}
		?>
	</h4>
	<?php
}





if (!function_exists('landspire_woocommerce_before_shop_loop_start')) {
	/**
	 * WC before shop loop start
	 */
	function landspire_woocommerce_before_shop_loop_start() {
		?>
		<div class="tm-wc-archive-before-loop">
		<?php
	}
	add_action( 'woocommerce_before_shop_loop', 'landspire_woocommerce_before_shop_loop_start', 19 );
}

if (!function_exists('landspire_woocommerce_before_shop_loop_end')) {
	/**
	 * WC after shop loop end
	 */
	function landspire_woocommerce_before_shop_loop_end() {
		?>
			<div class="clearfix"></div>
		</div>
		<?php
	}
	add_action( 'woocommerce_before_shop_loop', 'landspire_woocommerce_before_shop_loop_end', 30 );
}



if ( ! function_exists( 'landspire_woocommerce_products_per_page' ) ) {
	/**
	 * Function that set number of items for main shop page
	 *
	 * @param $products_per_page int
	 *
	 * @return int
	 */
	function landspire_woocommerce_products_per_page( $products_per_page ) {
		$option = landspire_get_redux_option( 'shop-archive-settings-products-per-page', 8 );

		if ( ! empty( $option ) ) {
			$products_per_page = intval( $option );
		}

		return $products_per_page;
	}
}
// Override number of products per page
add_filter( 'loop_shop_per_page', 'landspire_woocommerce_products_per_page' );




/**
 * Woocommerce Cart Sidebar
 */
if ( ! function_exists( 'landspire_floating_cart_sidebar' ) ) {
function landspire_floating_cart_sidebar() {
	$floating_woocart_sidebar = landspire_get_redux_option( 'shop-single-product-settings-enable-floating-woocart-sidebar', false );
	if( !$floating_woocart_sidebar ) {
		return;
	}

	?>
	<?php if(class_exists('Woocommerce')) : ?>
		<div class="tm-floating-woocart-wrapper woocommerce">
			<div class="floating-woocart-overlay"></div>
			<div class="floating-woocart-sidebar">
				<div class="widget_shopping_head">
				  <div class="woocart-close"><i class="woocart-close-icon"></i></div>
					<div class="widget_shopping_title"><?php echo esc_html__( 'Cart', 'landspire' );?></div>
				</div>
				<div class="widget_shopping_cart">
					<div class="widget_shopping_cart_content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php
}
}

/**
 * Show Cart Sidebar Hidden
 */
add_action('wp_ajax_nopriv_wc_item_added_signal', 'landspire_addedtocart_item_added_signal');
add_action('wp_ajax_wc_item_added_signal', 'landspire_addedtocart_item_added_signal');
function landspire_addedtocart_item_added_signal() {
	check_ajax_referer('tm_woo_added_signal');
	echo isset($_POST['id']) && $_POST['id'] > 0 ? absint($_POST['id']) : false;
	die();
}
function landspire_product_item_added_signal_check() {
	if (class_exists('Woocommerce') && is_checkout()){
		return;
	}
	// Enqueue your external JavaScript file
	wp_enqueue_script( 'my-external-script', LANDSPIRE_TEMPLATE_URI . '/assets/js/custom-woo.js', array('jquery'), false, true );
	// Prepare the data you want to pass
	$data_to_pass = array(
			'myValue' => 'Hello, World!',
	);
	$nonce_array = array(
			'my_nonce' => wp_create_nonce('tm_woo_added_signal')
	);
	// Localize the script with the data
	wp_localize_script('my-external-script', 'myData', $nonce_array);
}
add_action('wp_enqueue_scripts', 'landspire_product_item_added_signal_check');



if (!function_exists('landspire_woocommerce_time_sale')) {
    function landspire_woocommerce_time_sale() {
        /**
         * @var $product WC_Product
         */
        global $product;

        if (!$product->is_on_sale()) {
            return;
        }

        $time_sale = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
        if ($time_sale) {
            wp_enqueue_script('landspire-countdown');
            $time_sale += (get_option('gmt_offset') * HOUR_IN_SECONDS);
            ?>
            <div class="time-sale">
                <div class="deal-text"><span><?php echo esc_html__('Ends in: ', 'landspire'); ?></span></div>
                <div class="landspire-countdown" data-countdown="true" data-date="<?php echo esc_attr($time_sale); ?>">
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-days"></span>
                        <span class="countdown-label"><?php echo esc_html__('d', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-hours"></span>
                        <span class="countdown-label"><?php echo esc_html__('h', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-minutes"></span>
                        <span class="countdown-label"><?php echo esc_html__('m', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-seconds"></span>
                        <span class="countdown-label"><?php echo esc_html__('s', 'landspire') ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if (!function_exists('landspire_woocommerce_time_sale_layout_2')) {
    function landspire_woocommerce_time_sale_layout_2() {
        /**
         * @var $product WC_Product
         */
        global $product;

        if (!$product->is_on_sale()) {
            return;
        }

        $time_sale = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
        if ($time_sale) {
            wp_enqueue_script('landspire-countdown');
            $time_sale += (get_option('gmt_offset') * HOUR_IN_SECONDS);
            ?>
            <div class="time-sale">
                <div class="landspire-countdown" data-countdown="true" data-date="<?php echo esc_attr($time_sale); ?>">
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-days"></span>
                        <span class="countdown-label"><?php echo esc_html__('Days', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-hours"></span>
                        <span class="countdown-label"><?php echo esc_html__('Hours', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-minutes"></span>
                        <span class="countdown-label"><?php echo esc_html__('Mins', 'landspire') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-seconds"></span>
                        <span class="countdown-label"><?php echo esc_html__('Secs', 'landspire') ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if (!function_exists('landspire_woocommerce_get_product_short_description')) {
    function landspire_woocommerce_get_product_short_description($excerpt_length = '') {
        global $post;
        if ($post->post_excerpt) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', landspire_slice_excerpt_by_length( $post->post_excerpt, $excerpt_length )); ?>
            </div>
            <?php
        }
    }
}