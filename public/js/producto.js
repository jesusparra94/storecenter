$(document).ready(function() {


    Table = $('.listado-productos').DataTable({

        "paging": true,

        "ordering": false,

        "info":false,

        language: {

            "sProcessing": "Procesando...",

            "sLengthMenu": "Mostrar _MENU_ registros",

            "sZeroRecords": "No se encontraron resultados",

            "sEmptyTable": "Ningún dato disponible en esta tabla =(",

            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",

            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

            "sInfoPostFix": "",

            "sSearch": "Buscar:",

            "sUrl": "",

            "sInfoThousands": ",",

            "sLoadingRecords": "Cargando...",

            "oPaginate": {

                "sFirst": "Primero",

                "sLast": "Último",

                "sNext": "<i class='fas fa-angle-right'></i>",

                "sPrevious": "<i class='fas fa-angle-left'></i>"

            },

            "oAria": {

                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",

                "sSortDescending": ": Activar para ordenar la columna de manera descendente"

            }

        }

    });

    /*
    $('.listado-productos').DataTable( {
        language: {
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );

    */

    $('.btn_tr').click(function(){
        var dominio = window.location.host;
        var protocol = window.location.protocol;
        var id = $(this).attr("data-id");
        var url = '/producto/'+id;
        window.location.replace(url);
    });
} );

$(document).on("click", ".btnpdf", function(){

    var id = $(this).data("id");
    var url = location.href+"/pdf";
      datos = {
        '_token': $("meta[name='csrf-token']").attr("content"),
        '_method': 'POST',
        'idproducto': id
      }

  $.ajax({
    type:"POST",
    url:url,
    data: datos,
    success: function(respuesta){

        //alert(respuesta);




    }

  });

  })

  $(document).on("click", ".btn-addcar", function () {

    var idproducto = $(this).data("id");
    var totalcar = $(this).data("totalcar");

    /*
    $(this).addClass("d-none");



    $(".textagg" + id).addClass("d-none");



    $(".unidades" + id).removeClass("d-none");



    $(".fpedido").show();

  */

    datos = {

      _token: $("meta[name='csrf-token']").attr("content"),
      _method: "POST",
      id: idproducto,

    };

    var hrf = location.origin;
    var public = "/";
    var url = hrf + public + "car/add";

    console.log(url );

    $.ajax({

      type: "POST",
      url: url,
      data: datos,

      beforeSend: function() {
        // setting a timeout
            $( "p.textcantidad" ).html( '<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>');
            $(".btn-addcar").html('<i class="far fa-check-circle"  style="font-size:35px;"></i><p>Añadido correctamente</p>');
      },

      success: function (respuesta) {
        var coun = $(".badgecar").data('count');
        console.log(respuesta);
        setTimeout(function status(){
            $( "p.textcantidad" ).html( 'Tiene <b>'+(respuesta)+'</b> unidades agregadas');
            $(".btn-addcar").html('<i class="fas fa-cart-plus" style="font-size:35px;"></i><p>Agregar al carro</p>');
            //$(".badgecar").html(coun+respuesta);
          },500);
          window.location.reload();
  /*
        var itemcarrito = Object.keys(respuesta).length;



        var login = $(".login").val();



        if (itemcarrito > 3 && login == 0) {

          $("#modalEmail").modal("show");

        }



        $("#tablaCarrito").html("");



        $(".totalunidadcarrito").text(

          "Tienes " + itemcarrito + " tipos de Productos"

        );



        $(".badgecar").text(itemcarrito);



        listarcarro(respuesta, id);
  */
      },



      error: function () {

        alert("Hay un error");

      },

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



