<?php 
	/*@package Jombazar 
	   - Single Menu
	*/ 
?>

<?php get_header(); ?>

<!-- ***************************************CONTENT SECTION************************************************** -->
	<div class="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post();?>

		<?php get_template_part('template-parts/dishes'); ?>
		
		<article id="post-<?php the_ID(); ?>" >
			<section class="content">
				<div class="container">
					<div class="row">
						<div class="col-xs-9">
							<div class="row" id="singleContent"><?php the_content(); ?></div>
							<hr class="style17">
							<div class="row" id="singleDetails">
								<div class="col-xs-4" id="singlePrice">
									<?php
										$price = esc_html( get_post_meta( get_the_ID(), 'item_price', true )); 
										if(!empty($price)) : ?>
										<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/serving64.svg" > <span><?php echo $price ?></span> 
										<?php endif; 
									?>
								</div>
								<div class="col-xs-4" id="singlePromo">
									<div class="row">
									<?php 
										$promo = esc_html( get_post_meta( get_the_ID(), 'item_promo', true ));
										if(!empty($promo)) : ?>
										<div class="row" id="ribbon">
											<span id="content"><?php echo $promo; ?> </span>
										</div>
										<?php endif;
									?>
									</div>
									<div class="row text-right" id="singlePromoImg">
									<?php 
										$featuredimg = esc_html( get_post_meta( get_the_ID(), 'item_featured', true ));
										if(!empty($featuredimg)) : ?>
										<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/cookrec.png" >
										<?php endif; 
									?>	
									</div>
								</div>
								<div class="col-xs-4" id="singleFeatured">
								<?php 
									$featured = esc_html( get_post_meta( get_the_ID(), 'item_featured', true ));
									if(!empty($featured)) : ?>
									<div class="oval-speech-border">
										<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/rec.png" > <span><?php echo $featured; ?></span>
									</div>
									<?php endif; 
								?>
								</div>
							</div>
						</div>
						<div class="col-xs-3 text-center" >
							<div class="row" id="singleImg"><?php the_post_thumbnail(); ?></div>
							<div class="row" id="singleMeal">
									
								<?php
								// We need to tell WordPress to look for our custom taxonomy lists
								 
								$meal = "";
								 
								// Then we need to tell it which one we want in particular and store it for use in our code.
								$meal_list = get_the_term_list( $post->ID, 'menu-meal', '', ', ', '' );
								if ( '' != $meal_list ) {
									$meal .= "$meal_list";
								}
								 
								// Now we need to tell Wordpress exactly how we want to display the tag
								if ( '' != $meal ) {
								?>
								<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/meal-time.png">
								<?php
								echo '<span>'.$meal.'</span>';
								} ?>

							</div>

							<div class="row" id="singleCourse">
									
								<?php
								// We need to tell WordPress to look for our custom taxonomy lists
								 
								$course = "";
								 
								// Then we need to tell it which one we want in particular and store it for use in our code.
								$course_list = get_the_term_list( $post->ID, 'menu-course', '', ', ', '' );
								if ( '' != $course_list ) {
									$course .= "$course_list";
								}
								 
								// Now we need to tell Wordpress exactly how we want to display the tag
								if ( '' != $course ) {
								?>
								<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/course.png">
								<?php
								echo '<span>'.$course.'</span>';
								} ?>
					
							</div>
						</div>
					</div>
				</div>
			</section>
		</article>
		
		<?php	endwhile; endif; wp_reset_query();?>
		
		<section>
			<hr class="style17">
		</section>
		
		<section class="content">
			<div class="container">
				<div class="row" id="recomend">
				
				<!-- begin custom related loop, isa -->
 
							<?php 
							 
							// get the custom post type's taxonomy terms
							 
							$custom_taxterms = wp_get_object_terms( $post->ID, 'menu-cuisine', array('fields' => 'ids') );
							// arguments
							$args = array(
							'post_type' => 'bzbr001-menu',
							'post_status' => 'publish',
							'posts_per_page' => 4, // you may edit this number
							'orderby' => 'rand',
							'tax_query' => array(
								array(
									'taxonomy' => 'menu-cuisine',
									'field' => 'id',
									'terms' => $custom_taxterms
								)
							),
							'post__not_in' => array ($post->ID),
							);
							$related_items = new WP_Query( $args );
							// loop over query
							if($related_items->have_posts()): ?>
							
							
					<h2>You may also like..</h2>
				</div>
				<div class="row">
					<div class="container" id="menuItem">
						<div class="row">

							<?php	while ( $related_items->have_posts() ) : $related_items->the_post();
									get_template_part('template-parts/content', 'menu');
								endwhile;
							endif;
							// Reset Post Data
							wp_reset_postdata();
							?>
							 
						<!-- end custom related loop, isa -->

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>