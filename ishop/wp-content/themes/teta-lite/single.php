<?php
/**
 * Template for displaying all single posts.
 */

	get_header();

	$blogSidebar  = 'span9';
	$sidebarclass = '';

	global $post;
	$sidebar = get_post_type( $post ) == 'elementor_library' ? 'no-sidebar' : kite_opt( 'blog-sidebar-position', 'main-sidebar' );
	if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
		$sidebar = 'no-sidebar';
	}
	if ( $sidebar == 'no-sidebar' ) {
		$blogSidebar = 'span12 fullwidth-blog';
	}
	$containerClass = kite_is_layout_fullwidth( true ) && !kite_is_blog() ? 'fullwidth' : 'container';
	?>

	<div class="<?php echo esc_attr( $containerClass );?>">
		<div class="row">
			<!--Content-->
			<?php
			if ( $sidebar == 'left-sidebar' ) {
				?>
				<!-- left Sidebar  -->
				<div class="span3 main-sidebar-container">
				<?php kite_get_sidebar( 'main-sidebar' ); ?>
				</div>
				<?php
			}
			?>
			<div class="<?php echo esc_attr( $blogSidebar ); ?>">

				<?php
				$postType = get_post_meta( get_the_ID(), 'media', true );
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
						<?php
						if ( $postType == 'gallery' ) {
							get_template_part( 'templates/single', 'post-gallery' );
						} elseif ( $postType == 'video' ) {
							get_template_part( 'templates/single', 'post-video' );
						} elseif ( $postType == 'video_gallery' ) {
							get_template_part( 'templates/single', 'post-video-gallery' );
						} elseif ( $postType == 'audio' ) {
							get_template_part( 'templates/single', 'post-audio' );
						} elseif ( $postType == 'audio_gallery' ) {
							get_template_part( 'templates/single', 'post-audio-gallery' );
						} elseif ( $postType == 'quote' ) {
							get_template_part( 'templates/single', 'post-quote' );
						} else {
							get_template_part( 'templates/single' );
						}
					} // end of the loop.
				} // end if
				?>
			</div>

			<?php
			if ( $sidebar == 'main-sidebar' ) {
				?>
					<!-- Right Sidebar  -->
					<div class="span3 main-sidebar-container">
						<?php kite_get_sidebar( 'main-sidebar' ); ?>
					</div>
			<?php } ?>
		</div>
	</div>
<?php get_footer(); ?>
