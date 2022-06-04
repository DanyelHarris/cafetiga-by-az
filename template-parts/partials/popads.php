<?php 
   /*@package Jombazar 
   -Pop Ads
	*/ 
?>

<?php
	$popsettings = get_posts(array('page'=> 'bzbr001_store'));
	$popupTrigger = esc_attr(get_option ('popup_trigger'));
	$popupanimateEntrance = esc_attr(get_option('popup_animate_entrance')); 
	$popupanimateExit = esc_attr(get_option('popup_animate_exit'));
	$popupDelay = esc_attr(get_option('popup_delay'));
	if($popupDelay <= 0  ) : $popupDelay = '60'; endif;
	$popupSize = esc_attr(get_option('popup_size'));
	$popupButton = esc_attr(get_option('popup_button'));
	$popupButton2 = esc_attr(get_option('popup_button_2'));
	$popupButton3 = esc_attr(get_option('popup_button_3'));
	$popupButtonchoice = esc_attr(get_option('popup_button_choice')); 
	$popupClose = esc_attr(get_option('popup_close'));
	$popupcloseButtonchoice = esc_attr(get_option('popup_close_button_choice')); 
	$popupAnimate = esc_attr(get_option('popup_animate'));
	$popupLoop = esc_attr(get_option('popup_loop'));
	$popupPerpage = esc_attr(get_option('popup_perpage'));
	if($popupPerpage <= 0 || $popupLoop == 0) : $popupPerpage = '1'; endif;
	$postadsid = bzbr001_loopid_ads();
?>

		
<!-- THIS IS FOR STATIC DISPLAY -->

<?php if($popupTrigger === 'onclickModal') : ?>
<button type="button" id="popup_button_css_display" class="<?php echo $popupButtonchoice; ?> btn-main"  data-toggle="modal" data-target="#<?php echo $popupTrigger; ?>"> 
	<div class="price">
		<span id="btnopen"><?php echo $popupButton;  ?></span>
		<span id="btnopen2"><?php echo $popupButton2; ?></span>
		<span id="btnopen3"><?php echo $popupButton3; ?></span>
	</div>
</button>
<?php endif; ?>

<!-- THIS IS FOR STATIC DISPLAY -->

<div id="<?php echo $popupTrigger; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-timer="<?php echo $popupDelay; ?>" data-entrance="<?php echo $popupanimateEntrance; ?>" data-exit="<?php echo $popupanimateExit; ?>">

	<div class="<?php echo $popupSize; ?> modal-size" role="document">
		<div class="modal-content">
		
			<?php if ($popupClose === '1'): ?>
			<div class="modal-header">
				<button type="button" id="popup_close_button_css_display" class="<?php echo $popupcloseButtonchoice; ?> btn-main-close" data-dismiss="modal"></button>	
			</div>
			<?php endif; ?>
			
			<div class="modal-body">
				<div class="row">

					<div class="col-md-12" id="popupWrap" data-animate="animated <?php echo $popupAnimate; ?>">
					
					<?php if (!empty ($popupLoop)) : 
					
						get_template_part('template-parts/partials/popslide'); 
					
					else :
					
						$args = array(
							'post_type' 		=> 'post',
							'post_status' 	=> 'publish',
							'posts_per_page'	=> $popupPerpage,
							'post__in'      	=> $postadsid,
							'tax_query' 		=> array(
								array(                
									'taxonomy'=> 'post_format',
									'field' 	=> 'slug',
									'terms' 	=> array('post-format-aside'),
							))
						);  
							
						$popads = new WP_Query($args); 
						
						if($popads->have_posts()): while ( $popads->have_posts() ) : $popads->the_post(); 
						
							
							get_template_part('template-parts/post', get_post_format()); 
							
							
						endwhile; endif; wp_reset_postdata();
						
					endif;?>
					
					</div> <!-- #popupWrap -->

				</div>
			</div> <!-- .modal-body -->
			
			<?php if ($popupClose === '1'): ?>
			<div class="modal-footer">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<?php endif; ?>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->	