<?php 
   /*@package Jombazar 
   -Status Post Formats
	*/ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-status'); ?>>
	<section class="post-status clearfix">

		<div class="container-fluid" id="statusWrap">

		<?php if (bzbr001_get_attachment()): ?>
			<div class="col-xs-2" id="statusImg" style="background-image: url(<?php echo bzbr001_get_attachment(); ?>); margin-left:0;" ></div>
			<div class="col-xs-8">
		<?php else : ?>
			<div class="col-xs-12">
		<?php endif; ?>		 
				<div class="row" id="statusMeta"><?php echo bzbr001_status_meta(); ?></div>
				<div class="row" id="statusContent" >
					<?php echo the_excerpt (40); ?>	
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="row"  id="shareholic">
							<h3 id="sharing">Care to share? </h3>
							<?php get_template_part('template-parts/partials/sharing'); ?>
						</div>
					</div>
					<div class="col-xs-6" style="padding-right:0px;">
					<?php if(!is_archive()): ?>
						<div class="button-container text-right" style="padding-top:50px;">
							<a href="<?php echo esc_url( get_post_format_link( 'status' ) ); ?>" class="btn btn-default"><?php _e('More Feeds') ?> </a>
						</div>
					<?php endif ?>
					</div>	
				</div>
				<div class="row" id="statusFooter"><?php echo bzbr001_status_footer(); ?></div>
			</div>

		</div>
		<br>
		<hr class="style17">
		
	</section> 
</article>
