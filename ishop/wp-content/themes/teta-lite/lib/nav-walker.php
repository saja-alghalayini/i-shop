<?php

class Kite_Nav_Walker extends Walker_Nav_Menu {

	private $navIdPrefix = '';

	private $curItemID;
	private $megaMenuWraperID;
	private $menu_output = true;

	public function __construct( $idPrefix = 'menu-item-' ) {
		$this->navIdPrefix = $idPrefix;
	}

	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$this->curItemID = $object->ID;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		$classes = array_slice( $classes, 0 );
		// add mega menu class
		$is_mega_menu = get_post_meta( $object->ID, 'is-mega-menu', true );
		if ( $depth == 0 && $is_mega_menu == 1 ) {
			$classes[] = 'mega-menu-parent';
		}

		 $is_bottom_line = get_post_meta( $object->ID, 'is-bottom-line', true );

		if ( $depth == 1 && $is_bottom_line == 1 ) {
			$classes[] = 'special-last-child';
		}
		
		$hide_menu_title = get_post_meta( $object->ID, 'hide-menu-title', true );
		if ( $hide_menu_title == 1 ) {
			$classes[] = 'hide-menu-title';
		}

		$menu_hover_style = kite_opt( 'menu-hover-style', 3 ); // Menu hover style

		// badge
		$badge          = get_post_meta( $object->ID, 'badge-label', true );
		$badge_bg_color = get_post_meta( $object->ID, 'badge-bg-color', true );

		// Add icon
		$icon = '';

		$icon = get_post_meta( $object->ID, 'nav-menu-icon', true );

		$headerType = kite_opt( 'header-type', 1 ); // Header type
		$bg         = '';

		if ( $depth > 0 && $headerType !== '8' && $headerType !== '7' ) {
			$bg = get_post_meta( $object->ID, 'bg-image', true );

			if ( $bg != '' ) {
				$classes[] = 'has-bg';
				$bg        = " style='background:url( " . esc_url( $bg ) . ");'";
			}
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$attributes  = ! empty( $object->attr_title ) ? ' title="' . esc_attr( $object->attr_title ) . '"' : '';
		$attributes .= ! empty( $object->target ) ? ' target="' . esc_attr( $object->target ) . '"' : '';
		$attributes .= ! empty( $object->xfn ) ? ' rel="' . esc_attr( $object->xfn ) . '"' : '';

		$attributesexternal = '';

		if ( $object->object == 'page' ) {
			$varpost       = get_post( $object->object_id );
			$separate_page = get_post_meta( $object->object_id, 'page-position-switch', true );

			$disable_menu    = get_post_meta( $object->ID, 'hide-in-menu-switch', true );
			$current_page_id = get_option( 'page_on_front' );

			$isHome = ( $varpost->ID == $current_page_id ) ? true : false;

			if ( $varpost->ID == $current_page_id ) { // set it to prevent unwanted value saved in home-page
				$separate_page = '0';
			}

			if ( $disable_menu != 1 ) {

				if ( ! empty( $icon ) ) {
					$hasIcon = 'has-icon';
				} else {
					$hasIcon = '';
				}

				$output .= $indent . '<li' . $value . $class_names . $bg . '>';
				if ( $depth == 0 && $menu_hover_style == 1 ) {
					$output .= '<span class="spanhover"></span>';
				}

				if ( $separate_page == '0' ) { // seperate page 0 = Page open in external page
					if ( $isHome ) {
						$attributes         .= ' class="locallink home" data-hash="home"  href="' . esc_url( home_url( '/' ) ) . '#home"';
						$attributesexternal .= ' class="externallink ' . $hasIcon . '" href="' . esc_url( home_url( '/' ) ) . '"'; // External Link In External Page

					} else {
						$attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
						$attributes .= ' class="' . $hasIcon . '" ';
					}
				} elseif ( $separate_page == '1' ) { // seperate page 1 = Page open in container page
					if ( is_front_page() ) {
						 $attributes         .= ' class="locallink ' . $hasIcon . '" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In main Page
						 $attributesexternal .= ' class="externallink ' . $hasIcon . '" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=kt_' . $varpost->post_name ) . '"'; // External Link In External Page
					} else {
						$attributes         .= ' class="locallink ' . $hasIcon . '" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In main Page
						$attributesexternal .= ' class="externallink ' . $hasIcon . '" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=kt_' . $varpost->post_name ) . '"'; // External Link In External Page
					}
				} else {
					 $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
					 $attributes .= ' class="' . $hasIcon . '" ';
				}

				$object_output = $args->before;

				$object_output .= '<a' . $attributes . '>';

				if ( ! empty( $icon ) ) {
					$object_output .= '<span class="icon icon-' . esc_attr( $icon ) . '"></span>';
				}

				if ( $depth == 0 && $menu_hover_style == 2 ) {
					$object_output .= '<hr>';
				}

				$object_output .= $args->link_before . '<span class="menu_title_wrap"><span class="menu_title"><span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';

				if ( $badge != '' ) {
					$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
				}

				$object_output .= '</span></span>';

				if ( $depth == 2 && $object->description != '' ) {
					$object_output .= '<span class="subtitle">' . $object->description . '</span>';
				}

				$object_output .= $args->link_after;

				$object_output .= '</a>';

				// this Part Of Code not generate for seperate page
				if ( $separate_page == '1' || $isHome ) {

					$object_output .= '<a' . $attributesexternal . ' >';

					if ( ! empty( $icon ) ) {
						$object_output .= '<span class="icon icon-' . esc_attr( $icon ) . '"></span>';
					}
					if ( $depth == 0 && $menu_hover_style == 2 ) {
						$object_output .= '<hr>';
					}

					$object_output .= $args->link_before . '<span class="menu_title_wrap"><span class="menu_title"><span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';

					if ( $badge != '' ) {
						$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
					}

					$object_output .= '</span></span>';

					if ( $depth == 2 && $object->description != '' ) {
						$object_output .= '<span class="subtitle">' . $object->description . '</span>';
					}

					$object_output .= '</a>';
				}

				$object_output .= '' . $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

			} else {
				$this->menu_output = false;
			}
		} else {

			$output .= $indent . '<li ' . $value . $class_names . $bg . '>';
			if ( $depth == 0 && $menu_hover_style == 1 ) {
				$output .= '<span class="spanhover"></span>';
			}
			$attributes .= ! empty( $object->url ) ? ' href="' . esc_url( $object->url ) . '"' : '';

			$object_output = $args->before;
			if ( ! empty( $icon ) ) {
				$hasIcon = 'has-icon';
			} else {
				$hasIcon = '';
			}
			$object_output .= '<a' . $attributes . ' class="' . $hasIcon . '">';

			if ( ! empty( $icon ) ) {
				$object_output .= '<span class="icon icon-' . esc_attr( $icon ) . '"></span>';
			}

			if ( $depth == 0 && $menu_hover_style == 2 ) {
				$object_output .= '<hr>';
			}

			$object_output .= $args->link_before . '<span class="menu_title_wrap"><span class="menu_title"><span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';

			if ( $badge != '' ) {
				$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
			}

			$object_output .= '</span></span>';

			if ( $depth == 2 && $object->description != '' ) {
				$object_output .= '<span class="subtitle">' . $object->description . '</span>';
			}

			$object_output .= '</a>';

			$object_output .= '' . $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

		}
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $this->menu_output == false ) {
			$this->menu_output = true;
			return;
		}

		$output .= '</li>';
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent     = str_repeat( "\t", $depth );
		$bg         = '';
		$wrapper    = '';
		$headerType = kite_opt( 'header-type', 1 ); // Header type

		// if menu be Left Or Roght menu
		$mplevelstart = '';
		$mpback       = '';

		if ( $headerType == '8' || $headerType == '7' ) {
			$mplevelstart = "<div class='mp-level'>";
			$mpback       = "<a class='mp-back' href='" . esc_url( '#' ) . "'>" . esc_html__( 'back', 'teta-lite' ) . '</a>';
		}

		if ( $depth == 0 ) {

			if ( $headerType !== '8' && $headerType !== '7' ) { // bg not Supported in vertical menus
				$bg = get_post_meta( $this->curItemID, 'bg-image', true );
			}

			$is_mega_menu = get_post_meta( $this->curItemID, 'is-mega-menu', true );
			if ( $is_mega_menu == 1 && $headerType !== '7' && $headerType !== '8' ) {
				$this->megaMenuWraperID = $this->curItemID;
				$wrapper                = "<div class='menu-item-wrapper'>";
				if ( $bg != '' ) {
					$wrapper = "<div class='menu-item-wrapper' style='background:url( " . esc_url( $bg ) . ");'>";
				}
			}
		}

		$output .= "\n$indent" . $wrapper . $mplevelstart . $mpback . "<ul class='sub-menu'>\n";

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent       = str_repeat( "\t", $depth );
		$wrapperEnd   = '';
		$is_mega_menu = get_post_meta( $this->megaMenuWraperID, 'is-mega-menu', true );
		$headerType   = kite_opt( 'header-type', 1 ); // Header type
		$mplevelend   = '';

		// if menu be Left Or Right menu
		if ( $headerType == '8' || $headerType == '7' ) {
			$mplevelend = '</div>';
		}

		// Wrap Of mega menu all type Of Menu Expect Menu left Or Menu Right
		if ( $this->megaMenuWraperID != -1 && $depth == 0 && $is_mega_menu == 1 && $headerType !== 7 && $headerType !== 8 ) {
			$this->megaMenuWraperID = -1;// reset saved ID
			$wrapperEnd             = '</div>';

		}

		$output .= "$indent</ul>" . $mplevelend . $wrapperEnd . "\n";

	}
}



/**********************************************
 * Mobile menu nav-walker
 **********************************************/
class Kite_Mobbile_Nav_Walker extends Walker_Nav_Menu {

	private $navIdPrefix = '';

	private $curItemID;
	private $menu_output = true;

	public function __construct( $idPrefix = 'menu-item-' ) {
		$this->navIdPrefix = $idPrefix;
	}

	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$this->curItemID = $object->ID;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$classes = array_slice( $classes, 0 );

		// badge
		$badge          = get_post_meta( $object->ID, 'badge-label', true );
		$badge_bg_color = get_post_meta( $object->ID, 'badge-bg-color', true );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$attributes  = ! empty( $object->attr_title ) ? ' title="' . esc_attr( $object->attr_title ) . '"' : '';
		$attributes .= ! empty( $object->target ) ? ' target="' . esc_attr( $object->target ) . '"' : '';
		$attributes .= ! empty( $object->xfn ) ? ' rel="' . esc_attr( $object->xfn ) . '"' : '';

		$attributesexternal = '';

		if ( $object->object == 'page' ) {
			$varpost       = get_post( $object->object_id );
			$separate_page = get_post_meta( $object->object_id, 'page-position-switch', true );

			$disable_menu    = get_post_meta( $object->ID, 'hide-in-menu-switch', true );
			$current_page_id = get_option( 'page_on_front' );

			$isHome = ( $varpost->ID == $current_page_id ) ? true : false;

			if ( $varpost->ID == $current_page_id ) { // set it to prevent unwanted value saved in home-page
				$separate_page = '0';
			}

			if ( ( $disable_menu != 1 ) ) {
				if ( ! empty( $icon ) ) {
					$hasIcon = 'has-icon';
				} else {
					$hasIcon = '';
				}

				$output .= $indent . '<li ' . $value . $class_names . '>';

				if ( $separate_page == '0' ) { // seperate page 0 = Page open in external page
					if ( $isHome ) {
						$attributes         .= ' class="locallink home" data-hash="home"  href="' . esc_url( home_url( '/' ) ) . '#home"';
						$attributesexternal .= ' class="externallink" href="' . esc_url( home_url( '/' ) ) . '"'; // External Link In External Page

					} else {
						$attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
					}
				} elseif ( $separate_page == '1' ) { // seperate page 1 = Page open in container page
					if ( is_front_page() ) {
						$attributes         .= ' class="locallink" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In main Page
						$attributesexternal .= ' class="externallink " data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=kt_' . $varpost->post_name ) . '"'; // External Link In External Page
					} else {
						$attributes         .= ' class="locallink" data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In main Page
						$attributesexternal .= ' class="externallink " data-hash="kt_' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=kt_' . $varpost->post_name ) . '"'; // External Link In External Page
					}
				} else {
					 $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
				}

				$object_output = $args->before;

				$object_output .= '<a' . $attributes . '>';

				$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );

				if ( $badge != '' ) {
					$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
				}

				$object_output .= $args->link_after;
				$object_output .= '</a>';

				// this Part Of Code don't generated for seperate page
				if ( $separate_page == '1' || $isHome ) {
					$object_output .= '<a' . $attributesexternal . '>';

					$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );

					if ( $badge != '' ) {
						$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
					}

					$object_output .= '</a>';
				}

				$object_output .= '' . $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

			} else {
				$this->menu_output = false;
			}
		} else {

			$output .= $indent . '<li ' . $value . $class_names . '>';

			$attributes .= ! empty( $object->url ) ? ' href="' . esc_url( $object->url ) . '"' : '';

			$object_output = $args->before;

			$object_output .= '<a' . $attributes . '>';

			$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );

			if ( $badge != '' ) {
				$object_output .= '<span class="badge no-select"' . ( $badge_bg_color != '' ? ' style="background-color:' . esc_attr( $badge_bg_color ) . '"' : '' ) . '> ' . $badge . '</span>';
			}

			$object_output .= '</a>';

			$object_output .= '' . $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

		}
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $this->menu_output == false ) {
			$this->menu_output = true;
			return;
		}

		$output .= '</li>';
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$toggle  = '<span class="toggle_submneu"><span class="toggle_icon"></span></span>';
		$output .= "\n$indent" . $toggle . "<ul class='sub-menu'>\n";

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );

		$output .= "$indent</ul>" . "\n";

	}
}

/**********************************************
 * simple menu nav-walker
 **********************************************/
// A nav_walker to show menu just in depth = 0
class Kite_Simple_Nav_Walker extends Walker_Nav_Menu {

	private $navIdPrefix = '';

	private $curItemID;

	public function __construct( $idPrefix = 'menu-item-' ) {
		$this->navIdPrefix = $idPrefix;
	}

	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

		if ( $depth > 0 ) {
			return;
		}

		$this->curItemID = $object->ID;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$classes = array_slice( $classes, 0 );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$attributes  = ! empty( $object->attr_title ) ? ' title="' . esc_attr( $object->attr_title ) . '"' : '';
		$attributes .= ! empty( $object->target ) ? ' target="' . esc_attr( $object->target ) . '"' : '';
		$attributes .= ! empty( $object->xfn ) ? ' rel="' . esc_attr( $object->xfn ) . '"' : '';

		$attributesexternal = '';

		if ( $object->object == 'page' ) {
			$varpost       = get_post( $object->object_id );
			$separate_page = get_post_meta( $object->object_id, 'page-position-switch', true );

			$disable_menu    = get_post_meta( $object->ID, 'hide-in-menu-switch', true );
			$current_page_id = get_option( 'page_on_front' );

			$isHome = ( $varpost->ID == $current_page_id ) ? true : false;

			if ( $varpost->ID == $current_page_id ) { // set it to prevent unwanted value saved in home-page
				$separate_page = '0';
			}

			if ( ( $disable_menu != 1 ) ) {

				$output .= $indent . '<li ' . $value . $class_names . '>';
				if ( $separate_page == '0' ) { // seperate page 0 = Page open in external page
					if ( $isHome ) {
						$attributes         .= ' class="locallink home" data-hash="home"  href="' . esc_url( home_url( '/' ) ) . '#home"';
						$attributesexternal .= ' class="externallink" href="' . esc_url( home_url( '/' ) ) . '"'; // External Link In External Page

					} else {
						$attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
					}
				} elseif ( $separate_page == '1' ) { // seperate page 1 = Page open in container page
					if ( is_front_page() ) {
						 $attributes         .= ' class="locallink" data-hash="' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In container Page
						 $attributesexternal .= ' class="externallink" data-hash="' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=' . $varpost->post_name ) . '"'; // External Link In External Page
					} else {
						$attributes         .= ' class="locallink" data-hash="' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) ) . '?locaklink"'; // locallink In container Page
						$attributesexternal .= ' class="externallink" data-hash="' . esc_attr( $varpost->post_name ) . '" href="' . esc_url( home_url( '/' ) . '?sectionid=' . $varpost->post_name ) . '"'; // External Link In External Page
					}
				} else {
					 $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) . '"' : '';
				}

				$object_output = $args->before;

				$object_output .= '<a' . $attributes . '>';

				$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );
				$object_output .= $args->link_after;
				$object_output .= '</a>';

				// this Part Of Code not generate for seperate page
				if ( $separate_page == '1' || $isHome ) {
					$object_output .= '<a' . $attributesexternal . '>';
					$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );
					$object_output .= $args->link_after;
					$object_output .= '</a>';
				}

				$object_output .= '' . $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
			}
		} else {

			$output .= $indent . '<li ' . $value . $class_names . '>';

			$attributes .= ! empty( $object->url ) ? ' href="' . esc_url( $object->url ) . '"' : '';

			$object_output = $args->before;

			$object_output .= '<a' . $attributes . '>';

			$object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID );
			$object_output .= $args->link_after;
			$object_output .= '</a>';

			$object_output .= '' . $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		}
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}

}
