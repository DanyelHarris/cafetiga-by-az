jQuery(document).ready(function($){


/* page=bazahab_store (popup setting) */ 			
	
	//button display
	
	/* text */
	$('#popup_button').keyup(function () {
		$('#btnopen').text($(this).val());
	});
	
	$('#popup_button_2').keyup(function () {
		$('#btnopen2').text($(this).val());
	});
	
	$('#popup_button_3').keyup(function () {
		$('#btnopen3').text($(this).val());
	});
	

	//color-picker
	(function ($) {
	  $(function () {
		$('.my-input-class').wpColorPicker();
	  });
	}(jQuery));
	
	/* color */
	jQuery('.my-input-class').wpColorPicker({
		/**
		 * @param {Event} event - standard jQuery event, produced by whichever
		 * control was changed.
		 * @param {Object} ui - standard jQuery UI object, with a color member
		 * containing a Color.js object.
		 */
		change: function (event, ui) {
			var element = event.target.id;
			var color = ui.color.toString();
			
			// Add your code here
			if(element == 'popup_button_css'){
			$('.btn-main').css('color', color);
			$('.btn-main').css('border-color', color);
			$('.price').css('border-color', color);
			$('#btnopen').css('border-color', color);
			$('#btnopen2').css('border-color', color);
			$('#btnopen3').css('border-color', color);
			$('#btnopen').css('color', color);
			$('#btnopen2').css('color', color);
			$('#btnopen3').css('color', color);
			} 
			else if(element == 'popup_button_back_css'){
			$('.btn-main').css('background', color);
			$('.ring-outer #btnopen').css('background', color);
			$('.starburst').css('background', 'radial-gradient(circle, #000000 10%, ' + color + ' 80%)'); 
			}
			else if(element == 'popup_close_button_css'){
			$('<style>#popup_close_button_css_display.closed::before{background:' + color + '}</style>').appendTo('head');
			$('<style>#popup_close_button_css_display.closed::after{background:' + color + '}</style>').appendTo('head');
			}
		},

		/**
		 * @param {Event} event - standard jQuery event, produced by "Clear"
		 * button.
		 */
		clear: function (event) {
			var element = jQuery(event.target).siblings('.my-input-class')[0];
			var color = '';

			if (element) {
				// Add your code here
				$('.btn-main').css('background', color);
				$('.ring-outer #btnopen').css('background', color);
				$('.starburst').css('background', 'radial-gradient(circle, #e00000 20%, #990000 80%)');
				
			}
		}
	});
	
	//button display
	$('#popup_button_choice').change(function() {
		var getText = $('#popup_button_choice option:selected').val();
		$("#popup_button_css_display").removeClass();
		$("#popup_button_css_display").toggleClass("btn-main " + getText);
	});
	
	
	$(document).on('click', '[name="popup_close_button_choice"]', function () {
	var getText = ($("input[name='popup_close_button_choice']:checked").attr("value"));
		
		$("#popup_close_button_css_display").removeClass();
		$("#popup_close_button_css_display").toggleClass("btn-main-close " + getText);
	});

});


