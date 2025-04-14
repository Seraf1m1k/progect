<?php
require_once "../sqlconnect.php";
require_once "../functions.php";
$query = $conn->query("DELETE FROM `products` WHERE `id` = ".$_GET["id"]);
AlertJS("Успешно!", 1);
exit();
?>