<?php 
/*@package Jombazar 
-Taxonomy Gallery
*/ 
?>

<div id="carouselGal">
  <figure id="spinner">
  
	<?php  $gallery = new WP_Query( array(
				'tax_query' => array(
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-gallery'),
				))
			));  

			if($gallery->have_posts()): while ( $gallery->have_posts() ) : $gallery->the_post(); 
  
			$attachments = bzbr001_get_bs_slides(bzbr001_get_attachment(8));
			foreach($attachments as $attachment): ?>

			<img src="<?php echo $attachment['url']; ?>" />

	<?php endforeach; endwhile; endif; wp_reset_postdata();?>

	</figure>
</div>

<span style="float:left" class="ss-icon" id="ssleft" >&lt;</span>
<span style="float:right" class="ss-icon" id="ssright" >&gt;</span>