<!-- custom section  -->
<?php

	$post_id = get_the_ID();
 /*
	 if ( ( get_post_meta( $post_id, "page-type-switch", true ) == "blog-section" ) && ( get_post_meta( $post_id, "blog-type-switch", true ) == "0" ) ) {  ?>

		<?php get_template_part( 'templates/loop-page-blog' ); ?>

	<?php } else  */if ( ( get_post_meta( $post_id, 'page-type-switch', true ) == 'blog-section' ) ) {  ?>	
		
		<div class="row">
			<div class="container">
		
				<?php get_template_part( 'templates/loop-page-cblog' ); ?>	
				
			</div>
		</div>

	<?php
} elseif ( get_post_meta( $post_id, 'page-type-switch', true ) == 'recently-viewed' ) {
	global $recentPage;
	$recentPage = true;
} else {

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<?php the_content(); ?>
				
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'teta-lite' ),
						'after'  => '</div>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					?>

						<div class="container clearfix"> 
							<div class="commentwrap" id="comment-text">
							<?php comments_template(); ?>
							</div>
						</div>

					<?php
				}
				?>
			</div>
			<?php
		}//While have_posts
	}//If have_posts
}
