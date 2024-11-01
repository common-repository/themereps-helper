<?php

/**
 * Themereps Helper post types
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Themereps_Helper
 * @subpackage Themereps_Helper/admin
 */
	if ( th_fs()->can_use_premium_code() ) {

		function themereps_registier_post_type() {

			register_post_type('trh_pricing',
				array(
					'labels'      => array(
						'name'          => __('Pricing Plans', 'themereps-helper'),
						'singular_name' => __('Pricing Plan', 'themereps-helper'),
						'all_items'         => __( 'All Plans', 'themereps-helper' ),
						'edit_item'         => __( 'Edit Plans', 'themereps-helper' ), 
						'update_item'       => __( 'Update Plans', 'themereps-helper' ),
						'add_new_item'      => __( 'Add New Plans', 'themereps-helper'),
						'new_item_name'     => __( 'New Plans', 'themereps-helper' ),
					),
					'public'      => true, 
					'show_in_menu' => 'false',
					'rewrite' => array('slug' => 'trh_pricing' ),
					'has_archive'  => true,
					'supports' => array( 'title', 'editor', 'thumbnail'),
					'show_in_rest'       => true
				)
			);

		}
		add_action( 'init', 'themereps_registier_post_type' );
	}

	$theme = wp_get_theme();
	if ( 'Bizes' == $theme->name || 'Bizes' == $theme->parent_theme ) {

		function themereps_helper_portfolio_init() {

			$labels = array(
				'name'                  => _x( 'Portfolios', 'Portfolio', 'themereps-helper' ),
				'singular_name'         => _x( 'Portfolio', 'Portfolio', 'themereps-helper' ),
				'menu_name'             => _x( 'Portfolios', 'Admin Menu text', 'themereps-helper' ),
				'name_admin_bar'        => _x( 'Portfolios', 'Add New on Toolbar', 'themereps-helper' ),
				'add_new'               => __( 'Add New', 'themereps-helper' ),
				'add_new_item'          => __( 'Add New Portfolio', 'themereps-helper' ),
				'new_item'              => __( 'New Portfolio', 'themereps-helper' ),
				'edit_item'             => __( 'Edit Portfolio', 'themereps-helper' ),
				'view_item'             => __( 'View Portfolio', 'themereps-helper' ),
				'all_items'             => __( 'All Portfolios', 'themereps-helper' ),
				'search_items'          => __( 'Search Portfolios', 'themereps-helper' ),
				'parent_item_colon'     => __( 'Parent Portfolios:', 'themereps-helper' ),
				'not_found'             => __( 'No portfolio found.', 'themereps-helper' ),
			);     
			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'trh_portfolio' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => true,
				'menu_position'      => 20,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
				'show_in_rest'       => true,
				'menu_icon'           => 'dashicons-format-gallery',
			);
			register_post_type( 'trh_portfolio', $args );

		}
		add_action( 'init', 'themereps_helper_portfolio_init' );


		function themereps_helper_portfolio_taxonomy() {
		 
		  $labels = array(
			'name' => _x( 'Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name' ),
			'menu_name' => __( 'Categories' ),
			'search_items' =>  __( 'Search Categories' ),
			'all_items' => __( 'All Categories' ),
			'parent_item' => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item' => __( 'Edit Category' ), 
			'update_item' => __( 'Update Category' ),
			'add_new_item' => __( 'Add New Category' ),
			'new_item_name' => __( 'New Category' ),

		  );    
		  register_taxonomy('trh_portfolio_category',array('trh_portfolio'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'trh_portfolio_category' ),
			'show_in_rest'       => true
		  ));
		} 
		add_action( 'init', 'themereps_helper_portfolio_taxonomy', 30 );

	}
