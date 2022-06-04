<?php
	
/* post options function
   @package Jombazar */ 

/*
	=================
	POST OPTIONS PAGE
	=================
*/

function bzbr001_add_post_page(){
		
	/* Post activation submenu */
	add_submenu_page('edit.php', 'Activate Post Options', 'Post Options', 'manage_options', 'bzbr001_post','bzbr001_post_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_post_settings');
	
}
add_action('admin_menu', 'bzbr001_add_post_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_post_settings(){
	
	//Post register settings
	register_setting('bzbr001-post-group', 'activate_post_formats', 'bzbr001_post_formats_callback');
	register_setting('bzbr001-post-group', 'activate_post_options', 'bzbr001_post_options_callback');
	register_setting('bzbr001-post-group', 'status_widget_field');
	register_setting('bzbr001-post-group', 'link_widget_field');
	register_setting('bzbr001-post-group', 'gallery_widget_field');
	register_setting('bzbr001-post-group', 'aside_widget_field');
	
	//Post Options
	add_settings_section('bzbr001-post-options', 'Activate and Deactivate Post options', 'bzbr001_post_options', 'bzbr001_post');
	add_settings_field('activate-post-formats','Apart from standard blog format, you can choose any formats to post your content. You may choose which formats to display in your blog as well.', 'bzbr001_activate_post_formats', 'bzbr001_post', 'bzbr001-post-options');
	add_settings_field('activate-widgets-field','Some of these formats can be displayed in any page by slot in activated widget or use short-code.', 'bzbr001_activate_widgets', 'bzbr001_post', 'bzbr001-post-options');
}

//THIS IS POST OPTIONS SECTION
function bzbr001_post_page(){
	require_once(get_template_directory().'/inc/template/activate-post.php');
}


/*=======Activate Post Options=========*/

function bzbr001_post_options(){
	echo'<td></td>';
}

function bzbr001_post_formats_callback($input){
	return $input;
}

function bzbr001_post_options_callback($inputs){
	return $inputs;
}

function bzbr001_activate_post_formats(){
	$options = get_option('activate_post_formats');
	$formats = array ('aside', 'gallery', 'quote', 'status', 'image', 'video', 'audio', 'link');
	$output = '';
	foreach ($formats as $format){
		$checked = (@$options[$format] == 1 ? 'checked' : '');
		$output .= '<td><div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="'.$format.'" name="activate_post_formats['.$format.']" value="1" '.$checked.'/><label for="'.$format.'">'.$format.'</label></div></td>'; 
	}
	echo 
	'<tr>
		<td>
			<table class="widefat">
				<thead>
					<label>Activate Post Formats</label>
				</thead>
				<tbody>
					<tr>
						'.$output.'
					</tr>
				</tbody>
			</table>
		</td>
	</tr>';

	$formats = get_option('activate_post_options');
	$terms = array ('post-format-aside', 'post-format-gallery', 'post-format-quote', 'post-format-status', 'post-format-image', 'post-format-video', 'post-format-audio', 'post-format-link');
	$new_keys = array( 
		'post-format-aside'=>'aside', 
		'post-format-gallery'=>'gallery', 
		'post-format-quote'=>'quote', 
		'post-format-status'=>'status', 
		'post-format-image'=>'image', 
		'post-format-video'=>'video', 
		'post-format-audio'=>'audio', 
		'post-format-link'=>'link', 
	);
	
	$outputs = '';
	foreach (array_combine($terms, $new_keys) as $term => $new_key) {
		$checked = (@$formats[$term] == 1 ? 'checked' : '');
		$outputs .= '<td><div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="'.$term.'" name="activate_post_options['.$term.']" value="1" '.$checked.'/><label for="'.$term.'">'.$new_key.'</label></div></td>'; 
	}
	
	echo 
	'<tr>
		<td>
			<table class="widefat">
				<thead>
					<label>Exclude any formats from display in blog</label>
				</thead>
				<tbody>
					<tr>
						'.$outputs.'
					</tr>
				</tbody>
			</table>
		</td>
	</tr>';
}


function bzbr001_activate_widgets(){
	$statusWidget = esc_attr(get_option('status_widget_field'));
	$checkedStatus = (@$statusWidget == 1 ? 'checked' : ''); 
	$activateStatus = '<div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="status_widget_field" name="status_widget_field" value="1" '.$checkedStatus.'/><label for="status_widget_field">Status</label></div>';
	$statementStatus = (@$statusWidget == 1 ?  '<br><br><span style="color:blue;">Activated!</span> Status widget now available. Slot in the widget <a href="widgets.php">here</a>.' : '' );
	
	$linkWidget = esc_attr(get_option('link_widget_field'));
	$checkedLink = (@$linkWidget == 1 ? 'checked' : ''); 
	$activateLink = '<div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="link_widget_field" name="link_widget_field" value="1" '.$checkedLink.'/><label for="link_widget_field">Links</label></div>';
	$statementLink = (@$linkWidget == 1 ? '<br><br><span style="color:blue;">Activated!</span> Links widget now available. Slot in the widget <a href="widgets.php">here</a>.' : '');
	
	$galleryWidget = esc_attr(get_option('gallery_widget_field'));
	$checkedGal = (@$galleryWidget == 1 ? 'checked' : ''); 
	$activateGal = '<div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="gallery_widget_field" name="gallery_widget_field" value="1" '.$checkedGal.'/><label for="gallery_widget_field">Gallery Slider</label></div>';
	$statementGal = (@$galleryWidget == 1 ? '<br><br><span style="color:blue;">Activated!</span> Gallery slider widget now available. Slot in the widget <a href="widgets.php">here</a>.' : '');
	
	$asideWidget = esc_attr(get_option('aside_widget_field'));
	$checkedAside = (@$asideWidget == 1 ? 'checked' : ''); 
	$activateAside = '<div class="stv-switch"><input class="stv-checkbox-switch" type = "checkbox" id="aside_widget_field" name="aside_widget_field" value="1" '.$checkedAside.'/><label for="aside_widget_field">Advertisement</label></div>';
	$statementAside = (@$asideWidget == 1 ? '<br><br><span style="color:blue;">Activated!</span>  Advertisement widget now available. Slot in the widget <a href="widgets.php">here</a>.' : '' );
	
	echo 
	'<tr>
		<td>
			<table class="widefat">
				<thead>
					<label>Activate Widgets</label>
				</thead>
				<tbody>
					<tr>
						<td>
						'.$activateStatus.$statementStatus.'
						</td>
					</tr>
					<tr>
						<td>
							'.$activateLink.$statementLink.'
						</td>
					</tr>
					<tr>
						<td>
						'.$activateGal.$statementGal.'
						</td>
					</tr>
					<tr>
						<td>
						'.$activateAside.$statementAside.'
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>';
}