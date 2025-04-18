<?php
require_once "php/sqlconnect.php";

$queryProducts = $conn->query("SELECT `products`.`id`, `nameProduct`, `priceProduct`, `category`.`name` AS `categoryProductID`, `imageProduct`  FROM `products` INNER JOIN `category` ON `category`.`id` = `products`.`categoryProductID`");
$queryCategory = $conn->query("SELECT `name`, `img` FROM `category`");
$queryTopProducts = $conn->query("SELECT `products`.`nameProduct`, `products`.`priceProduct`, `products`.`imageProduct` , SUM(`reviewsStars`) AS `totalStars`, COUNT(*) AS `reviewCount`, (SUM(`reviewsStars`) / COUNT(*)) AS `rating` FROM `reviews` JOIN `products` ON `reviews`.`reviewsProductID` = `products`.`id` GROUP BY `products`.`id` ORDER BY `rating` DESC LIMIT 3")
?>