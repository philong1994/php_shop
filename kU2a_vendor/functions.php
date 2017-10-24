<?php 
function error_msg ($error) {
	if ($error != null) {
		echo '<div class="error_msg">'.$error.'</div>';
	}
}

function error_mul_mes ($error) {
	if (!empty($error)) {
		echo '<ul class="error_msg">';
		foreach ($error as $item) {
			echo '<li >'.$item.'</li>';
		}
		echo '</ul>';
	}
}

function redirect ($url = '') {
	if ($url == '') {
		header("location:index.php");
		exit();
	} else {
		header("location:index.php?p=$url");
		exit();
	}
}

function issetInput ($name,$data = '') {
	if (isset($_POST["$name"])) {
		echo 'value="'.$_POST["$name"].'"';
	} else {
		echo 'value="'.$data.'"';
	}
}

function issetTextArea ($name,$data = '') {
	if (isset($_POST["$name"])) {
		echo $_POST["$name"];
	} else {
		echo $data;
	}
}

function secure_url ($id,$url) {
	settype($id,'int');
	if ($id <= 0) {
		redirect($url);
	}
}

function getExt ($name,$ext_img) {
	$pos = strrpos($name,".") + 1;
	$ext = strtolower(substr($name, $pos));
	if (in_array($ext, $ext_img)) {
		return true;
	} else {
		return false;
	}
}

function changeName ($img) {
	$name = strtolower($img);
	$name = str_replace(" ", "-", $name);
	$name = time()."_".$name;
	return $name;
}

function format_price ($gia) {
	return number_format($gia , 0 , "," , ".");
}
?>