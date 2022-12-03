$(function() {
    // Notificaciones pendientes

    setTimeout(function() {
        notificacionesPendientes();
    }, 500);

    create_asunto = false;
    create_mensaje = false;
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $("#notificaciones").click(function() {
        var id_destinatario = $("#id_destinatario").val();

        $("#tabla-notificaciones").empty();

        // Recogemos todos los mensajes para el usuario conectado

        $.ajax({
            url: url_n + '/' + id_destinatario,
            method: "GET",
            success: function(data) {

                notificacionesRecibidas(data);

                $("#notification-modal").modal();

                $(document).on("click", "#leer_msj", function() {

                    $.ajax({
                        url: url_n + '/' + $(this).parent().parent().children("#id_msj").text(),
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        method: 'PATCH',
                        success: function(data) {

                            notificacionesPendientes();
                        }
                    })


                    $("#notification-modal").modal("toggle");

                    $(".cabecera-mensaje").empty();
                    $(".cuerpo-mensaje").empty();

                    $(".cabecera-mensaje").append("<h2>" + $(this).parent().parent().children("#nombre_rem_msj").text() + "</h2>")
                    $(".cuerpo-mensaje").append("<h4>" + $(this).parent().parent().children("#asunto_msj").text() + ":</h4>", "<p>" + $(this).parent().parent().children("#mensaje_msj").text() + "</p>");

                    $("#mensaje-modal").modal();
                })

                $(document).on("click", "#borrar_msj", function() {

                    $.ajax({
                        url: url_n + '/' + $(this).parent().parent().children("#id_msj").text(),
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        method: 'DELETE',
                        success: function(data) {
                            notificacionesPendientes();

                            $.ajax({
                                url: url_n + '/' + id_destinatario,
                                method: 'GET',
                                success: function(data) {

                                    notificacionesRecibidas(data);
                                }
                            })
                        }
                    })
                })

                $(document).on("click", "#leer_msj_enviado", function() {

                    $("#notification-modal").modal("toggle");

                    $(".cabecera-mensaje").empty();
                    $(".cuerpo-mensaje").empty();

                    $(".cabecera-mensaje").append("<h2>" + $(this).parent().parent().children("#nombre_rem_msj").text() + "</h2>")
                    $(".cuerpo-mensaje").append("<h4>" + $(this).parent().parent().children("#asunto_msj").text() + ":</h4>", "<p>" + $(this).parent().parent().children("#mensaje_msj").text() + "</p>");

                    $("#mensaje-modal").modal();
                })

                $("#mensajesRecibidos").click(function() {

                    $.ajax({
                        url: url_n + '/' + id_destinatario,
                        method: 'GET',
                        success: function(data) {

                            notificacionesRecibidas(data);
                        }
                    })
                })

                $("#mensajesEnviados").click(function() {

                    $.ajax({
                        url: url_n + '/getMsgSend/' + id_destinatario,
                        method: 'GET',
                        success: function(data) {

                            notificacionesEnviadas(data);
                        }
                    })
                })
            }
        })

    })

    $("#nuevoMensaje").click(function() {
        $("#notification-modal").modal("toggle");

        $("#destinatario").val("");
        $("#asunto").val("");
        $("#mensaje").val("");

        $.ajax({
            url: url_n + '/getMembers/' + id_destinatario,
            method: "GET",
            success: function(data) {
                $.each(data, function(val, value) {
                    $("#destinatario").append("<option value=" + value.id + ">" + value.name + "</option>");
                })
                $("#enviar-mensaje-modal").modal();
            }
        })

    })

    $("#asunto").blur(function() {
        vacio = /^[\wáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s\<\>\.\,\:\;\ª\º\ç8\)\=\"\'\[\]\{\}\ñ\$\€\%\&\/\=\!\¡\¿\?]{1,}$/g;
        halladoVacio = $("#asunto").val().match(vacio);
        if (halladoVacio) {
            $("#asunto").css('border-color', '#5cb85c')
            create_asunto = true;
        } else {
            $("#asunto").css('border-color', 'red')
            create_asunto = false;
        }
    })
    $("#mensaje").blur(function() {
        vacio = /^[\wáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s\<\>\.\,\:\;\ª\º\ç8\)\=\"\'\[\]\{\}\ñ\$\€\%\&\/\=\!\¡\¿\?]{1,}$/g;
        halladoVacio = $("#mensaje").val().match(vacio);
        if (halladoVacio) {
            $("#mensaje").css('border-color', '#5cb85c')
            create_mensaje = true;
        } else {
            $("#mensaje").css('border-color', 'red')
            create_mensaje = false;
        }
    })

    $("#enviarMensaje").click(function() {

        if (create_asunto && create_mensaje) {
            $.ajax({
                type: "POST",
                url: url_n,
                method: "POST",
                data: {
                    id_remitente: $("#id_destinatario").val(),
                    id_destinatario: $("#destinatario").val(),
                    nombre_remitente: $("#nombre_remitente").val(),
                    asunto: $("#asunto").val(),
                    mensaje: $("#mensaje").val(),
                    visto: "no",
                    '_token': $("meta[name='csrf-token']").attr("content")
                },
                success: function(mensaje) {
                    notificacionesPendientes();
                    $("#enviar-mensaje-modal").modal('toggle');
                }
            })
        } else {
            var mensajeError = "";
            if (!create_asunto)
                mensajeError += "\n Asunto inválido"
            if (!create_mensaje)
                mensajeError += "\n Mensaje inválido"
            alert("Error:" + mensajeError)
        }


    })

    // FUNCIONES


    function notificacionesPendientes() {
        $.ajax({
            url: url_n + '/howManyNotifications/' + $("#id_destinatario").val(),
            method: "GET",
            success: function(data) {
                if (data != '0')
                    $("#badgeNotificaciones").html(data).removeClass("d-none");
                else
                    $("#badgeNotificaciones").html("").addClass("d-none");
            }
        })
    }

    function notificacionesRecibidas(data) {
        $("#tabla-notificaciones").empty();

        if (data.length > 0)
            $("#tabla-notificaciones").append($("<tr class='titulos'></tr>").append($("<th>Remitente</th>"), $("<th>Asunto</th>"), $("<th>Fecha</th>"), $("<th></th>")));
        else
            $("#tabla-notificaciones").append("<h2>¡No tienes notificaciones!</h2>");
        $.each(data, function(val, value) {
            (value.visto == 'no') ? tr = $("<tr id='mensajeEntrante' class='no'></tr>"): tr = $("<tr id='mensajeEntrante' class='si'></tr>")
            tr.append("<td id='id_msj' class='d-none'>" + value.id + "</td>", "<td id='nombre_rem_msj'>" + value.nombre_remitente + "</td>", "<td id='asunto_msj'>" + value.asunto + "</td>", "<td id='mensaje_msj' class='d-none'>" + value.mensaje + "</td>", "<td id='fecha_msj'>" + new Date(value.created_at).getDate() + " " + meses[new Date(value.created_at).getMonth()] + "</td>", "<td id='acciones'><button id='leer_msj' class='btn btn-success btn-table'>Leer</button><button id='borrar_msj' class='btn btn-danger btn-table'>X</button></td>");
            $("#tabla-notificaciones").append(tr);
        })
    }

    function notificacionesEnviadas(data) {
        $("#tabla-notificaciones").empty();

        if (data.length > 0)
            $("#tabla-notificaciones").append($("<tr class='titulos'></tr>").append($("<th>Destinatario</th>"), $("<th>Asunto</th>"), $("<th>Fecha</th>"), $("<th></th>")));
        else
            $("#tabla-notificaciones").append("<h2>¡No has enviado ningún mensaje!</h2>", "<h4>(O se han borrado)</h4>");

        $.each(data, function(val, value) {
            (value.visto == 'no') ? tr = $("<tr id='mensajeEnviado' class='no'></tr>"): tr = $("<tr id='mensajeEnviado' class='si'></tr>")
            tr.append("<td id='id_msj' class='d-none'>" + value.id + "</td>", "<td id='nombre_rem_msj'>" + value.nombre_destinatario + "</td>", "<td id='asunto_msj'>" + value.asunto + "</td>", "<td id='mensaje_msj' class='d-none'>" + value.mensaje + "</td>", "<td id='fecha_msj'>" + new Date(value.created_at).getDate() + " " + meses[new Date(value.created_at).getMonth()] + "</td>", "<td id='acciones'><button id='leer_msj_enviado' class='btn btn-success btn-table'>Leer</button>");
            $("#tabla-notificaciones").append(tr);
        })
    }
})