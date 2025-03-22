<?php
require_once "sqlconnect.php";
require_once "functions.php";

function StartSession(array $result)
{
    session_start();

    $_SESSION["name"] = $result["name"];
    $_SESSION["email"] = $result["email"];

    if (isset($result["address"]))
    {
        $_SESSION["address"] = $result["address"];
    }
    else
    {
        $_SESSION["address"] = "";
    }

    if (isset($result["phone_number"]))
    {
        $_SESSION["phone_number"] = $result["phone_number"];
    }
    else
    {
        $_SESSION["phone_number"] = "";
    }
}
function EndSession()
{
    session_unset();
    if (session_status() === PHP_SESSION_ACTIVE)
    {
        session_destroy();
    }
}
?>