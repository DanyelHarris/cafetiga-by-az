<?php 
   /*@package Jombazar 
   -Image Post Formats
	*/ 
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-image'); ?>>
	
	<section class="post-image clearfix">
		<div class="container-fluid" id="imageWrap">				
			<?php if (bzbr001_get_attachment()): ?>
			<div class="row" id="imgPic" style="background-image: url(<?php echo bzbr001_get_attachment(); ?>); margin-left:0;" ></div>
			<?php endif; ?>
			<div class="row">
				<div class="col-xs-3">
					<?php echo bzbr001_image_meta(); ?>
				</div>
				<div class="col-xs-9">
					<div class="row" id="imgTitle">
						<?php the_title('<h2><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>
					</div>
					<div class="row" id="imgContent"><?php echo the_excerpt (); ?>	</div>
				</div>
			</div>
		</div>
	</section> 
	
</article>


