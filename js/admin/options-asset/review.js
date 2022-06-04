jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-review-bg').on('click',function(e) {
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
			$('#review-bg').val(attachment.url);
			$('#review-bg-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-review-image').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove image?");
		if(answer == true){
			$('#review-bg').val('');
			$('.bzbr001-review-form').submit();
		}
		return;
	});
	
	
});