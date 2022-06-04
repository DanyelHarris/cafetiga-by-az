<?php 
   /*@package Jombazar 
   - About content
	*/ 
?>
		
<div class="row">
	<?php 
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=0'); 
		foreach ($posts as $post) : start_wp(); 
		static $count1 = 0; 
		if ($count1 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-5 wow rotateInDownLeft" data-wow-duration="0.5s" id="toRight">
		<div class="col-xs-8" >
			<?php 
				the_title('<h4>', '</h4>');
				echo'<span id="getcontentAbout">'.get_the_content().'</span>';
			?>
		</div>
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
	</div>
	<?php 
		$count1++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
		
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=1'); 
		foreach ($posts as $post) : start_wp();
		static $count2 = 0; 
		if ($count2 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-5 col-xs-offset-2 wow rotateInDownRight" data-wow-duration="0.5s">
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
		<div class="col-xs-8">
			<?php 
				the_title('<h4>', '</h4>');
				echo'<span id="getcontentAbout">'.get_the_content().'</span>';
			?>
		</div>
	</div>
	<?php 
		$count2++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
	?>
</div>

<div class="row">
	<?php 
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=2'); 
		foreach ($posts as $post) : start_wp();
		static $count3 = 0; 
		if ($count3 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-4 wow fadeInLeft">
		<div class="col-xs-8">
			<?php 
				the_title('<h4>', '</h4>');
				echo'<span id="getcontentAbout">'.get_the_content().'</span>';
			?>
		</div>
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
	</div>
	<?php 
		$count3++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
		
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=3'); 
		foreach ($posts as $post) : start_wp();
		static $count4 = 0; 
		if ($count4 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-4 col-xs-offset-4 wow fadeInRight">
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
		<div class="col-xs-8">
			<?php 
				the_title('<h4>', '</h4>');
				echo'<spanspan id="getcontentAbout">'.get_the_content().'</spanspan>';
			?>
		</div>
	</div>
	<?php 
		$count4++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
	?>
</div>

<div class="row">
	<?php 
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=4'); 
		foreach ($posts as $post) : start_wp();
		static $count5 = 0; 
		if ($count5 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-5 wow rotateInUpLeft" id="toRight">
		<div class="col-xs-8">
			<?php 
				the_title('<h4>', '</h4>');
				echo'<spanspanspan id="getcontentAbout">'.get_the_content().'</spanspanspan>';
			?>
		</div>
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
	</div>
	<?php 
		$count5++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
		
		query_posts('showposts=1');
		$posts = get_posts('post_type=bzbr001-about&post_status=publish&numberposts=1&offset=5'); 
		foreach ($posts as $post) : start_wp();
		static $count6 = 0; 
		if ($count6 == "1") { break; } 
		else { 
	?>
	<div class="col-xs-5 col-xs-offset-2 wow rotateInUpRight">
		<div class="col-xs-4"><figure><img src="<?php echo bzbr001_get_attachment(); ?>"></figure></div>
		<div class="col-xs-8">
			<?php 
				the_title('<h4>', '</h4>');
				echo'<span id="getcontentAbout">'.get_the_content().'</span>';
			?>
		</div>
	</div>
	<?php 
		$count6++; } 
		endforeach; 
	
		// Reset Post Data
		wp_reset_postdata();
	?>
</div>
