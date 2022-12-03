$(function() {
    $(document).on('keyup mouseup', "#quantity", function() {

        var id = $(this).attr("class").split(" ")[0];
        var valor = $(this).val();
        var PrecioItemAntiguo = parseInt($("#precio" + id).text());
        var precioTotal = parseInt($("#PrecioTotal").text());

        if (valor > 30) {
            valor = $(this).val(50);
            alert("Atención, su pedido ha pasado las 30 unidades.");
        }
        if (valor < 1) {
            valor = $(this).val(1);
            alert("Atención, su pedido no puede ser menor a 1 unidad");
        }



        $.ajax({
            url: url_ + "/" + id,
            method: "GET",
            data: {
                quantity: valor
            },
            success: function(data) {
                $("#precio" + id).empty().append($("#price" + id).val() * valor + "€")
                $("#PrecioTotal").empty().append(precioTotal - PrecioItemAntiguo + $("#price" + id).val() * valor)
            }
        })
    })
})