<?php 
   /*@package Jombazar 
   -Testimony part
	*/ 
?>


<section id="carousel">  
	
	<?php
		// The Query
		$the_query = new WP_Query('bzbr001_cpt_review');
		// The Loop	
		if( $the_query->have_posts()  ) : $the_query->the_post();
		$reviewBg = esc_attr(get_option('review_bg')); 
	?>
					
	<div class="container-fluid text-center" style="background-image: url(<?php print $reviewBg ?>);" id="testparalax" data-stellar-background-ratio="0.5">		
					
		<?php endif;
					
			// Reset Post Data
			wp_reset_postdata();
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2" >
					<div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
					<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
					  <!-- Carousel indicators -->
					  <ol class="carousel-indicators">
						<li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#fade-quote-carousel" data-slide-to="1"></li>
						<li data-target="#fade-quote-carousel" data-slide-to="2"></li>
						<li data-target="#fade-quote-carousel" data-slide-to="3"></li>
						<li data-target="#fade-quote-carousel" data-slide-to="4"></li>
						<li data-target="#fade-quote-carousel" data-slide-to="5"></li>
					  </ol>
					  <!-- Carousel items -->
					  <div class="carousel-inner">
					  
					  <?php $sliders = get_posts(array(
							'post_type' 	=> 'bzbr001-reviews', 
							)); 
						?>
						<?php $count = 0; ?>
						<?php foreach($sliders as $slide): ?>
						
						<div class="<?php echo ($count == 0) ? 'active' : ''; ?> item">
							<div class="profile-circle">
								<?php
									$nb_stars = intval( get_post_meta(($slide->ID), 'rating_field', true ) );
									for ( $star_counter = 1; $star_counter <= 5; $star_counter++ ) {
										if ( $star_counter <= $nb_stars ) { ?>
										<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/good.png">
										<?php } else { ?>
										<img style="opacity:0.5; filter: alpha(opacity=50);" src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/bad.png">
										<?php }
									}
								?>
							</div>
							<blockquote>
								<p><?php echo get_post_meta(($slide->ID), 'review_field', true ); ?></p>
								<span class="client">- <?php echo get_post_meta(($slide->ID), 'review_by_field', true ); ?></span>
							</blockquote>	
						</div>
						
						<?php $count++; ?>
						<?php endforeach; ?>
						
					  </div>
					</div>
				</div>							
			</div>
		</div>
	</div>
</section>