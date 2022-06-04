<?php 
   /*@package Jombazar 
	   - About content
	*/ 
?>

<?php get_header(); ?>

<!-- ********************************CONTENT SECTION******************************************************** -->
	<div class="main">
		<section class="head">
			<div class="container-fluid">
				<div class="row" id="headText">

				<?php
					// The Query
					$the_query = new WP_Query('bzbr001_cpt_about');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$aboutBg = esc_attr(get_option('about_bg')); 
					$aboutPage = esc_attr(get_option('about_page_title'));
					$aboutSection = esc_attr(get_option('about_section_title'));
					$aboutDes = esc_attr(get_option('about_description')); ?>
					
					<h1 class="letterpress"><?php print $aboutPage ?></h1>

				</div>
			</div>
		</section>

		<section class="content about"  style="background-image: url(<?php print $aboutBg ?>); ">
			<div class="container-fluid" id="contentAbout">
				<div class="row" id="sectionTitle">
				
					<h2><?php print $aboutSection ?></h2>
					<p><?php print $aboutDes ?></p>
					
					<?php endif;
					
					// Reset Post Data
					wp_reset_postdata();
				?>
				
				</div>

					<?php get_template_part('template-parts/content', 'about');?>
					
			</div>
		</section>
		
		<!--template part testimony-->
		<?php dynamic_sidebar('about'); ?>
		
		<section class="menugalery">
			<div class="container-fluid" id="menuImg">
				<?php get_template_part('template-parts/partials/images'); ?>
			</div>
		</section>	
	</div>

<?php get_footer(); ?>