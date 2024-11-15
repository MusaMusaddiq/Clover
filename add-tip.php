<?php 
session_start();

$tip = $_GET['tip_amount'];
$_SESSION['tip'] = $tip;

// echo $_SESSION['tip'];

// header("Location:checkout.php"); 
header("Location:cart.php"); 
?>