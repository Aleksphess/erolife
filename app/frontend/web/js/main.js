// owl-carouseles
$(document).ready(function() {
    var owl = $('.week.owl-carousel');
    owl.owlCarousel({
        margin: 10,
        dots: false,
        nav: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },

            700: {
                items: 2
            },

            900: {
                items: 4
            }
        }
    })
});

jQuery(document).ready(function($) {
    $('.fadeOut.owl-carousel.owl-theme').owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        dots: true,
        loop: true,
        touchDrag: true,
        rewind: true,
        speed:1000,
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 10
    });
});

$(document).ready(function() {
    var owl = $('.two-items.owl-carousel');
    owl.owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            980: {
                items: 2
            }
        },
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: true,
        dots: false
    });
});


// Catalog
$(document).ready(function() {
    $('.popup').click( function(event){
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function(){
                $('#modal_form')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '0'}, 500);
            });
    });

    $('#modal_close, #overlay').click( function(){
        $('#modal_form')
            .animate({opacity: 0, top: '0'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });
});

//call
$(document).ready(function() {
    $('.call-back').click( function(event){
        event.preventDefault();
        $('.overlay').fadeIn(400,
            function(){
                $('.modal_form')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('.modal_close, .overlay').click( function(){
        $('.modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('.overlay').fadeOut(400);
                }
            );
    });

    $('.write-to-us').click( function(event){
        event.preventDefault();
        $('.overlay').fadeIn(400,
            function(){
                $('.modal_form-2')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('.modal_close, .overlay').click( function(){
        $('.modal_form-2')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('.overlay').fadeOut(400);
                }
            );
    });
});


// function Registration () {
//     var forms = document.getElementById('good');
//     var but = document.getElementsByClassName('next');
//     but.addEventListener('click', function () {
//         forms.style.display = 'block';
//     });
// }



//tabs in personal account
function openProduct(productName) {
    var i;
    var x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(productName).style.display = "block";
}


// active tabs
$(document).ready(function(){
    $('.w3-bar-item').click(function() {
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    $('.category__subcategory li a').click(function() {
        $('.active').removeClass('active');
        $(this).addClass('active');
    });
});


//count in basket
// $(document).ready(function() {
//     $('.minus').click(function () {
//         var $input = $(this).parent().find('input');
//         var count = parseInt($input.val()) - 1;
//         count = count < 1 ? 1 : count;
//         $input.val(count);
//         $input.change();
//         return false;
//     });
//
//     $('.plus').click(function () {
//         var $input = $(this).parent().find('input');
//         $input.val(parseInt($input.val()) + 1);
//         $input.change();
//         return false;
//     });
// });


//count in basket
$(document).ready(function() {
    $('.minus').click(function (e) {
        var id = $(e.currentTarget).data('id');
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '/cart/change-count',
            data: {id:id,count:count},
            success: function (response) {
                $('.js-change').html(response);
            },
            error: function (jqXhr) {
                console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
            }

        })
    });

    $('.plus').click(function (e) {
        var id = $(e.currentTarget).data('id');
        console.log(id);
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) + 1;
        $input.val(count);
        $input.change();
        $.ajax({
            type: "post",
            dataType: 'json',
            url: '/cart/change-count',
            data: {id:id,count:count},
            success: function (response) {
                $('.js-change').html(response);
            },
            error: function (jqXhr) {
                console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
            }

        })
    });

});



//gallery in product-item
$('.large img').attr('src', $('.mini img:first').attr('data-large'));
$('.mini img:first').addClass('active');

$('.mini img').click(function() {
    var $large = $(this).attr('data-large');
    $('.mini img').removeClass('active');
    $('.large').hide();
    $('.large img').attr('src', $large);
    $('.large').fadeIn();
    $(this).addClass('active');
});


//height blocks compare
$(document).ready(function(){
    $('.compare').each(function(){
        var highestBox = 0;
        $('.my-height ', this).each(function(){
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        $('.my-height ',this).height(highestBox);
    });
});



/*
$('.close').click(function(){
    $('.blocks-fore-items__item').hide(1000);
});
*/


// adaptive menu
$('.adaptive-menu__open-menu').click(function(){
    $('.adaptive-menu__full-menu').slideDown();
});
$('.adaptive-menu__close-menu').click(function(){
    $('.adaptive-menu__full-menu').hide();
});
//spoiler
$(document).on('click', '.spoiler-trigger', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $(this).parent().find('.spoiler-block').first().slideToggle(300);
});







