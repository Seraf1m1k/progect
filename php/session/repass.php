<?php
require_once "../session.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $oldPass = trim($_POST["oldPassword"]);
    $newPass = trim($_POST["newPassword"]);
    $newPass1 = trim($_POST["newPassword2"]);

    if (empty($oldPass) || empty($newPass) || empty($newPass1)) 
    {
        AlertJS( "Заполните все поля", 3);
        exit();
    }

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT `email` FROM `users` WHERE `email` = ? AND `password` = ?");
    $query->bind_param("ss", $_SESSION["email"], $oldPass);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    if ($result->num_rows > 0)
    {
        if ($newPass === $newPass1)
        {
            $query = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ? AND `password` = ?");
            $query->bind_param("sss", $newPass, $_SESSION["email"], $oldPass);
            $query->execute();
            $query->close();
            AlertJS("Успешно",1);
            exit();
        }
        else
        {
            AlertJS("Введёные пароли не совпадают", 3);
            exit();
        }
    }
    else
    {
        AlertJS("Введёный пароль не верный", 3);
        exit();
    }
}
exit();
?>