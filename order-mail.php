<?php 
session_start();
print_r($_SESSION['order_details']);

$order_details = json_decode($_SESSION['order_details']);

$Email = $_SESSION['UserDetails']['Email'];
$subject = "Your Order " . $order_details->id ."";
$order_id = $order_details->id;
$PickupDateTime = "";
$PickupLocation = "";

$message = '
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: #f2f2f2; border-radius: 8px;">
    <div class="header" style="text-align: center; padding-bottom: 20px;">
        <h2 style="color: #007bff;">Thank You for Your Order, ' . $_POST['Name'] . '!</h2>
    </div>
    <div class="content" style="margin-bottom: 20px;">
        <p>Hi ' . $_SESSION['UserDetails']['FirstName'] . ' ' . $_SESSION['UserDetails']['LastName'] . ',</p>
        <p>Thank you for your order! We\'re excited to get your items ready for you. Here are the details of your order:</p>
        <ul style="list-style-type: none; padding-left: 0;">
            <li><strong>Pickup Date & Time:</strong> ' . $PickupDateTime . '</li>
            <li><strong>Pickup Location:</strong> ' . $PickupLocation . '</li>
        </ul>
        <p>You can track your order status using the link below:</p>
        <a href="' . $receiptLink . $order_details->id . '" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px;">Track Your Order</a>
    </div>
    <div class="footer" style="text-align: center; padding-top: 20px; color: #777;">
        <p>If you have any questions or need to make changes to your order, feel free to contact us. We look forward to seeing you soon!</p>
        <p>Best regards,<br>'.' '.$businessName.'</p>
    </div>
</div>
';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$abc= substr($_SESSION['UserDetails']['FirstName'],0,8);
$headers .= 'From: '.$Email.  "\r\n";
mail($to, $subject, $message, $headers);

$_SESSION['UserDetails'] = "";
$_SESSION['cart'] = "";
$_SESSION['order_details'] = "";

header("Location: thank-you.php?orderid=" . $order_id);
exit();
?>