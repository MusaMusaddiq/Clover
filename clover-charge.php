<?php
ob_start();
error_reporting(0);
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once('vendor/autoload.php');

require ('connections.php');
$client = new \GuzzleHttp\Client();

$response = '';
$response1 = '';
$CustomerID = 0;



$response = $client->request('POST', 'https://sandbox.dev.clover.com/v3/merchants/'. $merchantID .'/customers', [
    'body' => '{"firstName":"James","lastName":"Bond","emailAddresses":[{"emailAddress":"james@gmail.com"}],"phoneNumbers":[{"phoneNumber":"654987987987"}],"addresses":[{"address1":"A1","address2":"A2","address3":"A3","city":"hyderabad","country":"India","state":"Telangana","zip":"500042"}]}',
    'headers' => [
      'accept' => 'application/json',
      'content-type' => 'application/json',
    ],
]);

  



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








if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid4_key = generate_uuid_v4();
    $client_ip = get_client_ip();
    $payment_id = $_POST['cloverToken'];
    $authToken = $token;
    $PrintauthToken = '8cd0a5b7-512d-23dd-8d89-f6e2415024b5';
    $FirstName = $_SESSION['UserDetails']['FirstName'];
    $Lastname = ' ' . $_SESSION['UserDetails']['Lastname'];
    $Address = $_SESSION['UserDetails']['address'];
    $City = $_SESSION['UserDetails']['City'];
    $country ='US';
    $phone = $_SESSION['UserDetails']['pnumber'];
    $State = $_SESSION['UserDetails']['State'];
    $zip = $_SESSION['UserDetails']['Zip'];
    $Email = $_SESSION['UserDetails']['email'];
    // $Clover_url = "https://scl.clover.com";
    $Clover_url = "https://sandbox.dev.clover.com/v3/merchants/";
    $TipAmount = $_SESSION['tip'];
    $TaxAmount = $_SESSION['tax'];
    $MID = $merchantID;
    $TotalWithTip = $_SESSION['total'];
    $TotalWothoutTip = $TotalWithTip - $TipAmount;
    $paymentAmount = round($TotalWothoutTip, 2) * 100;
    $TotalAmount = $paymentAmount;
    $taxPer = 700000;
    $curl = curl_init();
    $totalProducts = [];

    if ($_SESSION['cart'] >= 1) {
        for ($i = 1; $i <= $_SESSION['cart']; $i++) {
            $Price = $_SESSION['cart'][$i]['productprice'];
            $Qty = $_SESSION['cart'][$i]['productqty'];
            $TotalPrice = $Qty * $Price;
            $Taxinfo = [
                'name' => 'Clover order sales tax',
                'rate' => (int)$taxPer
            ];
            $Product = [
                'amount' => (float)$Price,
                'currency' => 'usd',
                'description' => $_SESSION['cart'][$i]['productname'],
                'inventory_id' => $_SESSION['cart'][$i]['productid'],
                'quantity' => (int)$_SESSION['cart'][$i]['productqty'],
                'tax_rates' => [$Taxinfo]
            ];
            array_push($totalProducts, $Product);
        }
    }

    curl_setopt_array($curl, [
        CURLOPT_URL => $Clover_url . "/v3/orders",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'shipping' => [
                'address' => [
                    'City' => $City,
                    'country' => $country,
                    'line1' => $Address,
                    'postal_code' => $zip,
                    'State' => $State
                ],
                'name' => $FirstName . ' ' . $Lastname,
                'phone' => $phone
            ],
            'currency' => 'usd',
            'email' => $Email,
            'items' => $totalProducts
        ]),
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            'Authorization: Bearer ' . $authToken,
            "content-type: application/json"
        ]
    ]);

    $response = curl_exec($curl);
    
    if ($response === FALSE) {
        die(curl_error($curl));
    }

    $responseData = json_decode($response, TRUE);
    $OrderID = $responseData['id'];
    
    $ch2 = curl_init();
    curl_setopt_array($ch2, [
        CURLOPT_URL => $Clover_url . "/v1/orders/" . $OrderID . "/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'ecomind' => 'ecom',
            'customer' => $CustomerID,
            'amount' => $TotalAmount,
            'currency' => 'usd',
            'source' => $payment_id,
            'tip_amount' => (int)($TipAmount * 100)
        ]),
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            'Authorization: Bearer ' . $authToken,
            "content-type: application/json",
            'idempotency-key: ' . $uuid4_key,
            "x-forwarded-for: " . $client_ip
        ]
    ]);

    $response2 = curl_exec($ch2);

    try {
        $orderResult = json_decode($response2, TRUE);
        if ($orderResult['status'] == "paid") {
            $OrderPrintData = ['id' => $OrderID];
            $smartPrintData = ['event' => 'PrintOrder', 'data' => $OrderID];

            $printch = curl_init('https://api.clover.com/v3/merchants/' . $MID . '/print_event');
            curl_setopt_array($printch, [
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $PrintauthToken,
                    'Content-Type: application/json'
                ],
                CURLOPT_POSTFIELDS => '{"orderRef":{"id":"' . $OrderID . '"}}'
            ]);

            $responseprint = curl_exec($printch);
            if ($responseprint === FALSE) {
                echo '<script>console.log(' . curl_error($printch) . ');</script>';
            }
        }
    } catch (Exception $e) {
    }

    echo $response2;
}
?>
