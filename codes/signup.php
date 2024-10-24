<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://sandbox.dev.clover.com/v3/merchants/2HAV1DN8NYK11/customers', [
  'body' => '{"firstName":"Abdul","lastName":"Siddiq","phoneNumbers":[{"phoneNumber":"9676620886"}],"emailAddresses":[{"emailAddress":"abdulsiddiq1234@gmail.com","primaryEmail":true}]}',
  'headers' => [
    'accept' => 'application/json',
    'authorization' => 'Bearer e2b7b646-e861-aae4-e293-c3e3fe3283a8',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();