<?php 
/* this is theme-support
   @package Jombazar */ 
  
  
/*====================
	REGISTER MENUS
=====================*/

function bazahab_theme_setup(){
	add_theme_support('menus');
	
	register_nav_menu('primary', __( 'Primary Header Navigation'));
	register_nav_menu('secondary', __( 'Footer Navigation'));
}
add_action ('init', 'bazahab_theme_setup');


/*====================
	ADD THEME SUPPORT
=====================*/

$options = get_option('activate_post_formats');
$formats = array ('aside', 'gallery', 'quote', 'status', 'image', 'video', 'audio', 'link');
$output = array();
foreach ($formats as $format){
	$output[] = (@$options[$format] == 1 ? $format : '');
}
if(!empty($options)){
	add_theme_support( 'post-formats', $output);
}

add_theme_support( 'post-thumbnails');
add_theme_support('html5', array ('comment-list', 'comment-forum', 'search-form', 'gallery', 'caption'));
add_theme_support( 'custom-header', array(
  'video' => true,
  'video-active-callback' => 'custom_video_active_callback'
));


/*====================
 ASSIGN CPT STICKY POST
=====================*/

add_action( 'submitpost_box', function() {
    global $post;
    if ( isset( $post->post_type ) && in_array( $post->post_type, array( 'bzbR001-about', 'menu-setting', 'about-setting', 'review-setting' ) ) ) {
        /* echo 'before'; // debug */
        $post->post_type_original = $post->post_type;
        $post->post_type = 'post';
    }
} );

add_action( 'post_submitbox_misc_actions', function() {
    global $post;
    if ( isset( $post->post_type_original ) && in_array( $post->post_type_original, array( 'bzbR001-about', 'menu-setting', 'about-setting', 'review-setting' ) ) ) {
        /* echo 'after'; // debug */
        $post->post_type = $post->post_type_original;
        unset( $post->post_type_original );
    }
} );


/*====================
 DISABLE DELETE POST
=====================*/

/* add_filter( 'map_meta_cap', function ( $caps, $cap, $user_id, $args )
{
    // Nothing to do
    if( 'delete_post' !== $cap || empty( $args[0] ) )
        return $caps;

    // Target the payment and transaction post types
    if( in_array( get_post_type( $args[0] ), [ 'store-map', 'faq-setting', 'about-setting', 'menu-setting', 'review-setting' ], true ) )
        $caps[] = 'do_not_allow';       

return $caps;    
}, 10, 4 );
 */
 
 
/*====================
 FILTER POST FORMATS
=====================*/

function store_admin_posts_filter( &$query ){
    if ( 
        is_admin() 
        AND 'edit.php' === $GLOBALS['pagenow']
        AND isset( $_GET['p_format'] )
        AND '-1' != $_GET['p_format']
        )
    {
        $query->query_vars['tax_query'] = array( array(
            'taxonomy' => 'post_format',
            'field'    => 'ID',
            'terms'    => array( $_GET['p_format'] )
        ) );
    }
}
add_filter( 'parse_query', 'store_admin_posts_filter' );

function store_restrict_manage_posts_format(){	
    $post_format_ID = ( isset( $_GET['p_format'] ) && $_GET['p_format'] != '' ) ? $_GET['p_format'] : -1;

	$type = 'post';
	if (isset($_GET['post_type'])) {	$type = $_GET['post_type'];}
	
	if ('post' == $type){
		wp_dropdown_categories( array(
			'taxonomy'         => 'post_format',
			'hide_empty'       => 0,
			'name'             => 'p_format',
			'show_option_none' => 'Select Post Format',
			'selected'         => $post_format_ID
		) );
	}
}
add_action( 'restrict_manage_posts', 'store_restrict_manage_posts_format' );


/*====================
 TOOLTIP BUTTON
=====================*/

// Filter Functions with Hooks
function custom_mce_button() {
  // Check if user have permission
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
  }
  // Check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'custom_tinymce_plugin' );
    add_filter( 'mce_buttons', 'register_mce_button' );
  }
}
add_action('admin_head', 'custom_mce_button');

// Function for new button
function custom_tinymce_plugin( $plugin_array ) {
  $plugin_array['custom_mce_button'] = get_template_directory_uri() .'/js/admin/tooltip_plugin.js';
  return $plugin_array;
}

// Register new button in the editor
function register_mce_button( $buttons ) {
  array_push( $buttons, 'custom_mce_button' );
  return $buttons;
}  


/*====================
 POPOVER BUTTON
=====================*/

// Filter Functions with Hooks
function popover_mce_button() {
  // Check if user have permission
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
  }
  // Check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'popover_tinymce_plugin' );
    add_filter( 'mce_buttons', 'reg_mce_button' );
  }
}
add_action('admin_head', 'popover_mce_button');

// Function for new button
function popover_tinymce_plugin( $plugin_array ) {
  $plugin_array['popover_mce_button'] = get_template_directory_uri() .'/js/admin/popover_plugin.js';
  return $plugin_array;
}

// Register new button in the editor
function reg_mce_button( $buttons ) {
  array_push( $buttons, 'popover_mce_button' );
  return $buttons;
}


/*====================
 MAP BUTTON
=====================*/

// Filter Functions with Hooks
function map_mce_button() {
  // Check if user have permission
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
	return;
  }
  // Check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
	add_filter( 'mce_external_plugins', 'map_tinymce_plugin' );
	add_filter( 'mce_buttons', 'regmap_mce_button' );
  }
}
$map = get_option ('activate_map'); /* Activate map submenu */
if(@$map == 1){add_action('admin_head', 'map_mce_button');}

// Function for new button
function map_tinymce_plugin( $plugin_array ) {
  $plugin_array['map_mce_button'] = get_template_directory_uri() .'/js/admin/map_plugin.js';
  return $plugin_array;
}

// Register new button in the editor
function regmap_mce_button( $buttons ) {
  array_push( $buttons, 'map_mce_button' );
  return $buttons;
}


/*====================
 OPT_IN BUTTON
=====================*/

function add_optin_form_button() {
  echo '<a href="#" class="button insert-optin-shortcode" ><span class="wp-media-buttons-icon dashicons dashicons-migrate"></span> ' . __( 'Add CTA Form', 'cafesatu' ) . '</a>';
}
$optinForm = get_option ('optin_form'); /* activate optin shortcode button */
$optinCode = esc_attr(get_option('optin_code'));
if(@$optinForm == 1 && $optinCode != '0'){add_action( 'media_buttons', 'add_optin_form_button', 100 );}

// Action on button click
function optin_form_button_action(){
  add_action( 'admin_print_footer_scripts', 'optin_form_button_scripts', 999);
}
add_action( 'wp_enqueue_media', 'optin_form_button_action' );

// Function for new button
function optin_form_button_scripts(){ ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
  $('body').on('click', '.insert-optin-shortcode', function InsertContainer() {
     window.send_to_editor('[cta_form]');
  });
});
</script>

<?php }


/*====================
 POPUP ADS BUTTON
=====================*/

function add_pop_ads_button() {
	$popupSize = esc_attr(get_option('popup_size'));
	$popupPerpage = esc_attr(get_option('popup_perpage'));

	echo '<a href="#" class="button insert-popads-shortcode" data-size="'.$popupSize.'" data-slide="'.$popupPerpage.'"><span class="wp-media-buttons-icon dashicons dashicons-admin-page"></span> ' . __( 'Add Pop-up Ads', 'cafesatu' ) . '</a>';
}

$popup = get_option ('activate_popup'); /* activate popads shortcode button */
$sum = bzbr001_ads_sum_all();
if(@$popup == 1 && $sum != 0){add_action( 'media_buttons', 'add_pop_ads_button', 100 );}

// Action on button click
function pop_ads_button_action(){
	add_action( 'admin_print_footer_scripts', 'pop_ads_button_scripts', 999);
}
add_action( 'wp_enqueue_media', 'pop_ads_button_action' );

// Function for new button
function pop_ads_button_scripts(){  ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	var size = $('.insert-popads-shortcode').data('size');
	var slide = $('.insert-popads-shortcode').data('slide');
	
  $('body').on('click', '.insert-popads-shortcode', function InsertContainer() {
     window.send_to_editor('[pop_ads size="' + size +'" slide="' + slide +'"]');
  });
});
</script>

<?php }