<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $hover_color ) || empty( $hover_color ) ) {
	$hover_color      = 'rgba(0, 0, 0, 0.7)';
	$hover_text_color = '#FFF';
	$border           = 'none';
	$style            = '#FFF';
	$image_size 	  = 'shop_catalog';
	$id 			  = kite_sc_id( 'wc_cat_content_loop' );
	$carousel		  = 'disable';
}
if ( ! isset( $description ) ) {
	$description      = '';
}
if ( ! isset( $count ) ) {
	$count            = 1;
}
if ( isset( $show_image ) && $carousel == 'list' ) {
	if ( empty( $show_image ) ) {
		$show_image = false;
	} else {
		$show_image = true;
	}
} else {
	$show_image = true;
}
	$item = '';
if ( isset( $carousel ) && $carousel != 'list' ) {
	$item = esc_html__( 'Items', 'teta-lite' );
}


	$class = array();
if ( $border == '' ) {
	$class[] = 'with-border';
}

// KiteSt CUSTOM CODE
// Find the category + category parent, if applicable
$term      = get_queried_object();
$parent_id = empty( $term->term_id ) ? 0 : $term->term_id;

if ( ! isset( $font_size ) || $font_size == '' ) {
	$font_size = '30';
}

if ( isset( $elementor ) && $elementor == 'elementor' ) {
	$fontsize = 'custom';
}

$cat_font_size = ' fontsize' . $font_size;
$fonts         = array(
	'16'     => '12',
	'20'     => '15',
	'28'     => '18',
	'35'     => '23',
	'44'     => '25',
	'custom' => '',
);

$fontOptions = '';
if ( isset( $font_family ) && $font_family != '' ) {
	$fontOptions = $font_family;
}

// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( https://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
$product_categories = get_categories(
	apply_filters(
		'woocommerce_product_subcategories_args',
		array(
			'parent'       => $parent_id,
			'menu_order'   => 'ASC',
			'hide_empty'   => 0,
			'hierarchical' => 1,
			'taxonomy'     => 'product_cat',
			'pad_counts'   => 1,
		)
	)
);

$display_type_shop_wc_setting = get_option( 'woocommerce_shop_page_display' );
$display_type_wc_setting      = get_option( 'woocommerce_category_archive_display' );
$display_type_cat_setting     = get_term_meta( $parent_id, 'display_type' );


if ( ( ( is_shop() && $display_type_shop_wc_setting !== 'subcategories' ) || ( is_product_category() && $display_type_wc_setting !== 'subcategories' && $product_categories ) ) && ! isset( $elementor ) ) {
	return;
}
// KiteSt CUSTOM CODE

	?> 
<div  <?php wc_product_cat_class( $class, $category ); ?> >
	<div class="product_category_container">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
		<?php if ( $show_image ) : ?>
		<div class="interactive-background-image" style="<?php if ( $carousel == 'list' && $elementor != 'elementor' ) { echo 'width:' . ( $font_size * 2 + 30 ) . 'px;height:' . ( $font_size * 2 + 30 ) . 'px;';}?>">
			<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			// KiteSt code ( pass $iamge_size to acton handler)
			do_action( 'woocommerce_before_subcategory_title', $category, $image_size );
			?>
			<div class="category-hover <?php echo esc_attr( $id ); ?>"> </div>
		</div>
		
		<?php endif; ?>
		<?php
		$kiteInlineStyle = '';
		if ( ! empty( $hover_color ) ) {
			$kiteInlineStyle .= ".wc-categories .category-hover.$id {background-color:$hover_color;}";
		}
		?>
			<?php
			if ( strlen( $style ) ) {
				$kiteInlineStyle .= ".woocommerce div.products div.product.product-category h3.$id{color:$style;}";
			}

			if ( strlen( esc_attr( $hover_text_color ) ) ) {// Changes on hover text color
				if ( $show_image ) {
					$kiteInlineStyle .= '.woocommerce div.products div.product.product-category:hover h3.' . $id;
				} else {
					$kiteInlineStyle .= '.woocommerce div.products div.product.product-category h3.' . $id . ':hover';
				}
				?>

					<?php
					$kiteInlineStyle .= "{color:$hover_text_color;}";
					?>
				<?php
			}
			if ( $show_image && $font_size != 'custom' ) {
				$kiteInlineStyle .= ' .wc-categories.list .product-category h3.' . $id;
				?>
				<?php
				$kiteInlineStyle .= '{width:calc(100% - ' . ( $font_size * 2 + 45 ) . 'px) !important;}';
			} else {
				$kiteInlineStyle .= '.wc-categories.list .product-category h3.' . $id;
				$kiteInlineStyle .= '{width:100% !important;}';
			}

			if ( $font_size != 'custom' && isset( $fonts[ $font_size ] ) ) {
				$kiteInlineStyle .= ".wc-categories .product-category h3 span,.woocommerce .wc-categories .product-category h3 mark {font-size:$fonts[$font_size]px;$fontOptions}";
			}
				wp_add_inline_style( 'kite-inline-style', $kiteInlineStyle );
			?>
		 <h3 class="<?php echo esc_attr( $id ) , esc_attr( $cat_font_size ); ?>" id="<?php echo esc_attr( 'categories_' . $category->term_id ); ?>" style="<?php echo esc_attr( $fontOptions ); ?> <?php
			if ( $carousel == 'list' && $elementor != 'elementor' ) {
				echo 'line-height: ' . ( $font_size ) . 'px;'; }
			?>
			">
					<?php
						echo esc_html( $category->name );
					if ( $count == 'enable' && $category->count > 0 ) {
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . ' ' . esc_attr( $item ) . '</mark>', $category );
					}



					if ( $description == 'enable' && $category->description != '' ) {
						echo '<span>' . esc_html( $category->description ) . '</span>';
					}
					?>
			</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	</div>
</div>
