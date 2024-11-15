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

// echo $total;
// echo $grandTotal;
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
                                <li class="breadcrumb-item text-white small active" aria-current="page">MENU </li>
                            </ol>
                        </nav>
                        <h1 class="display-1" data-aos="fade-up" data-aos-duration="600">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container pb-5">
        <div class="row g-4">
        
        

        <?php include('order-details.php'); ?>

            <div class="col-lg-6 col-12">
                <h4 class="fw-bold pb-2">Your Details </h4>
                <form class="row g-3" action="saveuserdetails.php"  method="post" id="SaveUserdetails" >
                    <div class="col-md-6">
                        <label for="inputFirstName" class="form-label small text-muted">First Name</label>
                        <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo isset($_SESSION['UserDetails']['FirstName']) ? $_SESSION['UserDetails']['FirstName'] : ''; ?>" placeholder="First name"  required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputLastname" class="form-label small text-muted">Last Name</label>
                        <input type="text" class="form-control" id="Lastname" name="Lastname" value="<?php echo isset($_SESSION['UserDetails']['Lastname']) ? $_SESSION['UserDetails']['Lastname'] : ''; ?>" placeholder="Last name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputphone" class="form-label small text-muted">Phone</label>
                        <input type="text" class="form-control" id="phone" name="Phone" value="<?php echo isset($_SESSION['UserDetails']['Phone']) ? $_SESSION['UserDetails']['Phone'] : ''; ?>" placeholder="Phone number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label small text-muted">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email"  value="<?php echo isset($_SESSION['UserDetails']['Email']) ? $_SESSION['UserDetails']['Email'] : ''; ?>" placeholder="Email address" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputAddress" class="form-label small text-muted">Address</label>
                        <input type="text" class="form-control" id="Address" name="Address" value="<?php echo isset($_SESSION['UserDetails']['Address']) ? $_SESSION['UserDetails']['Address'] : ''; ?>" placeholder="Address" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label small text-muted">City</label>
                        <input type="text" class="form-control" id="City" name="City" value="<?php echo isset($_SESSION['UserDetails']['City']) ? $_SESSION['UserDetails']['City'] : ''; ?>" placeholder="City" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label small text-muted">State</label>
                        <input type="text" class="form-control" id="State" name="State" value="<?php echo isset($_SESSION['UserDetails']['State']) ? $_SESSION['UserDetails']['State'] : ''; ?>" placeholder="State" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label small text-muted">Zip</label>
                        <input type="text" class="form-control" id="Zip" name="Zip" value="<?php echo isset($_SESSION['UserDetails']['Zip']) ? $_SESSION['UserDetails']['Zip'] : ''; ?>" placeholder="Zip code" required>
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlTextarea1" class="form-label small text-muted">Order notes (optional)</label>
                        <textarea class="form-control" id="ordernotes" name="ordernotes" value="<?php echo isset($_SESSION['UserDetails']['ordernotes']) ? $_SESSION['UserDetails']['ordernotes'] : ''; ?>" placeholder="Note about your order" rows="5"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="SaveUserdetails" class="btn btn-purple px-3 py-3 w-100">Payment</button>
                    </div>
                </form>

            </div>
            
        </div>
    </div>


    <?php include('footer.php') ?>
    <?php include('sidenav.php') ?>

    <script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vender/jquery/jquery-3.6.4.min.js"></script>
    <script src="vender/aos/dist/aos.js"></script>
    <script src="js/script.js"></script>
    <button id="back-to-top" title="Go to top" style="display: none;">Top</button>


</body>

</html>