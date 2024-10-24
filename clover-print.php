<?php
ob_start();
error_reporting(0);
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$PrintauthToken='8cd0a5b7-512d-23dd-8d89-f6e2415024b5';
$MID='9PFC0YZA2RNC1';
$OrderID='JZMPMYSTPB0P6';

$printch=curl_init('https://api.clover.com/v3/merchants/'.$MID.'/print_event');
curl_setopt_array($printch,[
    CURLOPT_POST=>TRUE,
    CURLOPT_RETURNTRANSFER=>TRUE,
    CURLOPT_HTTPHEADER=>[
        'Authorization: Bearer '.$PrintauthToken,
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS=>'{"orderRef":{"id":"'.$OrderID.'"}}'
]);

$responseprint=curl_exec($printch);
echo $responseprint;
?>
