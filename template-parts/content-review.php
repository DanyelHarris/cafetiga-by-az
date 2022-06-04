<?php 
   /*@package Jombazar 
   - Reviews
	*/ 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	$review = get_post_meta( get_the_ID(), 'review_field', true );
	$by = esc_html( get_post_meta( get_the_ID(), 'review_by_field', true ));
	$nb_stars = intval( get_post_meta(get_the_ID(), 'rating_field', true ));
	$reply = get_post_meta(get_the_ID(), 'admin_response_field', true );
	$companyName = esc_attr(get_option('company_name'));
	?>
	
	<div class="container" id="reviewBox">
	
		<div class="row" id="reviewStar">
			<?php
				for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
					if ( $star_counter <= $nb_stars ) { ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/good.png">
					<?php 
					} else { ?>
						<img style="opacity:0.5; filter: alpha(opacity=50);" src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/bad.png">
					<?php 
					}
				}
			?>
		</div>
		
		<div class="row" id="reviewTitle"><?php echo get_the_title(); ?></div>
		
		<div class="row" id="reviewContent"><?php echo $review ?></div>
		
		<div class="row" id="reviewBy"><?php echo '- '.$by ?></div>
		
		<div class="row" id="reviewDate"><?php echo get_the_date(); ?></div>
		
		<?php if($reply) : ?>
		<div class="row" id="reviewReply"><?php echo $reply ?></div>
		<div class="row" id="reviewOwner"><?php echo '~ '.$companyName ?></div>
		<?php endif ?>
		
	</div>
	
</div>