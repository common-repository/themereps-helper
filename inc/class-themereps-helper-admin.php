<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://themereps.com/
 * @since      1.0.0
 *
 * @package    Themereps_Helper
 * @subpackage Themereps_Helper/core
 
*/

class Themereps_Helper_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->themereps_helper_admin();
		add_action('admin_enqueue_scripts', array($this, 'enqueue_styles')); //enqueues admin elements
	}

	private function themereps_helper_admin(){
		

		/**
		* Register custom post type for plugins
		*/
		require_once THEMEREPS_HELPER_PATH . 'inc/register-posttype.php';

		/**
		* Register custom metaboxes for plugins
		*/
		require_once THEMEREPS_HELPER_PATH . 'inc/register-metaboxes.php';

		/**
		* Register Megamenu
		*/
		require_once THEMEREPS_HELPER_PATH . 'inc/menu/themereps-megamenu.php';
		
		/**
		 * Register Admin Menu
		 */
		require_once THEMEREPS_HELPER_PATH . 'inc/register-menu.php';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/themereps-helper-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/themereps-helper-admin.js', array( 'jquery' ), $this->version, false );

	}
}
