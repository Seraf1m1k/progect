<?php
require_once "sqlconnect.php";
require_once "functions.php";

function StartSession(array $result)
{
    session_start();

    $_SESSION["name"] = $result["name"];
    $_SESSION["email"] = $result["email"];

    if (isset($result["address"]))
        $_SESSION["address"] = $result["address"];
    else
        $_SESSION["address"] = "";

    if (isset($result["phone_number"]))
        $_SESSION["phone_number"] = $result["phone_number"];
    else
        $_SESSION["phone_number"] = "";
}
function EndSession()
{
    session_unset();
    if (session_status() === PHP_SESSION_ACTIVE)
        session_destroy();
}
function UpdateSessionDate(mysqli $conn, string $email, string $password)
{
    if ($password == "+f")
    {
        $query = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $query->bind_param("s", $email);
    }
    else
    {
        $query = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
        $query->bind_param("ss", $email, $password);
    }
    $query->execute();
    $result = $query->get_result();
    $query->close();
    StartSession($result->fetch_assoc());
}
?>