$(document).on('click', '.js-add-to-cart', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');
    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/cart/request',
        data: {id:id},
        success: function (response) {
            console.log(response);
            $('.js-backet-price').text(response.cost);
            $('.js-backet-count').text(response.cart_count);
            $('#success_add').modal();
            /*  $('#modal_success').modal('toggle');*/
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});
$(document).on('click', '.js-add-to-cart-product', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');
    var count = $('.number_input').val();
    console.log(id,count);
    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/cart/request-product',
        data: {id:id,count:count},
        success: function (response) {
            console.log(response);
            $('.js-backet-price').text(response.cost);
            $('.js-backet-count').text(response.cart_count);
            $('#success_add').modal();
            /*  $('#modal_success').modal('toggle');*/
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});
$("form#send-mas").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'cart/save-order',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
               location.href = response.url;
            }
            else {
                $('.js-text').text(response);
            }

        },
        error: function (data) {
        }
    });
});
$(document).on('click', '.js-balance', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');

    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/add-comparison',
        data: {id:id},
        success: function (response) {
            console.log(response);
            $('.js-backet-price').text(response.cost);
            $('.js-backet-count').text(response.cart_count);
            $('#success_add').modal();
            /*  $('#modal_success').modal('toggle');*/
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});

$(document).on('click', '.js-favorite', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');

    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/favorite/add',
        data: {id:id},
        success: function (response) {
            console.log(response);

            /*  $('#modal_success').modal('toggle');*/
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});
$(document).on('click', '.js-delete-favorite', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');

    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/favorite/delete',
        data: {id:id},
        success: function (response) {
            console.log(response);
            $('.blocks-fore-items').html(response);
            /*  $('#modal_success').modal('toggle');*/
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});

$(document).on('click', '.js-delete-comparasion', function(e){
    e.preventDefault();
    var id = $(e.currentTarget).data('id');

    $.ajax({
        type: "post",
        dataType: 'json',
        url: '/delete-comparison',
        data: {id:id},
        success: function (response) {
           location.href = response.url;
        },
        error: function (jqXhr) {
            console.log("РћС€РёР±РєР°: " + jqXhr.statusText + " (" + jqXhr.readyState + ", " + jqXhr.status + ", " + jqXhr.responseText + ")");
        }

    })


});

$("form.form-registration").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'auth/sign-up',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                location.href = response.url;
            }
            else {
                $('.js-text').text(response);
            }

        },
        error: function (data) {
        }
    });
});

$("form.form-sign").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'auth/sign-in',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                location.href = response.url;

            }
            else {
                $('.js-text').text(response);
            }

        },
        error: function (data) {
        }
    });
});
$("form.form-change").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/user/change-settings',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer==true)
            {
              //  location.href = response.url;
                $('.js-change-settings').text(response.text);
                setTimeout("$('.js-change-settings').text('')", 3000);

            }
            else {
                $('.js-change-settings').text(response.text);
                setTimeout("$('.js-change-settings').text('')", 3000);
            }

        },
        error: function (data) {
        }
    });
});


$("form#call-back").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/form/callback',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                $('#call-back').trigger("reset");
                $('.js-text-call').text('Успешно');
            }
            else {
                $('.js-text-call').text(response);
            }

        },
        error: function (data) {
        }
    });
});

$("#write-to-us").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/form/feedback',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                $('#write-to-us').trigger("reset");
                $('.js-text-write').text('Успешно');
            }
            else {
                $('.js-text-write').text(response);
            }

        },
        error: function (data) {
        }
    });
});
$("#subscription").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/form/subscription',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                $('#subscription').trigger("reset");
                $('.js-text-subscription').text('Успешно');
                setTimeout("$('.js-text-subscription').text('')", 3000);
            }
            else {
                $('.js-text-subscription').text(response);
                setTimeout("$('.js-text-subscription').text('')", 3000);
            }

        },
        error: function (data) {
        }
    });
});

$("#new-news").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/save-new-feedback',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                $('#new-news').trigger("reset");
                $(".overlay").fadeIn(400, function () {
                    $(".modal_form_comment").css("display", "block").animate({opacity: 1, top: "50%"}, 200)
                });
            }
            else {

            }

        },
        error: function (data) {
        }
    });
});

$("#save-new-product-feedback").on('submit',function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/save-new-product-feedback',
        data: $( this ).serialize(),
        success: function (response) {
            if (response.answer=='success')
            {
                $('#save-new-product-feedback').trigger("reset");
                $(".overlay").fadeIn(400, function () {
                    $(".modal_form_comment").css("display", "block").animate({opacity: 1, top: "50%"}, 200)
                });
            }
            else {

            }

        },
        error: function (data) {
        }
    });
});