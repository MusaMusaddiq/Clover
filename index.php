<?php 
session_start();
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

		<div class="py-5 my-5">
			<div class="container pb-5 pt-4 mb-5">
				<div class="row pb-5">
					<div class="col-lg-6 col-12">
						<div class="text-center text-md-start text-white">
							<div class="mb-5">
								<h1 class="display-1 pb-2" data-aos="fade-up" data-aos-duration="600">
								Delicious Food for any Event
								</h1>
								<p class="text-secondary-emphasis lead" data-aos="fade-up" data-aos-duration="700">
									Cras eu elit congue, placerat dui ut, tincidunt nislnulla leo elit, pharetra bibendum justo quiscursus consectetur erat.
								</p>
							</div>
							<div
								class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
								<a href="#" class="btn btn-success btn-lg rounded-0" data-aos="fade-up"
									data-aos-duration="600">Get Started <i class="ri-arrow-right-line ms-2"></i></a>
								<a href="#" class="btn btn-light btn-lg rounded-0" data-aos="fade-up"
									data-aos-duration="700">Learn more <i class="ri-arrow-right-line ms-2"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mt-n7">
		<div class="container">
			<div class="row bg-dark g-0">
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="600">
					<div class="bg-success text-center text-white p-5">
						<img src="img/information/1.png" alt="natural-ingridients" class="img-fluid" />
						<div class="pt-4">
							<h2 class="title">Natural Ingridients </h2>
							<p class="text-white-50 mb-0">Aenean non accumsan ante. Duis et risus accumsan sem tempus porta nec sit amet est. Sed ut euismod quam.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="700">
					<div class="bg-success bg-opacity-75 text-center text-white p-5">
						<img src="img/information/2.png" alt="varied-menu" class="img-fluid" />
						<div class="pt-4">
							<h2 class="title">Varied Menu </h2>
							<p class="text-white-50 mb-0">Phasellus risus turpis, pretium sit amet magna non, molestie ultricies enim. Nullam pulvinar felis at metus.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="800">
					<div class="bg-success bg-opacity-50 text-center text-white p-5">
						<img src="img/information/3.png" alt="best-chefs" class="img-fluid" />
						<div class="pt-4">
							<h2 class="title">Best chefs </h2>
							<p class="text-white-50 mb-0">Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo, quis tempor ligula quisque.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-5">
		<div class="container py-5">
			<div class="row justify-content-center mb-5">
				<div class="col-xl-7 col-lg-8 col-md-10 col-12">
					<div class="text-center" data-aos="fade-up" data-aos-duration="600">
						<h1 class="title pb-2">Choose Your Menu </h1>
						<p>Donec convallis, elit vitae ornare cursus, libero purus facilisis felisa volutpat metus tortor bibendum elit. Integer nec mi eleifend, fermentum lorem vitae, finibus neque.</p>
					</div>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="600">
					<div class="card bg-light border-0 rounded-0 text-center p-5">
						<img src="img/choose-menu/menu-1.png" class="card-img-top rounded-0" alt="menu" />
						<div class="card-body">
							<h2 class="card-title pb-2">Salads </h2>
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus.</p>
						</div>
						<div class="card-footer bg-transparent border-0"><a href="#"
								class="btn btn-success btn-lg rounded-0">Get Menu </a></div>
					</div>
				</div>
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="700">
					<div class="card bg-light border-0 rounded-0 text-center p-5">
						<img src="img/choose-menu/menu-2.png" class="card-img-top rounded-0" alt="menu" />
						<div class="card-body">
							<h2 class="card-title pb-2">Fish & Meat </h2>
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus.</p>
						</div>
						<div class="card-footer bg-transparent border-0"><a href="#"
								class="btn btn-success btn-lg rounded-0">Get Menu </a></div>
					</div>
				</div>
				<div class="col-lg-4 col-12" data-aos="fade-up" data-aos-duration="800">
					<div class="card bg-light border-0 rounded-0 text-center p-5">
						<img src="img/choose-menu/menu-3.png" class="card-img-top rounded-0" alt="menu" />
						<div class="card-body">
							<h2 class="card-title pb-2">Desserts </h2>
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus.</p>
						</div>
						<div class="card-footer bg-transparent border-0"><a href="#"
								class="btn btn-success btn-lg rounded-0">Get Menu </a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-veg text-white py-5">
		<div class="container py-5">
			<div class="row justify-content-center g-4">
				<div class="col-12 mb-5" data-aos="fade-up" data-aos-duration="600">
					<div class="card text-bg-dark border-0 rounded-0">
						<img src="img/video.png" class="card-img" alt="video" />
						<div class="card-img-overlay d-flex align-items-center justify-content-center">
							<a href="#" class="link-success" data-bs-toggle="modal" data-bs-target="#videoModal"><i
									class="ri-play-circle-fill display-1"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xl-7 col-lg-8 col-md-10 col-12">
					<div class="text-center">
						<div class="mb-5">
							<h1 class="title pb-2" data-aos="fade-up" data-aos-duration="600">Cooking delicious food
								since 1984 </h1>
							<p class="lead fw-normal" data-aos="fade-up" data-aos-duration="700">
								Aliquam faucibusodio nec commodo aliquam, neque felis placerat dui, a porta ante lectus dapibus est. Aliquam a bibendum mised. condimentum vestibulum quis dapibus sit amet, finibus id turpis. Aliquam semper fringilla semper.
							</p>
						</div>
						<a href="#" class="btn btn-dark btn-lg rounded-0" data-aos="fade-up"
							data-aos-duration="800">Read More <i class="ri-arrow-right-line ms-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-5">
		<div class="container py-5">
			<div class="row justify-content-center mb-5">
				<div class="col-xl-7 col-lg-8 col-md-10 col-12">
					<div class="text-center aos-init" data-aos="fade-up" data-aos-duration="600">
						<h1 class="title pb-2">Catering for any ocassion</h1>
						<p>Donec convallis, elit vitae ornare cursus, libero purus facilisis felisa volutpat metus tortor bibendum elit. Integer nec mi eleifend, fermentum lorem vitae, finibus neque.</p>
					</div>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-lg-6 col-12 aos-init" data-aos="fade-up" data-aos-duration="600">
					<div class="card border-0 rounded-0 h-100">
						<img src="img/ocasion/ocasion-image-1.png" class="card-img rounded-0" alt="ocassion-img">
						<div class="card-img-overlay d-flex align-items-end p-4">
							<div class="bg-white text-center p-5">
								<h2 class="card-title pb-2">Private Party</h2>
								<p class="card-text">Praesent libero augue, ornare eget quam sed, volutpat suscipit arcu duis ut urna commodo.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12 aos-init" data-aos="fade-up" data-aos-duration="700">
					<div class="card border-0 rounded-0 h-100">
						<img src="img/ocasion/ocasion-image-2.png" class="card-img rounded-0" alt="ocassion-img">
						<div class="card-img-overlay d-flex align-items-end p-4">
							<div class="bg-white text-center p-5">
								<h2 class="card-title pb-2">Wedding Recepction</h2>
								<p class="card-text">Praesent libero augue, ornare eget quam sed, volutpat suscipit arcu duis ut urna commodo.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12 aos-init" data-aos="fade-up" data-aos-duration="800">
					<div class="card border-0 rounded-0 h-100">
						<img src="img/ocasion/ocasion-image-3.png" class="card-img rounded-0" alt="ocassion-img">
						<div class="card-img-overlay d-flex align-items-end p-4">
							<div class="bg-white text-center p-5">
								<h2 class="card-title pb-2">Corporate Event</h2>
								<p class="card-text">Praesent libero augue, ornare eget quam sed, volutpat suscipit arcu duis ut urna commodo.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12 aos-init" data-aos="fade-up" data-aos-duration="900">
					<div class="card border-0 rounded-0 h-100">
						<img src="img/ocasion/ocasion-image-4.png" class="card-img rounded-0" alt="ocassion-img">
						<div class="card-img-overlay d-flex align-items-end p-4">
							<div class="bg-white text-center p-5">
								<h2 class="card-title pb-2">Birthday Party</h2>
								<p class="card-text">Praesent libero augue, ornare eget quam sed, volutpat suscipit arcu duis ut urna commodo.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-today-menu text-white py-5">
		<div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-8 col-md-10 col-12">
					<div class="text-center mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-duration="600">
						<h1 class="title pb-2">Today’s menu</h1>
						<p>Donec convallis, elit vitae ornare cursus, libero purus facilisis felisa volutpat metus tortor bibendum elit. Integer nec mi eleifend, fermentum lorem vitae, finibus neque.</p>
					</div>
					<div>
						<div class="card bg-transparent border-0 rounded-0 mb-4">
							<div class="row align-items-center g-2 aos-init" data-aos="fade-up" data-aos-duration="600">
								<div class="col-md-2 col-12 aos-init" data-aos="fade-up" data-aos-duration="600">
									<img src="img/today-menu/menu-image-1.png" class="img-fluid d-block mx-auto" alt="today-menu">
								</div>
								<div class="col-md-10 col-12">
									<div class="card-body text-center text-md-start">
										<div class="d-flex align-items-center justify-content-between gap-3 w-100">
											<h2 class="card-title">Mix Salad</h2>
											<hr class="text-white w-50">
											<h2 class="card-title">$10</h2>
										</div>
										<p class="card-text text-white-50 mb-0">Vestibulum commodo sapien non elit porttitor vitae eiusmod.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card bg-transparent border-0 rounded-0 mb-4">
							<div class="row align-items-center g-2 aos-init" data-aos="fade-up" data-aos-duration="700">
								<div class="col-md-2 col-12">
									<img src="img/today-menu/menu-image-2.png" class="img-fluid d-block mx-auto" alt="today-menu">
								</div>
								<div class="col-md-10 col-12">
									<div class="card-body text-center text-md-start">
										<div class="d-flex align-items-center justify-content-between gap-3 w-100">
											<h2 class="card-title">Green Garden Salad</h2>
											<hr class="text-white w-25">
											<h2 class="card-title">$12</h2>
										</div>
										<p class="card-text text-white-50 mb-0">Pellentesque tincidunt tristique neque eget venenatis vulputate</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card bg-transparent border-0 rounded-0 mb-4">
							<div class="row align-items-center g-2 aos-init" data-aos="fade-up" data-aos-duration="800">
								<div class="col-md-2 col-12">
									<img src="img/today-menu/menu-image-3.png" class="img-fluid d-block mx-auto" alt="today-menu">
								</div>
								<div class="col-md-10 col-12">
									<div class="card-body text-center text-md-start">
										<div class="d-flex align-items-center justify-content-between gap-3 w-100">
											<h2 class="card-title">Grilled Shrimp Salad</h2>
											<hr class="text-white w-25">
											<h2 class="card-title">$14</h2>
										</div>
										<p class="card-text text-white-50 mb-0">Pellentesque tincidunt tristique neque eget venenatis vulputate</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card bg-transparent border-0 rounded-0">
							<div class="row align-items-center justify-content-center g-2 aos-init" data-aos="fade-up" data-aos-duration="900">
								<div class="col-md-2 col-12">
									<img src="img/today-menu/menu-image-4.png" class="img-fluid d-block mx-auto" alt="today-menu">
								</div>
								<div class="col-md-10 col-12">
									<div class="card-body text-center text-md-start">
										<div class="d-flex align-items-center justify-content-between gap-3 w-100">
											<h2 class="card-title">Chicken Caesar Salad</h2>
											<hr class="text-white w-25">
											<h2 class="card-title">$10</h2>
										</div>
										<p class="card-text text-white-50 mb-0">Duis rhoncus dui venenatis consequat portitortiam commodo.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-5">
		<div class="container py-5">
			<div class="row justify-content-center mb-5">
				<div class="col-xl-7 col-lg-8 col-md-10 col-12">
					<div class="text-center aos-init" data-aos="fade-up" data-aos-duration="600">
						<h1 class="title pb-2">Our clients thought</h1>
						<p>Donec convallis, elit vitae ornare cursus, libero purus facilisis felisa volutpat metus tortor bibendum elit. Integer nec mi eleifend, fermentum lorem vitae, finibus neque.</p>
					</div>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-lg-4 col-12 aos-init" data-aos="fade-up" data-aos-duration="600">
					<div class="card bg-light border-0 rounded-0 text-center p-5 h-100">
						<div class="card-header bg-transparent border-0">
							<img src="img/profile/profile-1.jpg" class="img-fluid rounded-circle client-img" alt="our-client">
						</div>
						<div class="card-body py-4">
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus neque tristique augue. Proin tempus urna vel congue elementum.</p>
						</div>
						<div class="card-footer bg-transparent border-0">
							<h4 class="card-title">Janet Baker</h4>
							<p class="card-text text-secondary-emphasis mb-0">Customer</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12 aos-init" data-aos="fade-up" data-aos-duration="700">
					<div class="card bg-light border-0 rounded-0 text-center p-5 h-100">
						<div class="card-header bg-transparent border-0">
							<img src="img/profile/profile-4.jpg" class="img-fluid rounded-circle client-img" alt="our-client">
						</div>
						<div class="card-body py-4">
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus neque tristique augue. Proin tempus urna vel congue elementum.</p>
						</div>
						<div class="card-footer bg-transparent border-0">
							<h4 class="card-title">Michael Jones</h4>
							<p class="card-text text-secondary-emphasis mb-0">Customer</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12 aos-init" data-aos="fade-up" data-aos-duration="800">
					<div class="card bg-light border-0 rounded-0 text-center p-5 h-100">
						<div class="card-header bg-transparent border-0">
							<img src="img/profile/profile-5.jpg" class="img-fluid rounded-circle client-img" alt="our-client">
						</div>
						<div class="card-body py-4">
							<p class="card-text">In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus neque tristique augue. Proin tempus urna vel congue elementum.</p>
						</div>
						<div class="card-footer bg-transparent border-0">
							<h4 class="card-title">Roger Reyes</h4>
							<p class="card-text text-secondary-emphasis mb-0">Customer</p>
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
						<img src="img/subscribe.jpg" class="card-img rounded-0 opacity-50" alt="subscribe">
						<div class="card-img-overlay d-flex align-items-center justify-content-center text-center">
							<div class="row justify-content-center">
								<div class="col-xl-7 col-lg-8 col-md-10 col-12">
									<h1 class="card-title title pb-2 aos-init" data-aos="fade-up" data-aos-duration="600">Subscribe and get 20% discount</h1>
									<p class="card-text aos-init" data-aos="fade-up" data-aos-duration="700">
										Donec convallis, elit vitae ornare cursus, libero purus facilisis felisa volutpat metus tortor bibendum elit. Integer nec mi eleifend, fermentum lorem vitae, finibus neque.
									</p>
									<form class="bg-white p-3 d-grid d-md-flex align-items-center justify-content-center gap-3 mt-5 w-75 mx-auto aos-init" data-aos="fade-up" data-aos-duration="800">
										<input class="form-control bg-transparent border-0 rounded-0 py-2 shadow-none" type="email" placeholder="Your Email Address">
										<button class="btn btn-success btn-lg rounded-0 text-uppercase">Subscribe</button>
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

	<script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vender/jquery/jquery-3.6.4.min.js"></script>
	<script src="vender/aos/dist/aos.js"></script>
	<script src="js/script.js"></script>
</body>

</html>