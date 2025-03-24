<?php
require_once "../session.php";
session_start();

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$phone_number = trim($_POST["phone_number"]);

if (empty($name) || empty($email) || empty($phone_number)) 
{
    AlertJS( "Заполните все поля", 3);
    exit();
}

$query = $conn->prepare("UPDATE `users` SET `name` = ?, `email` = ?, `phone_number` = ? WHERE `email` = ?");
$query->bind_param("ssis", $name, $email, $phone_number, $_SESSION["email"]);
$query->execute();
$query->close();
AlertJS("Успешно",1);
UpdateSessionDate($conn, $email, "+f");

exit();
?>