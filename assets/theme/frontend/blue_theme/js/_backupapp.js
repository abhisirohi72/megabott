(function () {
  ("use strict");

  AOS.init({
    duration: 1250, 
    easing: 'ease-in-out',
    once: true 
  });
  // HTML Root Element
  const rootHtml = document.firstElementChild;
  let windowWidth = window.innerWidth;

  const header = document.querySelector(".header");
  if (header) {
    const checkScroll = () => {
      if (window.scrollY > 40) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    };

    window.addEventListener("scroll", checkScroll);

    window.addEventListener("load", checkScroll);
  }


  $('.sidebar-btn').on("click", function () {
      alert("b3ab3a");
    $('.main-nav').addClass('show-menu');
});

$('.menu-close-btn').on("click", function () {
    $('.main-nav').removeClass('show-menu');
});

// mobile-drop-down

$(".main-nav").on('click', function (event) {
    alert("b3a3b3ab3");
    var $fl = $(this);
    $(this).parent().siblings().find('.sub-menu').slideUp();
    $(this).parent().siblings().find('.bi').addClass('bi-chevron-down');
    if ($fl.hasClass('bi-chevron-down')) {
        $fl.removeClass('bi-chevron-down').addClass('bi-chevron-up');
    } else {
        $fl.removeClass('bi-chevron-up').addClass('bi-chevron-down');
    }
    $fl.next(".sub-menu").slideToggle();
});

  // Review slider
  const reviewSlider = document.querySelector(".review-slider");
  if (reviewSlider) {
    new Swiper(".review-slider", {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".review-next",
        prevEl: ".review-prev",
      },

      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 2,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  }

  // Blog slider

  const blogSlider = document.querySelector(".blog-slider");
  if (blogSlider) {
    new Swiper(blogSlider, {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".button-next",
        prevEl: ".button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 2,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  }

  const swiper = new Swiper('.providers-slider', {
    slidesPerView: 2,
    spaceBetween: 20,
    autoplay: {
      delay: 0, 
    },
    loop: true,
    speed: 4000,
    breakpoints: {
      375: {
        slidesPerView: 3,
        spaceBetween: 20
      },
      640: {
        slidesPerView: 4,
        spaceBetween: 20
      },
      768: {
        slidesPerView: 5,
        spaceBetween: 30
      },
      // when window width is >= 1024px
      1024: {
        slidesPerView: 6,
        spaceBetween: 40
      },
      // when window width is >= 1200px
      1200: {
        slidesPerView: 8,
        spaceBetween: 50
      }
    }
  });

  
})();
