$(document).ready(function(){

    Table = $('.tablepedidos').DataTable({

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

    Table = $('.tableproductoscar').DataTable({

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

    $(document).on("click", ".btnEliminarProd", function () {

        var id = $(this).data("idpro");

        datos = {

          _token: $("meta[name='csrf-token']").attr("content"),



          _method: "POST",



          id: id,

        };



        var hrf = location.origin;



        // mientras se arregla el error del public



        //var public = "/tienda/public/";
        var public = "/";


        var url = hrf + public + "car/delete";



        $.ajax({

          type: "POST",



          url: url,



          data: datos,



          success: function (respuesta) {

            window.location.reload();

          },

        });

      });

      $(document).on("click", ".btn-limpiarcar", function () {

        var id = $(this).data("idpro");

        datos = {

          _token: $("meta[name='csrf-token']").attr("content"),



          _method: "POST",



          id: id,

        };



        var hrf = location.origin;



        // mientras se arregla el error del public



        //var public = "/tienda/public/";
        var public = "/";


        var url = hrf + public + "car/clear";



        $.ajax({

          type: "POST",



          url: url,



          data: datos,



          success: function (respuesta) {

            window.location.reload();

          },

        });

      });


})
