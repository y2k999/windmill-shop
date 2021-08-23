<?php
/**
 * Pre-set widgets for WooCommerce plugin.
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
 * [CASE]
 * In this sample child theme, you can know how to 
 * 	1. setup WooCommerce compatible environment.
*/


	/**
	 * @access (public)
	 * 	Pre-set default widgets on each sidebars.
	 * @reference (Beans)
	 * 	Set beans_add_action() using the callback argument as the action ID.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_smart_action/
	 * @reference (WP)
	 * 	Fires on the first WP load after a theme switch if the old theme still exists.
	 * 	https://developer.wordpress.org/reference/hooks/after_switch_theme/
	 * @return (void)
	*/
	beans_add_smart_action('after_switch_theme',function()
	{
		if(!__is_woocommerce_extension_activated()){return;}

		$default = array(
			// Unshown
			'widget_meta' => array(1 => array('_multiwidget' => 1)),
			'widget_search' => array(1 => array('_multiwidget' => 1)),
			'widget_recent-posts' => array(1 => array('_multiwidget' => 1)),
			'widget_categories' => array(1 => array('_multiwidget' => 1)),

			// Show
			'product_search' => array(2 => array('title' => esc_html__('(Woo) Product Search','windmill')),'_multiwidget' => 1),
			'shopping_cart' => array(2 => array('title' => esc_html__('(Woo) Cart','windmill'),'hide_if_empty' => 0),'_multiwidget' => 1),
			'products' => array(2 => array('title' => esc_html__('(Woo) Products','windmill'),'number' => 5,'show' => '','orderby' => 'date','order' => 'desc','hide_free' => 0,'show_hidden' => 0,),'_multiwidget' => 1),
			'product_categories' => array(2 => array('title' => esc_html__('(Woo) Product Categories','windmill'),'orderby' => 'name','dropdown' => 0,'count' => 0,'hierarchical' => 1,'show_children_only' => 0,'hide_empty' => 0,'max_depth' => ''),'_multiwidget' => 1),

			// Order
			'sidebars_widgets' => array(
				'wp_inactive_widgets' => array(),
				'sidebar_primary' => array(
					0 => 'woocommerce_product_search-4',
					1 => 'woocommerce_widget_cart-5',
				),
				'sidebar_secondary' => array(
					0 => 'woocommerce_product_categories-4',
					1 => 'woocommerce_products-4',
				),
				'footer_primary' => array(),
				'footer_secondary' => array(),
				'header_primary' => array(),
				'header_secondary' => array(),
				'content_primary' => array(),
				'content_secondary' => array(),
				'array_version' => 3
			),
		);
		foreach($default as $key => $value){
			update_option($key,$value);
		}

	},99);
