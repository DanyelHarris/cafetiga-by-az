<?php 
	/*@package Jombazar 
	   - FAQ content
	*/ 
?>

<?php get_header(); ?>

<!-- ***********************************CONTENT SECTION**************************************************** -->
	<div class="main">
		<section class="head">
			<div class="container-fluid">
				<div class="row shadow" id="headText">
					  
					<?php
					// The Query
					$the_query = new WP_Query('bzbr001_cpt_faq');
					// The Loop	
					if( $the_query->have_posts()  ) : $the_query->the_post();
					$faqBg = esc_attr(get_option('faq_bg')); 
					$faqPage = esc_attr(get_option('faq_page_title'));
					$faqSection = esc_attr(get_option('faq_section_title'));
					$faqDes = esc_attr(get_option('faq_description')); ?>
					
					<h1 class="letterpress"><?php print $faqPage ?></h1>
					
				</div>
			</div>
		</section>
					
		<section class="content">
			<div class="container-fluid">
				<div class="row text-center" id="sectionTitle">
					<h2><?php print $faqSection ?></h2>
					<p><?php print $faqDes ?></p>
					
					<?php endif;
					
					// Reset Post Data
					wp_reset_postdata();
				?>
				
				</div>
				<div class="row">
					<div class="container" style="padding-bottom: 20px;">
						<?php get_search_form(); ?>
					</div>
				</div>
				<div class="row">
					<div class="row hilite-main-container">
						<ul>
							<li>
								<!-- first faq -->
								<!-- <h1 class="hilite-title">FIRST FAQ</h1> -->
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<?php
											
									// The Query
									$about = new WP_Query(array(
										'post_type'	=> 'bzbr001-faq',	
										'post_status'	=> 'publish'
									));
									
									// The Loop
									if($about->have_posts()): 
										while ( $about->have_posts() ) : $about->the_post(); ?>
								
								
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="<?php the_ID(); ?>">
											<h4 class="panel-title text-center">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordian" href="#collapse<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapseOne">
												<?php the_title();?>
												</a>   
											</h4>
										</div>
										<div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php the_ID(); ?>">
											<div class="panel-body">
												<?php the_content(); ?>
											</div>
									  </div>
									</div>

									<?php	endwhile;
									endif;
									
									// Reset Post Data
									wp_reset_postdata();

								?>	
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>