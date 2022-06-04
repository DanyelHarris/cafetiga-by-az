<?php 
   /*@package Jombazar 
   -Menu Dishesh
	*/ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-quote'); ?>>
		
	<!-- Paralax -->
	<section class="post-quote">
		<div class="container-fluid" style="background-image: url('<?php echo bzbr001_get_attachment(); ?>')" id="wrapAll" data-stellar-background-ratio="0.5">
			<div class="container-fluid" id="dishesText">
				<h2><?php echo get_the_title(); ?></h2>
				<?php if (function_exists('my_breadcrumbs')) my_breadcrumbs(); ?>
			</div>
		</div>
	</section>
					
</article>
			