<div <?php post_class( ['kt-post-format-video-gallery'] ); ?>>
	<?php
	$sidebar = kite_opt( 'blog-sidebar-position', 'main-sidebar' );// to make header gallery and video fill in span8
	if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
		$sidebar = 'no-sidebar';
	}
	if ( $sidebar == 'no-sidebar' ) {
		?>
		<div class="row single-post-header"><div class="span12">
	<?php } ?>
	<?php get_template_part( 'templates/single', 'post-meta' ); ?>
	<div class="post-media">
		<!-- Video -->
		<?php


		// Parse the content for the first occurrence of video url
		$video     = get_post_meta( get_the_ID(), 'video-id', true );
		$videoType = get_post_meta( get_the_ID(), 'video-type', true );

		if ( $video != null ) {
			$w = 500;
			$h = 280;

			// Extract video ID
			?>
			<div class="post-media video-frame">
				<?php
				if ( $videoType == 'youtube' ) {
					// detect youtube id form url
					$video_id = explode( '?v=', $video ); // For videos like http://www.youtube.com/watch?v=...
					if ( empty( $video_id[1] ) ) {
						$video_id = explode( '/v/', $video ); // For videos like http://www.youtube.com/watch/v/..
					}
					if ( ! empty( $video_id[1] ) ) {
							$video_id = explode( '&', $video_id[1] ); // Deleting any other params
							$video_id = $video_id[0];
					} else {
						$video_id = $video;
					}

					$url = 'http://www.youtube.com/watch?v=' . $video_id;
				} else {
					$vimeoId = preg_replace( '/[^0-9]/', '', $video );
					$url = 'http://vimeo.com/' . $vimeoId;
				}

				echo wp_oembed_get( $url, array( 'width' => $w , 'height' => $h ) );
				?>
			</div>
		<?php } ?>

		<!-- SlideShow -->
		<?php
		$images = kite_get_meta( 'gallery' );
		if ( is_array( $images ) && count( $images ) ) {
			?>
		
			<div class="bp-swiper swiper-container clearfix <?php echo( count( $images ) == 1 ? 'disabled_swiper' : '' ); ?>">
				
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
								<div class="swiper-slide">  <?php echo '' . $imgTag; ?> </div>
							<?php } ?>

							<?php
						}
					}
					?>
					  
				</div>
			</div>
			<?php
		}
		?>

	</div>
	<?php

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
