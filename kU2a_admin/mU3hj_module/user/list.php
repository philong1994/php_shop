<?php $data = user_list ($conn) ?>
<table class="list_table">
	<tr class="list_heading">
		<td class="id_col">STT</td>
		<td>Username</td>
		<td>Level</td>
		<td class="action_col">Quản lý?</td>
	</tr>
    <?php 
    $stt = 0;
    foreach ($data as  $value) {
        $stt = $stt + 1;
    ?>
	<tr class="list_data">
        <td class="aligncenter"><?php echo $stt; ?></td>
        <td class="list_td aligncenter"><?php echo $value ['user'] ?></td>
        <td class="list_td aligncenter">
            <?php 
                if ($value["id"] == 1) {
                    echo '<span style="color: green; font-weight: bold;">Superadmin</span>';
                } elseif ($value["level"] == 1) {
                    echo '<span style="color: red; font-weight: bold;">Admin</span>';
                } else {
                    echo '<span style="color: black; font-weight: bold;">Member</span>';
                }
            ?>
          
        </td>
        <td class="list_td aligncenter">
            <a href="index.php?p=sua-thanh-vien&id=<?php echo $value["id"] ?>"><img src="temp/images/edit.png" /></a>&nbsp;&nbsp;&nbsp;
            <a onclick="return acceptDel('Bạn có chắc muốn xóa thành viên này không ?')" href="index.php?p=xoa-thanh-vien&id=<?php echo $value["id"] ?>"><img src="temp/images/delete.png" /></a>
        </td>
    </tr> <?php } ?>
</table>