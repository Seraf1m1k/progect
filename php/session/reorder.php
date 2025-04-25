<?php
require_once "../sqlconnect.php";
require_once "../functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $query = $conn->prepare("DELETE FROM `orders` WHERE `id` = ?");
    $query->bind_param("i", $_POST["orserid"]);
    $query->execute();
    $query->close();
    AlertJS("Успешно удалено!", 1, true, "user.php");
}
exit();
?>