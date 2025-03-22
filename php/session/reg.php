<?php
require_once "../sqlconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email) || empty($password)) 
    {
        die("Пожалуйста, заполните все поля.");
    }

    $query = $conn->prepare("SELECT `email` FROM `users` WHERE `email` == ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    if ($result->num_rows > 0)
    {
        die("Такая почта уже зарегестрирована.");
    }

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("INSERT INTO `users` (`name`,`email`,`password`) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $email, $password);
    $query->execute();
    $query->close();


    // header("Location: index.php");

}
?>