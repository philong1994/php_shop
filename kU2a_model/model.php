<?php 
function trangchu ($conn) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_product ORDER BY id DESC LIMIT 10");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function theloai ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_category WHERE parent_id = :parent_id");
	$stmt->bindParam(":parent_id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;

}


function theloai_sanpham ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_product WHERE category_id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function chitietsanpham ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_product WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function cart ($conn,$data) {
	$stmt_info = $conn->prepare("INSERT INTO z3yk_customer (name,phone) VALUES (:name,:phone)");
	$stmt_info->bindParam(":name",$data["hoten"],PDO::PARAM_STR);
	$stmt_info->bindParam(":phone",$data["dienthoai"],PDO::PARAM_STR);
	$stmt_info->execute();
	$id = $conn->lastInsertId();

	foreach ($data["product"]["cart"]["id"] as $key => $value) {
		$stmt_cart = $conn->prepare("INSERT INTO z3yk_cart (idsp,quantity,id_customer) VALUES (:idsp,:quantity,:id_customer)");
		$stmt_cart->bindParam(":idsp",$data["product"]["cart"]["id"][$value],PDO::PARAM_INT);
		$stmt_cart->bindParam(":quantity",$data["product"]["cart"]["quantity"][$value],PDO::PARAM_INT);
		$stmt_cart->bindParam(":id_customer",$id,PDO::PARAM_INT);
		$stmt_cart->execute();
	}
}
?>

