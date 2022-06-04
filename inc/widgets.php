<?php
/* 	This is the widgets information
	@package Jombazar */

	
/*====================
	REGISTER WIDGETS
=====================*/

function bazahab_widget_setup() {
   register_sidebar( array(
   'name' 					=> __( 'Header Widget', 'cafesatu' ),
		'id' 				=> 'header',
		'description' 		=> __( 'Widgets for header.', '' ),
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</div>',
		'before_title'  	=> '<h2>',
		'after_title'   	=> '</h2>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Front Page Widget', 'cafesatu' ),
		'id' 				=> 'frontpage',
		'description' 		=> __( 'Middle Section of front page.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
		));
	register_sidebar( array(
		'name' 			=> __( 'Slide Widget', 'cafesatu' ),
		'id' 				=> 'slide',
		'description' 	=> __( 'Slide Images.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Footer Widget', 'cafesatu' ),
		'id' 				=> 'footer',
		'description' 	=> __( 'Widgets for footer.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'About Page Widget', 'cafesatu' ),
		'id' 				=> 'about',
		'description' 	=> __( 'Widgets for middle section of About page.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Sidebar Widget', 'cafesatu' ),
		'id' 				=> 'aside',
		'description' 	=> __( 'Widgets for sidebar.', '' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><br>',
		'before_title'  => '<h6><strong>',
		'after_title'   => '</strong></h6>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Blog Header Widget', 'cafesatu' ),
		'id' 				=> 'blog',
		'description' 	=> __( 'Widgets for blog header.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section><br>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Status Header Widget', 'cafesatu' ),
		'id' 				=> 'status',
		'description' 	=> __( 'Widgets for status archive header.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section><br>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Audio Header Widget', 'cafesatu' ),
		'id' 				=> 'audio',
		'description' 	=> __( 'Widgets for audio archive header.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section><br>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
    ));
	register_sidebar( array(
		'name' 			=> __( 'Video Header Widget', 'cafesatu' ),
		'id' 				=> 'video',
		'description' 	=> __( 'Widgets for video archive header.', '' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section><br>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
    ));
}
add_action( 'widgets_init', 'bazahab_widget_setup' );


/*This is Header Phone Information Widget
******************************************/
class Bazahab_Mobile_Widget extends WP_Widget {
	
 //setup the header widget
 public function __construct(){
	$widget_ops = array(
		'classname' 	=> 'bazahab-mobile-widget',
		'description'	=> __('Phone icon  to place in Header Widget.'),
	);
	parent::__construct('bazahab_mobile',__('Mobile Phone Icon'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may insert your mobile phone number <a href="./admin.php?page=jombazar_bazahab">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	 echo $args['before_widget']; 
		$mobileNo = esc_attr(get_option('mobile_no'));?>
	
		<div class="col-xs-3">
		<?phpif(!empty($mobileNo)):?>
		<span id="phone"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico/ico_phone.svg">  &nbsp;&nbsp; <?php print $mobileNo ?></span>
		</div>

	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Mobile_Widget');
});

	
/*This is Header Logo Widget
******************************************/
class Bazahab_Logo_Widget extends WP_Widget {
	
 //setup the footer navigation widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-logo-widget',
		'description'	=> __('Business logo to place in Header Widget.'),
	);
	parent::__construct('bazahab_logo',__('Logo Icon'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may insert your business logo <a href="./admin.php?page=jombazar_bazahab">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget'];
	
		$companyLogo = esc_attr(get_option('company_logo'));?>
		
		<div class="col-xs-6" id="logo">
		<?php if(!empty($companyLogo)):?>
		<a href="index.php" title="Home"><img src="<?php print $companyLogo;?>"></a>
		<?php endif; ?>
		</div>
	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Logo_Widget');
});


/*This is Social Media Widget
**********************************/
class Bazahab_Social_Widget extends WP_Widget {
	
 //setup the header widget
 public function __construct(){
	$widget_ops = array(
		'classname' 	=> 'bazahab-social-widget',
		'description'	=> __('Social Media links. Place it in Header Widget.'),
	);
	parent::__construct('bazahab_social',__('Social Media Icons'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may insert your sosial media information <a href="./admin.php?page=jombazar_bazahab">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	 echo $args['before_widget'];?>
		 <!-- social media -->
		<div class="col-xs-3" id="sosial">
			<?php get_template_part('template-parts/partials/sosial'); ?>
		</div>
	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Social_Widget');
});


/*This is Operation Widget
**********************************/
class Bazahab_Operation_Widget extends WP_Widget {
	
 //setup the operation widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-operation-widget',
		'description'	=> __('Business hours information. Place it in Footer Widget.'),
	);
	parent::__construct('bazahab_operation',__('Business Hours'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may edit business hours <a href="./edit.php?post_type=store-operation">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
	
	<div class="col-xs-3">
		<h4>Business Hours</h4>
		<ul class="operation">
		
		<?php
				
			// The Query
			$the_query = new WP_Query(array(
				'post_type'	=> 'store-operation',
				'meta_key' 	=> 'operation_field',
				'meta_value' 	=> 'Open'

			));

			// The Loop
			if($the_query->have_posts()):
				while ( $the_query->have_posts() ) : $the_query->the_post();
					
					get_template_part('template-parts/partials/operation');
					
				endwhile;
			endif;

			// Reset Post Data
			wp_reset_postdata();

		?>
		
		</ul>
		<ul class="operation">
		<?php
				
			// The Query
			$the_query = new WP_Query(array(
				'post_type'		=> 'store-operation',
				'posts_per_page'	=> 1,
				'meta_key' 		=> 'operation_field',
				'meta_value' 		=> 'Close'
				));

			// The Loop 
			if($the_query->have_posts()): 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
				
				echo '<span style="text-decoration: underline;">Closed</span>';
														
				endwhile; 
			endif;

			// Reset Post Data
			wp_reset_postdata(); 

		?>  
		
		<?php
				
			// The Query
			$the_query = new WP_Query(array(
				'post_type'	=> 'store-operation',
				'meta_key' 	=> 'operation_field',
				'meta_value' 	=> 'Close'

			));

			// The Loop
			if($the_query->have_posts()):
				while ( $the_query->have_posts() ) : $the_query->the_post();
					
				get_template_part('template-parts/partials/operation');
					
				endwhile;
			endif;

			// Reset Post Data
			wp_reset_postdata();

		?>
		
		</ul>
	</div>
	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Operation_Widget');
});


/*This is Updates Widget
**********************************/
class Bazahab_Updates_Widget extends WP_Widget {
	
 //setup the updates widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-updates-widget',
		'description'	=> __('Latest status to display in footer.'),
	);
	parent::__construct('bazahab_updates',__('Updates'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Information retrieve from status post.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
	 <div class="col-xs-4">
		<h4>Updates</h4>
		<?php

			// The Query
			$latest_status = new WP_Query( array(
				'posts_per_page'	=> 1,
				'tax_query' => array(
						array(                
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-status'),
				))
			));  

			// The Loop
			if($latest_status->have_posts()):
				while ( $latest_status->have_posts() ) : $latest_status->the_post();
				echo '<p>';
				echo excerpt(30);
				echo '</p>';
				endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
	</div>
	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Updates_Widget');
});


/*This is Status Widget
**********************************/
class Bazahab_Status_Widget extends WP_Widget {
	
 //setup the updates widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-status-widget',
		'description'	=> __('Display your status in page.'),
	);
	parent::__construct('bazahab_status',__('Status'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Newsfeed and updated status.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
		<?php

			// The Query
			$status = new WP_Query( array(
				'posts_per_page'	=> 1,
				'tax_query' => array(
						array(                
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-status'),
				))
			));  

			// The Loop
			if($status->have_posts()):
			while ( $status->have_posts() ) : $status->the_post(); ?>
			<?php get_template_part('template-parts/post', get_post_format()); ?>
			<?php	endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
	<?php echo $args['after_widget'];
 }
}
$statusWidget = get_option ('status_widget_field');
	if(@$statusWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Status_Widget');
	});
}

/*This is Link Widget
**********************************/
class Bazahab_Link_Widget extends WP_Widget {
	
 //setup the updates widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-link-widget',
		'description'	=> __('Display links to other site.'),
	);
	parent::__construct('bazahab_link',__('Links'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Information retrieve from links post.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
		<?php

			// The Query
			$link = new WP_Query( array(
				'posts_per_page'	=> 1,
				'tax_query' => array(
						array(                
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-link'),
				))
			));  

			// The Loop
			if($link->have_posts()):
			while ( $link->have_posts() ) : $link->the_post(); ?>
			<?php get_template_part('template-parts/post', get_post_format()); ?>
			<?php	endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
	<?php echo $args['after_widget'];
 }
}
/* Activate link widget */
$linkWidget = get_option ('link_widget_field');
	if(@$linkWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Link_Widget');
	});
}

/*This is Gallery Widget
**********************************/
class Bazahab_Gallery_Widget extends WP_Widget {
	
 //setup the updates widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-gallery-widget',
		'description'	=> __('Display picture gallery slider.'),
	);
	parent::__construct('bazahab_gallery',__('Gallery Slider'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Information retrieve from gallery pictures.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
		<?php

			// The Query
			$gallery = new WP_Query( array(
				'tax_query' => array(
						array(                
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-gallery'),
				))
			));  

			// The Loop
			if($gallery->have_posts()):
			while ( $gallery->have_posts() ) : $gallery->the_post(); ?>
			<?php get_template_part('template-parts/partials/carousel'); ?>
			<?php	endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
	<?php echo $args['after_widget'];
 }
}
/* Activate link widget */
$galleryWidget = get_option ('gallery_widget_field');
	if(@$galleryWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Gallery_Widget');
	});
}

/*This is Pop-up Widget
**********************************/
class Bazahab_Aside_Widget extends WP_Widget {
	
 //setup the updates widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-aside-widget',
		'description'	=> __('Display Advertisement.'),
	);
	parent::__construct('bazahab_aside',__('Advertisement Widget'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Display promotion advertisement posted from aside post formats.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
		<?php

			// The Query
			$aside = new WP_Query( array(
				'posts_per_page'	=> 1,
				'tax_query' => array(
						array(                
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-aside'),
				))
			));  

			// The Loop
			if($aside->have_posts()):
			while ( $aside->have_posts() ) : $aside->the_post(); ?>
			<?php get_template_part('template-parts/post', get_post_format()); ?>
			<?php	endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();

		?>
	<?php echo $args['after_widget'];
 }
}
/* Activate link widget */
$asideWidget = get_option ('aside_widget_field');
	if(@$asideWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Aside_Widget');
	});
}

/*This is Footer Navigation Widget
**********************************/
class Bazahab_Footer_Nav_Widget extends WP_Widget {
	
 //setup the footer navigation widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-footer-navigation-widget',
		'description'	=> __('Other links to place in footer.'),
	);
	parent::__construct('bazahab_footer_navigation',__('Footer Navigation'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may edit your navigation <a href="./nav-menus.php">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget']; ?>
	 <div class="col-xs-2">
		<h4>More about us</h4>
		<?php
			wp_nav_menu( array(
			  'theme_location' => 'secondary',
			  'sub_menu'       => true,
			  'direct_parent'  => true
			) );
			?>
		
	</div>
	<?php echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Footer_Nav_Widget');
});

/*This is Contact Information Widget
**********************************/
class Bazahab_Contact_Widget extends WP_Widget {
	
 //setup the header widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-contact-widget',
		'description'	=> __('Address and contact number. Place it in Footer Widget.'),
	);
	parent::__construct('contact',__('Contact Information'), $widget_ops);
	}
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may insert your contact information <a href="./admin.php?page=jombazar_bazahab">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	 echo $args['before_widget'];
	 ?>
	 <div class="col-xs-3">
		<h4>Contact</h4>
		<?php get_template_part('template-parts/partials/address'); ?>
	</div>
	<?php  
	 echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Contact_Widget');
});

/*This is Slides Widget
**********************************/
class Bazahab_Slides_Widget extends WP_Widget {
	
 //setup the slides widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-slides-widget',
		'description'	=> __('Images from about slide posts.'),
	);
	parent::__construct('bazahab_slides',__('Slide Images'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may insert your slide images <a href="./edit.php?post_type=store-slide">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget'];
	 get_template_part('template-parts/partials/slide');
	echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Slides_Widget');
});

/*This is Paralax Widget
**********************************/
class Bazahab_Paralax_Widget extends WP_Widget {
	
 //setup the paralax widget
 public function __construct(){
	$widget_ops = array(
		'classname' 	=> 'bazahab-paralax-widget',
		'description'	=> __('Latest quote posts.'),
	);
	parent::__construct('bazahab_paralax',__('Quotes Post'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('Information retrieve from quote posts.');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget'];
	// The Query
	$paralax = new WP_Query( array(
		'posts_per_page'=> 1,
		'tax_query' => array(
			array( 
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					 'post-format-quote',
				)
			)
		)
	));

	// The Loop
	if($paralax->have_posts()):
		while ( $paralax->have_posts() ) : $paralax->the_post();
		get_template_part('template-parts/post', get_post_format());
		endwhile; 
	endif; 
				
	// Reset Post Data
	wp_reset_postdata();

	echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Paralax_Widget');
});


/*This is Testimony Widget
**********************************/
class Bazahab_Testimony_Widget extends WP_Widget {
	
 //setup the testimony widget
 public function __construct(){
	$widget_ops = array(
		'classname' 		=> 'bazahab-testimony-widget',
		'description'	=> __('Reviews from others.'),
	);
	parent::__construct('bazahab_testimony',__('Testimony List'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p>You may review testimonies <a href="./edit.php?post_type=store-reviews">here</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget'];
		get_template_part('template-parts/partials/testimony');
	echo $args['after_widget'];
 }
}
/* Activate testimony widget */
$revWidget = get_option ('review_widget');
	if(@$revWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Testimony_Widget');
	});
}


/*This is Map Widget 
**********************************/
class Bazahab_Map_Widget extends WP_Widget {
	
 //setup the header widget
 public function __construct(){
	$widget_ops = array(
		'classname' 	=> 'bazahab-map-widget',
		'description'	=> __('Store location in Google map.'),
	);
	parent::__construct('bazahab_map',__('Store Location'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 echo __('<h2>Edit Data</h2><p><a href="./admin.php?page=jombazar_bazahab_map">Setting page</a>');
 }
 //front-end display of this widget
 public function widget($args, $instance){
	echo $args['before_widget'];
		get_template_part('template-parts/partials/map'); 
	echo $args['after_widget'];
 }
}
/* Activate map widget */
$mapWidget = get_option ('map_widget_field');
	if(@$mapWidget == 1){
	add_action('widgets_init', function(){
		register_widget('Bazahab_Map_Widget');
	});
}


/*This is Popular Post Widget
**********************************/
class Bazahab_Popular_Posts_Widget extends WP_Widget {
	
 //setup the header widget
 public function __construct(){
	$widget_ops = array(
		'classname' 	=> 'bazahab-popular-posts-widget',
		'description'	=> __('Shows popular posts.'),
	);
	parent::__construct('bazahab_popular_posts',__('Popular Posts'), $widget_ops);
 }
 //back-end display of this widget
 public function form($instance){
	 
	 $title = (!empty($instance['title']) ? $instance['title'] : 'Popular Posts');
	 $tot = (!empty ($instance['tot']) ? absint($instance['tot']) : 4);
	 
	 $output = '<p>';
	 $output .= '<label for="'.esc_attr($this->get_field_id('title')).'">Title:</label>';
	 $output .= '<input type="text" class="widefat" id="'.esc_attr($this->get_field_id('title')).'" name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr($title).'">';
	 $output .= '</p>';
	 
	 $output .= '<p>';
	 $output .= '<label for="'.esc_attr($this->get_field_id('tot')).'">Number of posts:</label>';
	 $output .= '<input type="number" class="widefat" id="'.esc_attr($this->get_field_id('tot')).'" name="'.esc_attr($this->get_field_name('tot')).'" value="'.esc_attr($tot).'">';
	 $output .= '</p>';
	 
	 echo $output;
	 
	 
 }
 //update widget
 /* public function update($new_instance, $old_instance){
	$instance = array();
	$instance['title'] = (!empty ($new_instance['title']) ? strip_tags($new_instance['title']): '');
	$instance['tot'] = (!empty ($new_instance['tot']) ? absint(strip_tags($new_instance['tot'])): 0);
	
	return $instance;
 } */
 
 //front-end display of this widget
 public function widget($args, $instance){
 
	$tot = absint ($instance['tot']);
	$post_args = array (
		'post_type' 		=> 'post',
		'post_per_page'	=> $tot,
		'meta_key'		=> 'store_post_views',
		'orderby'			=> 'meta_value_num',
		'order'			=> 'DESC'
	);
	
	$posts_query = new WP_Query ($post_args);	
	
	echo $args['before_widget'];
	
	if (!empty($instance['title'])):
		echo $args['before_title'].apply_filters('widget_title', $instance['title']).$args['after_title'];
	endif;
		
	if($posts_query->have_posts()):
		
		while ( $posts_query->have_posts() ) : $posts_query->the_post();
			echo '<div class="row" id="popPosts">';
				echo '<div class="col-xs-4" id="popPic" style="background-image: url('.bzbr001_get_attachment().');"></div>';
			
				echo '<div class="col-xs-8" id="popTitle">
						<div class="row">
							<a href="'.esc_url(get_permalink()).'">'.get_the_title(). '</a>
						</div>
						<div class="row text-right">
							'.store_popular_meta().'
						</div>
					</div>';
			echo '</div>';	
		endwhile;
		
	endif;
	
	echo $args['after_widget'];
 }
}
add_action('widgets_init', function(){
	register_widget('Bazahab_Popular_Posts_Widget');
});


/*====================
  TAGS CUSTOM FUNCTION
=====================*/

function store_tag_cloud_font_change($args){
	$args['smallest'] = 10;
	$args['largest'] = 10;
	
	return $args;
}
add_filter('widget_tag_cloud_args','store_tag_cloud_font_change');


/*====================
  POPULAR POST
=====================*/

function store_save_post_views($postID){
	
	$metaKey = 'store_post_views';
	$views	= get_post_meta($postID,$metaKey, true);
	
	$count = (empty($views) ? '0' : $views);
	$count++;
	
	update_post_meta($postID, $metaKey, $count);
	
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function store_popular_meta(){
	ob_start();
	$date_post = the_time('F j, Y');
	return ob_get_clean();
	
	return $date_post;
}