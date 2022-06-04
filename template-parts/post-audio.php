<?php 
   /*@package Jombazar 
   -Audio Post Formats
	*/ 
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-audio'); ?>>
	<section class="post-audio clearfix">
	
		<div class="container-fluid" id="audioWrap"> 
		
			<div class="row text-center" id="audioTitle">
				<?php the_title('<h2><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>
			</div>	
			
			<div class="row" id="audioMeta"><?php echo bzbr001_posted_meta(); ?></div>
				
			<div class="row" id="audioContent">
				<?php echo bzbr001_get_embedded_media(array('audio', 'iframe')); ?>
			</div>
			
		</div>
		
		<div class="container-fluid" id="audioFooter"><?php echo bzbr001_status_meta(); ?></div>

	</section> 
</article>

