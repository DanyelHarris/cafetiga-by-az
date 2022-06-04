<?php 
   /*@package Jombazar 
   - About gallery
	*/ 
?>
		
<div class="row" >
	<?php
								
	// The Query
	$about = new WP_Query(array(
		'post_type'		=> 'bzbr001-menu',
		'posts_per_page'	=>	4,
		'post_status'	=> 'publish'
	));
	
	// The Loop
	if($about->have_posts()): $i = 0;
		while ( $about->have_posts() ) : $about->the_post(); ?>
		
		<?php if($i == 0): ?>
			<div class="img1"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 0 && $i <= 1): ?>
			<div class="img2"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 1 && $i <= 2): ?>
			<div class="img3"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 2 && $i <= 3): ?>
			<div class="img4"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
	
	<?php endif; ?>
	
	<?php	$i++; endwhile;
	endif;
	
	// Reset Post Data
	wp_reset_postdata();

	?>
			
</div>

<div class="row">
	<?php
								
	// The Query
	$about = new WP_Query(array(
		'post_type'		=> 'bzbr001-menu',
		'posts_per_page'=>	4,
		'offset'			=>	4,
	
	));
	
	// The Loop
	if($about->have_posts()): $i = 0;
		while ( $about->have_posts() ) : $about->the_post(); ?>
		
		<?php if($i == 0): ?>
			<div class="img5"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 0 && $i <= 1): ?>
			<div class="img6"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 1 && $i <= 2): ?>
			<div class="img7"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
		<?php elseif($i > 2 && $i <= 3): ?>
			<div class="img8"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo bzbr001_get_attachment(); ?>"></a></div>
	
	<?php endif; ?>
	
	<?php	$i++; endwhile;
	endif;
	
	// Reset Post Data
	wp_reset_postdata();

	?>
	
</div>