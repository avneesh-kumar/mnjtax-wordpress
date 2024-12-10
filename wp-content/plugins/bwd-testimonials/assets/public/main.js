

(function ($) {
  "use strict";
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/bwdtbtTestimonials.default",
      function(){



          function sliderAllWrapper(sliderItem){
            let sliderAttrs =sliderItem.querySelector('.bwdtbt-for-all-owlCarousel');
              let slider = sliderAttrs;
              let margin = null;
              let mobile = null;
              let tablet = null;
              let desktop = null;
              let autoplay = false;
              let loop = false;
              let autoplayHoverPause = false;
              let center= false;
              let autoplayTimeout = null;
              let autoplaySpeed = null;
              let stagePadding = null;
              let nav = false;
              let navText = null;
              let navType = '';
              let dots = false;
              let dotsType = '';


            const init = function() {

                margin = parseInt(slider.getAttribute('bwdtbt-data-margin'));
                desktop = parseInt(slider.getAttribute('bwdtbt-data-desktop'));

                tablet = parseInt(slider.getAttribute('bwdtbt-data-tablet'));

                mobile = parseInt(slider.getAttribute('bwdtbt-data-mobile'));

                autoplay = slider.getAttribute('bwdtbt-data-autoplay') === 'yes' ? true : false;

                loop = slider.getAttribute('bwdtbt-data-loop') === 'yes' ? true : false;

                autoplayHoverPause = slider.getAttribute('bwdtbt-data-hoverpause') === 'yes' ? true : false;

                center = slider.getAttribute('bwdtbt-data-centermode') === 'yes' ? true : false;

                autoplayTimeout = parseInt(slider.getAttribute('bwdtbt-data-timeout'));

                autoplaySpeed = parseInt(slider.getAttribute('bwdtbt-data-autospeed'));

                stagePadding = parseInt(slider.getAttribute('bwdtbt-data-stagepadding'));

                //nav-arrow
                nav = slider.getAttribute('bwdtbt-data-navigations') === 'yes' ? true : false;

                setTimeout( function() {

                  const sliderIdNew = sliderItem.getAttribute('id');
                  let myNewTest = document.querySelector(`#${sliderIdNew}`);
                  let myOwlNavNew = myNewTest.querySelector( '.bwdtbt-owl-nav' );

                  if( slider.getAttribute('bwdtbt-data-navigations') === 'yes' ) {
                    myOwlNavNew.classList.add('owlActive')
                  }

                }, 500)

                navType = slider.getAttribute('bwdtbt-data-navtype');
                
                if( navType === 'icon' ) {
                  navText = [
                    `<i class="${slider.getAttribute('bwdtbt-data-navprev')}"></i>`,
                    `<i class="${slider.getAttribute('bwdtbt-data-navnext')}"></i>`
                  ]
                } else {
                  navText = [
                    `<span>${slider.getAttribute('bwdtbt-data-navprev')}</span>`, 
                    `<span>${slider.getAttribute('bwdtbt-data-navnext')}</span>`
                  ]
                }

                //dots
                dots = slider.getAttribute('bwdtbt-data-dots') === 'yes' ? true : false;

                dotsType = slider.getAttribute('bwdtbt-data-dotstype');

                setTimeout( function() {

                  const sliderIdNew = sliderItem.getAttribute('id');
                  let myNewTest = document.querySelector(`#${sliderIdNew}`);
                let sliderDots = myNewTest.querySelector('.bwdtbt-owl-dots');
                let dotBtns = sliderDots.querySelectorAll('button');

                if( slider.getAttribute('bwdtbt-data-dots') === 'yes' ) {
                  sliderDots.classList.add('owlActive')
                }
                  
                if( dotsType == 'dots' ) {
                  sliderDots.classList.add('myActive');
                }else if( dotsType == 'numbers' ) {
                  sliderDots.classList.remove('myActive');
                  for(let i = 0; i <  dotBtns.length; i++){
                    dotBtns[i].innerHTML = `<span>${i + 1}</span>`;
                    }
                }
                }, 500)
          }
          init();

          const sliderId = sliderItem.getAttribute('id');
   
          $(`#${sliderId} .bwdtbt-owl.bwdtbt-owl-carousel`).owlCarouselBWDTBT({
            loop:loop,
            autoplay: autoplay,
            autoplayTimeout: autoplayTimeout,
            autoplaySpeed: autoplaySpeed,
            autoplayHoverPause: autoplayHoverPause,
            center: center,
            margin: margin,
            stagePadding: stagePadding,
            nav: nav,
            navText: [ navText[0], navText[1] ],
            dots: dots,
            responsive:{
              0:{
                items:mobile
              },
              768:{
                  items:tablet
              },
              992:{
                  items:desktop
              }
            }
          })

          }

          const allSliderItem = document.querySelectorAll('.bwdtbt-slider-common')
          for(let item of allSliderItem){
          sliderAllWrapper(item)
          }
          
      }
    );
  });
})(jQuery);








