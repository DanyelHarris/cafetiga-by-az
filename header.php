<?php 
/* this is the template for header
   @package Jombazar */ 
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo('name'); wp_title(); ?></title>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta charset="<?php bloginfo('charset')?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		
		<?php wp_head(); ?>
	</head>

	<body <?php body_class();?>>
		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Back to Top" data-toggle="tooltip" data-placement="top">
		<span class="glyphicon glyphicon-chevron-up"></span>
		</a>
		<!-- **********************************HEADER SECTION************************************************ -->
		<header>
			<div class="container-fluid">
				<div class="row" id="headinfo">
					<?php dynamic_sidebar('header'); ?>
				</div>
				<div class="row">
					<div class="container-fluid" id="nav-menu">
						<nav class="navbar navbar-default" role="navigation">
						  <div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navdrop">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
							  <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bootstrap-nav-collapse">         
								  <?php $args = array(
										  'theme_location'	=> 'primary',
										  'depth' 			=> 3,
										  'container' 		=> 'false',
										  'menu_class'  		=> 'nav navbar-nav',
										  'walker'  			=> new WP_Bootstrap_Navwalker()
										  );
									wp_nav_menu($args);
								  ?>
								
							</div><!-- /.navbar-collapse -->
						  </div><!-- /.container-fluid -->
						</nav>
					</div>
				</div>
			</div>
		</header>
		
		