<?php 
   /*@package Jombazar 
    - Contact form
   
	*/ 
?>
	
<form id="storeContactForm" class="cf" action="#" method="post" data-url = "<?php echo admin_url('admin-ajax.php'); ?>">
	
	<div class="cf form-group">
		<input type="text" class="form-control" id="name" name="name" placeholder="Name">
		<small class="text-danger form-control-msg">Your name is required.</small>
	</div>
	
	<div class="cf form-group">
		<input type="email" class="form-control" id="email" name="email" placeholder="Email address">
		<small class="text-danger form-control-msg">Your email is required.</small>
	</div>
	
	<div class="cf form-group">
		<textarea name="message" class="form-control" id="message" placeholder="Message"></textarea>
		<small class="text-danger form-control-msg">Your message is required.</small>
	</div>  
	
	<button type="submit" id="input-submit">Submit</button>
	<small class="text-info form-control-msg js-form-submission">Submission in process, please wait...</small>
	<small class="text-success form-control-msg js-form-success">Message successfully submitted. Thank you.</small>
	<small class="text-danger form-control-msg js-form-error">Oops! There was a problem, please try again.</small>
	
</form>
