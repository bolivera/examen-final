
$('#checkout-btn').on('click', function(e) {
    if($("#nombres").val() == ''){
        swal({
            text: "Debes agregar tu nombre",  
            icon: "warning",
            });
        return false;
    }

    if($("#apellidos").val() == ''){
        swal({
            text: "Debes agregar tus apellidos completos",  
            icon: "warning",
            });
        return false;
    }

    if($("#email").val() == ''){
        swal({
            text: "Debes agregar correo",  
            icon: "warning",
            });
        return false;
    }else{
        emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (emailRegex.test($("#email").val()) != true) {
            swal({
                text: "Debes agregar correo valido",  
                icon: "warning",
            });
            return false;
        } 
    }

    if($("#direccion").val() == ''){
        swal({
            text: "Debes agregar una dirección",  
            icon: "warning",
            });
        return false;
    }
  
    if ($.trim($('#departamento').val()) == '[Seleccionar]' || $.trim($('#provincia').val()) == '' || $.trim($('#distrito').val()) == '') {
        swal({
            text: "Debes Seleccionar un Departamento / Provincia / Distrito!",  
            icon: "warning",
            });
        return false;
    }

    if($("#telefono").val() == ''){
        swal({
            text: "Ingresa un número de teléfono",  
            icon: "warning",
            });
        return false;
    }else{
        telefonoMobilRegex = /^\+?([0-9]{9})$/;
        telefonoRegex = /^\+?([0-9]{6})$/;
        if(telefonoMobilRegex.test($('#telefono').val()) != true & telefonoRegex.test($('#telefono').val()) != true){
            swal({
            text: "Ingresa un número de teléfono valido",  
            icon: "warning",
            });
            return false;
        }
    }

    if ($("#check").is(':checked')) {

        // var idUbigeo = $('#departamento').val();
        // $.ajax({
        //         url: "/carrito/izipay-pagar",
        //         method: "post",
        //         dataType: 'json',
        //         data: {
        //             _token: token,
        //             id: idUbigeo,
        //         },
        //         success : function(response){
        //                //codigo de exito
        //                swal({
        //                 text: response.msg,  
        //                 icon: "warning",
        //                 });
        //         },
        //         error: function(error){
        //                //codigo error
        //             toastr.warning('Nooooooooooooooo')
        //         }
        // })
        
        // e.preventDefault();

    } else {
        swal({
            text: "Acepta los terminos y condiciones",  
            icon: "warning",
            });
        return false;
    }



});

