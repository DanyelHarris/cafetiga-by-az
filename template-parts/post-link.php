<?php 
   /*@package Jombazar 
   -Link Post Formats
	*/ 
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('store-format-link'); ?>>
	<section class="post-link clearfix">
		<div class="container-fluid" id="linkWrap"> 
			<div class="row text-center" id="linkTitle">
				<?php 
					$link = bzbr001_grab_url();
					the_title('<h1 class="entry-title"><a href="'.$link.'" target="_blank">', '<div class="link-icon"><span class="fa fa-link"></span></div></a></h1>'); 
				?>
			</div>	
		</div>
	</section> 
</article>

