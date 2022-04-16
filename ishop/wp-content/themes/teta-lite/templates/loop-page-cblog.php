<?php

	$blogSidebar = 'span9';
	$span1       = '';/* It is used to fix the positioning of span 10*/

	// Inheritance check for blog sidebar
	$postid          = $wp_query->queried_object->ID;
	$checkSidebar    = get_post_meta( $postid, 'blog-sidebar', true );
	$checkSidebarpos = get_post_meta( $postid, 'blog-sidebar-position', true );

if ( $checkSidebar == 1 ) {
	$sidebar = $checkSidebarpos;
} elseif ( $checkSidebar == 2 ) {
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

?>
<!-- Blog -->
<section  id="blog" class="cblog <?php echo esc_attr( $sidebarclass ); ?>">
	<div class="wrap">
		<!-- blog post items -->
		<div class="container" id="content">
			<div class="row">
				<?php echo '' . $span1; ?>
				<?php if ( $sidebar == 'left-sidebar' ) { ?>
			   
			   <!-- left Sidebar  -->
				<div class="span3 main-sidebar-container">
					<?php kite_get_sidebar( 'main-sidebar' ); ?>
				</div>
				
			<?php } ?>
				<div class="<?php echo esc_attr( $blogSidebar ); ?>">
				
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
				<div class="span3 main-sidebar-container">
					<?php kite_get_sidebar( 'main-sidebar' ); ?>
				</div>
				
			<?php } ?>

			</div>
		</div>
		
	</div>
</section>
<!-- End Blog -->
