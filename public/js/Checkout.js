$(function () {

    $("input").keyup(function () {
        console.log($(this).val());
        if ($(this).val() == "") {
            $("#paypal-button-container").css("display", "none")
        }
        else {
            $("#paypal-button-container").css("display", "block")
        }
    })

    $("#email").keyup(function () {
        emailCorrecto = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/g;
        hallado = $("#email").val().match(emailCorrecto);
        if (hallado) {
            // $("#email").css('border-color','#5cb85c')
            $("#paypal-button-container").css("display", "block")
        }
        else {
            // $("#email").css('border-color','red')
            $("#paypal-button-container").css("display", "none")
        }
    })

    $("#cp").keyup(function () {
        cpCorrecto = /^[0-9]{5}$/g;
        hallado = $("#cp").val().match(cpCorrecto);
        if (hallado) {
            // $("#email").css('border-color','#5cb85c')
            $("#paypal-button-container").css("display", "block")
        }
        else {
            // $("#email").css('border-color','red')
            $("#paypal-button-container").css("display", "none")
        }
    })

    $("#telefono").keyup(function () {
        telefonoCorrecto = /^[0-9]{9}$/g;
        hallado = $("#telefono").val().match(telefonoCorrecto);
        if (hallado) {
            // $("#email").css('border-color','#5cb85c')
            $("#paypal-button-container").css("display", "block")
        }
        else {
            // $("#email").css('border-color','red')
            $("#paypal-button-container").css("display", "none")
        }
    })

})