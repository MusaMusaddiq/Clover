<?php 
session_start();
$grandTotal = 0;
$tax = 0;
$taxpercentage = 7;
$tip = 7;


if(isset($_SESSION['cart']) &&  count($_SESSION['cart']) > 0){
    foreach($_SESSION['cart'] as $item){
        $itemTotal = $item['producttotal']; 
        $grandTotal += $itemTotal;
        $tax += ($itemTotal*$taxpercentage)/(100);
    } 
} 

$total = $grandTotal + $tax + $tip;


?>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/pages/icon.png" type="image/png">
    <title>Clover Cart</title>
    <link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vender/icofont/icofont.min.css">
    <link rel="stylesheet" href="vender/aos/dist/aos.css">
    <link rel="stylesheet" href="vender/remixicon/remixicon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/common.css">
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">



    <?php include('loader.php')?>
    <div class="bg-menu">

        <?php include('header.php') ?>

        <div class="container py-5 my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="text-center text-white">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex align-items-center justify-content-center gap-1"
                                data-aos="fade-up" data-aos-duration="600">
                                <li class="breadcrumb-item text-white small"><a href="#" class="link-light">HOME
                                    </a></li>
                                <li><i class="ri-arrow-right-s-line"></i></li>
                                <li class="breadcrumb-item text-white small active" aria-current="page">Payment </li>
                            </ol>
                        </nav>
                        <h1 class="display-1" data-aos="fade-up" data-aos-duration="600">Payment</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container pb-5">
        <div class="row g-4">

            <?php include('order-details.php'); ?>

            <div class="col-lg-6 col-12">
                <h4 class="fw-bold pb-2">Payment Details </h4>
              

                <form action="/charge" method="post" id="payment-form">
                    <div style="background: white;" id="farpaysuc"></div>
                    <div class="form-row top-row">
                        <div id="payment-request-button" class="payment-request-button full-width"></div>
                    </div>
                    <img src="img/we-use.png">
                    <div class="form-row top-row">
                        <div id="card-number" class="field full-width"></div>
                        <div class="input-errors" id="card-number-errors" role="alert"></div>
                    </div>

                    <div class="form-row">
                        <div id="card-date" class="field third-width"></div>
                        <div class="input-errors" id="card-date-errors" role="alert"></div>
                    </div>

                    <div class="form-row">
                        <div id="card-cvv" class="field third-width"></div>
                        <div class="input-errors" id="card-cvv-errors" role="alert"></div>
                    </div>

                    <div class="form-row">
                        <div id="card-postal-code" class="field third-width"></div>
                        <div class="input-errors" id="card-postal-code-errors" role="alert"></div>
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>


                    <!-- Testing -->
                    <div id="card-response" role="alert"></div>
                    <div class="button-container">
                        <button>Submit Payment </button>
                    </div>
                </form>



            </div>

        </div>
    </div>


    <?php include('footer.php') ?>
    <?php include('sidenav.php') ?>

    <script>
        const clover = new Clover('0540a9cd140f0ad0f7e93dd59133ec0b');
        const elements = clover.elements();
        const styles = {
            body: {
                fontFamily: 'Roboto, Open Sans, sans-serif',
                fontSize: '16px',
            },
            input: {
                fontSize: '16px',
            },
        };
        const cardNumber = elements.create('CARD_NUMBER', styles);
        const cardDate = elements.create('CARD_DATE', styles);
        const cardCvv = elements.create('CARD_CVV', styles);
        const cardPostalCode = elements.create('CARD_POSTAL_CODE', styles);

        cardNumber.mount('#card-number');
        cardDate.mount('#card-date');
        cardCvv.mount('#card-cvv');
        cardPostalCode.mount('#card-postal-code');

        const cardResponse = document.getElementById('card-response');
        const displayCardNumberError = document.getElementById('card-number-errors');
        const displayCardDateError = document.getElementById('card-date-errors');
        const displayCardCvvError = document.getElementById('card-cvv-errors');
        const displayCardPostalCodeError = document.getElementById('card-postal-code-errors');

        cardNumber.addEventListener('change', function (event) {
            console.log(`cardNumber changed ${JSON.stringify(event)}`);
        });

        cardNumber.addEventListener('blur', function (event) {
            console.log(`cardNumber blur ${JSON.stringify(event)}`);
        });

        cardDate.addEventListener('change', function (event) {
            console.log(`cardDate changed ${JSON.stringify(event)}`);
        });

        cardDate.addEventListener('blur', function (event) {
            console.log(`cardDate blur ${JSON.stringify(event)}`);
        });

        cardCvv.addEventListener('change', function (event) {
            console.log(`cardCvv changed ${JSON.stringify(event)}`);
        });

        cardCvv.addEventListener('blur', function (event) {
            console.log(`cardCvv blur ${JSON.stringify(event)}`);
        });

        cardPostalCode.addEventListener('change', function (event) {
            console.log(`cardPostalCode changed ${JSON.stringify(event)}`);
        });

        cardPostalCode.addEventListener('blur', function (event) {
            console.log(`cardPostalCode blur ${JSON.stringify(event)}`);
        });

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            document.getElementById('farpaysuc').innerHTML = "<img src='processing.gif' class='pro' id='farpaysuc'>";
            event.preventDefault();
            clover.createToken()
                .then(function (result) {
                    if (result.errors) {
                        alert(result.errors.CARD_NUMBER);
                        window.location.reload();
                        Object.values(result.errors).forEach(function (value) {
                            console.log(value);
                        });
                    } else {
                        if (result && result.token) {
                            var form = document.getElementById('payment-form');
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'cloverToken');
                            hiddenInput.setAttribute('value', result.token);
                            form.appendChild(hiddenInput);

                            let formData = new FormData(form);
                            fetch('clover-charge.php', {
                                method: 'POST',
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status == "paid") {
                                        window.location.href = 'order-mail.php';
                                    } else {
                                        alert('Invalid details');
                                        window.location.reload();
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred: ' + error);
                                });
                        } else {
                            alert('You entered invalid details');
                        }
                    }
                }).catch(function (data) {
                    console.log(data);
                });
        });

        // let total = parseFloat("<?php echo $_SESSION['total']; ?>");
        let paymentAmount = (parseFloat(total.toFixed(2)) * 100).toFixed(0);

        const paymentReqData = {
            country: 'US',
            currency: 'usd',
            total: {
                label: 'total',
                amount: paymentAmount,
            },
            requestPayerName: true,
            requestPayerEmail: true,
        };

        const paymentRequest = clover.paymentRequest(paymentReqData);
        const paymentRequestButton = elements.create('PAYMENT_REQUEST_BUTTON', {
            paymentReqData
        });

        paymentRequest.canMakePayment().then(function (result) {
            if (result) {
                paymentRequestButton.mount('#payment-request-button');
            } else {
                document.getElementById('payment-request-button').style.display = 'none';
            }
        });

        paymentRequestButton.addEventListener('paymentMethod', function (ev) {
            alert(JSON.stringify(ev));
        });

        function cloverTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'cloverToken');
            hiddenInput.setAttribute('value', token);
            form.appendChild(hiddenInput);

            event.preventDefault();
        }

    </script>

    <script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vender/jquery/jquery-3.6.4.min.js"></script>
    <script src="vender/aos/dist/aos.js"></script>
    <script src="js/script.js"></script>
    <button id="back-to-top" title="Go to top" style="display: none;">Top</button>


</body>

</html>