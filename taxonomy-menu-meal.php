<?php 
	/*@package Jombazar 
	   - Menu meal
	  
	*/ 
?>

<?php get_header(); ?>

<!-- *********************************************CONTENT SECTION*********************************************************** -->
		<section class="head">
			<div class="container-fluid">
				<div class="row" id="headText">
					  
					<?php
					// The Query
					$the_query = new WP_Query('store_cpt_menu');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$menuPage = esc_attr(get_option('menu_page_title'));
					?>
					
					<h1 class="letterpress"><?php print $menuPage ?></h1>
					
					<?php endif;
					
					// Reset Post Data
					wp_reset_postdata();
					?>
					
				</div>
			</div>
		</section>
					
		<section class="content main">
			<div class="container-fluid">
				<div class="row text-center">
					<h2 class="catMenu"><?php single_cat_title(); ?></h2>
					<hr class="style18">
				</div>
				<div class="row">
					<div class="container" id="menuItem">
						<div class="row">
					
						<?php
							$current_category = single_cat_title("", false);
							$about = new WP_Query(array(
								'paged'          => get_query_var('paged'),
								'post_type'      => 'bzbr001-menu',
								'post_status'		=> 'publish',
								'posts_per_page' => -1,
								'tax_query'      => array(
									array(
										'taxonomy' => 'menu-meal', 
										'field'    => 'name',
										'terms'    => $current_category,
									),
								),
							));
							
							if($about->have_posts()):
								while ( $about->have_posts() ) : $about->the_post();
									get_template_part('template-parts/content', 'menu');
								endwhile;
							endif;
							
							// Reset Post Data
							wp_reset_postdata();
						?>

						</div>
					</div>
				</div>
			</div>
		</section>

<?php get_footer(); ?>