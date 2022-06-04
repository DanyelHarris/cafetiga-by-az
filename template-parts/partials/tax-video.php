<?php 
/*@package Jombazar 
-Taxonomy Video
*/ 
?>

<div id="vdhead">
  
	<?php $args = array(
			'post_type' 		=> 'post',
			'post_status' 	=> 'publish',
			'posts_per_page'	=> 1,
			'tax_query' 		=> array(
				array(                
					'taxonomy' => 'post_format',
					'field' 	=> 'slug',
					'terms' 	=> array('post-format-video'),
			))
		);  
			
		$video = new WP_Query($args); 
		
		if($video->have_posts()): while ( $video->have_posts() ) : $video->the_post(); ?>
		
		<div class="videocontainer" id="background">

		<?php echo bzbr001_get_embedded_media(array('video', 'iframe')); ?>

		</div>

	<?php endwhile; endif; wp_reset_postdata();?>

</div>
