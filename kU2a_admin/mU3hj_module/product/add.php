<?php 
$error = null;
if (isset($_POST["btnProductAdd"])) {
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
	} elseif (empty($_FILES["newsImg"]["name"])) {
		$error = "Vui lòng chọn hình";
	} elseif (!getExt($_FILES["newsImg"]["name"],$ext_img)) {
		$error = "Hình này không đúng định dạng";
	} else {
		$data = array(
				'cate'     => $_POST["sltCate"],
				'name'     => $_POST["txtName"],
				'price'    => $_POST["txtPrice"],
				'quantity' => $_POST["txtQuantity"],
				'content'  => $_POST["txtFull"],
				'image'    => changeName($_FILES["newsImg"]["name"]),
				'tmp'      => $_FILES["newsImg"]["tmp_name"],
				'status'   => $_POST["rdoPublic"],
				'feature'  => $_POST["rdoFeature"]
			);
		product_add ($conn,$data,$error);
	}
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
					cate_parent ($conn);
				}
				?>
			</select>
		</span><br />
		<span class="form_label">Tên sản phẩm :</span>
		<span class="form_item">
			<input type="text" name="txtName" class="textbox" <?php issetInput('txtName') ?> />
		</span><br />
		<span class="form_label">Giá:</span>
		<span class="form_item">
			<input type="text" name="txtPrice" class="textbox" <?php issetInput('txtPrice') ?>  />
		</span><br />
		<span class="form_label">Số lượng:</span>
		<span class="form_item">
			<input type="number" name="txtQuantity" min="1" class="textbox" <?php issetInput('txtQuantity') ?> />
		</span><br />
		<span class="form_label">Nội dung:</span>
		<span class="form_item">
			<textarea name="txtFull" rows="8" class="textbox"><?php issetTextArea('txtFull') ?></textarea>
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
		<span class="form_label">Hình đại diện:</span>
		<span class="form_item">
			<input type="file" name="newsImg" class="textbox" />
		</span><br />
		<span class="form_label">Trang thái:</span>
		<span class="form_item">
			<input type="radio" name="rdoPublic" value="1" checked="checked" /> Hiện 
			<input type="radio" name="rdoPublic" value="0" /> Ẩn
		</span><br />
		<span class="form_label">Nổi bật:</span>
		<span class="form_item">
			<input type="radio" name="rdoFeature" value="1" checked="checked" /> Có 
			<input type="radio" name="rdoFeature" value="0" /> Không
		</span><br />
		<span class="form_label"></span>
		<span class="form_item">
			<input type="submit" name="btnProductAdd" value="Thêm sản phẩm" class="button" />
		</span>
	</fieldset>
</form>