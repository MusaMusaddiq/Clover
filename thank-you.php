
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
									<li class="breadcrumb-item text-white small active" aria-current="page">Thank You </li>
								</ol>
							</nav>
							<h1 class="display-1" data-aos="fade-up" data-aos-duration="600">Thank You </h1>
						</div>
					</div>
				</div>
			</div>
		</div>



        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div class="card shadow-lg p-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <!-- Success Icon -->
                                <i class="ri-check-fill  text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h2 class="mb-3 text-success">Order Placed Successfully!</h2>
                            <p>Your order has been successfully placed. <br> 
                                <strong>Order ID:</strong> <?php echo htmlspecialchars($_GET['orderid'] ?? ''); ?>
                            </p>
                            <a href="index.php" class="mt-3"><button class="btn btn-success">Go Back to Home</button></a>
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

	<script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vender/jquery/jquery-3.6.4.min.js"></script>
	<script src="vender/aos/dist/aos.js"></script>
	<script src="js/script.js"></script>
</body>

</html>