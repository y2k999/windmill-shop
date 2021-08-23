<?php
/**
 * Template Name: woocommerce
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
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
 * 	In this sample child theme, you can know how to 
 * 	2. apply customization via WooCommerce hooks.
 * 	3. apply customization via WooCommerce template override.
 * 
 * @reference (Woo)
 * 	https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
*/
?>

<?php
/**
 * @reference (WP)
 * 	Load header template.
 * 	https://developer.wordpress.org/reference/functions/get_header/
*/
?>
<?php get_header(); ?>

<!-- ====================
	<site-content>
 ==================== -->
<section<?php echo apply_filters("_property[section][content]",''); ?><?php echo apply_filters("_attribute[section][content]",''); ?>>
	<div id="content"<?php echo apply_filters("_property[container][content]",esc_attr('site-content')); ?><?php echo apply_filters("_attribute[container][content]",''); ?>>
		<div<?php echo apply_filters("_property[grid][default]",''); ?><?php echo apply_filters("_attribute[grid]",''); ?>>

			<!-- ====================
				<primary>
			 ==================== -->
			<main id="primary"<?php echo apply_filters("_property[column][primary]",esc_attr('site-main')); ?><?php echo apply_filters("_attribute[column][primary]",''); ?>>
				<?php
				/**
				 * @reference (Woo)
				 * 	When creating woocommerce.php in your themefs folder,
				 * 	you will not be able to override the woocommerce/archive-product.php custom template as woocommerce.php has priority over archive-product.php.
				 * 	This is intended to prevent display issues.
				 * 	https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
				*/
				woocommerce_content();
				?>
			</main>

			<!-- ====================
				<secondary>
			 ==================== -->
			<?php
			/**
			 * @reference (WP)
			 * 	Load sidebar template.
			 * 	https://developer.wordpress.org/reference/functions/get_sidebar/
			*/
			get_sidebar();
			?>

		</div><!-- .row -->

	</div><!-- #content -->
</section>

<?php
/**
 * @reference (WP)
 * 	Load footer template.
 * 	https://developer.wordpress.org/reference/functions/get_footer/
*/
?>
<?php get_footer(); ?>
