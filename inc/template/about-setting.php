<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======About Settings=========*/
  
function cpt_about_options(){
	echo 'Description in about page.';
} 

function cpt_about_background(){
	$aboutBg = esc_attr(get_option('about_bg'));
	if(empty($aboutBg)){
		echo '<input type="button" value="Upload Image" id="upload-about-bg"/> <input type="hidden" id="about-bg" name="about_bg" value="" /> ';		
	} else{
		echo '<input type="button" value="Replace Image" id="upload-about-bg"/> <input type="hidden" id="about-bg" name="about_bg" value="'.$aboutBg.'" /> <input type="button" value="Remove" id="remove-about-image"/>';
	}
}

function cpt_about_page_title(){
	$aboutPage = esc_attr(get_option('about_page_title'));
	echo '<input type="text" name="about_page_title" id="about_page_title" style="width:240px;" value="'.$aboutPage.'" placeholder="Page Title"/>';
}

function cpt_about_section_title(){
	$aboutSection = esc_attr(get_option('about_section_title'));
	echo '<input type="text" name="about_section_title" id="about_section_title" style="width:240px;" value="'.$aboutSection.'" placeholder="Section Title"/>';
}

function cpt_about_description(){
	$aboutDes = esc_attr(get_option('about_description')); 
	echo '<textarea rows="10" cols="60" name="about_description" id="about_description" value="'.$aboutDes.'" placeholder="Description in about page">'.$aboutDes.'</textarea>';
 }


$aboutBg = esc_attr(get_option('about_bg')); 

?>

<!-- FRONT PAGE PREVIEW -->
<h1>ABOUT PAGE SETTINGS </h1>

<table>
	<tbody>
		<tr>
			<td valign="top" style="padding-right: 20px;">
				<div class="cpt">
					<div class="aboutcontent"  id="about-bg-preview"  style="background-image: url(<?php print $aboutBg;?>); "></div>
				</div>
			</td>
			<td>
				<form method="post" action="options.php" class="bzbr001-about-form">
					<?php settings_fields('bzbr001-cpt-about'); ?>
					<?php do_settings_sections('cpt_about'); ?>
					<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
				</form>
			</td>
		</tr>
	</tbody>
</table>
