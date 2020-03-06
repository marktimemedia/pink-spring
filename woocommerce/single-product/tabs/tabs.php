<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
	<?php $i = 1; ?>
	<?php $j = 1; ?>

	<div class="mtm-component--content mtm-tabs--wrapper">
		<ul class="mtm-tabs--title-container" role="tablist">

			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab mtm-tabs--title current" id="tab-title-<?php echo esc_attr( $key ); ?>" data-tab="tab-<?php echo $i++; ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ) ); ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="mtm-tabs--title mtm-tabs--title-accordion current" data-tab="tab-<?php echo $j; ?>" >
				<h3><?php if ( isset( $product_tab['title'] ) ) { echo $product_tab['title']; } ?></h3>
			</div>
			<div class="mtm-tabs--content current" id="tab-<?php echo $j; ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo $j++; ?>">
				<?php if ( isset( $product_tab['callback'] ) ) { call_user_func( $product_tab['callback'], $key, $product_tab ); } ?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
