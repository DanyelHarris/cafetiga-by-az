<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======Menu Settings=========*/
  
function cpt_menu_options(){
	echo 'Description in menu page.';
} 

function cpt_menu_background(){
	$menuBg = esc_attr(get_option('menu_bg'));
	if(empty($menuBg)){
		echo '<input type="button" value="Upload Image" id="upload-menu-bg"/> <input type="hidden" id="menu-bg" name="menu_bg" value="" /> ';		
	} else{
		echo '<input type="button" value="Replace Image" id="upload-menu-bg"/> <input type="hidden" id="menu-bg" name="menu_bg" value="'.$menuBg.'" /> <input type="button" value="Remove" id="remove-menu-image"/>';
	}
}

function cpt_menu_page_title(){
	$menuPage = esc_attr(get_option('menu_page_title'));
	echo '<input type="text" name="menu_page_title" id="menu_page_title" style="width:240px;" value="'.$menuPage.'" placeholder="Page Title"/>';
}

function cpt_menu_section_title(){
	$menuSection = esc_attr(get_option('menu_section_title'));
	echo '<input type="text" name="menu_section_title" id="menu_section_title" style="width:240px;" value="'.$menuSection.'" placeholder="Section Title"/>';
}

function cpt_menu_description(){
	$menuDes = esc_attr(get_option('menu_description')); 
	echo '<textarea rows="10" cols="60" name="menu_description" id="menu_description" value="'.$menuDes.'" placeholder="Description in menu page">'.$menuDes.'</textarea>';
 }


$menuBg = esc_attr(get_option('menu_bg')); 

?>

<!-- FRONT PAGE PREVIEW -->
<h1>MENU PAGE SETTINGS </h1>

<table>
	<tbody>
		<tr>
			<td valign="top" style="padding-right: 20px;">
				<div class="cpt">
					<div class="aboutcontent"  id="menu-bg-preview"  style="background-image: url(<?php print $menuBg;?>); "></div>
				</div>
			</td>
			<td>
				<form method="post" action="options.php" class="bzbr001-menu-form">
					<?php settings_fields('bzbr001-cpt-menu'); ?>
					<?php do_settings_sections('cpt_menu'); ?>
					<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
				</form>
			</td>
		</tr>
	</tbody>
</table>
