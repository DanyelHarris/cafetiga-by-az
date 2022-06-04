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
	
	<div class="row">
		<div class="col-xs-12" id="videoContent">
			<div class="embed-responsive embed-responsive-16by9 text-center">
				<?php echo bzbr001_get_embedded_media(array('video', 'iframe')); ?>
			</div>
		</div>
	</div>
	
</article>