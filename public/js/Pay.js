paypal.Buttons({
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '{{ Cart::session(auth()->id())->getTotal() }}'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            alert('Transaction completed by ' + details.payer.name.given_name)
            $("#form").submit();
        });
    }
}).render('#paypal-button-container'); // Display payment options on your web page