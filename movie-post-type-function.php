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

//setting up taxomonies releasing year
add_action( 'init', 'create_year_movie_taxonomies' );
function create_year_movie_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'                       => _x( 'Year Screened', 'taxonomy general name' ),
		'singular_name'              => _x( 'Year', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Years' ),
		'all_items'                  => __( 'All Years' ),
		'parent_item'                => __( 'Parent Year' ),
		'parent_item_colon'          => __( 'Parent Year:' ),
		'edit_item'                  => __( 'Edit Year' ),
		'update_item'                => __( 'Update Year' ),
		'add_new_item'               => __( 'Add New Year' ),
		'new_item_name'              => __( 'New Year Name' ),
		'separate_items_with_commas' => __( 'Separate Years with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Years' ),
		'choose_from_most_used'      => __( 'Choose from the most used Years' ),
		'not_found'                  => __( 'No Years found.' ),
		'menu_name'                  => __( 'Year Screened' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'public'				=> true,
		'publicly_queryable'	=> true,
		'has_archive'			=> true,
	);

	$years = array( 'rewrite' => array( 'slug' => 'movie-year' ) );
	$movie_args = array_merge( $args, $years );
	register_taxonomy( 'movie-years', 'movie', $movie_args );

}

//Display the content at the bottom of the post
add_filter( 'the_content', 'prepend_movie_data' );
function prepend_movie_data ( $content ) {
	
	if ( is_singular ('movie') ) {

		$director = get_post_meta( get_the_ID(), 'director', true);
		$score = get_post_meta( get_the_ID(), 'score', true);
		$publish_date = get_post_meta( get_the_ID(), 'publish date', true);

		$html = '
			<div class="book-meta">
				<strong>Director: </strong> '.$director.'<br>
				<strong>Score: </strong> '.$score.'<br>
				<strong>Publish Date: </strong> '.$publish_date.'<br>
			</div>	 

		';
			
		return $content . $html;
	}
		
	return $content;
}