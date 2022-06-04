<?php
	
/* remove generator version function
   @package Jombazar */ 

/*
	=================
	 POPUP ADS PAGE
	=================
*/

function bzbr001_add_popads_page(){
	
	//Generate Popup Pages
	$popup = get_option ('activate_popup');
	if(@$popup == 1){
	add_menu_page('Store Popup', 'Advertisement', 'manage_options', 'bzbr001_advertisement', 'bzbr001_popup_page', get_template_directory_uri().'/img/admin/popup.png', 27);
	}
	
	//Generate Popup Sub Pages
	add_submenu_page('bzbr001_advertisement', 'Store Advertise Popup', 'Pop-up Settings', 'manage_options', 'bzbr001_advertisement', 'bzbr001_popup_page');
	
	//Activate custom settings
	add_action('admin_init', 'bzbr001_popads_settings');
	
}
add_action('admin_menu', 'bzbr001_add_popads_page');

/*THIS IS REGISTER AND OPTIONS SETTINGS*/
function bzbr001_popads_settings(){
	
	//Ads Popup trigger register settings 
	register_setting('bzbr001-popup-settings', 'popup_trigger');
	register_setting('bzbr001-popup-settings', 'popup_animate_entrance');
	register_setting('bzbr001-popup-settings', 'popup_animate_exit');
	register_setting('bzbr001-popup-settings', 'popup_delay');
	
	//Ads Popup Trigger Options 
	add_settings_section('bzbr001-popup-options', '', 'bzbr001_popup_options', 'bzbr001_popup');
	add_settings_field('popup-trigger','', 'bzbr001_popup_trigger', 'bzbr001_popup', 'bzbr001-popup-options');
	
	//Ads Popup box register settings 
	register_setting('bzbr001-popup-settings', 'popup_size');
	register_setting('bzbr001-popup-settings', 'popup_button');
	register_setting('bzbr001-popup-settings', 'popup_button_2');
	register_setting('bzbr001-popup-settings', 'popup_button_3');
	register_setting('bzbr001-popup-settings', 'popup_button_css');
	register_setting('bzbr001-popup-settings', 'popup_button_choice');
	register_setting('bzbr001-popup-settings', 'popup_button_back_css');
	register_setting('bzbr001-popup-settings', 'popup_close');
	register_setting('bzbr001-popup-settings', 'popup_close_button_css');
	register_setting('bzbr001-popup-settings', 'popup_close_button_choice');
	register_setting('bzbr001-popup-settings', 'popup_animate');
	
	//Ads Popup Box Options 
	add_settings_section('bzbr001-popup-box', '', 'bzbr001_popup_box', 'bzbr001_popup');
	add_settings_field('modal-options','', 'bzbr001_modal_options', 'bzbr001_popup', 'bzbr001-popup-box');
	
	//Ads Popup loop register settings 
	register_setting('bzbr001-popup-settings', 'popup_loop');
	register_setting('bzbr001-popup-settings', 'popup_perpage');
	
	//Ads Popup Loop Options
	add_settings_section('bzbr001-popup-slide', '', 'bzbr001_popup_slide', 'bzbr001_popup');
	add_settings_field('popup-loop','', 'bzbr001_popup_loop', 'bzbr001_popup', 'bzbr001-popup-slide');
	
	}


//THIS IS POPUP OPTIONS SECTION
function bzbr001_popup_page(){
	require_once(get_template_directory().'/inc/template/popup-setting.php');
}
 
/*=======Advertisement Option=========*/
function bzbr001_popup_options(){
	return 'Settings for this advertisement pop-up appearance.';	
}

function bzbr001_popup_trigger(){	echo '<td></td>'; ?>
	
	<table class="widefat">
		<thead>
		
			<tr>
				<th id="titleAds"><label>Popup Options</label></th>
				<th id="titleAds"></th>
			</tr>
			
		</thead>
		<tbody>
		
			<tr> <!-- opening -->
				<td class="wrapOptions">
					<span class="italic"><?php echo bzbr001_popup_options(); ?></span>
					<br><br>
					<table class="modalAnimate"> <!-- nested table -->
						<tr>
							<td id="label"><label>Trigger </label> </td>
							<td>
							<?php $popupTrigger = esc_attr(get_option('popup_trigger')); ?>

								<input type="radio" name="popup_trigger" id="popup_trigger" value="onclickModal"<?php checked( 'onclickModal' == $popupTrigger); ?> /> click a button &nbsp; &nbsp;
								<input type="radio" name="popup_trigger" id="popup_trigger" value="onloadModal"<?php checked( 'onloadModal' == $popupTrigger); ?> /> page load &nbsp; &nbsp;	
							</td>
						</tr>	
						<tr>
							<td id="label"><label>Box animation</label></td>
							<td>
							<?php 
							$popupanimateEntrance = esc_attr(get_option('popup_animate_entrance')); 
							$popupanimateExit = esc_attr(get_option('popup_animate_exit'));
							?>
							
								<table class="modalAnimate">
									<td><span> Entrance</span>										
										<select name="popup_animate_entrance" id="popup_animate_entrance" >
											<optgroup label="Attention Seekers">
												<option value="bounce" <?php selected( $popupanimateEntrance, 'bounce'); ?>>bounce</option>
												<option value="flash" <?php selected( $popupanimateEntrance, 'flash'); ?>>flash</option>
												<option value="pulse" <?php selected( $popupanimateEntrance, 'pulse'); ?>>pulse</option>
												<option value="rubberBand" <?php selected( $popupanimateEntrance, 'rubberBand'); ?>>rubberBand</option>
												<option value="shake" <?php selected( $popupanimateEntrance, 'shake'); ?>>shake</option>
												<option value="swing" <?php selected( $popupanimateEntrance, 'swing'); ?>>swing</option>
												<option value="tada" <?php selected( $popupanimateEntrance, 'tada'); ?>>tada</option>
												<option value="wobble" <?php selected( $popupanimateEntrance, 'wobble'); ?>>wobble</option>
												<option value="jello" <?php selected( $popupanimateEntrance, 'jello'); ?>>jello</option>
											</optgroup>
											<optgroup label="Bouncing Entrances">
												<option value="bounceIn" <?php selected( $popupanimateEntrance, 'bounceIn'); ?>>bounceIn</option>
												<option value="bounceInDown" <?php selected( $popupanimateEntrance, 'bounceInDown'); ?>>bounceInDown</option>
												<option value="bounceInLeft" <?php selected( $popupanimateEntrance, 'bounceInLeft'); ?>>bounceInLeft</option>
												<option value="bounceInRight"<?php selected( $popupanimateEntrance, 'bounceInRight'); ?>>bounceInRight</option>
												<option value="bounceInUp" <?php selected( $popupanimateEntrance, 'bounceInUp'); ?>>bounceInUp</option>
											</optgroup>
											<optgroup label="Fading Entrances">
												<option value="fadeIn" <?php selected( $popupanimateEntrance, 'fadeIn'); ?>>fadeIn</option>
												<option value="fadeInDown" <?php selected( $popupanimateEntrance, 'fadeInDown'); ?>>fadeInDown</option>
												<option value="fadeInDownBig" <?php selected( $popupanimateEntrance, 'fadeInDownBig'); ?>>fadeInDownBig</option>
												<option value="fadeInLeft" <?php selected( $popupanimateEntrance, 'fadeInLeft'); ?>>fadeInLeft</option>
												<option value="fadeInLeftBig" <?php selected( $popupanimateEntrance, 'fadeInLeftBig'); ?>>fadeInLeftBig</option>
												<option value="fadeInRight" <?php selected( $popupanimateEntrance, 'fadeInRight'); ?>>fadeInRight</option>
												<option value="fadeInRightBig" <?php selected( $popupanimateEntrance, 'fadeInRightBig'); ?>>fadeInRightBig</option>
												<option value="fadeInUp" <?php selected( $popupanimateEntrance, 'fadeInUp'); ?>>fadeInUp</option>
												<option value="fadeInUpBig" <?php selected( $popupanimateEntrance, 'fadeInUpBig'); ?>>fadeInUpBig</option>
											</optgroup>
											<optgroup label="Flippers">
												<option value="flip" <?php selected( $popupanimateEntrance, 'flip'); ?>>flip</option>
												<option value="flipInX" <?php selected( $popupanimateEntrance, 'flipInX'); ?>>flipInX</option>
												<option value="flipInY" <?php selected( $popupanimateEntrance, 'flipInY'); ?>>flipInY</option>
												</optgroup>
												<optgroup label="Lightspeed">
												<option value="lightSpeedIn" <?php selected( $popupanimateEntrance, 'lightSpeedIn'); ?>>lightSpeedIn</option>
											</optgroup>
											<optgroup label="Rotating Entrances">
												<option value="rotateIn" <?php selected( $popupanimateEntrance, 'rotateIn'); ?>>rotateIn</option>
												<option value="rotateInDownLeft" <?php selected( $popupanimateEntrance, 'rotateInDownLeft'); ?>>rotateInDownLeft</option>
												<option value="rotateInDownRight" <?php selected( $popupanimateEntrance, 'rotateInDownRight'); ?>>rotateInDownRight</option>
												<option value="rotateInUpLeft" <?php selected( $popupanimateEntrance, 'rotateInUpLeft'); ?>>rotateInUpLeft</option>
												<option value="rotateInUpRight" <?php selected( $popupanimateEntrance, 'rotateInUpRight'); ?>>rotateInUpRight</option>
											</optgroup>
											<optgroup label="Sliding Entrances">
												<option value="slideInUp" <?php selected( $popupanimateEntrance, 'slideInUp'); ?>>slideInUp</option>
												<option value="slideInDown" <?php selected( $popupanimateEntrance, 'slideInDown'); ?>>slideInDown</option>
												<option value="slideInLeft" <?php selected( $popupanimateEntrance, 'slideInLeft'); ?>>slideInLeft</option>
												<option value="slideInRight" <?php selected( $popupanimateEntrance, 'slideInRight'); ?>>slideInRight</option>
											</optgroup>
											<optgroup label="Zoom Entrances">
												<option value="zoomIn" <?php selected( $popupanimateEntrance, 'zoomIn'); ?>>zoomIn</option>
												<option value="zoomInDown" <?php selected( $popupanimateEntrance, 'zoomInDown'); ?>>zoomInDown</option>
												<option value="zoomInLeft" <?php selected( $popupanimateEntrance, 'zoomInLeft'); ?>>zoomInLeft</option>
												<option value="zoomInRight" <?php selected( $popupanimateEntrance, 'zoomInRight'); ?>>zoomInRight</option>
												<option value="zoomInUp" <?php selected( $popupanimateEntrance, 'zoomInUp'); ?>>zoomInUp</option>
											</optgroup>
											<optgroup label="Specials">
												<option value="rollIn" <?php selected( $popupanimateEntrance, 'rollIn'); ?>>rollIn</option>
												<option value="hinge" <?php selected( $popupanimateEntrance, 'hinge'); ?>>hinge</option>
											</optgroup>
										</select>
									</td>
									
									<td><span> Exits</span>
										<select class="form-control" name="popup_animate_exit" id="popup_animate_exit">
											<optgroup label="Attention Seekers">
												<option value="bounce" <?php selected( $popupanimateExit, 'bounce'); ?>>bounce</option>
												<option value="flash" <?php selected( $popupanimateExit, 'flash'); ?>>flash</option>
												<option value="pulse" <?php selected( $popupanimateExit, 'pulse'); ?>>pulse</option>
												<option value="rubberBand" <?php selected( $popupanimateExit, 'rubberBand'); ?>>rubberBand</option>
												<option value="shake" <?php selected( $popupanimateExit, 'shake'); ?>>shake</option>
												<option value="swing" <?php selected( $popupanimateExit, 'swing'); ?>>swing</option>
												<option value="tada" <?php selected( $popupanimateExit, 'tada'); ?>>tada</option>
												<option value="wobble" <?php selected( $popupanimateExit, 'wobble'); ?>>wobble</option>
												<option value="jello" <?php selected( $popupanimateExit, 'jello'); ?>>jello</option>
											</optgroup>
											<optgroup label="Bouncing Exits">
												<option value="bounceOut" <?php selected( $popupanimateExit, 'bounceOut'); ?>>bounceOut</option>
												<option value="bounceOutDown" <?php selected( $popupanimateExit, 'bounceOutDown'); ?>>bounceOutDown</option>
												<option value="bounceOutLeft" <?php selected( $popupanimateExit, 'bounceOutLeft'); ?>>bounceOutLeft</option>
												<option value="bounceOutRight" <?php selected( $popupanimateExit, 'bounceOutRight'); ?>>bounceOutRight</option>
												<option value="bounceOutUp" <?php selected( $popupanimateExit, 'bounceOutUp'); ?>>bounceOutUp</option>
											</optgroup>
											<optgroup label="Fading Exits">
												<option value="fadeOut" <?php selected( $popupanimateExit, 'fadeOut'); ?>>fadeOut</option>
												<option value="fadeOutDown" <?php selected( $popupanimateExit, 'fadeOutDown'); ?>>fadeOutDown</option>
												<option value="fadeOutDownBig" <?php selected( $popupanimateExit, 'fadeOutDownBig'); ?>>fadeOutDownBig</option>
												<option value="fadeOutLeft" <?php selected( $popupanimateExit, 'fadeOutLeft'); ?>>fadeOutLeft</option>
												<option value="fadeOutLeftBig" <?php selected( $popupanimateExit, 'fadeOutLeftBig'); ?>>fadeOutLeftBig</option>
												<option value="fadeOutRight" <?php selected( $popupanimateExit, 'fadeOutRight'); ?>>fadeOutRight</option>
												<option value="fadeOutRightBig" <?php selected( $popupanimateExit, 'fadeOutRightBig'); ?>>fadeOutRightBig</option>
												<option value="fadeOutUp" <?php selected( $popupanimateExit, 'fadeOutUp'); ?>>fadeOutUp</option>
												<option value="fadeOutUpBig" <?php selected( $popupanimateExit, 'fadeOutUpBig'); ?>>fadeOutUpBig</option>
											</optgroup>
											<optgroup label="Flippers">
												<option value="flipOutX" <?php selected( $popupanimateExit, 'flipOutX'); ?>>flipOutX</option>
												<option value="flipOutY" <?php selected( $popupanimateExit, 'flipOutY'); ?>>flipOutY</option>
											</optgroup>
											<optgroup label="Lightspeed">
												<option value="lightSpeedOut" <?php selected( $popupanimateExit, 'lightSpeedOut'); ?>>lightSpeedOut</option>
											</optgroup>
											<optgroup label="Rotating Exits">
												<option value="rotateOut" <?php selected( $popupanimateExit, 'rotateOut'); ?>>rotateOut</option>
												<option value="rotateOutDownLeft" <?php selected( $popupanimateExit, 'rotateOutDownLeft'); ?>>rotateOutDownLeft</option>
												<option value="rotateOutDownRight" <?php selected( $popupanimateExit, 'rotateOutDownRight'); ?>>rotateOutDownRight</option>
												<option value="rotateOutUpLeft" <?php selected( $popupanimateExit, 'rotateOutUpLeft'); ?>>rotateOutUpLeft</option>
												<option value="rotateOutUpRight" <?php selected( $popupanimateExit, 'rotateOutUpRight'); ?>>rotateOutUpRight</option>
											</optgroup>
											<optgroup label="Sliding Exits">
												<option value="slideOutUp" <?php selected( $popupanimateExit, 'slideOutUp'); ?>>slideOutUp</option>
												<option value="slideOutDown" <?php selected( $popupanimateExit, 'slideOutDown'); ?>>slideOutDown</option>
												<option value="slideOutLeft" <?php selected( $popupanimateExit, 'slideOutLeft'); ?>>slideOutLeft</option>
												<option value="slideOutRight" <?php selected( $popupanimateExit, 'slideOutRight'); ?>>slideOutRight</option>
											</optgroup>
											<optgroup label="Zoom Exits">
												<option value="zoomOut" <?php selected( $popupanimateExit, 'zoomOut'); ?>>zoomOut</option>
												<option value="zoomOutDown" <?php selected( $popupanimateExit, 'zoomOutDown'); ?>>zoomOutDown</option>
												<option value="zoomOutLeft" <?php selected( $popupanimateExit, 'zoomOutLeft'); ?>>zoomOutLeft</option>
												<option value="zoomOutRight" <?php selected( $popupanimateExit, 'zoomOutRight'); ?>>zoomOutRight</option>
												<option value="zoomOutUp" <?php selected( $popupanimateExit, 'zoomOutUp'); ?>>zoomOutUp</option>
												</optgroup>
												<optgroup label="Specials">
												<option value="rollOut" <?php selected( $popupanimateExit, 'rollOut'); ?>>rollOut</option>
											</optgroup>
										</select>
									</td>
								</table>
								
							</td>
						</tr>	
						
						<tr>
							<td id="label"><label>Display duration</label> </td>
							<td>
							<?php $popupDelay = esc_attr(get_option('popup_delay')); ?>
								Delay for <input type="number" name="popup_delay" id="popup_delay" style="width:40px;" value="<?php echo $popupDelay; ?>" /> seconds.
							</td>
						</tr>	<!-- /nested table opening-->	
						
					</table> <!-- /nested table -->
				</td>
				<td style="text-align: center;"><small> Animation duration in front-end may vary </small>
					
					<div class="disAnimate" >
						<img id="animated" class="hide" src="<?php echo get_template_directory_uri().'/img/admin/popads.png'; ?>" />
						<img id="web" class="" src="<?php echo get_template_directory_uri().'/img/admin/website.png'; ?>" />
					</div>
				
				</td>
			</tr> <!-- /opening -->
			
		</tbody>
	</table>
	
<?php }


/*=======Ads Popup box=========*/
function bzbr001_popup_box(){
	return 'Settings for pop-up box.';
}

function bzbr001_modal_options(){ echo '<td></td>'; ?>
	
	<table class="widefat">
		<thead>
			<tr>
				<th id="titleAds"><label>Popup Box Options</label></th>
				<th id="titleAds"></th>
			</tr>
		</thead>
		<tbody>
			<tr> <!-- opening -->

				<td class="wrapOptions">
					<span class="italic"><?php echo bzbr001_popup_box(); ?></span>
					<br><br>
					
					<table> <!-- opening nested table -->
						<tr>
							
							<label style="padding-right: 10px;">Box size</label>
							<?php $popupSize = esc_attr(get_option('popup_size')); ?>
							
							<span>
								<input type="radio" name="popup_size" id="popup_size" value="modal-dialog modal-sm"<?php checked( 'modal-dialog modal-sm' == $popupSize); ?> /> Small &nbsp; &nbsp;
								<input type="radio" name="popup_size" id="popup_size" value="modal-dialog modal-lg"<?php checked( 'modal-dialog modal-lg' == $popupSize); ?> /> Medium &nbsp; &nbsp;
								<input type="radio" name="popup_size" id="popup_size" value="large"<?php checked( 'large' == $popupSize); ?> /> Large
							</span>
								
							<!-- <td id="label"></td> -->
						
						</tr>
						
						<tr id="popbutton" class="hide">
							<td id="label">
								<?php $popupButton = esc_attr(get_option('popup_button')); ?>
								<?php $popupButton2 = esc_attr(get_option('popup_button_2')); ?>
								<?php $popupButton3 = esc_attr(get_option('popup_button_3')); ?>
								<?php $popupButtoncss = esc_attr(get_option('popup_button_css')); ?>
								<?php $popupButtonbackcss = esc_attr(get_option('popup_button_back_css')); ?>
								<?php $popupButtonchoice = esc_attr(get_option('popup_button_choice')); ?>
								<?php cafesatu_wp_head_popbtn(); ?>
								
								<label>Popup button settings</label>
							
								<div style="padding-top: 10px;">
									<input type="text" name="popup_button" id="popup_button" style="width:240px;" value="<?php echo $popupButton; ?>" placeholder="Text in button"/>
								</div>
								<div>
									<input type="text" name="popup_button_2" id="popup_button_2" style="width:240px;" value="<?php echo $popupButton2; ?>" placeholder="Text in button"/>
								</div>
								<div>
									<input type="text" name="popup_button_3" id="popup_button_3" style="width:240px;" value="<?php echo $popupButton3; ?>" placeholder="Text in button"/>
								</div>
							
							</td> 
							<td>
								
								<div style="padding-top: 30px;">
									<table>
										<tr><td>
										<input type="text" name="popup_button_css" class="my-input-class" id="popup_button_css" value="<?php echo $popupButtoncss; ?>" /> 
										</td>
									<td>
									<input type="text" name="popup_button_back_css" class="my-input-class" id="popup_button_back_css" value="<?php echo $popupButtonbackcss; ?>" /> 
										</td>
										<td><span class="italic">Change button color</span></td>
										</tr>
									</table>
								</div>
								
								<div class="pickbtn">
								<table>
									<tr><td>
									<select name="popup_button_choice" id="popup_button_choice">	
										<option value="popen" <?php selected( $popupButtonchoice, 'popen'); ?>>Default</option>
										<option value="coupon" <?php selected( $popupButtonchoice, 'coupon'); ?>>Coupon</option>
										<option value="rubber_stamp" <?php selected( $popupButtonchoice, 'rubber_stamp'); ?>>Rubber Stamp</option>
										<option value="starburst" <?php selected( $popupButtonchoice, 'starburst'); ?>>Starburst</option>
										<option value="badges" <?php selected( $popupButtonchoice, 'badges'); ?>>Badges</option>
										<option value="rubber_stamped" <?php selected( $popupButtonchoice, 'rubber_stamped'); ?>>Circle Rubber Stamp</option>
										<option value="ring-outer" <?php selected( $popupButtonchoice, 'ring-outer'); ?>>Ring</option>
										<option value="myButton" <?php selected( $popupButtonchoice, 'myButton'); ?>>My Button</option>
										<option value="myButton2" <?php selected( $popupButtonchoice, 'myButton2'); ?>>More My Button</option>
										<option value="grad" <?php selected( $popupButtonchoice, 'grad'); ?>>Gradient</option>
										<option value="grad2" <?php selected( $popupButtonchoice, 'grad2'); ?>>More Gradient</option>
										<option value="grad3" <?php selected( $popupButtonchoice, 'grad3'); ?>>Even More Gradient</option>
										<option value="grad4" <?php selected( $popupButtonchoice, 'grad4'); ?>>Last but not least Gradient</option>
									</select>
									</td><td>
									<span class="italic">Pick button style</span>
									</td></tr>
								</table>
								</div>
								
							</td>
						</tr>
						<tr>
							<td id="label">
								<label>Close button settings</label>
								<div class="h2title">
									<?php $popupClose = esc_attr(get_option('popup_close'));
									$checked = (@$popupClose == '1' ? 'checked' : ''); ?>
				
									<input type = "checkbox" id="popup_close" name="popup_close" value="1"<?php echo $checked; ?>/> <span class="italic"> Close box before display ends. </span>
								</div>
							</td>
							<td id="label">
								<label>Animate one of image in content</label>

								<div>
								<?php $popupAnimate = esc_attr(get_option('popup_animate')); ?>
								
									<select name="popup_animate" id="popup_animate">	
										<option value="noanimate" <?php selected( $popupAnimate, 'noanimate'); ?>>No animation</option>
										<optgroup label="Attention Seekers">	
											<option value="flash" <?php selected( $popupAnimate, 'flash'); ?>>flash</option>
											<option value="pulse" <?php selected( $popupAnimate, 'pulse'); ?>>pulse</option>
											<option value="rubberBand" <?php selected( $popupAnimate, 'rubberBand'); ?>>rubberBand</option>
											<option value="shake" <?php selected( $popupAnimate, 'shake'); ?>>shake</option>
											<option value="swing" <?php selected( $popupAnimate, 'swing'); ?>>swing</option>
											<option value="tada" <?php selected( $popupAnimate, 'tada'); ?>>tada</option>
											<option value="wobble" <?php selected( $popupAnimate, 'wobble'); ?>>wobble</option>
											<option value="jello" <?php selected( $popupAnimate, 'jello'); ?>>jello</option>
										</optgroup>	
										<optgroup label="Bouncing Entrances">	
											<option value="bounceIn" <?php selected( $popupAnimate, 'bounceIn'); ?>>bounceIn</option>
											<option value="bounceInDown" <?php selected( $popupAnimate, 'bounceInDown'); ?>>bounceInDown</option>
											<option value="bounceInLeft" <?php selected( $popupAnimate, 'bounceInLeft'); ?>>bounceInLeft</option>
											<option value="bounceInRight"<?php selected( $popupAnimate, 'bounceInRight'); ?>>bounceInRight</option>
											<option value="bounceInUp" <?php selected( $popupAnimate, 'bounceInUp'); ?>>bounceInUp</option>
										</optgroup>	
										<optgroup label="Bouncing Exits">	
											<option value="bounceOut" <?php selected( $popupAnimate, 'bounceOut'); ?>>bounceOut</option>
											<option value="bounceOutDown" <?php selected( $popupAnimate, 'bounceOutDown'); ?>>bounceOutDown</option>
											<option value="bounceOutLeft" <?php selected( $popupAnimate, 'bounceOutLeft'); ?>>bounceOutLeft</option>
											<option value="bounceOutRight" <?php selected( $popupAnimate, 'bounceOutRight'); ?>>bounceOutRight</option>
											<option value="bounceOutUp" <?php selected( $popupAnimate, 'bounceOutUp'); ?>>bounceOutUp</option>
										</optgroup>	
										<optgroup label="Fading Entrances">	
											<option value="fadeIn" <?php selected( $popupAnimate, 'fadeIn'); ?>>fadeIn</option>
											<option value="fadeInDown" <?php selected( $popupAnimate, 'fadeInDown'); ?>>fadeInDown</option>
											<option value="fadeInDownBig" <?php selected( $popupAnimate, 'fadeInDownBig'); ?>>fadeInDownBig</option>
											<option value="fadeInLeft" <?php selected( $popupAnimate, 'fadeInLeft'); ?>>fadeInLeft</option>
											<option value="fadeInLeftBig" <?php selected( $popupAnimate, 'fadeInLeftBig'); ?>>fadeInLeftBig</option>
											<option value="fadeInRight" <?php selected( $popupAnimate, 'fadeInRight'); ?>>fadeInRight</option>
											<option value="fadeInRightBig" <?php selected( $popupAnimate, 'fadeInRightBig'); ?>>fadeInRightBig</option>
											<option value="fadeInUp" <?php selected( $popupAnimate, 'fadeInUp'); ?>>fadeInUp</option>
											<option value="fadeInUpBig" <?php selected( $popupAnimate, 'fadeInUpBig'); ?>>fadeInUpBig</option>
										</optgroup>	
										<optgroup label="Fading Exits">	
											<option value="fadeOut" <?php selected( $popupAnimate, 'fadeOut'); ?>>fadeOut</option>
											<option value="fadeOutDown" <?php selected( $popupAnimate, 'fadeOutDown'); ?>>fadeOutDown</option>
											<option value="fadeOutDownBig" <?php selected( $popupAnimate, 'fadeOutDownBig'); ?>>fadeOutDownBig</option>
											<option value="fadeOutLeft" <?php selected( $popupAnimate, 'fadeOutLeft'); ?>>fadeOutLeft</option>
											<option value="fadeOutLeftBig" <?php selected( $popupAnimate, 'fadeOutLeftBig'); ?>>fadeOutLeftBig</option>
											<option value="fadeOutRight" <?php selected( $popupAnimate, 'fadeOutRight'); ?>>fadeOutRight</option>
											<option value="fadeOutRightBig" <?php selected( $popupAnimate, 'fadeOutRightBig'); ?>>fadeOutRightBig</option>
											<option value="fadeOutUp" <?php selected( $popupAnimate, 'fadeOutUp'); ?>>fadeOutUp</option>
											<option value="fadeOutUpBig" <?php selected( $popupAnimate, 'fadeOutUpBig'); ?>>fadeOutUpBig</option>
										</optgroup>	
										<optgroup label="Flippers">	
											<option value="flip" <?php selected( $popupAnimate, 'flip'); ?>>flip</option>
											<option value="flipInX" <?php selected( $popupAnimate, 'flipInX'); ?>>flipInX</option>
											<option value="flipInY" <?php selected( $popupAnimate, 'flipInY'); ?>>flipInY</option>
											<option value="flipOutX" <?php selected( $popupAnimate, 'flipOutX'); ?>>flipOutX</option>
											<option value="flipOutY" <?php selected( $popupAnimate, 'flipOutY'); ?>>flipOutY</option>
										</optgroup>	
										<optgroup label="Lightspeed">	
											<option value="lightSpeedIn" <?php selected( $popupAnimate, 'lightSpeedIn'); ?>>lightSpeedIn</option>
											<option value="lightSpeedOut" <?php selected( $popupAnimate, 'lightSpeedOut'); ?>>lightSpeedOut</option>
										</optgroup>	
										<optgroup label="Rotating Entrances">	
											<option value="rotateIn" <?php selected( $popupAnimate, 'rotateIn'); ?>>rotateIn</option>
											<option value="rotateInDownLeft" <?php selected( $popupAnimate, 'rotateInDownLeft'); ?>>rotateInDownLeft</option>
											<option value="rotateInDownRight" <?php selected( $popupAnimate, 'rotateInDownRight'); ?>>rotateInDownRight</option>
											<option value="rotateInUpLeft" <?php selected( $popupAnimate, 'rotateInUpLeft'); ?>>rotateInUpLeft</option>
											<option value="rotateInUpRight" <?php selected( $popupAnimate, 'rotateInUpRight'); ?>>rotateInUpRight</option>
										</optgroup>	
										<optgroup label="Rotating Exits">	
											<option value="rotateOut" <?php selected( $popupAnimate, 'rotateOut'); ?>>rotateOut</option>
											<option value="rotateOutDownLeft" <?php selected( $popupAnimate, 'rotateOutDownLeft'); ?>>rotateOutDownLeft</option>
											<option value="rotateOutDownRight" <?php selected( $popupAnimate, 'rotateOutDownRight'); ?>>rotateOutDownRight</option>
											<option value="rotateOutUpLeft" <?php selected( $popupAnimate, 'rotateOutUpLeft'); ?>>rotateOutUpLeft</option>
											<option value="rotateOutUpRight" <?php selected( $popupAnimate, 'rotateOutUpRight'); ?>>rotateOutUpRight</option>
										</optgroup>	
										<optgroup label="Sliding Entrances">	
											<option value="slideInUp" <?php selected( $popupAnimate, 'slideInUp'); ?>>slideInUp</option>
											<option value="slideInDown" <?php selected( $popupAnimate, 'slideInDown'); ?>>slideInDown</option>
											<option value="slideInLeft" <?php selected( $popupAnimate, 'slideInLeft'); ?>>slideInLeft</option>
											<option value="slideInRight" <?php selected( $popupAnimate, 'slideInRight'); ?>>slideInRight</option>
										</optgroup>	
										<optgroup label="Sliding Exits">	
											<option value="slideOutUp" <?php selected( $popupAnimate, 'slideOutUp'); ?>>slideOutUp</option>
											<option value="slideOutDown" <?php selected( $popupAnimate, 'slideOutDown'); ?>>slideOutDown</option>
											<option value="slideOutLeft" <?php selected( $popupAnimate, 'slideOutLeft'); ?>>slideOutLeft</option>
											<option value="slideOutRight" <?php selected( $popupAnimate, 'slideOutRight'); ?>>slideOutRight</option>
										</optgroup>	
										<optgroup label="Zoom Entrances">	
											<option value="zoomIn" <?php selected( $popupAnimate, 'zoomIn'); ?>>zoomIn</option>
											<option value="zoomInDown" <?php selected( $popupAnimate, 'zoomInDown'); ?>>zoomInDown</option>
											<option value="zoomInLeft" <?php selected( $popupAnimate, 'zoomInLeft'); ?>>zoomInLeft</option>
											<option value="zoomInRight" <?php selected( $popupAnimate, 'zoomInRight'); ?>>zoomInRight</option>
											<option value="zoomInUp" <?php selected( $popupAnimate, 'zoomInUp'); ?>>zoomInUp</option>
										</optgroup>	
										<optgroup label="Zoom Exits">	
											<option value="zoomOut" <?php selected( $popupAnimate, 'zoomOut'); ?>>zoomOut</option>
											<option value="zoomOutDown" <?php selected( $popupAnimate, 'zoomOutDown'); ?>>zoomOutDown</option>
											<option value="zoomOutLeft" <?php selected( $popupAnimate, 'zoomOutLeft'); ?>>zoomOutLeft</option>
											<option value="zoomOutRight" <?php selected( $popupAnimate, 'zoomOutRight'); ?>>zoomOutRight</option>
											<option value="zoomOutUp" <?php selected( $popupAnimate, 'zoomOutUp'); ?>>zoomOutUp</option>
										</optgroup>	
										<optgroup label="Specials">	
											<option value="hinge" <?php selected( $popupAnimate, 'hinge'); ?>>hinge</option>
											<option value="rollIn" <?php selected( $popupAnimate, 'rollIn'); ?>>rollIn</option>
											<option value="rollOut" <?php selected( $popupAnimate, 'rollOut'); ?>>rollOut</option>
										</optgroup>	
									</select>	
									
								</div>
							</td>
						</tr>
						<tr id="popclosebutton" class="hide">
							
							<td id="label">
							<?php $popupcloseButtoncss = esc_attr(get_option('popup_close_button_css')); ?>
							<?php $popupcloseButtonchoice = esc_attr(get_option('popup_close_button_choice')); ?>

								<input type="text" name="popup_close_button_css" class="my-input-class" id="popup_close_button_css" value="<?php echo $popupcloseButtoncss; ?>" />

							</td>
							<td>
								
								<fieldset id="closechoice">
									
									<input id="item-1" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed hairline" <?php checked( 'closed hairline' == $popupcloseButtonchoice); ?>/>
									<label class="radio-inline__label" for="item-1">
									  <span class="closed warp"></span>
									</label>

									<input id="item-2" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed thick" <?php checked( 'closed thick' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-2">
									  <span class="closed thick"></span>
									</label>

									<input id="item-3" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed black" <?php checked( 'closed black' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-3">
									  <span class="closed black"></span>
									</label>

									<input id="item-4" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed heavy" <?php checked( 'closed heavy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-4">
									  <span class="closed heavy"></span>
									</label>

									<input id="item-5" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed pointy" <?php checked( 'closed pointy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-5">
									  <span class="closed pointy"></span>
									</label>

									<input id="item-6" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed thick pointy" <?php checked( 'closed thick pointy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-6">
									  <span class="closed thick pointy"></span>
									</label>

									<input id="item-7" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed black pointy" <?php checked( 'closed black pointy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-7">
									  <span class="closed black pointy"></span>
									</label>

									<input id="item-8" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed heavy pointy" <?php checked( 'closed heavy pointy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-8">
									  <span class="closed heavy pointy"></span>
									</label>

									<input id="item-9" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed rounded" <?php checked( 'closed rounded' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-9">
									  <span class="closed rounded"></span>
									</label>

									<input id="item-10" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed rounded thick" <?php checked( 'closed rounded thick' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-10">
									  <span class="closed rounded thick"></span>
									</label>

									<input id="item-11" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed rounded black" <?php checked( 'closed rounded black' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-11">
									  <span class="closed rounded black"></span>
									</label>

									<input id="item-12" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed rounded heavy" <?php checked( 'closed rounded heavy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-12">
									  <span class="closed rounded heavy"></span>
									</label>

									<input id="item-13" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed blades" <?php checked( 'closed blades' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-13">
									  <span class="closed blades"></span>
									</label>

									<input id="item-14" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed blades thick" <?php checked( 'closed blades thick' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-14">
									  <span class="closed blades thick"></span>
									</label>

									<input id="item-15" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed blades black" <?php checked( 'closed blades black' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-15">
									  <span class="closed blades black"></span>
									</label>

									<input id="item-16" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed blades heavy" <?php checked( 'closed blades heavy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-16">
									  <span class="closed blades heavy"></span>
									</label>

									<input id="item-17" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed warp" <?php checked( 'closed warp' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-17">
									  <span class="closed warp"></span>
									</label>

									<input id="item-18" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed warp thick" <?php checked( 'closed warp thick' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-18">
									  <span class="closed warp thick"></span>
									</label>

									<input id="item-19" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed warp black" <?php checked( 'closed warp black' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-19">
									  <span class="closed warp black"></span>
									</label>

									<input id="item-20" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed warp heavy" <?php checked( 'closed warp heavy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-20">
									  <span class="closed warp heavy"></span>
									</label>

									<input id="item-21" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed fat" <?php checked( 'closed fat' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-21">
									  <span class="closed fat"></span>
									</label>

									<input id="item-22" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed fat thick" <?php checked( 'closed fat thick' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-22">
									  <span class="closed fat thick"></span>
									</label>

									<input id="item-23" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed fat black" <?php checked( 'closed fat black' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-23">
									  <span class="closed fat black"></span>
									</label>

									<input id="item-24" class="popup_close_button_choice" type="radio" name="popup_close_button_choice" value="closed fat heavy" <?php checked( 'closed fat heavy' == $popupcloseButtonchoice); ?> />
									<label class="radio-inline__label" for="item-24">
									  <span class="closed fat heavy"></span>
									</label>
 
								</fieldset>

							</td>
						</tr>	

					</table> <!-- /nested table -->
						
				</td>
				
				<td>
					<table>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr>
							<td id="popbuttondisplaylabel" class="hide">
								<label class="label">View popup button</label>
							</td>
						</tr>
						<tr>
							<td id="popbuttondisplay" class="hide">
								<div id="displayposition" >
									<button type="button" id="popup_button_css_display" class="<?php echo $popupButtonchoice; ?> btn-main" > 
										<div class="price">
											<span id="btnopen"><?php echo $popupButton; ?></span>
											<span id="btnopen2"><?php echo $popupButton2; ?></span>
											<span id="btnopen3"><?php echo $popupButton3; ?></span>
										</div>
									</button>
								</div>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr>
							<td class="hide" id="popclosedisplaylabel">
								<label class="label">View close button</label>
							</td>
						</tr>
						<tr>
							<td class="hide" id="popclosedisplay">
								<div id="displaypositionclose" >
									<button type="button" id="popup_close_button_css_display" class="<?php echo $popupcloseButtonchoice; ?> btn-main-close"></button>
								</div>
							</td>
						</tr>
					</table>
				</td>
				
			</tr> <!-- /opening -->
		</tbody>
	</table> <!-- /wrapping all -->
	
<?php }


/*=======Ads Popup loop=========*/
function bzbr001_popup_slide(){
	return _('Display more than one advertisement posts.');
}

function bzbr001_popup_loop(){
	echo '<td></td>';
	
	$popupLoop = esc_attr(get_option('popup_loop'));
	$popupPerpage = esc_attr(get_option('popup_perpage'));
	
	if($popupPerpage <= 0 || $popupLoop == 0) : $popupPerpage = '1'; endif;
	
	if ($popupPerpage == 1) : 
	
		$ads = ' post'; 
		$warnone = '<blockquote>
						Please deactivate the slide function.
						<p><details>
							You do not need to use slide function if you want to display just one post.<br>
							<small>In case of no number of slides being set, the slide by default will be set to 1. </small>
						</details></p>
					</blockquote>';
		
	else : $ads = ' posts'; endif;
	
	$postadsid = bzbr001_loopid_ads();
	$sum = bzbr001_ads_sum_all();
	$sumids = bzbr001_ads_sum_selected();
	$comparepostpage = cafesatu_compare_postpage();
	$ids = cafesatu_ids_selected();
	
	$checked = (@$popupLoop == '1' ? 'checked' : '');
	$disLoop = 'Add slides &nbsp; <input type = "checkbox" id="popup_loop" name="popup_loop" value="1" '.$checked.'/><br><br>';
	$disPerpage = '<div class="hide" id="popslide"> Number of slides <input type="number" name="popup_perpage" id="popup_perpage" style="width:50px;" value="'.$popupPerpage.'" />';
	$disState = '<div class="hide" id="poplist"><span id="choose"><br>You choose to display '.$popupPerpage.$ads. '.</span>';
	
	$listID = '';

	foreach ($ids as $id){
	
		$listID .='<div class="carousel-cell">';
		$listID .='	<div class="slideback" style="background-image: url('.wp_get_attachment_url(get_post_thumbnail_id($id)).');">';
		$listID .= 		get_the_title($id);
		$listID .=		do_shortcode(get_post_field('post_content', $id));
		$listID .='	</div>';
		$listID .='</div>';

	}
	
	if ($sumids != 0):
	$popcarousel ='<div class="hide" id="popcarousel">
						This is listed posts. Views may be vary from the front-end.
						<div class="main-carousel">'.$listID.'</div>
					</div>';
	endif;
	
	echo 	'<table class="widefat">
				<thead>
					<tr>
						<th id="titleAds"><label>Popup Slide Options</label></th>
						<th id="titleAds"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="wrapSlide"><span class="italic">'.bzbr001_popup_slide().'</span></td>
					</tr>
					<tr>
						<td id="slideSec">'.$disLoop.$disPerpage.$disState.$comparepostpage.$warnone.'</td>
						<td>'.$popcarousel.'</td>
					</tr>
				</tbody>
			</table>';

}


/*
	=================
	CUSTOM FUNCTIONS
	=================
*/

function bzbr001_ads_sum_all(){
	$args = cafesatu_query_all();
	$count= new WP_Query( $args );
	$sum = $count->found_posts;
	
	return $sum;
}


function bzbr001_ads_sum_selected(){
	$args = cafesatu_query_selected();
	$count= new WP_Query( $args );
	$sumids = $count->found_posts;
	
	return $sumids;	
}


function cafesatu_query_selected(){
	$popupLoop = esc_attr(get_option('popup_loop'));
	$popupPerpage = esc_attr(get_option('popup_perpage'));
	if($popupPerpage <= 0 || $popupLoop == 0) : $popupPerpage = '1'; endif;
	$postadsid = bzbr001_loopid_ads();
	
	return $args = array(
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page'	=> $popupPerpage,
		'post__in'      	=> $postadsid,
		'tax_query' 		=> array(
			array(                
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-aside'),
		))
	);	
}


function cafesatu_ids_selected(){
	$args = cafesatu_query_selected();
	$ids = array(); 
	$adsid = new WP_Query( $args );
		
	if ( $adsid->have_posts() ) : 
	  while ( $adsid->have_posts() ) : $adsid->the_post();
		array_push( $ids, get_the_ID() );
	  endwhile;
	endif;
	
	return $ids;
}


function cafesatu_compare_postpage(){
	$popupPerpage = esc_attr(get_option('popup_perpage'));
	if($popupPerpage <= 0 ) : $popupPerpage = 1; endif;
	$popupPerpages = intval($popupPerpage);
	$sumids = bzbr001_ads_sum_selected();
	$sum = bzbr001_ads_sum_all();
	if ($sumids > 1) { $ads = ' posts'; } else {$ads = ' post';}
	
	$comparepostpage = '';
	
	switch(true) {

		case ( $sum == 0 ) :
			$comparepostpage = '<br><br><div class="block-danger"><span class=" blink">Warning! </span> <br>You dont have any posts at the moment.</div>';
			$comparepostpage .= '<br><br><span class="italic">Please use aside post formats to craft your advertisement or promotion.</span>';	
			
			break;
		
		case ( $sum < $popupPerpage):
			$comparepostpage = '<br><br><div class="block-warning"><span class=" blink">Attention! </span> You only have '.$sum.$ads.' at the moment.</div>';
			$comparepostpage .= '<br><br><span class="italic">Please use aside post formats to craft your advertisement or promotion.</span>';
			
			break;
			
		case ( $sumids < $popupPerpages && $sumids != 0):
			$comparepostpage = '<br><br><div class="block-warning"><span class=" blink">Attention! </span> You only listed '.$sumids.$ads.' at the moment.</div>';
			$comparepostpage .= '<br><br><span class="italic"> Please review and add post into the list <a href="./admin.php?page=bzbr001_ads_listing">here</a>. You can either list more posts or reduce the number of slides.</span>';
			
			break;
			 
		case ($sumids == 0 ):
			$comparepostpage = '<br><br><div class="block-danger"><span class="blink">Warning! </span><br>  You do not list any posts at the moment.</div>';
			$comparepostpage .= '<br><br><span class="italic"> Please list it <a href="./admin.php?page=bzbr001_ads_listing">here</a>.</span>';
			
			break;
			
		case ( $sumids > $popupPerpages):
			$comparepostpage = '<br><br><div class="block-danger"><span class="blink">Warning! </span><br>You listed more than limit posts you set to display.</div>';
			$comparepostpage .= '<br><br><span class="italic"> Please review the list <a href="./admin.php?page=bzbr001_ads_listing">here</a>. You can either reduce the list or add the number of slides.</span>';
			
			break;
			
		case ( $sumids == $popupPerpages):
			$comparepostpage = '';
			
			break;
		
		default : $comparepostpage = '';
	
	}	
	return $comparepostpage;
}


function cafesatu_wp_head_popbtn() {
	$popupButtoncss = esc_attr(get_option('popup_button_css'));
	$popupButtonbackcss = esc_attr(get_option('popup_button_back_css'));
	/* if($popupButtonbackcss = ''  ) : $popupButtonbackcss = '#990000'; endif; */
	$popupcloseButtoncss = esc_attr(get_option('popup_close_button_css'));
	
    echo 
	
	'<style> 

	#popup_button_css_display.btn-main  {
		color:'.$popupButtoncss.';
		border-color:'.$popupButtoncss.'; 	
	}
	
	#popup_button_css_display.btn-main:visited, 
	#popup_button_css_display.btn-main:hover, 
	#popup_button_css_display.btn-main:active {
		border-color:'.$popupButtoncss.';
	}
		
	
	//ring outer
	.ring-outer {
		border-left: 0px solid'. $popupButtoncss.';
		border-top: 10px ridge'. $popupButtoncss.';
		border-right: 5px double'. $popupButtoncss.';
		border-bottom: 5px ridge'. $popupButtoncss.';
	}
	
	.ring-outer .price {
		border-left: 5px ridge '. $popupButtoncss.';
		border-top: 5px solid '. $popupButtoncss.';
		border-right: 2px ridge '. $popupButtoncss.';
		border-bottom: 2px solid '. $popupButtoncss.';
	
	}
	
	.ring-outer .price #btnopen {
		color:'.$popupButtoncss.';
		border-top: 5px double '. $popupButtoncss.';
		border-right: 5px ridge '. $popupButtoncss.';
		border-bottom: 1px solid '. $popupButtoncss.';
	}
	
	/* CLOSE */
	#popup_close_button_css_display.btn-main-close  {
		color:'.$popupcloseButtoncss.';
		border-color:'.$popupcloseButtoncss.'; 	
	}
	
	#popup_close_button_css_display.btn-main-close:visited, 
	#popup_close_button_css_display.btn-main-close:hover, 
	#popup_close_button_css_display.btn-main-close:active {
		border-color:'.$popupcloseButtoncss.';
	}
	
	.btn-main-close::before {background:'.$popupcloseButtoncss.';}
	.btn-main-close::after {background:'.$popupcloseButtoncss.';}
	
	/* BACKGROUND */
	.btn-main { background:'.$popupButtonbackcss.';}
	#btnopen { background:'.$popupButtonbackcss.';}
	.starburst {background: radial-gradient(circle, #000000 20%, '.$popupButtonbackcss.' 80%); }
		
	</style>';
}
add_action( 'wp_head', 'cafesatu_wp_head_popbtn' );

/*
	=======================
	END OF CUSTOM FUNCTIONS
	=======================
*/
