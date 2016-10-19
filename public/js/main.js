

/**********************************************************************************************


Template Name : Zenda
Description : Professional & Creative Multipurpose Responsive Business HTML5 Template
Version : 1.0
Author : Naveen Kumar

IF YOU NEED ANY KIND OF HELP REGARDING TO THIS TEMPLATE
SO, DIRECT E-MAIL US AT :- naveenkumarwp@gmail.com



************************************************************************************************/


$(document).ready(function() {



/*=================================================================
        PRELOADER
  =================================================================*/
  $(window).load(function() {
  $(".site-loader").delay(1000).slideUp(1000); //here you can set slideup and delay time of preloader
    })
/*=================================================================
        PRELOADER END
  =================================================================*/




/*=================================================================
        HEADER SECTION
  =================================================================*/


/*=================================================================
        HEADER ANIMATION ON SCROLL
  =================================================================*/
  $(window).scroll(function() {
    var outer = $('#home').height();

    if ($(document).scrollTop() >= outer) {
      $('#topnav').addClass('scrolled');
    } else{
      $('#topnav').removeClass('scrolled');
    }
  }).trigger('scroll');

  $('#nav a[href=#]').click(function() {
    return false;
  });



/*=================================================================
        NAVIGATION SCROLLING
        Its for the long page navigation on the index page. like
        when you click about, the page scrolls to about us section
  =================================================================*/
  //$('a[href*=#]').click(function() {
  //  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
  //    var target = $(this.hash);
  //    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
  //    if (target.length) {
  //      $('html,body').animate({
  //        scrollTop: target.offset().top
  //      }, 1000);
  //      return false;
  //    }
  //  }
  //});


/*=================================================================
        CLOSE NAVBAR ON SCROLL
  =================================================================*/
  //$('#nav a').on('click', function(){
  //  if ($(window).width() < 768) {
  //    $(".navbar-toggle").click();
  //  }
  //});
/*=================================================================
        HEADER SECTION END
  =================================================================*/






/*=================================================================
        PARALLAX SECTION
  =================================================================*/
  $('.parallax-section').each(function() {
    $(this).parallax("100%", 0.1);
  });
/*=================================================================
        PARALLAX SECTION END
  =================================================================*/






/*=================================================================
        HOME SECTION SLIDER
  =================================================================*/
  $('#home-slider').flexslider({
    animation: "slide",
    directionNav: false,
    controlNav: false,
    direction: "vertical",
    smoothHeight: true,
    useCSS: false
  });
/*=================================================================
        HOME SECTION SLIDER END
  =================================================================*/





/*=================================================================
        BACKGROUND SLIDER
  =================================================================*/
  $('#backgrounds').flexslider({
    animation: "fade",
    directionNav: false,
    controlNav: false,
  });
/*=================================================================
        BACKGROUND SLIDER END
  =================================================================*/





/*=================================================================
        BACKGROUND IMAGE
  =================================================================*/
  $('#backgrounds img').each(function() {
    var image = $(this).attr('src');
    $(this).parents('li').css('background-image', 'url('+image+')');
    $(this).remove();
  });
/*=================================================================
        BACKGROUND IMAGE END
  =================================================================*/





/*=================================================================
        PAGE TITLE OPACITY ON SCROLL
  =================================================================*/
  $(window).on('scroll', function(){

    var fadeStart=  100;
    var fadeUntil=  '';

    if ($('#home').length) {
      fadeUntil = 450
    } else{
      fadeUntil = 200
    }

    var offset = $(document).scrollTop();
    var opacity=0;

    if(offset<=fadeStart){
      opacity=1;
    }
    else if( offset<=fadeUntil ){
      opacity=1-offset/fadeUntil;
    }

    $('.slide-middle, .title-text').css('opacity',opacity);

  });
/*=================================================================
        PAGE TITLE OPACITY ON SCROLL END
  =================================================================*/





/*=================================================================
        ELEMENT ANIMATION
  =================================================================*/
  $('.animated').appear(function(){
    var element = $(this);
    var animation = element.data('animation');
    var animationDelay = element.data('animation-delay');
    if (animationDelay) {
      setTimeout(function(){
        element.addClass( animation + " visible" );
      }, animationDelay);
    }else {
      element.addClass( animation + " visible" );
    }
  },{accY: -150});
/*=================================================================
        ELEMENT ANIMATION END
  =================================================================*/





/*=================================================================
        CLIENT CAROUSEL
  =================================================================*/
  $("#clients-carousel").owlCarousel({
    items : 4,
    itemsDesktop : [1000,4],
    itemsDesktopSmall : [900,3],
    itemsTablet: [600,2],
    itemsMobile : false,
    pagination: false,
    autoPlay: 4000,  // here you can change carousel slide duration
  });
/*=================================================================
        CLIENT CAROUSEL END
  =================================================================*/





/*=================================================================
        TESTIMONIALS CAROUSEL
  =================================================================*/
  $("#testimonials-carousel").owlCarousel({
    singleItem: true,
	autoPlay: 4000,  // here you can change carousel slide duration
  });
/*=================================================================
        TESTIMONIAL CAROUSEL END
  =================================================================*/





/*=================================================================
        PORTFOLIO SECTION START
  =================================================================*/


/*=================================================================
        PORTFOLIO FILTER
  =================================================================*/
  $('#works-list').mixitup({
    effects: ['fade','scale'],
    easing: 'snap'
  });


  $(".goTop").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
  });



/*=================================================================
        PORTFOLIO PROJECT SLIDER
  =================================================================*/
  function initProjectSlider() {
    $('.project-slider').flexslider({
      prevText: "",
      nextText: "",
      useCSS: false,
      animation: "slide"
    });
  };



/*=================================================================
        PORTFOLIO MODAL
  =================================================================*/
  $('.open-project').on('click', function(){
    var projectUrl = $(this).attr("href");

    $('#project-modal').fadeIn('slow');
    $("#project-modal-content").load(projectUrl + ' #project',
      function(){
        if ($('.project-slider').length > 0) {
          initProjectSlider();
        }
    });

    $('.project-modal-title h3').text($(this).find('h5').text());
    $('body').addClass('modal-open');

    return false;
  });




/*=================================================================
        PORTFOLIO MODAL CLOSE
  =================================================================*/
  $('#project-modal').on('click', '#project-modal-close', function(event) {
    $('#project-modal-content').html('');
    $('#project-modal').fadeOut('slow');
    $('body').removeClass('modal-open');
    return false;
  });

  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
      $('#project-modal-close').trigger('click');
    }
  });




/*=================================================================
        PORTFOLIO PROJECT SLIDER
  =================================================================*/
  $('.project-slider').flexslider({
    controlNav: false,
    animation: "slide",
    prevText: "",
    nextText: ""
  });

 });
/*=================================================================
        PORTFOLIO SECTION END
  =================================================================*/






/*=================================================================
        COUNTER (Fun Facts)
  =================================================================*/
  $('.counter').appear(function(){

    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');

    $('.total-number-1').animateNumber({
            number: 3500, //change value here
            numberStep: comma_separator_number_step
    }, 10000); //change counter duration here

    $('.total-number-2').animateNumber({
            number: 2300, //change value here
            numberStep: comma_separator_number_step
    }, 10000); //change counter duration here

    $('.total-number-3').animateNumber({
            number: 2700, //change value here
            numberStep: comma_separator_number_step
    }, 10000); //change counter duration here

    $('.total-number-4').animateNumber({
            number: 2800, //change value here
            numberStep: comma_separator_number_step
    }, 20000); //change counter duration here


    }, {
        offset: '50%'

 });
/*=================================================================
        COUNTER END
  =================================================================*/





/*=================================================================
        BACK TO TOP
  =================================================================*/
 jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 500,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 2000,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.back-to-top-link');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('back-to-top-visible') : $back_to_top.removeClass('back-to-top-visible back-to-top-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('back-to-top-fade-out');
		}
	});

	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

 });
/*=================================================================
        BACK TO TOP END
  =================================================================*/





/*=================================================================
        TAB (Working Process)
  =================================================================*/
 //$(document).ready(function () {
 //
	//$('.tabs.tabs-reasons').easytabs({
	//	cycle: 1500
	//});
 //
	//$('.tabs.tabs-top, .tabs.tabs-circle-top, .tabs.tabs-2-big-top, .tabs.tabs-side').easytabs({
	//	animationSpeed: 200,
	//	updateHash: false
	//});
 //
 //});
/*=================================================================
        TAB END
  =================================================================*/




/*=================================================================
        MAILCHIMP SUBSCRIBE FORM
  =================================================================*/
 $(".mc-subscribe").ajaxChimp({
        callback: mcCallback,
        url: "http://wpsolutiongroup.us10.list-manage.com/subscribe/post?u=dfebf17589e5f97ee693a5a9c&amp;id=b2cd10112f" // Just Replace your mailchimp post url inside double quote "" & It's Ready.
    });

    function mcCallback (res) {
      if(res.result === 'success') {
        $('.subscribe-result').html(res.msg).delay(100).slideDown(500).delay(5000).slideUp(1000);
      }else if(res.result === 'error'){
        $('.subscribe-result').html(res.msg).delay(100).slideDown(500).delay(5000).slideUp(1000);
      }
    }
/*=================================================================
        MAILCHIMP SUBSCRIBE FORM END
  =================================================================*/




/*=================================================================
        CHART SKILL
  =================================================================*/
//$(document).ready(function(e) {
//var index=0;
//$(document).scroll(function(){
//	var top = $('.skills').height()-$(window).scrollTop();
//	console.log(top)
//	if(top<-1000){
//		if(index==0){
//
//			$('.chart').easyPieChart({
//				easing: 'easeOutBounce',
//				onStep: function(from, to, percent) {
//					$(this.el).find('.percent').text(Math.round(percent));
//				}
//			});
//
//		}
//		index++;
//	}
//})
//});


/*=================================================================
        CHART LOADING
  =================================================================*/
$(window).load(function() {

	var chart = window.chart = $('.chart').data('easyPieChart');
	$('.js_update').on('click', function() {
		chart.update(Math.random()*100);
	});
});
/*=================================================================
        CHART SKILL END
  =================================================================*/





/*=================================================================
        GOOGLE MAP
  =================================================================*/

		if(typeof $.fn.gMap !== 'undefined'){


			$('.google-map').each(function() {

				var $t = $(this),
					mapZoom = 15,
					mapAddress = $t.attr("data-address"),
					mapCaption = $t.attr("data-caption"),
					mapType = "ROADMAP",
					mapHeight = $t.attr("data-mapheight"),
					popUp = false;

				if ($t.attr("data-zoom") !== undefined) {
					mapZoom = parseInt($t.attr("data-zoom"),10);
				}

				if ($t.attr("data-mapHeight") !== undefined) {
					$t.css( "height", mapHeight+'px');
				}

				if ($t.attr("data-maptype") !== undefined) {
					mapType = $t.attr("data-maptype");
				}

				if ($t.attr("data-popup") !== undefined) {
					popUp = $t.data("popup");
				}

				$t.gMap({
					maptype: mapType,
					scrollwheel: false,
					zoom: mapZoom,
					markers: [{
						address: mapAddress,
						html: mapCaption,
						popup: popUp
					}],
					controls: {
						panControl: true,
						zoomControl: true,
						mapTypeControl: true,
						scaleControl: false,
						streetViewControl: false,
						overviewMapControl: false
					}
				});

			});

		}
/*=================================================================
        GOOGLE MAP END
  =================================================================*/





/*=================================================================
        SCROLL SPEED (Here You can Set Website Scroll Speed)
  =================================================================*/
$(function() {

    jQuery.scrollSpeed(100, 800, 'easeOutCubic');

});
/*=================================================================
        SCROLL SPEED END
  =================================================================*/





/*=================================================================
        COMING SOON
  =================================================================*/
    //$(".timer").countdown('2016/09/09', function(event) {  //here you setup your launching date just change the date from your launching date and it's ready to work.
    //  var $this = $(this).html(event.strftime(''
    //    + '<ul class="list-none list-inline"><li><span>%w</span> <span>weeks</span></li>'
    //    + '<li><span>%d</span> <span>days</span></li>'
    //    + '<li><span>%H</span> <span>hr</span></li>'
    //    + '<li><span>%M</span> <span>min</span></li>'
    //    + '<li><span>%S</span> <span>sec</span></li></ul>'));
    //});
/*=================================================================
        COMING SOON END
  =================================================================*/