<?php 
   /*@package Jombazar 
   - Menu
	*/ 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('col-xs-3'); ?>>
	
	<?php 
	$promo = esc_html( get_post_meta( get_the_ID(), 'item_promo', true ) );
	$featured = esc_html( get_post_meta( get_the_ID(), 'item_featured', true ) );
	$price = esc_html( get_post_meta( get_the_ID(), 'item_price', true ) );
	?>
	
	<div class="row" id="menuPic">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		
		<?php if(!empty($promo)): ?>
		<div class="ribbon ribbon-top-left"><span><?php echo $promo; ?></span></div>
		<?php endif;	?>
		
		<div class="row" id="<?php if ( is_singular() ): echo 'menuPriceHome'; else: echo 'menuPrice'; endif; ?>">
			<span><?php echo $price; ?></span>
		</div>
	</div>
	
	<div class="row" id="menuIntro">
		<h3>
			<?php 
			if(!empty($featured)) : ?>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/rec.png" >  
			<?php else: echo ''; endif; ?>
			<?php the_title(); ?>
		</h3>		
	</div>
	
	<div class="<?php if ( is_singular() ): echo 'row menuDes'; else: echo 'row menuDesi'; endif; ?>" id="menuDes">
	<?php if (!is_singular() ): ?>
		<p><?php echo excerpt(10); ?></p>
	<?php else: echo ''; endif; ?>
	</div>
	
</div>