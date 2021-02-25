$('.enviarcodigo').click(function(){

    $(this).addClass('d-none');

    $('.textenvio').removeClass('d-none');

    $('.divcode').removeClass('d-none');

    $('.rowbtn').removeClass('d-none');



    let email = $("#email").val();


    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        email: email
    };

    let hrf = location.origin;

    let url = hrf + "/enviarcodigo";

    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function (respuesta) {

        }
    });


});

$(document).ready(function(){

    $('.btn-ingresar').attr('disabled','disabled');

    if($('.muestraalerta').is(':hidden')){

        let titulo = $('.muestraalerta').val()

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          })
          Toast.fire({
            icon: 'error',
            title: titulo
          })
    }
});

$('#codigo').keyup(function(){

    let codigo = $(this).val();

    if(codigo.length == 6){

        $('.btn-ingresar').attr('disabled',false)
    }else{

        $('.btn-ingresar').attr('disabled','disabled')
    }
})


