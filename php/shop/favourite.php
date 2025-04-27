<?php
session_start();
require_once "../sqlconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["productid"]) && isset($_SESSION["id"]))
{
    $query = $conn->prepare("SELECT `id` FROM `favourites` WHERE `favouritesUserID` = ? AND `favouritesProductID` = ?");
    $query->bind_param("ii", $_SESSION["id"], $_GET["productid"]);
    $query->execute();
    $iffav = $query->get_result()->fetch_assoc();
    if (isset($iffav["id"]))
    {
        $query = $conn->prepare("DELETE FROM `favourites` WHERE `favouritesUserID` = ? AND `favouritesProductID` = ?");
        $query->bind_param("ii", $_SESSION["id"], $_GET["productid"]);
        $query->execute(); 
    }
    else
    {
        $query = $conn->prepare("INSERT INTO `favourites` (`favouritesUserID`, `favouritesProductID`) VALUE (?, ?)");  
        $query->bind_param("ii", $_SESSION["id"], $_GET["productid"]);
        $query->execute(); 
    }
    $query->close();
}
header("Location: ../../product.php?id=".$_GET["productid"]);
exit();
?>