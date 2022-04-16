<div <?php post_class( ['kt-post-format-gallery'] ); ?>>
	<?php
	$sidebar = kite_opt( 'blog-sidebar-position', 'main-sidebar' );// to make header gallery fill in span8
	if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
		$sidebar = 'no-sidebar';
	}
	if ( $sidebar == 'no-sidebar' ) {
		?>
		<div class="row single-post-header"><div class="span12">
	<?php } ?>
	<?php 
	get_template_part( 'templates/single', 'post-meta' ); 
	$images = kite_get_meta( 'gallery' );
	if ( ! empty( $images ) ) {
	?>
		<div class="post-media">
			<div class="bp-swiper swiper-container clearfix <?php echo( ( ! is_array( $images ) || count( $images ) == 1 ) ? 'disabled_swiper' : '' ); ?>">
				<?php if ( is_array( $images ) ) { ?>
				<!-- Next Arrows -->
				<div class="arrows-button-next no-select"></div>


				<!-- Prev Arrows -->
				<div class="arrows-button-prev no-select"></div>
				
				<?php } ?>
		
				<div class="swiper-wrapper">
				
					<?php

					if ( ! is_array( $images ) ) {
						?>

						<div class="swiper-slide">  <?php echo "<img src=\"$images\"/>"; ?> </div>
					
						<?php
					} else {

						$imageSize = 'full';
						foreach ( $images as $img ) {
							// For getting image size use
							// http://php.net/manual/en/function.getimagesize.php
							$imgId = kite_get_image_id( $img );
							if ( $imgId == -1 ) { // Fallback
								if ( ! empty( $img ) ) {
									$imgTag = '<img src="' . esc_url( $img ) . '"/>';
								}
							} else {
								$imgTag = wp_get_attachment_image( $imgId, $imageSize );
							}

							?>

							<?php if ( ! empty( $imgTag ) ) { ?>
								<div class="swiper-slide">  <?php echo '' . $imgTag;// Sanitization performed in above lines! ?> </div>
							<?php } ?>

							<?php
						}
					}
					?>
					  
				</div>

			</div>
			</div>
	<?php
	}
	if ( $sidebar == 'no-sidebar' ) {
		?>
		 </div></div>
		<?php
	}
	the_content();
	wp_link_pages();
	?>
</div>
<?php get_template_part( 'templates/single', 'post-content' ); ?>
