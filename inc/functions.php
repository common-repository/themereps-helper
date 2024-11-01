<?php
function themereps_helper_get_theme_name(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function themereps_helper_plugin_check_activated(){
    $pluginList = get_option( 'active_plugins' );
    $themereps_helper_plugin = 'advanced-import/advanced-import.php'; 
    $checkPlugin = in_array( $themereps_helper_plugin , $pluginList );
    return $checkPlugin;
}

function themereps_helper_plugin_file_exists(){
    $themereps_helper_plugin = 'advanced-import/advanced-import.php'; 
    $pathpluginurl = WP_PLUGIN_DIR .'/'. $themereps_helper_plugin;
    $isinstalled = file_exists( $pathpluginurl );
    return $isinstalled;
}

function themereps_helper_get_theme_screenshot(){
    $current_theme = wp_get_theme();
    return $current_theme->get_screenshot();
}

function themereps_helper_get_current_theme_slug(){
    $current_theme = wp_get_theme();
    return $current_theme->stylesheet;
}

function themereps_helper_get_templates_lists( $theme_slug ){

    switch ( $theme_slug ):

        case "bizes":
			$demo_templates_lists = array(
				'bizes' =>array(
					'title' => esc_html__( 'Bizes Free', 'themereps-helper' ),/*Title*/
					'is_pro' => false,  /*Premium*/
					'type' => 'free',
					'author' => esc_html__( 'Themereps', 'themereps-helper' ),    /*Author Name*/
					'keywords' => array( 'bizes' , 'themereps-helper'),  /*Search keyword*/
					'categories' => array( 'free' ), /*Categories*/
					'template_url' => array(
						'content' => 'https://themereps.com/files/bizes/free/content.json',
						'options' => 'https://themereps.com/files/bizes/free/options.json',
						'widgets' => 'https://themereps.com/files/bizes/free/widgets.json'
					),
					'screenshot_url' => 'https://themereps.com/files/bizes/free/screenshot.png',
					'demo_url' => 'https://bizes.themereps.com/',
					'plugins' => ''
				),
				'bizes-agency' =>array(
					'title' => esc_html__( 'Bizes Agency', 'themereps-helper' ),/*Title*/
					'is_pro' => true,  /*Premium*/
					'type' => 'pro',
					'author' => esc_html__( 'Themereps', 'themereps-helper' ),    /*Author Name*/
					'keywords' => array( 'bizes' , 'themereps-helper'),  /*Search keyword*/
					'categories' => array( 'pro' ), /*Categories*/
					'template_url' => array(
						'content' => 'https://themereps.com/files/bizes/agency/content.json',
						'options' => 'https://themereps.com/files/bizes/agency/options.json',
						'widgets' => 'https://themereps.com/files/bizes/agency/widgets.json'
					),
					'screenshot_url' => 'https://themereps.com/files/bizes/agency/screenshot.png',
					'demo_url' => 'https://bizes.themereps.com/agency',
					'plugins' => ''
				),
				'bizes-marketing' =>array(
					'title' => esc_html__( 'Bizes Marketing', 'themereps-helper' ),/*Title*/
					'is_pro' => true,  /*Premium*/
					'type' => 'pro',
					'author' => esc_html__( 'Themereps', 'themereps-helper' ),    /*Author Name*/
					'keywords' => array( 'bizes' , 'themereps-helper'),  /*Search keyword*/
					'categories' => array( 'pro' ), /*Categories*/
					'template_url' => array(
						'content' => 'https://themereps.com/files/bizes/marketing/content.json',
						'options' => 'https://themereps.com/files/bizes/marketing/options.json',
						'widgets' => 'https://themereps.com/files/bizes/marketing/widgets.json'
					),
					'screenshot_url' => 'https://themereps.com/files/bizes/marketing/screenshot.png',
					'demo_url' => 'https://bizes.themereps.com/marketing',
					'plugins' => ''
				),
			);
		break;

        case "kunty":
			$demo_templates_lists = array(
				'kunty' =>array(
					'title' => esc_html__( 'Kunty', 'themereps-helper' ),/*Title*/
					'is_pro' => false,  /*Premium*/
					'type' => 'free',
					'author' => esc_html__( 'Themereps', 'themereps-helper' ),    /*Author Name*/
					'keywords' => array( 'kunty' , 'themereps-helper'),  /*Search keyword*/
					'categories' => array( 'free' ), /*Categories*/
					'template_url' => array(
						'content' => 'https://themereps.com/files/kunty/content.json',
						'options' => 'https://themereps.com/files/kunty/options.json',
						'widgets' => 'https://themereps.com/files/kunty/widgets.json'
					),
					'screenshot_url' => 'https://themereps.com/files/kunty/screenshot.png',
					'demo_url' => 'https://kunty.themereps.com/',
					'plugins' => ''
				),
			);
		break;


        default:
            $demo_templates_lists = array();

    endswitch;

    return $demo_templates_lists;

}

if ( th_fs()->can_use_premium_code() ) {
    add_action( 'advanced_import_is_pro_active','themereps_helper_set_premium_active' );
    function themereps_helper_set_premium_active( $is_pro_active ) {
        return true;
    }
}


