<?php
/* Course */
function bufnita_post_type_course() {
	$labels = array(
		'name'               => _x( 'Courses', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Course', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Courses', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Course', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'course', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Course', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Course', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Course', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Course', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Courses', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Courses', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Courses:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Courses found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Courses found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'cursuri' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies' 		 => array('post_tag')
	);

	register_post_type( 'course', $args );
	
	$labels_course_categ = array(
		'name'              => _x( 'Course Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Categories' ),
		'all_items'         => __( 'All Course Categories' ),
		'parent_item'       => __( 'Course Category Parent' ),
		'parent_item_colon' => __( 'Course Category Parent:' ),
		'edit_item'         => __( 'Edit Course Category' ),
		'update_item'       => __( 'Update Course Category' ),
		'add_new_item'      => __( 'Add New Course Category' ),
		'new_item_name'     => __( 'New Course Category Name' ),
		'menu_name'         => __( 'Course Category' ),
	);

	$args_course_categ  = array(
		'hierarchical'      => true,
		'labels'            => $labels_course_categ ,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'course-category' ),
	);

	register_taxonomy( 'course_category', array( 'course' ), $args_course_categ );
	
}
add_action('init', 'bufnita_post_type_course');


if ( is_admin()) {  //do nothing for front end requests
    add_action( 'load-post-new.php', 'init_group_cpt_class' );
    add_action( 'load-post.php', 'init_group_cpt_class' );
}

function init_group_cpt_class() {
	new MicCpt();
	new MijlociuCpt();
	new MareCpt();
	new AvailableCategoriesCpt();
	new HomepageCpt();
}