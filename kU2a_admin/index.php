<?php
ob_start();
session_start();
include '../config.php';
include '../kU2a_vendor/connect.php';
include '../kU2a_vendor/functions.php';
include 'mU3hj_model/model.php';

if (!isset($_SESSION["kU2L_level"]) || ($_SESSION["kU2L_level"] != 1)) {
	header("location:login.php");
	exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="QuocTuan.Info" />
    <link rel="stylesheet" href="temp/css/style.css" />
	<title>Admin Area :: Trang chính</title>
	<script type="text/javascript" src="../kU2a_vendor/library/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		function acceptDel (msg) {
			if (window.confirm(msg)) {
				return true;
			}
			return false;
		}
	</script>
</head>

<body>
<div id="layout">
    <div id="top">
        Admin Area :: Trang chính
    </div>
	<div id="menu">
		<table width="100%">
			<tr>
				<td>
					<a href="index.php">Trang chính</a> | <a href="index.php?p=danh-sach-thanh-vien">Quản lý user</a> | <a href="index.php?p=danh-sach-the-loai">Quản lý danh mục</a> | <a href="index.php?p=danh-sach-san-pham">Quản lý sản phẩm</a>
				</td>
				<td align="right">
					Xin chào <?php echo $_SESSION["kU2L_user"] ?> | <a href="logout.php">Logout</a>
				</td>
			</tr>
		</table>
	</div>
    <div id="main">
	<?php 
	if (isset($_GET["p"])) {
		$p = $_GET["p"];
		switch ($p) {
			case 'them-the-loai':
				include 'mU3hj_module/category/add.php';
				break;
			case 'xoa-the-loai':
				include 'mU3hj_module/category/del.php';
				break;
			case 'sua-the-loai':
				include 'mU3hj_module/category/edit.php';
				break;
			case 'danh-sach-the-loai':
				include 'mU3hj_module/category/list.php';
				break;
			case 'them-thanh-vien':
				include 'mU3hj_module/user/add.php';
				break;
			case 'xoa-thanh-vien':
				include 'mU3hj_module/user/del.php';
				break;
			case 'sua-thanh-vien':
				include 'mU3hj_module/user/edit.php';
				break;
			case 'danh-sach-thanh-vien':
				include 'mU3hj_module/user/list.php';
				break;
			case 'them-san-pham':
				include 'mU3hj_module/product/add.php';
				break;
			case 'xoa-san-pham':
				include 'mU3hj_module/product/del.php';
				break;
			case 'sua-san-pham':
				include 'mU3hj_module/product/edit.php';
				break;
			case 'danh-sach-san-pham':
				include 'mU3hj_module/product/list.php';
				break;
			default:
				include 'mU3hj_module/dashboard/index.php';
				break;
		}
	} else {
		include 'mU3hj_module/dashboard/index.php';
	}
	?>
	</div>
    <div id="bottom">
        Copyright © 2016 by QuocTuan.Info
    </div>
</div>

</body>
</html>