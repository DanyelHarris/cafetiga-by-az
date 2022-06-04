jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-pic').on('click',function(e) {
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Store Picture',
			button: {
				text: 'Upload picture'
			},
			multiple: false
		});
		
		mediaUploader.on('select',function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#store-pic').val(attachment.url);
			$('#store-pic-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-picture').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove picture?");
		if(answer == true){
			$('#store-pic').val('');
			$('.bzbr001-general-form').submit();
		}
		return;
	});
	
	
});