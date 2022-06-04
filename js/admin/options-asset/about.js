jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-about-bg').on('click',function(e) {
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
			$('#about-bg').val(attachment.url);
			$('#about-bg-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-about-image').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove image?");
		if(answer == true){
			$('#about-bg').val('');
			$('.bzbr001-about-form').submit();
		}
		return;
	});
	
	
});