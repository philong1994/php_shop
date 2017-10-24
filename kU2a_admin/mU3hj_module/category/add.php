<?php 
$error = null;
if (isset($_POST["btnCateAdd"])) {

	if (empty($_POST["txtCateName"])) {
		$error = "Vui lòng nhập thể loại";
	} else {
		$data_add = array(
				'name'	=> $_POST["txtCateName"],
				'parent'=> $_POST["sltParent"]
			);
		cate_add ($conn,$data_add,$error);
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
					cate_parent ($conn);
				}
				?>
			</select>
		</span><br />
		<span class="form_label">Tên danh mục:</span>
		<span class="form_item">
			<input type="text" name="txtCateName" class="textbox"  <?php issetInput ("txtCateName") ?> />
		</span><br />
		<span class="form_label"></span>
		<span class="form_item">
			<input type="submit" name="btnCateAdd" value="Thêm danh mục" class="button" />
		</span>
	</fieldset>
</form>