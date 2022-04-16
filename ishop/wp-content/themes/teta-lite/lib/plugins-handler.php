<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once KITE_THEME_LIB . '/includes/class-tgm-plugin-activation.php';
class Kite_Plugins_Handler {

    /**
     * TGMPA Menu slug
     *
     * @var string
     */
    protected $tgmpa_menu_slug = 'install-required-plugins';

    /**
     * TGMPA Menu url
     *
     * @var string
     */
    protected $tgmpa_url = 'themes.php?page=install-required-plugins';


	/**
	 * Holds the current instance of the plugins handler
	 *
	 */
	protected static $instance 	= null;
	
	/**
	 * Retrieves class instance
	 *
	 * @return Kite_Plugins_Handler
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance 	= new self;
		}

		return self::$instance;
	}

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'tgmpa_register', array( $this, 'kite_register_required_plugins' ) );
		add_action( 'vc_before_init', array( $this, 'kite_vc_set_as_theme' ) );
		add_action( 'wp_ajax_install_plugins', array( $this, 'install_plugins') );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
	}

	/**
	 * Register required plugins
	 */
	public function kite_register_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			// Kite Core
			array(
				'name'             => 'Kitestudio Core',
				'slug'             => 'kitestudio-core',
				'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'required'         => false,
			),
		);
		
		$plugins = apply_filters( 'kite_theme_neccessary_plugins', $plugins );

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       => 'teta-lite',          // Text domain - likely want to be the same as your theme.
			'default_path' => '',                      // Default absolute path to pre-packaged plugins
			'parent_slug'  => 'themes.php',            // Default parent menu slug
			'parent_slug'  => 'themes.php',            // Default parent URL slug
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'menu'         => 'install-required-plugins', // Menu slug
			'has_notices'  => false,                       // Show admin notices or not
			'is_automatic' => false,                       // Automatically activate plugins after installation or not
			'message'      => '',                      // Message to output right before the plugins table
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'teta-lite' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'teta-lite' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'teta-lite' ), // %1$s = plugin name
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'teta-lite' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'teta-lite' ), // %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'teta-lite' ), // %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'teta-lite' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'teta-lite' ),
				'return'                          => esc_html__( 'Return to required plugins installer', 'teta-lite' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'teta-lite' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'teta-lite' ), // %1$s = dashboard link
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated' or 'error'
			),
		);

		tgmpa( $plugins, $config );
	}

	// Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the  Settings-> Visual Composer page
	public function kite_vc_set_as_theme() {
		vc_set_as_theme();
	}

	/**
	 * Check capability for handling plugins
	 */
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
     * get all required plugins
     */
    public function _get_plugins() {
        $instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
        $plugins  = array(
            'all'      => array(), // Meaning: all plugins which still have open actions.
            'install'  => array(),
            'update'   => array(),
            'activate' => array(),
        );

        foreach ( $instance->plugins as $slug => $plugin ) {
            if ( $instance->plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
                continue;
            } else {
                $plugins['all'][ $slug ] = $plugin;

                if ( ! $instance->is_plugin_installed( $slug ) ) {
                    $plugins['install'][ $slug ] = $plugin;
                } else {
                    if ( false !== $instance->does_plugin_have_update( $slug ) ) {
                        $plugins['update'][ $slug ] = $plugin;
                    }

                    if ( $instance->can_plugin_activate( $slug ) ) {
                        $plugins['activate'][ $slug ] = $plugin;
                    }
                }
            }
        }

        return $plugins;
    }

    /**
     * Install Plugins
     */
    public function install_plugins() {
        if ( ! check_ajax_referer( 'kite_theme_admin_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
            wp_send_json_error(
                array(
                    'error'   => 1,
                    'message' => esc_html__(
                        'No Slug Found',
                        'teta-lite'
                    ),
                )
            );
        }
        $json = array();
        // send back some json we use to hit up TGM
		$plugins = $this->_get_plugins();
		$received_slug = sanitize_text_field( $_POST['slug'] );
        // what are we doing with this plugin?
        foreach ( $plugins['activate'] as $slug => $plugin ) {
            if ( $received_slug == $slug ) {
                $json = array(
                    'url'           => admin_url( $this->tgmpa_url ),
                    'plugin'        => array( $slug ),
                    'tgmpa-page'    => $this->tgmpa_menu_slug,
                    'plugin_status' => 'all',
                    '_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
                    'action'        => 'tgmpa-bulk-activate',
                    'action2'       => - 1,
                    'message'       => esc_html__( 'Activating ', 'teta-lite' ) . $plugin['name'],
                );
                break;
            }
        }
        foreach ( $plugins['update'] as $slug => $plugin ) {
            if ( $received_slug == $slug ) {
                $json = array(
                    'url'           => admin_url( $this->tgmpa_url ),
                    'plugin'        => array( $slug ),
                    'tgmpa-page'    => $this->tgmpa_menu_slug,
                    'plugin_status' => 'all',
                    '_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
                    'action'        => 'tgmpa-bulk-update',
                    'action2'       => - 1,
                    'message'       => esc_html__( 'Updating ', 'teta-lite' ) . $plugin['name'],
                );
                break;
            }
        }
        foreach ( $plugins['install'] as $slug => $plugin ) {
            if ( $received_slug == $slug ) {
                $json = array(
                    'url'           => admin_url( $this->tgmpa_url ),
                    'plugin'        => array( $slug ),
                    'tgmpa-page'    => $this->tgmpa_menu_slug,
                    'plugin_status' => 'all',
                    '_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
                    'action'        => 'tgmpa-bulk-install',
                    'action2'       => - 1,
                    'message'       => esc_html__( 'Installing ', 'teta-lite' ) . $plugin['name'],
                );
                break;
            }
        }

        if ( $json ) {
            $json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
            wp_send_json( $json );
        } else {
            if ( $received_slug == 'woocommerce' ) {
                if ( get_transient( '_wc_activation_redirect' ) ) {
                    delete_transient( '_wc_activation_redirect' );
                }
            }
            if ( $received_slug == 'elementor' ) {
                if ( get_transient( 'elementor_activation_redirect' ) ) {
                    delete_transient( 'elementor_activation_redirect' );
                }
            }
            wp_send_json(
                array(
                    'done'    => 1,
                    'message' => esc_html__(
                        'Success',
                        'teta-lite'
                    ),
                )
            );
        }
        exit;
    }
}

Kite_Plugins_Handler::get_instance();