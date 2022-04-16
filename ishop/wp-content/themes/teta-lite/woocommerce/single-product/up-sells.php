<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : 

	$upsells_width = kite_opt( 'upsells_fullwidth', false ) ? 'fullwidth' : 'container';
	$upsells_grid_mode = kite_opt( 'upsells_grid_mode', false ) ? 'grid' : 'carousel';
	$data_layout_mode = $upsells_grid_mode == 'grid' ? "data-layoutmode=fitRows" : '';
?>

<div class="<?php echo esc_attr( $upsells_width ); ?>">
	<div class="up-sells upsells products">
		<div class="related <?php echo esc_attr( $upsells_grid_mode ); ?> woocommerce wc-shortcode no-responsive-animation" <?php echo esc_attr( $data_layout_mode ); ?>>

			<h2><?php esc_html_e( 'You may also like&hellip;', 'teta-lite' ); ?></h2>

			<?php woocommerce_product_loop_start(); ?>

			<?php if ( $upsells_grid_mode == 'carousel' ) : ?>
			<div class="swiper-container" data-visibleitems="<?php kite_eopt( 'shop-column', '4');?>" data-exist_items="<?php echo count( $upsells ); ?>">
					<div class="swiper-wrapper">
			<?php endif;?>

						<?php foreach ( $upsells as $upsell ) : ?>

							<?php
								$post_object = get_post( $upsell->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object );

								wc_get_template_part( 'content', 'product' );
							?>

						<?php endforeach; ?>
			<?php if ( $upsells_grid_mode == 'carousel' ) : ?>
				</div>
			</div>

			<div class="arrows-button-next"></div>
			<div class="arrows-button-prev"></div>
			
			<?php endif; ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>
	</div>
</div>

	<?php
endif;

wp_reset_postdata();
