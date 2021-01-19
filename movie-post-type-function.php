<?php


/**
 *	Register Movie Post Type
 */
//Hooking up our function to theme setup
add_action( 'init', 'Movie_review_post_type' );
//Our custom post type function
function Movie_review_post_type() {

	$labels = array(
		'name'               => _x( 'Movie', 'post type general name', 'engwp' ),
		'singular_name'      => _x( 'Movie', 'post type singular name', 'engwp' ),
		'menu_name'          => _x( 'Movie Review', 'admin menu', 'engwp' ),
		'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'engwp' ),
		'add_new'            => _x( 'Add New', 'Movie', 'engwp' ),
		'add_new_item'       => __( 'Add New Movie', 'engwp' ),
		'new_item'           => __( 'New Movie', 'engwp' ),
		'edit_item'          => __( 'Edit Movie', 'engwp' ),
		'view_item'          => __( 'View Movie', 'engwp' ),
		'all_items'          => __( 'All Movies', 'engwp' ),
		'search_items'       => __( 'Search Movies', 'engwp' ),
		'parent_item_colon'  => __( 'Parent Movie:', 'engwp' ),
		'not_found'          => __( 'No Movies found.', 'engwp' ),
		'not_found_in_trash' => __( 'No Movies found in Trash.', 'engwp' )
	);

//Set other options for movie review post type
	$args = array(
		'description'	     		=> __( 'Movie', 'engwp' ),
		'labels'	      		 	=> $labels,
//Features this movie review post type support in Post editor		
		'supports'	     	 		=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions' ),
		'hierarchical'	    		=> false,
		'public'	      			=> true,
		'publicly_queryable'		=> true,
		'query_var'	      			=> true,
		'rewrite'	      			=> array( 'slug' => 'block-buster' ), /* changed from movies to block-buster */
		'show_ui'	      			=> true,
		'menu_icon'	      			=> 'dashicons-format-video',
		'show_in_menu'	     		=> true,
		'show_in_nav_menus'			=> true,
		'show_in_admin_bar'			=> true,
		// 'menu_position'	=> 5,
		'can_export'				=> true,
		'has_archive'				=> true,
		'exclude_from_search'		=> false,
		'capability_type'			=> 'post',
	);

	register_post_type( 'movie', $args );

}