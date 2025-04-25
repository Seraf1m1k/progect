<?php
require_once "php/sqlconnect.php";
session_start();
$query = $conn->prepare("SELECT `id`, `dateStart`, `dateEnd`, `status`, `price` FROM `orders` WHERE `ordersUserID` = ?");
$query->bind_param("i",$_SESSION["id"]);
$query->execute();
$resultOrdersAll = $query->get_result();
$query->close();
?>