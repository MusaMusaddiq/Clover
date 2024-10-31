<?php
// ob_start();
// error_reporting(0);
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once('vendor/autoload.php');

require ('connections.php');
$client = new \GuzzleHttp\Client();

$response = '';
$response1 = '';
$CustomerID = "9C7JY6FNR5V76";





function get_client_ip() {
    if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'UNKNOWN';
}

function generate_uuid_v4() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff),
        mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}


$uuid4_key = generate_uuid_v4();
$client_ip = get_client_ip();
// $payment_id = $_POST['cloverToken'];
$authToken = $token;
// $PrintauthToken = '8cd0a5b7-512d-23dd-8d89-f6e2415024b5';
$PrintauthToken = 'e2b7b646-e861-aae4-e293-c3e3fe3283a8';
$FirstName = $_SESSION['UserDetails']['FirstName'];
$Lastname = ' ' . $_SESSION['UserDetails']['Lastname'];
$Address = $_SESSION['UserDetails']['Address'];
$City = $_SESSION['UserDetails']['City'];
$country ='US';
$phone = $_SESSION['UserDetails']['Phone'];
$State = $_SESSION['UserDetails']['State'];
$zip = $_SESSION['UserDetails']['Zip'];
$Email = $_SESSION['UserDetails']['Email'];
// $Clover_url = "https://scl.clover.com";
// $Clover_url = "https://sandbox.dev.clover.com/v3/merchants/";
$Clover_url = "https://scl-sandbox.dev.clover.com";
// $TipAmount = $_SESSION['tip'];
// $TaxAmount = $_SESSION['tax'];
$TipAmount = 84;
$TaxAmount = 14;
$MID = $merchantID;
// $TotalWithTip = $_SESSION['total'];
$TotalWithTip = 999;
$TotalWothoutTip = $TotalWithTip - $TipAmount;
$paymentAmount = round($TotalWothoutTip, 2) * 100;
$TotalAmount = $paymentAmount;
$taxPer = 700000;
$curl = curl_init();
$totalProducts = [];

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if (isset($_SESSION['cart'][$i])) { // Check if the index exists in the cart
            $Price = 99; // Cast to float if necessary
            $Qty = (int)$_SESSION['cart'][$i]['productqty']; // Cast to integer
            $TotalPrice = $Qty * $Price; // Now this should work without errors
            $Taxinfo = [
                'name' => 'Clover order sales tax',
                'rate' => (int)$taxPer
            ];
            $Product = [
                'amount' => $Price,
                'currency' => 'usd',
                'description' => $_SESSION['cart'][$i]['productname'],
                'inventory_id' => $_SESSION['cart'][$i]['productid'],
                'quantity' => $Qty,
                'tax_rates' => [$Taxinfo]
            ];
            array_push($totalProducts, $Product);
        }
    }
}


$body = [
    'shipping' => [
        'address' => [
            'city' => $City,
            'country' => $country,
            'line1' => $Address,
            'postal_code' => $zip,
            'state' => $State
        ],
        'name' => $FirstName . ' ' . $Lastname,
        'phone' =>  $phone
    ],
    'currency' => 'USD',
    'email' => $Email,
    'items' => $totalProducts 
];


$jsonBody = json_encode($body);
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sandbox.dev.clover.com/v3/merchants/'.$merchantID.'/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonBody,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $authToken
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $responseData = json_decode($response, true);
  $OrderID =  $responseData['id'];


  $TipAmount = $_SESSION['tip'];
    $TaxAmount = $_SESSION['tax'];
    $MID = $merchantID;
    $TotalWithTip = $_SESSION['total'];
    $TotalWothoutTip = $TotalWithTip - $TipAmount;
    $paymentAmount = round($TotalWothoutTip, 2) * 100;
    $TotalAmount = $paymentAmount;

    echo $TotalAmount;

// echo $OrderID;








?>