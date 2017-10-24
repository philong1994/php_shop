<?php 
ob_start();
session_start();
include 'config.php';
include 'kU2a_vendor/connect.php';
include 'kU2a_vendor/functions.php';
include 'kU2a_model/model.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>welcome to Sancart</title>
<meta name="generator" content="Sancart" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Sancart" />
<meta name="Description" content="Sancart" />
<meta name="Author" content="Santosh Setty" />
<meta name="robots" content="all" />
<link rel="stylesheet" href="temp/css/style.css" type="text/css" media="screen" />
</head>
<body>
<!-- Wrapper Starts -->
	<div id="wrapper">
	<!-- Header Starts -->
		<?php include 'blocks/header.php'; ?>
	<!-- Header Ends -->
	<!-- Menu Starts  -->
		<?php include 'blocks/menu.php'; ?>
	<!-- Menu Ends -->
	<!-- Container Starts -->
		<div id="container" class="clearfix">
		<!-- Left Column Starts -->
			<?php include 'blocks/left.php'; ?>
		<!-- Left Column Ends -->

		<!-- Center Column Starts -->
			<div id="center-col">

			<?php 
			if (isset($_GET["p"])) {
				$p = $_GET["p"];
				switch ($p) {
					case 'trang-chu':
						include 'kU2a_module/trang-chu.php';
						break;
					case 'detail' : 
						include 'kU2a_module/detail.php';
						break;
					case 'add-cart' : 
						include 'kU2a_module/addcart.php';
						break;
					case 'the-loai' : 
						include 'kU2a_module/category.php';
						break;
					case 'gio-hang' : 
						include 'kU2a_module/cart.php';
						break;
					case 'thanh-toan' : 
						include 'kU2a_module/thanhtoan.php';
						break;
					default:
						include 'kU2a_module/trang-chu.php';
						break;
				}
			} else {
				include 'kU2a_module/trang-chu.php';
			}
			



			 ?>
			</div>
		<!-- Center Column Ends -->

		<!-- Right Column Starts -->
			<?php include 'blocks/right.php'; ?>
		<!-- Right Column Ends -->
		</div>
	<!-- Container Ends -->
	<!-- Footer Starts -->
		<div id="footer">
			<p class="floatleft">Copyright &copy; sancart   - the online shopping store</p>
			<p class="floatright"><a href="#">Create an Account</a>|<a href="#">Log In</a>|<a href="#">Privacy Notice</a>|<a href="#">Conditions of Use</a></p>
		</div>
	<!-- Footer Ends -->
	</div>
<!-- Wrapper Ends -->
</body>
</html>
