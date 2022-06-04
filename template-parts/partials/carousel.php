<?php 
   /*@package Jombazar 
   -Gallery Post Formats Slider
	*/ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('store-gallery'); ?>>
	<section class="pic-gallery clearfix">
		<div class="container-fluid" id="picWrap">	

			<?php if (bzbr001_get_attachment()): 	?>
	
			<div id="post-gallery-<?php the_ID(); ?>" class="carousel slide store-carousel-thumb" data-ride="carousel" >
				
				<div class="carousel-inner" role="listbox">
				
					<?php 
					$attachments = bzbr001_get_bs_slides(bzbr001_get_attachment(7));
					foreach($attachments as $attachment):
					?>
					
					<div class="item <?php echo $attachment['class']; ?> background-image standard-featured" style="background-image:url(<?php echo $attachment['url']; ?>);">
					
						<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img'] ?>"></div>
						
						<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img'] ?>"></div>
						
						<div class="galleryText text-center">
							<?php echo $attachment['caption']; ?>
						</div>
					</div>
					
					<?php endforeach; ?>
					
				</div>
				
				<!-- Left Control -->
				<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="fa fa-angle-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</div>
						</div>
					</div>
				</a>

				<!-- Right Control -->
				<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="fa fa-angle-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</div>
						</div>
					</div>
				</a>
			
			</div>
			<?php endif; ?>
				
		</div>
	</section>
</article>