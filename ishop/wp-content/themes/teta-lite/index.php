<?php
/**
 * The main template file used as blog page
 */
get_header();


// blog Sidebar For Classic blog
$blogSidebar = 'span9';
$span1       = '';/* It is uses to fix the positioning of span 10*/

// Inheritence check for blog sidebar
$postid          = get_queried_object_id();
$checkSidebar    = get_post_meta( $postid, 'blog-sidebar', true );
$checkSidebarpos = get_post_meta( $postid, 'blog-sidebar-position', true );

if ( $checkSidebar == 1 && $checkSidebar != false ) {
	$sidebar = $checkSidebarpos;
} elseif ( $checkSidebar == 2 && $checkSidebar != false ) {
	$sidebar = 'no-sidebar';
} else {
	$sidebar = kite_opt( 'blog-sidebar-position', 'main-sidebar' );
}
if ( ( ( $sidebar == 'main-sidebar' ) || ( $sidebar == 'left-sidebar' ) ) && ! is_active_sidebar( 'main-sidebar' ) ) {
	$sidebar = 'no-sidebar';
}

if ( $sidebar == 'no-sidebar' ) {
	$blogSidebar = 'span10 fullwidth-blog';
}
	$sidebarclass = '';
if ( $sidebar == 'main-sidebar' ) {
	$sidebarclass = 'blog-has-sidebar right';
}
if ( $sidebar == 'left-sidebar' ) {
	$sidebarclass = 'blog-has-sidebar left';
}

	$headerTypeClass = '';
if ( Kite_opt( 'header-type', 1 ) == 10 ) { // humburger menu
	$headerTypeClass = ' type10';
}

$containerClass = kite_is_layout_fullwidth( true ) && !kite_is_blog() ? 'fullwidth' : 'container';
?>
	<section class="cblog <?php echo esc_attr( $sidebarclass ); ?>">
		<div class="wrap">
			<div class="<?php echo esc_attr( $containerClass );?>" id="content">
				<div class="row">
				<?php echo wp_kses( $span1, $GLOBALS['kite-allowed-tags'] ); ?>
					
					<?php if ( $sidebar == 'left-sidebar' ) { ?>
		   
						<!-- left Sidebar  -->
						<div class="span3 main-sidebar-container <?php echo esc_attr( $headerTypeClass ); ?> " >
							<?php kite_get_sidebar( 'main-sidebar' ); ?>
						</div>
			
						
					<?php } ?>
					<div class="
					<?php
					echo esc_attr( $blogSidebar );
					echo esc_attr( $headerTypeClass );
					?>
					">

						<div id="blogloop">
							<?php

								$postpage = isset( $_GET['postpage'] ) ? (int) sanitize_text_field( $_GET['postpage'] ) : 1;

								$args2 = array(
									'post_type' => 'post',
									'paged'     => $postpage,
								);

								$main_query = new WP_Query( $args2 );

								if ( have_posts() ) {
									while ( $main_query->have_posts() ) {
										$main_query->the_post();

										global $post;
										$postType = get_post_meta( get_the_ID(), 'media', true );

										if ( $postType == 'gallery' ) {
											$postType = 'gallery';
										} elseif ( $postType == 'video' ) {
											$postType = 'video';
										} elseif ( $postType == 'video_gallery' ) {
											$postType = 'video';
										} elseif ( $postType == 'audio' ) {
											$postType = 'audio';
										} elseif ( $postType == 'audio_gallery' ) {
											$postType = 'audio';
										} elseif ( $postType == 'quote' ) {
											$postType = 'quote';
										} else {
											$postType = 'standard';
										}
										?>
								
											<div <?php post_class( 'clearfix' ); ?>>
								
												<?php get_template_part( 'templates/loop', 'blog-standard' ); ?>
									
											</div>
										<?php
									}
								}
								?>
						</div>
						
						<?php if ( have_posts() ) { ?>
		
							<!-- Single Page Navigation-->
							<div class="pagenavigation clearfix">
								<div class="navNext"><?php next_posts_link( esc_html__( '&larr; Older Entries', 'teta-lite' ) ); ?></div>
								<div class="navPrevious"><?php previous_posts_link( esc_html__( 'Newer Entries &rarr;', 'teta-lite' ) ); ?></div>
							</div>

						<?php } ?>
					</div>
			
					<?php if ( $sidebar == 'main-sidebar' ) { ?>
		   
						<!-- Right Sidebar  -->
						<div class="span3 main-sidebar-container <?php echo esc_attr( $headerTypeClass ); ?> " >
							<?php kite_get_sidebar( 'main-sidebar' ); ?>
						</div>
			
						
					<?php } ?>

				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
