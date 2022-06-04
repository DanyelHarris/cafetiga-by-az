<?php 
   /*@package Jombazar 
   -Pop Slide
	*/ 
	
	$popsettings = get_posts(array('page'=> 'bzbr001_store'));
	$popupLoop = esc_attr(get_option('popup_loop'));
	$popupPerpage = esc_attr(get_option('popup_perpage'));
	if($popupPerpage <= 0 || $popupLoop == 0) : $popupPerpage = '1'; endif;
	$postadsid = bzbr001_loopid_ads();
?>

<!-- THIS IS FOR SLIDER DISPLAY -->
<div id="carousel-example-generic" class="carousel slide control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">
	
	<!-- Wrapper for slides -->
	<div class="carousel-inner">

	<?php 
	$args = array(
		'post_type' 		=> 'post',
		'post_status' 	=> 'publish',
		'posts_per_page'	=> $popupPerpage,
		'post__in'      	=> $postadsid,
		'tax_query' 		=> array(
			array(                
				'taxonomy' => 'post_format',
				'field' 	=> 'slug',
				'terms' 	=> array('post-format-aside'),
		))
	);  
			
	$popads = get_posts($args);
		
	$count = 0;  
	foreach($popads as $popad):  
	?>

		<div class="item <?php echo ($count == 0) ? 'active' : ''; ?>">
		
			<div class="container-fluid backthumb" <?php if(has_post_thumbnail()): echo 'style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id($popad->ID)).');"'; endif; ?>>
	
				<div class="row"><?php echo get_the_title($popad->ID); ?></div>
				<div class="row"><?php echo do_shortcode(get_post_field('post_content', $popad->ID)); ?></div>
				
			</div>
	
		</div>
	
	<?php $count++; endforeach; wp_reset_query();?>

	</div>


<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>

<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

</div>