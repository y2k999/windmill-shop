<?php
/**
 * The template for displaying global navigation with sub-menu.
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
 * [NOTE]
 * 	This template part file overrides the corresponding template part file in the parent theme.
 * 
 * @since 1.0.1
 * 	Display uikit offcanvas navigation.
 * @reference
 * 	[Parent]/model/app/nav.php
 * 	[Parent]/template-part/nav/nav-offcanvas.php
*/
?>

<?php
/**
 * @reference (Beans)
 * 	HTML markup.
 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
*/
beans_open_markup_e("_nav[{$theme}][{$index}]",'nav',array(
	'id' => 'primary-navigation',
	'itemscope' => 'itemscope',
	'itemtype' => 'https://schema.org/SiteNavigationElement',
	'aria-label' => esc_attr__('WooCommerce Offcanvas Navigation','windmill'),
	'role' => 'navigation',
));

	/**
	 * @since 1.0.1
	 * 	Overwrite parent theme's template part.
	 * 	Rename theme location id(name) for this child theme.
	 * @reference (WP)
	 * 	Determines whether a registered nav menu location has a menu assigned to it.
	 * 	https://developer.wordpress.org/reference/functions/has_nav_menu/
	 * @reference
	 * 	[Child]/lib/controller.php
	 * 	[Parent]/template-part/nav/offcanvas.php
	*/
	if(has_nav_menu('woocommerce_primary')){
		/**
		 * @reference (Uikit)
		 * 	https://getuikit.com/docs/nav
		 * @reference (WP)
		 * 	Displays a navigation menu.
		 * 	https://developer.wordpress.org/reference/functions/wp_nav_menu/
		*/
		wp_nav_menu(array(
			'theme_location' => 'woocommerce_primary',
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',	
			'container' => FALSE,
			'menu_class' => 'uk-nav uk-nav-default',
			'echo' => TRUE,
		));
	}
	else{
		/**
		 * @reference (WP)
		 * 	Echo output registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		*/
		beans_output_e("_output[{$theme}][{$index}]",esc_html__('Add WooCommerce Offcanvas Navigation','windmill'));
	}

beans_close_markup_e("_nav[{$theme}][{$index}]",'nav');
