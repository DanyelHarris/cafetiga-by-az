<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>


<!-- PRINT OPTION -->
<?php
$adslist = new WP_Query( array(
	'posts_per_page'	=> -1,
	'tax_query' 		=> array(
			array(                
				'taxonomy' 	=> 'post_format',
				'field' 		=> 'slug',
				'terms' 		=> array('post-format-aside'),
	))
));
?>
	
<div class="wrap" id="adsList">
	
	<div class="clearboth">
		<div class="divTableCell">
			<span> <img src="<?php bloginfo('stylesheet_directory'); ?>/img/admin/advers2.png"></span>
		</div>
		<div class="divTableCell" id="adsTitle">
			<h1><?php _e('POP-UP ADS LISTINGS' , 'cafesatu') ?></h1>
		</div>
	</div>

	
	<?php if($adslist->have_posts()): ?>
		<p> <?php _e('List it aaooollll', 'cafesatu') ?> </p>

	<?php while ( $adslist->have_posts() ) : $adslist->the_post(); ?>
				 
										
		<td id="previewAds">

			<div class="adsBox" id="<?php the_ID(); ?>" style="display: none;">
				<div class="divTableCell eyeclose">
					<a href="#<?php the_ID(); ?>" id="<?php the_ID(); ?>-link" class="link" rel="<?php the_ID(); ?>"><img title="View" src="<?php bloginfo('stylesheet_directory'); ?>/img/admin/eye_close.svg" style="width: 24px; height: 24px;"></a>
				</div>
				<div class="divTableCell eyeclose">
					<input type = "checkbox" id="<?php the_ID(); ?>" class="viewingads" name="ads_list_id[<?php the_ID(); ?>]"/>
				</div>
				<div class="divTableCell eyeclose">
					<label>Post title: <?php the_title(); ?></label>
				</div>
				
				<?php get_template_part('template-parts/post', get_post_format()); ?>
				
			</div>
			
		</td>
					
	<?php endwhile; ?>

	<?php else: ?>
		<p> <?php _e('No List y\'all', 'cafesatu') ?> </p>
	<?php endif; wp_reset_postdata();?>


</div> <!-- .wrap#adsList -->
	

	

	

<!-- FRONT PAGE PREVIEW -->

<form method="post" action="options.php" class="bzbr001-adslist-form">
	<?php if( isset($_GET['settings-updated']) ) { ?>
	<div id="adslistings" class="pickbtn is-dismissible">
		<span class="text-info"> Please set your advertisements pop-up <a href="./admin.php?page=bzbr001_advertisement">here</a>.</span> 
	</div>
<?php } ?>
	
	<div class="divTable">
		<div class="divTableBody">
			<div class="divTableRow">
				<div class="divTableCell">
					<?php settings_fields('bzbr001-ads-list'); ?>
					<?php do_settings_sections('ads_list'); ?>
				</div>
				<div class="divTableCell">ADS DISPLAY</div>
			</div>
		</div>
	</div>
		
	<?php submit_button('Display Advertisement', 'primary', 'btnSubmit'); ?>

</form>