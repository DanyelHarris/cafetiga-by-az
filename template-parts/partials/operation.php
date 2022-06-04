<?php 
   /*@package Jombazar 
	   -Operation part
	*/ 
?>

<?php
// The Query
$the_query = new WP_Query(array(
	'post_type'	=> 'bzbr001-operation',
	'post_status'	=> 'publish'
));
	
$operation = get_post_meta( get_the_ID(), 'operation_field', true );
$dayopen = get_post_meta( get_the_ID(), 'operation_from_field', true );
$dayclose = get_post_meta( get_the_ID(), 'operation_to_field', true );
$houropen = get_post_meta( get_the_ID(), 'operation_open_field', true );
$hourclose = get_post_meta( get_the_ID(), 'operation_close_field', true );

if( $the_query->have_posts()  ) : $the_query->the_post();
?>

<li>
	<?php		
	if(!empty($dayopen)):
	echo $dayopen;
	endif;
	if(!empty($dayclose)):
	echo ' - ';
	print $dayclose;
	endif;
	if(!empty($houropen)):
	echo ': ';
	print $houropen;
	endif;
	if(!empty($hourclose)):
	echo ' - ';
	print $hourclose;
	endif;
	?>		
</li>

<?php 
	endif;
	// Reset Post Data
	wp_reset_postdata();
?>