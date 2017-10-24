<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url ($id,"danh-sach-san-pham");
	$data_edit = data_edit_product ($conn,$id);
	$error = null;
	if (isset($_POST["btnProductEdit"])) {
		if ($_POST["sltCate"] == "0") {
			$error = "Vui lòng chọn danh mục";
		} elseif (empty($_POST["txtName"])) {
			$error = "Vui lòng nhập tên sản phẩm";
		} elseif (empty($_POST["txtPrice"])) {
			$error = "Vui lòng nhập giá sản phẩm";
		} elseif (empty($_POST["txtQuantity"])) {
			$error = "Vui lòng nhập số lượng";
		} elseif (empty($_POST["txtFull"])) {
			$error = "Vui lòng nhập nội dung";
		} else {
			$data = array(
					'id'		=> $id,
					'cate'     => $_POST["sltCate"],
					'name'     => $_POST["txtName"],
					'price'    => $_POST["txtPrice"],
					'quantity' => $_POST["txtQuantity"],
					'content'  => $_POST["txtFull"],
					'status'   => $_POST["rdoPublic"],
					'feature'  => $_POST["rdoFeature"]
				);

			if (empty($_FILES["newsImg"]["name"])) {
				// khong chon hinh
				$data['image'] = $data_edit["image"];
			} else {
				// up hinh moi
				if (!getExt($_FILES["newsImg"]["name"],$ext_img)) {
					$error = "Hình này không đúng định dạng";
				} else {
					$img = '../storage/product/'.$data_edit["image"];
					if (file_exists($img)) {
						unlink($img);
					}
					$data['image'] = changeName($_FILES["newsImg"]["name"]);
					move_uploaded_file($_FILES["newsImg"]["tmp_name"], '../storage/product/'.$data['image']);
				}
			}
			product_edit ($conn,$data);
			
		}
	}
} else {
	redirect("danh-sach-san-pham");
}
?>

<?php error_msg($error) ?>
<form action="" method="POST" enctype="multipart/form-data" style="width: 650px;">
	<fieldset>
		<legend>Thông Tin Sản Phẩm</legend>
		<span class="form_label">Tên danh mục:</span>
		<span class="form_item">
			<select name="sltCate" class="select">
				<option value="0">Chọn danh mục</option>
				<?php 
				if (isset($_POST["sltCate"])) {
					cate_parent ($conn,$_POST["sltCate"]);
				} else {
					cate_parent ($conn,$data_edit["category_id"]);
				}
				?>
			</select>
		</span><br />
		<span class="form_label">Tên sản phẩm :</span>
		<span class="form_item">
			<input type="text" name="txtName" class="textbox" <?php issetInput('txtName',$data_edit["product_name"]) ?> />
		</span><br />
		<span class="form_label">Giá:</span>
		<span class="form_item">
			<input type="text" name="txtPrice" class="textbox" <?php issetInput('txtPrice',$data_edit["price"]) ?>  />
		</span><br />
		<span class="form_label">Số lượng:</span>
		<span class="form_item">
			<input type="number" name="txtQuantity" min="1" class="textbox" <?php issetInput('txtQuantity',$data_edit["quantity"]) ?> />
		</span><br />
		<span class="form_label">Nội dung:</span>
		<span class="form_item">
			<textarea name="txtFull" rows="8" class="textbox"><?php issetTextArea('txtFull',$data_edit["content"]) ?></textarea>
			<script type="text/javascript">
				var editor = CKEDITOR.replace('txtFull',{
					language:'vi',
					filebrowserImageBrowseUrl : '../kU2a_vendor/library/ckfinder/ckfinder.html?Type=Images',
					filebrowserFlashBrowseUrl : '../kU2a_vendor/library/ckfinder/ckfinder.html?Type=Flash',
					filebrowserImageUploadUrl : '../kU2a_vendor/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : '../kU2a_vendor/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				});
			</script>
		</span><br />
		<span class="form_label">Hình hiện tại:</span>
		<span class="form_item">
			<img src="../storage/product/<?php echo $data_edit["image"] ?>" width="100px" />
		</span><br />
		<span class="form_label">Hình đại diện:</span>
		<span class="form_item">
			<input type="file" name="newsImg" class="textbox" />
		</span><br />
		<span class="form_label">Trang thái:</span>
		<span class="form_item">
			<input type="radio" name="rdoPublic" value="1"
			<?php 
			if ($data_edit["status"] == 1) {
				echo 'checked';
			}
			?>
			 /> Hiện 
			<input type="radio" name="rdoPublic" value="0"
			<?php 
			if ($data_edit["status"] == 0) {
				echo 'checked';
			}
			?>
			 /> Ẩn
		</span><br />
		<span class="form_label">Nổi bật:</span>
		<span class="form_item">
			<input type="radio" name="rdoFeature" value="1"
			<?php 
			if ($data_edit["featured"] == 1) {
				echo 'checked';
			}
			?>
			 /> Có 
			<input type="radio" name="rdoFeature" value="0"
			<?php 
			if ($data_edit["featured"] == 0) {
				echo 'checked';
			}
			?>
			 /> Không
		</span><br />
		<span class="form_label"></span>
		<span class="form_item">
			<input type="submit" name="btnProductEdit" value="Sửa sản phẩm" class="button" />
		</span>
	</fieldset>
</form>