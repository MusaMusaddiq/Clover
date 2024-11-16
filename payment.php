<?php 

session_start();
require_once('vendor/autoload.php');
require ('connections.php');

$client = new \GuzzleHttp\Client();

// fetch taxes
$response = $client->request('GET', "{$cloverApiEndPoint}{$merchantID}/tax_rates", [
	'headers' => [
	  'accept' => 'application/json',
	  'authorization' => 'Bearer ' . $token,
	],
]);

$data = json_decode($response->getBody(), true);

$defaultTaxRate = array_filter($data['elements'], function ($element) {
    // return $element['isDefault'] === true;
    return $element['rate'] > 0;
});


if (!empty($defaultTaxRate)) {
    $defaultTaxRate = array_values($defaultTaxRate)[0]; // Get the first matching element
    $name = $defaultTaxRate['name'];
    $rate = $defaultTaxRate['rate'];
    $_SESSION['taxname'] = $name;
    $_SESSION['taxrate'] = $rate;
} else {
    $_SESSION['taxname'] = "";
    $_SESSION['taxrate'] = 0;
}
$grandTotal = 0;
$tax = 0;
$taxpercentage = 0;
$tip = $_SESSION['tip']*100;
// $tip = 0;

if(isset($_SESSION['cart']) &&  count($_SESSION['cart']) > 0){
    foreach($_SESSION['cart'] as $item){
        $itemTotal = $item['producttotal']; 
        $grandTotal += $itemTotal;
        // $tax += $itemTotal;
        // $tax += ($itemTotal*$taxpercentage)/(100);
    } 
} 


$rate = ($_SESSION['taxrate']/100000);
$tax = (($grandTotal*100)*($rate/100));
$total = ($grandTotal*100) + $tax + $tip;

$_SESSION['totalPayable'] = $total;

// echo $_SESSION['totalPayable'];
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
    <script src="https://checkout.sandbox.dev.clover.com/sdk.js"></script>

    <style>
    /* shamsheer */
    
.payment-container {
  background-color: #FFFFFF;
  /* border-top-left-radius: 15px;
  border-top-right-radius: 15px; */
  box-shadow: 0 0 6px 0 rgba(141,151,158,0.2);
  padding: 0px 20px;
  width: 100%;
  
}
.clover-footer{
  display:none
}

.payment-container * {
  font-family: Roboto, "Open Sans", sans-serif;
  font-size: 16px;
}

.payment-container .form-row {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;
}

.payment-container .form-row.top-row {
  margin-top: 16px;
}

.input-errors {
  font-size: 12px;
  position: absolute;
  margin-left: 5px;
  margin-top: 54px;
  color: red;
}

.payment-container .form-row .field {
  box-sizing: border-box;
  border: 1px solid #DEE0E1;
  border-radius: 5px;
  height: 55px;
  margin-bottom: 30px;
  padding: 14px;
  width: 100%;
}

.payment-container .button-container {
  display: flex;
  flex-direction: row;
  justify-content: center;
}

.payment-container .button-container button {
  background-color: #228800;
  border: none;
  border-radius: 3px;
  color: #FFFFFF;
  display: block;
  height: 47px;
  width: 300px;
  cursor: pointer;
}
.user{
  width: 100%;
  margin-bottom: 0;
}

.pro{
    width: 98%;
    position: absolute;
    display: block;
    z-index: 999;
    text-align: center;
    margin-right: auto;
    background: white;
    margin-left: -20px;
    margin-top: 50px;
}

@media screen and (max-width: 767px) {
    .pro{
            margin-top: 52px;
    height: 387px;
    }
}

#payment-request-button {
  width: 160px;
  height: 40px;
  margin: 0 auto;
  display: none;
}


  
  .payment-container {
    height: 500px;
  }


  
 


.hr {
  width: 100%; 
  height: 10px; 
  border-bottom: 1px solid black; 
  text-align: center;
  margin: 20px 0;
}

.hr span {
  font-size: 10px; 
  background-color: #FFF; 
  padding: 0 10px;
}
.offer-section:after {
    content: "";
    background-image: url(assets/images/section-shape-img1.png);
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -ms-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 0px;
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 9;
}
    </style>

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

        <!-- <a href="tests.php"><button class="btn btn-primary">test</button></a> -->

            <?php include('order-details.php'); ?>

            <div class="col-lg-6 col-12">
                <h4 class="fw-bold pb-2">Payment Details </h4>
              

                <div class="payment-container">
                <form action="/charge" method="post" id="payment-form">
                    <div style="background: white;" id="farpaysuc"></div>
                    <div class="form-row top-row">
                        <div id="payment-request-button" class="payment-request-button full-width"></div>
                    </div>
                    <!-- <img src="img/we-use.png"> -->
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
    </div>


    <?php include('footer.php') ?>
    <?php include('sidenav.php') ?>

    <script>
        debugger;
        const clover = new Clover('0ee66f639232cceffd3f72808ab1a017');
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
        debugger;
        const cardNumber = elements.create('CARD_NUMBER', styles);
        const cardDate = elements.create('CARD_DATE', styles);
        const cardCvv = elements.create('CARD_CVV', styles);
        const cardPostalCode = elements.create('CARD_POSTAL_CODE', styles);
        debugger;
        cardNumber.mount('#card-number');
        cardDate.mount('#card-date');
        cardCvv.mount('#card-cvv');
        cardPostalCode.mount('#card-postal-code');
        debugger;
        const cardResponse = document.getElementById('card-response');
        const displayCardNumberError = document.getElementById('card-number-errors');
        const displayCardDateError = document.getElementById('card-date-errors');
        const displayCardCvvError = document.getElementById('card-cvv-errors');
        const displayCardPostalCodeError = document.getElementById('card-postal-code-errors');
        debugger;
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
        debugger;
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            debugger;
            document.getElementById('farpaysuc').innerHTML = "<img src='processing.gif' class='pro' id='farpaysuc'>";
            event.preventDefault();
            clover.createToken()
                .then(function (result) {
                    debugger;
                    if (result.errors) {
                        debugger;
                        alert(result.errors.CARD_NUMBER);
                        window.location.reload();
                        Object.values(result.errors).forEach(function (value) {
                            console.log(value);
                        });
                        debugger;
                    } else {
                        debugger;
                        if (result && result.token) {
                            debugger;
                            var form = document.getElementById('payment-form');
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'cloverToken');
                            hiddenInput.setAttribute('value', result.token);
                            form.appendChild(hiddenInput);
                            console.log('result.token', result.token);
                            let formData = new FormData(form);
                            debugger;
                            fetch('clover-charge.php', {
                                method: 'POST',
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    debugger;
                                    console.log('data',data);
                                    if (data.status == "paid" || data.status == "created") {
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

        let dollars  = parseFloat("<?php echo $total; ?>");
         const cents = Math.round(dollars )
        let paymentAmount = cents ;
        console.log('paymentTotal',paymentAmount);
        debugger;
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
        debugger;
        const paymentRequest = clover.paymentRequest(paymentReqData);
        const paymentRequestButton = elements.create('PAYMENT_REQUEST_BUTTON', {
            paymentReqData
        });
        debugger;
        paymentRequest.canMakePayment().then(function (result) {
            if (result) {
                paymentRequestButton.mount('#payment-request-button');
            } else {
                document.getElementById('payment-request-button').style.display = 'none';
            }
        });
        debugger;
        paymentRequestButton.addEventListener('paymentMethod', function (ev) {
            alert(JSON.stringify(ev));
        });
        debugger;
        function cloverTokenHandler(token) {
            debugger;
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'cloverToken');
            hiddenInput.setAttribute('value', token);
            form.appendChild(hiddenInput);
            debugger;
            console.log('payment Token',token);
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