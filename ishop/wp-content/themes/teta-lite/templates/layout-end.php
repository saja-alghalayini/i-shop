<?php
if ( ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) || is_page_template( 'main-page.php' ) || is_page() || is_home() || is_404() || is_search() || is_archive() || is_single() ) {  ?> 
			</div>
		</div>
	</div>
<?php } else { ?>
			</div> <!-- close container div - use in whislist, dokan and ...  -->
		</div>
	</div>
</div>

<?php } ?>
