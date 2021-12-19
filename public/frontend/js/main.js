(function ($) {
	"use strict";

	// Preloader Start
	var AUTOFIREBOX = {};
	var $window = $(window);

	AUTOFIREBOX.preloader = function () {
		$("#load").fadeOut();
		$('#pre-loader').delay(0).fadeOut('slow');
	};

	$window.on("load", function () {
		AUTOFIREBOX.preloader();
	}); // Preloader End



	// scrollToTop
	var btn = $('#button');

	$(window).scroll(function () {
		if ($(window).scrollTop() > 200) {
			btn.addClass('show');
		} else {
			btn.removeClass('show');
		}
	});

	btn.on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, '300');
	});
	//end scrollToTop


	// parallax active
	$('.parallax-window').parallax();
	
	//	wow js
	new WOW().init();

})(jQuery);





//for javascript
$(document).ready(function () {


	/* nav*/
	$(window).scroll(function () {
		$('.header-section').toggleClass('scrolled', $(this).scrollTop() > 70);
	});


	/* mobile menu */
	$('.mobile-btn').on('click', function () {
		$('.mobile-menu').toggleClass('active');
	});


	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function () {
		$(this).prev(".menu-link").find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
	}).on('hide.bs.collapse', function () {
		$(this).prev(".menu-link").find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
	});



	//mixitup
	var mixer = mixitup('.conten');

	// megnifi popup
	$('.image-link').magnificPopup({
		type: 'image'
	});
	$('.test-popup-link').magnificPopup({
		type: 'image'
		// other options
	});


	// megnifi popup
	$('.image-link').magnificPopup({
		type: 'image'
	});
    
	$('.test-popup-link').magnificPopup({
		type: 'image'
	});
});




//for other javascript
//	accordion about-us-page
var acc = document.getElementsByClassName("p-accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function () {
		this.classList.toggle("p-active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
}


//fot counter
$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 6000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }

  });  
  
  

});
// table counter
$(document).ready( function () {
    $('#table_id').DataTable();
} );

$(document).ready( function () {
    $('#table2_id').DataTable();
} );

$(document).ready( function () {
    $('#table3_id').DataTable();
} );



$(document).ready(function () {
    $('#ud-mobile-btn').click(function () {
        $('.mobile-user-dashboard').addClass('mud-add');
        $("body").addClass('hover-body');
    });

    $('#mud-close-btn').click(function () {
        $('.mobile-user-dashboard').removeClass('mud-add');
    });
});



//slick slider
$('.autoplay').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrows: true,
    nextArrow: $('.nxt'),
    prevArrow: $('.prv'),
    responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,


            }
                },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            }
                },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
                }

            ]

});
