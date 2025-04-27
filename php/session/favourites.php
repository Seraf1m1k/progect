<?php
session_start();
require_once "php/sqlconnect.php";
require_once "php/functions.php";
$query = $conn->prepare("SELECT `products`.`id`, `products`.`nameProduct`, `products`.`priceProduct`, `products`.`imageProduct` FROM `favourites` JOIN `products` ON `favourites`.`favouritesProductID` = `products`.`id` WHERE `favourites`.`favouritesUserID` = ?");
$query->bind_param("i", $_SESSION["id"]);
$query->execute();
$queryFavouritesALL = $query->get_result();
$query->close();
?>