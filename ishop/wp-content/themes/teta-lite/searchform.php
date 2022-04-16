<?php

$search_post_type = kite_opt( 'search_post_type', 'product' );

if ( ! $search_post_type ) { // set on product when update theme
	$search_post_type = 'product';
}
if ( !empty( $args['kite-modern-search-form'] ) ) {
	extract( $args );
	?>
	<div <?php if ( ! empty( $wrap_id ) ) echo 'id="' . $wrap_id . '"'; ?> class="<?php echo esc_attr( $wrap_classes ); ?>" >
		<form role="search" method="get" class="<?php echo esc_attr( $form_classes ); ?>"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( ! empty( $terms ) ) : ?>
				<div class='mobilesearchcats nice-select hidden-desktop' tabindex="0">
					<span class="current"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></span>
					<ul class="list">
						<li data-value="all" class="option selected"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></li>
						<?php foreach ( $terms as $term ) { ?>
							<li data-value="<?php echo esc_attr( $term->slug ); ?>" class="option"><?php echo esc_html( $term->name ); ?></li>
						<?php } ?>
					</ul>
				</div>
			<?php endif; ?>
			<div class="searchelements <?php echo esc_attr( $style );?>">
				<input type="text" class="searchinput" placeholder="<?php echo esc_attr( $search_place_holder ); ?>" name='s' autocomplete="off">
				<?php if ( ! empty( $terms ) ) : ?>
					<div class="nice-select searchcats hidden-tablet hidden-phone">
						<span class="current"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></span>
						<ul class="list">
							<li data-value="all" class="option selected"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></li>
							<?php foreach ( $terms as $term ) { ?>
								<li data-value="<?php echo esc_attr( $term->slug ); ?>" class="option"><?php echo esc_html( $term->name ); ?></li>
							<?php } ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
			<div class="searchicon">
				<a href="#/">
				<?php if ( ! $svg_icon || empty( $svg_url ) ) { ?>
					<span class="<?php echo esc_attr( $search_icon );?>"></span>
				<?php } else { ?>
					<span><img src="<?php echo esc_url( $svg_url );?>" alt="<?php esc_attr_e( 'search icon', 'teta-lite' )?>"></span>
				<?php } ?>
				</a>
			</div>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
			<input type="hidden" name="cat" value="">

		</form>
		<div class="results-info">
			<div class="searchresults close">
				<div class="kt-history"></div>
				<div class="kt-result"></div>
			</div>
			<div class="show_all_results close"><?php esc_html_e( 'See All Results', 'teta-lite' ); ?></div>
		</div>
	</div>

	<?php
} elseif ( !empty( $args['no-result'] ) ) {
	?>
	<div class="no-result-search-box">
		<form role="search" method="get" class=""  action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Search...', 'teta-lite' ); ?>">
			<input type="submit" value="<?php esc_attr_e( 'Search', 'teta-lite' ); ?>">
		</form>
	</div>
	<?php
} elseif ( !empty( $args['404-form'] ) ) {
	?>
	<form role="search" method="get" class="searchform"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="inner-searchform-container searchelements">
			<input type="text" class="searchinput" placeholder="<?php esc_attr_e( 'Search', 'teta-lite' ); ?>" value="" name='s' autocomplete="on">

			<div class="searchicon">
				<span class="kt_button"><?php esc_html_e( 'search', 'teta-lite' ); ?></span>
			</div>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		</div>
	</form>
	<?php
} elseif ( !empty( $args['shop-filter-search-form'] ) ) {
	?>
	<span class="search-box no-select">
		<span class="icon icon-magnifier"></span>
		<span class="text"><?php echo esc_html__( 'Search', 'teta-lite' ) ?> </span>
		<span class="close"></span>
	</span>
	<div class="filter-search-form-container">
		<form role="search" method="get" class="woocommerce-product-search <?php echo esc_attr( $args['search-arg-class'] );?>" data-type="<?php echo esc_attr( $args['search-type'] );?>" action="<?php echo esc_url( $args['page-url'] );?>">
			<span class="icon icon-magnifier"></span>
			<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) );?>" class="cross_close_link"><span class="cross_close"></span></a>
			<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'teta-lite' );?>" value="<?php echo esc_attr( get_search_query() );?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'teta-lite' );?>" />
			<input type="hidden" name="post_type" value="product" />
		</form>
		<span class="search-hint hide"><?php echo esc_html__( 'Press "Enter" to search', 'teta-lite' );?></span>
	</div>
	<?php
} elseif ( !empty( $args['kite-search-form'] ) ) {
	?>
	<div class="search-form search-container popup">
		<form role="search" method="get" class="searchform popup"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text"><?php esc_html_x( 'Search for:', 'label', 'teta-lite' ); ?></label>
				<div class="searchwrapper">
					<input type="text" placeholder="<?php echo esc_attr_x( 'Search', 'submit button', 'teta-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" class='searchinput' autocomplete="off" />
					<div class="typing-indicator">
					<span></span>
					<span></span>
					<span></span>
					</div>
					<div class="cat_container">
						<?php
						$cat_args = array(
							'orderby'    => 'term_id',
							'order'      => 'ASC',
							'hide_empty' => false,
						);
						if ( $search_post_type == 'product' ) {
							$terms = get_terms( array( 'taxonomy' => 'product_cat' ) );
						} else {
							$terms = get_terms( array( 'taxonomy' => 'category' ) );
						}
						if ( kite_opt( 'search_form_hide_subcategories', false ) ) {
							foreach( $terms as $key => $term ) {
								if ( $term->parent ) {
									unset( $terms[$key] );
								}
							}
						}

						/**
						 * Filter to modify popup search terms
						 */
						$terms = apply_filters( 'kite_popup_search_terms', $terms );
						
						?>
						<div class="nice-select searchcats" tabindex="0">
							<span class="current"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></span>
							<ul class="list">
								<li data-value="all" class="option selected"><?php echo apply_filters( 'kite_search_all_terms_label', esc_html__( 'All Categories', 'teta-lite' ) ); ?></li>
						<?php
						if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
							foreach ( $terms as $term ) {
								?>
									<li data-value="<?php echo esc_attr( $term->slug ); ?>" class="option"><?php echo esc_html( $term->name ); ?></li>
								<?php
							}
						}
						?>
							</ul>
						</div>
					</div>
					<a href="#" class="search-icon-link"><div class="searchicon"><span class="icon icon-search"></span></div></a>
					<div class="searchresults close">
						<?php if ( kite_opt( 'show_history_in_search', false ) ) { ?>
							<div class="kt-history"></div>
						<?php } ?>
						<div class="kt-result"></div>
					</div>
					<div class="show_all_results close"><?php esc_html_e( 'See All Results', 'teta-lite' ); ?></div>
				</div>
				<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
				<input type="hidden" name="cat" value="">
		</form>
	</div>
	<?php
} else {
?>

<div class="search-form 
<?php
if ( kite_opt( 'search-widget-category', false ) ) {
	?>
	 widget-has-catlist <?php } ?>">
	<form role="search" method="get" class="searchform"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="inner-searchform-container">
			<label class="screen-reader-text" for="searchwidget"><?php esc_html_x( 'Search for:', 'label', 'teta-lite' ); ?></label>
			<input type="text" placeholder="<?php echo esc_attr_x( 'Search keywords', 'submit button', 'teta-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="searchwidget" />
			<div class='widget_area_display searchicon'><span class="icon icon-search"></span></div>
			<?php if ( kite_opt( 'search-widget-category', false ) ) { ?>
			<div class="cat_container widget_area_display">
				<?php
				$cat_args = array(
					'orderby'    => 'term_id',
					'order'      => 'ASC',
					'hide_empty' => false,
				);
				if ( $search_post_type == 'product' ) {
					$terms = get_terms( 'product_cat', $cat_args );
				} else {
					$terms = get_terms( 'category', $cat_args );
				}
				if ( kite_opt( 'search_form_hide_subcategories', false ) ) {
					foreach( $terms as $key => $term ) {
						if ( $term->parent ) {
							unset( $terms[$key] );
						}
					}
				}
				?>
				<div class="nice-select searchcats" tabindex="0">
					<span class="current"><?php esc_html_e( 'All Categories', 'teta-lite' ); ?></span>
					<ul class="list">
						  <li data-value="all" class="option selected"><?php esc_html_e( 'All Categories', 'teta-lite' ); ?></li>
				<?php
				foreach ( $terms as $term ) {
					?>
						<li data-value="<?php echo esc_attr( $term->slug ); ?>" class="option"><?php echo esc_html( $term->name ); ?></li>
				<?php } ?>
					</ul>
					<div class="icon"> 		
					</div>
				</div>
			</div>
			<?php } ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>">
		
		</div>
	</form>
</div>
<?php
}