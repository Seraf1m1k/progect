<?php
require_once "php/sqlconnect.php";
$queryUsersForAdmins = $conn->query("SELECT `id`, `email`, `password`, `name` FROM `users`");
$queryCatalogForAdmins = $conn->query("SELECT `id`, `nameProduct`, `priceProduct` FROM `products`");
?>