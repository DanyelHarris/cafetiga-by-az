jQuery(document).ready(function($){

/* generic */

//datepicker
jQuery('.datepicker').datepicker();


/* page=store_cpt_optin (Shortcode generator) */

	//optin campaign form
	var	optin_code = $('#optin_code');
	var	form_table = $('.form-table');

	$('.button-primary').click(function () {
		if(optin_code.val() === '0' ){
			form_table.addClass('has-error');
		} else {
			form_table.removeClass('has-error');
		}
	 }); 
	 
	
	//Optin popup promo confirmation
	$('#promoSubmit').on('click', function(){
		
			var lightbox = document.getElementById("lightbox"),
				dimmer = document.createElement("div");
			
			dimmer.style.width =  window.innerWidth + 'px';
			dimmer.style.height = window.innerHeight + 'px';
			dimmer.className = 'dimmer';
			
			dimmer.onclick = function(){
				document.body.removeChild(this);   
				lightbox.style.visibility = 'hidden';
			}
				
			document.body.appendChild(dimmer);
			
			lightbox.style.visibility = 'visible';
			lightbox.style.top = window.innerHeight/2 - 150 + 'px';
			lightbox.style.left = window.innerWidth/2 - 100 + 'px';
			return false;
	
	});
	
	//Promo Form Submission
	$('#storePromoForm').on('submit', function(){

		var form = $(this),
			ajaxurl = form.data('url');
			
		$.ajax({
		
			url: ajaxurl,
			type : 'post',
			data : { action : 'bzbr001_save_user_promo_form'	},
			error : function(response){ console.log(response);	},
			success : function(response){ console.log(response); }
			
		});
		
	});
	
	
	/* page=bazahab_ads_listing (advertisement list) */ 

	//Ads view
	$('.link').click(function(){
		var id = $(this).attr("rel");

		$('#'+id).slideToggle('slow');
	});

	//checks all ads to list
	$('input[name="all"]').bind('click', function(){
		var status = $(this).is(':checked');
		$('input[type="checkbox"]').attr('checked', status);
	});
	
	//reflect checked
	var name = $('.viewingads').attr('id');
		
	$('.viewingads').on('change', function(){
		var name = $(this).attr('id');
		var status = $(this).is(':checked');
		$('input[type="checkbox"][name="ads_list_id[' + name + ']"]').attr('checked', status);
	});
	
	//Ads listing Form Submission
	/* $('form').on('submit', function(){
			
		var adslistID = $(this).attr('id'),
			adsTitle = $(this).data('title'),
			adsContent = $(this).find('.adsContent').data('content');
			ajaxurl = $('#listAds').data('url'),
			root = $('.widefat').data('root');
		
		$.ajax({
			
			url: ajaxurl,
			type : 'post',
			data : { 
				adslistID : adslistID,
				adsTitle : adsTitle,
				adsContent : adsContent,
				action : 'store_save_user_ads_list_form'	
			},
			
			error : function(response){ console.log(response); },
			success : function(response){ console.log(response); }
			
		});
		
		$.post(root + "/inc/ajax.php", data);
		
	});  */
	
	
/* page=bazahab_store (popup setting) */ 

	//onclick button appear
	function showButton(value) {
	  if(value=="onclickModal"){
		$("#popbutton").fadeIn();
		$("#popbuttondisplaylabel").fadeIn();
		$("#popbuttondisplay").fadeIn();
	  }
	  if(value=="onloadModal"){
		$("#popbutton").fadeOut();
		$("#popbuttondisplaylabel").fadeOut();
		$("#popbuttondisplay").fadeOut();
	  }
	}

	showButton($("input[type='radio']:checked").attr("value"));
	$('input[type="radio"]').click(function(){
		showButton($(this).attr("value"));
	});
	
	
	//onclick closebutton and slide appear
	function evaluate(){
		var triggerItem = $('#popup_close');
		var closeItem = $('#popclosebutton');
		var closeDisplay = $('#popclosedisplay');
		var closeDisplayLabel = $('#popclosedisplaylabel');
		var loopItem = $('#popup_loop');
		var slideItem = $('#popslide');
		var sliderItem = $('#popslider');
		var popcarousel = $('#popcarousel');
		var listItem = $('#poplist');
			
		if(triggerItem.is(':checked')){
			closeItem.fadeIn();
			closeDisplay.fadeIn();
			closeDisplayLabel.fadeIn();
		}else{
			closeItem.fadeOut(); 
			closeDisplay.fadeOut(); 
			closeDisplayLabel.fadeOut(); 
		}
		
		if(loopItem.is(':checked')){
			sliderItem.fadeIn();
			slideItem.fadeIn();
			popcarousel.fadeIn();
			listItem.fadeIn();
		}else{
			sliderItem.fadeOut();   
			slideItem.fadeOut();   
			popcarousel.fadeOut();   
			listItem.fadeOut();      
		}
		
	}
	$('input[type="checkbox"]').click(evaluate).each(evaluate);
	
	
	//animate display
	$('#popup_animate_entrance').change(function() {
		var getText = $('#popup_animate_entrance option:selected').html();
		$("#animated").removeClass();
		$("#web").hide();
		$("#animated").toggleClass("animated " + getText);
	});
	 
	$('#popup_animate_exit').change(function() {
		var getText = $('#popup_animate_exit option:selected').html();
		$("#animated").removeClass();
		$("#web").hide();
		$("#animated").toggleClass("animated " + getText);
		
		setTimeout(function () { 
			$('#animated').addClass('hide'); $("#web").show();}, 1000);
	});

	
	//slide display ads list
	$('.main-carousel').flickity({
	  /* options */
	  cellAlign: 'left',
	  contain: true
	});


});


