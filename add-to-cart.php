<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productid'])) {
    $productid = $_POST['productid'];
    $productname = $_POST['productname'] ?? 'Unknown Product';
    $productprice = $_POST['productprice'] ?? 0;
    $productqty = $_POST['productqty'] ?? 1;
    $modifierid = $_POST['modifierid'] ?? 0;
    $modifiername = $_POST['modifiername'] ?? 'No Addon';
    $modifierprice = $_POST['modifierprice'] ?? 0;
    $producttotal = $_POST['producttotal'] ?? 0;

    $product = [
        'productid' => $productid,
        'productname' => $productname,
        'productprice' => $productprice,
        'productqty' => $productqty,
        'modifierid' => $modifierid,
        'modifiername' => $modifiername,
        'modifierprice' => $modifierprice,
        'producttotal' => $producttotal
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['productid'] == $productid) {
            $item['modifierid'] += $modifierid;
            $item['modifiername'] = $modifiername; // Or append if needed
            $item['modifierprice'] += $modifierprice;
            $item['productqty'] += $productqty;
            $item['producttotal'] += $producttotal;
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $_SESSION['cart'][] = $product;
    }

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
    session_write_close();
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

?>