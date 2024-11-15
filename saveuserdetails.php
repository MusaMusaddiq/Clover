<?php 
    session_start();
    require ('connections.php');
    require_once('vendor/autoload.php');
    $client = new \GuzzleHttp\Client();

    if(isset($_POST['SaveUserdetails'])){
        $userdetails = [
            'FirstName' =>  !empty($_POST['FirstName']) ? $_POST['FirstName'] : '',
            'Lastname' =>  !empty($_POST['Lastname']) ? $_POST['Lastname'] : '',
            'Phone' =>  !empty($_POST['Phone']) ? $_POST['Phone'] : '',
            'Email' =>  !empty($_POST['Email']) ? $_POST['Email'] : '',
            'Address' =>  !empty($_POST['Address']) ? $_POST['Address'] : '',
            'City' =>  !empty($_POST['City']) ? $_POST['City'] : '',
            'State' =>  !empty($_POST['State']) ? $_POST['State'] : '',
            'Zip' =>  !empty($_POST['Zip']) ? $_POST['Zip'] : '',
            'ordernotes' =>  !empty($_POST['ordernotes']) ? $_POST['ordernotes'] : ''
        ];
        $_SESSION['UserDetails'] = $userdetails;
    }
        
    $response = $client->request('POST', "{$cloverApiEndPoint}{$merchantID}/customers", [
        'body' => json_encode([
            "firstName" => $_POST['FirstName'],
            "lastName" => $_POST['Lastname'],
            "emailAddresses" => [
                ["emailAddress" => $_POST['Email']]
            ],
            "phoneNumbers" => [
                ["phoneNumber" => $_POST['Phone']]
            ],
            "addresses" => [
                [
                    "address1" => $_POST['Address'],
                    "address2" => "",
                    "address3" => "",
                    "city" => $_POST['City'],
                    "country" => "us",
                    "state" => $_POST['State'],
                    "zip" => $_POST['Zip']
                ]
            ]
        ]),
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ],
    ]);
    

    $customerdata = json_decode($response->getBody());
    $_SESSION['CustomerId'] = $customerdata->id;
    header("Location:payment.php"); 
?>