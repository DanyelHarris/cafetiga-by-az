<?php 
   /*@package Jombazar 
	   -Single Video Post
	*/ 
?>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
	<div class="row" id="singleblogMetawrap">
		<div class="col-xs-2">
			<div class="singleblogDate text-center"><strong><?php the_time('F j'); ?></strong></div>
		</div>
		
		<div class="col-xs-10">
			<div class="row" id="singleblogTitle">
				<?php the_title('<h2>', '</h2>'); ?>
			</div>
			<div class="row" id="singleblogMeta">
				<?php echo bzbr001_posted_meta(); ?>
			</div>
		</div>
	</div>
	
	<div class="row store-format-quote">
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
		
	</div>
	
</article>