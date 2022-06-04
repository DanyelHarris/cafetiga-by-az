<?php 
   /*@package Jombazar 
	   -Sosial Media part
	*/ 
?>

<?php
// The Query
$the_query = new WP_Query(array(
	'page'		=> 'bazahab_bzbr001',
));
	
$facebookID = esc_attr(get_option('facebook_id'));
$twitterID = esc_attr(get_option('twitter_id'));
$instagramID = esc_attr(get_option('instagram_id'));
$linkedinID = esc_attr(get_option('linkedin_id'));

if( $the_query->have_posts()  ) : $the_query->the_post();
?>

<!-- social media -->
<ul class="media">
	<?php if(!empty($facebookID)):?>
	<li>
		<a href="http://www.facebook.com/<?php print $facebookID; ?>" target="_blank" id="fb" data-toggle="tooltip" data-placement="bottom" title="Like us"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/ico_facebook.svg"></a>
	</li>
	<?php endif;
	if(!empty($twitterID)):?>
	<li>
		<a href="http://www.twitter.com/<?php print $twitterID; ?>" target="_blank" id="tweet" data-toggle="tooltip" data-placement="bottom" title="Follow us"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/ico_twitter.svg"></a>
	</li>
	<?php endif;
	if(!empty($instagramID)):?>
	<li>
		<a href="http://www.instagram.com/<?php print $instagramID; ?>" target="_blank" id="ig" data-toggle="tooltip" data-placement="bottom" title="Follow us"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/ico_instagram.svg"></a>
	</li>
	<?php endif;
	if(!empty($linkedinID)):?>
	<li>
		<a href="http://www.linkedin.com/<?php print $linkedinID; ?>" target="_blank" id="linkedin" data-toggle="tooltip" data-placement="bottom" title="Join our circle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/ico_linkedin.svg"></a>
	</li>
	<?php endif; ?>
</ul>

<?php 
	endif;
	// Reset Post Data
	wp_reset_postdata();
?>