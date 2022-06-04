<?php 
   /*@package Jombazar 
    - Contact form
	   Template Name: Contact
   
	*/ 
?>
<?php get_header(); ?>

<section>
	<div class="container" id="headContact">
		<?php the_content(); ?>
	</div>
</section>
<section>
	<div class="container main">
		<div class="row">

			<div class="col-xs-6 col-xs-offset-1" id="contactForm">
				
				 <?php get_template_part('template-parts/form', 'contact'); ?>

			</div>
			<div class="col-xs-5 " id="address">
				<?php get_template_part('template-parts/partials/address'); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>