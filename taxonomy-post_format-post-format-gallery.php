<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- **********************************CONTENT SECTION******************************************* -->
<section class="main-tax-gallery">
	<div class="container-fluid" id="mainContent">
		<div class="row">
			<?php get_template_part('template-parts/partials/tax-gallery'); ?>
		</div>
		<div class="row">
			<div class="container-fluid" id="postaxwrapper">
			
				<div class="col-xs-9 singlewrap" id="postaxwrap"> 
				
					<header class="tax-header text-center">
						<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
					</header>
											
					<div class="row store-posts-container">
						
						<section class="galleryloop">
						
						<?php $args = array(
								'post_type' 		=> 'post',
								'post_status' 	=> 'publish',
								'posts_per_page'	=> -1,
								'tax_query' 		=> array(
									array(                
										'taxonomy'=> 'post_format',
										'field' 	=> 'slug',
										'terms' 	=> array('post-format-gallery'),
								))
							);  
								
							$gallery = new WP_Query($args); 
							
							if($gallery->have_posts()): while ( $gallery->have_posts() ) : $gallery->the_post(); 

							$attachments = bzbr001_get_bs_slides(bzbr001_get_attachment(30));
							foreach($attachments as $attachment): ?>

							
								<div class="module text-center" style="background-image: url(<?php echo $attachment['url']; ?>);">
								
									<a href="#<?php echo $attachment['title']; ?>">
										<span class="full-link"><?php echo $attachment['title']; ?></span>
									</a>
														
								</div>
								
								<a href="#_1" class="lightbox trans" id="<?php echo $attachment['title']; ?>">
									<img src="<?php echo $attachment['url']; ?>">
								</a>
							
							

						<?php endforeach; endwhile; endif; wp_reset_postdata(); ?>
						
						</section>
					</div> <!-- store-posts-container -->

				</div> <!-- postwrap -->
				
				<div class="col-xs-3" id="postaside">	
					<aside> <?php dynamic_sidebar('aside'); ?></aside>
				</div>
				
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>


<!-- Gallery -->
<div class="show iteme open-item">
	<a href="#<?php echo $attachment['title']; ?>">
		<span class="full-link"></span>
	</a>
	<img src="<?php echo $attachment['url']; ?>" />
	<div class="pf_content">
		<h2><?php echo $attachment['title']; ?></h2>
		<h3><?php the_time('F j, Y'); ?></h3>
		<span class="pf_viewmore">[ VIEW FULL IMAGE ]</span>
	</div>
</div>
<!--/Gallery -->

