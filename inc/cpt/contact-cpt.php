<?php
/* @package Jombazar */
/*========================
  CONTACT CUSTOM POST TYPE
========================*/

/* Activate CPT */
$contact = get_option ('activate_contact');
if(@$contact == 1){
	add_action('init', 'bzbr001_contact_custom_post_type');
}

/* Register CPT */
function bzbr001_contact_custom_post_type(){
	
	$singular	= __('Contact');
	$plural	= __('Contacts');
	
	$labels = array (
		'name' 					=> $singular,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('New ').$plural,
		'edit_item'				=> __('Edit ').$singular,
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
		'uploaded_to_this_item'	=> __('Uploaded to this ').$singular,
		/* 'featured_image'		=> $singular.__(' Image'), */
		/* 'set_featured_image'	=> __('Set ').$singular.__(' Image'), */
		/* 'remove_featured_image'=> __('Remove ').$singular.__(' Image'), */
		/* 'use_featured_image'	=> __('Use ').$singular.__(' Image'), */
		'menu_name'				=>	$plural,
		'filter_items_list'		=> __('Filter ').$plural.__(' list'),
		'items_list_navigation'	=> $plural.__(' list navigation'),
		'items_list'				=> $plural.__(' list'),
		'name_admin_bar'			=>	$singular,
	);
	
	$args = array(
		'labels'					=>	$labels,
		'description'        	=> __( 'This is Contact page.', 'bzbr001-contact' ),
		'public'					=>	false,
		'exclude_from_search'	=> true,
		'publicly_queryable'  	=> true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> true,
		'show_in_menu'			=>	true,
		'show_in_admin_bar'		=>	true,
		'menu_position'			=>	26,
		'menu_icon'				=> get_template_directory_uri().'/img/admin/message.png',
		/* 'rewrite'            	=> true, */
		'capability_type'		=>	'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=>	false,
		'supports'				=>	array('title', 'editor'),
		'has_archive'         	=> false,
		/* 'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'contact'
											), */
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbr001-contact', $args);
}

/* Set Column */
function bzbr001_set_contact_columns($columns){
	$newColumns = array(
		'cb'		=> '<input type="checkbox" />',
		'date'		=> __( 'Date' ),
		'email'	=> __( 'Email' ),
		'title'	=> __( 'Full Name' ),
		'message'	=> __( 'Message' ),
	);
	return $newColumns;
	
}
add_filter('manage_bzbr001-contact_posts_columns', 'bzbr001_set_contact_columns');

/* Display content in column */
function bzbr001_contact_custom_column($column, $post_id){
	switch($column){
		case 'message' :
			echo get_the_excerpt();
			break;
		
		case 'email' :
			$email = get_post_meta($post_id, '_contact_email_value_key', true);
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
		
	}
}
add_action('manage_bzbr001-contact_posts_custom_column', 'bzbr001_contact_custom_column', 10, 2);

/* Change title placeholder */
function bzbr001_contact_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'bzbr001-contact' == $screen->post_type ) {
          $title = __('Full Name');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'bzbr001_contact_change_title_text' );

/* Contact Meta Boxes */
function bzbr001_contact_add_meta_box(){
	add_meta_box('contact_email', __('User Email'), 'bzbr001_contact_email_callback', 'bzbr001-contact', 'side', 'default');
}
add_action('add_meta_boxes', 'bzbr001_contact_add_meta_box');

function bzbr001_contact_email_callback($post){
	wp_nonce_field('bzbr001_save_contact_email_data', 'bzbr001_contact_email_meta_box_nonce');
	$value = get_post_meta($post->ID, '_contact_email_value_key', true);
	echo __('<label for="bzbr001_contact_email_field">User Email Address</label>');
	echo '<input type="email" id="bzbr001" name="bzbr001_contact_email_field" value="'.esc_attr($value).'" size="25" />';
}

/* Save Contact Meta Boxes */
function bzbr001_save_contact_email_data($post_id){
	if(! isset($_POST['bzbr001_contact_email_meta_box_nonce'])){
		return;
	}
	if(! wp_verify_nonce($_POST['bzbr001_contact_email_meta_box_nonce'], 'bzbr001_save_contact_email_data')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}
	if(! current_user_can('edit_post', $post_id)){
		return;
	}
	if(! isset($_POST['bzbr001_contact_email_field'])){
		return;
	}
	$my_data = sanitize_text_field($_POST['bzbr001_contact_email_field']);
	update_post_meta($post_id, '_contact_email_value_key', $my_data);
}
add_action('save_post', 'bzbr001_save_contact_email_data');
