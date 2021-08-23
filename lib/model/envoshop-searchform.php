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
 * Inspired by Envo Shop WordPress Theme
 * @link https://envothemes.com/free-envo-shop/
 * @author EnvoThemes
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
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
 * @reference (Uikit)
 * 	https://getuikit.com/docs/form
 * 	https://getuikit.com/docs/search
*/
beans_open_markup_e("_column[{$theme}][{$index}]",'div',__utility_get_column('half',array('class' => 'uk-padding-small uk-margin-top')));

	beans_open_markup_e("_form[{$theme}][{$index}]",'form',array(
		'role' => 'search',
		'method' => 'get',
		'action' => esc_url(home_url('/')),
		'class' => 'uk-search uk-search-default uk-padding-small uk-flex uk-padding uk-padding-remove-vertical',
	));
	?>
		<input type="hidden" name="post_type" value="product" />
		<input class="uk-input" name="s" type="search" placeholder="<?php esc_attr_e('Search products...','windmill'); ?>"/>
		<select class="uk-select" name="product_cat">
			<option value=""><?php esc_html_e('All Categories','windmill'); ?></option> 
			<?php
			/**
			 * @reference (WP)
			 * 	Retrieves a list of category objects.
			 * 	https://developer.wordpress.org/reference/functions/get_categories/
			 * 	Convert a value to non-negative integer.
			 * 	https://developer.wordpress.org/reference/functions/absint/
			*/
			$categories = get_categories('taxonomy=product_cat');
			foreach($categories as $category){
				$option = '<option value="' . esc_attr($category->category_nicename) . '">';
				$option .= esc_html($category->cat_name);
				$option .= ' (' . absint($category->category_count) . ')';
				$option .= '</option>';
				/* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */
				echo $option;
			}
			?>
		</select>

	<?php
	beans_close_markup_e("_form[{$theme}][{$index}]",'form');
beans_close_markup_e("_column[{$theme}][{$index}]",'div');
