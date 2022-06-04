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
	
	<div class="row store-format-image">
		<section class="post-image">
			<div class="container-fluid" id="imageWrap">				
				<?php if (bzbr001_get_attachment()): ?>
				<div class="row" id="imgPic" style="background-image: url(<?php echo bzbr001_get_attachment(); ?>); margin-left:0;" ></div>
				<?php endif; ?>
				<div class="row" id="imgContent"><?php echo the_content (); ?>	</div>
			</div>
		</section>
	</div>
	
</article>