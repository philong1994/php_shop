<?php
try {
	$conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,
				DBUSER,
				DBPASS,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
	echo "Lỗi : " . $e->getMessage();
	die();
}

?>