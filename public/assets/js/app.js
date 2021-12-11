// $(document).load(function(){
//     LoadListOrden();
// })

// $('input[type=text]').val(function () {
//     return this.value.toUpperCase();
// })




if ($("body .editar-orden").length) {
    let idorden = $.trim($('#idorden').val());
    setTimeout(LoadListOrden(idorden), 4000);
}


function LoadListOrden(id) {
    $("#ListOrden").load("/admin/ListViewOrden?orden=" + id);
    $('#spinner').addClass('d-none');
    // $idem = $('#ListOrden .actualizar-producto').length;
}

$('#listColeccions').on('click', '.delete', function () {
    let $this = $(this);
    let data = {}
    data.id = $this.data('id');
    let list = $('#listSeleccionado_' + data.id);
    list.remove();
});


$('#fileGaleria_list, #fileadjunto_list').on('click', '.delete', function () {
    let data = {}
    let $this = $(this);
    data.name = $this.data('name');
    data.id = $this.data('id');
    data._token = $('meta[name="csrf-token"]').attr('content');
    let list = $('#fileGaleria_list #img_' + data.id + ',#fileadjunto_list #img_' + data.id);
    swal({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/eliminar-imagen',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                list.remove();
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });
});

$("#productos .eliminar").click(function () {
    let data = {};
    let $this = $(this)
    data.id = $(this).attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '/admin/eliminar-producto',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                location.reload();
                                // window.location.href = '/admin/todos-los-productos';
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });


});

$("#colecciones .eliminar").click(function () {
    let data = {};
    let $this = $(this)
    data.id = $(this).attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "¿Estás seguro de eliminar la colección?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '/admin/eliminar-coleccion',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                location.reload();
                                // window.location.href = '/admin/todos-los-productos';
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });
});

$("#categorias .delete").click(function () {
    let data = {};
    let $this = $(this)
    data.id = $(this).attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "¿Estás seguro de eliminar la categoría?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/eliminar-categoria',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                location.reload();
                                // window.location.href = '/admin/todos-los-productos';
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });
});

$("#colores .delete").click(function () {
    let data = {};
    let $this = $(this)
    data.id = $(this).attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "¿Estás seguro de eliminar la color?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/eliminar-color',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                location.reload();
                                // window.location.href = '/admin/todos-los-productos';
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });
});

$("#tallas .delete").click(function () {
    let data = {};
    let $this = $(this)
    data.id = $(this).attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "¿Estás seguro de eliminar la talla?",
        text: "Una vez eliminado, ¡no podrá recuperar este archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/eliminar-talla',
                    data: data,
                    type: 'POST',
                    beforeSend: function ($e) {
                        $this.addClass('disabled').text('Eliminando ...').attr('disabled', 'disabled');
                    },
                    success: function (ret) {
                        if (ret.ok) {
                            swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                                location.reload();
                                // window.location.href = '/admin/todos-los-productos';
                            });
                        } else {
                            swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
                        }
                    }
                });

            } else {
                swal("Operación cancelada!");
            }
        });
});


function is_email(email) {
    return /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(email);
}

function showSalespopup() {
    $('.sold_sale_popup').removeClass('sold_sale_popup_tl sold_sale_popup_tr sold_sale_popup_bl sold_sale_popup_br sold_sale_show');
    var productData = response[salePopupIndex];
    $('.sold_sale_popup .sold_sale_product_image img').attr('src', productData.image);
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
        $('#salsepop_close').click();
    }, 5000);
}

function is_name(name) {
    return /^([a-z Ã±Ã¡Ã©Ã­Ã³Ãº]{2,60})$/i.test(name);
}

function is_number(numero) {
    return /^[0-9]*$/.test(numero);
}

// buscar cliente
$('.search_text').click(function () {
    let criteria = $.trim($("#search #txt_search").val());
    if (criteria.length == '') {
        swal("Error de búsqueda!", "Ingrese DNI / RUC correctamente!", "warning");
        return false;
    }

    $.ajax({
        url: '/admin/txt_search_dni_cliente',
        data: {
            dni: criteria,
        },
        method: 'POST',
        dataType: 'json',
        success: function (ret) {
            if (ret.result == '' || ret.result == null) {
                swal("Cliente no encontrado!", "Registre al cliente!", "warning");
                return false;
            }
            $('#nombresclinete').val(ret.result.NOM_APEL);
            $('#telefonocliente').val(ret.result.CELULAR);
            $('#idcliente').val(ret.result.ID);
        }
    });

});

$(".seleccionar").click(function () {
    let data = {}
    let $this = $(this);
    data.id = $this.attr('data-id');
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/buscar-producto-por-id',
        data: data,
        type: 'POST',
        beforeSend: function ($e) {
            $this.addClass('disabled').text('Procesando ...').attr('disabled', 'disabled');
        },
        success: function (ret) {
            if (ret.ok) {
                var html = '<div class="card card-task col-md-6 productos" id="listSeleccionado_' + ret.result.id + '"  data-id="' + ret.result.id + '"><div class="card-body">';
                html += ' <div class="card-title">';
                html += ' <a href="javascript:void(0);"><h6 data-filter-by="text">' + ret.result.titulo + '</h6></a>';
                html += '<span class="text-small">' + ret.result.nameCategoria + '</span>';
                html += '     </div>';
                html += '   <div class="card-meta">';
                html += '       <div class="d-flex align-items-center">';
                html += '     <button type="button" class="btn btn-sm btn-danger delete" data-id="' + ret.result.id + '"> <i class="icofont-close"></i></button>';
                html += '     </div>';
                html += '  </div>'
                html += '</div></div>';
                $("#listColeccion").append(html);
                swal("Agregado correctamente!", "Buen trabajo :)!", "success");
                $this.removeClass('disabled').html('<i class="icofont-checked"></i> Seleccionar').prop('disabled', false);
            }
        }
    });


});

$("#search #txt_search").keypress(function (e) {
    if (e.keyCode == 13) {
        criteria = $.trim($("#search #txt_search").val());
        if (criteria.length == '') {
            swal("Error de búsqueda!", "Ingrese su búsqueda!", "warning");
            return false;
        }

        $.ajax({
            url: '/admin/txt_search_Producto',
            data: {
                criteria: criteria,
            },
            method: 'POST',
            dataType: 'json',
            success: function (ret) {
                if (ret.result == '' || ret.result == null) {
                    swal("Cliente no encontrado!", "Registre al cliente!", "warning");
                    return false;

                }
                $('#nombresclinete').val(ret.result.NOM_APEL);
                $('#telefonocliente').val(ret.result.CELULAR);
                $('#idcliente').val(ret.result.ID);
            }
        });
    }
});

$("#fileGaleria").on("change", function (e) {
    e.preventDefault();
    var esto = $(this);
    var idFile = esto.attr('id');
    uploadAjaxarchivo(idFile);
});

$("#fileadjunto").on("change", function (e) {
    e.preventDefault();
    var esto = $(this);
    var idFile = esto.attr('id');
    uploadAjaxarchivo(idFile);
});

$('#colecciones .guardar').on('click', function () {
    let data = {};
    let $this = $(this);
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.titulo = $.trim($('#titulo').val());
    data.descripcion = $.trim($('#descripcion').val());
    data.id = $this.data('id');
    data.productos = '';
    data.imagen = '';
    _imagenes = $("#fileadjunto_list .image");
    _productos = $("#listColeccion .productos");

    if (data.titulo == '') {
        swal("Debes ingresar  un titulo!", "", "warning");
        return false;
    }

    if (data.descripcion == '') {
        swal("Debes descripción!", "", "warning");
        return false;
    }

    if (_imagenes.length >= 2) {
        swal("Sole se permite una imagen!", "", "warning");
        return
    }

    for (i = 0; i < _imagenes.length; i++) {
        data.imagen += $(_imagenes[i]).attr('data-id') + '|';
    }

    for (i = 0; i < _productos.length; i++) {
        data.productos += $(_productos[i]).attr('data-id') + '|';
    }

    if (data.imagen == '') {
        swal("Debes agregar una imagen!", "", "warning");
        return false;
    }

    if (data.productos == '') {
        swal("Debes agregar productos!", "", "warning");
        return false;
    }

    $.ajax({
        url: '/admin/guardar-coleccion',
        data: data,
        type: 'POST',
        beforeSend: function ($e) {
            $this.addClass('disabled').text('Guardando datos ...').attr('disabled', 'disabled');
        },
        success: function (ret) {
            if (ret.ok) {
                swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                    location.reload();
                    // window.location.href = '/admin/todos-los-productos';
                });
            } else {
                swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
            }
        }
    });
});


$('#producto .guardar').on('click', function () {
    let data = {};
    let $this = $(this);
    var tallas = [];
    var colores = [];

    $.each($("input[name='tallaId[]']:checked"), function () {
        tallas.push($(this).val());
    });
    $.each($("input[name='coloresId[]']:checked"), function () {
        colores.push($(this).val());
    });
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.titulo = $.trim($('#titulo').val());
    data.categoria = $.trim($('#categoria').val());
    data.DespachoDomicilio = $('#tipoEntregaDomicilio').is(':checked') ? 1 : 0;
    data.DespachoTienda = $('#DespachoTienda').is(':checked') ? 1 : 0;
    data.descripcion = $.trim($('#descripcion').val());
    data.descripcionCompleta = $('#descripcionCompleta_ifr').contents().find("body").html();
    data.precio = $.trim($('#precio').val());
    data.tallas = tallas;
    data.colores = colores;
    data.tags = $.trim($('#tags').val());
    data.id = $this.data('id');
    data.fotos = '';
    _imagenes = $("#fileGaleria_list .image");
    for (i = 0; i < _imagenes.length; i++) {
        data.fotos += $(_imagenes[i]).attr('data-id') + '|';
    }

    if (data.titulo == '') {
        swal("Debes ingresar  un titulo!", "", "warning");
        return false;
    }
    if (data.categoria == '') {
        swal("Debes seleccionar categoria!", "", "warning");
        return false;
    }
    if (data.DespachoDomicilio == 0 && data.DespachoTienda == 0) {
        swal("Debes seleccionar tipo de entrega!", "", "warning");
        return false;
    }

    if (data.descripcion == '') {
        swal("Debes descripción!", "", "warning");
        return false;
    }

    if (data.precio == '') {
        swal("Debes ingresar el precio!", "", "warning");
        return false;
    }

    if (data.tallas.length == 0) {
        swal("Debes seleecionar las tallas!", "", "warning");
        return false;
    }

    if (data.colores.length == 0) {
        swal("Debes seleccionar las colores disponibles!", "", "warning");
        return false;
    }
    if (data.tags == '') {
        swal("Debes ingresar al menos un tag!", "", "warning");
        retur
    }
    if (data.fotos == '') {
        swal("Debes subir al menos una imagen!", "", "warning");
        return
    }

    $.ajax({
        url: '/admin/guardar-producto',
        data: data,
        type: 'POST',
        
        beforeSend: function ($e) {
            $this.addClass('disabled').text('Guardando datos ...').attr('disabled', 'disabled');
        },
        success: function (ret) {
            if (ret.ok) {
                swal(ret.message, "Buen trabajo :)", "success").then((value) => {
                    location.reload();
                    // window.location.href = '/admin/todos-los-productos';
                });
            } else {
                swal("Error!", "Problemas al guardar -- Comuníquese con el administrador!", "warning");
            }
        }
    });
});

function uploadAjaxarchivo(idFile) {
    var inputFileImage = document.getElementById(idFile);
    var file = inputFileImage.files;
    var archivos = new FormData();
    for (i = 0; i < file.length; i++) {
        archivos.append('file' + i, file[i]);
    }
    archivos.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        url: '/admin/uploads',
        type: 'POST',
        data: archivos,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            $('.cargando').show();
        },
        success: function (xdata) {
            if (xdata.ok == true) {
                $('#' + idFile + '_list').append(plantillaListImagenes(xdata));
            }
        },
        complete: function (res) {
            $('.cargando').hide();
        },

    });

};

function plantillaListImagenes(res) {
    var html = '<div class="col-md-6 image"  id="img_' + res.imgId + '" data-id="' + res.imgId + '" data-name="' + res.name + '">';
    html += '<div class="card">';
    html += '<div class="card-body">'
    html += '<div class="dropdown card-options">';
    html += '<button class="btn-options" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_vert</i></button>';
    html += '<div class="dropdown-menu dropdown-menu-right" style="">';
    html += '<a href="javascript:void(0)" class="dropdown-item text-danger delete" data-id="' + res.imgId + '" data-name="' + res.name + '" href="#">Eliminar</a></div></div>';
    html += '<div class="card-title">';
    html += '<a href="#"><h5  class="H5-filter-by-text"><img src="' + res.urlCompleta + '" width="100%"/></h5></a>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    return html;
}
