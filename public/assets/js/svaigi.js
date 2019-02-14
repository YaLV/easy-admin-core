var winScrollTop = 0;


jQuery(window).scroll(function(){

  winScrollTop = jQuery(this).scrollTop();

  offsetYGlobal = window.pageYOffset;

  parallax();

});

jQuery(window).resize(function(){

  dropdowns();
  mobileslidernav();
  mobilemenuscroll();

});


jQuery(document).ready(function() {

  itemonscreen();
  dropdowns();
  parallax();
  carousels();
  forms();
  animatedisplaynone();
  marketdaydropdown();
  lightbox();
  mobilemenuscroll();

  if (jQuery('#farmersmap-canvas').length > 0) {
    farmersmap();
  }
  else if (jQuery('#contactsmap-canvas').length  >0) {
    contactsmap();
  }

});


jQuery(window).on('load', function(){

  if (jQuery(window).width() > 998) {

    // var sidebarheight = jQuery('.sv-cart .sidebar').height();
    //
    // jQuery('.sv-cart .list').css('min-height', sidebarheight);

    var $sticky = jQuery('.sticky');
    var $stickyrStopper = jQuery('.sticky-stopper');

    if (!!$sticky.offset()) {

      var windowTop = jQuery(window).scrollTop();

      var generalSidebarHeight = $sticky.height();
      var stickyTop = $sticky.offset().top;
      var stickOffset = 30;
      var stickyStopperPosition = $stickyrStopper.offset().top;
      var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset - stickOffset;
      var diff = stickyStopperPosition - stopPoint;

      var diff2 = stickyStopperPosition - stickyTop - stickOffset;

      console.log(diff);

      if (diff2 < generalSidebarHeight) {
        $sticky.css({ position: 'relative', top: 'initial', right: '0', width: 'calc(33.32% - 30px)' });
      }

      jQuery(window).scroll(function(){

        var windowTop = jQuery(window).scrollTop();

        if (stopPoint < windowTop) {
          $sticky.css({ position: 'absolute', bottom: 0, top: 'auto' });
        }
        else if (stickyTop < windowTop+stickOffset) {
          $sticky.css({ position: 'fixed', top: stickOffset });
        }
        else {
          $sticky.css({position: 'absolute', bottom: 'auto', top: 'initial' });
        }

        if (diff2 < generalSidebarHeight) {
          $sticky.css({ position: 'relative', bottom: 'auto', top: 'initial' });
        }

      });

    }

  }

});


function itemonscreen() {

  winScrollTop = jQuery(this).scrollTop();

  jQuery.fn.isOnScreen = function(){

    var win = jQuery(window);
    var viewport = {
      top : win.scrollTop(),
      left : win.scrollLeft()
    };

    viewport.bottom = viewport.top + win.height();
    var bounds = this.offset();
    bounds.bottom = bounds.top + this.outerHeight();
    return (!(viewport.bottom < bounds.top || viewport.top > bounds.bottom));

  };

}


function dropdowns() {

  if ($(window).width() > 992) {

    jQuery('.sv-dock .cart, .sv-products-menu .cart').on('mouseenter', function() {
      clearTimeout(window.timeout);
      jQuery(this).find('.sv-dropdown').addClass('is-dom');
      jQuery(this).addClass('is-active');
      var drop = jQuery(this).find('.sv-dropdown');
      setTimeout(function() {
        drop.addClass('is-visible');
      }, 10);
    });

    jQuery('.sv-dock .cart, .sv-products-menu .cart').on('mouseleave', function() {
      jQuery(this).find('.sv-dropdown').removeClass('is-visible');
      var drop = jQuery(this).find('.sv-dropdown');
      jQuery(this).removeClass('is-active');
      window.timeout = setTimeout(function() {
        drop.removeClass('is-dom');
      }, 350);
    });

    jQuery('.sv-dock .user').on('mouseenter', function() {
      clearTimeout(window.timeout);
      jQuery(this).find('.sv-dropdown').addClass('is-dom');
      jQuery(this).addClass('is-active');
      var drop = jQuery(this).find('.sv-dropdown');
      setTimeout(function() {
        drop.addClass('is-visible');
      }, 10);
    });

    jQuery('.sv-dock .user').on('mouseleave', function() {
      jQuery(this).find('.sv-dropdown').removeClass('is-visible');
      var drop = jQuery(this).find('.sv-dropdown');
      jQuery(this).removeClass('is-active');
      window.timeout = setTimeout(function() {
        drop.removeClass('is-dom');
      }, 350);
    });

    jQuery('.sv-products-menu .sv-default-dropdown-toggle').on('mouseenter', function() {
      clearTimeout(window.timeout);
      jQuery(this).find('.sv-dropdown').removeClass('is-dom').addClass('is-dom');
      jQuery(this).addClass('is-active');
      var drop = jQuery(this).find('.sv-dropdown');
      setTimeout(function() {
        drop.addClass('is-visible');
      }, 10);
    });

    jQuery('.sv-products-menu .sv-default-dropdown-toggle').on('mouseleave', function() {
      jQuery(this).find('.sv-dropdown').removeClass('is-visible');
      var drop = jQuery(this).find('.sv-dropdown');
      jQuery(this).removeClass('is-active');
      window.timeout = setTimeout(function() {
        drop.removeClass('is-dom');
      }, 350);
    });

  }

  var productsdropdown = 280;
  var windowwidth = jQuery(window).width();
  var productsmenuleft = jQuery('.sv-products-menu .sv-default-dropdown-toggle').offset().left;

  if ( windowwidth - productsmenuleft - productsdropdown < 0 ) {
    jQuery('.sv-products-menu .sv-dropdown').css({
      "left": "auto",
      "right": "0"
    })
  }

}


function parallax() {

  var scrolled = jQuery(window).scrollTop();

  jQuery('.bg-parallax').each(function(){

    if (jQuery(this).isOnScreen()) {
      var firstTop = jQuery(this).offset().top;
      var block1 = jQuery(this).find(".image");
      var block2 = jQuery(this).find("video");
      var block3 = jQuery(this).find(".slow");
      var moveTop = (firstTop-winScrollTop)*0.3 //speed;
      var moveTop2 = (firstTop-winScrollTop)*0.6 //speed;
      var moveTop3 = (firstTop-winScrollTop-200)*0.1 //speed;
      block1.css("transform","translateY("+-moveTop+"px)");
      block2.css("transform","translate("+-50+"%, "+-moveTop2+"px)");
      block3.css("transform","translateY("+-moveTop3+"px)");
    }

  });

}


function carousels() {

  var owl = jQuery('.sv-product-card-slider .owl-carousel');
    owl.on('initialized.owl.carousel', function(e) {
        mobileslidernav();
    }).owlCarousel({
    autoWidth: false,
    loop: true,
    nav: true,
    rewind: false,
  	autoplay: false,
  	dots: false,
  	mouseDrag: false,
  	smartSpeed: 250,
    margin: 30,
    callbacks: true,
    navText: [
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M16.929,25.657l1.414,1.414,0.157-.157L29.657,38.071l1.414-1.414L19.914,25.5,31.071,14.343l-1.414-1.414L18.5,24.086l-0.157-.157-1.414,1.414L17.086,25.5Z' /></svg>",
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M33.071,25.657l-1.414,1.414L31.5,26.914,20.343,38.071l-1.414-1.414L30.086,25.5,18.929,14.343l1.414-1.414L31.5,24.086l0.157-.157,1.414,1.414-0.157.157Z' /></svg>"
    ],
    responsive: {
      0: {
        items: 1,
        slideBy: 1,
        margin: 15
      },
      750: {
        items: 3,
        slideBy: 3
      },
      1016: {
        items: 4,
        slideBy: 4
      },
      1246: {
        items: 5,
        slideBy: 5
      }
    }
  });

  var owl = jQuery('.sv-linked-products-slider .owl-carousel');
    owl.on('initialized.owl.carousel', function(e) {
        mobileslidernav();
    }).owlCarousel({
    autoWidth: false,
    loop: true,
    nav: true,
    rewind: false,
  	autoplay: false,
  	dots: false,
  	mouseDrag: false,
  	smartSpeed: 250,
    margin: 30,
    callbacks: true,
    navText: [
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M16.929,25.657l1.414,1.414,0.157-.157L29.657,38.071l1.414-1.414L19.914,25.5,31.071,14.343l-1.414-1.414L18.5,24.086l-0.157-.157-1.414,1.414L17.086,25.5Z' /></svg>",
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M33.071,25.657l-1.414,1.414L31.5,26.914,20.343,38.071l-1.414-1.414L30.086,25.5,18.929,14.343l1.414-1.414L31.5,24.086l0.157-.157,1.414,1.414-0.157.157Z' /></svg>"
    ],
    responsive: {
      0: {
        items: 1,
        slideBy: 2,
        margin: 15
      },
      750: {
        items: 3,
        slideBy: 3
      },
      1016: {
        items: 3,
        slideBy: 3
      },
      1246: {
        items: 4,
        slideBy: 4
      },
      1470: {
        items: 5,
        slideBy: 5
      }
    }
  });

  var owl = jQuery('.sv-blog-list-slider .owl-carousel');
    owl.on('initialized.owl.carousel', function(e) {
        mobileslidernav();
    }).owlCarousel({
    autoWidth: false,
    loop: true,
    nav: true,
    rewind: false,
  	autoplay: false,
  	dots: false,
  	mouseDrag: false,
  	smartSpeed: 250,
    margin: 30,
    callbacks: true,
    navText: [
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M16.929,25.657l1.414,1.414,0.157-.157L29.657,38.071l1.414-1.414L19.914,25.5,31.071,14.343l-1.414-1.414L18.5,24.086l-0.157-.157-1.414,1.414L17.086,25.5Z' /></svg>",
      "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><path class='bg' d='M-0.000,0.000 L50.000,0.000 L50.000,50.000 L-0.000,50.000 L-0.000,0.000 Z' /><path class='arrow' d='M33.071,25.657l-1.414,1.414L31.5,26.914,20.343,38.071l-1.414-1.414L30.086,25.5,18.929,14.343l1.414-1.414L31.5,24.086l0.157-.157,1.414,1.414-0.157.157Z' /></svg>"
    ],
    responsive: {
      0: {
        items: 1,
        slideBy: 1,
      },
      750: {
        items: 1,
        slideBy: 1
      },
      1016: {
        items: 2,
        slideBy: 2
      },
      1246: {
        items: 3,
        slideBy: 3
      }
    }
  });

}


function forms() {

  jQuery('select').selectric({
    maxHeight: 300,
    disableOnMobile: false,
    nativeOnMobile: false,
    optionsItemBuilder: function(itemData, element, index) {
        if($(itemData.element[0]).data('wrap')) {
            return "<h3>" + ($(itemData.element[0]).data('origprice') ? "<s>" + $(itemData.element[0]).data('origprice') + "</s>" + itemData.text : itemData.text) + "</h3>";
        }
        return ($(itemData.element[0]).data('origprice') ? "<s>" + $(itemData.element[0]).data('origprice') + "</s>" + itemData.text : itemData.text);
    },
    labelBuilder: function(itemData) {
        if ($(itemData.element[0]).data('wrap')) {
            return "<h3>" + ($(itemData.element[0]).data('origprice') ? "<s>" + $(itemData.element[0]).data('origprice') + "</s>" + itemData.text : itemData.text) + "</h3>";
        }
        return ($(itemData.element[0]).data('origprice') ? "<s>"+$(itemData.element[0]).data('origprice')+"</s>"+itemData.text:itemData.text);
    }
  });

    jQuery('select').on('selectric-change', function(event, element, selectric) {
    jQuery(element).val(jQuery(element).selectric().val());
  });

  jQuery(':checkbox').on('click', function(){
    jQuery(this).parent().toggleClass('checked');
  });

  jQuery(function(){
    jQuery('.add').on('click',function(){
      var $qty=jQuery(this).closest('.quantity').find('.qty');
      var currentVal = parseInt($qty.val());
      if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
      }
    });
    jQuery('.minus').on('click',function(){
      var $qty=jQuery(this).closest('.quantity').find('.qty');
      var currentVal = parseInt($qty.val());
      if (!isNaN(currentVal) && currentVal > 0) {
        $qty.val(currentVal - 1);
      }
    });
  });

  jQuery('.sv-cart-tabs .tab').on('click', function() {
    jQuery('.sv-cart-tabs .tab').removeClass('active');
    jQuery(this).addClass('active');
  });

  jQuery('#spinner, .spinner').spinner({
    min: 1,
    max: 5,
    step: 1,
    numberFormat: "n",
  });

  if(jQuery('.spinner').val() < 2) {
    jQuery('.ui-spinner-down').css('background', '#e1e1e1');
  }

  jQuery('.ui-spinner-button').click(function() {
    if(jQuery('.spinner').val() < 2) {
      jQuery('.ui-spinner-down').css('background', '#e1e1e1');
    }
    else {
      jQuery('.ui-spinner-down').css('background', '#1f9363');
    }
    if(jQuery('.spinner').val() > 4) {
      jQuery('.ui-spinner-up').css('background', '#e1e1e1');
    }
    else {
      jQuery('.ui-spinner-up').css('background', '#1f9363');
    }
  });

  jQuery('.coupon .enter').click(function() {
    jQuery('.coupon .nr').focus();
    if (jQuery('.coupon .nr').is(":focus")) {
      jQuery('.coupon').addClass('has-focus');
    }
    // setTimeout(function () {
    //   jQuery('.coupon .nr').css('width', '100%');
    // }, 350);
  });

  jQuery('.coupon .nr').blur(function(){
    jQuery('.coupon').removeClass('has-focus');
    // jQuery('.coupon .nr').css('width', 'auto');
  });

}


function animatedisplaynone() {

  var bgmenuclose = jQuery('.sv-mobile-menu-close-bg');
  var body = jQuery('body');
  var html = jQuery('html');

  jQuery('.toggle-sv-menu-mobile, .sv-mobile-menu-close-bg').on('click', function () {

    window.offsetYClose = window.offsetYGlobal;

    var offsetY = window.pageYOffset;

    jQuery('body').css('top', -offsetY);

    body.toggleClass('sv-menu-mobile-open');
    html.toggleClass('sv-menu-mobile-open');

    if (bgmenuclose.hasClass('hidden')) {
      bgmenuclose.removeClass('hidden');
      if (jQuery(window).width() < 767) {
        setTimeout(function () {
          bgmenuclose.removeClass('visuallyhidden');
        }, 0);
      }
      else {
        setTimeout(function () {
          bgmenuclose.removeClass('visuallyhidden');
        }, 100);
      }
    }

    else {
      bgmenuclose.addClass('visuallyhidden');
      setTimeout(function () {
        bgmenuclose.addClass('hidden');
      }, 300);
    }

  });

  jQuery('.sv-menu-mobile-close').on('click', function () {

    jQuery('body').css('top', 'auto');

    jQuery('body, html').toggleClass('sv-menu-mobile-open');

    jQuery(window).scrollTop(window.offsetYClose);

    if (bgmenuclose.hasClass('hidden')) {
      bgmenuclose.removeClass('hidden');
      if (jQuery(window).width() < 767) {
        setTimeout(function () {
          bgmenuclose.removeClass('visuallyhidden');
        }, 0);
      }
      else {
        setTimeout(function () {
          bgmenuclose.removeClass('visuallyhidden');
        }, 100);
      }
    }

    else {
      bgmenuclose.addClass('visuallyhidden');
      setTimeout(function () {
        bgmenuclose.addClass('hidden');
      }, 300);
    }

  });

}

function mobileslidernav() {
  if (jQuery(window).width() < 767) {
    var imageheight = jQuery('.sv-product-card-slider .sv-product-card .image').height();
    jQuery('.sv-product-card-slider .owl-nav').css('top', imageheight / 2 - 25);
  }
}

function marketdaydropdown() {

  jQuery('.sv-marketday-dropdown .title').on('click', function () {
    jQuery('.sv-marketday-dropdown').toggleClass('is-open');
  });

  jQuery('.sv-marketday-dropdown .button').hover(
    function(){
      jQuery(this).parent().addClass('has-hover');
    },
    function(){
      jQuery(this).parent().removeClass('has-hover');
    }
  );

}


function lightbox() {

  var signin = jQuery('.sv-lightbox.sv-signin');
  var newsletter = jQuery('.sv-lightbox.sv-newsletter');
  var body = jQuery('body');
  var html = jQuery('html');

  jQuery('.toggle-sv-signin').on('click', function () {

		signin.toggleClass('sv-lightbox-open');
    html.toggleClass('sv-lightbox-open');
    body.toggleClass('sv-lightbox-open');

	  if (signin.hasClass('hidden')) {

	    signin.removeClass('hidden');

			setTimeout(function () {
	      signin.removeClass('visuallyhidden');
	    }, 50);

	  } else {

			signin.addClass('visuallyhidden');

			setTimeout(function () {
	      signin.addClass('hidden');
	    }, 650);

	  }

	});

  jQuery('.toggle-sv-newsletter').on('click', function () {

		newsletter.toggleClass('sv-lightbox-open');
    html.toggleClass('sv-lightbox-open');
    body.toggleClass('sv-lightbox-open');

	  if (newsletter.hasClass('hidden')) {

	    newsletter.removeClass('hidden');

			setTimeout(function () {
	      newsletter.removeClass('visuallyhidden');
	    }, 50);

	  } else {

			newsletter.addClass('visuallyhidden');

			setTimeout(function () {
	      newsletter.addClass('hidden');
	    }, 650);

	  }

	});

  jQuery('.toggle-lightbox-mobile-close').click(function(){
    jQuery('body').css('top', 'auto');
    jQuery(window).scrollTop(window.offsetYClose);
  });

  jQuery('.sv-newsletter .toggle-success').click(function(){
    jQuery(this).parents('.title').addClass('success');
    jQuery(this).parents('.title .data').animate({height: '0px'}, 350);
  });

}


function farmersmap() {

  var map;
  var markers = []; // Create a marker array to hold your markers
  var farmers = [
    ['z/s Cimbuļi', 56.9680577, 23.9764266, 1],
    ['z/s Cimbuļi', 57.3905378, 21.6458912, 2],
    ['z/s Cimbuļi', 56.3640147, 21.0163034, 3],
    ['z/s Cimbuļi', 56.3754104, 25.0451068, 4],
    ['z/s Cimbuļi', 57.3780472, 25.8692115, 5],
    ['z/s Cimbuļi', 56.5697352, 27.1985571, 6]
  ];
  var masters = [
    ['Meistars', 56.7170924, 23.7973048, 1],
    ['Meistars', 56.9484532, 24.8426623, 2],
    ['Meistars', 57.3557291, 25.1895103, 3],
    ['Meistars', 57.2613051, 22.6613138, 4],
    ['Meistars', 56.6588643, 22.0284328, 5],
    ['Meistars', 56.3648658, 26.7031151, 6]
  ];


  function setMarkers(locations) {

    var markerIcon = {
      url: 'img/tmp/icon-map-farmer.png',
      scale: 1,
      width: 45,
      height: 45,
      // anchor: new google.maps.Point(12, 24),
      optimized: false,
      zIndex: 99999999
    };

    for (var i = 0; i < locations.length; i++) {
      var farmer = locations[i];
      var myLatLng = new google.maps.LatLng(farmer[1], farmer[2]);
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        animation: google.maps.Animation.DROP,
        title: farmer[0],
        zIndex: farmer[3],
        icon: markerIcon
      });

      // Push marker to markers array
      markers.push(marker);
    }

  }

  function reloadFarmersMarkers() {

    // Loop through markers and set map to null for each
    for (var i=0; i<markers.length; i++) {
      markers[i].setMap(null);
    }

    // Reset the markers array
    markers = [];

    // Call set markers to re-add markers
    setMarkers(farmers);

  }

  function reloadMastersMarkers() {

    // Loop through markers and set map to null for each
    for (var i=0; i<markers.length; i++) {
      markers[i].setMap(null);
    }

    // Reset the markers array
    markers = [];

    // Call set markers to re-add markers
    setMarkers(masters);

  }

  function initialize() {

    var center = {lat: 56.9428967, lng: 24.2437765};

    if (jQuery(window).width() < 767) {
      var mapOptions = {
        zoom: 6,
      	center: center,
      	disableDefaultUI: true,
      	scrollwheel: false,
      	streetViewControl: true,
        zoomControl: true,
      }
    }
    else {
      var mapOptions = {
        zoom: 8,
      	center: center,
      	disableDefaultUI: true,
      	scrollwheel: false,
      	streetViewControl: true,
        zoomControl: true,
      }
    }

    map = new google.maps.Map(document.getElementById('farmersmap-canvas'), mapOptions);

    setMarkers(farmers);

    // Bind event listener on button to reload markers
    document.getElementById('reloadFarmersMarkers').addEventListener('click', reloadFarmersMarkers);

    document.getElementById('reloadMastersMarkers').addEventListener('click', reloadMastersMarkers);

  }

  initialize();

}


function contactsmap() {

  var map;
  var markers = []; // Create a marker array to hold your markers
  var home = [
    ['Svaigi HQ', 56.9400374, 24.0568313, 1]
  ];

  function setMarkers(locations) {

    var markerIcon = {
      url: 'img/icon-svaigi-1.svg',
      scale: 1,
      width: 45,
      height: 45,
      // anchor: new google.maps.Point(12, 24),
      optimized: false,
      zIndex: 99999999
    };

    for (var i = 0; i < locations.length; i++) {
      var shop = locations[i];
      var myLatLng = new google.maps.LatLng(shop[1], shop[2]);
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        animation: google.maps.Animation.DROP,
        title: shop[0],
        zIndex: shop[3],
        icon: markerIcon
      });

      // Push marker to markers array
      markers.push(marker);
    }

  }

  function initialize() {

    var center = {lat: 56.9400374, lng: 24.0568313};

    if (jQuery(window).width() < 767) {
      var mapOptions = {
        zoom: 17,
      	center: center,
      	disableDefaultUI: true,
      	scrollwheel: false,
      	streetViewControl: true,
        zoomControl: true,
      }
    }
    else {
      var mapOptions = {
        zoom: 17,
      	center: center,
      	disableDefaultUI: true,
      	scrollwheel: false,
      	streetViewControl: true,
        zoomControl: true,
      }
    }

    map = new google.maps.Map(document.getElementById('contactsmap-canvas'), mapOptions);

    setMarkers(home);

  }

  initialize();

}


jQuery('.sv-tabs .tab').click(function (e) {
  e.preventDefault()
  jQuery(this).tab('show')
})


jQuery('.sv-category-title-banner .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-category-title-banner .bg-parallax').addClass('has-loaded');
});

jQuery('.sv-page-title-banner .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-page-title-banner .bg-parallax').addClass('has-loaded');
});

jQuery('.sv-image-banner .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-image-banner .item').addClass('has-loaded');
});

jQuery('.content-sv-newsletter .image').imagesLoaded( { background: true }, function() {
  jQuery('.content-sv-newsletter form').addClass('has-loaded');
});

jQuery('.sv-steps .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-steps .bg-parallax').addClass('has-loaded');
});

jQuery('.sv-blog-list .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-blog-list .item').addClass('has-loaded');
});

jQuery('.sv-blog-list-slider .image').imagesLoaded( { background: true }, function() {
  jQuery('.sv-blog-list-slider .item').addClass('has-loaded');
});


function mobilemenuscroll() {

  var container = jQuery('.sv-menu-mobile .content');
  var content = jQuery('.sv-menu-mobile .content').height();
  var total_height = 0;
  jQuery('.sv-menu-mobile .content ul').each(function(){
    total_height += jQuery(this).outerHeight(true);
  });

  if (total_height > content) {
    jQuery(container).css('justify-content', 'flex-start');
  }

  else {
    jQuery(container).css('justify-content', 'center');
  }

}
