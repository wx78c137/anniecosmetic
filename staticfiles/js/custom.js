$(document).ready(function() {
  $('.sub-banner-slider').owlCarousel({
    loop: false,
    margin: 20,
    nav: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    dots: false,
    autoplay: false,
    smartSpeed: 700,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 3
      },
    },
  });

  $(".nav-product.saleoff .tab-link").on("click", function() {
    $(".tab-contain.saleoff .tab-panel").hide();
    $($(this).data("target")).show();
    $(".nav-product.saleoff .tab-link").removeClass("selected");
    $(this).addClass("selected");
  });


  $("#singleForm").validate({
    ignore: '',
    rules: {
      version_id: {
        required: true
      }
    },
    messages: {
      version_id: {
        required: "Vui lòng chọn màu sắc."
      }
    },
  });
});



$(document).ready(function() {
  $('#bannerSlider').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    dots: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    autoplaySpeed: 1000,
    animateOut: 'fadeOut',
    smartSpeed: 1000,
    fluidSpeed: 1000,
  })
});
$(document).ready(function() {
  var height = 400;
  // TODO: Nếu là màn hình lớn thì lấy chiều dài / 2 || 400
  if ($(window).width() > 768) {
    height = $(window).width() / 2 > 400 ? 400 : $(window).width() / 2;
  } else { // Nếu là mobile thì lấy chiều cao / 2
    height = $(window).height() / 2;
  }

  if ($('.block-single-content-body').length > 0) {
    // TODO: Nếu height của body lớn hơn height cho phép thì ẩn bớt và hiện read more
    if ($('.block-single-content-body').height() > height) {
      $('.block-single-content-body').height(height)
      $('.block-single-content .show-more').show()
    }
  }
  if ($('.block-single-property-body').length > 0) {
    // TODO: Nếu height của body lớn hơn height cho phép thì ẩn bớt và hiện read more
    if ($('.block-single-property-body').height() > height) {
      $('.block-single-property-body').height(height)
      $('.block-single-property .show-more').show()
    }
  }
})

function readmore(elementClass) {
  $('.' + elementClass).height('auto');
  $('.' + elementClass).parent().find('.show-more').hide()
}

// Xzoom Slider
$(document).ready(function() {
  $(".xzoom, .xzoom-gallery").xzoom({
    tint: '#333',
    Xoffset: 15
  });
});
$(document).ready(function() {
  $(window).scroll(function() {
    if ($(window).scrollTop() >= $("#nav-target").offset().top - 5)
      $("nav#navigation").addClass("fixed");
    else
      $("nav#navigation").removeClass("fixed");
  });
});
