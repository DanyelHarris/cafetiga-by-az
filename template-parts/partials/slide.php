<?php 
   /*@package Jombazar 
   -Slide
	*/ 
?>
<section class="slide">
	<div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
			<li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
			<li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper For Slides -->
		<div class="carousel-inner" role="listbox">
		<?php $slider = get_posts(array(
			'post_type' 		=> 'bzbr001-slide', 
			'posts_per_page' => -1,
			'post_status'	=> 'publish'
			)); 
		?>
		<?php $count = 0; ?>
		<?php foreach($slider as $slide): ?>
	
		<!-- Third Slide -->
		<div class="item <?php echo ($count == 0) ? 'active' : ''; ?>">

			<!-- Slide Background -->
			<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)); ?>" class="img-responsive"/>
			<div class="bs-slider-overlay"></div>

			<div class="container">
				<div class="row">
					<!-- Slide Text Layer -->
					<div class="slide-text slide_style_left">
					
						<h1 data-animation="animated <?php echo ($count == 0) ? 'zoomInRight' : 'flipInX'; ?>"><?php echo get_the_title($slide->ID); ?></h1>
						<p data-animation="animated <?php echo ($count == 0) ? 'fadeInLeft' : 'lightSpeedIn'; ?>"><?php echo get_post_meta(($slide->ID), 'slide_sentence', true ); ?> 
						<!--<a href="http://bootstrapthemes.co/" target="_blank" class="btn btn-default" data-animation="animated fadeInLeft">select one</a>
						<a href="http://bootstrapthemes.co/" target="_blank"  class="btn btn-primary" data-animation="animated fadeInRight">select two</a>-->
					</div>
				</div>
			</div>
		</div>
		<!-- End of Slide -->
		
		
		<?php $count++; ?>
		<?php endforeach; ?>
		
		</div>
		<!-- End of Wrapper For Slides -->

		<!-- Left Control -->
		<a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
		<span class="fa fa-angle-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
		</a>

		<!-- Right Control -->
		<a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
		<span class="fa fa-angle-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
		</a>

	</div> <!-- End  bootstrap-touch-slider Slider -->
</section>