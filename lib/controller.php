<?php
/**
 * WooCommerce functions and definitions.
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
 * 	woocommerce_output_related_products_args()
 * 	woocommerce_product_thumbnails_columns()
 * 	woocommerce_loop_add_to_cart_link()
 * 	envoshop-searchform
 * 	topbar-cart-link
*/

/**
 * [CASE]
 * 	1. setup Woocommerce compatible environment.
 * 	2. apply customization via Woocommerce hooks.
*/

	/**
	 * @since 1.0.1
	 * 	Related Products Args
	 * @param (array) $args
	 * 	Related products args.
	 * @return (array)
	 * 	Related products args
	 * @return (Woo)
	 * 	Output the related products.
	 * 	http://hookr.io/filters/woocommerce_output_related_products_args/
	*/
	beans_add_filter('woocommerce_output_related_products_args',function($args)
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return $args;}

		$args = array(
			'posts_per_page' => 3,
			'columns' => 3,
		);
		return $args;

	});


	/**
	 * @since 1.0.1
	 * 	Product gallery thumbnail columns
	 * @return (integer)
	 * 	number of columns
	 * @reference (Woo)
	 * 	The WordPress Core woocommerce product thumbnails columns hook.
	 * 	http://hookr.io/filters/woocommerce_product_thumbnails_columns/
	*/
	beans_add_filter('woocommerce_product_thumbnails_columns',function($args)
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return;}

		$columns = 4;

		if(__utility_is_beans('widget')){
			/**
			 * @reference (Beans)
			 * 	Check whether a widget area is registered.
			 * 	https://www.getbeans.io/code-reference/functions/beans_has_widget_area/
			*/
			if(!beans_has_widget_area('sidebar_primary') || !beans_has_widget_area('sidebar_secondary')){
				$columns = 5;
			}
		}
		else{
			/**
			 * @reference (WP)
			 * 	Determines whether a sidebar contains widgets.
			 * 	https://developer.wordpress.org/reference/functions/is_active_sidebar/
			*/
			if(!is_active_sidebar('sidebar_primary') || !is_active_sidebar('sidebar_secondary')){
				$columns = 5;
			}
		}
		return intval($columns);
	});


	/**
	 * @since 1.0.1
	 * 	Theme layout integration.
	 * 	Remove the before content that wraps all WooCommerce content in wrappers which match the theme markup
	 * 	Remove the after content that closes the wrapping divs
	 * @reference (Woo)
	 * 	http://docs.woothemes.com/document/third-party-custom-theme-compatibility/#section-2
	 * 	http://hookr.io/actions/woocommerce_before_main_content/
	 * 	http://hookr.io/actions/woocommerce_after_main_content/
	 * @reference (WP)
	 * 	Removes a function from a specified action hook.
	 * 	https://developer.wordpress.org/reference/functions/remove_action/
	*/
	// Check if WooCommerce is activated.
	if(__is_woocommerce_extension_activated()){
		remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
		remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
	}


	/**
	 * @since 1.0.1
	 * 	Modify add-to-cart button style.
	 * 	https://www.datafeedr.com/customizing-woocommerce-buy-now-and-add-to-cart-buttons
	 * @param (string) $html
	 * @param (object) $product
	 * @param (array) $args
	 * @return (void)
	 * @reference (Woo)
	 * 	https://docs.woocommerce.com/document/template-structure/
	*/
	beans_add_filter('woocommerce_loop_add_to_cart_link',function($html,$product,$args)
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return $html;}

		if(!$product->is_on_sale()){
			return $html;
		}

		// $extra_class = ' uk-button uk-button-default';
		// $extra_text = ' SALE';

		$url = $product->add_to_cart_url();
		$quantity = $args['quantity'] ?? 1;

		/**
		 * @reference (Uikit)
		 * 	https://getuikit.com/docs/button
		 * 	https://getuikit.com/docs/width
		*/
		// $class = isset($args['class']) ? $args['class'] . $extra_class : 'button' . $extra_class;
		$class = 'uk-button uk-button-secondary uk-width-1-1';
	
		/**
		 * @reference (Woo)
		 * 	Implode and escape HTML attributes for output.
		 * 	https://docs.wpdebuglog.com/plugin/woocommerce/5.0.0/function/wc_implode_html_attributes/
		*/
		$attributes = isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '';
		// $text = $product->add_to_cart_text() . $extra_text;
		$text = $product->add_to_cart_text();

		$format = '<a href="%1$s" data-quantity="%2$s" class="%3$s" %4$s>%5$s</a>';
		return sprintf(
			$format,
			esc_url($url),
			esc_attr($quantity),
			esc_attr($class),
			$attributes,
			esc_html($text)
		);
	},20,3);


	/**
	 * @since 1.0.1
	 * 	Display keyword and category search form after site branding.
	 * @return (void)
	*/
	beans_add_smart_action('_column[_structure_header][branding]_after_markup',function()
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return;}
		get_template_part('lib/model/envoshop-searchform');
	});


	/**
	 * @since 1.0.1
	 * 	Show cart contents (total link).
	 * 	https://catchthemes.com/themes/e-commerce/
	 * @return (void)
	 * @reference
	 * 	[Parent]/controller/structure/header.php
	* 	@reference (Woo)
	 * 	https://docs.woocommerce.com/document/template-structure/
	*/
	beans_add_smart_action('_list[_structure_header][icon]_prepend_markup',function()
	{
		// Check if WooCommerce is activated.
		if(!__is_woocommerce_extension_activated()){return;}
		get_template_part('lib/model/topbar-cart-link');
	});
