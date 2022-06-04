<?php 
	/*@package Jombazar 
	   - Menu content
	*/ 
?>

<?php get_header(); ?>

<!-- **************************************CONTENT SECTION**************************************************** -->
		<section class="head">
			<div class="container-fluid">
				<div class="row" id="headText">
					  
					<?php
					// The Query
					$the_query = new WP_Query('bzbr001_cpt_menu');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$menuBg = esc_attr(get_option('menu_bg')); 
					$menuPage = esc_attr(get_option('menu_page_title'));
					$menuSection = esc_attr(get_option('menu_section_title'));
					$menuDes = esc_attr(get_option('menu_description')); ?>
					
					<h1 class="letterpress"><?php print $menuPage ?></h1>
					
				</div>
			</div>
		</section>
					
		<section class="content main">
			<div class="container-fluid">
				<div class="row text-center" id="sectionTitle">
				
					<h2><?php print $menuSection ?></h2>
					<p><?php print $menuDes ?></p>
					
					<?php endif;
					
					// Reset Post Data
					wp_reset_postdata();
				?>
				
				</div>
				<div class="row">
						
					<?php
					/*
					 * Loop through Categories and Display Posts within
					 */
					$post_type = 'bzbr001-menu';
					 
						$terms = get_terms( array(
								'post_type' => $post_type,
								'post_status'	=> 'publish',
								'taxonomy' => 'menu-cuisine',
								'field' => 'ids',
							));
					 
						foreach( $terms as $term ) : 
					?>
						
						<div class="container" >
							<div class="row" id="menuItem">
								<div class="row">
									<h2 class="catMenu"><?php echo $term->name; ?></h2>
								</div>
								<hr class="style18">
								<div class="row">

					<?php $args = array(
								'post_type' => $post_type,
								'post_status'	=> 'publish',
								'posts_per_page' => -1,  //show all posts
								'tax_query' => array(
									array(
										'taxonomy' => 'menu-cuisine',
										'field' => 'slug',
										'terms' => $term->slug,
									)
								)
				 
							);
						$posts = new WP_Query($args);
				 
						if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post(); 
						get_template_part('template-parts/content', 'menu');
					
						endwhile; endif; 
					?>
								</div>
							</div>
						</div>
					<?php endforeach; 
						// use reset postdata to restore orginal query
						wp_reset_postdata();
					?>
				</div>
			</div>
		</section>

<?php get_footer(); ?>