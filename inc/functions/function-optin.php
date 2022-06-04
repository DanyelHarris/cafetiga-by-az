<?php
	
/* remove generator version function
   @package Jombazar */ 

/*
	=================
		OPTIN PAGE
	=================
*/

function bzbr001_add_optin_page(){
	
	/* CPT setting page */
	add_submenu_page('edit.php?post_type=bzbr001-optin', 'Shortcode Generator', 'Shortcode Generator', 'manage_options', 'bzbr001_cpt_optin','bzbr001_optin_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_optin_settings');
	
}
add_action('admin_menu', 'bzbr001_add_optin_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_optin_settings(){
	
	//Optin-setting register settings
	register_setting('bzbr001-cpt-optin', 'optin_code');
	register_setting('bzbr001-cpt-optin', 'optin_desc');
	register_setting('bzbr001-cpt-optin', 'optin_start');
	register_setting('bzbr001-cpt-optin', 'optin_end');

	//Optin-setting Options
	add_settings_section('cpt-optin-options', '', 'cpt_optin_options', 'cpt_optin');
	add_settings_field('optin-code', optin_inform_shortcode() , 'bzbr001_optin_info', 'cpt_optin', 'cpt-optin-options');	
	
}

/*THIS IS OPTIN PAGE SECTION*/
function bzbr001_optin_page(){
	require_once(get_template_directory().'/inc/template/optin-setting.php');
}


/*
	=================
	CUSTOM FUNCTIONS
	=================
*/

// retrieve data to inform shortcode 
function optin_inform_shortcode(){
	
	$optinCode = esc_attr(get_option('optin_code'));
	$optinDesc = esc_attr(get_option('optin_desc'));
						 
	if(!empty($optinCode) && !empty($optinDesc)): 
		return 
		'<div id="helpTab">
			<center><code>[cta_form]</code></center>
			<br> 
			<p>Paste the shortcode in aside post to generate opt-in form.</p>
			<p>You may also use button to generate shortcode.</p>
			<p>Just look for button: <br> <code>Add CTA Form</code> ;-)</p>
		</div>';
	else:
		return 
		'<div id="helpTab">
			<p>Please insert data to activate opt-in form shortcode.</p>
			<p>The data may consist of any character. If you insert just "0" it may consider as null</p>
		</div>';
	endif; 
	
}

//Calculate Promo countdown
function bzbr001_calc_countdown_promo(){
	
	/* retrieve data */
	$optinStart = get_option('optin_start');
	$optinEnd = get_option('optin_end');
	$curDate = date_i18n(get_option('date_format')); 
	$curTime = date_i18n(get_option('time_format', current_time('timestamp'))); 
	
	/* convert and calculate for countdown days */
	$date = strtotime($optinEnd. ' ' .$curTime);
	$remaining = $date - time();
			
	$days_remaining = floor($remaining / 86400);
	$hours_remaining = floor(($remaining % 86400) / 3600);
	
	/* results for countdown days*/
	if ($days_remaining > 1) { $days = ' days'; }else {$days = ' day';} 
	if ($hours_remaining > 1) { $hours = ' hours'; }else {$hours = ' hour';} 
	
	$countdown = '<p>There are '.$days_remaining.' '.$days.' and '.$hours_remaining.' '.$hours.' left.</p>';
	
	/* convert and show date different */
	$Start = (string)$optinStart;
	$Start = date('Y-m-d', strtotime(str_replace('/', '-', $optinStart)));
	$End = (string)$optinEnd;
	$End = date('Y-m-d', strtotime(str_replace('/', '-', $optinEnd)));
	$Current = (string)$curDate;
	$Current = date('Y-m-d', strtotime(str_replace('/', '-', $curDate)));
	
	if ($Current == $Start || $Start <= $Current && $Current <= $End ) {
		return $countdown;
	} elseif ($End < $Current && $Start < $End ) { 
		return '<p class="text-danger blink" style="font-weight:bold;">Promotion has ended.<p>';
	}elseif ($End < $Start) { 
		return ''; 
	}
	
}


//Calculate Promo Duration and display para 1 info
function optinInfo_par_one(){
	
	/* retrieve data */
	$optinStart = get_option('optin_start');
	$optinEnd = get_option('optin_end');
	
	/* convert and calculate for counting days */
	$date1	=	date_create($optinStart);
	$date2	=	date_create($optinEnd);
	$diff	=	date_diff($date1,$date2);
	
	/* results for counting days*/
	$calc_promo_date = $diff->format('%R%a')+1;
	
	if ($calc_promo_date > 1) { $days = ' days'; }else {$days = ' day';} 
	
	/* convert and show date different */
	$Start = (string)$optinStart;
	$Start = date('Y-m-d', strtotime(str_replace('/', '-', $optinStart)));
	$End = (string)$optinEnd;
	$End = date('Y-m-d', strtotime(str_replace('/', '-', $optinEnd)));
	
	if ($Start <= $End) {
		return	'<p> It starts on '.$optinStart.' and ends on '.$optinEnd.'. </p>
				 <p>The promotion is for '.$calc_promo_date.$days.'.';
	}else {
		return '<p class="text-warning" style="font-weight:bold;">The date is not valid. End date can not be earlier than Start date. Please fill in a valid date.<p>';
	}
	
}
