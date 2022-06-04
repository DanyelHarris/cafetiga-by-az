<?php 
   /*@package Jombazar 
   -Quote Post Formats
	*/ 
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-quote'); ?>>
	<section class="post-quote clearfix">

	<?php if (bzbr001_get_attachment()): ?>
		<div class="container-fluid" style="background-image: url('<?php echo bzbr001_get_attachment(); ?>');" id="wrapAll" data-stellar-background-ratio="0.5">
	<?php else: ?>
		<div class="container-fluid">
	<?php endif; ?>
	
			<div class="container-fluid text-center" id="paralaxText">
				<blockquote>
					<div class="row"><strong><?php the_excerpt(60); ?></strong></div>
					<div class="text-right">- <?php the_title (); ?> </div>
				</blockquote>
			</div>
			
		</div>
	</section>
</article>