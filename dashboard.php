<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Innap : Hotel Admin Template" />
	<meta property="og:title" content="Innap : Hotel Admin Template" />
	<meta property="og:description" content="Innap : Hotel Admin Template" />
	<meta property="og:image" content="https://innap.dexignzone.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Innap : Hotel Admin Template</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
	<link rel="stylesheet" href="./vendor/chartist/css/chartist.min.css">
	<link href="./vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="./vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<!-- Style css -->
	<link href="./css/style.css" rel="stylesheet">
	<?= session_start();
	if (!isset($_SESSION["username"])) {
		$_SESSION['flash'] = "Session Has Been Expired";
		header("Location: ../login.php");
		exit();
	}

	include '../db_connection.php';
	$sql_pending = "SELECT COUNT(*) AS pending_count FROM booking_service WHERE status = 'PENDING'";
	$sql_completed = "SELECT COUNT(*) AS completed_count FROM booking_service WHERE status = 'COMPLETED'";
	$sql_in_progress = "SELECT COUNT(*) AS in_progress_count FROM booking_service WHERE status = 'INPROGRESS'";
	$sql_total = "SELECT COUNT(*) AS total_count FROM booking_service";

	// Execute SQL queries
	$result_pending = mysqli_query($conn, $sql_pending);
	$result_completed = mysqli_query($conn, $sql_completed);
	$result_in_progress = mysqli_query($conn, $sql_in_progress);
	$result_total = mysqli_query($conn, $sql_total);

	// Fetch counts from query results
	$row_pending = mysqli_fetch_assoc($result_pending);
	$row_completed = mysqli_fetch_assoc($result_completed);
	$row_in_progress = mysqli_fetch_assoc($result_in_progress);
	$row_total = mysqli_fetch_assoc($result_total);

	// Handle empty result sets
	if (!$row_pending) {
		$row_pending['pending_count'] = 0;
	}
	if (!$row_completed) {
		$row_completed['completed_count'] = 0;
	}
	if (!$row_in_progress) {
		$row_in_progress['in_progress_count'] = 0;
	}
	if (!$row_total) {
		$row_total['total_count'] = 0;
	}

	// Close the database connection
	mysqli_close($conn);
	?>

</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="waviy">
			<span style="--i:1">L</span>
			<span style="--i:2">o</span>
			<span style="--i:3">a</span>
			<span style="--i:4">d</span>
			<span style="--i:5">i</span>
			<span style="--i:6">n</span>
			<span style="--i:7">g</span>
			<span style="--i:8">.</span>
			<span style="--i:9">.</span>
			<span style="--i:10">.</span>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="index.html" class="brand-logo">
				<svg class="logo-abbr" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0)">
						<rect class="rect-primary-rect" width="80" height="80" rx="16" fill="#1362FC" />
						<circle cx="42" cy="19" r="10" fill="white" />
						<circle cx="75.5" cy="76.5" r="16.5" fill="#12A7FB" />
						<circle cx="5.5" cy="1.5" r="17.5" fill="#1362FC" />
						<circle class="rect-primary-rect-1" cx="5.5" cy="1.5" r="16.5" stroke="white" stroke-opacity="0.66" stroke-width="2" />
						<path d="M33.7656 87.2159C34.9565 76.5246 37.5874 53.6112 38.5845 47.4881V47.4881C39.1698 43.8941 40.2547 47.2322 39.8692 50.8531C38.9933 59.0813 37.1429 74.1221 35.5121 87.4131C33.1225 106.889 33.3507 95.974 33.7635 88.0818" stroke="white" stroke-width="21" stroke-linecap="round" stroke-linejoin="round" />
					</g>
					<defs>
						<clipPath id="clip0">
							<rect class="rect-primary-rect" width="80" height="80" rx="16" fill="white" />
						</clipPath>
					</defs>
				</svg>
				<svg class="brand-title" width="123" height="68" viewBox="0 0 123 68" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.376 11.22C9.996 11.22 8.092 12.92 7.616 15.3C7.14 17.544 8.568 19.38 10.948 19.38C13.192 19.38 15.3 17.544 15.776 15.3C16.252 12.92 14.62 11.22 12.376 11.22ZM3.672 36.312L2.652 42.092C1.768 46.988 5.372 51 10.2 51C11.22 51 11.9 50.864 12.104 49.844C12.308 48.416 10.404 46.92 11.152 42.976L14.416 24.072C14.892 21.284 13.464 21.216 10.676 21.216C8.296 21.216 6.256 21.692 5.78 24.072L3.672 36.312ZM30.8651 21.216C29.1651 21.216 27.6011 21.488 26.1731 22.1C25.6291 21.352 24.3371 21.216 22.5011 21.216C20.2571 21.216 18.0811 21.624 17.6051 24.072L13.4571 48.144C13.0491 50.388 14.8851 51 17.1291 51C20.1211 51 21.6851 50.864 22.1611 48.144L25.4931 28.696C26.1051 26.044 28.6211 24.208 30.5251 24.208C32.3611 24.208 33.2451 25.636 32.6331 29.24L30.3891 42.092C29.5051 46.92 32.9051 51 37.9371 51C38.9571 51 39.5691 50.796 39.7731 49.912C39.9771 49.164 39.7731 49.028 39.5691 48.552C38.8211 47.124 38.3451 45.968 38.8891 42.976L41.1331 30.124C41.8811 25.228 38.7531 21.216 33.7891 21.216H30.8651ZM58.6229 21.216C56.9229 21.216 55.3589 21.488 53.9309 22.1C53.3869 21.352 52.0949 21.216 50.2589 21.216C48.0149 21.216 45.8389 21.624 45.3629 24.072L41.2149 48.144C40.8069 50.388 42.6429 51 44.8869 51C47.8789 51 49.4429 50.864 49.9189 48.144L53.2509 28.696C53.8629 26.044 56.3789 24.208 58.2829 24.208C60.1189 24.208 61.0029 25.636 60.3909 29.24L58.1469 42.092C57.2629 46.92 60.6629 51 65.6949 51C66.7149 51 67.3269 50.796 67.5309 49.912C67.7349 49.164 67.5309 49.028 67.3269 48.552C66.5789 47.124 66.1029 45.968 66.6469 42.976L68.8909 30.124C69.6389 25.228 66.5109 21.216 61.5469 21.216H58.6229ZM77.7702 46.24C76.6822 44.948 76.6822 43.316 76.9542 41.616C77.4302 39.916 77.9742 38.556 80.4222 37.536C81.9862 36.788 83.8902 36.72 85.5902 35.428L85.5222 35.972L84.6382 41.072C84.1622 43.588 83.6182 45.22 82.5982 46.24C81.3062 47.532 79.0622 47.804 77.7702 46.24ZM82.6662 51C88.7862 51 92.5262 46.172 93.4102 40.596L94.2262 35.972L95.2462 29.988C96.1302 25.092 92.7982 21.012 87.8342 21.012H82.3942C79.0622 21.012 75.7302 22.848 73.7582 25.568C72.7382 26.928 71.1742 29.58 72.6022 30.804C73.7582 31.824 76.3422 31.688 77.9062 31.484C79.4702 31.28 80.4222 30.94 80.6942 29.104C81.4422 24.548 86.9502 22.236 86.9502 26.928C86.9502 27.472 86.8822 28.084 86.7462 28.832C85.9982 33.048 79.8782 32.64 76.2062 33.932C72.1942 35.224 69.3382 38.556 68.5902 42.364C68.3862 43.384 68.3862 43.86 68.4542 44.88C69.0662 48.416 71.9902 51 76.0022 51H79.3342H82.6662ZM108.845 21.216C103.949 21.216 99.1206 25.228 98.3726 30.124L94.1566 54.332C93.2726 59.772 91.1646 59.84 90.9606 61.064C90.7566 62.084 91.3006 62.356 92.3206 62.356C97.2846 62.356 102.045 58.616 102.929 53.448L103.473 50.252C104.697 50.728 106.057 51 107.485 51H110.341C115.305 51 119.861 46.988 120.745 42.092L122.853 30.124C123.601 25.228 120.473 21.216 115.509 21.216H112.177H108.845ZM106.193 34.612L107.145 29.24C107.689 26.044 108.437 24.412 110.885 24.412C113.129 24.412 114.897 26.18 114.353 29.24L111.973 42.976C111.361 46.512 110.001 48.008 108.097 48.008C106.261 48.008 104.561 46.376 104.629 43.928L106.193 34.612Z" fill="#383838" />
				</svg>
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->
		<?php include 'chat.php'; ?>
		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar">
								Dashboard
							</div>
						</div>
						<ul class="navbar-nav header-right">
							<li class="nav-item dropdown header-profile">
								<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<img src="images/profile/pic1.jpg" alt="">
									<div class="header-info ms-3">
										<span><?php echo $_SESSION['username']; ?></span>
										<small>Superadmin</small>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="#" class="dropdown-item ai-icon">
										<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
										<span class="ms-2">Profile </span>
									</a>
									<a href="#" class="dropdown-item ai-icon">
										<svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
											<polyline points="22,6 12,13 2,6"></polyline>
										</svg>
										<span class="ms-2">Inbox </span>
									</a>
									<a href="../logout.php" class="dropdown-item ai-icon">
										<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
											<polyline points="16 17 21 12 16 7"></polyline>
											<line x1="21" y1="12" x2="9" y2="12"></line>
										</svg>
										<span class="ms-2">Logout </span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<div class="deznav">
			<div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li><a href="dashboard.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
					<li><a href="service_report.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Service Report</span>
						</a>
					</li>
				</ul>
				<div class="copyright">
					<p><strong>Innap Hotel Admin</strong> © 2021 All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by DexignZone</p>
				</div>
			</div>
		</div>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body pt-0 mt-0">
			<!-- row -->
			<div class="container-fluid">
				<div class="row">
					<?php
					if (isset($_SESSION["flash"])) {
						echo '<div class="alert alert-success solid alert-dismissible fade show" role="alert">';
						echo '<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">';
						echo '<polyline points="9 11 12 14 22 4"></polyline>';
						echo '<path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>';
						echo '</svg>';
						echo '<strong style="color: white">' . $_SESSION["flash"] . '</strong>';
						echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
						echo '</div>';
						unset($_SESSION["flash"]); // Remove flash message after displaying it
					}
					?>
					<div class="col-xl-3 col-sm-6">
						<div class="card gradient-1 card-bx">
							<div class="card-body d-flex align-items-center">
								<div class="me-auto text-white">
									<h2 class="text-white"><?php echo $row_total['total_count']; ?></h2>
									<span class="fs-18">Total Service</span>
								</div>
								<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M29.0611 39.4402L13.7104 52.5947C12.9941 53.2089 11.9873 53.3497 11.1271 52.9556C10.2697 52.5614 9.7226 51.7041 9.7226 50.7597C9.7226 50.7597 9.7226 26.8794 9.7226 14.5028C9.7226 9.16424 14.0517 4.83655 19.3904 4.83655H38.7289C44.0704 4.83655 48.3995 9.16424 48.3995 14.5028V50.7597C48.3995 51.7041 47.8495 52.5614 46.9922 52.9556C46.1348 53.3497 45.1252 53.2089 44.4088 52.5947L29.0611 39.4402ZM43.5656 14.5028C43.5656 11.8335 41.3996 9.66841 38.7289 9.66841C33.0207 9.66841 25.1014 9.66841 19.3904 9.66841C16.7196 9.66841 14.5565 11.8335 14.5565 14.5028V45.5056L27.4873 34.4215C28.3926 33.646 29.7266 33.646 30.6319 34.4215L43.5656 45.5056V14.5028Z" fill="white" />
								</svg>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card gradient-4 card-bx">
							<div class="card-body d-flex align-items-center">
								<div class="me-auto text-white">
									<h2 class="text-white"><?php echo $row_pending['pending_count']; ?></h2>
									<span class="fs-18">Pending Service</span>
								</div>
								<svg width="57" height="46" viewBox="0 0 57 46" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.55512 20.7503L11.4641 17.8435C12.3415 16.9638 12.3415 15.5397 11.4641 14.6601C10.5844 13.7827 9.16031 13.7827 8.28289 14.6601L1.53353 21.4094C0.653858 22.2891 0.653858 23.7132 1.53353 24.5929L8.28289 31.3422C9.16031 32.2197 10.5844 32.2197 11.4641 31.3422C12.3415 30.4626 12.3415 29.0385 11.4641 28.1588L8.55512 25.2498H27.8718C29.1137 25.2498 30.1216 24.2419 30.1216 23C30.1216 21.7604 29.1137 20.7503 27.8718 20.7503H8.55512Z" fill="white" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5038 31.9992V36.4987C16.5038 41.4708 20.5332 45.4979 25.5029 45.4979H48.0008C52.9728 45.4979 57 41.4708 57 36.4987C57 29.0092 57 16.9931 57 9.50129C57 4.53151 52.9728 0.502136 48.0008 0.502136C41.5687 0.502136 31.9373 0.502136 25.5029 0.502136C20.5332 0.502136 16.5038 4.53151 16.5038 9.50129V14.0009C16.5038 15.2427 17.5117 16.2507 18.7536 16.2507C19.9955 16.2507 21.0034 15.2427 21.0034 14.0009C21.0034 14.0009 21.0034 11.8928 21.0034 9.50129C21.0034 7.01752 23.0192 5.00171 25.5029 5.00171H48.0008C50.4868 5.00171 52.5004 7.01752 52.5004 9.50129V36.4987C52.5004 38.9848 50.4868 40.9983 48.0008 40.9983C41.5687 40.9983 31.9373 40.9983 25.5029 40.9983C23.0192 40.9983 21.0034 38.9848 21.0034 36.4987C21.0034 34.1095 21.0034 31.9992 21.0034 31.9992C21.0034 30.7595 19.9955 29.7494 18.7536 29.7494C17.5117 29.7494 16.5038 30.7595 16.5038 31.9992Z" fill="white" />
								</svg>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card gradient-3 card-bx">
							<div class="card-body d-flex align-items-center">
								<div class="me-auto text-white">
									<h2 class="text-white"><?php echo $row_in_progress['in_progress_count'] ?></h2>
									<span class="fs-18">In Progress Service</span>
								</div>
								<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M9.66671 38.6667V43.5C9.66671 48.8409 13.995 53.1667 19.3334 53.1667H43.5C48.8409 53.1667 53.1667 48.8409 53.1667 43.5C53.1667 35.455 53.1667 22.5475 53.1667 14.5C53.1667 9.16162 48.8409 4.83337 43.5 4.83337C36.5908 4.83337 26.245 4.83337 19.3334 4.83337C13.995 4.83337 9.66671 9.16162 9.66671 14.5V19.3334C9.66671 20.6674 10.7494 21.75 12.0834 21.75C13.4174 21.75 14.5 20.6674 14.5 19.3334C14.5 19.3334 14.5 17.069 14.5 14.5C14.5 11.832 16.6654 9.66671 19.3334 9.66671H43.5C46.1705 9.66671 48.3334 11.832 48.3334 14.5V43.5C48.3334 46.1705 46.1705 48.3334 43.5 48.3334C36.5908 48.3334 26.245 48.3334 19.3334 48.3334C16.6654 48.3334 14.5 46.1705 14.5 43.5C14.5 40.9335 14.5 38.6667 14.5 38.6667C14.5 37.3351 13.4174 36.25 12.0834 36.25C10.7494 36.25 9.66671 37.3351 9.66671 38.6667ZM27.9995 26.5834L24.8748 23.461C23.9323 22.5161 23.9323 20.9864 24.8748 20.0415C25.8197 19.099 27.3495 19.099 28.292 20.0415L35.542 27.2915C36.4869 28.2364 36.4869 29.7661 35.542 30.711L28.292 37.961C27.3495 38.9035 25.8197 38.9035 24.8748 37.961C23.9323 37.0161 23.9323 35.4864 24.8748 34.5415L27.9995 31.4167H7.25004C5.91604 31.4167 4.83337 30.334 4.83337 29C4.83337 27.6685 5.91604 26.5834 7.25004 26.5834H27.9995Z" fill="white" />
								</svg>

							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card gradient-2 card-bx">
							<div class="card-body d-flex align-items-center">
								<div class="me-auto text-white">
									<h2 class="text-white"><?php echo $row_completed['completed_count']; ?></h2>
									<span class="fs-18">Completed Service</span>
								</div>
								<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M36.25 9.66665V7.24998C36.25 5.91598 37.3327 4.83331 38.6667 4.83331C40.0007 4.83331 41.0833 5.91598 41.0833 7.24998V9.66665C46.4242 9.66665 50.75 13.9949 50.75 19.3333V43.5C50.75 48.8384 46.4242 53.1666 41.0833 53.1666C34.1741 53.1666 23.8283 53.1666 16.9167 53.1666C11.5782 53.1666 7.25 48.8384 7.25 43.5V19.3333C7.25 13.9949 11.5782 9.66665 16.9167 9.66665V7.24998C16.9167 5.91598 17.9993 4.83331 19.3333 4.83331C20.6673 4.83331 21.75 5.91598 21.75 7.24998V9.66665H36.25ZM45.9167 29H12.0833V43.5C12.0833 46.168 14.2487 48.3333 16.9167 48.3333H41.0833C43.7537 48.3333 45.9167 46.168 45.9167 43.5V29ZM33.5748 37.8329L36.9822 34.5172C37.9392 33.5868 39.469 33.6086 40.3994 34.5656C41.3298 35.5202 41.3081 37.0523 40.3535 37.9827L35.3848 42.8161C34.4955 43.6788 33.1011 43.732 32.1513 42.9393L29.4302 40.6677C28.4055 39.8146 28.2677 38.2896 29.1232 37.265C29.9763 36.2403 31.5012 36.1026 32.5259 36.9581L33.5748 37.8329ZM41.0833 14.5V16.9166C41.0833 18.2506 40.0007 19.3333 38.6667 19.3333C37.3327 19.3333 36.25 18.2506 36.25 16.9166V14.5H21.75V16.9166C21.75 18.2506 20.6673 19.3333 19.3333 19.3333C17.9993 19.3333 16.9167 18.2506 16.9167 16.9166V14.5C14.2487 14.5 12.0833 16.6629 12.0833 19.3333V24.1666H45.9167V19.3333C45.9167 16.6629 43.7537 14.5 41.0833 14.5Z" fill="white" />
								</svg>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->



		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">

			<div class="copyright">
				<p>Copyright © Designed &amp; Developed by <a href="https://dexignzone.com/" target="_blank">DexignZone</a> 2021</p>
			</div>
		</div>
		<!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

		<!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

	<!-- Chart piety plugin files -->
	<script src="./vendor/peity/jquery.peity.min.js"></script>

	<!-- Apex Chart -->
	<script src="./vendor/apexchart/apexchart.js"></script>

	<script src="vendor/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Dashboard 1 -->
	<script src="./js/dashboard/dashboard-1.js"></script>
	<script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>


	<script>
		$(function() {
			$('#datetimepicker').datetimepicker({
				inline: true,
			});
		});

		$(document).ready(function() {
			$(".booking-calender .fa.fa-clock-o").removeClass(this);
			$(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
		});
	</script>
</body>

</html>