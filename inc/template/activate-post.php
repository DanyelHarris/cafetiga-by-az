<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>


<!-- PRINT OPTION -->


<!-- FRONT PAGE PREVIEW -->
<div class="wrap" id="postWrap">
	<h1>POST SETTINGS</h1>
	<form method="post" action="options.php" class="bzbr001-post-form">
	<?php settings_fields('bzbr001-post-group'); ?>
	<?php do_settings_sections('bzbr001_post'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
	</form>
</div>

<div class="">


<p>Apart from standard blog format, you can choose any formats to post your content. You also can choose which formats to display in your blog. 
<br>Some of these formats can be displayed in any page by slot in activated widget or use short-code.</p>

<p><strong>Here some tips on how you can use these formats:</strong></p>

<label>~ <strong>Aside post formats</strong> can be use to announce any promotion. Activate widget for pop-up ad.</label><br>
<label>~ <strong>Gallery post formats</strong> is for picture gallery page. There is an option to activate slider widget to display posted images. <br> It may be used as another input for slide presentation aside from built-in theme slide post.</label><br>
<label>~ <strong>Quote post formats</strong> will display any quotes sentence. Add featured image as background for paralax effect.</label><br>
<label>~ <strong>Status post formats</strong> will display any updated feed. Add this to any page widgets.</label><br>
<label>~ <strong>Image post formats</strong> is for individual image display.</label><br>
<label>~ <strong>Video post formats</strong> is for video gallery page.</label><br>
<label>~ <strong>Audio post formats</strong> is for audio gallery page.</label><br>
<label>~ <strong>Link post formats</strong> may be used to share any website links.</label><br><br>
</div>

	
