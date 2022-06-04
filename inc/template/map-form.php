<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<?php 
/*=======Map Information=========*/
function bzbr001_map_options(){
	echo 'Please include <strong>shortcode</strong> <code>[store_map]</code> in page posting field.';
} 

function bzbr001_map_iframe(){
	$mapIframe = esc_attr(get_option('map_iframe_field')); 
	echo '<textarea rows="7" cols="80" name="map_iframe_field" id="map_iframe_field" value="'.$mapIframe.'" placeholder="Google Maps Iframe Tag">'.$mapIframe.'</textarea>';
}

function bzbr001_map_position(){
	$mapPosition = esc_attr(get_option('map_position_field')); ?>
	
	<fieldset id="mapPos">
		<input class="map_position_field" type="radio" name="map_position_field" id="item-1" value="flex-start"<?php checked( 'flex-start' == $mapPosition); ?> />  
		<label class="radio-inline__label" for="item-1">
		  <div class="align_left"></div>
		  <span>Left</span>
		</label>

		<input class="map_position_field" type="radio" name="map_position_field" id="item-2" value="center"<?php checked( 'center' == $mapPosition); ?> /> 
		<label class="radio-inline__label" for="item-2">
		  <div class="align_center"></div>
		  <span>Center</span>
		</label>

		<input class="map_position_field" type="radio" name="map_position_field" id="item-3" value="flex-end"<?php checked( 'flex-end' == $mapPosition); ?> />  
		<label class="radio-inline__label" for="item-3">
		  <div class="align_right"></div>
		  <span>Right</span>
		</label>
	</fieldset>
<?php }

function bzbr001_map_size(){
	$mapSize = esc_attr(get_option('map_size_field')); ?>
	<div class="letter-slider">
		<input type="radio" name="map_size_field" id="switch-1" value="small"<?php checked( 'small' == $mapSize); ?> /> 
		<label for="switch-1" data-label="">Small</label>

		<input type="radio" name="map_size_field" id="switch-2" value="medium"<?php checked( 'medium' == $mapSize); ?> /> 
		<label for="switch-2" data-label=" ">Medium</label>
		
		<input type="radio" name="map_size_field" id="switch-3" value="large"<?php checked( 'large' == $mapSize); ?> /> 
		<label for="switch-3" data-label="">Large</label>
		
		<input type="radio" name="map_size_field" id="switch-4" value="full"<?php checked( 'full' == $mapSize); ?> /> 
		<label for="switch-4" data-label="">Full</label>
	</div>
<?php }

function bzbr001_map_border_style(){
	$mapShadow = esc_attr(get_option('map_shadow_field'));
	$checkedShadow = (@$mapShadow == 'shadow' ? 'checked' : ''); 
	$mapCurve = esc_attr(get_option('map_curve_field')); 
	$checkedCurve = (@$mapCurve == 'curve' ? 'checked' : '');
	
	echo 
	'<div class="roundedOne">
	
		<input type = "checkbox" class="switch" id="map_shadow_field" name="map_shadow_field" value="shadow" '.$checkedShadow.'/> 
		<label for="map_shadow_field"></label>Shadow
		
		<input type = "checkbox" class="switch" id="map_curve_field" name="map_curve_field" value="curve" '.$checkedCurve.'/> 
		<label for="map_curve_field"></label>Curve
		
	</div>';
}

function bzbr001_map_background(){
	$mapBg = esc_attr(get_option('map_bg_field'));
	
	if(empty($mapBg)){
	
		echo '<input class="mapButton" type="button" value="Upload Image" id="upload-bg"/> <input type="hidden" id="map-bg" name="map_bg_field" value="" /> ';
		
	} else {
	
		echo '<input class="mapButton" type="button" value="Replace Image" id="upload-bg"/> <input type="hidden" id="map-bg" name="map_bg_field" value="'.$mapBg.'" /> 
		<input class="mapButton" type="button" value="Remove" id="remove-image"/>';
	}
}

function bzbr001_map_background_paralax(){
	$mapParalax = esc_attr(get_option('map_paralax_field'));
	$checked = (@$mapParalax == 'paralax' ? 'checked' : ''); 
	
	echo 
	'<div class="roundedOne">
		<input type = "checkbox" class="switch" id="map_paralax_field" name="map_paralax_field" value="paralax" '.$checked.'/> 
		<label for="map_paralax_field"></label>Activate
	</div>';
	
	if ( $mapParalax === 'paralax' ): echo '<p><strong><small><span style="color:blue;">Activated!</span></strong> Please reload site page to see the effects.</small></p>'; else: echo ''; endif;
}

function bzbr001_map_widget(){
	$mapWidget = esc_attr(get_option('map_widget_field'));
	$checked = (@$mapWidget == 1 ? 'checked' : ''); 
	
	echo 
	'<div class="roundedOne">
		<input type = "checkbox" class="switch" id="map_widget_field" name="map_widget_field" value="1" '.$checked.'/> 
		<label for="map_widget_field"></label>Activate
	</div>';
	
	if ( $mapWidget === '1' ): echo '<p><strong><small><span style="color:blue;">Activated!</span></strong> Location widget now available. Slot in the widget <a href="widgets.php">here</a>.'; else: echo ''; endif;
}

?>


<!-- FRONT PAGE PREVIEW -->
<?php 
$mapPosition = esc_attr(get_option('map_position_field'));
$mapSize = esc_attr(get_option('map_size_field'));
$mapShadow = esc_attr(get_option('map_shadow_field'));
$mapCurve = esc_attr(get_option('map_curve_field'));
$mapBg = esc_attr(get_option('map_bg_field'));
$mapIframe = get_option('map_iframe_field'); 
bzbr001_map_display();
?>

<div class="wrap container-fluid" id="map-bg-preview" >
	<?php print $mapIframe; ?>
</div>
	
<h1>STORE LOCATION </h1>
<form method="post" action="options.php" class="bzbr001-map-form">
	<?php settings_fields('bzbr001-map-group'); ?>
	<?php do_settings_sections('bzbr001_map'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>



