<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title ?> - Sinar Ketandan</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= site_url() ?>assets/image/logo.jpeg" rel="icon">
	<link href="<?= site_url() ?>assets/NiceAdmin/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/NiceAdmin/vendor/remixicon/remixicon.css" rel="stylesheet">

	<!-- CDN -->
	<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<!-- Template Main CSS File -->
	<link href="<?= site_url() ?>assets/NiceAdmin/css/style.css" rel="stylesheet">
	<link href="<?= site_url() ?>assets/plugins/icheck-1.0.3/skins/all.css" rel="stylesheet">

	<!-- custom CSS -->
	<link href="<?= site_url() ?>assets/css/custom.css?t=<?= filemtime('assets/css/custom.css') ?>" rel="stylesheet">

	<!-- =======================================================
	* Template Name: NiceAdmin - v2.2.0
	* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
	* Author: BootstrapMade.com
	* License: https://bootstrapmade.com/license/
	======================================================== -->
</head>

<body>
	<script>
		const base_url = "<?= site_url() ?>/";
	</script>
	<!-- ======= Header ======= -->
	<header id="header" class="header fixed-top d-flex align-items-center">

		<div class="d-flex align-items-center justify-content-between">
			<a href="<?= site_url() ?>" class="logo d-flex align-items-center">
				<img src="<?= site_url() ?>assets/image/logo.jpeg" alt="">
				<span class="d-none d-lg-block">Sinar Ketandan</span>
			</a>
			<i class="bi bi-list toggle-sidebar-btn"></i>
		</div><!-- End Logo -->

		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">
				<li class="nav-item dropdown">

					<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
						<i class="bi bi-bell"></i>
						<span class="badge bg-primary badge-number">0</span>
					</a><!-- End Notification Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
						<li class="dropdown-header">
							You have 0 new notifications
						</li>
					</ul><!-- End Notification Dropdown Items -->

				</li><!-- End Notification Nav -->

				<li class="nav-item dropdown pe-3">
					<?php if (session()->username): ?>
						<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
							<img src="<?= site_url() ?>assets/image/logo.jpeg" alt="Profile" class="rounded-circle">
							<span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->display_name ?></span>
						</a><!-- End Profile Iamge Icon -->

						<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
							<li class="dropdown-header">
								<h6><?= session()->display_name ?></h6>
							</li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center" href="<?= site_url('logout') ?>">
									<i class="bi bi-box-arrow-right"></i>
									<span>Sign Out</span>
								</a>
							</li>
						</ul>
					<?php endif ?>
				</li><!-- End Profile Nav -->

			</ul>
		</nav><!-- End Icons Navigation -->

	</header><!-- End Header -->

	<!-- ======= Sidebar ======= -->
	<aside id="sidebar" class="sidebar">

		<ul class="sidebar-nav" id="sidebar-nav">

			<li class="nav-item">
				<a class="nav-link <?= ($title == 'Dashboard') ? '':'collapsed' ?>" href="<?= site_url('dashboard') ?>">
					<i class="bi bi-grid"></i>
					<span>Dashboard</span>
				</a>
			</li><!-- End Dashboard Nav -->

			<li class="nav-heading">Pages</li>

			<?php $no_menu = 0; foreach ($list_menu as $menu): ?>
				<?php if (isset($menu['submenu']) && $menu['submenu']): ?>
					<li class="nav-item">
						<a class="nav-link <?= ($title == $menu['name']) ? '':'collapsed' ?>" data-bs-target="#sub<?= $no_menu ?>" data-bs-toggle="collapse" href="#">
							<i class="bi bi-bar-chart"></i><span><?= $menu['name'] ?></span><i class="bi bi-chevron-down ms-auto"></i>
						</a>
						<ul id="sub<?= $no_menu ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
							<?php foreach ($menu['submenu'] as $submenu): ?>
								<li>
									<a href="<?= site_url().$submenu['link'] ?>" class="<?= ($submenu['name'] ==  $submenu) ? 'active':'' ?>">
										<i class="bi bi-circle"></i><span><?= $submenu['name'] ?></span>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link <?= ($title == $menu['name']) ? '':'collapsed' ?>" href="<?= site_url().$menu['link'] ?>">
							<i class="<?= $menu['icon'] ?>"></i>
							<span><?= $menu['name'] ?></span>
						</a>
					</li>
				<?php endif ?>
			<?php $no_menu++; endforeach ?>
		</ul>

	</aside><!-- End Sidebar-->

	<main id="main" class="main">

		<div class="pagetitle">
			<h1><?= $title ?></h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item active"><?= $title ?></li>
					<?php if (isset($sub_title1)): ?>
						<li class="breadcrumb-item active"><?= $sub_title1 ?></li>
					<?php endif ?>
				</ol>
			</nav>
		</div><!-- End Page Title -->

		<section class="section dashboard">
			<?= $content ?>
		</section>

	</main><!-- End #main -->

	<footer id="footer" class="footer">
		<div class="credits">
			<!-- All the links in the footer should remain intact. -->
			<!-- You can delete the links only if you purchased the pro version. -->
			<!-- Licensing information: https://bootstrapmade.com/license/ -->
			<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
			Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
		</div>
	</footer>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/chart.js/chart.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/echarts/echarts.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/quill/quill.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/tinymce/tinymce.min.js"></script>
	<script src="<?= site_url() ?>assets/NiceAdmin/vendor/php-email-form/validate.js"></script>

	<!-- CDN -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= site_url() ?>assets/NiceAdmin/js/main.js"></script>
	<script src="<?= site_url() ?>assets/plugins/icheck-1.0.3/icheck.min.js"></script>

	<!-- custom JS -->
	<script src="<?= site_url() ?>assets/js/custom.js?t=<?= filemtime("assets/js/custom.js") ?>"></script>
	<?php foreach ($js as $key): ?>
		<script src="<?= site_url() ?>assets/js/<?= $key ?>?t=<?= filemtime("assets/js/".$key) ?>"></script>
	<?php endforeach ?>
</body>

</html>