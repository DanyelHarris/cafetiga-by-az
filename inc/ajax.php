<?php 
   /*@package Jombazar */ 

/*
	=================
	  AJAX FUNCTION
	=================
*/

/* +++++ Front-End +++++ */

//loading pagination
add_action('wp_ajax_nopriv_bzbr001_load_more', 'bzbr001_load_more');  	//for every user
add_action('wp_ajax_bzbr001_load_more', 'bzbr001_load_more');				//for log-in user only

//user contact form
add_action('wp_ajax_nopriv_bzbr001_save_user_contact_form', 'bzbr001_save_contact');  	//for every user
add_action('wp_ajax_bzbr001_save_user_contact_form', 'bzbr001_save_contact');			//for log-in user only

//user review form
add_action('wp_ajax_nopriv_bzbr001_save_user_review_form', 'bzbr001_save_review');  	//for every user
add_action('wp_ajax_bzbr001_save_user_review_form', 'bzbr001_save_review');			//for log-in user only


/* +++++ Back-End +++++ */

//optin form
add_action('wp_ajax_nopriv_bzbr001_save_user_optin_form', 'bzbr001_save_optin');  	//for every user
add_action('wp_ajax_bzbr001_save_user_optin_form', 'bzbr001_save_optin');			//for log-in user only

//promo form
add_action('wp_ajax_nopriv_bzbr001_save_user_promo_form', 'bzbr001_save_promo');  	//for every user
add_action('wp_ajax_bzbr001_save_user_promo_form', 'bzbr001_save_promo');			//for log-in user only

//ads list form
add_action('wp_ajax_nopriv_bzbr001_save_user_ads_list_form', 'bzbr001_save_ads_list');  	//for every user
add_action('wp_ajax_bzbr001_save_user_ads_list_form', 'bzbr001_save_ads_list');			//for log-in user only

/*##############################################################################################################*/

/* +++++ Front-End +++++ */

//loading pagination
function bzbr001_load_more(){
	$slug = $_POST['slug'];
	$paged = $_POST["page"]+1;
	$prev = $_POST["prev"];
	$archive = $_POST["archive"];
	
	if($prev == 1 && $_POST["page"] != 1){
		$paged = $_POST["page"]-1;
	}
		$category_id = get_cat_ID(single_cat_title('', false));
		
		$postform = bzbr001_loop_options();
		if(!empty($postform)){
		
			$args = array(
				'post_type' 	=> 'post',
				'post_status'	=> 'publish',
				'cat'  		=> $category_id,
				'paged'		=> $paged,
				'tax_query' 	=> array(
					array(                
						'taxonomy' => 'post_format',
						/* 'ignore_sticky_posts' => 1, */
						'field' 	=> 'slug',							
						'terms' 	=>  $postform,
						'operator' => 'NOT IN',
					)
				)
			);
		
		}else{
		
			$args = array(
				'post_type' 	=> 'post',
				'post_status'	=> 'publish',
				'cat'  		=> $category_id,
				'paged'		=> $paged,
			);

		}
			
		if($archive != '0'){
			$archVal = explode ('/', $archive);
			$flipped = array_flip($archVal);
			
			switch(isset($flipped)){
			
				case $flipped["category"]:
					$type = "category_name";
					$key = "category";
					break;
				
				case $flipped["tag"]:
					$type = "tag";
					$key = $type;
					break;
				
				case $flipped["author"]:
					$type = "author";
					$key = $type;
					break;
			}
			
			$currKey = array_keys($archVal, $key);
			$nextKey = $currKey[0]+1;
			$value = $archVal[$nextKey];
				
			$args[$type] = $value;
				
			//check page trail and remove "page" value
			if(isset($flipped["page"])){
				$pageVal = explode ('page', $archive);
				$page_trail = $pageVal[0];
			}else{
				$page_trail = $archive;
			}

		}else {
			$page_trail = '/';
		}
		
			$myposts = new WP_Query($args);
			
			if ($myposts->have_posts()) : 
			
				if ( $slug ):
				
				echo '<div class="page-limit" data-page="/'.$slug.'/page/'.$paged.'">';
				
				else: 
				
				echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'">';
				
				endif;
				
			while ($myposts->have_posts()) : $myposts->the_post(); 
			 
				get_template_part('template-parts/post', get_post_format()); 

			endwhile;
				
				echo '</div>';
				
			else:
				
				echo 0;
				
			endif;
			
			// Reset Post Data
			wp_reset_postdata();

	die();
	
}


function bzbr001_check_paged($num = null){
	
	$output = '';
	
	if(is_paged()){$output = 'page/'.get_query_var('paged');}
	if($num == 1){
		$paged = (get_query_var('paged') == 0 ? 1 : get_query_var('paged'));
		return $paged;
	} else {
		return $output;
	}
}


//user contact form
function bzbr001_save_contact(){
	
	$name = wp_strip_all_tags($_POST["name"]);
	$email = wp_strip_all_tags($_POST["email"]);
	$message = wp_strip_all_tags($_POST["message"]);
	$companyName = esc_attr(get_option('company_name'));
	$emailAdd = esc_attr(get_option('email_add'));
	$autoMsg = esc_attr(get_option('autorespond_message')); 
	
	$args = array (
		'post_title'	=>	$name,
		'post_content'=>	$message,
		'post_author'	=>	1,
		'post_status'	=>	'publish',
		'post_type'	=>	'bzbr001-contact',
		'meta_input'	=>	array('_contact_email_value_key' => $email)
	);
	
	$postID = wp_insert_post($args);
	
	if($postID !== 0){
	
		$to = $emailAdd;
		$subject = $companyName.' Contact Form -'.$name;
		$message = $autoMsg.'<br><hr><p>'.$message.'</p>';
		
		$headers[] = 'From:'.$companyName.'<'.$to.'>';
		$headers[] = 'Reply-To:'.$name.'<'.$email.'>';
		$headers[] = 'Content-Type: text/html: charset=UTF-8';
	
		wp_mail($to, $subject, $message, $headers);
		
		echo $postID;
		
	}else{
		echo 0;
	}
	
	die();
}


//user review form
function bzbr001_save_review(){
	
	$title = wp_strip_all_tags($_POST["title"]);
	$reviews = wp_strip_all_tags($_POST["reviews"]);
	$rating = wp_strip_all_tags($_POST["rating"]);
	$name = wp_strip_all_tags($_POST["name"]);
	$email = wp_strip_all_tags($_POST["email"]);
	
	$companyName = esc_attr(get_option('company_name'));
	$emailAdd = esc_attr(get_option('email_add'));
	$autoRev = esc_attr(get_option('review_autorespond')); 
	
	$args = array (
		'post_title'	=>	$title,
		'post_author'	=>	1,
		'post_status'	=> 'pending',
		'post_type'	=>	'bzbr001-reviews',
		'meta_input'	=>	array(
			'review_field' 		=> $reviews,
			'rating_field'			=> $rating,
			'review_by_field'		=> $name,
			'email_address_field'	=> $email,
		)
	);
	
	$postID = wp_insert_post($args);
	
	if($postID !== 0){
	
		$to = $emailAdd;
		$subject = $companyName.' Reviews Form -'.$name;
		$message = $autoRev.'<br><hr><p>'.$reviews.'</p>';
		
		$headers[] = 'From:'.$companyName.'<'.$to.'>';
		$headers[] = 'Reply-To:'.$name.'<'.$email.'>';
		$headers[] = 'Content-Type: text/html: charset=UTF-8';
	
		wp_mail($to, $subject, $message, $headers);
		
		echo $postID;
		
	}else{
		echo 0;
	}
	
	die();
}


//optin form
function bzbr001_save_optin(){
	
	$name = wp_strip_all_tags($_POST["name"]);
	$email = wp_strip_all_tags($_POST["email"]);
	$optinCode = esc_attr(get_option('optin_code'));
	$optinDesc = esc_attr(get_option('optin_desc'));
	
	$optinStart = esc_attr(get_option('optin_start'));
	$optinEnd = esc_attr(get_option('optin_end'));
	
	$companyName = esc_attr(get_option('company_name'));
	$emailAdd = esc_attr(get_option('email_add'));
	$optinAuto = esc_attr(get_option('optin_autoresponder'));
	
	$args = array (
		'post_author'	=>	1,
		'post_status'	=> 'publish',
		'post_type'	=>	'bzbr001-optin',
		'meta_input'	=>	array(
			'optin_code'				=> $optinCode,
			'optin_desc'				=> $optinDesc,
			'optin_name'				=> $name,
			'optin_start'				=> $optinStart,
			'optin_end'				=> $optinEnd,
			'_optin_email_value_key'	=> $email,
		)
	);
	
	$postID = wp_insert_post($args);
	
	if($postID !== 0){
	
		$to = $emailAdd;
		$subject = $companyName.' Subscribe Form -'.$name;
		$message = $optinAuto;
		
		$headers[] = 'From:'.$companyName.'<'.$to.'>';
		$headers[] = 'Reply-To:'.$name.'<'.$email.'>';
		$headers[] = 'Content-Type: text/html: charset=UTF-8';
	
		wp_mail($to, $subject, $message, $headers);
		
		echo $postID;
		
	}else{
		echo 0;
	}
	
	die();
}


/* +++++ Back-End +++++ */

//promo form
function bzbr001_save_promo(){
	
	$optinCode = esc_attr(get_option('optin_code'));
	$optinDesc = esc_attr(get_option('optin_desc'));
	$optinStart = esc_attr(get_option('optin_start'));
	$optinEnd = esc_attr(get_option('optin_end'));
	
	$args = array (
		'post_author'	=>	1,
		'post_status'	=> 'publish',
		'post_type'	=>	'bzbr001-promo',
		'meta_input'	=>	array(
			'promo_code'		=> $optinCode,
			'promo_desc'		=> $optinDesc,
			'promo_start'		=> $optinStart,
			'promo_end'		=> $optinEnd,
		)
	);
	
	$postID = wp_insert_post($args);
	
	die();
}


//ads listing form
/* function bzbr001_save_ads_list(){
	
	$adslistID = $_POST['adslistID'];
	$adslistTitle = $_POST['adsTitle'];
	$adslistadsContent = $_POST['adsContent'];
	
	$args = array (
		'post_title'	=>	$adslistTitle,
		'post_content'	=>	$adslistadsContent,
		'post_author'	=>	1,
		'post_status'	=> 'publish',
		'post_type'	=>	'bzbr001-ads',
		'meta_input'	=>	array(
			'ads_listed_id'	=> $adslistID,
			'promo_desc'		=> $optinDesc,
			'promo_start'		=> $optinStart,
			'promo_end'		=> $optinEnd, 
		)
	);
	
	$postID = wp_insert_post($args);
	
	die();
} */


//ads view 

/* function bzbr001_view_ads(){
	
} */