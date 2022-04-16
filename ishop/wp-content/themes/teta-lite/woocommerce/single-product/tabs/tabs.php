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
 * @see     https://docs.woocommerce.com/document/template-structure/
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
 *
 * @see woocommerce_default_product_tabs()
 */
 
if ( kite_get_meta( 'product_desc_tab_inherit' ) == '1' ) {
	$product_desc_tab = kite_get_meta('product_desc_tab' );  // style of product description in product page
} else {
	$product_desc_tab = kite_opt( 'product_desc_tab' , 'tab' ); // style of product description in theme settings
}

$class = array();

switch ( $product_desc_tab ) {
	case 'vartical_tab':
		$class[] = 'vartical-woo-tab container';
		break;
	case 'accordion_tab':
		$class[] = 'accordion-tab container';
		break;
	case 'tab':
		$class[] = 'tab';
		break;
}
$tabcontainer = " ";
if ($product_desc_tab == 'tab' ){
	$tabcontainer = " container ";
}

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
        <div class=" woocommerce-tabs wc-tabs-wrapper <?php echo implode( ' ', $class );  ?> ">
    <?php if ($product_desc_tab == 'vartical_tab' ){ ?>
    <div class="vartical-tab">
    <?php }?>
        <?php if ($product_desc_tab != 'accordion_tab' ){ ?>
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="<?php echo esc_url( '#tab-' . $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		        <?php } ?>
        <?php if ($product_desc_tab == 'vartical_tab' ){ ?>
        </div> 
        <?php } ?>
        <?php if ($product_desc_tab == 'accordion_tab' ){ ?>
        <ul class="tabs wc-tabs" role="tablist">
        <?php 
		}
		$i = 1;
		foreach ( $product_tabs as $key => $product_tab ) : ?>
			<?php if ($product_desc_tab == 'accordion_tab' ){ ?>
                    <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                    <a href="<?php echo esc_url( '#tab-' . $key ); ?>" class="tab-title"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?></a>
                    </li>
                <?php }?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); if ( $i > 1 ) echo ' hide-during-load'; ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
			
			<?php if ( esc_attr( $key ) != 'description' ) {  
				if ($product_desc_tab == 'tab' ){?>
				<div class="container">
				<?php }
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab ); }
					?>
					<?php if ($product_desc_tab == 'tab' ){ ?>
						</div> <?php } ?>
				<?php
			} elseif ( ( esc_attr( $key ) == 'description' ) ) {
				?>
					<div class="<?php echo esc_attr($tabcontainer); ?> descriptionTab">
						<?php
						if ( isset( $product_tab['callback'] ) ) {
							call_user_func( $product_tab['callback'], $key, $product_tab ); }
						?>
					</div>
				<?php
			} else {
				?>
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab ); }
				?>
			<?php } ?>
			<!-- edit by KiteSt -->

			</div>
		<?php 
		++$i;
		endforeach; 
		?>
		        <?php if ($product_desc_tab == 'accordion_tab' ){ ?>
        <ul>
        <?php }?>
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
