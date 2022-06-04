<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- **********************************CONTENT SECTION********************************************* -->
<section class="main">
	<div class="container-fluid" id="mainContent">
		<div class="row">
			<?php get_template_part('template-parts/partials/testimony'); ?>
		</div>
		<div class="row">
			<div class="container-fluid" id="postwrapper">
			
				<div class="col-xs-9 singlewrap" id="postwrap"> 
				
					<header class="archive-header text-center">
						<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
					</header>
											
					<div class="row store-posts-container">
						 
					<?php $args = array(
							'post_type' 		=> 'post',
							'post_status' 	=> 'publish',
							'posts_per_page'	=> -1,
							'tax_query' 		=> array(
								array(                
									'taxonomy'=> 'post_format',
									'field' 	=> 'slug',
									'terms' 	=> array('post-format-aside'),
							))
						);  
							
						$popads = new WP_Query($args); 
						
						if($popads->have_posts()): while ( $popads->have_posts() ) : $popads->the_post(); 

							get_template_part('template-parts/post', get_post_format()); 

						endwhile; endif; wp_reset_postdata();
						
					?>
					
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

 