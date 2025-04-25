<?php
require_once "../sqlconnect.php";
require_once "../functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $query = $conn->prepare("DELETE FROM `basket` WHERE `id` = ?");
    $query->bind_param("i", $_POST["basketid"]);
    $query->execute();
    $query->close();
    AlertJS("Успешно удалено!", 1, true, "cart.php");
}
exit();
?>