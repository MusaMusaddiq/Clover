<?php 
session_start();

// Example usage
$action = $_GET['action'];  // 'add' or 'remove'
$itemId = $_GET['productID'];      // The ID of the item

function updateItemQuantity($itemId, $action) {
    // Check if the cart exists
    if (isset($_SESSION['cart'])) {
        // Loop through the cart to find the item by its ID
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productid'] == $itemId) {
                // If action is 'add', increment the quantity
                if ($action === 'add') {
                    $_SESSION['cart'][$key]['productqty'] += 1;
                    
                }
                // If action is 'remove', decrement the quantity
                elseif ($action === 'remove') {
                    if ($_SESSION['cart'][$key]['productqty'] > 1) {
                        $_SESSION['cart'][$key]['productqty'] -= 1;
                    } else {
                        // Optionally remove the item if quantity is 1 and action is 'remove'
                        unset($_SESSION['cart'][$key]);
                        // Reindex the array after removing the item
                        
                    }
                }

                // $productPrice = floatval($_SESSION['cart'][$key]['productprice']);
                // $modifierPrice = floatval($_SESSION['cart'][$key]['modifierprice']);
                // $productQty = intval($_SESSION['cart'][$key]['productqty']);
                
                $productPrice = floatval(str_replace('$', '', $_SESSION['cart'][$key]['productprice']));
                $modifierPrice = floatval($_SESSION['cart'][$key]['modifierprice']);
                $productQty = intval($_SESSION['cart'][$key]['productqty']);
                
                // Update the product total
                $_SESSION['cart'][$key]['producttotal'] =  ($productQty * $productPrice) + $modifierPrice;

                // $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }
}

// Update the item quantity based on the action
updateItemQuantity($itemId, $action);
header("Location:cart.php"); 



?>