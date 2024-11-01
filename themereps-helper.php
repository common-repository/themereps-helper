<?php
/**
 * Plugin Name:       Themereps Helper
 * Plugin URI:        https://wordpress.org/plugins/themereps-helper/
 * Description:       Themereps Helper is a companion plugin for Themereps themes. It provides core functionality and extends free and premium theme features. This plugin requires 'Advanced Import' plugin which provides the functionality to import demo data content in just a click.
 * Version:           1.0.4
 * Author:            ThemeReps
 * Author URI:        https://themereps.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       themereps-helper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'th_fs' ) ) {
    // Create a helper function for easy SDK access.
    function th_fs() {
        global $th_fs;

        if ( ! isset( $th_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $th_fs = fs_dynamic_init( array(
                'id'                  => '11210',
                'slug'                => 'themereps-helper',
                'premium_slug'        => 'themereps-helper-premium',
                'type'                => 'plugin',
                'public_key'          => 'pk_a5ac3c7bec8afc6f9cecd1969078b',
                'is_premium'          => true,
                'premium_suffix'      => 'Premium',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'trial'               => array(
                    'days'               => 7,
                    'is_require_payment' => false,
                ),
                'menu'                => array(
                    'slug'           => 'themereps-helper',
                    'first-path'     => 'admin.php?page=themereps-helper&welcome-message=true',
                ),
                'is_live'        => true,
            ) );
        }

        return $th_fs;
    }

    // Init Freemius.
    th_fs();
    // Signal that SDK was initiated.
    do_action( 'th_fs_loaded' );
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'THEMEREPS_HELPER_VERSION', '1.0.0' );
define( 'THEMEREPS_HELPER_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEMEREPS_HELPER_URL', plugin_dir_url( __FILE__ ) );
define( 'THEMEREPS_HELPER_SETUP_SCRIPT_PREFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '' );

/**
 * The code that runs during plugin activation.
 * This action is documented in class/class-themereps-helper-activator.php
 */
function activate_themereps_helper() {
	require_once plugin_dir_path( __FILE__ ) . 'class/class-themereps-helper-activator.php';
	Themereps_Helper_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in class/class-themereps-helper-deactivator.php
 */
function deactivate_themereps_helper() {
	require_once plugin_dir_path( __FILE__ ) . 'class/class-themereps-helper-deactivator.php';
	Themereps_Helper_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_themereps_helper' );
register_deactivation_hook( __FILE__, 'deactivate_themereps_helper' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'class/class-themereps-helper.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_themereps_helper() {

	$plugin = new Themereps_Helper();
	$plugin->run();

}
run_themereps_helper();
