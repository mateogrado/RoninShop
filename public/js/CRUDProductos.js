$(function() {
    $("#button-create-product").click(function() {

        $("#name").val("")
        $("#name").css('border-color', '#ced4da')
        $("#autor").val("")
        $("#autor").css('border-color', '#ced4da')
        $("#editorial").val("")
        $("#editorial").css('border-color', '#ced4da')
        $("#categoria").val("")
        $("#categoria").css('border-color', '#ced4da')
        $("#unidades").val("")
        $("#unidades").css('border-color', '#ced4da')
        $("#price").val("")
        $("#price").css('border-color', '#ced4da')
        $("#description").val("")
        $("#description").css('border-color', '#ced4da')
        $("#imagen").val("")
        $("#img-button").css('border-color', '#ced4da')

        $("#create_producto").modal();
    })
    $("#img-button").click(function() {
        $("#imagen").click();
    })

    // Create

    var create_nombre = false;
    var create_autor = false;
    var create_editorial = false;
    var create_categoria = false;
    var create_unidades = false;
    var create_precio = false;
    var create_descripcion = false;
    var create_img = false;

    // Comprobar si la img es tipo jpg o png

    $("#imagen").change(function() {
        jpg = /.jpg$/g;
        jpeg = /.jpeg$/g;
        png = /.png$/g;
        halladoJPG = $("#imagen").val().match(jpg);
        halladoJPEG = $("#imagen").val().match(jpeg);
        halladoPNG = $("#imagen").val().match(png);
        if (halladoJPG || halladoPNG || halladoJPEG) {
            $("#img-button").css('border-color', '#5cb85c')
            create_img = true;
        } else {
            $("#img-button").css('border-color', 'red')
            create_img = false;
        }
    })

    // Comprobar si el input nombre está vacío

    $("#name").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#name").val().match(vacio);
        if (halladoVacio) {
            $("#name").css('border-color', '#5cb85c')
            create_nombre = true;
        } else {
            $("#name").css('border-color', 'red')
            create_nombre = false;
        }
    })

    // Comprobar si el input autor está vacío

    $("#autor").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#autor").val().match(vacio);
        if (halladoVacio) {
            $("#autor").css('border-color', '#5cb85c')
            create_autor = true;
        } else {
            $("#autor").css('border-color', 'red')
            create_autor = false;
        }
    })


    // Comprobar si el input editorial está vacío

    $("#editorial").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#editorial").val().match(vacio);
        if (halladoVacio) {
            $("#editorial").css('border-color', '#5cb85c')
            create_editorial = true;
        } else {
            $("#editorial").css('border-color', 'red')
            create_editorial = false;
        }
    })

    // Comprobar si el input categoria está vacío

    $("#categoria").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#categoria").val().match(vacio);
        if (halladoVacio) {
            $("#categoria").css('border-color', '#5cb85c')
            create_categoria = true;
        } else {
            $("#categoria").css('border-color', 'red')
            create_categoria = false;
        }
    })



    // Comprobar si el input precio está vacío

    $("#price").blur(function() {
        vacio = /^[0-9]+([.][0-9]+)?$/g;
        halladoVacio = $("#price").val().match(vacio);
        if (halladoVacio && $("#price").val() != "0") {
            $("#price").css('border-color', '#5cb85c')
            create_precio = true;
        } else {
            $("#price").css('border-color', 'red')
            create_precio = false;
        }
    })


    // Comprobar si el input unidades está vacío

    $("#unidades").blur(function() {
        vacio = /^[0-9]+([.][0-9]+)?$/g;
        halladoVacio = $("#unidades").val().match(vacio);
        if (halladoVacio && $("#price").val() != "0") {
            $("#unidades").css('border-color', '#5cb85c')
            create_unidades = true;
        } else {
            $("#unidades").css('border-color', 'red')
            create_unidades = false;
        }
    })

    // Comprobar si el input descripción está vacío

    $("#description").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#description").val().match(vacio);
        if (halladoVacio) {
            $("#description").css('border-color', '#5cb85c')
            create_descripcion = true;
        } else {
            $("#description").css('border-color', 'red')
            create_descripcion = false;
        }
    })


    $("#create_form").submit(function(e) {
        e.preventDefault();
        var token = $('input[name=_token]').val();
        var formData = new FormData($("#create_form")[0]);

        if (create_nombre && create_autor && create_editorial && create_categoria && create_precio && create_unidades && create_descripcion && create_img) {

            $.ajax({
                url: url_,
                headers: { 'X-CSRF-TOKEN': token },
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $("#create_producto").modal("toggle")
                    location.reload();
                },
                error: function(errors) {
                    alert('error')
                }
            });
        } else {
            var mensajeError = "";
            if (!create_nombre)
                mensajeError += "\n Nombre inválido"
            if (!create_autor)
                mensajeError += "\n Autor inválido"
            if (!create_editorial)
                mensajeError += "\n Editorial inválida"
            if (!create_categoria)
                mensajeError += "\n Categoría inválida"
            if (!create_unidades)
                mensajeError += "\n Unidades inválidas"
            if (!create_precio)
                mensajeError += "\n Precio inválido"
            if (!create_descripcion)
                mensajeError += "\n Descripción inválida"
            if (!create_img)
                mensajeError += "\n Imagen inválida"
            alert("Error:" + mensajeError)
        }

    })

    // Edit

    var editar_nombre = true;
    var editar_autor = true;
    var editar_editorial = true;
    var editar_categoria = true;
    var editar_unidades = true;
    var editar_precio = true;
    var editar_descripcion = true;
    var editar_img = true;

    $("#edit_img-button").click(function() {
        $("#edit_imagen").click();
    })

    // Comprobar si la img es tipo jpg o png

    $("#edit_imagen").change(function() {
        jpg = /.jpg$/g;
        jepg = /.jpeg$/g;
        png = /.png$/g;
        halladoJPG = $("#edit_imagen").val().match(jpg);
        halladoJPEG = $("#edit_imagen").val().match(jpeg);
        halladoPNG = $("#edit_imagen").val().match(png);
        if (halladoJPG || halladoPNG || halladoJPEG) {
            $("#edit_img-button").css('border-color', '#5cb85c')
            create_img = true;
        } else {
            $("#edit_img-button").css('border-color', 'red')
            create_img = false;
        }
    })

    // Comprobar si el input nombre está vacío

    $("#edit_name").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#edit_name").val().match(vacio);
        if (halladoVacio) {
            $("#edit_name").css('border-color', '#5cb85c')
            create_nombre = true;
        } else {
            $("#edit_name").css('border-color', 'red')
            create_nombre = false;
        }
    })

    // Comprobar si el input autor está vacío

    $("#edit_autor").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#edit_autor").val().match(vacio);
        if (halladoVacio) {
            $("#edit_autor").css('border-color', '#5cb85c')
            editar_autor = true;
        } else {
            $("#edit_autor").css('border-color', 'red')
            editar_autor = false;
        }
    })

    // Comprobar si el input editorial está vacío

    $("#edit_editorial").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#edit_editorial").val().match(vacio);
        if (halladoVacio) {
            $("#edit_editorial").css('border-color', '#5cb85c')
            editar_editorial = true;
        } else {
            $("#edit_editorial").css('border-color', 'red')
            editar_editorial = false;
        }
    })

    // Comprobar si el input categoria está vacío

    $("#edit_categoria").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#edit_categoria").val().match(vacio);
        if (halladoVacio) {
            $("#edit_categoria").css('border-color', '#5cb85c')
            editar_categoria = true;
        } else {
            $("#edit_categoria").css('border-color', 'red')
            editar_categoria = false;
        }
    })

    // Comprobar si el input precio está vacío

    $("#edit_price").blur(function() {
        vacio = /^[0-9]+([.][0-9]+)?$/g;
        halladoVacio = $("#edit_price").val().match(vacio);
        if (halladoVacio && $("#edit_price").val() > 0) {
            $("#edit_price").css('border-color', '#5cb85c')
            create_precio = true;
        } else {
            $("#edit_price").css('border-color', 'red')
            create_precio = false;
        }
    })

    // Comprobar si el input unidades está vacío

    // $("#edit_unidades").blur(function() {
    //     vacio = /^[0-9]+([.][0-9]+)?$/g;
    //     halladoVacio = $("#edit_unidades").val().match(vacio);
    //     if (halladoVacio && $("#edit_unidades").val() > 0) {
    //         $("#edit_unidades").css('border-color', '#5cb85c')
    //         editar_unidades = true;
    //     } else {
    //         $("#edit_unidades").css('border-color', 'red')
    //         editar_unidades = false;
    //     }
    // })

    // Comprobar si el input descripción está vacío

    $("#edit_description").blur(function() {
        vacio = /^[\w\sáéíóúàèìòùäëïöü]{1,}$/g;
        halladoVacio = $("#edit_description").val().match(vacio);
        if (halladoVacio) {
            $("#edit_description").css('border-color', '#5cb85c')
            create_descripcion = true;
        } else {
            $("#edit_description").css('border-color', 'red')
            create_descripcion = false;
        }
    })

    $(document).on("click", "#edit", function() {

        $("#edit_name").val("");
        $("#edit_name").css('border-color', '#ced4da')
        $("#edit_autor").val("");
        $("#edit_autor").css('border-color', '#ced4da')
        $("#edit_editorial").val("");
        $("#edit_editorial").css('border-color', '#ced4da')
        $("#edit_categoria").val("");
        $("#edit_categoria").css('border-color', '#ced4da')
        $("#edit_price").val("");
        $("#edit_price").css('border-color', '#ced4da')
        $("#edit_unidades").val("");
        $("#edit_unidades").css('border-color', '#ced4da')
        $("#edit_description").val("");
        $("#edit_description").css('border-color', '#ced4da')
        $("#edit_imagen").val("");
        $("#edit_img-button").css('border-color', '#ced4da')

        var id = $(this).attr("class").split(" ")[0];
        var token = $('input[name=_token]').val();

        $.ajax({
            url: url_ + "/" + id,
            headers: { 'X-CSRF-TOKEN': token },
            method: 'GET',
            success: function(data) {
                $.each(data, function(val, value) {
                    $("#edit_name").val(value.name);
                    $("#edit_autor").val(value.autor);
                    $("#edit_editorial").val(value.editorial);
                    $("#edit_categoria").val(value.categoria);
                    $("#edit_price").val(value.price);
                    $("#edit_unidades").val(value.unidades);
                    $("#edit_description").val(value.description);
                    $("#edit_imagen").val(value.imagen);
                })
                $("#editar_producto").modal();
            },
            error: function(errors) {
                alert('error')
            }
        });

        $("#edit_form").submit(function(e) {
            e.preventDefault();

            var formData = new FormData($("#edit_form")[0]);

            formData.append('_method', 'patch');
            formData.append('_token', token);



            if (editar_nombre && editar_autor && editar_editorial && editar_categoria && editar_precio && editar_unidades && editar_descripcion && editar_img) {

                $.ajax({
                    url: url_ + "/" + id,
                    headers: { 'X-CSRF-TOKEN': token },
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        $("#editar_producto").modal("toggle")
                        location.reload();
                    },
                    error: function(errors) {
                        console.log(formData[0].imagen)
                        alert('error')
                    }
                });
            } else {
                var mensajeError = "";
                if (!edit_nombre)
                    mensajeError += "\n Nombre inválido"
                if (!edit_autor)
                    mensajeError += "\n Autor inválido"
                if (!edit_editorial)
                    mensajeError += "\n Editorial inválida"
                if (!edit_categoria)
                    mensajeError += "\n Categoría inválida"
                if (!edit_unidades)
                    mensajeError += "\n Unidades inválidas"
                if (!edit_precio)
                    mensajeError += "\n Precio inválido"
                if (!edit_descripcion)
                    mensajeError += "\n Descripción inválida"
                if (!edit_img)
                    mensajeError += "\n Imagen inválida"
                alert("Error:" + mensajeError)
            }

        })

    })


    // Delete

    $(document).on("click", "#borrar", function() {

        var id = $(this).attr("class").split(" ")[0];
        var token = $('input[name=_token]').val();

        $.ajax({
            url: url_ + "/" + id,
            headers: { 'X-CSRF-TOKEN': token },
            method: 'DELETE',
            success: function(data) {
                location.reload();
            },
            error: function(errors) {
                alert('error')
            }
        });
    })
})