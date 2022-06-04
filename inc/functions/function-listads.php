<?php
	
/* remove generator version function
   @package Jombazar */ 

/*
	=================
	 POPUP ADS PAGE
	=================
*/

function bzbr001_add_listads_page(){
	
	//Generate Popup Sub Pages
	add_submenu_page('bzbr001_advertisement', 'Advertisements Listing', 'Advertisement Listing', 'manage_options', 'bzbr001_ads_listing', 'bzbr001_listing_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_listads_settings');
	
}
add_action('admin_menu', 'bzbr001_add_listads_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_listads_settings(){
	
	//Ads listing register settings
	register_setting('bzbr001-ads-list', 'ads_list_id', 'bzbr001_ads_id_callback');

	//Ads listing Options
	add_settings_section('bzbr001-ads-list', 'WAAAAATTT', 'bzbr001_ads_list', 'ads_list');
	add_settings_field('ads-id', 'List of Advertisement Posts' , 'bzbr001_ads_id', 'ads_list', 'bzbr001-ads-list');
	
}



//THIS IS ADS LISTINGS SECTION
function bzbr001_listing_page(){
	require_once(get_template_directory().'/inc/template/popup-listing.php');
}

/*=======Advertisement Listings=========*/

function bzbr001_ads_list(){ 
	echo _('List all posts to appear in pop-up.'); 
}		

function bzbr001_ads_id_callback($input){
	return $input;
}

function bzbr001_ads_id(){

	$ids = cafesatu_ids_array();

	echo '<td></td>';
	$adslistID = get_option('ads_list_id');
	$listID = '';
	$rowclass = 0;
	
	foreach ($ids as $id){
	
		$checked = (@$adslistID[$id] == 1 ? 'checked' : '');
		$listID .= '<tr class="row'.$rowclass.'">';
		
		$listID .= '	<td id="selectAds"><input class="viewingads" type = "checkbox" id="'.$id.'" name="ads_list_id['.$id.']" value="1" '.$checked.'/></td>';
		
		$listID .= '	<td id="titleAds">'.get_the_title($id).'</td>';
		$listID .= '	<td id="actionAds">';
		
		$listID .= '		<a href="#'.$id.'" id="'.$id.'-link" class="link" rel="'.$id.'">
		<span><img title="View" src="'.get_template_directory_uri().'/img/admin/adsview.png"></span></a>';
		
		$listID .= '		<a onclick="return confirm(\'Edit post '.get_the_title($id).'?\')" href="'.admin_url('post.php?post=').$id.'&amp;action=edit" aria-label="Edit “New ads”"><span><img title="Edit" src="'.get_template_directory_uri().'/img/admin/adsedit.png"></span></a>';
		
		$listID .= '		<a onclick="return confirm(\'Are you sure you wish to delete post '.get_the_title($id).'?\')" href="'.get_delete_post_link( $id ).'"><span><img title="Delete" src="'.get_template_directory_uri().'/img/admin/adsremove.png"></span></a>';
		
		$listID .= '	</td>';
		$listID .= '</tr>';
			
		$rowclass = 1 - $rowclass;
	}
	
	echo 	'<table class="widefat">
				<thead>
					<tr>
						<th id="selectAds"><input type="checkbox" name="all" id="all" /></th>
						<th id="titleAds">Title</th>
						<th id="actionAds">Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th id="selectAds"><input type="checkbox" name="all" id="all" /></th>
						<th id="titleAds">Title</th>
						<th id="actionAds">Actions</th>
					</tr>
				</tfoot>
				<tbody>
					'.$listID.'
				</tbody>
			</table>';
	
	
}


function bzbr001_loopid_ads(){
	
	$ids = cafesatu_ids_array();
	
	$adslistID = get_option('ads_list_id');
	$terms = $ids;
	$postadsid = array();
	foreach ($terms as $term){$postadsid[] = (@$adslistID[$term] == 1 ? $term : '');}
	
	return $postadsid;
	
}


/*
	=================
	CUSTOM FUNCTIONS
	=================
*/

function cafesatu_query_all(){

	return $args = array(
	  'post_type' => 'post',
	  'post_status' => 'publish',
	  'posts_per_page'	=> -1,
	  'tax_query' 		=> array(
				array(                
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-aside'),
			))
	);
}


function cafesatu_ids_array(){
	
	$args = cafesatu_query_all();
	
	$ids = array();
		
		$adsid = new WP_Query( $args );
		if ( $adsid->have_posts() ) : 
		  while ( $adsid->have_posts() ) : $adsid->the_post();
			array_push( $ids, get_the_ID() );
		  endwhile;
		endif;
	
	return $ids;
	
}


/*
	=======================
	END OF CUSTOM FUNCTIONS
	=======================
*/
