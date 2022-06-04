<?php
/* @package Jombazar */
/*========================
  FAQ CUSTOM POST TYPE
========================*/

/* Register CPT */
function bzbr001_faq_register_post_type(){
	
	$singular	= __('FAQ');
	$plural	= __('FAQs');
	
	$labels = array (
		'name' 					=> $singular,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('Add ').$singular,
		'edit_item'				=>	__('Edit ').$singular,
		'new_item'				=> __('New ').$singular,
		'view_item'				=> __('View ').$singular,
		'view_items'				=> __('View ').$plural,
		'search_items'			=> __('Search ').$plural,
		'not_found'				=> __('No ').$singular.__(' found'),
		'not_found_in_trash'		=> __('No ').$singular.__(' found in Trash'),
		/* 'parent_item_colon'	=> '', */
		'all_items'				=> __('All ').$plural,
		'archives'				=> $singular.__(' Archives'),
		'attributes'				=> $singular.__(' Attributes'),
		'insert_into_item'		=> __('Insert into ').$plural,
		'uploaded_to_this_item'=> __('Uploaded to this ').$singular,
		/* 'featured_image'		=> $singular.__(' Image'), */
		/* 'set_featured_image'	=> __('Set ').$singular.__(' Image'), */
		/* 'remove_featured_image'=> __('Remove ').$singular.__(' Image'), */
		/* 'use_featured_image'	=> __('Use ').$singular.__(' Image'), */
		'menu_name'				=>	$plural,
		'filter_items_list'		=> __('Filter ').$plural.__(' list'),
		'items_list_navigation'=> $plural.__(' list navigation'),
		'items_list'				=> $plural.__(' list'),
		'name_admin_bar'			=>	$singular,		
	);
		
	$args = array(
		'labels'					=>	$labels,
		'description'        	=> __( 'This is FAQ page.', 'bzbr001-faq' ),
		'public'					=>	false,
		'exclude_from_search'	=> false,
		'publicly_queryable'  	=> true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> true,
		'show_in_menu'			=>	true,
		'show_in_admin_bar'		=>	true,
		'menu_position'			=>	14,
		'menu_icon'				=> get_template_directory_uri().'/img/admin/faq.png',
		'rewrite'            	=> true,
		'capability_type'		=> 'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=>	true,
		'supports'				=>	array('title', 'editor'),
		'has_archive'         	=> true,
		'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'faq'
											),
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbr001-faq', $args);
	
	}
add_action('init', 'bzbr001_faq_register_post_type');

/* Set Column */
function bzbr001_set_faq_columns($columns){
	$newColumns = array(
		'title'	=> __( 'Question' ),
		'message'	=> __( 'Answer' ),
	);
	return $newColumns;
}
add_filter('manage_bzbr001-faq_posts_columns', 'bzbr001_set_faq_columns');

/* Display content in column */
function bzbr001_faq_custom_column($column, $post_id){
	switch($column){
		case 'title' :
			echo get_the_title();
			break;
		
		case 'message' :
			echo get_the_excerpt();
			break;
	}
}
add_action('manage_bzbr001-faq_posts_custom_column', 'bzbr001_faq_custom_column', 10, 2);

/* Change title placeholder */
function bzbr001_faq_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'bzbr001-faq' == $screen->post_type ) {
          $title = __('Questions');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'bzbr001_faq_change_title_text' );

/* Remove media button */
function remove_media_buttons_faq() {
	global $current_screen;
	if( 'bzbr001-faq' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');
}
add_action('admin_head','remove_media_buttons_faq');