<?php 
   /*@package Jombazar 
	   -Address part
	*/ 
?>

<?php
// The Query
$the_query = new WP_Query(array(
	'page'		=> 'bazahab_bzbr001',
));
		
$companyName = esc_attr(get_option('company_name'));
$unit = esc_attr(get_option('unit'));
$street1 = esc_attr(get_option('street_1'));
$street2 = esc_attr(get_option('street_2'));
$street = $street1.' '.$street2;
$zipcode = esc_attr(get_option('zipcode'));
$city = esc_attr(get_option('city'));
$state = esc_attr(get_option('state'));
$emailAdd = esc_attr(get_option('email_add'));
$phoneNo = esc_attr(get_option('phone_no'));
$mobileNo = esc_attr(get_option('mobile_no'));

if( $the_query->have_posts()  ) : $the_query->the_post();
?>

<address>
	<?php if(!empty($companyName)):?>
	<strong><?php print $companyName; ?></strong><br>
	<?php endif;
		if(!empty($unit)):?>
	<?php print $unit; ?> 
	<?php endif;
		if(!empty($street)):?>
	<?php print $street; ?><br>
	<?php endif;
	if(!empty($zipcode)):?>
	<?php print $zipcode; ?>
		<?php endif;
		if(!empty($city)):?>
	<?php print $city; ?>,
	<?php endif;
		if(!empty($state)):?>
	<?php print $state; ?><br>
	<?php endif;
		if(!empty($emailAdd)):?>
		<a href="mailto:<?php print $emailAdd; ?>"><?php print $emailAdd; ?></a>
	<?php endif; 
		if(!empty($phoneNo) && ( is_page_template( 'page-contact.php' ) )):?>
	<?php print '<br><br><abbr title="Phone">P:</abbr> '.$phoneNo; ?><br>
	<?php endif;
		if(!empty($mobileNo) && ( is_page_template( 'page-contact.php' ) )):?>
	<?php print '<abbr title="Mobile">HP:</abbr> '.$mobileNo; ?><br>
	<?php endif; ?>
</address>

<?php 
	endif;
	// Reset Post Data
	wp_reset_postdata();
?>