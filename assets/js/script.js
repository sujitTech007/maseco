$('.mobile-nav-toggle').click(function(){
  $('.navigation').toggleClass('open')
})

 /*==================================================
        [ Sticky Header ]
        ==================================================*/
       
      
            $(window).scroll(function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > 300) {
                    $('.headerNav').addClass('header-sticky');
                } else {
                    $('.headerNav').removeClass('header-sticky');
                }
            });
      
        


$(document).ready(function(){

  $(".slider-items").slick({
    autoplay: false,
    arrows: true,
    dots: true,
    prevArrow:
      '<div class="slick-nav prev-arrow"><i class="icon-left-arrow-thin"></i></div>',
    nextArrow:
      '<div class="slick-nav next-arrow"><i class="icon-right-arrow-thin"></i></div>',
    slidesToShow: 1,
    cssEase: "linear",
    responsive: [      
      {
        breakpoint: 900,
        settings: {
          arrows: false,
        }
      },
      
      
    ]
  });

$('.testimonial-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
    dots: true,
    adaptiveHeight: false,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1
            }
        }
    ]
});




  $('.blogs-slider').slick({
    dots: true,
    infinite: false,
    arrows: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [      
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      
      
    ]
  });


  
$('.circle-progress-bar').each(function() {
  var number = $(this).data('skill-level');
  var empty_color = $(this).data('empty-color');
  var fill_color = $(this).data('fill-color');
  var size = $(this).data('size');
  var thickness = $(this).data('thickness');
  $(this).circleProgress({
      value: '0.' + number,
      size: size,
      emptyFill: empty_color,
      fill: {
          color: fill_color
      }
  }).on('circle-animation-progress', function(event, progress) {
      $(this).find('.progress-count').html(Math.round(number * progress) + '%');
  });
});


  $('#back-to-top').fadeOut();
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 250) {
            $('#back-to-top').fadeIn(1400);
        } else {
            $('#back-to-top').fadeOut(400);
        }
    });
    $('#top').on('click', function () {
        $('top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 100);
        return false;
    });

  
});






(function($){
  $.fn.accordion = function(speed){
    this.on('click', '.filterTitle', function(e){
      e.preventDefault();
      $(this)
          
          .next('.accordionFilter-panel')
          .not(':animated')
          .slideToggle(speed);
    });
    return $(this);
    
  }
  $('.filterTitle').click(function(){
    $(this).toggleClass('active');
});
})($);

$('.accordionFilter').accordion(250).fadeIn();



    /*==================================================
    [ Back To Top ]
    ==================================================*/
  