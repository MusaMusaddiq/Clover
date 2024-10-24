<?php 
session_start();
print_r($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" href="img/pages/icon.png" type="image/png" />
	<title>Clover</title>

	<link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="vender/icofont/icofont.min.css" />
	<link rel="stylesheet" href="vender/aos/dist/aos.css" />
	<link rel="stylesheet" href="vender/remixicon/remixicon.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/common.css" />
</head>

<body>

	<?php include('loader.php')?>
	<div class="bg-homepage">
   <?php include('header.php') ?>
	

<h2>Your Cart</h2>

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Modifier Name</th>
                <th>Modifier Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            foreach($_SESSION['cart'] as $item): 
                $itemTotal = $item['producttotal']; 
                $grandTotal += $itemTotal;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['productname']); ?></td>
                <td><?php echo htmlspecialchars($item['productqty']); ?></td>
                <td>₹<?php echo htmlspecialchars(number_format($item['productprice'], 2)); ?></td>
                <td><?php echo htmlspecialchars($item['modifiername']); ?></td>
                <td>₹<?php echo htmlspecialchars(number_format($item['modifierprice'], 2)); ?></td>
                <td>₹<?php echo htmlspecialchars(number_format($itemTotal, 2)); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="cart-total">
        Grand Total: ₹<?php echo number_format($grandTotal, 2); ?>
    </div>

    <div class="checkout-btn">
        <button type="button" onclick="alert('Proceeding to Checkout')">Checkout</button>
    </div>

<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>


	<?php include('footer.php') ?>
	<?php include('sidenav.php') ?>

	<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content bg-transparent border-0 rounded-0">
				<div class="modal-header d-flex justify-content-end border-0 py-0">
					<a href="#" class="link-light" data-bs-dismiss="modal" aria-label="Close"><i
							class="ri-close-fill ri-2x"></i></a>
				</div>
				<div class="modal-body px-5">
					<div class="ratio ratio-16x9">
						<iframe src="../../../www.youtube.com/embed/gu-HhgJ7vfM_56a161f0.html"
							title="YouTube video player" frameborder="0"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
							allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vender/jquery/jquery-3.6.4.min.js"></script>
	<script src="vender/aos/dist/aos.js"></script>
	<script src="js/script.js"></script>
</body>

</html>


<div class="col-md-12 mt-3">
                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Addon Name</th>
                            <th>Addon Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grandTotal = 0;
                        foreach($_SESSION['cart'] as $item): 
                            $itemTotal = $item['producttotal']; 
                            $grandTotal += $itemTotal;
                        ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($item['productname']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($item['productqty']); ?>
                                <!-- <div class="input-group"> -->
                                <a href="itemqty.php?action=remove&productID=<?php echo $item['productid'] ?>"><button
                                        class="btn btn-outline-secondary" id="decrement-item-btn"
                                        type="button">-</button></a>
                                <a href="itemqty.php?action=add&productID=<?php echo $item['productid'] ?>"><button
                                        class="btn btn-outline-secondary" id="decrement-item-btn"
                                        type="button">+</button></a>
                                <!-- </div> -->
                            </td>
                            <td>
                                <?php echo $item['productprice']; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($item['modifiername']); ?>
                            </td>
                            <td>$
                                <?php echo htmlspecialchars(number_format($item['modifierprice'], 2)); ?>
                            </td>
                            <td>$
                                <?php echo htmlspecialchars(number_format($itemTotal, 2)); ?>
                            </td>
                            <td><a href="remove-item.php?productID=<?php echo $item['productid'] ?>"><i
                                        class="ri-delete-bin-6-fill text-danger"></i></a></td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-end"><b> Grand Total:</b></td>
                            <td><b>$
                                    <?php echo number_format($grandTotal, 2); ?>
                                </b></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>



                <div class="checkout-btn float-end">
                    <!-- <button type="button" onclick="alert('Proceeding to Checkout')">Checkout</button> -->
                    <a onclick="alert('Proceeding to Checkout')"
                        class="btn btn-success btn-lg rounded-0 aos-init aos-animate" data-aos="fade-up"
                        data-aos-duration="600">
                        Checkout
                    </a>
                </div>

                <?php else: ?>
                <div class="row">
                    <div class="col-md-2 mx-auto text-center">
                        <img src="img/nodata-icons/empty-cart.png" class="w-100">
                        <p class="mt-3">Your Cart is Empty.</p>
                        <a href="menu.php" class="btn btn-success btn-lg rounded-0 aos-init aos-animate"
                            data-aos="fade-up" data-aos-duration="600">
                            Shop Now
                        </a>
                    </div>
                </div>
                <?php endif; ?>

            </div>