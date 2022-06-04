<?php 
   /*@package Jombazar 
	   -Single Video Post
	*/ 
?>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
	<div class="row" id="singleblogMetawrap">
		<div class="col-xs-2">
			<div class="singleblogDate text-center"><strong><?php the_time('F j'); ?></strong></div>
		</div>
		
		<div class="col-xs-10">
			<div class="row" id="singleblogTitle">
				<?php the_title('<h2>', '</h2>'); ?>
			</div>
			<div class="row" id="singleblogMeta">
				<?php echo bzbr001_posted_meta(); ?>
			</div>
		</div>
	</div>
	
	<div class="row store-format-link">
		<section class="post-link clearfix">
			<div class="container-fluid" id="linkWrap"> 
				<div class="row text-center" id="linkTitle">
					<?php 
						$link = bzbr001_grab_url();
						the_title('<h1 class="entry-title"><a href="'.$link.'" target="_blank">', '<div class="link-icon"><span class="fa fa-link"></span></div></a></h1>'); 
					?>
				</div>	
			</div>
		</section> 
	</div>
	
</article>