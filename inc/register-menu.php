<?php
/**
 * Register Menu for Plugin
 * 
 * @package themereps_helper
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'Themereps_Helper_Menu' ) ) :

    class Themereps_Helper_Menu {
		
        public function __construct() {

            add_action( 'admin_menu', array( $this, 'register_main_menus'),	9 );

			if ( th_fs()->can_use_premium_code() ) {

				$theme = wp_get_theme();

				if ( 'Bizes' == $theme->name || 'Bizes' == $theme->parent_theme ):
                    add_action( 'admin_menu', array( $this, 'register_pricing_submenu'), 15 );
				endif;
				
				if ( 'Kunty' == $theme->name || 'Kunty' == $theme->parent_theme ):
                    add_action( 'admin_menu', array( $this, 'register_pricing_submenu'), 15 );
				endif;
				
			}
        }
		
        public function register_main_menus() {
			
            add_menu_page( 'Themereps Helper', 'Themereps Helper', 'manage_options', 'themereps-helper', array( $this, 'themereps_helper_info' ), '','5' );
    
            add_submenu_page('themereps-helper', 'Dashboard', __( 'Dashboard', 'themereps-helper' ), 'manage_options', 'themereps-helper');
    
        }

		public function register_pricing_submenu() {
	
			add_submenu_page(
				'themereps-helper',
				'pricing',
				'Pricing Plans',
				'manage_options',
				'edit.php?post_type=trh_pricing'
			);
	
		}

        public function themereps_helper_info() {
			
			$theme = wp_get_theme();

			if ( 'Bizes' == $theme->name || 'Bizes' == $theme->parent_theme ):
				include_once('dashboard/dashboard-bizes.php');
			endif;
			
			if ( 'Kunty' == $theme->name || 'Kunty' == $theme->parent_theme ):
				include_once('dashboard/dashboard-kunty.php');
			endif;
			
        }

    }
    
    $Themereps_Plugin_Mneu = new Themereps_Helper_Menu;
    
endif;
