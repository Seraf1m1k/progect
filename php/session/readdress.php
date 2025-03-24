<?php
require_once "../session.php";
session_start();

$address = trim($_POST["address"]);

if (empty($address)) 
{
    AlertJS( "Заполните все поля", 3);
    exit();
}

$query = $conn->prepare("UPDATE `users` SET `address` = ? WHERE `email` = ?");
$query->bind_param("ss", $address, $_SESSION["email"]);
$query->execute();
$query->close();
AlertJS("Успешно",1);
UpdateSessionDate($conn, $_SESSION["email"], "+f");

exit();
?>