<?php

class Kite_Scripts_Loader {

    /**
     * minify suffix for assets
     *
     * @var string
     */
    protected $suffix = '.min';

    /**
     * kite main js handler id
     *
     * @var string
     */
    protected $js_handler = 'kite-main';

    /**
     * kite main css handler id
     *
     * @var string
     */
    protected $css_handler = 'kite-theme-style';

    /**
     * kite icomoon handler id
     *
     * @var string
     */
    protected $icomoon_handler = 'icomoon';

    /**
	 * Holds the current instance of scripts loader
	 *
	 */
	protected static $instance 	= null;
	
	/**
	 * Retrieves class instance
	 *
	 * @return Kite_Scripts_Loader
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance 	= new self;
		}

		return self::$instance;
	}

    /**
     * Scripts Loader Constructor
     */
    public function __construct() {
        if ( defined( 'KITE_DEVELOP_MODE' ) && KITE_DEVELOP_MODE ) {
            $this->suffix = '';
        }

        add_action( 'wp_enqueue_scripts', [$this, 'set_handler'], 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'add_editor_styles'], 9 );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles'], 9 );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts'], 98 );

        add_action( 'wp_enqueue_scripts', [ $this, 'dequeue_styles'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dequeue_styles'] );
        add_action( 'wp_print_scripts', [ $this, 'dequeue_scripts'], 99 );
        
        add_action( 'customize_controls_print_footer_scripts', [ $this, 'customizer_scripts'] );

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles'], 10 );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts'], 99 );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_inline_styles'], 100 );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_child_theme_styles'], 100 );
    }

    /**
     * set handlers ID
     *
     * @return void
     */
    public function set_handler() {
        if ( ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || !kite_opt( 'load_script_when_required', false ) ) {
            $this->js_handler = 'kite-all';
        }

        if ( ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || !kite_opt( 'load_style_when_required', false ) ) {
            $this->css_handler = 'kite-all-styles';
        }
    }

    /**
     * add editor styles
     *
     * @return void
     */
    public function add_editor_styles() {
        add_theme_support( 'editor-styles' );
        add_editor_style( 'editor-style.css' );
    }

    // Dequeue Styles
    public function dequeue_styles() {
        if ( kite_woocommerce_installed() ) {
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        }

        if ( class_exists( 'YITH_WCWL' ) ) {
            wp_dequeue_style( 'jquery-selectBox' );
        }

        if ( class_exists( 'YITH_Woocompare' ) ) {
            wp_dequeue_style( 'jquery-colorbox' );
        }

    }

    public function dequeue_scripts() {
        global $wp_scripts;
    
        if ( kite_woocommerce_installed() ) {
    
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'vc_woocommerce-add-to-cart-js' );
    
            wp_localize_script(
                $this->js_handler,
                'wc_single_product_params',
                array(
                    'i18n_required_rating_text' => esc_html__( 'Please select a rating', 'teta-lite' ),
                    'review_rating_required'    => get_option( 'woocommerce_review_rating_required' ),
                )
            );
    
            if ( class_exists( 'YITH_WCWL' ) ) {
                wp_dequeue_script( 'jquery-selectBox' );
                // Remove depencency of jquery-yith-wcwl to jquery-selectBox (use this way to keep jquery-yith-wcwl localizations)
                if ( isset( $wp_scripts->registered['jquery-yith-wcwl']->deps[1] ) && $wp_scripts->registered['jquery-yith-wcwl']->deps[1] == 'jquery-selectBox' ) {
                    unset( $wp_scripts->registered['jquery-yith-wcwl']->deps[1] );
                }
                // Remove depencency of jquery-yith-wcwl to prettyPhoto (use this way to keep jquery-yith-wcwl localizations)
                if ( isset( $wp_scripts->registered['jquery-yith-wcwl']->deps[2] ) && $wp_scripts->registered['jquery-yith-wcwl']->deps[2] == 'prettyPhoto' ) {
                    unset( $wp_scripts->registered['jquery-yith-wcwl']->deps[2] );
                }
            }
    
            if ( class_exists( 'YITH_Woocompare' ) ) {
                wp_dequeue_script( 'jquery-colorbox' );
            }
        }
    
    }

    public function customizer_scripts() {
        wp_register_script( 'kite-customizer-script', KITE_THEME_LIB_URI . '/admin/scripts/admin-customizer.js', array( 'jquery' ), '1.0.0' );
        wp_enqueue_script( 'kite-customizer-script' );
    }

    /**
     * register required styles
     *
     * @return void
     */
    public function register_styles() {
        $this->icomoon_handler = wp_style_is( 'icomoon', 'queue' ) ? 'kite-icomoon' : 'icomoon';

        $styles = [
            'swiper' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/swiper.min.css',
                'version' => '4.5.3',
                'dependency' => []
            ],
            'isotope' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/isotope.min.css',
                'version' => '3.0.6',
                'dependency' => []
            ],
            'lightgallery' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/lightGallery.min.css',
                'version' => '1.2.22',
                'dependency' => []
            ],
            $this->icomoon_handler => [
                'file' => KITE_THEME_ASSETS_URI . '/css/icomoon.min.css',
                'version' => KITE_THEME_VERSION,
                'dependency' => []
            ],
            'kite-responsive' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/kite/responsive.css',
                'version' => KITE_THEME_VERSION,
                'dependency' => []
            ],
            'kite-all-styles' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/kite/all-styles.css',
                'version' => KITE_THEME_VERSION,
                'dependency' => []
            ],
            'kite-all-wc-styles' => [
                'file' => KITE_THEME_ASSETS_URI . '/css/kite/all-wc-styles.css',
                'version' => KITE_THEME_VERSION,
                'dependency' => []
            ],
            'kite-inline-styles' => [
                'file' => false,
                'version' => KITE_THEME_VERSION,
                'dependency' => []
            ],
        ];

        foreach( $styles as $style_id => $style_info ) {
            wp_register_style( $style_id, $style_info['file'], $style_info['dependency'], $style_info['version'] );
        }

        wp_register_style( 'kite-inline-style', false );

        if ( is_rtl() ) {
            wp_register_style( 'kite-rtl', KITE_THEME_URI . '/rtl.css', false, KITE_THEME_VERSION );
        }
    }

    /**
     * register required scripts
     *
     * @return void
     */
    public function register_scripts() {

        $scripts = array(
            'polyfill' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/polyfill.js',
                'version' => '1.0',
                'dependency' => [],
            ],
            'isotope' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/isotope.pkgd.min.js',
                'version' => '3.0.6',
                'dependency' => ['jquery'],
            ],
            'jquery-easypiechart' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.easypiechart.min.js',
                'version' => '2.1.7',
                'dependency' => ['jquery'],
            ],
            'jquery-count-to' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.countTo.min.js',
                'version' => '1.0',
                'dependency' => ['jquery']
            ],
            'jquery-easing' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.easing.min.js',
                'version' => '1.3',
                'dependency' => ['jquery']
            ],
            'jquery-fitvids' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.fitvids.min.js',
                'version' => '1.1',
                'dependency' => ['jquery']
            ],
            'jquery-mousewheel'  => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.mousewheel.min.js',
                'version' => '3.1.13',
                'dependency' => ['jquery']
            ],
            'jquery-touchswipe'  => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.touchswipe.min.js',
                'version' => '1.6.18',
                'dependency' => ['jquery']
            ],
            'jquery-waitforimages'  => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.waitForImages.min.js',
                'version' => '2.4.0',
                'dependency' => ['jquery']
            ],
            'jquery-nice-select' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.nice-select.min.js',
                'version' => '1.0',
                'dependency' => ['jquery']
            ],
            'jquery-waypoints' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.waypoints.min.js',
                'version' => '4.0',
                'dependency' => ['jquery']
            ],
            'jquery-waypoints-inveiw' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.waypoints.inview.min.js',
                'version' => '4.0.1',
                'dependency' => ['jquery']
            ],
            'jquery-rtResponsiveTables' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.rtResponsiveTables.min.js',
                'version' => '1.0',
                'dependency' => ['jquery']
            ],
            'swiper' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/swiper.min.js',
                'version' => '4.5.0',
                'dependency' => []
            ],
            'typed' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/typed.js',
                'version' => '2.0.11',
                'dependency' => []
            ],
            'jquery-sticky-kit' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/jquery.sticky-kit.min.js',
                'version' => '2.0.11',
                'dependency' => []
            ],
            'infinite-scroll' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/infinite-scroll.pkgd.min.js',
                'version' => '3.0.5',
                'dependency' => []
            ],
            'modernizr' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/modernizr.min.js',
                'version' => '3.6.0',
                'dependency' => []
            ],
            'lg-custom-package' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/lg-custom-package.min.js',
                'version' => '1.7.1',
                'dependency' => []
            ],
            'kite-all' => [
                'file' => KITE_THEME_ASSETS_URI . '/js/kite/all' . $this->suffix . '.js',
                'version' => KITE_THEME_VERSION,
                'dependency' => [
                    'polyfill',
                    'isotope',
                    'jquery-easing',
                    'jquery-mousewheel',
                    'jquery-touchswipe',
                    'jquery-waitforimages',
                    'jquery-nice-select',
                    'jquery-fitvids',
                    'jquery-count-to',
                    'swiper',
                    'modernizr',
                    'lg-custom-package',
                    'elementor-waypoints', 
                    'jquery-waypoints', 
                    'jquery-waypoints-inveiw',
                    'jquery-easypiechart',
                    'typed',
                    'imagesloaded',
                    'infinite-scroll',
                    'zoom',
                    'jquery-sticky-kit',
                    'jquery-rtResponsiveTables'
                ]
            ],
        );

        if ( ! class_exists('\Elementor\Plugin') ) {
            unset($scripts['kite-all']['dependency'][12] );
        }
        if ( !kite_woocommerce_installed() ) {
            unset($scripts['kite-all']['dependency'][19] );
        }
        foreach( $scripts as $script_id => $script_info ) {
            wp_register_script( $script_id, $script_info['file'], $script_info['dependency'], $script_info['version'], true );
        }
    }
    

    public function enqueue_styles() {
        
        // icomoon style
        wp_enqueue_style( $this->icomoon_handler );
        
        // 3rd parties
        wp_enqueue_style( 'swiper' );
        wp_enqueue_style( 'lightgallery' );
        wp_enqueue_style( 'isotope' );

        // Media Element (use css file in core of WP)
        wp_enqueue_style( 'mediaelement' );
        
        $this->enqueue_fonts_style();

        // check if header or footer build with elementor , enqueue elementor active kite style before theme styles
        if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
            
            $custom_header = kite_get_meta( 'is-header-build-with-elementor' ) ? kite_get_meta( 'header-template' ) : '';
            $elementor_header_ID = kite_opt( 'elementor_header_template_id', '' );
            $custom_footer = kite_get_meta( 'is-footer-build-with-elementor' ) ? kite_get_meta( 'footer-template' ) : '';
            $elementor_footer_ID = kite_opt( 'elementor_footer_template_id', '' );

            if ( ( kite_opt( 'is_header_build_with_elementor', false) && ! empty( $elementor_header_ID ) ) || ! empty( $custom_header) ) {
                $elementor_builder = true;
            } else if ( ( kite_opt( 'is_footer_build_with_elementor', false) && ! empty( $elementor_footer_ID ) ) || ! empty( $custom_footer) ) {
                $elementor_builder = true;
            } else {
                $elementor_builder = false;
            }
            
            if ( $elementor_builder ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( get_option( 'elementor_active_kit' , '') );
                $css_file->enqueue();
            }

            $this->add_elementor_header_style();
        }

            $this->load_all_css_files();

    }

    public function load_all_css_files() {
        // all style
        wp_enqueue_style( 'kite-all-styles' );

        if ( kite_woocommerce_installed() ) {
            wp_enqueue_style( 'kite-all-wc-styles' );
        }

        // responsive style
        wp_enqueue_style( 'kite-responsive' );
    }

    public function enqueue_inline_styles() {
        ob_start();
        include kite_path_combine( KITE_THEME_CSS, '/kite/styles-inline.php' );
        wp_enqueue_style( 'kite-inline-styles' );
        wp_add_inline_style( 'kite-inline-styles', ob_get_clean() );
    }

    public function add_elementor_header_style() {
		$custom_header = kite_get_meta( 'header-template' );
		$elementor_header_ID = kite_opt( 'elementor_header_template_id', '' );
		if ( ( kite_opt( 'is_header_build_with_elementor', false) && ! empty( $elementor_header_ID ) ) || ! empty( $custom_header) ) {
			$elementor_header_ID = ! empty( $custom_header ) ? $custom_header : $elementor_header_ID;
			
			if( class_exists( '\Elementor\Core\Files\CSS\Post' ) ){
				$css_file = new \Elementor\Core\Files\CSS\Post( $elementor_header_ID );
				$css_file->enqueue();
			}
		}
	}

    /**
     * Enqueue google fonts styles
     *
     * @return void
     */
    public function enqueue_fonts_style() {
        $primary_font_type    = kite_opt( 'primary-font-type', 'default' );
        $secondary_font_type = kite_opt( 'secondary-type', 'default' );
        $condenced_font_type = kite_opt( 'condenced-type', 'default' );
        $fontNavType     = kite_opt( 'font-navigation-type', 'default' );

        $primary_font    = array();
        $secondary_font = array();
        $fontNav     = array();
        $def_font    = [
            'font-family'	=> 'DM Sans',
            'font-weight'	=> '400',
            'letter-spacing'=> ''
        ];

        /* Define default fonts */
        if ( $primary_font_type == 'default' || empty( $primary_font_type ) ) {
            $primary_font = array( 'DM Sans' => array( '300', '400', '500', '600', '700' ) );
        } elseif ( $primary_font_type == 'google' ) {
            $primary_font =  [ kite_opt( 'primary-font', $def_font )['font-family'] => array( '300', '400', '500', '600', '700' ) ];
        }

        if ( $secondary_font_type == 'default' || empty( $secondary_font_type ) ) {
            $secondary_font = array( 'Roboto' => array( '300', '400', '500', '600', '700' ) );
        } elseif ( $secondary_font_type == 'google' ) {
            $secondary_font = [ kite_opt( 'secondary-font', $def_font )['font-family'] => array( '300', '400', '500', '600', '700' ) ];
        }

        if ( $condenced_font_type == 'default' || empty( $condenced_font_type ) ) {
            $condenced_font = array( 'DM Sans' => array( '300', '400', '500', '600', '700' ) );
        } elseif ( $condenced_font_type == 'google' ) {
            $condenced_font = [ kite_opt( 'condenced-font', $def_font )['font-family'] => array( '300', '400', '500', '600', '700' ) ];
        }

        if ( $fontNavType == 'default' ) {
            $fontNav = array( 'DM Sans' => array( '300', '400', '500', '600', '700' ) );
        } elseif ( $fontNavType == 'google' ) {
            $fontNav = [ kite_opt( 'font-navigation', $def_font )['font-family'] => array( '300', '400', '500', '600', '700' ) ];
        }

        // Merge 4 font arrays + remove duplicates
        $fonts   = array_merge( $primary_font, $secondary_font, $fontNav, $condenced_font );
        $fonts   = array_filter( $fonts );// remove empty elements
        $fontReq = '//fonts.googleapis.com/css?family=';

        $RequestedFonts = array();
        foreach ( $fonts as $font => $variants ) {
            // Repplace space in font name with plus character
            $query = preg_replace( '/ /', '+', $font );

            if ( count( $variants ) ) {
                $query .= ':' . implode( ',', $variants );
            }

            $RequestedFonts[] = $query;
        }

        // Load default or user selected google fonts
        $fontReq .= implode( '|', $RequestedFonts );

        if ( 'disable' !== kite_opt( 'google_font_display', 'disable' ) ) {
            $fontReq .= '&display=' . kite_opt( 'google_font_display' );
        }

        if ( count( $RequestedFonts ) > 0 ) {
            wp_enqueue_style( 'kite-fonts', $fontReq );
        }

        /* Load custom fonts */
        if ( $primary_font_type == 'custom' ) {
            $primary_custom_font_url = kite_opt( 'primary-font-custom-url' );
            wp_enqueue_style( 'kite-custom-primary-font', $primary_custom_font_url );
        }

        if ( $secondary_font_type == 'custom' ) {
            $secondary_custom_font_url = kite_opt( 'secondary-font-custom-url' );
            wp_enqueue_style( 'kite-custom-secondary-font', $secondary_custom_font_url );
        }

        if ( $condenced_font_type == 'custom' ) {
            $condenced_custom_font_url = kite_opt( 'condenced-font-custom-url' );
            wp_enqueue_style( 'kite-custom-condenced-font', $condenced_custom_font_url );
        }

        if ( $fontNavType == 'custom' ) {
            $nav_custom_font_url = kite_opt( 'custom-font-url-navigation' );
            wp_enqueue_style( 'kite-custom-nav-font', $nav_custom_font_url );
        }
    
    }

    public function enqueue_scripts() {
            $this->loadAllJsFiles();
    }

    public function loadAllJsFiles() {
        wp_enqueue_script( 'kite-all' );
        // additional scripts
        $custom = kite_opt( 'additional-js' );
        $custom = str_replace( '<script>', '', $custom );
        $custom = str_replace( '</script>', '', $custom );

        // Localize custom.js with url of site
        wp_localize_script(
            $this->js_handler,
            'kite_theme_vars',
            array(
                // site variables
                'url'              => esc_url( get_site_url() ),
                'home_url'         => esc_url( home_url( '/' ) ),
                'img'              => esc_url( KITE_THEME_IMAGES_URI ),
                // ajax variables
                'ajax_url'         => esc_url( admin_url( 'admin-ajax.php' ) ),
                'nonce'            => wp_create_nonce( 'ajax-nonce' ),
                // scrolling options
                'scrolling_speed'  => esc_html( kite_opt( 'scrolling-speed' ) ),
                'scrolling_easing' => esc_html( kite_opt( 'scrolling-easing' ) ),
                // Custom scripts
                'additionaljs'     => $custom,
                'sort_by_text'	   => esc_html__( 'Sort By', 'teta-lite' ),
                'see_all_results'  => esc_html__( 'See All Results For : ', 'teta-lite' ),
                'show_more'  	   => esc_html__( 'Show More', 'teta-lite' ),
                'add_to_cart'  	   => esc_html__( 'Add to cart', 'teta-lite' ),
            )
        );

        // get exception pages of ajax
        $no_ajax_pages = kite_no_ajax_pages();
        wp_localize_script(
            $this->js_handler,
            'no_ajax_objects',
            array(
                'no_ajax_pages' => $no_ajax_pages,
            )
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        $this->localize_blog_posts_data();
    }

    // load more function
    public function localize_blog_posts_data() {

        // Add some parameters for the JS - blog load more .
        $queryArgsPost = array(
            'post_type' => 'post',
        );
        $query         = new WP_Query( $queryArgsPost );
        $max           = $query->max_num_pages;
        $paged         = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

        wp_localize_script(
            $this->js_handler,
            'paged_data',
            array(
                'startPage'       => $paged,
                'maxPages'        => $max,
                'nextLink'        => next_posts( $max, false ),
                'loadingText'     => esc_html__( 'Loading...', 'teta-lite' ),
                'loadmoreText'    => esc_html__( 'more posts', 'teta-lite' ),
                'noMorePostsText' => esc_html__( 'No More Posts', 'teta-lite' ),
            )
        );
        wp_reset_postdata();

    }

    /**
     * Load child theme styles if set to load all styles in theme
     *
     * @return void
     */
    public function enqueue_child_theme_styles() {
        if ( !is_child_theme() || $this->css_handler != 'kite-all-styles' ) {
            return;
        }

        wp_enqueue_style( 'kite-child-theme-styles', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', [] );  

    }
}

Kite_Scripts_Loader::get_instance();