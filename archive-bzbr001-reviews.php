<?php 
	/*@package Jombazar 
	   - Reviews content
	*/ 
?>

<?php get_header(); ?>

<!-- **************************************CONTENT SECTION**************************************************** -->
		<section class="head">
			<div class="container-fluid">
				<div class="row" id="headText">
					  
					<?php
					// The Query
					$the_query = new WP_Query('bzbr001_cpt_review');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$reviewBg = esc_attr(get_option('review_bg')); 
					$reviewPage = esc_attr(get_option('review_page_title'));
					$reviewSection = esc_attr(get_option('review_section_title'));
					$reviewDes = esc_attr(get_option('review_description')); ?>
					
					<h1 class="letterpress"><?php print $reviewPage ?></h1>
					
				</div>
			</div>
		</section>
					
		<section class="content main">
			<div class="container-fluid">
			
				<div class="row text-center" id="sectionTitle">
				
					<h2><?php print $reviewSection ?></h2>
					<p><?php print $reviewDes ?></p>
					
					<?php endif;
					
					// Reset Post Data
					wp_reset_postdata();
				?>
				
				</div>
				
				<div class="row" id="reviewWrap">
						
					<?php $args = array(
								'post_type' => 'bzbr001-reviews',
								'post_status'	=> 'publish',
								'posts_per_page' => -1,  //show all posts				 
							);
							
						$posts = new WP_Query($args);
				 
						if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post(); 
						get_template_part('template-parts/content', 'review');
						endwhile; endif; 

						// use reset postdata to restore orginal query
						wp_reset_postdata();
					?>
				</div>
				
				<div class="row text-center" id="reviewFormWrap">
					<hr class="style17">
					<p class="revtext">We really appreciate your feedback</p>
					 <?php get_template_part('template-parts/form', 'review'); ?>
				</div>
			</div>
		</section>

<?php get_footer(); ?>