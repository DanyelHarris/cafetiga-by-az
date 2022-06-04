<?php
/* @package Jombazar */
/*==========================================
  EMAIL MARKETING DATABASE CUSTOM POST TYPE
===========================================*/

/* Activate CPT */
add_action('init', 'bzbr001_marketing_custom_post_type');

/* Register CPT */
function bzbr001_marketing_custom_post_type(){
	
	$singular	= __('Promo List');
	$plural	= __('Promo Lists');
	
	$labels = array (
		'name' 					=> $singular,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('New ').$singular,
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
		'description'				=> __( 'This is Promo lists page.', 'bzbr001-promo' ),
		'public'					=>	false,
		'exclude_from_search'	=> 	true,
		'publicly_queryable'  	=> 	true,
		'show_ui'					=>	true,
		'show_in_nav_menus'   	=> 	true,
		'show_in_menu'			=>	'edit.php?post_type=bzbr001-optin',
		'show_in_admin_bar'		=>	true,
		/* 'menu_position'			=>	28, */
		/* 'menu_icon'				=> get_template_directory_uri().'/img/admin/optin.png', */
		/* 'rewrite'            	=> true, */
		'capability_type'		=>	'post',
		'capabilities' 			=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false 
		'map_meta_cap' 			=> true,
		'hierarchical'			=>	false,
		'supports'				=>	array(''),
		'has_archive'         	=> false,
		/* 'rewrite' 				=> array(
											'with_front' => false,
											'slug'       => 'contact'
											), */
		'query_var'           	=> true,
		'show_in_rest'			=> true,
	);
	
	register_post_type('bzbr001-promo', $args);
}

/* Set Column */
function bzbr001_set_promo_columns($columns){
	$newColumns = array(
		'cb'		=> '<input type="checkbox" />',
		'date'		=> __( 'Date' ),
		'promo'	=> __( 'Promo Code' ),
		'desc'		=> __( 'Description' ),
		'start'	=> __( 'Date start' ),
		'end'		=> __( 'Date end' ),
	);
	return $newColumns;
	
}
add_filter('manage_bzbr001-promo_posts_columns', 'bzbr001_set_promo_columns');

/* Display content in column */
function bzbr001_promo_custom_column($column, $post_id){
	switch($column){
	
		case 'promo' :
			$optinCode = get_post_meta($post_id, 'promo_code', true);
			echo $optinCode;
			break;
			
		case 'desc' :
			$optinDesc = get_post_meta($post_id, 'promo_desc', true);
			echo $optinDesc;
			break;
	
		case 'start' :
			$optinStart = get_post_meta($post_id, 'promo_start', true);
			echo $optinStart;
			break;
			
		case 'end' :
			$optinEnd = get_post_meta($post_id, 'promo_end', true);
			echo $optinEnd;
			break;
			
		
	}
}
add_action('manage_bzbr001-promo_posts_custom_column', 'bzbr001_promo_custom_column', 10, 2);

/* remove mce in textarea */
function promo_wp_editor_settings( $settings, $editor_id ) {
    if ( $editor_id === 'promo_desc' && get_current_screen()->post_type === 'bzbr001-promo' ) {
        $settings['tinymce']   = false;
        $settings['quicktags'] = false;
        $settings['media_buttons'] = false;
    }
    return $settings;
}
add_filter( 'wp_editor_settings', 'promo_wp_editor_settings', 10, 2 );

/* promo Meta Boxes */
function bzbr001_promo_add_meta_box(){
	add_meta_box('promo_form', __('Promo Lits'), 'bzbr001_promo_data_callback', 'bzbr001-promo', 'normal', 'default');
}
add_action('add_meta_boxes', 'bzbr001_promo_add_meta_box');

function bzbr001_promo_data_callback($post){  
	wp_nonce_field (basename(__FILE__), 'bzbr001_promo_nonce');
	$value = get_post_meta($post->ID);	?>
	
	<div>
		<table>
			<tbody>
				<tr>
					<td>
						<label style="font-weight: bold;">Promo Code</label><br>
						<input type="text" id="promo_code" name="promo_code" placeholder="Insert Code" size="40" value="<?php if (!empty ($value['promo_code'])) echo esc_attr($value['promo_code'][0]); ?>" />
					
					</td>
					<td>
						<label style="font-weight: bold;">Promo Duration</label><br>
						<input type="text" class="datepicker" id="promo_start" name="promo_start" placeholder="Promo start" size="40" style="width:100px;" value="<?php if (!empty ($value['promo_start'])) echo esc_attr($value['promo_start'][0]); ?>" />
						
						<input type="text" class="datepicker" id="promo_end" name="promo_end" placeholder="Promo end" size="40" style="width:100px;" value="<?php if (!empty ($value['promo_end'])) echo esc_attr($value['promo_end'][0]); ?>" />
	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<br><br>
	<div>
		<label style="font-weight: bold;">Promo Description</label>
		<?php 
		$content	= get_post_meta($post->ID, 'promo_desc', true);
		$editor	= 'promo_desc';
		$settings	= array(
			'textarea_rows'=> 5,
			'media_buttons'=> false
		);
		wp_editor($content, $editor, $settings);
		?>
	</div>		

<?php }

/* Save Promo Meta Boxes */
function promo_save_data($post_id){
	//check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision ( $post_id );
	$is_valid_nonce = (isset ($_POST ['bzbr001_promo_nonce']) && wp_verify_nonce($_POST['bzbr001_promo_nonce'], basename(__FILE__)))? 'true' : 'false';
	
	//Exits depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	if(isset ($_POST['promo_code'])){
		update_post_meta($post_id, 'promo_code', sanitize_text_field($_POST['promo_code']));
	}
	if(isset ($_POST['promo_desc'])){
		update_post_meta($post_id, 'promo_desc', sanitize_text_field($_POST['promo_desc']));
	}
	if(isset ($_POST['promo_start'])){
		update_post_meta($post_id, 'promo_start', sanitize_text_field($_POST['promo_start']));
	}
	if(isset ($_POST['promo_end'])){
		update_post_meta($post_id, 'promo_end', sanitize_text_field($_POST['promo_end']));
	}
}
add_action('save_post', 'promo_save_data');

/* Filter Search*/
function bzbr001_promo_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('bzbr001-promo' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
		
		$values = array();			
		$args = array(
			'post_type' 		=> 'bzbr001-promo',
			'posts_per_page'	=> -1,
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
			while ($my_query->have_posts()) : $my_query->the_post();
			
				$promo_start = get_post_meta( get_the_ID(), 'promo_start', true);
				$values[$promo_start] = $promo_start;
				
			endwhile;
		}	
		wp_reset_postdata();
	
        ?>
        <select name="promo_title_filter">
        <option value=""><?php _e('View all start dates', 'cafesatu'); ?></option>
        <?php
            $current_v = isset($_GET['promo_title_filter'])? $_GET['promo_title_filter']:'';
            foreach ($values as $label => $value) {
				printf(
					'<option value="%s"%s>%s</option>',
					$value,
					$value == $current_v? ' selected="selected"':'',
					$label
				);
			}
        ?>
        </select>
        <?php
    }
}
add_action( 'restrict_manage_posts', 'bzbr001_promo_posts_filter_restrict_manage_posts' );

function bzbr001_promo_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'bzbr001-promo' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['promo_title_filter']) && $_GET['promo_title_filter'] != '' && $query->is_main_query()) {
		
        $query->query_vars['meta_key'] = 'promo_start';
        $query->query_vars['meta_value'] = $_GET['promo_title_filter'];
		
    }
}
add_filter( 'parse_query', 'bzbr001_promo_filter' );

/* Box Search*/
//hook the posts search if we're on the admin page for our type
function promo_init_post_type() {
    global $typenow;
 
    if ($typenow === 'bzbr001-promo') {
        add_filter('posts_search', 'posts_search_promo_type', 10, 2);
    }
}
add_action('admin_init', 'promo_init_post_type');
 
// add query condition for custom meta
// @param string $search the search string so far
// @param WP_Query $query
// @return string
function posts_search_promo_type($search, $query) {
    global $wpdb;
 
    if ($query->is_main_query() && !empty($query->query['s'])) {
        $sql    = "
            or exists (
                select * from {$wpdb->postmeta} where post_id={$wpdb->posts}.ID
                and meta_key in ('promo_code','promo_desc', 'promo_start', 'promo_end')
                and meta_value like %s
            )
        ";
        $like   = '%' . $wpdb->esc_like($query->query['s']) . '%';
        $search = preg_replace("#\({$wpdb->posts}.post_title LIKE [^)]+\)\K#",
            $wpdb->prepare($sql, $like), $search);
    }
 
    return $search;
}