<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url ($id,"danh-sach-san-pham");
	product_delete ($conn,$id);
} else {
	redirect("danh-sach-san-pham");
}
?>