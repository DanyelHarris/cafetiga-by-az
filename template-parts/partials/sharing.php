<?php 
   /*@package Jombazar 
   -Share post
	*/ 
?>


<?php 
							
	$title = get_the_title();
	$permalink = get_permalink();
	
	$twitterHandler = (get_option('twitter_id')? '&amp;via='.esc_attr(get_option('twitter_id')): '');
	
	$twitter = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.$twitterHandler.'';
	$facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
	/* $google = 'https://plus.google.com/share?url='.$permalink;  */

?>

<ul id="sharing">
	<li>
		<a href="<?php echo $twitter ?>" target="_blank"><span class="fa fa-twitter-square"></span></a>
	</li>
	<li>
		<a href="<?php echo $facebook ?>" target="_blank"><span class="fa fa-facebook-square"></span></a>
	</li>
	<!-- <li><a href="<?php /* echo $google */ ?>"></a></li> -->
</ul>