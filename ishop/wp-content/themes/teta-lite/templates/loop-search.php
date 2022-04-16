<section id="blog" class="cblog">
	<div class="row">
		<div class="span10 fullwidth-blog">
			<div id="blogloop" class="results">
				<?php
				while ( have_posts() ) {
					the_post();
					global $post;
					?>
					<div <?php post_class( 'clearfix' ); ?>>
						<?php get_template_part( 'templates/loop', 'blog-standard' ); ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
