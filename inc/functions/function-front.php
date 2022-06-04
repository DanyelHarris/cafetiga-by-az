<?php
	
/* remove generator version function
   @package Jombazar */ 

/*
	=================
		FRONT PAGE
	=================
*/

// Changing excerpt
function new_excerpt_more($more) {
	global $post; 
   return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more'); 

/* if (is_menu() ):
	function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
endif; */

function excerpt($limit) { 
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'… <a href="'. get_permalink($post->ID) . '">' . 'More &raquo;' . '</a>';
	} else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'{...}';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

// Add CPT to Navigation
function prefix_add_metabox_menu_posttype_archive(){
  add_meta_box( 'prefix_metabox_menu_posttype_archive', __( 'Archives' ), 'prefix_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default' );
}
add_action( 'admin_head-nav-menus.php', 'prefix_add_metabox_menu_posttype_archive' );

function prefix_metabox_menu_posttype_archive(){
  $post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );

  if( $post_types ){

    foreach( $post_types as $post_type ){

      $post_type->classes = array( $post_type->name );
      $post_type->type = $post_type->name;
      $post_type->object_id = $post_type->name;
      $post_type->title = $post_type->labels->name;
      $post_type->object = 'cpt_archive';

    }

    $walker = new Walker_Nav_Menu_Checklist( array() );?>
    <div id="cpt-archive" class="posttypediv">
      <div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
        <ul id="ctp-archive-checklist" class="categorychecklist form-no-clear"><?php
        echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $post_types ), 0, (object) array( 'walker' => $walker ) );?>
        </ul>
      </div>
    </div>
    <p class="button-controls">
      <span class="add-to-menu">
        <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
      </span>
    </p><?php
  }
}

function prefix_cpt_archive_menu_filter( $items, $menu, $args ){
  foreach( $items as &$item ){
    if( $item->object != 'cpt_archive' ) continue;
    $item->url = get_post_type_archive_link( $item->type );
    if( get_query_var( 'post_type' ) == $item->type ){
      $item->classes []= 'current-menu-item';
      $item->current = true;
    }
  }
  return $items;
}
add_filter( 'wp_get_nav_menu_items', 'prefix_cpt_archive_menu_filter', 10, 3 );

// Add Breadcrumb
function my_breadcrumbs() {
 
    /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
 
    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ' &raquo; '; // delimiter between crumbs
    $before         = '<span class="current">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */
 
    global $post;
	 /* $home_link    = home_url('/'); sepatutnya */
    $home_link    = home_url('');
    $link_before  = '<span typeof="v:Breadcrumb">';
    $link_after   = '</span>';
    $link_attr    = ' rel="v:url" property="v:title"';
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');
 
    if (is_home() || is_front_page()) {
 
        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
 
    } else {
 
        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
        if ($show_home_link == 1) {
            echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }
 
        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 
        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
 
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
 
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
 
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
					/* printf($link, $home_link . ' . $slug['slug'] . ', $post_type->labels->singular_name); sepatutnya*/ 
                printf($link, $home_link . '/menu/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
 
        } elseif ( is_attachment() ) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
            $cats = str_replace('</a>', '</a>' . $link_after, $cats);
            if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
            echo $cats;
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
 
        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;
 
        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }
 
        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
        echo '</div><!-- .breadcrumbs -->';
 
    }
}


/*====================
	LOOP OPTIONS
=====================*/

function bzbr001_loop_options(){
	$formats = get_option('activate_post_options');
	$terms = array (
		'post-format-aside', 
		'post-format-gallery', 
		'post-format-quote', 
		'post-format-status', 
		'post-format-image', 
		'post-format-video', 
		'post-format-audio', 
		'post-format-link'
	);
	$postform = array();
	foreach ($terms as $term){$postform[] = (@$formats[$term] == 1 ? $term : '');}
	
	return $postform;
}


/*=========================
BLOG LOOP CUSTOM FUNCTION
=========================*/

//standard post formats meta
function bzbr001_posted_meta(){
$categories = get_the_category();
$separator	= ', ';
$output	= '';
$i = 1;

	if(!empty($categories)):
		foreach ($categories as $category):
			
			if($i > 1): $output .= $separator; endif;
		
			$output .= '<a href="'.esc_url(get_category_link($category->term_id)).'" alt="'.esc_attr('View all posts in%s', $category->name).'">'.esc_html($category->name).'</a>';
			$i++;
		endforeach;
	endif;
	
	if (!empty ($output)) : $span = '<span class="fa fa-tags"></span>'; endif;
	
	$comments_num	= get_comments_number();
		if(comments_open()){
			if($comments_num == 0){
				$comments = __('No comments');
			}elseif ($comments_num > 1) {
				$comments = __(' comments');
			}else {
				$comments = __('1 comment');
			}
			$comments = '<a href="'. get_comments_link().'">'.$comments.'</a>';
		} else {
			$comments = __('Comments are closed');
		}
		
return'<span class="fa fa-comments-o"></span>'.$comments.''. $span .''.$output;
}

//image post formats meta
function bzbr001_image_meta(){
$posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));	
$categories = get_the_category();
$separator	= ', ';
$output	= '';
$i = 1;

	if(!empty($categories)):
		foreach ($categories as $category):
			
			if($i > 1): $output .= $separator; endif;
		
			$output .= '<a href="'.esc_url(get_category_link($category->term_id)).'" alt="'.esc_attr('View all posts in%s', $category->name).'">'.esc_html($category->name).'</a>';
			$i++;
		endforeach;
	endif;
	if (!empty ($output)) : $span = '<span class="fa fa-tags"></span>'; endif;
	
	$comments_num	= get_comments_number();
		if(comments_open()){
			if($comments_num == 0){
				$comments = __('No comments');
			}elseif ($comments_num > 1) {
				$comments = __(' comments');
			}else {
				$comments = __('1 comment');
			}
			$comments = '<a href="'. get_comments_link().'">'.$comments.'</a>';
		} else {
			$comments = __('Comments are closed');
		}
		
return'<ul class="List">
			<li><span class="fa fa-comments-o"></span> '.$comments.'</li>
			<li>'.$span.' '.$output.'</li>
			<li>Posted on '.$posted_on.' ago</li>
		<ul>';
}

//status post formats meta
function bzbr001_status_meta(){
$posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));	
return'<span class="posted-on">Posted on '.$posted_on.' ago</span>';
}

function bzbr001_status_footer(){
$comments_num	= get_comments_number();
		if(comments_open()){
			if($comments_num == 0){
				$comments = __('No comments');
			}elseif ($comments_num > 1) {
				$comments = __(' comments');
			}else {
				$comments = __('1 comment');
			}
			$comments = '<a href="'. get_comments_link().'">'.$comments.'</a>';
		} else {
			$comments = __('Comments are closed');
		}
		
return'<span class="fa fa-comments-o"></span>'.$comments;
}

//image & gallery post formats meta
function bzbr001_get_attachment($num = 1){	
$output = '';
If(has_post_thumbnail() && $num == 1):
	$output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));

else :
	$attachments = get_posts(array(
		'post_type' 		=> 'attachment',
		'posts_per_page'	=> $num,
		'post_parent'		=> get_the_ID(),
	));
	if($attachments && $num == 1):
		foreach ($attachments as $attachment):
			$output = wp_get_attachment_url( $attachment->ID);
		endforeach;
	elseif ($attachments && $num > 1):
		$output = $attachments;
	endif;
	
/* wp_reset_postdata();	 */

endif;

return $output;

wp_reset_postdata();	
}

//gallery slider post formats meta
function bzbr001_get_bs_slides($attachments){
	
	$output = array();
	$count = count($attachments)-1;
	
	for ($i = 0; $i <= $count; $i++): 
	
		$active = ( $i == 0 ? ' active' : '');
		
		$n = ($i == $count ? 0 : $i+1);
		$nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID);
		$p = ($i == 0 ? $count : $i-1);
		$prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID);
	
		$output[$i] = array(
			'class'		=> $active,
			'url'			=> wp_get_attachment_url( $attachments[$i]->ID),
			'next_img'	=> $nextImg,
			'prev_img'	=> $prevImg,
			'caption'		=> $attachments[$i]->post_excerpt,
			'title'		=> $attachments[$i]->post_title
		);
	
	endfor; 
	
	return $output;
}


//audio post formats meta
function bzbr001_get_embedded_media ($type = array()){
	$content = do_shortcode(apply_filters('the_content', get_the_content()));
	$embed = get_media_embedded_in_content ($content, $type);
	
	if(in_array('audio', $type)):
		$ouput = str_replace('?visual=true', '?visual=false', $embed[0]);
	else:
		$ouput =  $embed[0];
	endif;
	
return $ouput;
}

//link post formats meta
function bzbr001_grab_url(){
	if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)){
		return false;
	}
	return esc_url_raw($links[1]);
}

function bzbr001_grab_current_uri(){
	$http = (isset($_SERVER["HTTPS"])? 'https://':'http://');
	$referer = (isset ($_SERVER["HTTP_REFERER"])? rtrim ($_SERVER["HTTP_REFERER"], "/"): $http.$_SERVER["HTTP_HOST"]);
	$archive_url = /* $referer. */$_SERVER["REQUEST_URI"];
	
	return $archive_url;
}


//video post formats header
function custom_video_header_pages( $active ) {
  if( is_home() || is_page() ) {
    return true;
  }

  return false;
}
add_filter( 'is_header_video_active', 'custom_video_header_pages' );

function custom_video_active_callback() {
  if( !is_user_logged_in() && !is_home() || is_page()) {
    return true;
  }
  return false;
}

function my_header_video_settings( $settings ) {
  $settings['minWidth'] = 680;
  $settings['minHeight'] = 400;
  return $settings;
}
add_filter( 'header_video_settings', 'my_header_video_settings');

//audio post formats header
/* function remove_mediaelement_styles() {
    if( is_tax( 'post_format', 'post-format-audio' ) ) {
	wp_dequeue_style('wp-mediaelement');
	wp_deregister_style('wp-mediaelement');
    }
}
add_action( 'wp_print_styles', 'remove_mediaelement_styles' ); */



/*====================
 SHARE POST
=====================*/

function bzbr001_share_this ($content){
	if(is_single()){
		$content .= '<div class="row" id="shareholic">';
		$content .= '<h3 id="sharing">Care to share? </h3>';
		
			$title = get_the_title();
			$permalink = get_permalink();
			$twitterHandler = (get_option('twitter_id')? '&amp;via='.esc_attr(get_option('twitter_id')): '');
			
			$twitter = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.$twitterHandler.'';
			$facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
			/* $google = 'https://plus.google.com/share?url='.$permalink;  */
		
		$content .= '<ul id="sharing">';
		$content .=	'<li><a href="'.$twitter.'" target="_blank"><span class="fa fa-twitter-square"></span></a></li>';
		$content .=	'<li><a href="'.$facebook.'" target="_blank"><span class="fa fa-facebook-square"></span></a></li>';
		/* $output .=	'<li><a href="'.$google .'"></a></li>'; */
		$content .=	'</ul>';
		$content .= '</div>';

		return $content;
	} else {
		return $content;
	}
}
add_filter ('the_content', 'bzbr001_share_this');


/*====================
	SINGLE POST
=====================*/

//Tags in post
function tags_after_single_post_content($content) {	
	if( is_singular('post') && is_main_query() ) {

		$tags = the_tags('<div class="entry-meta">Tagged with: ',' • ','</div><br />'); 
		$content .= $tags;
    }
return $content;
}
add_filter( 'the_content', 'tags_after_single_post_content' );


//Post Navigation
function bzbr001_post_navigation(){
	$nav = '<div class="row" id="post-navi">';
	
	$prev = get_previous_post_link('<div class="post-link-nav" ><span class="fa fa-angle-left" aria-hidden="true"></span>%link</div>', '%title');
	$nav .= '<div class="col-xs-6" style="
    padding-left: 0px;">'.$prev.'</div>';
	
	$next = get_next_post_link('<div class="post-link-nav">%link<span class="fa fa-angle-right" aria-hidden="true"></span></div>', '%title');
	$nav .= '<div class="col-xs-6 text-right">'.$next.'</div>';
	
	$nav .='</div>';
	
	return $nav;
}


//comment navigation
function bzbr001_get_post_navigation(){
	/* if(get_comment_pages_count() > 1 && get_option('page_comments')):  */
		require(get_template_directory().'/inc/template/store-comment-nav.php');
	/* endif */;
}



/*====================
	MAIL TRAP - for dev purpose only
=====================*/

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '35ae51d028c1ad';
  $phpmailer->Password = 'f94b783825d016';
}

add_action('phpmailer_init', 'mailtrap');



/*====================
	LIKE POST
=====================*/

/* function post_like()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
     
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];
         
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];
 
        if(!is_array($voted_IP))
            $voted_IP = array();
         
        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);
 
        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
 
            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);
             
            // Display count (ie jQuery return value)
            echo $meta_count;
        }
        else
            echo "already";
    }
    exit;
}
add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

function hasAlreadyVoted($post_id)
{
    global $timebeforerevote;
 
    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    $voted_IP = $meta_IP[0];
     
    if(!is_array($voted_IP))
        $voted_IP = array();
         
    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];
     
    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
         
        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;
             
        return true;
    }
     
    return false;
}

function getPostLikeLink($post_id)
{
    $themename = "cafesatu";
 
    $vote_count = get_post_meta($post_id, "votes_count", true);
 
    $output = '<p class="post-like">';
    if(hasAlreadyVoted($post_id))
        $output .= ' <span title="'.__('I like this article', $themename).'" class="like alreadyvoted"></span>';
    else
        $output .= '<a href="#" data-post_id="'.$post_id.'">
                    <span  title="'.__('I like this article', $themename).'"class="qtip like"></span>
                </a>';
    $output .= '<span class="count">'.$vote_count.'</span></p>';
     
    return $output;
} */




