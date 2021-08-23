<?php
/**
 * The template for displaying content in card format.
 * @link https://codex.wordpress.org/Template_Hierarchy
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
 * @since 1.0.1
 * 	Display keyword and category search form after site branding.
 * @reference
 * 	[Child]/lib/controller.php
 * 	[Parent]/inc/utility/theme.php
*/
?>

<?php
/**
 * @reference (Beans)
 * 	HTML markup.
 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
 * @reference (Uikit)
 * 	https://getuikit.com/docs/icon
*/
beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array('class' => 'uk-padding-remove-vertical uk-margin-small-right'));
	beans_open_markup_e("_link[{$theme}][{$index}]",'a',array(
		/**
		 * @reference (Woo)
		 * 	Gets the url to the cart page.
		 * 	http://hookr.io/functions/wc_get_cart_url/
		*/
		'href' => esc_url(wc_get_cart_url()),
		'title' => esc_html__('View cart','windmill'),
	));

		beans_open_markup_e("_icon[{$theme}][{$index}]",'span',array(
			'class' => 'uk-margin-small-right',
			'uk-icon' => 'icon: cart',
		));
		beans_close_markup_e("_icon[{$theme}][{$index}]",'span');

		beans_open_markup_e("_label[{$theme}][{$index}][subtotal]",'span',array('class' => 'subtotal'));
			/**
			 * @reference (WP)
			 * 	Sanitize content with allowed HTML KSES rules.
			 * 	https://developer.wordpress.org/reference/functions/wp_kses_data/
			*/
			beans_output_e("_output[{$theme}][{$index}][subtotal]",wp_kses_data(WC()->cart->get_cart_subtotal()));
		beans_close_markup_e("_label[{$theme}][{$index}][subtotal]",'span');

		beans_open_markup_e("_label[{$theme}][{$index}][count]",'span',array('class' => 'count'));

		beans_output_e("_output[{$theme}][{$index}][count]",wp_kses_data(sprintf(_n('%d item','%d items',WC()->cart->get_cart_contents_count(),'windmill'),WC()->cart->get_cart_contents_count())));
		beans_close_markup_e("_label[{$theme}][{$index}][count]",'span');

	beans_close_markup_e("_link[{$theme}][{$index}]",'a');
beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');
