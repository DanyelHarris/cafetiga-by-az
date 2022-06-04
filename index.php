<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- **************************************CONTENT SECTION**************************************************** -->
<section class="main">
	<div class="container-fluid" id="mainContent">
		<div class="row">
			<?php dynamic_sidebar('blog'); ?>
		</div>
		<div class="row">
			<div class="container-fluid" id="postwrapper">
				<div class="col-xs-9 singlewrap" id="postwrap"> 
				
				<?php if(is_paged()) :  ?>
					<div class="row text-center ajax-button">
						<a class="store-btn store-load-more" data-slug="<?php echo get_query_var('pagename'); ?>" data-prev = "1" data-page="<?php echo bzbr001_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
							<span class="fa fa-refresh"></span>
							<span class="text">LOAD PREVIOUS</span>
							<span class="sr-only">Loading...</span>
						</a>
					</div>
				<?php endif; ?>
								
					<div class="row store-posts-container">
					<?php 
					$category_id = get_cat_ID(single_cat_title('', false));
					
					$postform = bzbr001_loop_options();
					if(!empty($postform)){
					
						$args = array(
							'post_type' 	=> 'post',
							'post_status'	=> 'publish',
							'cat'  			=> $category_id,
							'tax_query' 	=> array(
								array(                
									'taxonomy' => 'post_format',
									/* 'ignore_sticky_posts' => 1, */
									'field' 	=> 'slug',							
									'terms' 	=>  $postform,
									'operator' => 'NOT IN',
								)
							)
						);
					
					}else{
					
						$args = array(
							'post_type' 	=> 'post',
							'post_status'	=> 'publish',
							'cat'  			=> $category_id,
						);
						
					}
					
						$myposts = new WP_Query($args);
									
						if ($myposts->have_posts()) : 
						
							$slug = get_query_var('pagename');
													
							echo '<div class="page-limit" data-page="/'.$slug.bzbr001_check_paged().'">';
						
						while ($myposts->have_posts()) : $myposts->the_post(); 
						 
							/* $class = 'reveal';
							set_query_var('post-class', $class); */
							get_template_part('template-parts/post', get_post_format()); 

						endwhile;
							
							echo '</div>';
							
						endif;
						
						// Reset Post Data
						wp_reset_postdata();
						
						
					?>	
					</div> <!-- store-posts-container -->

					<div class="row text-center ajax-button">
						<a class="store-btn store-load-more" data-slug="<?php echo get_query_var('pagename'); ?>" data-page="<?php echo bzbr001_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
							<span class="fa fa-refresh"></span>
							<span class="text">LOAD MORE</span>
							<span class="sr-only">Loading...</span>
						</a>
					</div>
					
				</div> <!-- postwrap -->
				
				<div class="col-xs-3" id="postaside">	
					<aside> <?php dynamic_sidebar('aside'); ?></aside>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

 