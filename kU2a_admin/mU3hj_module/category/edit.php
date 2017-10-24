<?php 
if (!isset($_GET["id"])) {
	redirect("danh-sach-the-loai");
} else {
	$id = $_GET["id"];
	$error = null;
	secure_url ($id,"danh-sach-the-loai");
	$data_edit = data_edit_cate ($conn,$id);
	if (isset($_POST["btnCateEdit"])) {
		if (empty($_POST["txtCateName"])) {
			$error = "Vui lòng nhập thể loại";
		} else {
			$data = array(
					'id' => $id,
					'name' => $_POST["txtCateName"],
					'parent_id' => $_POST["sltParent"]
				);
			cate_edit($conn,$data);
		}
	}
}
?>

<?php error_msg ($error) ?>
<form action="" method="POST" style="width: 650px;">
	<fieldset>
		<legend>Thông Tin Danh Mục</legend>
		<span class="form_label">Danh mục cha:</span>
		<span class="form_item">
			<select name="sltParent" class="select">
				<option value="0">Vui lòng chọn danh mục cha</option>
				<?php 
				if (isset($_POST["sltParent"])) {
					cate_parent ($conn,$_POST["sltParent"]);
				} else {
					cate_parent ($conn,$data_edit["parent_id"]);
				}
				?>
			</select>
		</span><br />
		<span class="form_label">Tên danh mục:</span>
		<span class="form_item">
			<input type="text" name="txtCateName" class="textbox" <?php issetInput ('txtCateName',$data_edit["category_name"]) ?> />
		</span><br />
		<span class="form_label"></span>
		<span class="form_item">
			<input type="submit" name="btnCateEdit" value="Sửa danh mục" class="button" />
		</span>
	</fieldset>
</form>