<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="bzbR001-general-form">
	<?php settings_fields('bzbr001-features-group'); ?>
	<?php do_settings_sections('bzbr001_features'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>