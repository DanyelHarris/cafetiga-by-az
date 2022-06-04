<?php 
/* this is shotcodes
   @package Jombazar */ 
  
/*====================
  REGISTER SHORTCODES
=====================*/

//Tooltip
function store_tooltip($atts, $content = null){
	
	//[tooltip placement="top" title="tooltip title"]  [/tooltip]
	
	/* get the attribute */
	$atts = shortcode_atts(
		array(
		'placement'	=> 'top',
		'title'		=> ''
		),
		$atts,
		'tooltip'
	);
	
	$title = ($atts['title'] == '' ? $content : $atts['title']);
	
	/* return HTML */
	return '<span class="store-tooltip" data-toggle="tooltip" data-placement="'.$atts['placement'].'" title="'.$title.'">'.$content.'</span>';
}
add_shortcode('tooltip', 'store_tooltip');

function store_popover($atts, $content = null){
	
	//[popover placement="top" title="tooltip title" trigger="click" content="tooltip title"] [/popover] 
	
	/* get the attribute */
	$atts = shortcode_atts(
		array(
		'placement'	=> 'top',
		'title'		=> '',
		'trigger'		=> 'click',
		'content'		=> ''
		),
		$atts,
		'popover'
	);
	
	/* return HTML */
	return '<span class="store-popover" data-toggle="popover" data-placement="'.$atts['placement'].'" title="'.$atts['title'].'" data-trigger="'.$atts['trigger'].'" data-content="'.$atts['content'].'">'.$content.'</span>';	
}
add_shortcode('popover', 'store_popover');


//Map Settings
function store_map_display ($atts, $content = null){
	
	//[store_map]
	
	//get the attributes
	$atts = shortcode_atts(
		array(),
		$atts,
		'store_map'
	);
	
	//return HTML
	ob_start();
	include get_template_directory().'/template-parts/partials/map.php';
	return ob_get_clean();
	
}
add_shortcode ('store_map', 'store_map_display');


//Optin Settings
function store_optin_form_generate ($atts, $content = null){
	
	//[cta_form]
	
	//get the attributes
	$atts = shortcode_atts(
		array(),
		$atts,
		'cta_form'
	);
	
	//return HTML
	if (!is_admin()):
		ob_start();
		include get_template_directory().'/template-parts/form-optin.php';
		return ob_get_clean();
	endif;

} 
$optinForm = get_option ('optin_form'); //activate optin shortcode
if(@$optinForm == 1){
add_shortcode ('cta_form', 'store_optin_form_generate');
}
	
//Popup Ads Settings
function store_popupads_display ($atts, $content = null){
	
	//[pop_ads size="small" slide="1"]
	
	//get the attributes
	$atts = shortcode_atts(
		array(
			'size'		=> 'small',
			'slide'	=> '1'
		),
		$atts,
		'pop_ads'
	);
	
	//return HTML
	ob_start();
	include get_template_directory().'/template-parts/partials/popads.php';
	return ob_get_clean();
	
}
add_shortcode ('pop_ads', 'store_popupads_display');


