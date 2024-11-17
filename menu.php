<?php 
session_start();
require_once('vendor/autoload.php');
require ('connections.php');

$client = new \GuzzleHttp\Client();


// Fetch categories
$response = $client->request('GET', "{$cloverApiEndPoint}{$merchantID}/categories", [
    'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Bearer ' . $token,
    ],
]);

$menu_categories = json_decode($response->getBody());

foreach ($menu_categories->elements as &$category) { 
    $category_id = $category->id;

    // Fetch items for each category
    $response = $client->request('GET', "{$cloverApiEndPoint}{$merchantID}/categories/{$category_id}/items", [
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $token,
        ],
    ]);
    $category_items = json_decode($response->getBody());
    $category->Product = $category_items->elements;
    
}

// print_r($menu_categories->elements);

?>



<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" href="img/pages/icon.png" type="image/png" />
	<title>Menu Clover</title>

	<link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="vender/icofont/icofont.min.css" />
	<link rel="stylesheet" href="vender/aos/dist/aos.css" />
	<link rel="stylesheet" href="vender/remixicon/remixicon.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/common.css" />
</head>

<body>


	<?php include('loader.php')?>
	<div class="bg-menu">

		<?php include('header.php') ?>

		<div class="container py-5 my-5">
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="text-center text-white">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb d-flex align-items-center justify-content-center gap-1"
									data-aos="fade-up" data-aos-duration="600">
									<li class="breadcrumb-item text-white small"><a href="#" class="link-light">HOME
										</a></li>
									<li><i class="ri-arrow-right-s-line"></i></li>
									<li class="breadcrumb-item text-white small active" aria-current="page">MENU </li>
								</ol>
							</nav>
							<h1 class="display-1" data-aos="fade-up" data-aos-duration="600">MENU </h1>
						</div>
					</div>
				</div>
			</div>
		</div>


	<?php
		$i=0;
		$totalCount = count($menu_categories->elements);
		while($i < $totalCount){
				$element = $menu_categories->elements[$i];
			?>
	<div class="container py-5">
		<div class="row mb-5">
			<div class="col-12">
				<div class="card text-bg-dark border-0 rounded-0">
					<img src="img/menu-img/menu-page-image-1.jpg" class="card-img opacity-25" alt="started" />
					<div class="card-img-overlay d-flex align-items-center p-5">
						<div class="mt-auto">
							<h1 class="card-title pb-2 fw-bold" data-aos="fade-up" data-aos-duration="600">
								<?php echo $element->name ?>
							</h1>
							<p class="card-text lead fw-normal mb-0" data-aos="fade-up" data-aos-duration="700">
								Aliquam faucibusodio nec commodo , neque felis <br />
								placerat dui, a porta lectus dapibus est.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row g-4 g-md-5">

			<?php
						$j=0;
						$cnt = count($element->Product);
						while($j < $cnt){
								$prod = $element->Product[$j];
							?>
			<div class="col-lg-6 col-12" data-aos="fade-right" data-aos-duration="500">
				<div class="d-flex align-items-center justify-content-between gap-3 w-100">
					<h3 class="flex-shrink-0">
						<?php echo $prod->name ?> - $
						<?php echo $prod->price/100 ?>
					</h3>
					<hr class="w-100" />
					<a data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-light add-to_cart cp"
						data-product-id="<?php echo $prod->id; ?>">Add To Cart</a>
				</div>
				<!-- <p class="text-secondary-emphasis mb-0">Maecenas interdum lorem eleifend aliquam mollis. </p> -->
			</div>
			<?php  $j++;
							}
						?>
		</div>
	</div>
	<?php  $i++;
		}
	?>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
					<!-- <button type="button" class="close" >
						<span aria-hidden="true">&times;</span>
						</button> -->
					<a data-bs-dismiss="modal" aria-label="Close" href="!#"><i
							class="ri-close-circle-line f-20 text-dark"></i></a>
				</div>
				<div class="modal-body">
					<div id="item-info">
						<h3>
							<p>Item Name : <span id="productname"></span></p>
						</h3>
						<h4>
							<p>Price :<span id="productprice"></span></p>
						</h4>
					</div>
					<h5 id="modifier-group-name"></h5>
					<div id="modifiers-list"></div>

					<div class="row">
						<div class="col-4">
							<div class="input-group">
								<button class="btn btn-outline-secondary" id="decrement-item-btn" type="button"
									onclick="qty('remove')">-</button>
								<input type="number" id="item-quantity" name="qty" class="form-control text-center"
									value="1" min="1" readonly>
								<button class="btn btn-outline-secondary" id="increment-item-btn" type="button"
									onclick="qty('add')">+</button>
							</div>
						</div>
						<div class="col-6 my-auto text-center">
							<h4 class="m-0" id="totalAmount">$</h4>
						</div>
					</div>

					<div class="row">
						<input type="text" id="productid" name="productid"  hidden>
						<input type="text" id="productname" name="productname"  hidden>
						<input type="text" id="productprice" name="productprice"  hidden>
						<input type="text" id="productqty" name="productqty"  hidden>
						<input type="text" id="modifierid" name="modifierid"  hidden>
						<input type="text" id="modifiername" name="modifiername"  hidden>
						<input type="text" id="modifierprice" name="modifierprice"  hidden>
						<input type="text" id="producttotal" name="producttotal"  hidden>
					</div>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					<a class="btn btn-success btn-lg rounded-0 aos-init aos-animate" data-aos="fade-up" 
						onclick="addToCart()"
						data-aos-duration="600">
						<span>Add<i class="ri-check-fill ms-2" ></i></span>
					</a>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title" id="exampleModal1Label">Pickup Details</h5>
						<a data-bs-dismiss="modal" aria-label="Close">
							<i class="ri-close-circle-line f-20 text-dark"></i>
						</a>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<select class="form-select form-select-sm" name="timeset" id="timeset"  style="background: #f6f6f6;
							margin-bottom: 5px;
							width: 100%;
							height: 42px;
							border-radius: 4px;
							padding: 7px;
							color: black;border: none;">
					<option value="">Select Time</option>
					<option value="1">11:00 AM - 11:45 AM</option>
					<option value="2">11:15 AM - 12:00 PM</option>
					<option value="3">11:30 AM - 12:15 PM</option>
					<option value="4">11:45 AM - 12:30 PM</option>
					<option value="5">12:00 PM - 12:45 PM</option>
					<option value="6">12:15 PM - 01:00 PM</option>
					<option value="7">12:30 PM - 01:15 PM</option>
					<option value="8">12:45 PM - 01:30 PM</option>
					<option value="9">01:00 PM - 01:45 PM</option>
					<option value="10">01:15 PM - 02:00 PM</option>
					<option value="11">01:30 PM - 02:15 PM</option>
					<option value="12">01:45 PM - 02:30 PM</option>
					<option value="13">02:00 PM - 02:45 PM</option>
					<option value="14">02:15 PM - 03:00 PM</option>
					<option value="15">02:30 PM - 03:15 PM</option>
					<option value="16">4:30 PM - 05:15 PM</option>
					<option value="17">4:45 PM - 05:30 PM</option>
					<option value="18">05:00 PM - 05:45 PM</option>
					<option value="19">05:15 PM - 06:00 pm</option>
					<option value="20">05:30 pm - 06:15 PM</option>
					<option value="21">05:45 PM - 06:30 PM</option>
					<option value="22">06:00 PM - 06:45 PM</option>
					<option value="23">06:15 PM - 07:00 PM</option>
					<option value="24">06:30 PM - 07:15 PM</option>
					<option value="25">06:45 PM - 07:30 PM</option>
					<option value="26">07:00 PM - 07:45 PM</option>
					<option value="27">07:15 PM - 08:00 PM</option>
					<option value="28">07:30 PM - 08:15 PM</option>
					<option value="29">07:45 PM - 08:30 PM</option>
					<option value="30">08:00 PM - 08:45 PM</option>
					<option value="31">08:15 PM - 09:00 PM</option>
					</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





	<div class="mb-n7">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card text-bg-dark border-0 rounded-0 h-100">
						<img src="img/subscribe.jpg" class="card-img rounded-0 opacity-50" alt="subscribe" />
						<div class="card-img-overlay d-flex align-items-center justify-content-center text-center">
							<div class="row justify-content-center">
								<div class="col-xl-7 col-lg-8 col-md-10 col-12">
									<h1 class="card-title pb-2" data-aos="fade-up" data-aos-duration="500">Subscribe and
										get 20% ________ </h1>
									<p class="card-text" data-aos="fade-up" data-aos-duration="600">
										Donec convallis, elit vitae ______ cursus, libero purus facilisis ______
										volutpat metus tortor bibendum ____. Integer nec mi eleifend, _________ lorem
										vitae, finibus neque.
									</p>
									<form
										class="bg-white p-3 d-grid d-md-flex align-items-center justify-content-center gap-3 mt-5 w-75 mx-auto"
										data-aos="fade-up" data-aos-duration="800">
										<input class="form-control bg-transparent border-0 rounded-0 py-2 shadow-none"
											type="email" placeholder="Your Email Address" />
										<button class="btn btn-success btn-lg rounded-0 text-uppercase">Subscribe
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include('footer.php') ?>
	<?php include('sidenav.php') ?>

	<!-- <script>
		 window.onload = function() {
			var modal = document.getElementById('exampleModal1');
			modal.style.display = 'block';
			modal.classList.add("show");
		 }
	</script> -->

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			debugger;
			const cartButtons = document.querySelectorAll('.add-to_cart');

			cartButtons.forEach(button => {
				debugger;
				button.addEventListener('click', function (event) {
					event.preventDefault();
					debugger;
					const productId = this.getAttribute('data-product-id');
					document.getElementById('productid').value = productId;
					// Make an AJAX request to fetch item details
					fetch(`get-modifiers.php?productId=${productId}`)
						.then(response => response.json())
						.then(res => {
							debugger;
							const data = res.data;
							const itemName = data.name; // Item Name
							const itemPrice = data.price / 100; // Item Price in dollars
							const modifierGroupName = (data.modifierGroups.elements.length) > 0 ? (data.modifierGroups.elements[0].name) : ''; // Modifier Group Name
							document.getElementById('totalAmount').innerText = `$${itemPrice.toFixed(2)}`;

							// Set Item Details
							document.getElementById('productname').innerText = itemName;
							document.getElementById('productprice').innerText = `$${itemPrice}`;
							document.getElementById('productname').value = itemName;
							document.getElementById('productprice').value = `$${itemPrice}`;
							document.getElementById('modifier-group-name').innerText = modifierGroupName;

							

							// Populate Modifiers
							const modifiersList = document.getElementById('modifiers-list');
							modifiersList.innerHTML = ''; // Clear previous data

							modifierData = res.modifierData;
							modifierData.elements.forEach((modifier, index) => {
								debugger;
								const modifierName = modifier.name;
								const modifierPrice = modifier.price / 100;
								const modifierId = modifier.id;

								// Create Modifier Row
								const modifierRow = document.createElement('div');
								modifierRow.classList.add('row', 'modifier-row', 'align-items-center', 'mb-2');

								modifierRow.innerHTML = `
									<div class="col-6">
										<span><input type="radio" name="modifier" id="modifier-${index}" data-modifier-id="${modifierId}" class="modifier-radio"> ${modifierName}</span>
									</div>
									<div class="col-6">
										<span class="text-success" >$${modifierPrice}</span>
									</div>
								`;

								modifiersList.appendChild(modifierRow);
								const radioButton = modifierRow.querySelector('.modifier-radio');
								radioButton.addEventListener('change', () => {
									debugger;
									document.getElementById('modifierid').value = modifierId;
									document.getElementById('modifiername').value = modifierName;
									document.getElementById('modifierprice').value = modifierPrice;


									const quantityElement = document.getElementById('item-quantity');
									let currentQuantity = parseInt(quantityElement.value);
									const qty = currentQuantity; // Default to 0 if not a number
									const priceString = document.getElementById('productprice').innerText; 
									const modifierprice = parseFloat(document.getElementById('modifierprice').value) || 0; 
									const price = parseFloat(priceString.replace(/[^0-9.-]+/g,""));
									// const modifierprice = parseFloat(modifierpriceString.replace(/[^0-9.-]+/g,""));
									const total = (qty) * (price+modifierprice);
									document.getElementById('totalAmount').innerText = `$${total.toFixed(2)}`;
									document.getElementById('producttotal').value = `${total.toFixed(2)}`;
								});
							});
							// Show Modal
							// const modal = new bootstrap.Modal(document.getElementById('itemDetailsModal'));
							// modal.show();
						})
						.catch(error => {
							console.error('Error fetching item details:', error);
						});
				});
			});
		});
	</script>

	<script>
	
		function qty(action) {
			debugger;
			const quantityElement = document.getElementById('item-quantity');
			let currentQuantity = parseInt(quantityElement.value);

			if (action === 'add') {
				currentQuantity += 1; // Increment
			} else if (action === 'remove' && currentQuantity > 1) {
				currentQuantity -= 1;
			}
			quantityElement.value = currentQuantity;

			const qty = currentQuantity; // Default to 0 if not a number
			const priceString = document.getElementById('productprice').innerText; 
			const modifierprice = parseFloat(document.getElementById('modifierprice').value) || 0; 
			const price = parseFloat(priceString.replace(/[^0-9.-]+/g,""));
			// const modifierprice = parseFloat(modifierpriceString.replace(/[^0-9.-]+/g,""));
			const total = (qty) * (price+modifierprice);
			document.getElementById('totalAmount').innerText = `$${total.toFixed(2)}`;
			document.getElementById('producttotal').value = `${total.toFixed(2)}`;
			document.getElementById('productqty').value = currentQuantity;
		}

		

	</script>

	<script>

	function addToCart() {
		const productid = document.getElementById('productid').value;
		const productname = document.getElementById('productname').value;
		const productprice = document.getElementById('productprice').value;
		const productqty = document.getElementById('productqty').value;
		const modifierid = document.getElementById('modifierid').value;
		const modifiername = document.getElementById('modifiername').value;
		const modifierprice = document.getElementById('modifierprice').value;
		const price = parseFloat(productprice.replace(/[^0-9.-]+/g, ""));
		const producttotal = parseFloat(price) * parseInt(productqty);

		const params = new URLSearchParams({
			productid,
			productname,
			productprice,
			productqty,
			modifierid,
			modifiername,
			modifierprice,
			producttotal
		}).toString();

		const xhr = new XMLHttpRequest();
		xhr.open("POST", "add-to-cart.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(params);

		xhr.onload = function () {
			if (xhr.status === 200) {
				const response = JSON.parse(xhr.responseText);
				if (response.status === "success") {
					console.log('Product added to cart successfully.');
					window.location.reload(); // Reload the page after a successful add to cart
				} else {
					console.error('Failed to add product to cart:', response.message);
					alert('Error: Unable to add product to cart.');
				}
			} else {
				console.error('Failed to send request. Status:', xhr.status);
				alert('Error: Something went wrong!');
			}
		};
	}

		</script>
	<script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vender/jquery/jquery-3.6.4.min.js"></script>
	<script src="vender/aos/dist/aos.js"></script>
	<script src="js/script.js"></script>
</body>

</html>