jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-bg').on('click',function(e) {
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Background Image',
			button: {
				text: 'Upload image'
			},
			multiple: false
		});
		
		mediaUploader.on('select',function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#map-bg').val(attachment.url);
			$('#map-bg-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-image').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove image?");
		if(answer == true){
			$('#map-bg').val('');
			$('.bzbr001-map-form').submit();
		}
		return;
	});
	
	/* Map position */
	$(document).on('click', '[name="map_position_field"]', function () {
		var position = ($('input[name="map_position_field"]:checked').attr('value'));
		$('#map-bg-preview').css('align-items', position);
		$('#map-bg-preview').css('justify-content', position);
	});
	
	/* Map size */
	$(document).on('click', '[name="map_size_field"]', function () {
		var mapSize = ($('input[name="map_size_field"]:checked').attr('value'));
		
		if (mapSize === 'small'){
			var width = '400px'
			var height = '300px'
		} else if (mapSize === 'medium'){
			var width = '600px'
			var height = '450px'
		}
		else if (mapSize === 'large'){
			var width = '800px'
			var height = '600px'
		}
		else if (mapSize === 'full'){
			var width = '100%'
			var height = '600px'
		}
		
		$('#map-bg-preview iframe').css('width', width);
		$('#map-bg-preview iframe').css('height', height);
	});
	
	/* Map Shadow */
	$('#map_shadow_field').click(function(){
		if($(this).is(':checked')){
			var mapShadow = $('input[name="map_shadow_field"]').val();
		} 
		
		if (mapShadow === 'shadow'){
			var webkit_box_shadow = '0px 0px 13px 1px rgba(0,0,0,0.75)'
			var moz_box_shadow = '0px 0px 13px 1px rgba(0,0,0,0.75)'
			var ms_box_shadow = '0px 0px 13px 1px rgba(0,0,0,0.75)'
			var o_box_shadow = '0px 0px 13px 1px rgba(0,0,0,0.75)'
			var box_shadow = '0px 0px 13px 1px rgba(0,0,0,0.75)'		
		} 
		else {
			var webkit_box_shadow = '0px 0px 0px 0px rgba(0,0,0,0)'
			var moz_box_shadow = '0px 0px 0px 0px rgba(0,0,0,0)'
			var ms_box_shadow = '0px 0px 0px 0px rgba(0,0,0,0)'
			var o_box_shadow = '0px 0px 0px 0px rgba(0,0,0,0)'
			var box_shadow = '0px 0px 0px 0px rgba(0,0,0,0)'	
		}
			
		$('#map-bg-preview iframe').css('-webkit-box-shadow', webkit_box_shadow);
		$('#map-bg-preview iframe').css('-moz-box-shadow', moz_box_shadow);
		$('#map-bg-preview iframe').css('border-radius', ms_box_shadow);
		$('#map-bg-preview iframe').css('-ms-box-shadow', o_box_shadow);
		$('#map-bg-preview iframe').css('box-shadow', box_shadow);	
	});

	/* Map edge */
	$('#map_curve_field').click(function(){
		if($(this).is(':checked')){
			var mapCurve = $('input[name="map_curve_field"]').val();
		} 
		
		if (mapCurve === 'curve'){var border_radius = '15px'} 
		else {var border_radius = '0'}
			
		$('#map-bg-preview iframe').css('border-radius', border_radius);	
	});
	
});