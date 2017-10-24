<table class="list_table">
	<tr class="list_heading">
		<td class="id_col">STT</td>
		<td>Tên Sản Phẩm</td>
        <td>Danh Mục</td>
		<td>Giá</td>
		<td class="action_col">Quản lý?</td>
	</tr>
    <?php 
    $data = product_list($conn);
    $id = 0;
    foreach ($data as $item) {
    	$id = $id + 1;
    ?>
	<tr class="list_data">
        <td class="aligncenter"><?php echo $id ?></td>
        <td class="list_td aligncenter"><?php echo $item["product_name"] ?></td>
        <td class="list_td aligncenter"><?php echo $item["category_name"] ?></td>
        <td class="list_td aligncenter"><?php echo number_format($item["price"],0,",",".") ?> VNĐ</td>
        <td class="list_td aligncenter">
            <a href="index.php?p=sua-san-pham&id=<?php echo $item["id"] ?>"><img src="temp/images/edit.png" /></a>&nbsp;&nbsp;&nbsp;
            <a onclick="return acceptDel('Bạn có chắc muốn xóa sản phẩm này không ?')" href="index.php?p=xoa-san-pham&id=<?php echo $item["id"] ?>"><img src="temp/images/delete.png" /></a>
        </td>
    </tr>
    <?php } ?>
	
</table>