<?php 
   /*@package Jombazar 
	   -Single Standard Post
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
	
	<?php if(has_post_thumbnail()): ?>
	<div class="row">
		<div class="col-xs-12" id="singleblogPic" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id()); ?>);"></div>
	</div>
	<?php endif; ?>
	
	<div class="row">
		<div class="col-xs-12" id="singleContent">
			<?php echo the_content(); ?>
		</div>
	</div>
	
</article>