<?php
/* @package Jombazar */
/*========================
  MENU CUSTOM POST TYPE
========================*/

/* Register CPT */
function bzbR001_slide_custom_post_type(){
	
	$singular	= __('Slide');
	$plural	= __('Slides');
	
	$labels = array (
		'name' 					=> $plural,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('Add New ').$singular,
		'edit_item'				=>	__('Edit ').$singular,
		'new_item'				=> __('New ').$singular,
		'view_item'				=> __('View ').$singular,
		'view_items'				=> __('View ').$plural,
		'search_items'			=> __('Search ').$plural,
		'not_found'				=> __('No ').$singular.__(' found'),
		'not_found_in_trash'	=> __('No ').$singular.__(' found in Trash'),
		/* 'parent_item_colon'	=> '', */
		'all_items'				=> __('All ').$plural,
		'archives'				=> $singular.__(' Archives'),
		'attributes'				=> $singular.__(' Attributes'),
		'insert_into_item'		=> __('Insert into ').$plural,
		'uploaded_to_this_item'	=> __('Uploaded to this ').$singular,
		'featured_image'			=> $singular.__(' Picture'),
		'set_featured_image'		=> __('Set ').$singular.__(' Picture'),
		'remove_featured_image'	=> __('Remove ').$singular.__(' Picture'),
		'use_featured_image'		=> __('Use ').$singular.__(' Picture'),
		'menu_name'				=>	$plural,
		'filter_items_list'		=> __('Filter ').$plural.__(' list'),
		'items_list_navigation'	=> $plural.__(' list navigation'),
		'items_list'				=> $plural.__(' list'),
		'name_admin_bar'			=>	$singular,
	);
		
	$args = array(
		'labels'					=>	$labels,
		'description'        	=> __( 'This is Slides page.', 'bzbR001-slide' ),
		'public'					=>	false,
		'exclude_from_search'	=> true,
		'publicly_queryable'  	=> true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> false,
		'show_in_menu'			=>	'edit.php?post_type=bzbr001-about',
		'show_in_admin_bar'	=>	false,
		/* 'menu_position'			=>	3, */
		/* 'menu_icon'				=> get_template_directory_uri().'/img/admin/about.png', */
		'rewrite'            	=> true,
		'capability_type'		=> 'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=>	true,
		'supports'				=>	array('title', 'thumbnail'),
		'has_archive'         	=> false,
		'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'slides'
											),
		'query_var'           	=> true,
		'show_in_rest'			=> true,		
	);
	
	register_post_type('bzbR001-slide', $args);
}
add_action('init', 'bzbR001_slide_custom_post_type');

/* Thumbnail size */
function slide_setup_theme() {
    add_image_size( 'bzbR001-slide-pic', 270, 125, false );
}
add_action( 'after_setup_theme', 'slide_setup_theme' );


/* Set Column */
function bzbR001_set_slide_columns($columns){
	$newColumns = array(
		'cb'				=> '<input type="checkbox" />',
		'title'			=> __( 'Slide Title' ),
		'sentence'		=> __('Slide Sentence'),
		'slide_image'		=>	__('Slide Image')
	);
	return $newColumns;
}
add_filter('manage_bzbR001-slide_posts_columns', 'bzbR001_set_slide_columns');

/* Display content in column */
function bzbR001_slide_custom_column($column, $post_id){
	switch($column){
		case 'title' :
			echo get_the_title();
			break;
		
		case 'sentence' :
			$sentence = get_post_meta($post_id, 'slide_sentence', true);
			echo $sentence;
			break;
		
		case 'slide_image':
        echo '<a href="' . get_edit_post_link() . '">';
        echo the_post_thumbnail( 'bzbR001-slide-pic' );
        echo '</a>';
        break;
	}
}
add_action('manage_bzbR001-slide_posts_custom_column', 'bzbR001_slide_custom_column', 10, 2);

/* Change title placeholder */
function slide_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'bzbR001-slide' == $screen->post_type ) {
          $title = __('Slide title');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'slide_change_title_text' );

/* Slide Meta Boxes */
function bzbR001_slide_add_meta_box(){
	add_meta_box('slide_sentence', 'Content', 'bzbR001_slide_callback', 'bzbR001-slide', 'normal', 'high');
}

function bzbR001_slide_callback($post){
	wp_nonce_field('slide_save_slide_sentence_data', 'slide_slide_sentence_meta_box_nonce');
	$sentence = get_post_meta($post->ID, 'slide_sentence', true);
	echo '<input type="text" id="slide_sentence" name="slide_sentence" value="'.esc_attr($sentence).'" size="100" placeholder="Brief Content" />';
}
add_action('add_meta_boxes', 'bzbR001_slide_add_meta_box');
	
/* Save Slide Meta Boxes */
function slide_save_slide_sentence_data($post_id){
	if(! isset($_POST['slide_slide_sentence_meta_box_nonce'])){
		return;
	}
	if(! wp_verify_nonce($_POST['slide_slide_sentence_meta_box_nonce'], 'slide_save_slide_sentence_data')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}
	if(! current_user_can('edit_post', $post_id)){
		return;
	}
	if(! isset($_POST['slide_sentence'])){
		return;
	}
	$my_data = sanitize_text_field($_POST['slide_sentence']);
	update_post_meta($post_id, 'slide_sentence', $my_data);
}
add_action('save_post', 'slide_save_slide_sentence_data');