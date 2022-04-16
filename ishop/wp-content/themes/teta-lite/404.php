<?php
/**
 * 404 (Page not found) template
 */
get_header();
?>
	<div class="wpb_wrapper">
		<div class="row">
			<div class="span12 not_found_page">
				<span
				><?php esc_html_e( 'Error', 'teta-lite' ); ?></span>
				<span id="not_found"><?php esc_html_e( '404', 'teta-lite' ); ?></span>
				<span><?php esc_html_e( 'Page not found', 'teta-lite' ); ?></span>
				
				<p>
					<span><?php esc_html_e( 'Don\'t Worry!', 'teta-lite' ); ?></span><br>
					<span><?php esc_html_e( 'You are not lost', 'teta-lite' ); ?></span>
				</p>
				<div id="search_box" class="search-container">
					<div class="search-form ">
					<?php
					get_search_form([
						'404-form'	=> true
					]);
					?>
					</div>
				</div>
			</div>
		 </div>
	</div>
<?php get_footer(); ?>
