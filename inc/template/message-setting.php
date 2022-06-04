<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======review Settings=========*/
  
function cpt_contact_options(){
	echo 'Fill in the message to respond automatically to person that send a message through contact form.';
} 


function cpt_autorespond_message(){
	$autoMsg = esc_attr(get_option('autorespond_message')); 
	echo '<textarea rows="10" cols="60" name="autorespond_message" id="autorespond_message" value="'.$autoMsg.'" placeholder="Autorespond Messages">'.$autoMsg.'</textarea>';
 }

?>

<!-- FRONT PAGE PREVIEW -->
<h1>AUTORESPONDER MESSAGE SETTINGS </h1>

<form method="post" action="options.php" class="bzbr001-contact-form">
	<?php settings_fields('bzbr001-cpt-contact'); ?>
	<?php do_settings_sections('cpt_contact'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>
