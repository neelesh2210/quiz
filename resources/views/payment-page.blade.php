<!-- // Let's Click this button automatically when this page load using javascript -->
<!-- You can hide this button -->
<p>Please wait......</p>
<button id="rzp-button1" hidden>Pay</button>  
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
        "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "{{$response['currency']}}",
        "name": "{{$response['name']}}",
        "description": "{{$response['description']}}",
        "image": "https://example.com/your_logo", // You can give your logo url
        "order_id": "{{$response['orderId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "callback_url": "{{url('/payment-response')}}",
        "prefill": {
            "name": "{{$response['name']}}",
            "email": "{{$response['email']}}",
            "contact": "{{$response['contactNumber']}}"
        },
        "theme": {
            "color": "#F37254"
        },
        "modal": {
            "ondismiss": function () {
                window.location.replace("/");
            }
        }
    };
    var rzp1 = new Razorpay(options);
    window.onload = function () {
        document.getElementById('rzp-button1').click();
    };

    document.getElementById('rzp-button1').onclick = function (e) {
        rzp1.open();
        e.preventDefault();
    }
</script>
