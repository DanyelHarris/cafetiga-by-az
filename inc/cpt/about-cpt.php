<?php
/* @package Jombazar */
/*========================
  ABOUT CUSTOM POST TYPE
========================*/

/* Register CPT */
function bzbR001_about_register_post_type(){
	
	$singular	= __('About');
	$plural	= __('About');
	
	$labels = array (
		'name' 					=> $plural,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add Information'),
		'add_new_item'			=>	__('Add ').$singular.__(' text'),
		'edit_item'				=>	__('Edit ').$singular.__(' text'),
		'new_item'				=> __('New ').$singular.__(' text'),
		'view_item'				=> __('View ').$singular,
		'view_items'				=> __('View ').$plural,
		'search_items'			=> __('Search ').$plural.__(' text'),
		'not_found'				=> __('No ').$singular.__(' text found'),
		'not_found_in_trash'		=> __('No ').$singular.__(' text found in Trash'),
		/* 'parent_item_colon'	=> '', */
		'all_items'				=> $plural.__(' list'),
		'archives'				=> $singular.__(' text archives'),
		'attributes'				=> $singular.__(' text attributes'),
		'insert_into_item'		=> __('Insert into ').$plural.__(' text'),
		'uploaded_to_this_item'=> __('Uploaded to this ').$singular.__(' text'),
		/* 'featured_image'		=> $singular.__(' Image'), */
		/* 'set_featured_image'	=> __('Set ').$singular.__(' Image'), */
		/* 'remove_featured_image'=> __('Remove ').$singular.__(' Image'), */
		/* 'use_featured_image'	=> __('Use ').$singular.__(' Image'), */
		'menu_name'				=>	$plural,
		'filter_items_list'		=> __('Filter ').$plural.__(' text list'),
		'items_list_navigation'	=> $plural.__(' text list navigation'),
		'items_list'				=> $plural.__(' text list'),
		'name_admin_bar'			=>	$singular,	
	);
		
	$args = array(
		'labels'					=>	$labels,
		'description'        	=> __( 'This is About page.', 'bzbR001-about' ),
		'public'					=>	true,
		'exclude_from_search'	=> false,
		'publicly_queryable'  	=> true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> true,
		'show_in_menu'			=>	true,
		'show_in_admin_bar'		=>	false,
		'menu_position'			=>	3,
		'menu_icon'				=> get_template_directory_uri().'/img/admin/about.png',
		'rewrite'            	=> true,
		'capability_type'		=> 'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=>	true,
		'supports'				=>	array('title', 'editor', 'thumbnail'),
		'has_archive'         	=> true,
		'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'about'
										),
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbR001-about', $args);
	
}
add_action('init', 'bzbR001_about_register_post_type');

/* Thumbnail size */
function about_setup_theme() {
    add_image_size( 'bzbR001-about-pic', 100, 100, false );
}
add_action( 'after_setup_theme', 'about_setup_theme' );

/* Set Column */
function bzbR001_set_about_columns($columns){
	$newColumns = array(
		'cb'				=> '<input type="checkbox" />',
		'title'			=> __( 'Title' ),
		'message'			=> __( 'Description' ),
		'about_image'		=>	__('Image')
	);
	return $newColumns;
}
add_filter('manage_bzbR001-about_posts_columns', 'bzbR001_set_about_columns');

function bzbR001_about_custom_column($column, $post_id){
	switch($column){
		case 'title' :
			echo get_the_title();
			break;
		
		case 'message' :
			echo get_the_excerpt();
			break;
		
		case 'about_image':
        echo '<a href="' . get_edit_post_link() . '">';
        echo the_post_thumbnail( 'bzbR001-about-pic' );
        echo '</a>';
        break;
	}
}
add_action('manage_bzbR001-about_posts_custom_column', 'bzbR001_about_custom_column', 10, 2);

/* Remove media button */
function remove_media_buttons_about() {
	global $current_screen;
	if( 'bzbR001-about' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');
}
add_action('admin_head','remove_media_buttons_about');