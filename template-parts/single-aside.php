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
	
	<div class="row store-format-aside">
		<section class="post-aside clearfix">
			<div class="container-fluid" id="asideWrap">

				<div class="row" id="asideBg" <?php if(has_post_thumbnail()): echo 'style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id()).');"'; endif; ?>>
						
					<div class="col-xs-12" id="asideContent" >
						<div class="row">
							<?php echo the_content(); ?>
						</div>
					</div>
				
				</div>
					
			</div>	
		</section> 
	</div>
	
</article>