$(document).ready(function(){
    $("input[name=rut]").keyup(function(){
        var rut = $(this).val();
        if(rut.match(/^(\d{1,3}(\.?\d{3}){2})\-?([\dkK])$/)){
            $('small.ruttext').text("RUT Válido");
            $('.btn-registrar').prop( "disabled", false );
        }else{
            $('small.ruttext').text("RUT Inválido");
        }
    });

    $("input[name=rut]").keydown(function(){
        $('small.ruttext').text("Sin puntos ni guión, ejemplo(23223223K)");
    });
});

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
