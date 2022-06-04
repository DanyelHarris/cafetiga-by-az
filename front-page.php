<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- *********************************CONTENT SECTION********************************************** -->
	<div class="main">
	
		<!-- Slide -->
		<?php dynamic_sidebar('slide'); ?>
		
		
		<!-- Content -->
		<section class="front-page clearfix">
			<div class="frontContent">
				<div class="container-fluid">
					<div class="row ">
					
					<?php	if (have_posts()) : while (have_posts()) : the_post();?>
								
								<?php if (has_post_thumbnail()): 	?>
						
						<div class="col-xs-6 text-center" id="frontText">
								<article id="post-<?php the_ID(); ?>">
									<?php the_content(); ?>
								</article>
								</div>
						
						<div class="col-xs-6" id="frontImg"><?php the_post_thumbnail(); ?></div>
					
						<?php else : ?>
						
						<div class="col-xs-12 text-center" id="frontText">
								<article id="post-<?php the_ID(); ?>">
									<?php the_content(); ?>
								</article>
						</div>
						
						<?php endif; ?>

					<?php endwhile; endif; 
						
						// Reset Post Data
						wp_reset_query();
						
					?>
						
					</div>
					<hr class="style17">
				</div>
			</div>
		</section>
		
		<!-- Paralax -->
		<?php dynamic_sidebar('frontpage');	?>
		
		<!-- Menu -->
		<?php

		// The Query
		$about = new WP_Query( array(
			'post_type'		=> 'bzbr001-menu',
			'posts_per_page'	=> 8,
			'meta_key' 		=> 'item_show',
			'meta_value' 		=> 'Display in front',
			'post_status'		=> 'publish' 
		));
		
		// The Loop
		if($about->have_posts()):?>
		
		<section class="front-Menu">
			<div class="container-fluid">
				<div class="row">
					<div class="menuTitle letterpressfront">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/chefhat.png" width="50px" height="50px"> We serve 
					</div>
					<div class="container" id="frontmenuItem">
						<div class="row">
							
							<?php	while ( $about->have_posts() ) : $about->the_post();
								get_template_part('template-parts/content', 'menu');
							endwhile;
							?>
			
						</div>
					</div>
				</div>
			</div>
		</section>
	
	
		<?php endif;
			
		// Reset Post Data
		wp_reset_postdata();

		?>
		
	</div>	
	
<?php get_footer(); ?>