<?php
	
/* All the CPT options function
   @package Jombazar */ 

/*
	=================
	CPT OPTIONS PAGE
	=================
*/

function bzbr001_add_cpt_page(){
	
	/* CPT setting page */
	add_submenu_page('edit.php?post_type=bzbr001-about', 'About Page Settings', 'About Settings', 'manage_options', 'bzbr001_cpt_about','bzbr001_about_page');
	add_submenu_page('edit.php?post_type=bzbr001-menu', 'Menu Page Settings', 'Menu Settings', 'manage_options', 'bzbr001_cpt_menu','bzbr001_menu_page');
	add_submenu_page('edit.php?post_type=bzbr001-reviews', 'Reviews Page Settings', 'Reviews Settings', 'manage_options', 'bzbr001_cpt_review','bzbr001_review_page');
	add_submenu_page('edit.php?post_type=bzbr001-faq', 'FAQ Page Settings', 'FAQ Settings', 'manage_options', 'bzbr001_cpt_faq','bzbr001_faq_page');
	add_submenu_page('edit.php?post_type=bzbr001-contact', 'Autoresponder Settings', 'Autoresponder', 'manage_options', 'bzbr001_cpt_contact','bzbr001_contact_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_cpt_settings');
	
}
add_action('admin_menu', 'bzbr001_add_cpt_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_cpt_settings(){
	
	//About-setting register settings
	register_setting('bzbr001-cpt-about', 'about_bg');
	register_setting('bzbr001-cpt-about', 'about_page_title');
	register_setting('bzbr001-cpt-about', 'about_section_title');
	register_setting('bzbr001-cpt-about', 'about_description');

	//About-setting Options
	add_settings_section('cpt-about-options', 'Information of about page', 'cpt_about_options', 'cpt_about');
	add_settings_field('cpt-about-bg','About Page Background', 'cpt_about_background', 'cpt_about', 'cpt-about-options');
	add_settings_field('cpt-about-page-title','Page Title', 'cpt_about_page_title', 'cpt_about', 'cpt-about-options');
	add_settings_field('cpt-about-section-title','Section Title', 'cpt_about_section_title', 'cpt_about', 'cpt-about-options');
	add_settings_field('cpt-about-description','Page Description', 'cpt_about_description', 'cpt_about', 'cpt-about-options');
	
	//Menu-setting register settings
	register_setting('bzbr001-cpt-menu', 'menu_bg');
	register_setting('bzbr001-cpt-menu', 'menu_page_title');
	register_setting('bzbr001-cpt-menu', 'menu_section_title');
	register_setting('bzbr001-cpt-menu', 'menu_description');

	//Menu-setting Options
	add_settings_section('cpt-menu-options', 'Information of menu page', 'cpt_menu_options', 'cpt_menu');
	add_settings_field('cpt-menu-bg','Menu Page Background', 'cpt_menu_background', 'cpt_menu', 'cpt-menu-options');
	add_settings_field('cpt-menu-page-title','Page Title', 'cpt_menu_page_title', 'cpt_menu', 'cpt-menu-options');
	add_settings_field('cpt-menu-section-title','Section Title', 'cpt_menu_section_title', 'cpt_menu', 'cpt-menu-options');
	add_settings_field('cpt-menu-description','Page Description', 'cpt_menu_description', 'cpt_menu', 'cpt-menu-options');
	
	//Reviews-setting register settings
	register_setting('bzbr001-cpt-review', 'review_bg');
	register_setting('bzbr001-cpt-review', 'review_page_title');
	register_setting('bzbr001-cpt-review', 'review_section_title');
	register_setting('bzbr001-cpt-review', 'review_description');
	register_setting('bzbr001-cpt-review', 'review_autorespond');
	register_setting('bzbr001-cpt-review', 'review_widget');

	//Reviews-setting Options
	add_settings_section('cpt-review-options', 'Information of reviews page', 'cpt_review_options', 'cpt_review');
	add_settings_field('cpt-review-bg','Reviews Page Background', 'cpt_review_background', 'cpt_review', 'cpt-review-options');
	add_settings_field('cpt-review-page-title','Page Title', 'cpt_review_page_title', 'cpt_review', 'cpt-review-options');
	add_settings_field('cpt-review-section-title','Section Title', 'cpt_review_section_title', 'cpt_review', 'cpt-review-options');
	add_settings_field('cpt-review-description','Page Description', 'cpt_review_description', 'cpt_review', 'cpt-review-options');
	add_settings_field('cpt-review-autorespond','Autorespond Message', 'cpt_review_autorespond', 'cpt_review', 'cpt-review-options');
	add_settings_field('cpt-review-widget','Testimony Slider Widget', 'cpt_review_widget', 'cpt_review', 'cpt-review-options');
	
	//FAQ-setting register settings
	register_setting('bzbr001-cpt-faq', 'faq_bg');
	register_setting('bzbr001-cpt-faq', 'faq_page_title');
	register_setting('bzbr001-cpt-faq', 'faq_section_title');
	register_setting('bzbr001-cpt-faq', 'faq_description');

	//FAQ-setting Options
	add_settings_section('cpt-faq-options', 'Information of FAQ page', 'cpt_faq_options', 'cpt_faq');
	add_settings_field('cpt-faq-bg','FAQ Page Background', 'cpt_faq_background', 'cpt_faq', 'cpt-faq-options');
	add_settings_field('cpt-faq-page-title','Page Title', 'cpt_faq_page_title', 'cpt_faq', 'cpt-faq-options');
	add_settings_field('cpt-faq-section-title','Section Title', 'cpt_faq_section_title', 'cpt_faq', 'cpt-faq-options');
	add_settings_field('cpt-faq-description','Page Description', 'cpt_faq_description', 'cpt_faq', 'cpt-faq-options');
	
	//Message-setting register settings
	register_setting('bzbr001-cpt-contact', 'autorespond_message');

	//Message-setting Options
	add_settings_section('cpt-contact-options', 'Autoresponder Settings', 'cpt_contact_options', 'cpt_contact');
	add_settings_field('cpt-autorespond-message','Fill in the message here', 'cpt_autorespond_message', 'cpt_contact', 'cpt-contact-options');
	
}


//THIS IS ABOUT PAGE SECTION
function bzbr001_about_page(){
	require_once(get_template_directory().'/inc/template/about-setting.php');
}

//THIS IS MENU PAGE SECTION
function bzbr001_menu_page(){
	require_once(get_template_directory().'/inc/template/menu-setting.php');
}

//THIS IS REVIEWS PAGE SECTION
function bzbr001_review_page(){
	require_once(get_template_directory().'/inc/template/review-setting.php');
}

//THIS IS FAQ PAGE SECTION
function bzbr001_faq_page(){
	require_once(get_template_directory().'/inc/template/faq-setting.php');
}

//THIS IS CONTACT PAGE SECTION
function bzbr001_contact_page(){
	require_once(get_template_directory().'/inc/template/message-setting.php');
}