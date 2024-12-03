<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AZyh8cZJWmKoxS4ZR9HfrkSHWakT_bYoCEFrSDp5ADUT_u_4rxgLkjUAbk-OYvNGNVw4IK76M8RkT_uZ&currency=MXN"></script>
</head>
<body>
    <div id="paypal-button-container"></div>
    
    <script>
        paypal.Buttons({
            style: {
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 100
                        }
                    }]
                });
            },

            onApprove: function(data, actions){
                actions.order.capture().then(function(detalles){
                    console.log(detalles);
                    window.location.href = "ventah.php";
                });
            },

            onCancel: function(data){
                alert("Pago Cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>