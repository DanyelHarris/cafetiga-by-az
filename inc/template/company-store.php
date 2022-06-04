<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======Store Information=========*/
  
function bzbr001_store_options(){
	echo'Picture for store listing display';
}

function bzbr001_store_picture(){
	$storePic = esc_attr(get_option('store_pic'));
	if(empty($storePic)){
	
		echo 
		
		'<input type="button" value="Upload Store Picture" id="upload-pic"/> 
		
		<input type="hidden" id="store-pic" name="store_pic" value="" /> ';
		
	} 	else{
	
		echo 
		'<input type="button" value="Replace Store Picture" id="upload-pic"/> 
		
		<input type="hidden" id="store-pic" name="store_pic" value="'.$storePic.'" /> 
		
		<input type="button" value="Remove" id="remove-picture"/>';
	}
}

function bzbr001_store_category(){
	$storeCat = esc_attr(get_option('store_cat'));
	echo '<input type="text" name="store_cat" style="width:240px;" value="'.$storeCat.'" placeholder="Store Category"/>';
}

function bzbr001_store_site(){
	$storeSite = esc_attr(get_option('store_site'));
	echo 'http://www.<input type="text" name="store_site" value="'.$storeSite.'" placeholder="Store Category"/>';
}

	$storePic = esc_attr(get_option('store_pic'));
	$storeCat = esc_attr(get_option('store_cat'));
	$storeSite = esc_attr(get_option('store_site'));
	$companyName = esc_attr(get_option('company_name'));
	$city = esc_attr(get_option('city'));
	$state = esc_attr(get_option('state'));
	$country = esc_attr(get_option('country'));
	$emailAdd = esc_attr(get_option('email_add'));
	$phoneNo = esc_attr(get_option('phone_no'));
	$mobileNo = esc_attr(get_option('mobile_no'));
?>

<!-- FRONT PAGE PREVIEW -->

	<div class="row" id="polaroid">
		<a href="http://www.<?php print $storeSite;?>" target="_blank">
		  <figure>
			<div id="store-pic-preview" class="store-pic" style="background-image:url(<?php print $storePic;?>);"></div>
			<figcaption><?php print $storeCat;?></figcaption>
		  </figure>
		</a>
	</div>

	<div class="row" id="storedetail">
		<h1><?php print $companyName; ?></h1>
		<address>
		<?php if(!empty($city)):?>
		<?php print $city; ?>, 
		<?php endif; ?>
		<?php print $state; ?><br>
		<?php print $country; ?><br>
		<?php if(!empty($phoneNo)):?>
		<abbr title="Phone">P:</abbr> <?php print $phoneNo; ?><br>
		<?php endif;
		if(!empty($mobileNo)):?>
		<abbr title="Mobile">HP:</abbr> <?php print $mobileNo; ?><br>
		<?php endif; ?>
		<a href="mailto:<?php print $emailAdd; ?>"><?php print $emailAdd; ?></a>
		</address>
	</div>



<h1>STORE DETAILS </h1>
<form method="post" action="options.php" class="bzbr001-general-form">
	<?php settings_fields('bzbr001-store-group'); ?>
	<?php do_settings_sections('bzbr001_store'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>
