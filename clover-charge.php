<?php
ob_start();
error_reporting(0);
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once('vendor/autoload.php');
require('connections.php');
$client = new \GuzzleHttp\Client();
$response = '';
$response1 = '';


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
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid4_key = generate_uuid_v4();
    $client_ip = get_client_ip();
    $payment_id = $_POST['cloverToken'];
    $authToken = $token;
    $PrintauthToken = $printToken;
    $FirstName = $_SESSION['UserDetails']['FirstName'];
    $Lastname = ' ' . $_SESSION['UserDetails']['Lastname'];
    $Address = $_SESSION['UserDetails']['Address'];
    $City = $_SESSION['UserDetails']['City'];
    $Country = 'US';
    $Phone = $_SESSION['UserDetails']['Phone'];
    $State = $_SESSION['UserDetails']['State'];
    $Zip = $_SESSION['UserDetails']['Zip'];
    $Email = $_SESSION['UserDetails']['Email'];


    // $CustomerID = $_SESSION['CustomerId'];
    $Clover_url = $orderApiEndPoint;
    $TipAmount = $_SESSION['tip']*100;

    $MID = $merchantID;
    
    

    $curl = curl_init();
    $totalProducts = array();
    $itemsTotal = 0;
    $PayableAmount = 0;
    $taxPer=700000;

    if (!empty($_SESSION['cart']) && count($_SESSION['cart']) >= 1) {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $priceInCents = str_replace('$', '', $_SESSION['cart'][$i]['productprice']);
            
            $Price = $priceInCents;
            $Qty = $_SESSION['cart'][$i]['productqty'];
            $TotalPrice = $Qty * $Price;

            $Taxinfo=array('name' =>'Clover Tax','rate'=>(int)($taxPer));
            $Product = array(
                'amount' => (float)$Price,
                'currency' => 'usd',
                'description' => $_SESSION['cart'][$i]['productname'],
                'inventory_id' => $_SESSION['cart'][$i]['productid'],
                'quantity' =>  $Qty,
                'tax_rates'=>[$Taxinfo]
            );

            $totalProducts[] = $Product;
        }
    }

    curl_setopt_array($curl, [
        CURLOPT_URL => $Clover_url . "/v1/orders",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'shipping' => [
                'address' => [
                    'city' => $City,
                    'country' => $Country,
                    'line1' => $Address,
                    'postal_code' => $Zip,
                    'state' => $State
                ],
                'name' => $FirstName . ' ' . $Lastname,
                'phone' => $Phone
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
        die(curl_error($ch1));
    }
    $responseData = json_decode($response, TRUE);
    $OrderID = $responseData['id'];

    
    $payableAmount = round($_SESSION['totalPayable']) ;

    $ch2 = curl_init();
    curl_setopt_array($ch2, [
        CURLOPT_URL => "{$Clover_url}/v1/orders/{$OrderID}/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'ecomind' => 'ecom',
            'customer' => $CustomerID,
            'amount' =>  $payableAmount,
            'currency' => 'usd',
            'source' => $payment_id,
            // 'tip_amount' => 20
            // 'tip_amount' => ((int)($TipAmount))
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
    $_SESSION['order_details'] = $response2;
    // try {
    //     $orderResult = json_decode($response2, TRUE);
    //     if ($orderResult['status'] == "paid" || $orderResult['status'] == "created") {
    //         $OrderPrintData = array(id => $OrderID);
    //         $CreateCustomerOrderPrint = array(
    //             orderRef => array($OrderPrintData)
    //         );
    //         $smartPrintData = array(event => 'PrintOrder', data => $OrderID);
    //         $printch = curl_init("{$printApiEndPoint}{$MID}/print_event");
    //         curl_setopt_array($printch, array(
    //             CURLOPT_POST => TRUE,
    //             CURLOPT_RETURNTRANSFER => TRUE,
    //             CURLOPT_HTTPHEADER => array(
    //                 'Authorization: Bearer ' . $PrintauthToken,
    //                 'Content-Type: application/json'
    //             ),
    //             CURLOPT_POSTFIELDS => '{"orderRef":{"id":"' . $OrderID . '"}}'
    //         ));
    //         $responseprint = curl_exec($printch);
    //         if ($responseprint === FALSE) {
    //             echo '<script>console.log(' . curl_error($printch) . ');</script>';
    //         }
    //     }
    // } catch (Exception $e) {
    // }

    echo $response2;
    // echo  $OrderID;
// }
?>
