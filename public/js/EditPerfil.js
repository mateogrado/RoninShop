$(function () {
    $("#miPerfil").click(function () {
        $("#perfil").modal();
    })

    var edit_PerfilCP = true;
    var edit_PerfilTelefono = true;

    $("#perfil_cp").blur(function () {
        pattern = /^\d{5}$/g;
        halladoCP = $("#perfil_cp").val().match(pattern);
        if (halladoCP) {
            $("#perfil_cp").css('border-color', '#ced4da')
            edit_PerfilCP = true;
        }
        else {
            $("#perfil_cp").css('border-color', 'red')
            edit_PerfilCP = false;
        }
    })
    $("#perfil_telefono").blur(function () {
        pattern = /^\d{9}$/g;
        halladoTF = $("#perfil_telefono").val().match(pattern);
        if (halladoTF) {
            $("#perfil_telefono").css('border-color', '#ced4da')
            edit_PerfilTelefono = true;
        }
        else {
            $("#perfil_telefono").css('border-color', 'red')
            edit_PerfilTelefono = false;
        }
    })

    $("#editar_perfil").click(function () {

        var token = $('input[name=_token]').val();

        if (edit_PerfilCP && edit_PerfilTelefono) {

            $.ajax({
                url: url_user + "/" + $("#perfil_id").val(),
                method: "PATCH",
                headers: { 'X-CSRF-TOKEN': token },
                data: {
                    name: $("#perfil_name").val(),
                    telefono: $("#perfil_telefono").val(),
                    provincia: $("#perfil_provincia").val(),
                    cp: $("#perfil_cp").val(),
                    direccion: $("#perfil_direccion").val()
                },
                success: function (data) {
                    $("#perfil").modal("toggle");
                    location.reload();
                }
            })

        }
        else {
            alert("Algunos datos introducidos son incorrectos");
        }

    })

})