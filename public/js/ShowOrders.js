$(function () {
    $(document).on("change", "#status", function () {

        if ($(this).val() == "pending" || $(this).val() == "procesing" || $(this).val() == "completed" || $(this).val() == "decline") {

            $.ajax({
                url: url_ + '/' + $(this).attr("class"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: $(this).val()
                },
                method: "PATCH",
                success: function (data) {
                    $(".alerts").empty()
                    $(".alerts").append('<div class="alert alert-success" role="alert">¡Estatus cambiado!</div>')
                }
            })
        }
        else {
            $(".alerts").empty()
            $(".alerts").append('<div class="alert alert-danger" role="alert">¡Estatus inválido!</div>')
        }

    })

    $(document).on("click", ".detalles", function () {
        var NumeroOrden = ".No" + $(this).attr("id");
        $("#DetallesPedidos .modal-header").html("");
        $("#TablaDetalles").empty();

        $.ajax({
            url: url_2 + "/" + $(this).attr("id"),
            method: "GET",
            success: function (data) {
                $("#DetallesPedidos .modal-header").append($(NumeroOrden).html());
                $("#DetallesPedidos .modal-body #TablaDetalles").append("<tr><th>Id Producto</th><th>Cantidad</th><th>Precio/Unidad</th></tr>");
                $.each(data, function (val, value) {
                    $("#DetallesPedidos .modal-body #TablaDetalles").append("<tr><td>" + value.product_id + "</td><td>" + value.quantity + "</td><td>" + value.price + "€</td></tr>");
                })
                $("#DetallesPedidos").modal();
            }
        })
    })
})