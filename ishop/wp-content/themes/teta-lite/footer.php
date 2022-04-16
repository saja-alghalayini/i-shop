<?php

get_template_part( 'templates/layout', 'end' );

/**
 * Hook : kite_footer_action hook
 * 
 * @hooked: kite_widgetized_footer - 5
 * @hooked: kite_recent_products - 10
 * @hooked: kite_maybe_print_elementor_footer - 1000
 * 
 */
do_action( 'kite_footer_action' );
?>

	<!-- end of wrap element -->
	</div>
	<?php
	if ( function_exists( 'is_woocommerce' ) && kite_opt( 'woocommerce-notices', true ) != '0' ) {
		?>
		<div id="kt_wc_notices">
			<div class="wc-notice-content"></div>
		</div>
		<?php
	}

		wp_footer();

	?>
	</body>
</html>
