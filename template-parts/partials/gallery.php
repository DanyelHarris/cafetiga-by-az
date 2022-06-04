<?php 
/*@package Jombazar 
-Gallery
*/ 
?>


<?php 
	$attachments = bzbr001_get_bs_slides(bzbr001_get_attachment(5));
	foreach($attachments as $attachment):
?>
<!-- Gallery -->
<div class="show iteme open-item">
	<a href="#<?php echo $attachment['title']; ?>">
		<span class="full-link"></span>
	</a>
	<img src="<?php echo $attachment['url']; ?>" />
	<div class="pf_content">
		<h2><?php echo $attachment['title']; ?></h2>
		<h3><?php the_time('F j, Y'); ?></h3>
		<span class="pf_viewmore">[ VIEW FULL IMAGE ]</span>
	</div>
</div>
<!--/Gallery -->

<!-- Modals -->
<div id="<?php echo $attachment['title']; ?>" class="modalContent pf_1">
	<a href="#close" title="Close">
		<span class="full-link"></span>
	</a>
	<div style="background: url('<?php echo $attachment['url']; ?>') center; background-size: cover;">
		<a href="#close" title="Close" class="close">[ CLOSE ME ]</a>
		<div class="modalDesc">
			<h2><?php echo $attachment['caption']; ?></h2>
			<h3>
				<a href="<?php echo esc_url( get_post_format_link( 'gallery' ) ); ?>" >[ VIEW GALLERY ]</a>
			</h3>
		</div>
	</div>	
</div>
<!--/Modals -->

<?php endforeach; ?>