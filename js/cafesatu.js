$(document).ready(function(){
	
	//init function
	revealPosts();
	
	//variable declration
	var last_scroll = 0;
	
	//Gallery Slider
	$(document).on('click', '.store-carousel-thumb', function(){
		var id = $("#" + $(this).attr("id"));
		$(id).on('slid.bs.carousel', function(){
			store_get_bs_thumbs(id);
		});
	});
	
	$(document).on('mouseenter', '.store-carousel-thumb', function(){
		var id = $("#" + $(this).attr("id"));
		store_get_bs_thumbs(id);
	});
	
	function store_get_bs_thumbs(id){
			
		var nextThumb = $(id).find('.item.active').find('.next-image-preview').data('image');
		var prevThumb = $(id).find('.item.active').find('.prev-image-preview').data('image');
		$(id).find('.carousel-control.right').find('.thumbnail-container').css({'background-image' : 'url('+nextThumb+')'});
		$(id).find('.carousel-control.left').find('.thumbnail-container').css({'background-image' : 'url('+prevThumb+')'});	
			
	}
	
	//AJAX Function Load More
	$(document).on('click','.store-load-more:not(.loading)', function(){
		
		var that = $(this);
		var page = $(this).data('page');
		var slug = that.data('slug');
		var newPage = page+1;
		var ajaxurl =that.data('url');
		var prev = that.data('prev');
		var archive = that.data('archive');
		
		if (typeof prev === 'undefined'){
			prev = 0;
		}
		
		if (typeof archive === 'undefined'){
			archive = 0;
		}
		
		that.addClass('loading').find('.text').slideUp(320);
		that.find('.fa-refresh').addClass('fa-spin');
		that.find('.fa-spin').addClass('fa-2x');

		$.ajax({
			
			url: ajaxurl,
			type : 'post',
			data : {
				slug : slug,
				page : page,
				prev : prev,
				archive : archive,
				action : 'store_load_more'
			},
			error : function(response){
				console.log(response);
			},
			success : function(response){
			
				if(response == 0 ){
				
					$('.store-posts-container').append('<div class="text-center"><h3>You reach the end of the line!</h3><p>No more posts to load.</p></div>');
					
					that.slideUp(320);
				
				}else {
				
					setTimeout(function(){
			
						if(prev == 1){
							$('.store-posts-container').prepend(response);
							newPage = page-1;
						} else {
							$('.store-posts-container').append(response);
						}
						
						if(newPage == 1){
							that.slideUp(320);
						
						}else {
							that.data('page', newPage);
						
							that.removeClass('loading').find('.text').slideDown(320);
							that.find('.fa-refresh').removeClass('fa-spin');
							that.find('.fa-refresh').removeClass('fa-2x');
						
						}
					
						revealPosts();
						$.stellar('refresh');
							
					}, 500);
				}
			}
		});
	});
	
	//Scroll function
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		
		if(Math.abs(scroll-last_scroll) > $(window).height()*0.1){
			last_scroll = scroll;
			
			$('.page-limit').each(function(index){
				if(isVisible($(this))){
					history.replaceState(null, null, $(this).attr("data-page"));
					return(false);
				}
			});
		}
	});
	
	//Helper functions
	function revealPosts(){
	
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
	
		var posts = $('article:not(.reveal)');
		var i = 0;
		setInterval(function(){
			if(i >= posts.length) return false;
			var el = posts[i];
			$(el).addClass('reveal').find('.store-carousel-thumb').carousel();
			
			
			i++
		}, 200);
	}
	
	function isVisible(element){
		var scroll_pos = $(window).scrollTop();
		var window_height = $(window).height();
		var el_top = $(element).offset().top;
		var el_height = $(element).height();
		var el_bottom = el_top + el_height;
		
		return ((el_bottom - el_height*0.25 > scroll_pos) && (el_top <(scroll_pos+0.5*window_height)));
		
	}

	//Contact Form Submission
	$('#storeContactForm').on('submit', function(e){
	
		e.preventDefault();
		
		$('.has-error').removeClass('has-error');
		$('.js-show-feedback').removeClass('js-show-feedback');
		
		var form = $(this),
			name 	= form.find('#name').val(),
			email 	= form.find('#email').val(),
			message = form.find('#message').val(),
			ajaxurl = form.data('url');
			
		if(name === ''){
			$('#name').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(email === ''){
			$('#email').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(message === ''){
			$('#message').parent('.form-group').addClass('has-error');
			return;
		}
		
		form.find('input, button, textarea').attr('disabled', 'disabled');
		$('.js-form-submission').addClass('js-show-feedback');
		
		$.ajax({
				
			url: ajaxurl,
			type : 'post',
			data : {
				name : name,
				email : email,
				message : message,
				action : 'bzbr001_save_user_contact_form'
			},
			error : function(response){
				$('.js-form-submission').removeClass('js-show-feedback');
				$('.js-form-error').addClass('js-show-feedback');
				form.find('input, button, textarea').removeAttr('disabled');
			},
			success : function(response){
				if(response == 0){
				
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-error').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled');
					}, 500);
					
				}else {
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-success').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled').val('');
					}, 500);
				}
				
			}
		});
		
	});
	
         
	//Reviews Form Submission
	$('#storeReviewForm').on('submit', function(e){
	
		e.preventDefault();
		
		$('.has-error').removeClass('has-error');
		$('.js-show-feedback').removeClass('js-show-feedback');
		
		var form = $(this),
			title	= form.find('#title').val(),
			reviews = form.find('#reviews').val(),
			rating = form.find('#rating').val(),
			name 	= form.find('#name').val(),
			email 	= form.find('#email').val(),
			ajaxurl = form.data('url');
		
		if(title === ''){
			$('#title').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(reviews === ''){
			$('#reviews').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(rating === ''){
			$('#rating').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(name === ''){
			$('#name').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(email === ''){
			$('#email').parent('.form-group').addClass('has-error');
			return;
		}
		
		form.find('input, button, textarea, select').attr('disabled', 'disabled');
		$('.js-form-submission').addClass('js-show-feedback');
		
		$.ajax({
				
			url: ajaxurl,
			type : 'post',
			data : {
				title : title,
				reviews : reviews,
				rating : rating,
				name : name,
				email : email,
				
				action : 'bzbr001_save_user_review_form'
			},
			error : function(response){
				$('.js-form-submission').removeClass('js-show-feedback');
				$('.js-form-error').addClass('js-show-feedback');
				form.find('input, button, textarea, select').removeAttr('disabled');
			},
			success : function(response){
				if(response == 0){
				
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-error').addClass('js-show-feedback');
						form.find('input, button, textarea, select').removeAttr('disabled');
					}, 500);
					
				}else {
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-success').addClass('js-show-feedback');
						form.find('input, button, textarea, select').removeAttr('disabled').val('');
					}, 500);
				}
				
			}
		});
		
	});
	
	
	//Optin Form Submission
	$('#storeOptinForm').on('submit', function(e){
	
		e.preventDefault();
		
		$('.has-error').removeClass('has-error');
		$('.js-show-feedback').removeClass('js-show-feedback');
		
		var form = $(this),
			name 	= form.find('#name').val(),
			email 	= form.find('#email').val(),
			ajaxurl = form.data('url');
		
		if(name === ''){
			$('#name').parent('.form-group').addClass('has-error');
			return;
		}
		
		if(email === ''){
			$('#email').parent('.form-group').addClass('has-error');
			return;
		}
		
		form.find('input, button, textarea, select').attr('disabled', 'disabled');
		$('.js-form-submission').addClass('js-show-feedback');
		
		$.ajax({
				
			url: ajaxurl,
			type : 'post',
			data : {
				name : name,
				email : email,
				
				action : 'bzbr001_save_user_optin_form'
			},
			error : function(response){
				$('.js-form-submission').removeClass('js-show-feedback');
				$('.js-form-error').addClass('js-show-feedback');
				form.find('input, button').removeAttr('disabled');
			},
			success : function(response){
				if(response == 0){
				
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-error').addClass('js-show-feedback');
						form.find('input, button').removeAttr('disabled');
					}, 500);
					
				}else {
					setTimeout(function(){
						$('.js-form-submission').removeClass('js-show-feedback');
						$('.js-form-success').addClass('js-show-feedback');
						form.find('input, button').removeAttr('disabled').val('');
					}, 500);
				}
			}
		});
	});
	
	
	//popup ads modal
	function show_modal(){$('#onloadModal').modal('show'); }   
	function hide_modal(){$('#onloadModal').modal('hide');}   
	
	$(window).load(function(){
		$('#onloadModal').modal('show');
		var rel = $('#onloadModal').data('timer')+'000';
		window.setTimeout(hide_modal, rel);
	});
	
	$(function(){
		$('#onclickModal').on('show.bs.modal', function(){
			var rel = $(this).data('timer')+'000';
			var myModal = $(this);
			clearTimeout(myModal.data('hideInterval'));
			myModal.data('hideInterval', setTimeout(function(){
				myModal.modal('hide');
			}, rel));
		});
	});
	
	//animate modal pops
	var entrance = $('.modal').data('entrance');
	var exit = $('.modal').data('exit');
	var modalID = document.getElementById('onclickModal');
	var modalID = document.getElementById('onloadModal');
	
	if(modalID === null){ var modalID = $('#onclickModal');	}
		
	$(modalID).on('show.bs.modal', function (e) {
	  $('.modal-size').addClass('animated ' + entrance);
	  $('.modal-size').removeClass(exit);
	});
	
	$(modalID).on('hide.bs.modal', function (e) {
		  $('.modal-size').addClass('animated ' + exit);
		  $('.modal-size').removeClass(entrance);
	}); 


	//animate ads images
	var animate = $('#popupWrap').data('animate');
	var el = $('#asideContent');
	var els = $('.modal-body');
	
	$(function(){
		el.find('img').addClass('wow ' + animate);
		els.find('img').addClass(animate);
	});
	
	
	//gallery list
	(function($) {

	/**
	* Copyright 2012, Digital Fusion
	* Licensed under the MIT license.
	* http://teamdf.com/jquery-plugins/license/
	*
	* @author Sam Sehnert
	* @desc A small plugin that checks whether elements are within
	*     the user visible viewport of a web browser.
	*     only accounts for vertical position, not horizontal.
	*/

		$.fn.visible = function(partial) {
			var $t				= $(this),
				$w            	= $(window),
				viewTop      	= $w.scrollTop(),
				viewBottom    	= viewTop + $w.height(),
				_top          	= $t.offset().top,
				_bottom       	= _top + $t.height(),
				compareTop    	= partial === true ? _bottom : _top,
				compareBottom 	= partial === true ? _top : _bottom;
			
			return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
		};	
	})(jQuery);

	var win = $(window);
	var allMods = $(".module");

	allMods.each(function(i, el) {
		var el = $(el);
		if (el.visible(true)) {el.addClass("already-visible"); } 
	});

	win.scroll(function(event) {
		allMods.each(function(i, el) {
			var el = $(el);
			if (el.visible(true)) {el.addClass("come-in"); } 
		});
	});

	//gallery head carousel
	var angle = 0;
	
	$('#ssleft').on('click', function(){ 
		spinner = document.querySelector("#spinner");
		angle = angle - 45; 
		spinner.setAttribute("style","-webkit-transform: rotateY("+ angle +"deg); -moz-transform: rotateY("+ angle +"deg); transform: rotateY("+ angle +"deg);");
	});
	
	$('#ssright').on('click', function(){ 
		spinner = document.querySelector("#spinner");
		angle = angle + 45; 
		spinner.setAttribute("style","-webkit-transform: rotateY("+ angle +"deg); -moz-transform: rotateY("+ angle +"deg); transform: rotateY("+ angle +"deg);");
	});
	
	//Audio head display
	
	

		
	

	
});