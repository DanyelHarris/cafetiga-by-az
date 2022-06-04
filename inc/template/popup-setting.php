<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>


<!-- PRINT OPTION -->
<div class="wrap" id="popSet">
	<div class="clearboth">
		<div class="divTableCell">
			<span> <img src="<?php bloginfo('stylesheet_directory'); ?>/img/admin/advers.png" /></span>
		</div>
		<div class="divTableCell" id="adsTitle">
			<h1><?php _e('POP-UP ADS SETTINGS' , 'cafesatu') ?></h1>
		</div>
	</div>
</div>

<!-- FRONT PAGE PREVIEW -->

<form method="post" action="options.php" class="bzbr001-adset-form" onsubmit="showHide(); return false;">
	
<?php if( isset($_GET['settings-updated']) ) { ?>
	<div id="adscontent" class="pickbtn is-dismissible">
		<?php $popupSize = esc_attr(get_option('popup_size')); ?>
		<?php $popupPerpage = esc_attr(get_option('popup_perpage')); ?>
	
		<span class="block-info"><code>[pop_ads size="<?php echo $popupSize ?>" slide="<?php echo $popupPerpage ?>"]</code></span>
		<span class="text-success"> Please use this code in your posts or text widget. You may also click a button provided above the editor to insert the code.</span> 
		<span class="text-warning"> Remember! Do not insert this code inside aside-post-format posts.</span> 
	</div>
<?php } 

	settings_fields('bzbr001-popup-settings'); 
	do_settings_sections('bzbr001_popup'); 
	submit_button('Create Pop-up', 'button', 'btnSubmit'); 
?>
</form>
