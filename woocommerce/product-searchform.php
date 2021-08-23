<?php
/**
 * The template for displaying product search form
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 * @link https://docs.woocommerce.com/document/template-structure/
 * @package Windmill Shop
 * @license GPL-3.0+
 * @version 3.3.0
*/

/**
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
 * In this sample child theme, you can know how to 
 * 	2. apply customization via WooCommerce hooks.
 * 	3. apply customization via WooCommerce template override.
 * 
 * @reference (Woo)
 * 	https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
*/

/**
 * @reference (Uikit)
 * 	https://getuikit.com/docs/form
 * 	https://getuikit.com/docs/icon
 * 	https://getuikit.com/docs/width
 * @reference (WP)
 * 	Retrieves the contents of the search WordPress query variable.
 * 	https://developer.wordpress.org/reference/functions/get_search_query/
*/
?>
<form role="search" method="get" class="woocommerce-product-search uk-form-horizontal" action="<?php echo esc_url(home_url('/')); ?>">

	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"><?php echo esc_html__('Search for:','windmill'); ?></label>
	<?php
	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e("_inline[{$theme}][{$index}]",'div',array('class' => 'uk-inline'));

		// Icon
		beans_open_markup_e("_icon[{$theme}][{$index}]",'span',array(
			'class' => 'uk-form-icon',
			'uk-icon' => 'icon: search',
		));
		beans_close_markup_e("_icon[{$theme}][{$index}]",'span');

		// <input>
		beans_selfclose_markup_e("_input[{$theme}][{$index}][search]",'input',array(
			'type' => 'search',
			'id' => 'woocommerce-product-search-field-' . isset($index) ? absint($index) : 0,
			'class' => 'search-field uk-input uk-width-1-1',
			'placeholder' => esc_attr__('Search products&hellip;','windmill'),
			'name' => 's',
			'value' => get_search_query(),
		));
		beans_selfclose_markup_e("_input[{$theme}][{$index}][hidden]",'hidden',array(
			'name' => 'post_type',
			'value' => 'product',
		));

	beans_close_markup_e("_inline[{$theme}][{$index}]",'div');
	?>
</form>
