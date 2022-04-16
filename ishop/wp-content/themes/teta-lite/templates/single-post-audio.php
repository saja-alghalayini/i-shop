<div <?php post_class( ['kt-post-format-audio'] ); ?>>
	<?php
	$sidebar = kite_opt( 'blog-sidebar-position', 'main-sidebar' );// to make header audio fill in span8
	if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
		$sidebar = 'no-sidebar';
	}
	if ( $sidebar == 'no-sidebar' ) {
		?>
		<div class="row single-post-header"><div class="span12">
	<?php } ?>
	<?php get_template_part( 'templates/single', 'post-meta' ); ?>
	<div class="post-media">
		<?php

		// Parse the content for the first occurrence of video url
		$audio = kite_extract_audio_info( kite_get_meta( 'audio-url' ) );

		if ( $audio != null ) {
			// Extract video ID
			?>
			<div class="post-media audio-frame">
				<?php
				echo kite_soundcloud_get_embed( $audio['url'] );
				?>
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
