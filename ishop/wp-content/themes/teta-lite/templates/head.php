<?php
$headerTextColor = '';
	$header      = true;

if ( function_exists( 'is_product_category' ) && ( is_product_category() || is_product_tag() ) ) {
	$cat    = get_queried_object();
	$catID  = $cat->term_id;
	$header = false;

	$display_type_wc_setting  = get_option( 'woocommerce_category_archive_display' );
	$display_type_cat_setting = get_term_meta( $catID, 'display_type', true );

	if ( $display_type_cat_setting == 'both' || ( $display_type_cat_setting == '' && $display_type_wc_setting == 'both' ) ) {

		$header                = true;
		$title                 = woocommerce_page_title( false );
		$subTitle              = strip_tags( term_description() );
		$headerImageID         = get_term_meta( $catID, 'header-background-image', true );
		$headerBackgroundImage = $headerImageID ? wp_get_attachment_url( $headerImageID ) : false;
		$headerTextColor       = get_term_meta( $catID, 'header-text-color', true );

	}
} else {
	$headerBackgroundImage = kite_get_meta( 'header-background-image', true );
	$headerTextColor       = kite_get_meta( 'header-text-color', true );
	$headerBackgroundColor = kite_get_meta( 'header-background-color', true );

	$header = ( kite_get_meta( 'header-type-switch', true ) == '0' || empty( kite_get_meta( 'header-type-switch', true ) ) ) ? true : false;

	if ( ( 'posts' == get_option( 'show_on_front' ) && is_front_page() ) || ( function_exists( 'is_woocommerce' ) && is_product() ) ) {
		$header = ( kite_get_meta( 'header-type-switch', true ) == '0' ) ? true : false;
	} elseif ( 'page' == get_option( 'show_on_front' ) && is_home() ) {
		$header = ( kite_get_meta( 'header-type-switch', true ) == '0' || empty( kite_get_meta( 'header-type-switch', true ) ) ) ? true : false;
	}
	$titleType = kite_get_meta( 'title-bar', true );


	if ( $titleType == '0' ) {
		$title    = '';
		$subTitle = '';
	} elseif ( $titleType == '1' ) {
		$title = kite_get_meta( 'title-text', true );

		$subTitle = kite_get_meta( 'subtitle-text', true );
	} else {
		$title    = kite_get_the_title();
		$subTitle = '';
	}
}

$style = '';
if ( isset( $headerBackgroundImage ) && $headerBackgroundImage ) {
	$style = 'background-image:url(' . esc_url( $headerBackgroundImage ) . ')';
} elseif ( isset( $headerBackgroundColor ) && $headerBackgroundColor ) {
	$style = 'background-color:' . $headerBackgroundColor . ';';
}

 $kiteInlineStyle = '';
if ( $headerTextColor ) {
	$kiteInlineStyle .= '#header h1,#header .subtitle, #header ul li a,.page-breadcrumb .woocommerce-breadcrumb,.page-breadcrumb .woocommerce-breadcrumb a, .page-breadcrumb .woocommerce-breadcrumb span.delimiter,.header_cat_name { color:' . esc_attr( $headerTextColor ) . ';}';
	$kiteInlineStyle .= '#header ul li a:before { background-color:' . esc_attr( $headerTextColor ) . ';}';
}
	wp_add_inline_style( 'kite-inline-style', $kiteInlineStyle );

$page_breadcrumb = kite_opt( 'page_breadcrumb', true );

if ( $header ) {
	$header_classes = $style != '' ? 'hasbg' : '';
	if ( kite_woocommerce_installed() ) {
		if ( is_shop() ) {
			$header_classes .= ' shoppage';
		} elseif ( is_product_category() ) {
			$header_classes .=  ' shoppage catpage ';
		} elseif ( is_product_tag() ) {
			$header_classes .=  ' shoppage tagpage ';
		}
		if ( function_exists( 'wcfm_is_marketplace' ) && wcfm_is_marketplace() ) {
			$header_classes .= ' wcfmheader ';
		}
		if ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) {	
			$header_classes .= ' wcfmstore';
		}
	}
	$containerClass = kite_is_layout_fullwidth( true ) && !kite_is_blog() ? 'fullwidth' : 'container';
	?>

<div id="header" class="<?php echo esc_attr( $header_classes ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<div id="header-content" class="<?php echo esc_attr( $containerClass );?>">
	<?php if ( kite_woocommerce_installed() ) { ?>
		<div class="page-breadcrumb">
			<?php woocommerce_breadcrumb(); ?>
		</div>
		<?php } ?>
		<?php if ( $title ) { ?>
		<div class="pagetitle <?php if ( kite_opt( 'responsive-category-header', false ) ) echo esc_attr('kt-show'); ?>"> 
			<h1><?php echo esc_html( $title ); ?></h1>
		</div>
		<?php } ?>

		<?php
		if ( $subTitle ) {
			if ( kite_woocommerce_installed() && is_product_category() ) {
				kite_wc_category_description_position();
			} else {
				echo "<span class='subtitle'>" . esc_html( $subTitle, 'teta-lite' ) . '</span>';
			}
		}
		if ( kite_woocommerce_installed() ) {
			// show categories and subcategories in shop & category page after shop-filter - ( in both display mode to show category and products)
			if ( ( is_shop() && get_option( 'woocommerce_shop_page_display' ) == 'both' ) || is_product_category() ) {
				$parentid       = get_queried_object_id();
				$args           = array(
					'parent'     => $parentid,
					'hide_empty' => true,
				);
				$header_display = get_option( KITE_THEME_SLUG . '_shop_header_display' );
				if ( isset( $_GET['header_display'] ) ) {
					if ( sanitize_text_field( $_GET['header_display'] ) == 'cat_sub' ) {
						$header_display = 'cat_sub';
					} elseif ( sanitize_text_field( $_GET['header_display'] ) == 'cat_icon' ) {
						$header_display = 'cat_icon';
					} elseif ( sanitize_text_field( $_GET['header_display'] ) == 'cat_image' ) {
						$header_display = 'cat_image';
					}
				}

				$class = '';
				if ( $header_display == 'cat_sub' ) {
					$class = 'product-categories cat-display-sub';
				} elseif ( $header_display == 'cat_image' ) {
					$class = 'products woocommerce wc-categories cat-display-image';
				} else {
					$class = 'cat-display';
				}

				$terms = get_terms( 'product_cat', $args );
				if ( $terms ) {
					echo "<div class='header_cats'><span class='header_cat_name'>" . esc_html__( 'CATEGORIES', 'teta-lite' ) . '</span>';
					if ( $header_display == 'cat_image' ) {
						echo '<ul class="' . esc_attr( $class ) . '">';
							foreach ( $terms as $term ) {
								echo '<li class="product-category">';
									echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
									woocommerce_subcategory_thumbnail( $term );
									echo '<h2>';
										echo esc_attr( $term->name );

								echo '</h2>';
								echo '</a>';

								echo '</li>';
							}
						echo '</ul>';
							
					} elseif ( $header_display == 'cat_sub' ) {
						echo "<div class='cat_display_container'>";
							echo '<ul class="' . esc_attr( $class ) . '">';
								kite_woocommerce_product_extended( $args );
							echo '</ul>';
						echo '</div>';
					} else {
						echo '<ul class="cat_display_container ' . esc_attr( $class ) . '">';
							kite_woocommerce_product_subcategories();
						echo '</ul>';
					}

					echo '</div>';
				}
			}
		}

		?>

	</div>
</div>
	<?php
} ?>
