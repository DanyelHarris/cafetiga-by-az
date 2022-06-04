<?php 
   /*@package Jombazar */ 
?>


<?php get_header(); ?>

<!-- **************************************CONTENT SECTION**************************************************** -->
<section>
	<div class="container-fluid main" >
		<div class="row">
			<div class="container">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'corporatebusiness' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'corporatebusiness' ); ?></p>

					<?php get_search_form(); ?>
                    
				</div><!-- .page-content -->
			</div>
		</div>
	</div>
</section>

		

<?php get_footer(); ?>