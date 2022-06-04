<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- **********************************CONTENT SECTION******************************************** -->
<?php get_template_part('template-parts/slide'); ?>

<section>
	<div class="container-fluid" id="mainContent">
		<div class="row" id="postwrapper">
			<div class="col-xs-9 " id="postwrap">	
			<?php if (have_posts()) : while (have_posts()) : the_post();
			
				store_save_post_views(get_the_ID());
			
				get_template_part('template-parts/single', get_post_format()); 
			
				echo bzbr001_post_navigation();
			
	
				if (comments_open):
					comments_template();
				endif;

			endwhile;	endif;
			

			?>	
			</div>
			
			<div class="col-xs-3" id="postaside">	
				<aside> <?php dynamic_sidebar('aside'); ?></aside>
			</div>
		</div>
	</div>

</section>

		

<?php get_footer(); ?>