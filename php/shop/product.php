<?php
require_once "php/sqlconnect.php";
require_once "php/functions.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]))
{
    $query = $conn->prepare("SELECT `id`, `nameProduct`, `priceProduct`, `descriptionProduct`, `descriptionProduct2`, `imageProduct` FROM `products` WHERE `id` = ?");
    $query->bind_param("i", $_GET["id"]);
    $query->execute();
    $resultProduct = $query->get_result()->fetch_assoc();
    $query = $conn->prepare("SELECT `reviews`.`reviewsText`, `reviews`.`reviewsStars`, `users`.`name` FROM `reviews` JOIN `users` ON `reviews`.`reviewsUserID` = `users`.`id` JOIN `products` ON `reviews`.`reviewsProductID` = `products`.`id` WHERE `products`.`id` = ? ORDER BY `reviews`.`reviewsDate` ASC");
    $query->bind_param("i", $_GET["id"]);
    $query->execute();
    $resultReviews = $query->get_result();
    $query->prepare("SELECT COUNT(`reviews`.`reviewsStars`) AS `total_rating`, AVG(`reviews`.`reviewsStars`) AS `average_rating` FROM `reviews` WHERE `reviews`.`reviewsProductID` = ?");
    $query->bind_param("i", $_GET["id"]);
    $query->execute();
    $resultCountReviews = $query->get_result()->fetch_assoc();
    $count = (int)$resultCountReviews["average_rating"];
    $countString = "";
    for ($i = 5; $i > 0; $i--)
    {
        if ($count - 1 > 0)
        {
            $countString = $countString."⭐";
            $count--; 
        }
        else
        {
            $countString = $countString."☆";
        }
    }
    $query->close();
}
?>