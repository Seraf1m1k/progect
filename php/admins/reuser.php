<?php
require_once "../sqlconnect.php";
require_once "../functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if ($_POST["btn"] == "upd")
    {
        $query = $conn->prepare("UPDATE `users` SET `password` = ?, `name` = ? WHERE `id` = ?");
        $query->bind_param("ssi", $_POST["password"], $_POST["name"], $_POST["id"]);
        $query->execute();
        $query->close();
    }
    elseif ($_POST["btn"] == "del")
    {
        $query = $conn->prepare("DELETE FROM `users` WHERE `id` = ?");
        $query->bind_param("i", $_POST["id"]);
        $query->execute();
        $query->close();
    }
    AlertJS("Успешно!", 1);
    exit();
}
exit();
?>