<?php
	
/* company profile settings function
   @package Jombazar */ 

/*
	=================
		ADMIN PAGE
	=================
*/

function bzbr001_add_admin_page(){
	
	//Generate Admin Page
	add_menu_page('Theme Options', 'Website Settings', 'manage_options', 'bazahab_bzbr001', 'bzbr001_theme_create_page', get_template_directory_uri().'/img/admin/bazahabfavico.png', 2);
	
	//Generate Admin Sub Pages
	add_submenu_page('bazahab_bzbr001', 'Company Profile', 'Company Profile', 'manage_options', 'bazahab_bzbr001', 'bzbr001_theme_create_page');
	add_submenu_page('bazahab_bzbr001', 'Store Appearance', 'Store Settings', 'manage_options', 'bazahab_bzbr001_store','bzbr001_store_page');
	$map = get_option ('activate_map'); /* Activate map submenu */
	if(@$map == 1){
		add_submenu_page('bazahab_bzbr001', 'Map Options', 'Map Settings', 'manage_options', 'bazahab_bzbr001_map','bzbr001_map_page');
	}
	add_submenu_page('bazahab_bzbr001', 'Activate Features Options', 'Added Features', 'manage_options', 'bzbr001_features','bzbr001_features_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_custom_settings');
}
add_action('admin_menu', 'bzbr001_add_admin_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_custom_settings(){
	
	//Company Profile register settings
	register_setting('bzbr001-settings-group', 'company_logo');
	register_setting('bzbr001-settings-group', 'company_name');
	register_setting('bzbr001-settings-group', 'company_registry');
	register_setting('bzbr001-settings-group', 'first_name');
	register_setting('bzbr001-settings-group', 'last_name');
	register_setting('bzbr001-settings-group', 'unit');
	register_setting('bzbr001-settings-group', 'street_1');
	register_setting('bzbr001-settings-group', 'street_2');
	register_setting('bzbr001-settings-group', 'zipcode');
	register_setting('bzbr001-settings-group', 'city');
	register_setting('bzbr001-settings-group', 'state');
	register_setting('bzbr001-settings-group', 'country');
	
	//Company Profile Options
	add_settings_section('bzbr001-company-options', 'Company Information', 'bzbr001_company_options', 'bzbr001_company');
	add_settings_field('company-logo','Company Logo', 'bzbr001_company_logo', 'bzbr001_company', 'bzbr001-company-options');
	add_settings_field('company-name','Company Details', 'bzbr001_company_name', 'bzbr001_company', 'bzbr001-company-options');
	add_settings_field('owner-name','Owner', 'bzbr001_owner_name', 'bzbr001_company', 'bzbr001-company-options');
	add_settings_field('company-address', 'Address', 'bzbr001_company_address', 'bzbr001_company', 'bzbr001-company-options');	
	
	//Contact register settings
	register_setting('bzbr001-settings-group', 'email_add');
	register_setting('bzbr001-settings-group', 'mobile_no');
	register_setting('bzbr001-settings-group', 'phone_no');
	
	//Contact Options
	add_settings_section('bzbr001-contact-options', 'Contact Information', 'bzbr001_contact_options', 'bzbr001_company');
	add_settings_field('contact-email', 'Email', 'bzbr001_contact_email', 'bzbr001_company', 'bzbr001-contact-options');
	add_settings_field('contact-mobile', 'Cell Phone No.', 'bzbr001_mobile_phone', 'bzbr001_company', 'bzbr001-contact-options');
	add_settings_field('contact-phone', 'Phone No.', 'bzbr001_contact_phone', 'bzbr001_company', 'bzbr001-contact-options');
	
	//Sosial Media register settings
	register_setting('bzbr001-settings-group', 'twitter_id', 'cv_sanitize_twitter_id');
	register_setting('bzbr001-settings-group', 'facebook_id');
	register_setting('bzbr001-settings-group', 'linkedin_id');
	register_setting('bzbr001-settings-group', 'instagram_id', 'cv_sanitize_instagram_id');
	
	//Social Media Options
	add_settings_section('bzbr001-sm-options', 'Sosial Media Information', 'bzbr001_sm_options', 'bzbr001_company');
	add_settings_field('sm-twitter', 'Twitter ID', 'bzbr001_sm_twitter', 'bzbr001_company', 'bzbr001-sm-options');
	add_settings_field('sm-facebook', 'Facebook ID', 'bzbr001_sm_facebook', 'bzbr001_company', 'bzbr001-sm-options');
	add_settings_field('sm-linkedin', 'Linkedin ID', 'bzbr001_sm_linkedin', 'bzbr001_company', 'bzbr001-sm-options');
	add_settings_field('sm-instagram', 'Instagram ID', 'bzbr001_sm_instagram', 'bzbr001_company', 'bzbr001-sm-options');
	
	//Store register settings
	register_setting('bzbr001-store-group', 'store_pic');
	register_setting('bzbr001-store-group', 'store_cat');
	register_setting('bzbr001-store-group', 'store_site');

	//Store Options
	add_settings_section('bzbr001-store-options', '', 'bzbr001_store_options', 'bzbr001_store');
	add_settings_field('bzbr001-store-pic','Store Picture', 'bzbr001_store_picture', 'bzbr001_store', 'bzbr001-store-options');
	add_settings_field('bzbr001-store-cat','Store Category', 'bzbr001_store_category', 'bzbr001_store', 'bzbr001-store-options');
	add_settings_field('bzbr001-store-site','Store Website', 'bzbr001_store_site', 'bzbr001_store', 'bzbr001-store-options');
	
	//Map register settings
	register_setting('bzbr001-map-group', 'map_iframe_field');
	register_setting('bzbr001-map-group', 'map_position_field');
	register_setting('bzbr001-map-group', 'map_size_field');
	register_setting('bzbr001-map-group', 'map_shadow_field');
	register_setting('bzbr001-map-group', 'map_curve_field');
	register_setting('bzbr001-map-group', 'map_bg_field');
	register_setting('bzbr001-map-group', 'map_paralax_field');
	register_setting('bzbr001-map-group', 'map_widget_field');
	
	//Map Options
	add_settings_section('bzbr001-map-options', '', 'bzbr001_map_options', 'bzbr001_map');
	add_settings_field('bzbr001-iframe-field','Google Maps Iframe Tag', 'bzbr001_map_iframe', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-position-field','Map Position', 'bzbr001_map_position', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-size-field','Map Size', 'bzbr001_map_size', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-border-field','Border Style', 'bzbr001_map_border_style', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-bg-field','Background Image', 'bzbr001_map_background', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-paralax-field','Paralax Background', 'bzbr001_map_background_paralax', 'bzbr001_map', 'bzbr001-map-options');
	add_settings_field('bzbr001-widget-field','Widget', 'bzbr001_map_widget', 'bzbr001_map', 'bzbr001-map-options');
	
	//Features options register settings
	register_setting('bzbr001-features-group', 'activate_contact');
	register_setting('bzbr001-features-group', 'activate_review');
	register_setting('bzbr001-features-group', 'activate_map');
	register_setting('bzbr001-features-group', 'activate_popup');
	register_setting('bzbr001-features-group', 'optin_form');
	register_setting('bzbr001-features-group', 'optin_autoresponder');
	
	//Features Options
	add_settings_section('bzbr001-features-options', 'Features Options', 'bzbr001_features_options', 'bzbr001_features');
	add_settings_field('activate-contact','Contact', 'bzbr001_activate_contact', 'bzbr001_features', 'bzbr001-features-options');
	add_settings_field('activate-review','Reviews', 'bzbr001_activate_review', 'bzbr001_features', 'bzbr001-features-options');
	add_settings_field('activate-map','Map', 'bzbr001_activate_map', 'bzbr001_features', 'bzbr001-features-options');
	add_settings_field('activate-popup','Popup Advertisement', 'bzbr001_activate_popup', 'bzbr001_features', 'bzbr001-features-options');
	add_settings_field('activate-optin','Call to Action Form', 'bzbr001_activate_optin', 'bzbr001_features', 'bzbr001-features-options');
	add_settings_field('optin-autoresponder','<span id="cta_autoresponder">CTA Autoresponder</span>', 'bzbr001_activate_optin_autoresponder', 'bzbr001_features', 'bzbr001-features-options');
}


//THIS IS COMPANY PROFILE SECTION
function bzbr001_theme_create_page() {
	require_once(get_template_directory().'/inc/template/company-profile.php');
}

/*=======Company Information=========*/
  
function bzbr001_company_options(){
	echo'Company Profile';
}

function bzbr001_company_logo(){
	$companyLogo = esc_attr(get_option('company_logo'));
	if(empty($companyLogo)){
		echo 
		'<input type="button" value="Upload Company Logo" id="upload-button"/>
		
		<input type="hidden" id="company-logo" name="company_logo" value="" /> ';
		
	} 	else{
	
		echo 
		'<input type="button" value="Replace Company Logo" id="upload-button"/> 
		
		<input type="hidden" id="company-logo" name="company_logo" value="'.$companyLogo.'" /> 
		
		<input type="button" value="Remove" id="remove-logo"/>';
	}
}

function bzbr001_company_name(){
	$companyName			= esc_attr(get_option('company_name'));
	$companyRegistry 	= esc_attr(get_option('company_registry'));
	echo '<input type="text" name="company_name" value="'.$companyName.'" placeholder="Company Name"/><br> <input type="text" name="company_registry" value="'.$companyRegistry.'" placeholder="Company Registry"/>';
}

function bzbr001_owner_name(){
	$firstName 	= esc_attr(get_option('first_name'));
	$lastName 	= esc_attr(get_option('last_name'));
	echo 
	'<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/> 
	
	<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
}

function bzbr001_company_address(){
	$unit 		= esc_attr(get_option('unit'));
	$street1 	= esc_attr(get_option('street_1'));
	$street2 	= esc_attr(get_option('street_2'));
	$zipcode 	= esc_attr(get_option('zipcode'));
	$city 		= esc_attr(get_option('city'));
	$state 	= esc_attr(get_option('state'));
	$country 	= esc_attr(get_option('country'));
	
	echo 
	
	'<br><input type="text" name="unit" value="'.$unit.'" placeholder="Unit/Block" style="width:330px;"/> 
	
	<br><input type="text" name="street_1" value="'.$street1.'" placeholder="Street"/><input type="text" name="street_2" value="'.$street2.'" placeholder="Street"/>

	<br><input type="text" name="zipcode" value="'.$zipcode.'" placeholder="Zipcode"/><input type="text" name="city" value="'.$city.'" placeholder="City"/>

	<br><input type="text" name="state" value="'.$state.'" placeholder="State"/><input type="text" name="country" value="'.$country.'" placeholder="Country"/>';
}

/*=======Contact Information=========*/
  
function bzbr001_contact_options(){
	echo'Company Contact';
}

function bzbr001_contact_email(){
	$emailAdd = esc_attr(get_option('email_add'));
	echo '<input type="text" name="email_add" value="'.$emailAdd.'" placeholder="Email Address"/>';
}

function bzbr001_mobile_phone(){
	$mobileNo = esc_attr(get_option('mobile_no'));
	echo '<input type="text" name="mobile_no" value="'.$mobileNo.'" placeholder="CellPhone No"/>';
}

function bzbr001_contact_phone(){
	$phoneNo = esc_attr(get_option('phone_no'));
	echo '<input type="text" name="phone_no" value="'.$phoneNo.'" placeholder="Phone No"/>';
}

/*=======Sosial Media Information=========*/

function bzbr001_sm_options(){
	echo'Company Social Media ID';
}

function bzbr001_sm_twitter(){
	$twitterID = esc_attr(get_option('twitter_id'));
	echo '<input type="text" name="twitter_id" value="'.$twitterID.'" placeholder="Twitter ID"/> <p class="description">Input without @</p>';
}

//Sanitization settings
function bzbr001_sanitize_twitter_id($input){
	$output = sanitize_text_field($input);
	$output = str_replace('@', '', $output);
	return $output;
}

function bzbr001_sm_facebook(){
	$facebookID = esc_attr(get_option('facebook_id'));
	echo '<input type="text" name="facebook_id" value="'.$facebookID.'" placeholder="Facebook ID"/>';
}

function bzbr001_sm_linkedin(){
	$linkedinID = esc_attr(get_option('linkedin_id'));
	echo '<input type="text" name="linkedin_id" value="'.$linkedinID.'" placeholder="Linkedin ID"/>';
}

function bzbr001_sm_instagram(){
	$instagramID = esc_attr(get_option('instagram_id'));
	echo '<input type="text" name="instagram_id" value="'.$instagramID.'" placeholder="Instagram ID"/> <p class="description">Input without @</p>';
}

//Sanitization settings
function bzbr001_sanitize_instagram_id($input){
	$output = sanitize_text_field($input);
	$output = str_replace('@', '', $output);
	return $output;
}


//THIS IS STORE SECTION
function bzbr001_store_page(){
	require_once(get_template_directory().'/inc/template/company-store.php');
}


//THIS IS MAP SECTION
function bzbr001_map_page(){
	require_once(get_template_directory().'/inc/template/map-form.php');
}

/*=======Activate Map Options=========*/
function bzbr001_map_display(){
	$mapPosition = esc_attr(get_option('map_position_field'));
	$mapSize = esc_attr(get_option('map_size_field'));
	$mapShadow = esc_attr(get_option('map_shadow_field'));
	$mapCurve = esc_attr(get_option('map_curve_field'));
	$mapBg = esc_attr(get_option('map_bg_field'));
	
	if (!empty ($mapBg)):
	$background = 
		'background-image: url('.$mapBg.');
		background-position: center center; 
		background-repeat: no-repeat;
		background-size: cover;';
	endif;
	
	if ($mapCurve === 'curve'):
	$border_radius = 'border-radius: 15px;';
	endif;

	if ($mapShadow === 'shadow'):
	$shadow = '
		-webkit-box-shadow: 0px 0px 13px 1px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 13px 1px rgba(0,0,0,0.75);
		-ms-box-shadow: 0px 0px 13px 1px rgba(0,0,0,0.75);
		-o-box-shadow: 0px 0px 13px 1px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 13px 1px rgba(0,0,0,0.75);';
	endif;
	
	if ($mapSize === 'small'):
		$size = 'width:400px; height:300px;';
	elseif ($mapSize === 'medium'):
		$size =  'width:600px; height:450px;';
	elseif ($mapSize === 'large'):
		$size =  'width:800px; height:600px;';
	elseif ($mapSize === 'full'):
		$size =  'width:100%; height:600px;';
	endif; 
	
	echo 
	'<style>
	
	#map-bg-preview, div#wrap.container-fluid { 
		display: flex;
		align-items:' .$mapPosition.';
		justify-content:'.$mapPosition.';
		padding: 15px;
		'.$background.'
	}
	
	#map-bg-preview iframe {
		margin-right: 40px;
		'.$border_radius.'
		'.$shadow.'
		'.$size.'
	}
	
	</style>';
}
add_action( 'wp_head', 'bzbr001_map_display' );


//THIS IS THEME FEATURES SECTION
function bzbr001_features_page(){
	require_once(get_template_directory().'/inc/template/theme-features.php');
}

/*=======Activate Features Options=========*/
  
function bzbr001_features_options(){
	echo'Activate and Deactivate Built-in Features';
}

function bzbr001_activate_contact(){
	$contact = get_option('activate_contact');
	$checked = (@$contact == 1 ? 'checked' : '');
	echo 
	'<div class="slideThree">
		<input type = "checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /><label for="activate_contact"></label>
	</div>';
}

function bzbr001_activate_review(){
	$review = get_option('activate_review');
	$checked = (@$review == 1 ? 'checked' : '');
	echo 
	'<div class="slideThree">
		<input type = "checkbox" id="activate_review" name="activate_review" value="1" '.$checked.' /><label for="activate_review"></label>
	</div>';
}

function bzbr001_activate_map(){
	$map = get_option('activate_map');
	$checked = (@$map == 1 ? 'checked' : '');
	echo 
	'<div class="slideThree">
		<input type = "checkbox" id="activate_map" name="activate_map" value="1" '.$checked.'/><label for="activate_map"></label>
	</div>';
}

function bzbr001_activate_popup(){
	$popup = get_option('activate_popup');
	$checked = (@$popup == 1 ? 'checked' : '');
	echo 
	'<div class="slideThree">
		<input type = "checkbox" id="activate_popup" name="activate_popup" value="1" '.$checked.'/><label for="activate_popup"></label>
	</div>';
}

function bzbr001_activate_optin(){
	$optinForm = esc_attr(get_option('optin_form'));
	$checked = (@$optinForm == 1 ? 'checked' : ''); 
	echo 
	'<div class="slideThree">
		<input type = "checkbox" id="optin_form" name="optin_form" value="1" '.$checked.'/><label for="optin_form"></label>
	</div><small> Use this CTA form to create clients email database.<small>';
}

function bzbr001_activate_optin_autoresponder(){
	$optinAuto = esc_attr(get_option('optin_autoresponder')); 
	echo '<textarea rows="7" cols="80" name="optin_autoresponder" id="optin_autoresponder" value="'.$optinAuto.'" placeholder="Autorespond message to new subscriber">'.$optinAuto.'</textarea>';
}