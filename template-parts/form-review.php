<?php 
   /*@package Jombazar 
    - Review form
   
	*/ 
?>

<form id="storeReviewForm" action="#" method="post" data-url = "<?php echo admin_url('admin-ajax.php'); ?>">
	
	<div class="form-group">
		<input type="text" class="form-control" id="title" name="title" placeholder="Subject">
		<small class="text-danger form-control-msg">Required.</small>
	</div>
	
	<div class="form-group">
		<select id="rating" name="rating">
		<?php for ( $rating = 5; $rating >= 1; $rating -- ) {	?>
			<option value="<?php echo $rating; ?>" <?php echo selected( $rating, $value['rating_field'][0] ); ?>>
			<?php echo $rating; ?> stars <?php } ?>
		</select>
	</div>
	
	<div class="form-group">
		<textarea name="text" class="form-control" id="reviews" placeholder="Your reviews"></textarea>
		<small class="text-danger form-control-msg">Your reviews is appreciated.</small>
	</div> 
	
	<div class="form-group">
		<input type="text" class="form-control" id="name" name="name" placeholder="Name">
		<small class="text-danger form-control-msg">Your name is required.</small>
	</div>
	
	<div class="form-group">
		<input type="email" class="form-control" id="email" name="email" placeholder="Email address">
		<small class="text-danger form-control-msg">Your email is required.</small>
	</div>

	<button type="submit" id="input-submit">Submit</button>
	<small class="text-info form-control-msg js-form-submission">Submission in process, please wait...</small>
	<small class="text-success form-control-msg js-form-success">Reviews successfully submitted. Thank you.</small>
	<small class="text-danger form-control-msg js-form-error">Oops! There was a problem, please try again.</small>
	
</form>