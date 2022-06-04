<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- ***************************CONTENT SECTION***************************************** -->
<section class="main-tax-audio">
	<div class="container-fluid" id="mainContent">
		<div class="row ">
			<?php dynamic_sidebar('audio'); ?>
		</div>
		<div class="row">
			<div class="container-fluid" id="audiotaxwrapper">
	
				<div class="col-xs-9 singlewrap" id="postaxwrap"> 
				
					<header class="tax-header text-center">
						<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
					</header>
											
					<div class="row store-audio-container">
						<section class="galleryloop">

							<?php $args = array(
									'post_type' 		=> 'post',
									'post_status' 	=> 'publish',
									'posts_per_page'	=> -1,
									'tax_query' 		=> array(
										array(                
											'taxonomy'=> 'post_format',
											'field' 	=> 'slug',
											'terms' 	=> array('post-format-audio'),
									))
								);  
									
								$video = new WP_Query($args); 
								
								if($video->have_posts()): while ( $video->have_posts() ) : $video->the_post(); ?>

								<div class="module" id="audio-<?php the_ID(); ?>">
								
									<div class="row text-center" id="audititle">
										<a href="<?php the_permalink(); ?>"><?php echo the_title('<h4>', '</h4>'); ?></a>
									</div>	
									
									<?php  echo bzbr001_get_embedded_media(array('audio', 'iframe')); ?>
									
								</div>

							<?php endwhile; endif; wp_reset_postdata(); ?>

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

 