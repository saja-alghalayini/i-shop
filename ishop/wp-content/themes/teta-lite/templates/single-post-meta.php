<div class="post-meta">
	<div class="post-date-title clearfix">
		<span class="post-categories"><?php the_category( ' . ' ); ?></span>
		<h1 class="post-title"><?php the_title(); ?></h1>
		
		<span class="post-info">
			<span class="post-date"><?php echo get_the_date(); ?></span>
			<span class="post-author kt-icon icon-user" data-name="user"><?php the_author_posts_link(); ?></span>
			<?php if ( comments_open() ) { ?>
			<span class="post-comments kt-icon icon-bubble" data-name="bubble">
				<?php
				if ( comments_open() ) {
					comments_popup_link( esc_html__( 'No Comment', 'teta-lite' ), '1', '%', 'comments-link', '' );}
				?>
			</span>
			<?php } ?>
		</span>
	
	</div>
</div>
