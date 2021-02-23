import * as $ from "jquery";

$(document).ready(() => {
  $(".offer-list").slick({
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000
  });
  $(".categories")
    .not(".slack-initialized")
    .slick({
      dots: true,
      autoplay: true,
      centerMode: true,
      slidesToShow: 3,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            dots: false,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 768,
          settings: {
            dots: false,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
});
