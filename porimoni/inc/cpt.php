<?php
// Register Portfolio
function cptui_register_my_cpts() {

	/**
	 * Post Type: Portfolios.
	 */

	$labels = [
		"name" => esc_html__( "Portfolios", "porimoni" ),
		"singular_name" => esc_html__( "Portfolio", "porimoni" ),
	];

	$args = [
		"label" => esc_html__( "Portfolios", "porimoni" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "portfolio", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-category",
		"supports" => [ "title", "thumbnail" ],
		"taxonomies" => [ "portfolio_category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "portfolio", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

// Register Portfolio Category
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Portfolio Category.
	 */

	$labels = [
		"name" => esc_html__( "Portfolio Category", "porimoni" ),
		"singular_name" => esc_html__( "Portfolio Category", "porimoni" ),
	];


	$args = [
		"label" => esc_html__( "Portfolio Category", "porimoni" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => false,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'portfolio_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "portfolio_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "portfolio_category", [ "portfolio" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );