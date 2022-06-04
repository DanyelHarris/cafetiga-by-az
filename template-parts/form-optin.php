<?php 
   /*@package Jombazar 
    - Optin form
   
	*/ 
?>

<form id="storeOptinForm" action="#" method="post" data-url = "<?php echo admin_url('admin-ajax.php'); ?>">
	
	<div class="col-xs-4" id="optName">
	
		<div class="form-group">
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" >
			<small class="text-danger form-control-msg">Your name is required.</small>
		</div>
		
	</div>
	
	<div class="col-xs-4" id="optEmail">
	
		<div class="form-group">
			<input type="email" class="form-control" id="email" name="email" placeholder="Email address" required="required" >
			<small class="text-danger form-control-msg">Your email is required.</small>
		</div>
		
	</div>
	
	<div class="col-xs-4" id="optSubmit">
		<button type="submit" id="input-submit">Submit</button>
		
		<small class="text-info form-control-msg js-form-submission">Submission in process, please wait...</small>
		
		<small class="text-success form-control-msg js-form-success">Form submitted. Thank you for subscribing.</small>
		
		<small class="text-danger form-control-msg js-form-error">Oops! There was a problem, please try again.</small>
	
	</div>
	
</form>