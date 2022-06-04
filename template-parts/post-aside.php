<?php 
   /*@package Jombazar 
   -Aside Post Formats
	*/ 

	/* $class = get_query_var('post-class'); */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('store-format-aside', $class)); ?>>
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
</article>
