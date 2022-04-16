<?php

if ( kite_get_meta( 'display-top-slider' ) != '1' || ( is_shop() && kite_is_shop_ajax_request() ) || kite_get_meta( 'snap-to-scroll' ) == 1 ) {
	echo '<div id="kt-home" class="hidehome"></div>';
	return;
}

	// overlay Options
	$sliderType         = kite_get_meta( 'slider-type' );
	$homeRevSlide       = kite_get_meta( 'home-rev-slide' );
	$sliderRevContainer = kite_get_meta( 'rev-slider-container' );
	$sliderParallax     = kite_get_meta( 'slider-parallax' );

?>
<section id="kt-home" class="
<?php
echo esc_attr( ( $sliderParallax == 1 ) ? 'sliderParallax ' : '' );
if ( $homeRevSlide != 'no-slider' ) {
	echo esc_attr( $homeRevSlide ); }
?>
">
	<h1 style="display:none!important"> <?php esc_html_e( 'Home section', 'teta-lite' ); ?> </h1>
	<div class="slider-wrap">
		<div class="homewrap">
			<?php
			if ( $sliderType == 'slider-revolutionSlider' ) {
				?>
				<!-- Revolution Slider -->
				<div id="homeHeight" class="revolutionSlider">
					<?php
					if ( $sliderRevContainer != 0 ) {
						?>
					<div class="container">
						<?php
					}
					if ( class_exists( 'RevSliderFront' ) && $homeRevSlide != 'no-slider' ) {
						$homeRevolutionslider = '[rev_slider ' . $homeRevSlide . ']';
						echo do_shortcode( $homeRevolutionslider );
					}
					?>
					<?php if ( $sliderRevContainer != 0 ) { ?>
					</div>
						<?php
					}
					?>
				</div>

				<?php
			}

			?>

		</div>
	</div>
</section>
<div id="startHere"></div>
