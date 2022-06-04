<?php 
   /*@package Jombazar 
   -Video Post Formats
	*/ 
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-video'); ?>>
	<section class="post-video clearfix">
		<div class="container-fluid" id="videoWrap">	
			<div class="row text-center" id="videoTitle">
				<?php the_title('<h2><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>
			</div>
			<div class="embed-responsive embed-responsive-16by9 text-center" id="videoContent">
				<?php echo bzbr001_get_embedded_media(array('video', 'iframe')); ?>
			</div>
			
			<div class="row" id="videoMeta">
				<div class="col-xs-8" >
					<?php echo bzbr001_posted_meta(); ?>
				</div>
				<div class="col-xs-4 text-right">
					<?php echo bzbr001_status_meta(); ?>
				</div>
			</div>
		</div>
	</section> 
</article>