<div class="no-result-container">
	<span class="no-result-title"><?php esc_html_e( 'No Results Found!', 'teta-lite' ); ?></span>
	<p class="no-result-text"><?php esc_html_e( "We didn't find any article matches your entry. Try different keywords using search box bellow:", 'teta-lite' ); ?></p>
	<?php
	get_search_form([
		'no-result'	=> true
	]);
	?>
</div>
