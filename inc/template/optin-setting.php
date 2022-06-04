<?php /* @package Jombazar */ ?>
<?php settings_errors(); ?>

<!-- PRINT OPTION -->

<!-- FRONT PAGE PREVIEW -->
<div class="wrap" id="optinWrap">
	<div class="clearboth">
		<div class="divTableCell">
			<span> <img src="<?php bloginfo('stylesheet_directory'); ?>/img/admin/shortcode.png"></span>
		</div>
		<div class="divTableCell" id="headTitle">
			<h1>HORTCODE GENERATOR</h1>
		</div>
	</div>
	<div class="panel-body divTableCell col-8" id="optinHead">
	
		<h3>Email Marketing Campaign Information</h3>
		<form method="post" action="options.php" class="bzbr001-optin-form">
			<?php settings_fields('bzbr001-cpt-optin'); ?>
			<?php do_settings_sections('cpt_optin'); ?>
			
		<?php function cpt_optin_options(){ 
			echo _('Insert data to keep track your marketing campaign.'); 
		}	?>
		
		<?php function bzbr001_optin_info(){
			$optinCode = esc_attr(get_option('optin_code')); 
			$optinDesc = esc_attr(get_option('optin_desc'));
			$optinStart = esc_attr(get_option('optin_start'));
			$optinEnd = esc_attr(get_option('optin_end'));
		?>
	
			<table class="form-table">
				<tr valign="top">
					
					<label>Promo Code </label><br>
					<input type="text" name="optin_code" id="optin_code" style="width:320px;" value="<?php echo $optinCode; ?>" placeholder="Insert promo code" required="required"/>
					<small class="text-danger form-control-msg">Please insert valid data.</small>
					<br><br>
					
					<label>Promo Description</label><br>
					<textarea rows="6" cols="48" name="optin_desc" id="optin_desc" value="<?php echo $optinDesc; ?>" placeholder="Description of your promo" required="required" /><?php echo $optinDesc; ?></textarea>
					<br><br>
					
					<label>Promo Duration </label><br>
					<input type="text" name="optin_start" class="datepicker" id="optin_start"  value="<?php echo $optinStart; ?>" placeholder="Date start" required="required"/>
					
					<input type="text" name="optin_end" class="datepicker" id="optin_end"  value="<?php echo $optinEnd; ?>" placeholder="Date end" required="required"/>
					
				</tr>
			</table> 
		
		<?php } 
			
			submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
		</form>
	
	</div>
	
	<?php 	
		$optinDesc = esc_attr(get_option('optin_desc')); 
		$optinCode = esc_attr(get_option('optin_code')); 
		$optinStart = esc_attr(get_option('optin_start'));
		$optinEnd = esc_attr(get_option('optin_end'));
	?>
		
	<div class="panel-body divTableCell col-4" id="optinAside">
		<div id="optinInfo">
			<p> You are offering <?php echo $optinDesc; ?> </p>
			
			<?php echo optinInfo_par_one(); ?>
			
			<?php echo bzbr001_calc_countdown_promo(); ?>
			
			<?php if(!empty($optinCode) && !empty($optinDesc)): ?>
			<p><button type="button" id="promoSubmit" class="button button-secondary">Add to list</button></p>
			<?php endif; ?>
			
		</div>
		<div class="column-2">
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
		</div>
		
		<div id="lightbox">
			<p> You are offering <?php echo $optinDesc; ?> </p>
			<p> You campaign code is <?php echo $optinCode; ?> </p>
			<?php echo optinInfo_par_one(); ?>

			<p> List this campaign for further reference? </p>
			<div class="divTable" id="promoForm">
				<form id="storePromoForm" action="#" method="post" data-url = "<?php echo admin_url('admin-ajax.php'); ?>">
					<button type="submit" id="promo-submit">Yes, please.</button>
				</form>
			</div>
		</div>
		
	</div>
</div>






