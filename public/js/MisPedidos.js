$(function () {
    $(document).on("click", ".detalles", function () {
        var NumeroOrden = ".No" + $(this).attr("id");
        $("#DetallesPedidos .modal-header").html("");
        $("#TablaDetalles").empty();

        $.ajax({
            url: url_ + "/" + $(this).attr("id"),
            method: "GET",
            success: function (data) {
                $("#DetallesPedidos .modal-header").append($(NumeroOrden).html());
                $("#DetallesPedidos .modal-body #TablaDetalles").append("<tr class ='cabeceraMisPedidos'><th>Producto</th><th>Cantidad</th><th>Precio/Unidad</th></tr>");
                $.each(data, function (val, value) {
                    $.ajax({
                        url: url_p + "/" + value.product_id,
                        method: "GET",
                        success: function (dataProd) {
                            console.log(dataProd);
                            $("#DetallesPedidos .modal-body #TablaDetalles").append("<tr class='ProdMisPedidos'><td><img class='imgMisPedidos' src=" + url_img + "/" + dataProd[0].img + "></td><td class='quantityMisPedidos'>" + value.quantity + "</td><td class='priceMisPedidos'>" + value.price + "€</td></tr>");
                        }
                    })


                })
                $("#DetallesPedidos").modal();
            }
        })
    })


    $(document).on("click", ".cancelar", function () {

        $.ajax({
            url: url_p + "/" + $(this).attr("id"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "PATCH",
            success: function (data) {
                location.reload();
            }
        })
    })
})