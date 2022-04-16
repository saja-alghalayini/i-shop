<?php
get_header();
// Get the sidebar option
$sidebarPos = kite_opt( 'sidebar-position', 2 );
$sidebar    = kite_get_meta( 'sidebar' );
if ( empty( $sidebar ) ) {
	$sidebar = 'page-sidebar';
}
if ( kite_get_meta( 'snap-to-scroll' ) == 1 ) {
	$sidebar = 'no-sidebar';
}
$containerClass = kite_is_layout_fullwidth( true ) ? 'fullwidth' : 'container';

?>
<!-- Page Content-->
<div class="wrap <?php echo esc_attr( $containerClass );?>" id="pageheight">

		<?php
		$page_type = kite_get_meta( 'page-type-switch' );

		if ( $page_type == 'custom-section' ) {

			if ( $sidebar == 'no-sidebar' ) {
			?>
				<div class="<?php echo esc_attr( $containerClass );?>">

				<?php get_template_part( 'templates/loop-page' ); ?>

				</div>
			<?php
			} else {
				if ( ! is_active_sidebar( $sidebar ) ) {
					$contentClass          = 'span12';
					$sidebarContainerClass = '';
				} else {

					$contentClass          = 'span9';
					$sidebarContainerClass = 'span3 page-sidebar-container';
				}
				if ( 1 == $sidebarPos ) {
					$contentClass .= ' float-right';
				}
				?>

			<div class="pagehassidebar <?php if ( ! function_exists( 'is_checkout' ) || ! is_checkout() ) { ?> container <?php } ?>">
				<div class="row">
					<div class="<?php echo esc_attr( $contentClass ); ?>"><?php get_template_part( 'templates/loop-page' ); ?></div>
					<div class="<?php echo esc_attr( $sidebarContainerClass ); ?>"><?php kite_get_sidebar( $sidebar ); ?></div>
				</div>
			</div>

				<?php
			}
		} elseif ( $page_type == 'blog-section' ) {
			?>
	
				<?php get_template_part( 'templates/loop-page' ); ?>
	
			<?php
		} else {
			if ( $sidebar == 'no-sidebar' ) {
				?>
				 
				<div class="container">
						<?php get_template_part( 'templates/loop-page' ); ?>
				</div>
				 
				 <?php
			} else {

				if ( ! is_active_sidebar( $sidebar ) ) {
					$contentClass          = 'span12';
					$sidebarContainerClass = '';
				} else {

					$contentClass          = 'span9';
					$sidebarContainerClass = 'span3 page-sidebar-container';
				}
				if ( 1 == $sidebarPos ) {
					$contentClass .= ' float-right';
				}
				?>

				<div class="pagehassidebar <?php if ( ! function_exists( 'is_checkout' ) || ! is_checkout() ) { ?> container <?php } ?>">
					<div class="row">
						<div class="<?php echo esc_attr( $contentClass ); ?>"><?php get_template_part( 'templates/loop-page' ); ?></div>
						<div class="<?php echo esc_attr( $sidebarContainerClass ); ?>"><?php kite_get_sidebar( $sidebar ); ?></div>
					</div>
				</div>
			

			<?php } ?>
		<?php } ?>

</div>

<!-- Page Content End -->
<?php

$footerMap = kite_get_meta( 'footer-map' );
if ( $footerMap == 1 && kite_get_meta( 'snap-to-scroll' ) != 1 ) {
	// Footer Map
	get_template_part( 'templates/section', 'location' );
}

get_footer(); 

?>
