<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
	$companyLogo = esc_attr(get_option('company_logo'));
	$companyName = esc_attr(get_option('company_name'));
	$companyRegistry = esc_attr(get_option('company_registry'));
	$firstName = esc_attr(get_option('first_name'));
	$lastName = esc_attr(get_option('last_name'));
	$fullName = $firstName.' '.$lastName;
	$unit = esc_attr(get_option('unit'));
	$street1 = esc_attr(get_option('street_1'));
	$street2 = esc_attr(get_option('street_2'));
	$street = $street1.' '.$street2;
	$zipcode = esc_attr(get_option('zipcode'));
	$city = esc_attr(get_option('city'));
	$state = esc_attr(get_option('state'));
	$country = esc_attr(get_option('country'));
	$twitterID = esc_attr(get_option('twitter_id'));
	$facebookID = esc_attr(get_option('facebook_id'));
	$linkedinID = esc_attr(get_option('linkedin_id'));
	$instagramID = esc_attr(get_option('instagram_id'));
	$emailAdd = esc_attr(get_option('email_add'));
	$phoneNo = esc_attr(get_option('phone_no'));
	$mobileNo = esc_attr(get_option('mobile_no'));

?>


<!-- FRONT PAGE PREVIEW -->
<div class="container" id="wrap">
	<div class="col-xs-6" id="logowrap">
		<div class="row">
			<div id="company-logo-preview" class="company-logo" style="background-image:url(<?php print $companyLogo;?>);"></div>
		</div>
	</div>
	<div class="col-xs-6" id="detailwrap">
		<div class="row">
			<h1><?php print $companyName; ?></h1>
		
				<address>
					<strong><?php print $companyRegistry; ?></strong><br>
					<?php print $unit; ?> <?php print $street; ?><br>
					<?php if(!empty($city)):?>
					<?php print $city; ?>, 
					<?php endif; ?>
					<?php print $zipcode; ?><br>
					<?php if(!empty($country)):?>
					<?php print $country; ?>, 
					<?php endif; ?>
					<?php print $state; ?><br>
					<?php if(!empty($phoneNo)):?>
					<abbr title="Phone">P:</abbr> <?php print $phoneNo; ?><br>
					<?php endif;
					if(!empty($mobileNo)):?>
					<abbr title="Mobile">HP:</abbr> <?php print $mobileNo; ?>
					<?php endif; ?>
				</address>

				<address>
					<strong><?php print $fullName; ?></strong><br>
					<a href="mailto:<?php print $emailAdd; ?>"><?php print $emailAdd; ?></a>
				</address>
			
			<ul class="header-social-icons social-icons hidden-xs">
				<?php if(!empty($facebookID)):?>
					<li class="social-icons-facebook"><a href="http://www.facebook.com/<?php print $facebookID; ?>" target="_blank" title="Facebook"><i class="fa fa-facebook"></a></i></li>
				<?php endif;
				if(!empty($twitterID)):?>
					<li class="social-icons-twitter"><a href="http://www.twitter.com/<?php print $twitterID; ?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
				<?php endif;
				if(!empty($instagramID)):?>
					<li class="social-icons-twitter"><a href="http://www.instagram.com/<?php print $instagramID; ?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
				<?php endif;
				if(!empty($linkedinID)):?>
					<li class="social-icons-linkedin"><a href="http://www.linkedin.com/<?php print $linkedinID; ?>" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<div class="container">
<h1>COMPANY DETAILS </h1>
	<form method="post" action="options.php" class="bzbr001-general-form">
		<?php settings_fields('bzbr001-settings-group'); ?>
		<?php do_settings_sections('bzbr001_company'); ?>
		<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
	</form>
</div>