<?php

	get_header();

?>

<!-- Page Content-->
<?php

$shopClass = '';

if ( ! is_product() ) {
	$shopClass = ' kt_shop_page';
	if ( isset( $_GET['shopWidth'] ) && ! empty( $_GET['shopWidth'] ) ) {
		if ( sanitize_text_field( $_GET['shopWidth'] ) == 'fullwidth' ) {
			$shopClass .= ' fullwidth';
		} elseif ( sanitize_text_field( $_GET['shopWidth'] ) == 'container' ) {
			$shopClass .= ' container';
		} else {
			if ( kite_opt( 'shop-enable-fullwidth', false ) ) {
				$shopClass .= ' fullwidth';
			} else {
				$shopClass .= ' container';
			}
		}
	} else {
		if ( kite_opt( 'shop-enable-fullwidth', false ) ) {
			$shopClass .= ' fullwidth';
		} else {
			$shopClass .= ' container';
		}
	}
} else {
	$shopClass = ' kt_product_page';
}

if ( isset( $_GET['pagination'] ) && ( ( sanitize_text_field( $_GET['pagination'] ) == 'pagination' ) || ( sanitize_text_field( $_GET['pagination'] ) == 'load_more' ) || ( sanitize_text_field( $_GET['pagination'] ) == 'infinite_scroll' ) ) ) {
	$pagination = sanitize_text_field( $_GET['pagination'] );
} else {
	$pagination = kite_opt( 'products-pagination', 'pagination' );
}
?>
<div class="wrap kitesection customSection woocommercepage <?php echo esc_attr( $shopClass ); ?> <?php echo esc_attr( $pagination ); ?>" id="pageheight">

	<?php
	// Get the sidebar option
	if ( isset( $_GET['shopSidebar'] ) && ! empty( $_GET['shopSidebar'] ) ) {
		if ( sanitize_text_field( $_GET['shopSidebar'] ) == 'left' ) {
			$sidebarPos = '1';
		} elseif ( sanitize_text_field( $_GET['shopSidebar'] ) == 'right' ) {
			$sidebarPos = '2';

		} elseif ( sanitize_text_field( $_GET['shopSidebar'] ) == 'no-sidebar' ) {
			$sidebarPos = '0';
		} else {
			$sidebarPos = kite_opt( 'shop-sidebar-position', 0 );
		}
	} else {
		$sidebarPos = kite_opt( 'shop-sidebar-position', 0 );
	}


	// shop and category page display options
	$display_type_shop_wc_setting = get_option( 'woocommerce_shop_page_display' );
	$display_type_wc_setting      = get_option( 'woocommerce_category_archive_display' );

	if ( 0 == $sidebarPos ) {

		if ( is_product() ) {

			 kite_woocommerce_content();

		} elseif ( is_shop() || is_product_category() || is_product_tag() ) {
			?>
			<div class="row  <?php if ( $display_type_shop_wc_setting == 'subcategories' || $display_type_wc_setting == 'subcategories' ) { echo 'shop_is_categories_style'; } ?>"> <!-- "shop_categories_style" categories style for shop -->  
				<?php kite_woocommerce_content(); ?>
			</div>

		<?php } else { ?>

			<div class="row">
				<?php kite_woocommerce_content(); ?>
			</div>

			<?php
		}
	} else {
		?>
		<!-- has Sidebar -->   
		<?php if ( is_product() ) { ?>

			<div class="shop_coulmn3">
				<?php kite_woocommerce_content(); ?>
			</div>
				  
		<?php } elseif ( is_shop() || is_product_category() || is_product_tag() ) { ?>

			<div class="row  <?php if ( $display_type_shop_wc_setting == 'subcategories' || $display_type_wc_setting == 'subcategories' ) { echo 'shop_is_categories_style'; } ?>">  <!-- "shop_categories_style" categories style for shop -->  
				<?php kite_woocommerce_content(); ?>
			</div>

		<?php } else { ?>

			<div class="row">
				<?php kite_woocommerce_content(); ?>
			</div>
		<?php } ?>

	<?php } ?> 

</div><!-- Page Content End -->

<?php 
if ( is_shop() ) { 
	// disable processing of footer widget area and map in djax requests for better performance
	if ( ! kite_is_shop_ajax_request() ) {
		if ( get_post() ) {
			$footerMap = kite_get_meta( 'footer-map' );

			if ( $footerMap == '1' ) {
				get_template_part( 'templates/section', 'location' );
			}

		}
	}
}

get_footer(); 

?>
