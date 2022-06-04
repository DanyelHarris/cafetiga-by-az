<?php 
   /*@package Jombazar 
   - Blog
	*/ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-standard'); ?>>
	<section class="post-standard clearfix">
		<div class="container-fluid">
		
			<?php if (bzbr001_get_attachment()): ?>
			<div class="col-xs-5" id="postimg">
				<div class="row" id="postpic" style="background-image: url(<?php echo bzbr001_get_attachment(); ?>);">
					<div class="col-xs-4 col-xs-offset-8" id="postdate"><?php the_time('F j'); ?></div>
				</div>
			</div>
			
			<div class="col-xs-7" id="postcontent">	
			
			<?php else : ?>
			<div class="col-xs-12" id="postcontent">
			<?php endif; ?>
									
				<div class="row" id="posttitle">
					<a href="<?php the_permalink(); ?>"><?php the_title('<h2>', '</h2>'); ?></a>
				</div>
				<div class="row" id="postcat"> 
					<?php echo bzbr001_posted_meta(); ?>
				</div>
				<div class="row" id="postexcerpt">
					<p><?php echo excerpt(40); ?></p>
				</div>
				
				<?php if (empty (bzbr001_get_attachment())): ?>
				<div class="row" id="postcat"><?php the_time('F j, Y'); ?></div>
				<?php endif; ?>
										
			</div>
			
		</div>
	</section>
</article>

