

  //  =========== Certification

  $('.certification_slider').slick({
    arrows: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    speed: 1600,
    autoplaySpeed: 2500,
    responsive: [
      {
        breakpoint: 468,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
    ]
  });


// =======blog slider============//

  $('.testimonial-slider').slick({
    arrows: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: false,
    speed: 1600,
    autoplaySpeed: 2500,
    responsive: [
      {
        breakpoint: 468,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint:576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint:768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint:992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint:1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
    ]
  });

  
  $('.blog_slider').slick({
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    speed: 1600,
    autoplaySpeed: 2500,
    responsive: [
      {
        breakpoint: 468,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint:768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint:992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      }
    ]
  });

  $('.bt_top').click(function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1500)
	});

	$(window).scroll(function () {
		var scrolling = $(this).scrollTop();

		if (scrolling > 300) {
			$('.bt_top').fadeIn(300);
		} else {
			$('.bt_top').fadeOut(300)
		}

		if (scrolling > 100) {
			$('.navbar').addClass('menu_fix');
		} else {
			$('.navbar').removeClass('menu_fix');
		}
	});

  // wow js
	wow = new WOW({
		boxClass: 'wow', // default
		animateClass: 'animated', // default
		offset: 0, // default
		mobile: true, // default
		live: true // default
	})
	wow.init();


  // Venobox
	new VenoBox({
		selector: '.my-image-links',
		numeration: true,
		infinigall: true,
		share: true,
		spinner: 'rotating-plane'
	});

  var containerEl = document.querySelector('.port_mix');

var mixer = mixitup(containerEl);