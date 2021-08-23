<?php
/**
 * Woocommerce functions and definitions.
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Windmill Shop
 * @license GPL-3.0+
 * @since 1.0.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
 * 
 * Inspired by Storefront WordPress Theme
 * @link https://woocommerce.com/storefront/
 * @author Automattic
 * 
 * Inspired by WooCommerce WordPress Plugin
 * @link https://woocommerce.com/
 * @author Automattic
*/


/* Prepare
______________________________
*/

// If this file is called directly,abort.
if(!defined('WPINC')){die;}

// Set identifiers for this template.
// $index = basename(__FILE__,'.php');

/**
 * @reference (WP)
 * 	Retrieves name of the current stylesheet.
 * 	https://developer.wordpress.org/reference/functions/get_stylesheet/
*/
// $theme = get_stylesheet();


/* Exec
______________________________
*/
?>
<?php
/**
 * [TOC]
 * 	admin_notices()
 * 	page_on_front()
 * 	add_theme_support()
 * 	wp_update_nav_menu_item()
 * 	__woocommerce_integrations()
 * 	__woocommerce_bundles_group_mode_options_data()
*/

/**
 * [CASE]
 * 	1. setup WooCommerce compatible environment.
*/

	/**
	 * @since 1.0.1
	 * 	Check if WooCommerce is activated.
	 * @reference
	 * 	[Child]/functions.php
	*/
	if(!__is_woocommerce_extension_activated()){
		/**
		 * @since 1.0.1
		 * 	Add a warning message as an admin notification immediately after switching to this theme, if Woocommerce plugin is inactive.
		 * @reference (WP)
		 * 	Prints admin screen notices.
		 * 	https://developer.wordpress.org/reference/hooks/admin_notices/
		*/
		add_action('admin_notices',function()
		{
			echo '<div class="message error"><p>' . __("This theme requires <strong>WooCommerce</strong> . Please <a href=\"plugins.php\">enable WooCommerce</a>.",'windmill') . '</p></div>';
		});
	}


	/**
	 * @since 1.0.1
	 * 	Update the front page and edirect to the page after switching to this theme.
	 * @reference (WP)
	 * 	Fires on the first WP load after a theme switch if the old theme still exists.
	 * 	https://developer.wordpress.org/reference/hooks/after_switch_theme/
	 * @return (void)
	*/
	add_action('after_switch_theme',function()
	{
		// Check if WooCommerce is activated.
		if(__is_woocommerce_extension_activated()){
			/**
			 * @reference (WP)
			 * 	What to show on the front page
			 * 	https://codex.wordpress.org/Option_Reference
			*/
			if(get_option('show_on_front') == 'page'){
				/**
				 * @reference (WP)
				 * 	Retrieves a page given its path.
				 * 	https://developer.wordpress.org/reference/functions/get_page_by_path/
				*/
				$shop = get_page_by_path('shop',OBJECT,'page')->ID;
				/**
				 * @since 1.0.1
				 * 	Update front page.
				 * @reference (WP)
				 * 	The ID of the page that should be displayed on the front page.
				 * 	Requires show_on_front's value to be page.
				 * 	https://codex.wordpress.org/Option_Reference
				*/
				update_option('page_on_front',$shop);
			}
		}

	});


	add_action('after_setup_theme',function()
	{
		/**
		 * @since 1.0.1
		 * 	Sets up theme defaults and registers support for various WooCommerce features.
		 * 	Note that this function is hooked into the after_setup_theme hook, which runs before the init hook.
		 * 	The init hook is too late for some features, such as indicating support for post thumbnails.
		 * @reference (WP)
		 * 	Registers theme support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/add_theme_support/
		*/
		add_theme_support('woocommerce',array(
			'single_image_width' => 360,
			'thumbnail_image_width' => 240,
			'product_grid' => array(
				'default_columns' => 3,
				'default_rows' => 4,
				'min_columns' => 1,
				'max_columns' => 6,
				'min_rows' => 1,
			),
		));

		/**
		 * @since 1.0.1
		 * 	As you know wefve redesigned the product gallery feature in WooCommerce to deliver a richer experience in 3.0.
		 * 	This is a significant frontend change that can be broken down in to three separate new features;
		 * @reference (Woo)
		 * 	https://developer.woocommerce.com/2017/02/28/adding-support-for-woocommerce-2-7s-new-gallery-feature-to-your-theme/
		 * 	https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
		 * 	https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
		*/
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		/**
		 * @reference (WP)
		 * 	Registers navigation menu locations for a theme.
		 * 	https://developer.wordpress.org/reference/functions/register_nav_menus/
		 * @param (array) $locations
		 * 	Associative array of menu location identifiers (like a slug) and descriptive text.
		 * 	Default value: array()
		 * @reference
		 * 	[Child]/template-part/nav/offcanvas.php
		 * 	[Child]/template-part/nav/primary.php
		 * 	[Child]/template-part/nav/secondary.php
		*/
		register_nav_menus(array(
			'woocommerce_primary' => esc_html__('[Woo] Primary','windmill'),
			'woocommerce_secondary' => esc_html__('[Woo] Secondary','windmill'),
		));

		/**
		 * @since 1.0.1
		 * 	Add woocommerce setup action.
		*/
		do_action('windmill_woocommerce_setup');

	},99);


	/**
	 * @access (public)
	 * 	Register nav menu for Woocommerce.
	 * @return (void)
	 * @reference
	 * 	[Child]/template-part/nav/offcanvas.php
	 * 	[Child]/template-part/nav/primary.php
	 * 	[Child]/template-part/nav/secondary.php
	*/
	add_action('windmill_woocommerce_setup',function()
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return;}

		foreach(array(
			'woocommerce_primary' => esc_html__('Woocommerce Primary','windmill'),
			'woocommerce_secondary' => esc_html__('Woocommerce Secondary','windmill'),
		) as $key => $value){
			/**
			 * @reference (WP)
			 * 	Set up a default menu if it doesn't exist.
			 * 	Returns a navigation menu object.
			 * 	https://developer.wordpress.org/reference/functions/wp_get_nav_menu_object/
			*/
			if(!wp_get_nav_menu_object($value)){
				/**
				 * @reference (WP)
				 * 	Creates a navigation menu.
				 * 	https://developer.wordpress.org/reference/functions/wp_create_nav_menu/
				*/
				$menu_id = wp_create_nav_menu($value);

				/**
				 * @reference (WP)
				 * 	Save the properties of a menu item or create a new one.
				 * 	https://developer.wordpress.org/reference/functions/wp_update_nav_menu_item/
				 * 	Retrieves a page given its path.
				 * 	https://developer.wordpress.org/reference/functions/get_page_by_path/
				*/
				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('Shop','windmill'),
					'menu-item-object' => get_page_by_path('shop',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('shop',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));

				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('Cart','windmill'),
					'menu-item-object' => get_page_by_path('cart',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('cart',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));

				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('Checkout','windmill'),
					'menu-item-object' => get_page_by_path('checkout',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('checkout',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));

				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('My Account','windmill'),
					'menu-item-object' => get_page_by_path('my-account',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('my-account',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));
			}
		}
	});


	/**
	 * @since 1.0.1
	 * 	Sets up integrations.
	 * @return (void)
	*/
	add_action('windmill_woocommerce_setup',function()
	{
		// Check if WC_Bundles is activated.
		if(__is_woocommerce_extension_activated('WC_Bundles')){
			add_filter('woocommerce_bundled_table_item_js_enqueued','__return_true');
			add_filter('woocommerce_bundles_group_mode_options_data','__woocommerce_bundles_group_mode_options_data');
		}

		// Check if WC_Composite_Products is activated.
		if(__is_woocommerce_extension_activated('WC_Composite_Products')){
			add_filter('woocommerce_composited_table_item_js_enqueued','__return_true');
			add_filter('woocommerce_display_composite_container_cart_item_data','__return_true');
		}
	});


	/**
	 * @since 2.3.4
	 * 	Add "Includes" meta to parent cart items.
	 * 	Displayed only on handheld/mobile screens.
	 * @param (array) $group_mode_data
	 * 	Group mode data.
	 * @return (array)
	*/
	if(function_exists('__woocommerce_bundles_group_mode_options_data') === FALSE) :
	function __woocommerce_bundles_group_mode_options_data($group_mode_data)
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return $group_mode_data;}

		$group_mode_data['parent']['features'][] = 'parent_cart_item_meta';
		return $group_mode_data;

	}// Method
	endif;
