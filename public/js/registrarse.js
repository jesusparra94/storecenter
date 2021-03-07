$(document).ready(function(){
    $("input[name=rut]").keyup(function(){
        var rut = $(this).val();
        if(rut.match(/^[0-9]+[kK]+$/)){
            $('small.ruttext').text("RUT Valido");
        }else{
            $('small.ruttext').text("RUT Invalido");
        }
    });

    $("input[name=rut]").keydown(function(){
        $('small.ruttext').text("Sin puntos ni guión, ejemplo(23223223K)");
    });
});

function ValidarRUT(rut){
    permitido = /^[0-9]+[kK]+$/;

//sólo letras, pero esto no incluye los acentos, así que si introduces á no es correcto.
letras = /^[a-zA-Z]+$/;
}

$(".region").change(function(){


    let idregion = $(this).val();

    console.log(idregion);

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        idregion: idregion
    };

    let hrf = location.origin;

    let url = hrf + "/traercomunas";

    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function (respuesta) {

            $(".comuna").html('');

            for (let i = 0; i < respuesta.length; i++) {

                $(".comuna").append('<option value="'+respuesta[i]["com_id"]+'">'+respuesta[i]["com_nombre"]+'</option>');
            }

        }
    });


})
