<?php

function kite_register_menus() {
	register_nav_menu( 'primary-nav', esc_html__( 'Primary Navigation', 'teta-lite' ) );
	register_nav_menu( 'category-nav', esc_html__( 'Ladder Navigation', 'teta-lite' ) );
	register_nav_menu( 'mobile-nav', esc_html__( 'Mobile Navigation', 'teta-lite' ) );
	register_nav_menu( 'topbar-nav', esc_html__( 'Top bar Navigation', 'teta-lite' ) );
	register_nav_menu( 'footer-nav', esc_html__( 'Footer Navigation', 'teta-lite' ) );
}

add_action( 'init', 'kite_register_menus' );
