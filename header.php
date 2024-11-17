


<div class="border-bottom border-white border-opacity-10 text-white top-nav py-3 d-none d-lg-block">
			<div class="container">
				<div class="row align-items-center justify-content-between g-4">
					<div class="col-auto">
						<div class="d-flex align-items-center gap-4">
							<a href="#" class="link-light"><i class="ri-facebook-circle-fill"></i></a> <a href="#"
								class="link-light"><i class="ri-twitter-fill"></i></a>
							<a href="#" class="link-light"><i class="ri-instagram-fill"></i></a>
						</div>
					</div>
					<div class="col-auto">
						<small class="mb-0"><i class="ri-time-line me-1"></i> Monday to Saturday - 8:00 -17:30 </small>
					</div>
				</div>
			</div>
		</div>
		<nav
			class="navbar osahan-main-nav navbar-expand catering-nav py-lg-0 py-3 border-bottom border-white border-opacity-10">
			<div class="container">
				<div class="position-relative d-flex align-items-center gap-2 site-brand">
					<i class="ri-cake-3-line fs-2 lh-1 text-white"></i>
					<div class="lh-1">
						<h5 class="fw-bold m-0 text-white">Catering </h5>
						<small class="text-white-50">Template </small>
					</div>
					<a class="stretched-link" href="index.php"></a>
				</div>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto m-none gap-4 pe-5">
						<li class="nav-item">
							<a class="nav-link active" href="index.php"><i class="ri-apps-2-line"></i> Home </a>
						</li>
						<li class="nav-item"><a class="nav-link" href="about.php">About </a></li>
						<li class="nav-item"><a class="nav-link" href="menu.php">Menu </a></li>
						<li class="nav-item"><a class="nav-link" href="gallery.php">Gallery </a></li>
						<li class="nav-item"><a class="nav-link" href="contact.php">Contact </a></li>
						<li class="nav-item my-auto">
							<a href="cart.php">
								<button class="cart-btn" title="Add to Cart">
									<i class="ri-shopping-cart-2-fill"></i>
									<span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
								</button>
							</a>
						</li>
					</ul>
					<!-- <a href="#" class="btn btn-light btn-lg rounded-0 d-none d-lg-block"><i
							class="ri-login-box-line me-1"></i> Login </a> -->
					<a href="#" class="link-light d-lg-none ms-auto" data-bs-toggle="offcanvas"
						data-bs-target="#sidebar" aria-controls="sidebar"><i class="ri-menu-3-line ri-lg"></i></a>
				</div>
			</div>
		</nav>