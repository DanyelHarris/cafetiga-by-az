jQuery(document).ready(function($){
	
	var mediaUploader;
	
	$('#upload-button').on('click',function(e) {
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Company Logo',
			button: {
				text: 'Upload Logo'
			},
			multiple: false
		});
		
		mediaUploader.on('select',function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#company-logo').val(attachment.url);
			$('#company-logo-preview').css('background-image','url('+attachment.url+')');
		});
		mediaUploader.open();
	});
	
	$('#remove-logo').on('click',function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove logo?");
		if(answer == true){
			$('#company-logo').val('');
			$('.bzbr001-general-form').submit();
		}
		return;
	});
	
	
});