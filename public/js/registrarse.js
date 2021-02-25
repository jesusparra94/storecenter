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