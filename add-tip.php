<?php
session_start();

if (isset($_POST['addTip'])) {
    $tip = $_POST['custom_tip'] ?? 0;
    $_SESSION['tip'] = $tip;
    header("Location: checkout.php");
    exit; 
} elseif (isset($_GET['tip_amount'])) {
    $tip = $_GET['tip_amount']; 
    $_SESSION['tip'] = $tip; 
    header("Location: cart.php");
    exit;
}elseif(isset($_POST['tip'])){
    $_SESSION['tip'] = $_POST['tip'];
    header("Location: cart.php");
}
