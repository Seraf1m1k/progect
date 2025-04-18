<?php
require_once "php/sqlconnect.php";
$queryUsersForAdmins = $conn->query("SELECT `id`, `email`, `password`, `name` FROM `users`");
$queryCatalogForAdmins = $conn->query("SELECT `products`.`nameProduct`, `products`.`priceProduct`, `products`.`id` , SUM(`reviewsStars`) AS `totalStars`, COUNT(*) AS `reviewCount`, (SUM(`reviewsStars`) / COUNT(*)) AS `rating` FROM `reviews` JOIN `products` ON `reviews`.`reviewsProductID` = `products`.`id` GROUP BY `products`.`id`");
?>