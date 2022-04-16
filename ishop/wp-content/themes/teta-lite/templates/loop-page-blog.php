<!-- Blog -->
<section  id="blog" class="blogSection">
	<div class="wrap">
		<!-- blog post items -->
		<div id="content">
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

							get_template_part( 'templates/loop', 'blog' );
						}
					}

					wp_reset_postdata();
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
	</div>
</section>
<!-- End Blog -->
