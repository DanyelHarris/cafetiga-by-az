<?php
/* @package Jombazar */
/*===========================
  OPERATION CUSTOM POST TYPE
============================*/

/* Register CPT */
function bzbr001_operation_custom_post_type(){
	
	$singular	= __('Operation hour');
	$plural	= __('Operation hours');
	
	$labels = array (
		'name' 					=> $plural,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('Add ').$singular.__(' information'),
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
		'description'        	=> __( 'This is Operation page.', 'bzbr001-operation' ),
		'public'					=>	false,
		'exclude_from_search'	=> true,
		'publicly_queryable'  	=> true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> false,
		'show_in_menu'			=>	true,
		'show_in_admin_bar'		=>	true,
		'menu_position'			=>	5,
		'menu_icon'				=> get_template_directory_uri().'/img/admin/hours.png',
		'rewrite'					=> true,
		'capability_type'		=> 'page',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'			=>	false,
		'supports'				=>	array(''),
		'has_archive'         	=> false,
		'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'operation'
										),
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbr001-operation', $args);
}
add_action('init', 'bzbr001_operation_custom_post_type');

/* Set Column */
function bzbr001_set_operation_columns($columns){
	$newColumns = array(
		'operation'	=> __( 'Operation' ),
		'from'			=> __( 'From'),
		'to'			=> __( 'To'),
		'open'			=> __( 'Open'),
		'close'		=> __( 'Close'),
	);
	return $newColumns;
}
add_filter('manage_bzbr001-operation_posts_columns', 'bzbr001_set_operation_columns');

/* Display content in column */
function bzbr001_operation_custom_column($column, $post_id){
	switch($column){
		case 'operation' :
			$operation = get_post_meta($post_id, 'operation_field', true);
			echo $operation;
			break;
	
		case 'from' :
			$from = get_post_meta($post_id, 'operation_from_field', true);
			echo $from;
			break;
			
		case 'to' :
			$to = get_post_meta($post_id, 'operation_to_field', true);
			echo $to;
			break;
		
		case 'open' :
			$from = get_post_meta($post_id, 'operation_open_field', true);
			echo $from;
			break;
			
		case 'close' :
			$to = get_post_meta($post_id, 'operation_close_field', true);
			echo $to;
			break;
	}
}
add_action('manage_bzbr001-operation_posts_custom_column', 'bzbr001_operation_custom_column', 10, 2);

/* Operation hours Meta Boxes */
function bzbr001_operation_add_custom_metabox(){
	add_meta_box('bzbr001_operation', __('Your bzbr001 operation days and hours'), 'bzbr001_operation_callback', 'bzbr001-operation', 'normal');
}
add_action('add_meta_boxes','bzbr001_operation_add_custom_metabox');

function bzbr001_operation_callback($post){
	wp_nonce_field (basename(__FILE__), 'bzbr001_operation_nonce');
	$value = get_post_meta($post->ID);	?>
	
<div style="display: table-row;">
	<div style="display: table-cell;	padding: 3px 10px;">
		<input type="radio" name="operation_field" id="operation_field" value="Open" <?php if(get_post_meta($post->ID,'operation_field', true ) == "Open" ){echo ' checked="checked"';} ?>>Open
		
		<input type="radio" name="operation_field" id="operation_field" value="Close" <?php if(get_post_meta($post->ID,'operation_field', true ) == "Close" ){echo ' checked="checked"';} ?>>Close
	</div>
	<div style="divTableCell">&nbsp;</div>
	</div>
	<div style="display: table-row;">
	<div style="display: table-cell;	padding: 3px 10px;">
		<label><h2>Day</h2></label>
		<input type="text" id="operation_from_field" name="operation_from_field" placeholder="Day" size="10" value="<?php if (! empty ($value['operation_from_field'])) echo esc_attr($value['operation_from_field'][0]); ?>" /> to 
		
		<input type="text" id="operation_to_field" name="operation_to_field" placeholder="Day" size="10" value="<?php if (! empty ($value['operation_to_field'])) echo esc_attr($value['operation_to_field'][0]); ?>"  />
	</div>
	<div style="display: table-cell;	padding: 3px 10px;">
		<label><h2>Time</h2></label>
		<input type="text" id="operation_open_field" name="operation_open_field" placeholder="ie. 8.00am" size="10" value="<?php if (! empty ($value['operation_open_field'])) echo esc_attr($value['operation_open_field'][0]); ?>" /> to 
		
		<input type="text" id="operation_close_field" name="operation_close_field" placeholder="ie. 11.00pm" size="10" value="<?php if (! empty ($value['operation_close_field'])) echo esc_attr($value['operation_close_field'][0]); ?>"  />
	</div>
</div>

<?php }

/* Save Operation hours Meta Boxes */
function operation_save_data($post_id){
	//check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision ( $post_id );
	$is_valid_nonce = (isset ($_POST ['bzbr001_operation_nonce']) && wp_verify_nonce($_POST['bzbr001_operation_nonce'], basename(__FILE__)))? 'true' : 'false';
	
	//Exits depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	if(isset ($_POST['operation_field'])){
		update_post_meta($post_id, 'operation_field', sanitize_text_field($_POST['operation_field']));
	}
	if(isset ($_POST['operation_from_field'])){
		update_post_meta($post_id, 'operation_from_field', sanitize_text_field($_POST['operation_from_field']));
	}
	if(isset ($_POST['operation_to_field'])){
		update_post_meta($post_id, 'operation_to_field', sanitize_text_field($_POST['operation_to_field']));
	}
	if(isset ($_POST['operation_open_field'])){
		update_post_meta($post_id, 'operation_open_field', sanitize_text_field($_POST['operation_open_field']));
	}
	if(isset ($_POST['operation_close_field'])){
		update_post_meta($post_id, 'operation_close_field', sanitize_text_field($_POST['operation_close_field']));
	}
}
add_action('save_post', 'operation_save_data');