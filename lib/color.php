<?php
/**
 * Color settings for child theme.
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

	/**
	 * @since 1.0.1
	 * 	Update theme customizer colors over parent theme.
	 * @reference (Beans)
	 * 	Hooks a function or method to a specific filter action.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_filter/
	 * @reference
	 * 	[Parent]/customizer/color.php
	*/
	beans_add_filter("_filter[_customizer_color][color]",function()
	{
		/**
			@access (public)
				Set default color for this child theme.
			@param (array) $color
				Color codes of parent theme.
			@return (array)
		*/
		return array(
			'text' => '#404040',
			'link' => '#ffdd22',
			'hover' => '#484848',
		);

	},99);
