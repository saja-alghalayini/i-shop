<div <?php post_class( ['kt-post-format-standard'] ); ?>>

	<?php
	// Post thumbnail
	if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) {
		?>
		<!--<div class="post-media">
			<div class="post-media">
				<?php the_post_thumbnail( 'Kite_standard-blog-detail' ); ?>
			</div>
		</div> !-->
	<?php } ?>
   
	
	<?php
		get_template_part( 'templates/single', 'post-meta' );
		the_content();
		wp_link_pages();
	?>
</div>
<?php get_template_part( 'templates/single', 'post-content' ); ?>
