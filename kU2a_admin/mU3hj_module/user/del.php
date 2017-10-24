<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url($id,"danh-sach-thanh-vien");
	$data = info_user ($conn,$id);
	if (($id == 1) || ($_SESSION["kU2L_id"] != 1 && $data["level"] == 1)) {
		echo '<script>
			alert("Bạn không được phép xóa thành viên này");
			window.location.href = "index.php?p=danh-sach-thanh-vien";
		</script>';
		exit();
	} else {
		delete_user ($conn,$id);
	}
}
?>