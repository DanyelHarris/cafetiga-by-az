jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-faq-bg').on('click',function(e) {
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
			$('#faq-bg').val(attachment.url);
			$('#faq-bg-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-faq-image').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove image?");
		if(answer == true){
			$('#faq-bg').val('');
			$('.bzbr001-faq-form').submit();
		}
		return;
	});
	
	
});