<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url ($id,"danh-sach-the-loai");
	cate_delete ($conn,$id);
} else {
	redirect("danh-sach-the-loai");
}
?>