<?php
/**
 * Customize WooCommerce components.
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
 * Inspired by E-Commerce WordPress Theme
 * @link https://catchthemes.com/themes/e-commerce/
 * @author Catch Themes
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
$index = basename(__FILE__,'.php');

/**
 * @reference (WP)
 * 	Retrieves name of the current stylesheet.
 * 	https://developer.wordpress.org/reference/functions/get_stylesheet/
*/
$theme = get_stylesheet();


/* Exec
______________________________
*/
?>
<?php
/**
 * [CASE]
 * 	1. setup Woocommerce compatible environment.
 * 	2. apply customization via Woocommerce hooks.
*/

	/**
	 * @since 1.0.1
	 * 	Remove topbar icons.
	 * @reference (Beans)
	 * 	Hooks a function or method to a specific filter action.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_filter/
	 * @reference
	 * 	[Parent]/controller/structure/header.php
	 * 	[Parent]/inc/utility/general.php
	 * 	[Parent]/model/data/icon.php
	*/
	beans_add_filter("_filter[_structure_header][icon]",function()
	{
		return array(
			'nav' => __utility_get_icon('nav'),
			'html-sitemap' => __utility_get_icon('html-sitemap'),
		);
	},99);


	/**
	 * @reference (Beans)
	 * 	Remove parent theme's hooks.
	 * 	https://www.getbeans.io/code-reference/functions/beans_remove_action/
	 * @reference
	 * 	[Parent]/controller/fragment/share.php
	 * 	[Parent]/controller/structure/sidebar.php
	 * 	[Parent]/controller/structure/single.php
	*/
	beans_remove_action('_structure_sidebar__the_profile');
	beans_remove_action('_structure_single__the_wp_link_pages');
	beans_remove_action('_structure_single__the_relation');
	beans_remove_action('_structure_single__the_post_link');
	beans_remove_action('_structure_single__the_comment');
	beans_remove_action('_fragment_share__the_single');
	beans_remove_action('_fragment_share__the_page');
