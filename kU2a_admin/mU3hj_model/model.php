<?php 
function cate_add ($conn,$data,&$err) {
	$stmt_check = $conn->prepare("SELECT category_name FROM z3yk_category WHERE category_name = :category_name");
	$stmt_check->bindParam(":category_name",$data["name"],PDO::PARAM_STR);
	$stmt_check->execute();
	$count = $stmt_check->rowCount();
	if ($count == 0) {
		$stmt = $conn->prepare("INSERT INTO z3yk_category (category_name,parent_id) VALUES (:category_name,:parent_id)");
		$stmt->bindParam(":category_name",$data["name"],PDO::PARAM_STR);
		$stmt->bindParam(":parent_id",$data["parent"],PDO::PARAM_INT);
		$stmt->execute();
		redirect('danh-sach-the-loai');
	} else {
		$err = "Thể loại này đã tồn tại rồi";
	}
}

function cate_parent ($conn,$selected = 0,$parent = 0,$str = "---| ") {
	$stmt = $conn->prepare("SELECT * FROM z3yk_category WHERE parent_id = :parent_id");
	$stmt->bindParam(":parent_id",$parent,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $val) {
		if ($val["parent_id"] == $parent) {
			if ($selected == $val["id"]) {
				echo '<option value="'.$val["id"].'" selected>'.$str.$val["category_name"].'</option>';
			} else {
				echo '<option value="'.$val["id"].'">'.$str.$val["category_name"].'</option>';
			}
			cate_parent ($conn,$selected,$val["id"],$str . "---| ");
		}
	}
}

function cate_list ($conn,&$stt = 0,$parent = 0,$str = "---| ") {
	$stmt = $conn->prepare("SELECT * FROM z3yk_category WHERE parent_id = :parent_id");
	$stmt->bindParam(":parent_id",$parent,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $key => $val) {
		$stt++;
		if ($val["parent_id"] == $parent) {
			echo '<tr class="list_data">
			        <td class="aligncenter">'. $stt .'</td>
			        <td class="list_td alignleft">'.$str.$val["category_name"].'</td>
			        <td class="list_td aligncenter">
			            <a href="index.php?p=sua-the-loai&id='.$val["id"].'"><img src="temp/images/edit.png" /></a>&nbsp;&nbsp;&nbsp;
			            <a onclick="return acceptDel (\'Bạn có chắc muốn xóa thể loại này hay không ? \')" href="index.php?p=xoa-the-loai&id='.$val["id"].'"><img src="temp/images/delete.png" /></a>
			        </td>
			    </tr>';
			cate_list ($conn,$stt,$val["id"],$str . "---| ");
		}
	}
}

function cate_delete ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_category WHERE parent_id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->rowCount();
	if ($row == 0) {
		$stmt_delete = $conn->prepare("DELETE FROM z3yk_category WHERE id = :id");
		$stmt_delete->bindParam(":id",$id,PDO::PARAM_INT);
		$stmt_delete->execute();
		redirect("danh-sach-the-loai");
	} else {
		echo "
			<script type=\"text/javascript\">
				alert('Danh mục này tồn tại con');
				window.location.href = 'index.php?p=danh-sach-the-loai';
			</script>";
		exit();
	}
}

function data_edit_cate ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_category WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function cate_edit($conn,$data) {
	$stmt = $conn->prepare("UPDATE z3yk_category SET category_name = :category_name , parent_id = :parent_id WHERE id = :id");
	$stmt->bindParam(":category_name",$data["name"],PDO::PARAM_STR);
	$stmt->bindParam(":parent_id",$data["parent_id"],PDO::PARAM_INT);
	$stmt->bindParam(":id",$data["id"],PDO::PARAM_INT);
	$stmt->execute();
	redirect("danh-sach-the-loai");
}



function product_add ($conn,$data,&$err) {
	$stmt_check = $conn->prepare("SELECT product_name FROM  z3yk_product WHERE product_name = :product_name");
	$stmt_check->bindParam(":product_name",$data["name"],PDO::PARAM_STR);
	$stmt_check->execute();
	$count = $stmt_check->rowCount();
	if ($count == 0) {
		$stmt = $conn->prepare("INSERT INTO z3yk_product (product_name,quantity,price,image,content,featured,status,category_id) VALUES (:product_name,:quantity,:price,:image,:content,:featured,:status,:category_id)");
		$stmt->bindParam(":product_name",$data["name"],PDO::PARAM_STR);
		$stmt->bindParam(":quantity",$data["quantity"],PDO::PARAM_INT);
		$stmt->bindParam(":price",$data["price"],PDO::PARAM_INT);
		$stmt->bindParam(":image",$data["image"],PDO::PARAM_STR);
		$stmt->bindParam(":content",$data["content"],PDO::PARAM_STR);
		$stmt->bindParam(":featured",$data["feature"],PDO::PARAM_INT);
		$stmt->bindParam(":status",$data["status"],PDO::PARAM_INT);
		$stmt->bindParam(":category_id",$data["cate"],PDO::PARAM_INT);
		$stmt->execute();
		move_uploaded_file($data["tmp"], '../storage/product/'.$data["image"]);
		redirect('danh-sach-san-pham');
	} else {
		$err = "San phẩm này đã tồn tại rồi";
	}
}

function product_list ($conn) {
	$stmt = $conn->prepare("SELECT p.id , p.product_name , c.category_name , p.price FROM z3yk_product as p LEFT JOIN z3yk_category as c ON p.category_id = c.id");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function product_delete ($conn,$id) {
	$stmt_img = $conn->prepare("SELECT * FROM z3yk_product WHERE id = :id");
	$stmt_img->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt_img->execute();
	$data = $stmt_img->fetch();
	$img = '../storage/product/'.$data["image"];

	if (file_exists($img)) {
		unlink($img);
	}

	$stmt = $conn->prepare("DELETE FROM z3yk_product WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	redirect("danh-sach-san-pham");
}

function data_edit_product ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_product WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function product_edit ($conn,$data) {
	$stmt = $conn->prepare("UPDATE z3yk_product SET product_name = :product_name , quantity = :quantity , price = :price , image = :image , content = :content , featured = :featured , status = :status , category_id = :category_id WHERE id = :id");
	$stmt->bindParam(":product_name",$data["name"],PDO::PARAM_STR);
	$stmt->bindParam(":quantity",$data["quantity"],PDO::PARAM_INT);
	$stmt->bindParam(":price",$data["price"],PDO::PARAM_INT);
	$stmt->bindParam(":image",$data["image"],PDO::PARAM_STR);
	$stmt->bindParam(":content",$data["content"],PDO::PARAM_STR);
	$stmt->bindParam(":featured",$data["feature"],PDO::PARAM_INT);
	$stmt->bindParam(":status",$data["status"],PDO::PARAM_INT);
	$stmt->bindParam(":category_id",$data["cate"],PDO::PARAM_INT);
	$stmt->bindParam(":id",$data["id"],PDO::PARAM_INT);
	$stmt->execute();
	redirect('danh-sach-san-pham');
}

function user_add ($conn,$data,&$error) {
	$stmt_check = $conn->prepare("SELECT * FROM z3yk_user WHERE user = :user");
	$stmt_check->bindParam(":user",$data["user"],PDO::PARAM_STR);
	$stmt_check->execute();
	$count = $stmt_check->rowCount();
	if ($count == 0) {
		$stmt = $conn->prepare("INSERT INTO z3yk_user (user,pass,level) VALUES (:user,:pass,:level)");
		$stmt->bindParam(":user",$data["user"],PDO::PARAM_STR);
		$stmt->bindParam(":pass",$data["pass"],PDO::PARAM_STR);
		$stmt->bindParam(":level",$data["level"],PDO::PARAM_INT);
		$stmt->execute();
		redirect('danh-sach-thanh-vien');
	} else {
		$error = "Tài khoản này tồn tại rồi";
	}
}

function user_list ($conn) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_user ORDER BY id DESC");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function login ($conn,$data,&$error) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_user WHERE user = :user AND pass = :pass");
	$stmt->bindParam(":user",$data["user"],PDO::PARAM_STR);
	$stmt->bindParam(":pass",$data["pass"],PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->rowCount();
	if ($row != 0) {
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION["kU2L_id"] = $data["id"];
		$_SESSION["kU2L_user"] = $data["user"];
		$_SESSION["kU2L_level"] = $data["level"];
		redirect();
	} else {
		$error = "Bạn không được phép truy cập khu vực này";
	}
}

function info_user ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM z3yk_user WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function delete_user ($conn,$id) {
	$stmt = $conn->prepare("DELETE FROM z3yk_user WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	redirect("danh-sach-thanh-vien");
}

function user_edit ($conn,$data) {
	$stmt = $conn->prepare("UPDATE z3yk_user SET pass = :pass , level = :level WHERE id = :id");
	$stmt->bindParam(":pass",$data["pass"],PDO::PARAM_STR);
	$stmt->bindParam(":level",$data["level"],PDO::PARAM_INT);
	$stmt->bindParam(":id",$data["id"],PDO::PARAM_INT);
	$stmt->execute();
	redirect('danh-sach-thanh-vien');
}
?>