<?php
require_once "../session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($password) || empty($email)) 
    {
        AlertJS( "Заполните все поля", 3);
        exit();
    }

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    $query->bind_param("ss", $email, $password);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    if ($result->num_rows > 0)
    {
        StartSession($result->fetch_assoc());
        AlertJS("Успешно", 4, "user.php");
    }
    else
    {
        AlertJS("Неверно введена почта или пароль", 2);
    }

}
exit();
?>