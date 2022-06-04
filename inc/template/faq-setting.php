<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======FAQ Settings=========*/
  
function cpt_faq_options(){
	echo 'Description in FAQ page.';
} 

function cpt_faq_background(){
	$faqBg = esc_attr(get_option('faq_bg'));
	if(empty($faqBg)){
		echo '<input type="button" value="Upload Image" id="upload-faq-bg"/> <input type="hidden" id="faq-bg" name="faq_bg" value="" /> ';		
	} else{
		echo '<input type="button" value="Replace Image" id="upload-faq-bg"/> <input type="hidden" id="faq-bg" name="faq_bg" value="'.$faqBg.'" /> <input type="button" value="Remove" id="remove-faq-image"/>';
	}
}

function cpt_faq_page_title(){
	$faqPage = esc_attr(get_option('faq_page_title'));
	echo '<input type="text" name="faq_page_title" id="faq_page_title" style="width:240px;" value="'.$faqPage.'" placeholder="Page Title"/>';
}

function cpt_faq_section_title(){
	$faqSection = esc_attr(get_option('faq_section_title'));
	echo '<input type="text" name="faq_section_title" id="faq_section_title" style="width:240px;" value="'.$faqSection.'" placeholder="Section Title"/>';
}

function cpt_faq_description(){
	$faqDes = esc_attr(get_option('faq_description')); 
	echo '<textarea rows="10" cols="60" name="faq_description" id="faq_description" value="'.$faqDes.'" placeholder="Description in FAQ page">'.$faqDes.'</textarea>';
 }


$faqBg = esc_attr(get_option('faq_bg')); 

?>

<!-- FRONT PAGE PREVIEW -->
<h1>FAQ PAGE SETTINGS </h1>

<table>
	<tbody>
		<tr>
			<td valign="top" style="padding-right: 20px;">
				<div class="cpt">
					<div class="aboutcontent"  id="faq-bg-preview"  style="background-image: url(<?php print $faqBg;?>); "></div>
				</div>
			</td>
			<td>
				<form method="post" action="options.php" class="bzbr001-faq-form">
					<?php settings_fields('bzbr001-cpt-faq'); ?>
					<?php do_settings_sections('cpt_faq'); ?>
					<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
				</form>
			</td>
		</tr>
	</tbody>
</table>
