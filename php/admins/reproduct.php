<?php
require_once "../sqlconnect.php";
require_once "../functions.php";
$query = $conn->prepare("UPDATE `products` SET `nameProduct` = ?, `priceProduct` = ? WHERE `id` = ?");
$query->bind_param("ssi", $_POST["name"], $_POST["price"], $_POST["id"]);
$query->execute();
$query->close();
AlertJS("Успешно!", 1);
exit();
?>