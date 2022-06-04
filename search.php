<?php 
/* this is Search Result page
   @package Jombazar */
?>

<?php get_header(); ?>

<section class="main">
	<div class="container" style="padding-bottom:40px; ">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">
				<p><?php get_search_form(); ?></p>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row" >
			<div class="container" >
		
				<?php
												
					// The Loop
					if(have_posts()): 
						while (have_posts() ) : the_post();
							echo '<hr class="style18">';
							echo get_template_part('template-parts/post', get_post_format()); 
						endwhile;
					endif;
					
					// Reset Post Data
					wp_reset_postdata();

				?>
			
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>