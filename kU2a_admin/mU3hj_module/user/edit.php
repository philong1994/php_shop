<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url($id,"danh-sach-thanh-vien");
	$data = info_user ($conn,$id);

	$edit_myself = null;
	if ($_SESSION["kU2L_id"] == $id) {
	    $edit_myself = true;
	} else {
	    $edit_myself = false;
	}

	if ($_SESSION["kU2L_id"] != 1 && (($id == 1) || ($data["level"] == 1 && $edit_myself == false))) {
		echo '<script>
			alert("Bạn không được phép sửa thành viên này");
			window.location.href = "index.php?p=danh-sach-thanh-vien";
		</script>';
		exit();
	} 

	$error = null;
	if (isset($_POST["btnUserEdit"])) {
		if (empty($_POST["txtPass"])) {
			$pass = $data["pass"];
		} else {
			if ($_POST["txtPass"] != $_POST["txtRepass"]) {
				$error = "Hai mật khẩu không trùng nhau";
			} else {
				$pass = md5($_POST["txtPass"]);
			}
		}
		if ($edit_myself == true) {
			$level = $data["level"];
		} else {
			$level = $_POST["rdoLevel"];
		}
		$data = array(
			'pass'  => $pass,
			'level' => $level,
			'id'    => $id
			);
		user_edit ($conn,$data);
	}
}
?>
<form action="" method="POST" style="width: 650px;">
	<fieldset>
		<legend>Thông Tin User</legend>
		<span class="form_label">Username:</span>
		<span class="form_item">
			<input type="text" name="txtUser" disabled class="textbox" <?php issetInput('txtUser',$data["user"]) ?> />
		</span><br />
		<span class="form_label">Password:</span>
		<span class="form_item">
			<input type="password" name="txtPass" class="textbox" />
		</span><br />
		<span class="form_label">Confirm password:</span>
		<span class="form_item">
			<input type="password" name="txtRepass" class="textbox" />
		</span><br />
		<?php if ($edit_myself == false) { ?>
		<span class="form_label">Level:</span>
		<span class="form_item">
			<input type="radio" name="rdoLevel" value="1" 
			<?php 
			if ($data["level"] == 1) {
				echo 'checked';
			}
			?> /> Admin 
			<input type="radio" name="rdoLevel" value="2" 
			<?php 
			if ($data["level"] == 2) {
				echo 'checked';
			}
			?>
			/> Member
		</span><br />
		<?php } ?>
		<span class="form_label"></span>
		<span class="form_item">
			<input type="submit" name="btnUserEdit" value="Sửa User" class="button" />
		</span>
	</fieldset>
</form> 