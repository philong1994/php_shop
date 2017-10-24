<?php 
if (isset($_POST["btnMua"])) {
	$hoten = $_POST["txtHoten"];
	$dienthoai = $_POST["txtDienThoai"];
	$data = array(
			'hoten'	=> $hoten,
			'dienthoai' => $dienthoai,
			'product'	=> $_SESSION
		);

	cart ($conn,$data);
	unset($_SESSION["cart"]);
	redirect();
}
?>
<form action="" method="POST" accept-charset="utf-8">
	<table>
		<tr>
			<td>Ho Ten</td>
			<td><input type="text" name="txtHoten" ></td>
		</tr>
		<tr>
			<td>Dien Thoai</td>
			<td><input type="text" name="txtDienThoai" ></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btnMua" value="Mua"></td>
		</tr>
	</table>
</form>