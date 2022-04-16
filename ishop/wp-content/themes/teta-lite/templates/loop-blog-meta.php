<div class="blog-details">
	<?php
	$post_type = get_post_meta( get_the_ID(), 'media', true );
	if ( $post_type == 'audio' || $post_type == 'video' ) {
		$class = array();
		if ( $post_type == 'video' ) {
			$class[] = 'youtube-logo';
		}
		$class = implode( ' ', $class );
		echo "<div class='post-type-indicator $class'>";
	}
	if ( $post_type == 'audio' ) {
		echo "<img src='" . KITE_THEME_ASSETS_URI . '/content/img/podcast.svg' . "' alt='post_audio'>";
	} elseif ( $post_type == 'video' ) {
		echo "<img src='" . KITE_THEME_ASSETS_URI . '/content/img/youtube-logo.svg' . "' alt='post_video'>";
	}
	if ( $post_type == 'audio' || $post_type == 'video' ) {
		echo '</div>';
	}
	?>
	<span class="post-categories"><?php the_category( ' ' ); ?></span>
	<div class="post-meta">
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<?php
		// blog Post text excerpt
		the_excerpt();
	?>
	<div class="post-info-container clearfix">
		<div class="post-info">
			<span class="post-date">
				<?php
				if ( empty( get_the_title() ) ) {
					echo "<a href='" . get_the_permalink() . "'>";
				}				
				echo get_the_date();

				if ( empty( get_the_title() ) ) {
					echo "</a>";
				}
				?>
			</span>
			<span class="post-author kt-icon icon-user" data-name="user"><?php the_author_posts_link(); ?></span>
			<?php if ( comments_open() ) { ?>
			<span class="post-comments kt-icon icon-bubble" data-name="bubble">
				<?php
				if ( comments_open() ) {
					comments_popup_link( esc_html__( 'No Comment', 'teta-lite' ), '1', '%', 'comments-link', '' );}
				?>
			</span>
			<?php } ?>
		</div>
	</div>
</div>
