<?php

session_start();
$id = $_GET['productID'];

function removeItemFromCart($pid){
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key =>$item){
            if($item['productid'] == $pid){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }
}

removeItemFromCart($id);


header("Location:cart.php"); 

?>