<?php
ob_start();
session_start();
include '../config.php';
include '../kU2a_vendor/connect.php';
include '../kU2a_vendor/functions.php';
include 'mU3hj_model/model.php';

if (isset($_SESSION["kU2L_level"])) {
    redirect();
}


$error = null;
if (isset($_POST["btnLogin"])) {
    if (empty($_POST["txtUser"])) {
        $error = "Vui lòng nhập Username";
    } elseif (empty($_POST["txtPass"])) {
        $error = "Vui lòng nhập Password";
    } else {
        $data = array(
                'user'  => $_POST["txtUser"],
                'pass'  => md5($_POST["txtPass"]),
            );
        login ($conn,$data,$error);
    }
}
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="QuocTuan.Info" />
    <link rel="stylesheet" href="temp/css/style.css" />
	<title>Admin Area :: Login</title>
</head>
<body>
<div id="layout">
    <div id="top">
        Admin Area :: Login
    </div>
    <div id="main">
        <?php error_msg($error); ?> 
		<form action="" method="POST" style="width: 650px; margin: 30px auto;">
            <fieldset>
                <legend>Thông Tin Đăng Nhập</legend>                
				<table>
                    <tr>
                        <td class="login_img"></td>
                        <td>
                            <span class="form_label">Username:</span>
                            <span class="form_item">
                                <input type="text" name="txtUser" class="textbox" />
                            </span><br />
                            <span class="form_label">Password:</span>
                            <span class="form_item">
                                <input type="password" name="txtPass" class="textbox" />
                            </span><br />
                            <span class="form_label"></span>
                            <span class="form_item">
                                <input type="submit" name="btnLogin" value="Đăng nhập" class="button" />
                            </span>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <div id="bottom">
        Copyright © 2016 by QuocTuan.Info
    </div>
</div>

</body>
</html>