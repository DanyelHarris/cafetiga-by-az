<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======review Settings=========*/
  
function cpt_review_options(){
	echo 'Description in reviews page.';
} 

function cpt_review_background(){
	$reviewBg = esc_attr(get_option('review_bg'));
	if(empty($reviewBg)){
		echo '<input type="button" value="Upload Image" id="upload-review-bg"/> <input type="hidden" id="review-bg" name="review_bg" value="" /> ';		
	} else{
		echo '<input type="button" value="Replace Image" id="upload-review-bg"/> <input type="hidden" id="review-bg" name="review_bg" value="'.$reviewBg.'" /> <input type="button" value="Remove" id="remove-review-image"/>';
	}
}

function cpt_review_page_title(){
	$reviewPage = esc_attr(get_option('review_page_title'));
	echo '<input type="text" name="review_page_title" id="review_page_title" style="width:240px;" value="'.$reviewPage.'" placeholder="Page Title"/>';
}

function cpt_review_section_title(){
	$reviewSection = esc_attr(get_option('review_section_title'));
	echo '<input type="text" name="review_section_title" id="review_section_title" style="width:240px;" value="'.$reviewSection.'" placeholder="Section Title"/>';
}

function cpt_review_description(){
	$reviewDes = esc_attr(get_option('review_description')); 
	echo '<textarea rows="5" cols="60" name="review_description" id="review_description" value="'.$reviewDes.'" placeholder="Description in review page">'.$reviewDes.'</textarea>';
 }
 
function cpt_review_autorespond(){
	$reviewAuto = esc_attr(get_option('review_autorespond')); 
	echo '<textarea rows="5" cols="60" name="review_autorespond" id="review_autorespond" value="'.$reviewAuto.'" placeholder="Autorespond Message for Reviewers">'.$reviewAuto.'</textarea>';
 }
 
function cpt_review_widget(){
	$revWidget = esc_attr(get_option('review_widget'));
	$checked = (@$revWidget == 1 ? 'checked' : ''); 
	echo '<label><input type = "checkbox" id="review_widget" name="review_widget" value="1" '.$checked.'/> Activate.</label>';
	if ( $revWidget === '1' ): echo '<p><label><span style="color:blue;">Activated!</span> Location widget now available. Slot in the widget <a href="widgets.php">here</a>.</label></p>'; else: echo ''; endif;
}
 

$reviewBg = esc_attr(get_option('review_bg')); 

?>

<!-- FRONT PAGE PREVIEW -->
<h1>REVIEWS PAGE SETTINGS </h1>

<table>
	<tbody>
		<tr>
			<td valign="top" style="padding-right: 20px;">
				<div class="cpt">
					<div class="aboutcontent"  id="review-bg-preview"  style="background-image: url(<?php print $reviewBg;?>); "></div>
				</div>
			</td>
			<td>
				<form method="post" action="options.php" class="bzbr001-review-form">
					<?php settings_fields('bzbr001-cpt-review'); ?>
					<?php do_settings_sections('cpt_review'); ?>
					<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
				</form>
			</td>
		</tr>
	</tbody>
</table>
