let token = $('meta[name="csrf-token"]').attr('content');
var spSoldStockShop = 'calzado-domiman';
$html = $('html');
$document = $(document);
window.spSalePopupSetting = JSON.parse('{"time":5,"delay":5,"perPage":10,"repeat":true,"sales":"custom","display":"mobile-desktop","position":"bottom-left","heading":"Compraron","color":"#55586c"}');



if ($document.find('.sold_sale_popup').length)
    spSalePoupInit();


toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-full-width",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$(document).ready(function () {

    // setTimeout(function () {
    //     showSalespopup();
    // }, salePopupTime * 1000);


    $body = $('body');
    $html = $('html');
    $document = $(document);

    $('[data-toggle="search"]').on('click', function () {
        $('.search-area-wrapper').show();
        $('.search-area-input').focus();
    });

    // ------------------------------------------------------- //
    //   Circle Slider
    // ------------------------------------------------------ //
    var circleSlider = $('.circle-slider');
    circleSlider.on({
        'initialized.owl.carousel': function () {
            // we add ..mh-full-screen to the parent section to avoid items below the carousel jumping before the carousel loads
            circleSlider.parents('section').removeClass('mh-full-screen');
        }
    }).owlCarousel({
        loop: true,
        margin: 0,
        smartSpeed: 500,
        responsiveClass: true,
        navText: ['<img src="' + basePath + 'img/prev-dark.svg" alt="" width="50">', '<img src="' + basePath + 'img/next-dark.svg" alt="" width="50">'],
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true
            },
            600: {
                items: 1,
                nav: false,
                dots: true
            },
            1120: {
                items: 1,
                dots: false,
                nav: true
            }
        },
        onRefresh: function () {
            circleSlider.find('.item').height('');
        },
        onRefreshed: function () {
            var maxHeight = 0;
            var items = circleSlider.find('.item');
            items.each(function () {
                var itemHeight = $(this).outerHeight();
                if (itemHeight > maxHeight) {
                    maxHeight = itemHeight;
                }
            });
            items.height(maxHeight);
        }
    });
    $('.search-area-wrapper .close-btn').on('click', function () {
        $('.search-area-wrapper').hide();
    });
    $(".detail-option .checkbox-radio").change(function () {
        $(this).closest(".detail-option").find(".option").removeClass("active");
        if ($(this).is(':checked')) {
            $(this).closest(".option").addClass("active");
        } else {
            $(this).closest(".option").removeClass("active");
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#departamento").on("change", function () {
        var iddepa = $(this).val();
        if (iddepa != "none") {
            $("#provincia").html('');
            $("#distrito").html('');
            getPrecioDeEnvio(iddepa);
            $.ajax({
                url: '/ajax_get_provincias',
                data: {
                    iddepa: iddepa,
                    _token: token,
                },
                dataType: 'json',
                success: function (ret) {
                    $("#provincia").append('<option value="">[Seleccionar]</option>');
                    for (i = 0; i < ret.length; i++) {
                        var itemx = ret[i];
                        $("#provincia").append('<option value="' + itemx.codprov + '" data-depa="' + itemx.coddep + '">' + itemx.nmbubigeo + '</option>');
                    }
                }
            });
        }
    });
    $("#provincia").on("change", function () {
        var e = document.getElementById("provincia");
        var idprov = e.options[e.selectedIndex].value;
        if (idprov != "none") {
            $("#distrito").html('');
            $.ajax({
                url: '/ajax_get_distritos',
                data: {
                    idprov: idprov,
                    iddepa: $('option:selected', this).attr('data-depa'),
                    _token: token,
                },
                dataType: 'json',
                success: function (ret) {
                    $("#distrito").append('<option value="">[Seleccionar]</option>');
                    for (i = 0; i < ret.length; i++) {
                        var itemx = ret[i];
                        $("#distrito").append('<option value="' + itemx.coddist + '" data-ubigeo="' + itemx.codubigeo + '">' + itemx.nmbubigeo + '</option>');
                    }
                }
            });
        }
    });

    $(".updateCantidad").click(function () {
        var $this = $(this);
        var data = {}
        data.status = $this.attr('data-status');
        data.id = $this.attr('data-id');
        $.ajax({
            url: "/carrito/actualizar-cantidad-producto",
            method: "post",
            dataType: 'json',
            data: data,
            beforeSend: function () {
                $(".spinner").show();
                $(".cart-item").hide()
            },
            success: function (response) {
                if (response.status) {
                    window.location.reload();
                } else {
                    swal(response.msg, {
                        icon: "warning",
                    });
                }
            },
            error: function () {
                toastr.warning('Se presentaron problemas, inténtelo más tarde')
            }
        });
    })


    $(".add-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var status = ele.attr("data-list");
        if (status)
            status = true
        else
            status = false

        let talla = $('input[name="talla"]:checked').val();
        if (talla == null) {
            toastr.warning('Debes seleccionar una talla');
            $("#talla").focus()
            return
        }
        let color = $('input[name="color"]:checked').val();
        if ($("input[name='color']:checked").val() == undefined) {
            toastr.warning('Debes seleccionar un color');
            return
        }
        if ($("#unidades").val() == 0) {
            // toastr.warning('Debes seleccionar un color');
            $("#unidades").focus()
            return
        }

        $.ajax({
            url: "/carrito/agregar-producto",
            method: "post",
            // dataType: 'json',
            data: {
                _token: token,
                id: ele.attr("data-id"),
                talla: talla,
                color: color,
                unidades: $("#unidades").val(),
            },
            beforeSend: function () {
                spinnerSend(ele, 'Agregando ...', true, status);
            },
            success: function (response) {
                // if (response.status) {
                        swal( (response.msg === undefined) ? 'Producto agregado correctamente' : response.msg, {
                            icon: (response.status == false) ? "warning" : "success",
                        });
                    
                    // var productos = response.cart;
                    if(response.status !== false)
                        $("#listCartheader").html(response);
                    // $("#listCart").append(listProductCart(productos));
                    // $("#cantidad").text(response.cantidad);
                    // $("#totalCart").text(response.total);
                // } else {
                //     swal(response.msg, {
                //         icon: "warning",
                //     });
                // }
                spinnerSend(ele, 'Agregar al carrito', false, status);
            },
            error: function () {
                spinnerSend(ele, 'Agregar al carrito', false, status);
                toastr.warning('Se presentaron problemas, inténtelo más tarde')
            }
        });
    });


    $(".cart-remove.quitarProducto").click(function () {
        var ele = $(this);
        $.ajax({
            url: "/carrito/quitar-producto",
            method: "post",
            dataType: 'json',
            data: {
                _token: token,
                id: ele.attr("data-id"),
            },
            success: function (response) {
                if (response.status) {
                    swal(response.msg, {
                        icon: "success",
                    }).then((willDelete) => {
                        window.location.reload();
                    });
                } else {
                    swal(response.msg, {
                        icon: "warning",
                    });
                }
            },
            error: function () {
                // spinnerSend(ele, 'Agregar al carrito', false, status);
                // toastr.warning('Se presentaron problemas, inténtelo más tarde')
            }
        });
    });
    $("#listCart").on('click', '.quitarProducto', function () {
        var ele = $(this);
        $.ajax({
            url: "/carrito/quitar-producto",
            method: "post",
            dataType: 'json',
            data: {
                _token: token,
                id: ele.attr("data-id"),
            },
            success: function (response) {
                if (response.status) {
                    swal(response.msg, {
                        icon: "success",
                    }).then((willDelete) => {
                        window.location.reload();
                    });
                } else {
                    swal(response.msg, {
                        icon: "warning",
                    });
                }
                $("#list_" + ele.attr("data-id")).remove();
            },
            error: function () {
                // spinnerSend(ele, 'Agregar al carrito', false, status);
                // toastr.warning('Se presentaron problemas, inténtelo más tarde')
            }
        });
    });

    function listProductCart(item) {
        let plantilla = `<div class="navbar-cart-product" id="list_${item.id}">
                <div class="d-flex align-items-center">
                    <a href="/detail-1">
                        <img class="img-fluid navbar-cart-product-image"
                             src="${item.attributes.fotos.urlCompleta}"></a>
                    <div class="w-100">
                        <a class="close text-sm mr-2 quitarProducto" data-id="${item.id}" href="javascript:void(0)">
                            <i class="icofont-close-line"></i>
                        </a>
                        <div class="pl-3">
                            <a class="navbar-cart-product-link" href="/detail-1">${item.name}</a>
                            <small class="d-block text-muted">Unidades: ${item.quantity}</small><strong class="d-block text-sm">S/. ${intlRound(item.price)}</strong></div>
                    </div>
                </div>
            </div>`;
        return plantilla;
    }

    function intlRound(num, decimals = 2) {
        return (num).toFixed(decimals);
    }

    function spinnerSend(content, text, estado = true, status = false) {
        var $ele = content;
        var plantilla;
        if (estado) {
            plantilla = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  ${(status == false) ? text : ''}`;
            $ele.text('').addClass('disabled').attr('disabled', 'disabled').append(plantilla);
        } else {
            plantilla = `<i class="icofont-ui-cart icofont-lg"></i> ${(status == false) ? text : ''}`;
            $ele.removeClass('disabled').attr('disabled', false).html(plantilla);
        }
    }

    var mySwiper = new Swiper('.swiper-container', {
        init: !0,
        direction: 'horizontal',
        slideDuplicateClass: 'swiper-slide-duplicate',
        slideDuplicatePrevClass: 'swiper-slide-duplicate-prev',
        slideNextClass: 'swiper-slide-duplicate-prev'
    })

    
    $('.detail-full').owlCarousel({
        loop: true,
        items: 1,
        dots: true,
        responsiveClass: false
    });

    $(".swiper-thumbnails").on('click', 'button', function () {
        mySwiper.slideTo($(this).index(), 500);
        $(this).addClass('active')
    });

})
$(document).scroll(function () {
    if ($(this).scrollTop() >= 140) {
        $("header nav").addClass("nav-fixed fixed-top");
        $("body").addClass("body-fixed");
        $('#search').hide();
    } else {
        $('.description-fixed').hide();
        $("header nav").removeClass("nav-fixed fixed-top");
        $("body").removeClass("body-fixed");
        $('#search').show();
    }
});
$('.login-facebook').click(function () {
    FB.getLoginStatus(function (response) {
        console.log(response)
        // statusChangeCallback(response);
    });
});

// $(".search #btn_search").click(function(){
// 	criteria = $.trim($("#search #txt_search").val());
// 	$(location).attr("href","http://www.ondacero.com.pe/buscar/"+criteria);
// });

$(".search #txt_search").keypress(function(e){
	if (e.keyCode == 13){
        console.log(this)
		// criteria = $.trim($("#search #txt_search").val());
		// $(location).attr("href","http://www.ondacero.com.pe/buscar/"+criteria);
	}
});

function spSalePoupInit() {
    if (!window.spSalePopupSetting)
        return false;

    var closeTimeout;
    var salePopupIndex = 0;
    var salePopupTime = spSalePopupSetting.time;
    var salePopupDelay = spSalePopupSetting.delay;
    var salePopupPerPage = spSalePopupSetting.perPage;
    var salePopupRepeat = spSalePopupSetting.repeat;
    var salePopupSales = spSalePopupSetting.sales;
    var salePopupHeading = spSalePopupSetting.heading;
    var salePopupDisplay = spSalePopupSetting.display;
    var salePopupPosition = spSalePopupSetting.position;
    var salePopupColor = spSalePopupSetting.color;

    if (salePopupDisplay == 'disable')
        return;

    $.get('/api/filter?a=popup-products&s=' + spSoldStockShop, function (response) {
        if (typeof response == 'undefined')
            return;

        if (response == '')
            return;

        if (!response.length)
            return;

        if (parseInt(salePopupPerPage) <= 0)
            return;

        setTimeout(function () {
            showSalespopup();
        }, salePopupTime * 1000);

        $('#salsepop_close').on('click', function () {
            clearTimeout(closeTimeout);
            $('.sold_sale_popup').removeClass('sold_sale_show');
            if ((parseInt(salePopupIndex) + 1) <= salePopupPerPage) {
                if (typeof response[salePopupIndex] == 'undefined') {
                    if (salePopupRepeat !== true)
                        return;
                    salePopupIndex = 0;
                }
                setTimeout(function () {
                    showSalespopup();
                }, salePopupDelay * 1000);
            }
        });

        function showSalespopup() {

            $('.sold_sale_popup').removeClass('sold_sale_popup_tl sold_sale_popup_tr sold_sale_popup_bl sold_sale_popup_br sold_sale_show');
            var productData = response[salePopupIndex];
            $('.sold_sale_popup .sold_sale_product_image img').attr('src', productData.image[0].urlCompleta);
            $('.sold_sale_popup .noti-body a').text(productData.title);
            $('.sold_sale_popup .noti-title span').text(salePopupHeading);
            $('.sold_sale_popup .noti-time').text(productData.date);
            $('.sold_sale_popup .noti-title span, .sold_sale_popup .noti-body a, .sold_sale_popup .noti-time').css({color: salePopupColor});

            if (salePopupPosition == 'top-left')
                $('.sold_sale_popup').addClass('sold_sale_popup_tl');
            else if (salePopupPosition == 'top-right')
                $('.sold_sale_popup').addClass('sold_sale_popup_tr');
            else if (salePopupPosition == 'bottom-left')
                $('.sold_sale_popup').addClass('sold_sale_popup_bl');
            else if (salePopupPosition == 'botom-right')
                $('.sold_sale_popup').addClass('sold_sale_popup_br');

            salePopupIndex++;
            $('.sold_sale_popup').addClass('sold_sale_show');

            closeTimeout = setTimeout(function () {
                clearTimeout(closeTimeout);
                $('.sold_sale_popup').removeClass('sold_sale_show');
                if ((parseInt(salePopupIndex) + 1) <= salePopupPerPage) {
                    if (typeof response[salePopupIndex] == 'undefined') {
                        if (salePopupRepeat !== true)
                            return;
                        salePopupIndex = 0;
                    }
                    setTimeout(function () {
                        showSalespopup();
                    }, salePopupDelay * 1000);
                }
            }, 5000);
        }
    });
}
