<?php
require_once "php/sqlconnect.php";
$query = $conn->prepare("SELECT `basket`.`id`, `products`.`nameProduct`, `products`.`priceProduct`, `products`.`imageProduct` FROM `basket` JOIN `products` ON `basket`.`basketProductID` = `products`.`id` WHERE `basket`.`basketUserID` = ?");
$query->bind_param("i", $_SESSION["id"]);
$query->execute();
$resultBasketAll = $query->get_result();
$sumBasket = 0;
?>