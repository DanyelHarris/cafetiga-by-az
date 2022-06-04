jQuery(document).ready(function($){
	
	function evaluate(){
		var triggerItem = $('#optin_form');
		var closeItem = $('#optin_autoresponder');
		var closeItems = $('#cta_autoresponder');
					
		if(triggerItem.is(':checked')){
			closeItem.fadeIn();
			closeItems.fadeIn();
		}else{
			closeItem.fadeOut(); 
			closeItems.fadeOut(); 
		}
	}
	$('input[type="checkbox"]').click(evaluate).each(evaluate);
	
});