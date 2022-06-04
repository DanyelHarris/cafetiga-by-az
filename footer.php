<?php 
/* this is the template for footer
   @package Jombazar */ 
?>

<!-- ************************************FOOTER SECTION******************************************************* -->
	<footer>
		<div class="container-fluid" id="footinfo">
			<div class="row">
				<div class="container">

						<?php dynamic_sidebar('footer'); ?>
				
				</div>
			</div>
		</div>
		<div class="container-fluid" id="copyright">
			<div class="row">
				&copy; <?php echo date('Y'); ?>
				<?php
					// The Query
					$the_query = new WP_Query('bazahab_bzbr001');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$companyName = esc_attr(get_option('company_name'));
						echo $companyName;
					endif;
					// Reset Post Data
					wp_reset_postdata();
				?>
			</div>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
	</body>
</html>