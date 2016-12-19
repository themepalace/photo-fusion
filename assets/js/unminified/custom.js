( function( $ ) {
    $(window).load(function(){


/*------------------------------------------------
                SIDR MENU
------------------------------------------------*/

$('#sidr-left-top-button').sidr({
    name: 'sidr-left-top',
    timing: 'ease-in-out',
    speed: 500,
    side: 'left',
    source: '.left'
});
$('#sidr-left-top-button .genericon').click(function(){
    $('body','html').css({'overflow-x': 'visible'});
});

/*------------------------------------------------
                END SIDR MENU
------------------------------------------------*/

/*------------------------------------------------
                MENU ACTIVE
------------------------------------------------*/

$('.main-navigation ul li').click(function(){
    $('.main-navigation ul li').removeClass('current-menu-item');
    $(this).addClass('current-menu-item');
});

/*------------------------------------------------
                END MENU ACTIVE
------------------------------------------------*/

/*------------------------------------------------
                STICKY HEADER
------------------------------------------------*/

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll > 1) {
        $(".make-sticky").addClass("is-sticky");
    }
    else {
        $(".make-sticky").removeClass("is-sticky");
    }
});
/*------------------------------------------------
                END STICKY HEADER
------------------------------------------------*/

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
    $('.backtotop').css({bottom:"25px"});
    } else {
    $('.backtotop').css({bottom:"-100px"});
    }
    });
    $('.backtotop').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});
/*------------------------------------------------
                END BACK TO TOP
------------------------------------------------*/

/*------------------------------------------------
                BUTTON EFFECTS
------------------------------------------------*/

$('.btn-js').each( function() {
  var btnText = $(this).html();
  $(this).append( '<span class="btn-show"><span class="btn-text">' + btnText + '</span></span>\
                 <span class="btn-hide"><span class="btn-text">' + btnText + '</span></span>' );
});

/*------------------------------------------------
                END BUTTON EFFECTS
------------------------------------------------*/

$('.sharedaddy ul').addClass('social-icons');


/*------------------------------------------------
                GALLERY
------------------------------------------------*/

// init Masonry
var $grid = $('.grid').masonry({
  // options...
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});

    $('.grid').masonry({
  // set itemSelector so .grid-sizer is not used in layout
  itemSelector: '.grid-item',
  // use element for option
  columnWidth: '.grid-sizer',
  percentPosition: true
})

var $grid = $('.grid').imagesLoaded( function() {
  // init Masonry after all images have loaded
  $grid.masonry({
    // options...
  });
});

/*------------------------------------------------
                END GALLERY
------------------------------------------------*/

/*------------------------------------------------
                PORTFOLIO
------------------------------------------------*/

(function ($) {
var $container = $('.tp-portfolio'),
    colWidth = function () {
        var w = $container.width(),
            columnNum = 1,
            columnWidth = 0;
        if (w > 1200) {
            columnNum  = 4;
        }
        else if (w > 900) {
            columnNum  = 3;
        }
        else if (w > 500) {
            columnNum  = 2;
        }
        else if (w > 300) {
            columnNum  = 1;
        }
        columnWidth = Math.floor(w/columnNum);
        $container.find('.box').each(function() {
            var $item = $(this),
                multiplier_w = $item.attr('class').match(/item-w(\d)/),
                multiplier_h = $item.attr('class').match(/item-h(\d)/),
                width = multiplier_w ? columnWidth*multiplier_w[1]-0 : columnWidth-5,
                height = multiplier_h ? columnWidth*multiplier_h[1]*1-5 : columnWidth*0.5-3;
            $item.css({
                width: width,
                height: height
            });
        });
        return columnWidth;
    }
    function refreshWaypoints() {
        setTimeout(function() {
        }, 3000);
    }
    $('nav.portfolio-filter ul a').on('click', function() {
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector }, refreshWaypoints());
        $('nav.portfolio-filter ul a').removeClass('active');
        $(this).addClass('active');
        return false;
    });
    function setPortfolio() {
        setColumns();
        $container.isotope('reLayout', true);
    }
    $container.imagesLoaded( function() {
        $container.isotope();
    });
    isotope = function () {
        $container.isotope({
            resizable: true,
            itemSelector: '.box',
            layoutMode : 'masonry',
            transformsEnabled: false,
            gutter: 20,
            masonry: {
                columnWidth: colWidth(),
                gutterWidth: 0
            }
        });
    };
isotope();

/*$(window).smartresize(isotope);*/
}(jQuery));

/*------------------------------------------------
                END PORTFOLIO
------------------------------------------------*/

/*------------------------------------------------
                Wp Gallery Popup
------------------------------------------------*/

$('.gallery .gallery-item .gallery-icon a').attr('data-lightbox', 'masonry');
$('.page form input[type="submit"]').addClass('btn fill btn-js btn-contact');

});

/*------------------------------------------------
            END LOAD FUNCTION
------------------------------------------------*/

}) ( jQuery );
/*------------------------------------------------
            END JQUERY
------------------------------------------------*/