<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php if ( ! kite_is_shop_ajax_request() ) { ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1,user-scalable=0" />
	<meta name="theme-color" content="<?php echo esc_attr( kite_opt( 'style-accent-color', '#5956e9' ) ); ?>">
		<?php 
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>

			<?php
			// If the 'has_site_icon' function doesn't exist (ie we're on < WP 4.3) or if the site icon has not been set
			if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {
				?>
		  
				<?php
				$site_icon_url = empty( get_site_icon_url() ) ? kite_opt( 'favicon', '' ) : get_site_icon_url(); 
				if (  ! empty ( $site_icon_url ) ) { ?>
				<link rel="shortcut icon" href="<?php echo esc_url( $site_icon_url ); ?>"  />
				<?php } ?>

			<?php } ?>

	<?php }
	?>
		<?php wp_head(); ?>
	<?php } ?>
</head>

<body <?php body_class(); ?> <?php kite_body_attr(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	?>
	<?php if ( ! kite_is_shop_ajax_request() ) { ?>
	
		<div id="top"></div>

		<?php
		/**
		 * Hook: kite_before_layout_starts
		 * 
		 * @hooked: kite_scroll_to_top - 5
		 */
		do_action( 'kite_before_layout_starts' );
		?>
		
		<div class="layout">

		<?php
		/**
		 * Hook: kite_preloader_section.
		 *
		 * @hooked kite_preloader - 10
		 */
		do_action( 'kite_preloader_section' );

		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

			/**
			 * Header Section Hook
			 * 
			 * @hooked kite_topbar 			5
			 * @hooked kite_mobile_nav 		10 
			 * @hooked kite_print_header 	15
			 */			
			do_action( 'kite_header_section' );
			
		}

	}

	get_template_part( 'templates/layout', 'start' );
	?>
