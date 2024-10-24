<?php
require ('connections.php');
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Clover API credentials (these should be secured, e.g., via environment variables)
    $mId = $merchantID;
    $bearerToken = $token;


    $url = "https://sandbox.dev.clover.com/v3/merchants/$mId/items/$productId?expand=modifierGroups";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $bearerToken",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    

    // // Check if modifier groups exist
    if (isset($data['modifierGroups']['elements'][0]['id'])) {
        $modifierGroupId = $data['modifierGroups']['elements'][0]['id'];

        // 2nd API call to get modifiers for the modifier group
        $modifierUrl = "https://apisandbox.dev.clover.com/v3/merchants/$mId/modifier_groups/$modifierGroupId/modifiers";

        $ch = curl_init($modifierUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $bearerToken",
            "Content-Type: application/json"
        ]);

        $modifierResponse = curl_exec($ch);
        curl_close($ch);

        $modifierData = json_decode($modifierResponse, true);
        // echo json_encode($modifierData,$data); 
        $combinedData = array(
            'modifierData' => $modifierData,
            'data' => $data
        );
        echo json_encode($combinedData);
    } else {
        // echo json_encode(['error' => 'No modifier groups found']);
        $combinedData = array(
            'modifierData' => [],
            'data' => $data
        );
        echo json_encode($combinedData);

    }
} else {
    echo json_encode(['error' => 'No product ID provided']);
}


// print_r($data);
    // echo json_encode($data);

    // 1st API Call to get the modifier groups for the item
    // $url = "https://sandbox.dev.clover.com/v3/merchants/$mId/items/$productId?expand=modifierGroups";

    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //     "Authorization: Bearer $bearerToken",
    //     "Content-Type: application/json"
    // ]);

    // $response = curl_exec($ch);
    // curl_close($ch);

    // $data = json_decode($response, true);