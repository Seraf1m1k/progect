<?php
session_start();
require_once "../sqlconnect.php";
require_once "../functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["name"]))
{
    $query = $conn->prepare("SELECT `id`, `countProduct` FROM `basket` WHERE `basketUserID` = ? AND `basketProductID` = ?");
    $query->bind_param("ii", $_SESSION["id"], $_POST["productid"]);
    $query->execute();
    if ($query->get_result()->num_rows < 0)
    {
        $basket = $query->get_result()->fetch_assoc();
        $count = $basket["countProduct"] + $_POST["count"];
        $query = $conn->prepare("UPDATE `basket` SET `countProduct` = ? WHERE `id` = ?");
        $query->bind_param("ii",$count, $basket["id"]);
        $query->execute();
    }
    else
    {
        $query = $conn->prepare("INSERT INTO `basket` (`basketUserID`, `basketProductID`, `countProduct`) VALUE (?, ?, ?)");
        $query->bind_param("iii", $_SESSION["id"], $_POST["productid"], $_POST["count"]);
        $query->execute();
    }
    $query->close();
    AlertJS("Товар добавлен в корзину!", 1, true);
}
exit();
?>