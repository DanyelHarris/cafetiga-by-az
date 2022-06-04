<?php
/* @package Jombazar */
/*========================
  REVIEWS CUSTOM POST TYPE
========================*/

/* Activate CPT */
$review = get_option ('activate_review');
if(@$review == 1){
	add_action('init', 'bzbr001_review_custom_post_type');
}

/* Register CPT */
function bzbr001_review_custom_post_type(){
	
	$singular	= __('Review');
	$plural	= __('Reviews');
	
	$labels = array (
		'name' 					=> __('Customer ').$plural,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('Add ').$singular,
		'edit_item'				=>	__('Edit ').$singular,
		'new_item'				=> __('New ').$singular,
		'view_item'				=> __('View ').$singular,
		'view_items'				=> __('View ').$plural,
		'search_items'			=> __('Search Customer ').$plural,
		'not_found'				=> __('No ').$plural.__(' found'),
		'not_found_in_trash'		=> __('No ').$plural.__(' found in Trash'),
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
		'name_admin_bar'			=>	$singular,
	);
		
	$args = array(
		'labels'					=> $labels,
		'description'        	=> __( 'This is Reviews page.', 'bzbr001-reviews' ),
		'public'					=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable' 	=> true,
		'show_ui'					=> true,
		'show_in_nav_menus'  	=> true,
		'show_in_menu'			=> true,
		'show_in_admin_bar'		=> true,
		'menu_position'			=>	9,
		'menu_icon'				=> get_template_directory_uri().'/img/admin/reviews.png',
		'rewrite'            	=> true,
		'capability_type'		=> 'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=> true,
		'supports'				=> array('title'),
		'has_archive'        	=> true,
		'rewrite' 				=> array(
										'with_front' => false,
										'slug'       => 'reviews'
									),
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbr001-reviews', $args);
}

/* Set Column */
function bzbr001_set_review_columns($columns){
	$newColumns = array(
		'cb' 		=> '<input type="checkbox" />',
		'date'		=> __( 'Date' ),
		'email'	=> __( 'Email' ),
		'title'	=> __( 'Title' ),
		'message'	=> __( 'Review' ),
		'rating'	=> __( 'Rating' ),
	);
	return $newColumns;
}
add_filter('manage_bzbr001-reviews_posts_columns', 'bzbr001_set_review_columns');

/* Display content in column */
function bzbr001_review_custom_column($column, $post_id){
	switch($column){
	
		case 'email' :
			$email = get_post_meta($post_id, 'email_address_field', true);
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
			
		case 'message' :
			$review = get_post_meta($post_id, 'review_field', true);
			echo $review;
			break;
			
		case 'rating' :
			$rating = get_post_meta($post_id, 'rating_field', true);
			echo $rating.'/5';
			break;
	}
}
add_action('manage_bzbr001-reviews_posts_custom_column', 'bzbr001_review_custom_column', 10, 2);

/* Change title placeholder */
function bzbr001_review_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'bzbr001-reviews' == $screen->post_type ) {
          $title = __('Review Title');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'bzbr001_review_change_title_text' );

/* Remove media button */
function remove_media_buttons_review() {
	global $current_screen;
	if( 'bzbr001-reviews' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');
}
add_action('admin_head','remove_media_buttons_review');

/* Reviews Meta Boxes */
function bzbr001_review_add_custom_metabox(){
	add_meta_box('bzbr001_review', __('<img src="'.get_template_directory_uri().'/img/admin/reviews.png" />&nbsp;Review Details'), 'bzbr001_review_callback', 'bzbr001-reviews', 'normal');
}
add_action('add_meta_boxes','bzbr001_review_add_custom_metabox');

function bzbr001_review_callback($post){  
	wp_nonce_field (basename(__FILE__), 'bzbr001_review_nonce');
	$value = get_post_meta($post->ID);	?>
	
	<div>
	<label style="font-weight: bold;">Reviews</label>
	<?php 
	$content	= get_post_meta($post->ID, 'review_field', true);
	$editor	= 'review_field';
	$settings	= array(
		'textarea_rows'	=> 5,
		'media_buttons'	
	);
	wp_editor($content, $editor, $settings);
	?>
	</div>
	
	<br><br><br>
	
	<div style="float:left; width:100px;"><label style="font-weight: bold;">Review by</label></div>
	
	<div style="float:left;">
		<input type="text" id="review_by_field" name="review_by_field" placeholder="Reviewer Name" size="35" value="<?php if (!empty ($value['review_by_field'])) echo esc_attr($value['review_by_field'][0]); ?>" /> 
	</div>
	
	<br><br>
	
	<div style="float:left; width:100px;"><label style="font-weight: bold;">Email Address</label></div>
	
	<div style="float:left;">
	<input type="text" id="email_address_field" name="email_address_field" placeholder="Email Address" size="35" value="<?php if (! empty ($value['email_address_field'])) echo esc_attr($value['email_address_field'][0]); ?>"  />
	</div>
	
	<br><br>

	<div style="float:left; width:100px;"><label style="font-weight: bold;">Rating</label></div>
	
	<div style="float:left;">
	<select style="width: 100px" id="rating_field" name="rating_field">
	<?php
	// Generate all items of drop-down list
	for ( $rating = 5; $rating >= 1; $rating -- ) {
	?>
		<option value="<?php echo $rating; ?>" <?php echo selected( $rating, $value['rating_field'][0] ); ?>>
		<?php echo $rating; ?> stars <?php } ?>
		</option>
	</select>
	</div>
	
	<br><br><br>
	
	<div>
	<label style="font-weight: bold;">Admin Response to Review</label>
	<?php 
	$content	= get_post_meta($post->ID, 'admin_response_field', true);
	$editor	= 'admin_response_field';
	$settings	= array(
		'textarea_rows'	=> 5,
		'media_buttons'	
	);
	wp_editor($content, $editor, $settings);
	?>
	</div>
	
<?php }

/* Save Reviews Meta Boxes */
function review_save_data($post_id){
	//check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision ( $post_id );
	$is_valid_nonce = (isset ($_POST ['bzbr001_review_nonce']) && wp_verify_nonce($_POST['bzbr001_review_nonce'], basename(__FILE__)))? 'true' : 'false';
	
	//Exits depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	
	if(isset ($_POST['review_field'])){
		update_post_meta($post_id, 'review_field', $_POST['review_field']);
	}
	if(isset ($_POST['review_by_field'])){
		update_post_meta($post_id, 'review_by_field', sanitize_text_field($_POST['review_by_field']));
	}
	if(isset ($_POST['email_address_field'])){
		update_post_meta($post_id, 'email_address_field', sanitize_text_field($_POST['email_address_field']));
	}
	if(isset ($_POST['admin_response_field'])){
		update_post_meta($post_id, 'admin_response_field', $_POST['admin_response_field']);
	}
	if(isset ($_POST['rating_field'])){
		update_post_meta($post_id, 'rating_field', sanitize_text_field($_POST['rating_field']));
	}
}
add_action('save_post', 'review_save_data');