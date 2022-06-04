<?php
/* @package Jombazar */
/*========================
  ADMIN ENQUEUE FUNCTIONS
  ========================*/
  
function bazahab_load_admin_scripts($hook){
	if(
	('toplevel_page_bazahab_bzbr001' != $hook) && 
	('website-settings_page_bazahab_bzbr001_store' != $hook) && 
	('website-settings_page_bazahab_bzbr001_map' != $hook) && 
	('website-settings_page_bzbr001_features' != $hook) && 
	('bzbr001-about_page_bzbr001_cpt_about' != $hook) && 
	('bzbr001-menu_page_bzbr001_cpt_menu' != $hook) && 
	('bzbr001-reviews_page_bzbr001_cpt_review' != $hook) &&
	('bzbr001-faq_page_bzbr001_cpt_faq' != $hook)&&
	('bzbr001-optin_page_bzbr001_cpt_optin' != $hook)&&
	('toplevel_page_bzbr001_advertisement' != $hook)&&
	('advertisement_page_bzbr001_ads_listing' != $hook)&&
	('posts_page_bzbr001_post' != $hook)&&
	('edit.php' != $hook)&&
	('post.php' != $hook)
	){return;}
	
	
	wp_register_style('flickity', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style('flickity');

	/* wp_enqueue_style( 'mobile', 'https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css', array(), '1.4.2', 'all' ); */
	
	wp_enqueue_style('wp-color-picker');
	
	wp_enqueue_style( 'font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	
	wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css', array(), '1.12.1', 'all' );
	
	wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', array(), '3.5.2', 'all');
	wp_enqueue_style('animate');
	
	wp_enqueue_style( 'Vollkorn', 'https://fonts.googleapis.com/css?family=Vollkorn', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Paytone One', 'https://fonts.googleapis.com/css?family=Paytone+One', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Lobster', 'https://fonts.googleapis.com/css?family=Lobster', array(), '1.0.0', 'all' );
	
	wp_register_style('cpt-options', get_template_directory_uri().'/css/admin/cpt-options.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cpt-options');
	
	wp_register_style('bazahab_web_settings', get_template_directory_uri().'/css/admin/website-settings.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bazahab_web_settings');
	
	wp_register_style('bazahab_optin', get_template_directory_uri().'/css/admin/cafesatu-admin.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bazahab_optin');
	
	wp_register_style('bazahab_popbutton', get_template_directory_uri().'/css/admin/popbutton.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bazahab_popbutton');
	
	wp_enqueue_media();
	
	/* wp_register_script('mobile', 'https://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js', false, '1.4.2', true);
	wp_enqueue_script('mobile'); */
	
	wp_register_script('flickity', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array('jquery', 'jquery-ui-datepicker'), '1.0.0', true);
	wp_enqueue_script('flickity');
	
	wp_register_script('bazahab-theme-script', get_template_directory_uri().'/js/admin/cafesatu-admin.js', array('jquery', 'jquery-ui-datepicker'), '1.0.0', true);
	wp_enqueue_script('bazahab-theme-script');
	
	wp_register_script('bazahab-admin-script', get_template_directory_uri().'/js/admin/settings-asset/logo.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bazahab-admin-script');
	
	wp_register_script('bazahab-features-script', get_template_directory_uri().'/js/admin/settings-asset/features.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bazahab-features-script');
	
	wp_register_script('bazahab-store-script', get_template_directory_uri().'/js/admin/settings-asset/store.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bazahab-store-script');
	
	wp_register_script('bazahab-map-script', get_template_directory_uri().'/js/admin/settings-asset/map.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bazahab-map-script');
	
	wp_register_script('cpt-about-script', get_template_directory_uri().'/js/admin/options-asset/about.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cpt-about-script');
	
	wp_register_script('cpt-menu-script', get_template_directory_uri().'/js/admin/options-asset/menu.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cpt-menu-script');
	
	wp_register_script('cpt-review-script', get_template_directory_uri().'/js/admin/options-asset/review.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cpt-review-script');
	
	wp_register_script('cpt-faq-script', get_template_directory_uri().'/js/admin/options-asset/faq.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cpt-faq-script');
	
	wp_register_script('cpt-optin-script', get_template_directory_uri().'/js/admin/options-asset/optin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cpt-optin-script');
	
	wp_register_script('bazahab-popbutton-script', get_template_directory_uri().'/js/admin/options-asset/cafesatu-admin-popbutton.js', array('jquery', 'wp-color-picker'), '1.0.0', true);
	wp_enqueue_script('bazahab-popbutton-script');
		
}
add_action('admin_enqueue_scripts', 'bazahab_load_admin_scripts');

/*========================
  FRONT-END FUNCTIONS
  ========================*/
  
function bazahab_load_scripts(){
	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	
	wp_register_style('audio-player', get_template_directory_uri().'/css/vendor/audio-player-styles.css', array(), '1.0.0', 'all');
	wp_enqueue_style('audio-player');
	
	wp_register_style('video-player', get_template_directory_uri().'/css/vendor/video-player-styles.css', array(), '1.0.0', 'all');
	wp_enqueue_style('video-player');

	wp_enqueue_style('wp-color-picker');
	
	wp_enqueue_style( 'font-dafoe', 'https://fonts.googleapis.com/css?family=Mr+Dafoe', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Bubbler-One', 'https://fonts.googleapis.com/css?family=Bubbler+One', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Vollkorn', 'https://fonts.googleapis.com/css?family=Vollkorn', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Paytone One', 'https://fonts.googleapis.com/css?family=Paytone+One', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'Lobster', 'https://fonts.googleapis.com/css?family=Lobster', array(), '1.0.0', 'all' );
	
	wp_register_style('cafesatu_theme', get_template_directory_uri().'/css/cafesatu.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_theme');
	
	wp_register_style('cafesatu_nav', get_template_directory_uri().'/css/vendor/nav.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_nav');
	
	/* wp_register_style('bootstrap-modal-carousel', get_template_directory_uri().'/css/vendor/bootstrap-modal-carousel.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bootstrap-modal-carousel'); */
	
	wp_register_style('cafesatu_slider', get_template_directory_uri().'/css/vendor/slider.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_slider');
	
	wp_register_style('cafesatu_pricetag', get_template_directory_uri().'/css/vendor/pricetag.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_pricetag');
	
	wp_register_style('wow', get_template_directory_uri().'/css/vendor/wow.css', array(), '1.1.2', 'all');
	wp_enqueue_style('wow');
	
	wp_register_style('cafesatu_testimony', get_template_directory_uri().'/css/vendor/testimony.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_testimony');
	
	wp_register_style('cafesatu_speech', get_template_directory_uri().'/css/vendor/speech.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_speech');
	
	wp_register_style('cafesatu_ribbon', get_template_directory_uri().'/css/vendor/ribbon.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_ribbon');
	
	wp_register_style('cafesatu_gallery', get_template_directory_uri().'/css/vendor/gallery.css', array(), '1.0.0', 'all');
	wp_enqueue_style('cafesatu_gallery');
	
	wp_register_style('bazahab_popbutton', get_template_directory_uri().'/css/admin/popbutton.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bazahab_popbutton');
	
	wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', array(), '3.5.2', 'all');
	wp_enqueue_style('animate');
	
	wp_deregister_script('jquery');
	
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1', true);
	wp_enqueue_script('jquery');
	
	wp_register_script('jquery-latest', 'http://code.jquery.com/jquery-latest.js', false, '3.2.1', true);
	wp_enqueue_script('jquery-latest');
	
	wp_enqueue_script('iris', 'https://cdn.jsdelivr.net/wordpress/3.8/js/iris.min.js',array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
	
	/* wp_enqueue_script('wp-color-picker', 'https://cdn.jsdelivr.net/g/wordpress@3.8(js/iris.min.js+js/colorpicker.min.js)', array('iris'), false,1);

	$colorpicker_l10n = array('clear' => __('Clear'), 'defaultString' => __('Default'), 'pick' => __('Select Color'));

	wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );  */

	wp_register_script('cafesatu-wow', get_template_directory_uri().'/js/vendor/wow.min.js', array('jquery'), '1.1.2', true);
	wp_enqueue_script('cafesatu-wow');
	
	wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	
	wp_register_script('cafesatu-scroll', get_template_directory_uri().'/js/scrollwin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cafesatu-scroll');
	
	wp_register_script('cafesatu-paralax', get_template_directory_uri().'/js/paralax.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cafesatu-paralax');
	
	wp_register_script('cafesatu', get_template_directory_uri().'/js/cafesatu.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cafesatu');
	
	/* wp_register_script('bootstrap-modal-carousel', get_template_directory_uri().'/js/vendor/bootstrap-modal-carousel.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bootstrap-modal-carousel'); */
	
	/* wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
	wp_localize_script('like_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
	)); */
	
	wp_register_script('cafesatu-slider', get_template_directory_uri().'/js/vendor/slider.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('cafesatu-slider');
	
	wp_register_script('stellar', get_template_directory_uri().'/js/vendor/jquery.stellar.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('stellar');

	}
add_action('wp_enqueue_scripts', 'bazahab_load_scripts');