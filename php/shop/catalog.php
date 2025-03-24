<?php
require_once "php/sqlconnect.php";

$queryProducts = $conn->query("SELECT `products`.`id`, `nameProduct`, `priceProduct`, `category`.`name` AS categoryProductID, `imageProduct`  FROM `products` INNER JOIN `category` ON `category`.`id` = `products`.`categoryProductID`");
$queryCategory = $conn->query("SELECT `name` FROM `category`");
?>