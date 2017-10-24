<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$data = chitietsanpham ($conn,$id);

	if (isset($_GET["sl"])) {
		$sl = $_GET["sl"];
		if ($sl <= 0) {
			unset($_SESSION["cart"]["id"][$id]);
			unset($_SESSION["cart"]["name"][$id]);
			unset($_SESSION["cart"]["price"][$id]);
			unset($_SESSION["cart"]["quantity"][$id]);
		} elseif ($sl > 10) {
			$_SESSION["cart"]["id"][$id] = $id;
			$_SESSION["cart"]["name"][$id] = $data["product_name"];
			$_SESSION["cart"]["price"][$id] = $data["price"];
			$_SESSION["cart"]["quantity"][$id] = 10;
		} else {
			$_SESSION["cart"]["id"][$id] = $id;
			$_SESSION["cart"]["name"][$id] = $data["product_name"];
			$_SESSION["cart"]["price"][$id] = $data["price"];
			$_SESSION["cart"]["quantity"][$id] = $sl;
		}
	} else {
		$_SESSION["cart"]["id"][$id] = $id;
		$_SESSION["cart"]["name"][$id] = $data["product_name"];
		$_SESSION["cart"]["price"][$id] = $data["price"];
		$_SESSION["cart"]["quantity"][$id] = 1;
	}



	

	echo "<pre>";
	print_r($_SESSION["cart"]);
	echo "</pre>";

	redirect("gio-hang");
}
?>
