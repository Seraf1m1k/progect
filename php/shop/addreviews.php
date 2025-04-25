<?php
session_start();
require_once "../sqlconnect.php";
require_once "../functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["name"]))
{
    if (!isset($_POST["text"]))
    {
        AlertJS("Нельзя отправить пустой комментарий!", 2);
        exit();
    }
    $date = date("Y-m-d H:i:s");
    $query = $conn->prepare("INSERT INTO `reviews` (`reviewsProductID`, `reviewsUserID`, `reviewsText`, `reviewsStars`, `reviewsDate`) VALUE (?, ?, ?, ?, ?)");
    $query->bind_param("iisis", $_POST["productid"], $_SESSION["id"], $_POST["text"], $_POST["rating"], $date);
    $query->execute();
    $query->close();
    AlertJS("Комментарий успешно оправлен!", 1, true, "product.php?id=".$_POST["productid"]."#comments");
}
exit();
?>