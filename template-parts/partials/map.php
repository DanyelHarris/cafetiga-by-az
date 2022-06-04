<?php 
   /*@package Jombazar 
   -Map
	*/ 

$map = get_posts(array('page'=> 'bazahab_bzbr001_map')); 
$mapIframe = get_option('map_iframe_field');
$mapParalax = get_option('map_paralax_field');
?>

<style type="text/css">
<?php echo bzbr001_map_display(); ?>
</style>
		
<div class="container" style="padding:0;">		
	<div class="container-fluid" id="map-bg-preview" <?php if ( $mapParalax === 'paralax' ): echo 'data-stellar-background-ratio="0.7"'; else: echo ''; endif; ?>>
		<?php if(!empty($mapIframe)): echo $mapIframe; endif; ?>
	</div>
</div>
