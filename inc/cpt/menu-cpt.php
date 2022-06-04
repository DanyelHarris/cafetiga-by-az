<?php
/* @package Jombazar */
/*========================
  MENU CUSTOM POST TYPE
========================*/

/* Register CPT */
function bzbr001_menu_custom_post_type(){
	
	$singular	= __('Menu');
	$plural	= __('Menu Items');
	
	$labels = array (
		'name' 					=> $singular,
		'singular_name'			=> $singular,
		'add_new'					=>	__('Add ').$singular,
		'add_new_item'			=>	__('Add New ').$singular,
		'edit_item'				=>	__('Edit ').$singular,
		'new_item'				=> __('New ').$singular,
		'view_item'				=> __('View ').$singular,
		'view_items'				=> __('View ').$plural,
		'search_items'			=> __('Search ').$plural,
		'not_found'				=> __('No ').$singular.__(' found'),
		'not_found_in_trash'		=> __('No ').$singular.__(' found in Trash'),
		/* 'parent_item'	=> '', */
		/* 'parent_item_colon'	=> '', */
		'all_items'				=> __('All ').$plural,
		'archives'				=> $singular.__(' Archives'),
		'attributes'				=> $singular.__(' Attributes'),
		'insert_into_item'		=> __('Insert into ').$plural,
		'uploaded_to_this_item'	=> __('Uploaded to this ').$singular,
		'featured_image'			=> $singular.__(' Picture'),
		'set_featured_image'		=> __('Set ').$singular.__(' Picture'),
		'remove_featured_image'	=> __('Remove ').$singular.__(' Picture'),
		'menu_name'				=>	$plural,
		'use_featured_image'		=> __('Use ').$singular.__(' Picture'),
		'filter_items_list'		=> __('Filter ').$plural.__(' list'),
		'items_list_navigation'	=> $plural.__(' list navigation'),
		'items_list'				=> $plural.__(' list'),
		'name_admin_bar'			=>	$singular,
	);
		
	$args = array(
		'labels'				=>	$labels,
		'description'			=> __( 'This is Menu page.', 'bzbr001-menu' ),
		'public'				=>	true,
		'exclude_from_search'=> false,
		'publicly_queryable'	=> true,						 
		'show_ui'				=>	true,
		'show_in_nav_menus' 	=> true,
		'show_in_menu'		=>	true,
		'show_in_admin_bar'	=>	true,
		'menu_position'		=>	8,
		'menu_icon'			=> get_template_directory_uri().'/img/admin/menu.png',
		'capability_type'	=>	'post',
		/* 'capabilities' 		=> array('create_posts' => 'do_not_allow',), // Prior to Wordpress 4.5, this was false */
		/* 'map_meta_cap' 		=> true,  */
		'hierarchical'		=>	true,
		'supports'			=>	array('title', 'editor', 'thumbnail'),
		'has_archive'			=> 'menu',
		'rewrite' 			=> array('with_front' => false, 'slug' => 'menu/%menu-cuisine%'),
		'query_var'        	=> true,
		'show_in_rest'		=> true,
		/* 'taxonomies'			=> array(category) */
	);
	register_post_type('bzbr001-menu', $args);
}
add_action('init', 'bzbr001_menu_custom_post_type');

/* Rearrange Permalink according to taxonomy */
function cuisine_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'bzbr001-menu' ){
        $terms = wp_get_object_terms( $post->ID, 'menu-cuisine' );
        if( $terms ){
            return str_replace( '%menu-cuisine%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'cuisine_show_permalinks', 1, 2 );

/* Thumbnail size */
function menu_setup_theme() {
    add_image_size( 'menu-item-pic', 80, 80, false );
}
add_action( 'after_setup_theme', 'menu_setup_theme' );

/* Set Column */
function bzbr001_set_menu_columns($columns){
	$newColumns = array(
		'cb'			=> '<input type="checkbox" />',
		'title'		=> __( 'Item Name' ),
		'price'		=> __( 'Price' ),
		'cuisine'		=> __( 'Cuisine'),
		'course'		=> __( 'Course'),
		'meal'			=> __( 'Meal Time'),
		'featured'	=> __( 'Word from Chef' ),
		'promo'		=> __( 'Tag Promo' ),
		'item_pic'	=>	__( 'Item Image')
	);
	return $newColumns;
}
add_filter('manage_bzbr001-menu_posts_columns', 'bzbr001_set_menu_columns');

/* Display content in column */
function bzbr001_menu_custom_column($column, $post_id){
	global $post;
	switch($column){

		case 'title' :
			echo get_the_title();
			break;
		
		case 'price' :
			$price = get_post_meta($post_id, 'item_price', true);
			echo $price;
			break;
		
		case 'cuisine' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'menu-cuisine' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'menu-cuisine' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'menu-cuisine', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'Not Categorized' );
			}

			break;
		
		case 'course' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'menu-course' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'menu-course' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'menu-course', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'Not Categorized' );
			}

			break;
			
			case 'meal' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'menu-meal' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'menu-meal' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'menu-meal', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'Not Categorized' );
			}

			break;
			
		case 'promo' :
			$promo = get_post_meta($post_id, 'item_promo', true);
			echo $promo;
			break;
			
		case 'featured' :
			$featured = get_post_meta($post_id, 'item_featured', true);
			$display = get_post_meta($post_id, 'item_show', true);
			echo $featured.'<br>'.$display;
			break;
		
		case 'item_pic':
        echo '<a href="' . get_edit_post_link() . '">';
        echo the_post_thumbnail( 'menu-item-pic' );
        echo '</a>';
        break;
		
		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_action('manage_bzbr001-menu_posts_custom_column', 'bzbr001_menu_custom_column', 10, 2);

/* Change title placeholder */
function menu_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'bzbr001-menu' == $screen->post_type ) {
          $title = __('Item name');
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'menu_change_title_text' );

/* Remove media button */
function remove_media_buttons_menu() {
	global $current_screen;
	if( 'bzbr001-menu' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');
}
add_action('admin_head','remove_media_buttons_menu');

/* Menu Meta Boxes */
function bzbr001_menu_add_custom_metabox(){
	add_meta_box('bzbr001_menu', __('Menu details'), 'bzbr001_menu_callback', 'bzbr001-menu', 'normal');
}
add_action('add_meta_boxes','bzbr001_menu_add_custom_metabox');

function bzbr001_menu_callback($post){
	wp_nonce_field (basename(__FILE__), 'bzbr001_menu_nonce');
	$value = get_post_meta($post->ID);	?>

<div style="display: table-row;">

	<div style="display: table-cell; padding: 3px 10px;">
	<label>Price</label><br>
	<input type="text" id="item_price" name="item_price" placeholder="ie. RM10" size="30" value="<?php if (! empty ($value['item_price'])) echo esc_attr($value['item_price'][0]); ?>" />
	</div>
	
	<div style="display: table-cell; padding: 3px 10px;">
	<label>Promo Tag</label><br>
	<input type="text" id="item_promo" name="item_promo" placeholder="ie. New" size="30" value="<?php if (! empty ($value['item_promo'])) echo esc_attr($value['item_promo'][0]); ?>" />
	</div>
	
	<div style="display: table-cell; padding: 3px 10px;">
	<br>
	<input type="checkbox" name="item_featured" id="item_featured" value="Recommended" <?php if ( isset ( $value['item_featured'] ) ) checked( $value['item_featured'][0], 'Recommended' ); ?> /> Recommended by Chef
	 &nbsp; &nbsp;<input type="checkbox" name="item_show" id="item_show" value="Display in front" <?php if ( isset ( $value['item_show'] ) ) checked( $value['item_show'][0], 'Display in front' ); ?> /> Display in front page
	</div>
	
</div>

<?php }

/* Save Meta Boxes */
function menu_save_data($post_id){
	//check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision ( $post_id );
	$is_valid_nonce = (isset ($_POST ['bzbr001_menu_nonce']) && wp_verify_nonce($_POST['bzbr001_menu_nonce'], basename(__FILE__)))? 'true' : 'false';
	
	//Exits depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	if(isset ($_POST['item_price'])){
		update_post_meta($post_id, 'item_price', sanitize_text_field($_POST['item_price']));
	}
	if(isset ($_POST['item_promo'])){
		update_post_meta($post_id, 'item_promo', sanitize_text_field($_POST['item_promo']));
	}
	if( isset( $_POST[ 'item_featured' ] ) ) {
	update_post_meta( $post_id, 'item_featured', 'Recommended' );
	} else {
		update_post_meta( $post_id, 'item_featured', '' );
	}
	if( isset( $_POST[ 'item_show' ] ) ) {
	update_post_meta( $post_id, 'item_show', 'Display in front' );
	} else {
		update_post_meta( $post_id, 'item_show', '' );
	}
}
add_action('save_post', 'menu_save_data');


/*  REGISTER TAXONOMY
========================*/

/* Register Menu-Cuisine Taxonomy */
function cuisine_menu_custom_taxonomies(){
	
	$singular	= __('Menu Cuisine');
	$plural	= __('Menu Cuisine');
	
	$labels = array (
		'name' 							=> $plural,
		'singular_name'					=> $singular,
		'menu_name'						=>	$plural,
		'all_items'						=> __('All ').$plural,
		'edit_item'						=>	__('Edit ').$singular,
		'view_item'						=> __('View ').$singular,
		'update_item'						=> __('Update ').$singular,
		'add_new'							=>	__('Add ').$singular,
		'add_new_item'					=>	__('Add New ').$singular,
		'new_item_name'					=> __('New ').$singular,
		/* 'parent_item'	=> '', */
		/* 'parent_item_colon'	=> '', */
		'search_items'					=> __('Search ').$plural,
		/* 'popular_items'					=> __('Popular ').$plural, */
		/* 'separate_items_with_commas'	=> __('Separate ').$plural.(' with commas'), */
		'add_or_remove_items'			=> __('Add or remove ').$plural,
		'choose_from_most_used' 		=> __('Choose from the most used ').$plural,
		'not_found'						=> __('No ').$singular.__(' found'),

	);
		
	$args = array(
		'labels'						=>	$labels,
		'hierarchical'          	=> true,
		'public'						=> true,
		'show_ui'               	=> true,
		'show_admin_column'     	=> true,
		'update_count_callback' 	=> '_update_post_term_count',
		'query_var'             	=> true,
		'rewrite'               	=> array( 'slug' => 'menu' ),
	);
	register_taxonomy('menu-cuisine', array('bzbr001-menu'), $args);
}
add_action('init', 'cuisine_menu_custom_taxonomies');

/* Filter Taxonomy */
function cuisine_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'menu-cuisine'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'cuisine_filter_post_type_by_taxonomy');

/* Convert ID to Term Taxonomy */
function cuisine_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'menu-cuisine'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'cuisine_convert_id_to_term_in_query');

/* Register Menu-Course Taxonomy */
function course_menu_custom_taxonomies(){
	
	$singular	= __('Menu Course');
	$plural	= __('Menu Courses');
	
	$labels = array (
		'name' 							=> $plural,
		'singular_name'					=> $singular,
		'menu_name'						=>	$plural,
		'all_items'						=> __('All ').$plural,
		'edit_item'						=>	__('Edit ').$singular,
		'view_item'						=> __('View ').$singular,
		'update_item'						=> __('Update ').$singular,
		'add_new'							=>	__('Add ').$singular,
		'add_new_item'					=>	__('Add New ').$singular,
		'new_item_name'					=> __('New ').$singular,
		/* 'parent_item'	=> '', */
		/* 'parent_item_colon'	=> '', */
		'search_items'					=> __('Search ').$plural,
		/* 'popular_items'					=> __('Popular ').$plural, */
		/* 'separate_items_with_commas'	=> __('Separate ').$plural.(' with commas'), */
		'add_or_remove_items'			=> __('Add or remove ').$plural,
		'choose_from_most_used' 		=> __('Choose from the most used ').$plural,
		'not_found'						=> __('No ').$singular.__(' found'),

	);
		
	$args = array(
		'labels'						=>	$labels,
		'hierarchical'          	=> true,
		'public'						=> true,
		'show_ui'               	=> true,
		'show_admin_column'     	=> true,
		'update_count_callback' 	=> '_update_post_term_count',
		'query_var'             	=> true,
		'rewrite'               	=> array( 'slug' => 'course' ),
	);
	register_taxonomy('menu-course', array('bzbr001-menu'), $args);
}
add_action('init', 'course_menu_custom_taxonomies');

/* Filter Taxonomy */
function course_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'menu-course'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'course_filter_post_type_by_taxonomy');

/* Convert ID to Term Taxonomy */
function course_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'menu-course'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'course_convert_id_to_term_in_query');

/* Register Menu-Meal Taxonomy */
function meal_menu_custom_taxonomies(){
	
	$singular	= __('Menu Meal');
	$plural	= __('Menu Meals');
	
	$labels = array (
		'name' 							=> $plural,
		'singular_name'					=> $singular,
		'menu_name'						=>	$plural,
		'all_items'						=> __('All ').$plural,
		'edit_item'						=>	__('Edit ').$singular,
		'view_item'						=> __('View ').$singular,
		'update_item'						=> __('Update ').$singular,
		'add_new'							=>	__('Add ').$singular,
		'add_new_item'					=>	__('Add New ').$singular,
		'new_item_name'					=> __('New ').$singular,
		/* 'parent_item'	=> '', */
		/* 'parent_item_colon'	=> '', */
		'search_items'					=> __('Search ').$plural,
		'popular_items'					=> __('Popular ').$plural,
		/* 'separate_items_with_commas'	=> __('Separate ').$plural.(' with commas'), */
		'add_or_remove_items'			=> __('Add or remove ').$plural,
		'choose_from_most_used' 		=> __('Choose from the most used ').$plural,
		'not_found'						=> __('No ').$singular.__(' found'),

	);
		
	$args = array(
		'labels'						=>	$labels,
		'hierarchical'          	=> true,
		'public'						=> true,
		'show_ui'               	=> true,
		'show_admin_column'     	=> true,
		'update_count_callback' 	=> '_update_post_term_count',
		'query_var'             	=> true,
		'rewrite'               	=> array( 'slug' => 'meal' ),
	);
	register_taxonomy('menu-meal', array('bzbr001-menu'), $args);
}
add_action('init', 'meal_menu_custom_taxonomies');

/* Filter Taxonomy */
/* function meal_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'meal-course'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'meal_filter_post_type_by_taxonomy'); */

/* Convert ID to Term Taxonomy */
function meal_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'bzbr001-menu'; // change to your post type
	$taxonomy  = 'menu-meal'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'meal_convert_id_to_term_in_query');