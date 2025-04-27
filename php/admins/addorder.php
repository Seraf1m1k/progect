<?php
session_start();
require_once "../functions.php";
require_once "../sqlconnect.php";
$dateStart = date("Y-m-d H:i:s");
$dateEnd = date("Y-m-d", strtotime("$dateStart +1 day"));
$status = "Доставлен";
$query = $conn->prepare("INSERT INTO `orders` (`dateStart`, `dateEnd`, `status`, `price`, `ordersUserID`) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("sssii", $dateStart, $dateEnd, $status, $_POST["price"], $_SESSION["id"]);
$query->execute();
$query = $conn->prepare("SELECT COUNT(*) FROM `basket` WHERE `basketUserID = ?`");
$query->bind_param("i",$_SESSION["id"]);
$query->execute();
if ($query->get_result()->num_rows < 0)
    {
        AlertJS("Нету товара в корзине", 3);
        exit();
    }
$query = $conn->prepare("DELETE FROM `basket` WHERE `basketUserID` = ?");
$query->bind_param("i", $_SESSION["id"]);
$query->execute();
$query->close();
AlertJS("Успешно!",1, true, "cart.php");
exit();
?>