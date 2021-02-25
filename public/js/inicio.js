$(".owl-carousel").owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    autoplay:true,
    loop:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 2,
        },
    },
});


// agregar producto al carro

$(document).on("click", ".btn-agg", function () {
    let idproducto = $(this).attr("idproducto");

    let tipoproducto = $(this).attr("tipo");

    $(this).addClass("d-none");

    $(".divadd" + idproducto).removeClass("d-none");

    $(".divadd" + idproducto).addClass("d-flex");

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        id: idproducto,

        tipoproducto: tipoproducto,
    };

    let hrf = location.origin;

    let url = hrf + "/car/add";

    $.ajax({
        type: "POST",

        url: url,

        data: datos,

        success: function (respuesta) {
            let itemcarrito = Object.keys(respuesta).length;

            if (itemcarrito > 0) {
                $("#tablaCarrito").html("");

                $(".badgecar").text(itemcarrito);

                listarcarro(respuesta, idproducto);

                let titulo = "Producto agregado correctamente";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: titulo,
                });
            } else {
                let titulo = "Producto que intentas agregar ya no tiene stock";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);

                        setTimeout(() => {
                            window.location = location.href;
                        }, 2000);
                    },
                });

                Toast.fire({
                    icon: "error",
                    title: titulo,
                });

                $("#tablaCarrito").html("");

                $(".badgecar").text(0);

                $(".btnaccionescarpedir").html("");

                $(".contenidosubtotal").html("");

                $(".contenidosubtotal").append(
                    '<div class="container  notcar" style="padding: 15px 27px 15px 20px;">' +
                        "<h5> No tienes productos agregados al carro de compras</h5>" +
                        "</div>"
                );
            }
        },
    });
});

function listarcarro(respuesta, id) {
    let total = 0;

    for (let i in respuesta) {
        if (id == respuesta[i]["id"]) {
            $(".badgecantidad" + id).removeClass("d-none");

            $(".badgecantidad" + id).text(respuesta[i]["cantidadcompra"]);

            $(".cantidadcompra" + id).text(respuesta[i]["cantidadcompra"]);

            $(".restarcantidad" + id).attr(
                "cantidad",
                respuesta[i]["cantidadcompra"]
            );
        }

        let precio =
            respuesta[i]["cantidadcompra"] * respuesta[i]["precio_venta"];

        precio = new Intl.NumberFormat("de-DE").format(precio);

        total += respuesta[i]["cantidadcompra"] * respuesta[i]["precio_venta"];

        let body =
            '<div class="row mb-3 cadaprod cadaprod' +
            respuesta[i]["id"] +
            ' " idproducto="' +
            respuesta[i]["id"] +
            '">' +
            '<div class="col-4 mb-2">' +
            '<img class="img-thumbnail img-fluid" style="height: 66px; object-fit: cover;" src="http://pickupnow/storage" alt="">' +
            "</div>" +
            '<div class="col-5" align="center">' +
            '<div class="row">' +
            '<div class="col-12 text-center mb-2" align="center">' +
            "<h6>" +
            respuesta[i]["nombre"] +
            "</h6>" +
            "</div>" +
            '<div class="col-12">' +
            '<div style="color:#072146; display: flex;">';

        let cantidadprod = parseInt(respuesta[i]["cantidadcompra"]);

        if (cantidadprod > 1) {
            body +=
                '<button class="btn btn-acciones restarcantidad restarcantidad' +
                respuesta[i]["id"] +
                '" idproducto="' +
                respuesta[i]["id"] +
                '" cantidadcar="' +
                respuesta[i]["cantidadcompra"] +
                '" >';
        } else {
            body +=
                '<button class="btn btn-acciones restarcantidad restarcantidad' +
                respuesta[i]["id"] +
                '" idproducto="' +
                respuesta[i]["id"] +
                '" cantidadcar="' +
                respuesta[i]["cantidadcompra"] +
                '" >';
        }

        body +=
            '<img class="img-fluid" style="width: 25px " src=" ' +
            location.origin +
            "/img/minusblack.png" +
            '" >' +
            "</button>" +
            '<span class="cantidad' +
            respuesta[i]["id"] +
            '" style="color:#072146;" >' +
            respuesta[i]["cantidadcompra"] +
            "</span>" +
            '<button class="btn btn-acciones sumarcantidad sumarcantidad' +
            respuesta[i]["id"] +
            ' float:right" idproducto="' +
            respuesta[i]["id"] +
            '" >' +
            '<img class="img-fluid" style="width: 25px " src="' +
            location.origin +
            "/img/addblack.png" +
            '" >' +
            "</button>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="col-3">' +
            '<div class="row">' +
            '<div class="col-12 mb-2">' +
            '<button class="btn btn-acciones borrarproduc float:right" idproducto="' +
            respuesta[i]["id"] +
            '" >' +
            '<img class="img-fluid" style="width: 25px " src="' +
            location.origin +
            "/img/deleteblack.png" +
            '" >' +
            "</button>" +
            "</div>" +
            '<div class="col-12">' +
            '<h6 class="precioproducto' +
            respuesta[i]["id"] +
            '">' +
            precio +
            "</h6>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>";

        $("#tablaCarrito").append(body);

        if (respuesta[i]["stock"] == 0) {
            $(".sumarcantidad" + id).attr("disabled", "disabled");

            $(".stock" + id).text("Sin Stock");

            $(".stock" + id).addClass("text-red");
        } else {
            $(".stock" + id).removeClass("text-red");

            $(".stock" + id).text("En Stock" + respuesta[i]["stock"]);
        }
    }

    let totalsinformato = total;

    total = new Intl.NumberFormat("de-DE").format(total);

    $(".contenidosubtotal").html("");

    $(".contenidosubtotal").append(
        '<div class="col-4 mb-2">' +
            "<h6>Subtotal</h6>" +
            "</div>" +
            '<div class="col-5">' +
            "</div>" +
            '<div class="col-3">' +
            '<div class="row">' +
            '<div class="col-12 p-1">' +
            '<h6 class="subtotalcar" total="' +
            totalsinformato +
            '">$' +
            total +
            "</h6>" +
            "</div>" +
            "</div>" +
            "</div>"
    );
    $(".btnaccionescarpedir").html("");

    $(".btnaccionescarpedir").append(
        '<div class="row btnaccionescarpedir">' +
            '<div class="col-6 d-flex">' +
            '<button class="btn btn-delete vaciarcar">Vaciar</button>' +
            "</div>" +
            '<div class="col-6 d-flex">' +
            '<button class="btn btn-crear realizarpedido" data-dismiss="modal" aria-label="Close">Pedir</button>' +
            "</div>" +
            "</div>"
    );
}

$(document).on("click", ".sumarcantidad", function () {
    let idproducto = $(this).attr("idproducto");

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        id: idproducto,
    };

    let hrf = location.origin;

    let url = hrf + "/car/sumar";

    $.ajax({
        type: "POST",

        url: url,

        data: datos,

        success: function (respuesta) {
            console.log(respuesta);

            let itemcarrito = Object.keys(respuesta).length;

            if (itemcarrito > 0) {
                $("#tablaCarrito").html("");

                $(".badgecar").text(itemcarrito);

                listarcarro(respuesta, idproducto);

                let titulo = "Producto agregado correctamente";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: titulo,
                });
            } else {
                let titulo = "Producto que intentas agregar ya no tiene stock";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);

                        setTimeout(() => {
                            window.location = location.href;
                        }, 2000);
                    },
                });

                Toast.fire({
                    icon: "error",
                    title: titulo,
                });
            }
        },
    });
});

$(document).on("click", ".restarcantidad", function () {
    let idproducto = $(this).attr("idproducto");
    let cantidad = $(this).attr("cantidad");

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        id: idproducto,
    };

    let hrf = location.origin;

    if (cantidad == 1) {
        $(".btn-agg" + idproducto).removeClass("d-none");

        $(".divadd" + idproducto).removeClass("d-flex");

        $(".divadd" + idproducto).addClass("d-none");

        $(".badgecantidad" + idproducto).addClass("d-none");

        let url = hrf + "/car/deleteprodcar";

        $.ajax({
            type: "POST",

            url: url,

            data: datos,

            success: function (respuesta) {
                console.log(respuesta);

                let itemcarrito = Object.keys(respuesta).length;

                if (itemcarrito > 0) {
                    $("#tablaCarrito").html("");

                    $(".badgecar").text(itemcarrito);

                    listarcarro(respuesta, idproducto);

                    let titulo = "Productos eliminado correctamente";

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    Toast.fire({
                        icon: "success",
                        title: titulo,
                    });
                } else {
                    $("#tablaCarrito").html("");

                    $(".badgecar").text(0);

                    $(".btnaccionescarpedir").html("");

                    $(".contenidosubtotal").html("");

                    $(".contenidosubtotal").append(
                        '<div class="container  notcar" style="padding: 15px 27px 15px 20px;">' +
                            "<h5> No tienes productos agregados al carro de compras</h5>" +
                            "</div>"
                    );
                }
            },
        });
    } else {
        let url = hrf + "/car/restar";

        $.ajax({
            type: "POST",

            url: url,

            data: datos,

            success: function (respuesta) {
                console.log(respuesta);

                let itemcarrito = Object.keys(respuesta).length;

                console.log(itemcarrito);

                if (itemcarrito > 0) {
                    $("#tablaCarrito").html("");

                    $(".badgecar").text(itemcarrito);

                    listarcarro(respuesta, idproducto);

                    let titulo = "Producto eliminado correctamente";

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    Toast.fire({
                        icon: "success",
                        title: titulo,
                    });
                } else {
                    window.location.reload();
                }
            },
        });
    }
});

$(document).on("click", ".borrarproduc", function () {
    let idproducto = $(this).attr("idproducto");

    $(".btn-agg" + idproducto).removeClass("d-none");

    $(".divadd" + idproducto).removeClass("d-flex");

    $(".divadd" + idproducto).addClass("d-none");

    $(".badgecantidad" + idproducto).addClass("d-none");

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        id: idproducto,
    };

    let hrf = location.origin;

    let url = hrf + "/car/deleteprodcar";

    $.ajax({
        type: "POST",

        url: url,

        data: datos,

        success: function (respuesta) {
            console.log(respuesta);

            let itemcarrito = Object.keys(respuesta).length;

            if (itemcarrito > 0) {
                $("#tablaCarrito").html("");

                $(".badgecar").text(itemcarrito);

                listarcarro(respuesta, idproducto);

                let titulo = "Productos eliminado correctamente";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: titulo,
                });
            } else {
                window.location.reload();

                $("#tablaCarrito").html("");

                $(".badgecar").text(0);

                $(".btnaccionescarpedir").html("");

                $(".contenidosubtotal").html("");

                $(".contenidosubtotal").append(
                    '<div class="container  notcar" style="padding: 15px 27px 15px 20px;">' +
                        "<h5> No tienes productos agregados al carro de compras</h5>" +
                        "</div>"
                );
            }
        },
    });
});

$(document).on("click", ".vaciarcar", function () {
    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",
    };

    let hrf = location.origin;

    let url = hrf + "/car/vaciarcar";

    $.ajax({
        type: "POST",

        url: url,

        data: datos,

        success: function (respuesta) {
            if (respuesta == "ok") {
                let titulo = "Haz vaciado tu carro :( ";

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: titulo,
                });
            }
        },
    });
});

$(document).on("click", ".realizarpedido", function () {
    $("#formpedido").submit();
});

$(document).on("keyup", "#buscador", function () {
    let nombre = $(this).val();

    datos = {
        _token: $("meta[name='csrf-token']").attr("content"),

        _method: "POST",

        nombre: nombre,
    };

    let hrf = location.origin;

    let url = hrf + "/buscador";

    $.ajax({
        type: "POST",

        url: url,

        data: datos,

        success: function (respuesta) {
            console.log(respuesta);

            let itemcarrito = Object.keys(respuesta).length;
            $(".cuerpobusqueda").html("");

            if (itemcarrito > 0) {
                $(".resultado").show();

                for (let i = 0; i < respuesta.length; i++) {
                    let producto = respuesta[i]["nombre"].split(" ").join("-");

                    producto = producto.toLowerCase();

                    let body = "<tr>";

                    body +=
                        "<td style='background:white; height: 30px;'><a style='color: #072146; display: block; font-size: 18px;' href='" +
                        hrf +
                        "/productos/" +
                        producto +
                        "' class=''>" +
                        respuesta[i]["nombre"] +
                        "</a></td>";

                    $(".cuerpobusqueda").append(body);
                }
            } else {
                $(".resultado").show();

                $(".cuerpobusqueda").html("");

                let body = "<tr>";

                body += "<td><a >No se encontraron resultados</a></td>";

                $(".cuerpobusqueda").append(body);
            }
        },
    });
});

$(document).on("search", "#buscador", function () {


    if ("" == this.value) {

      $(".resultado").hide();

      $(".cuerpobusqueda").html("");

    }

});

$(document).on("click", ".logout", function () {

    var idcliente = $(this).data("cliente");

    datos = {

      _token: $("meta[name='csrf-token']").attr("content"),
      _method: "POST",
      id: idcliente,

    };

    var hrf = location.origin;
    var public = "/";
    var url = hrf + public + "logout";

    console.log(url );

    $.ajax({

      type: "POST",
      url: url,
      data: datos,

      beforeSend: function() {

      },

      success: function (respuesta) {
        console.log(respuesta);
        if(respuesta=="ok"){
            window.location.href = hrf+public;
        }else{
            alert("Hay un error");
        }
      },



      error: function () {

        alert("Hay un error");

      },

    });

  });
