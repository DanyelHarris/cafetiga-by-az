$(document).ready(function(){
	
	//tooltip social icon
	$('[data-toggle="tooltip"]').tooltip();
	
     $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
       /*  $('#back-to-top').tooltip('show'); */


	
	//Add Fixed-Navbar
	$(window).scroll(fixedNavi);
	function fixedNavi(e) {
	if ($(this).scrollTop() > 150) {
	  $('.navbar-default').addClass('navbar-fixed-top');
	  } else {
		$('.navbar-default').removeClass('navbar-fixed-top');
	  }
	}

	//stores-appear
	new WOW().init();















});