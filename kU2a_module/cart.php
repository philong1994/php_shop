<?php 
if (isset($_POST["btnUpdate"])) {

	foreach ($_POST["txtQuantity"] as $key => $value) {
		if ($value <= 0) {
			unset($_SESSION["cart"]["id"][$key]);
			unset($_SESSION["cart"]["name"][$key]);
			unset($_SESSION["cart"]["price"][$key]);
			unset($_SESSION["cart"]["quantity"][$key]);
		} elseif ($value > 10) {
			$_SESSION["cart"]["quantity"][$key] = 10;
		} else {
			$_SESSION["cart"]["quantity"][$key] = $value;
		}
		
	}
	
}
?>
<table border="1px" width="500px" align="center">
	<thead>
		<tr>
			<th>ID</th>
			<th>Tên Sản Phẩm</th>
			<th>Giá</th>
			<th>Số Lượng</th>
			<th>Thành Tiền</th>
			<th>Xóa</th>
		</tr>
	</thead>
	<form action="" method="POST">
	<tbody>
		<?php 
		$tongtien = 0;
		foreach ($_SESSION["cart"]["id"] as $val) { ?>
		<tr>
			<td><?php echo $val ?></td>
			<td><?php echo $_SESSION["cart"]["name"][$val] ?></td>
			<td><?php echo format_price($_SESSION["cart"]["price"][$val]) ?></td>
			<td><input type="number" name="txtQuantity[<?php echo $val ?>]" value="<?php echo $_SESSION["cart"]["quantity"][$val] ?>" placeholder=""></td>
			<td><?php
			$tien = $_SESSION["cart"]["quantity"][$val] * $_SESSION["cart"]["price"][$val]; 
			echo format_price($tien);
			$tongtien += $tien;
			?></td>
			<td><a href="index.php?p=add-cart&id=<?php echo $val ?>&sl=0" max="10">Xóa</a></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="4">Tổng Tiền : <?php echo format_price($tongtien) ?></td>
			<td colspan="2"><a href="index.php?p=thanh-toan">Thanh Toán</a></td>
		</tr>
		<tr>
			<td colspan="4"></td>
			<td colspan="2"><input type="submit" name="btnUpdate" value="Cập Nhật"></td>
		</tr>
	</tbody>
	</form>
</table>