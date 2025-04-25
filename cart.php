<?php
require_once "header.php";
require_once "php/shop/basket.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    <section class="py-10">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-6">Корзина</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <?
                while($resultBasket = $resultBasketAll->fetch_assoc())
                {
                    $sumBasket = $sumBasket + $resultBasket["priceProduct"];
                ?>
                <form action="php/shop/removebasket.php">
                    <input type="hidden" name="basketid" value="<?=$resultBasket["id"]?>"/>
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center">
                            <img src="<?=$resultBasket["imageProduct"]?>" alt="Товар" class="rounded-lg">
                            <div class="ml-4">
                                <h3 class="text-lg font-bold"><?=$resultBasket["nameProduct"]?></h3>
                                <p class="text-gray-600"><?=$resultBasket["priceProduct"]?> ₽</p>
                            </div>
                        </div>
                        <button type="submit" class="text-red-500">Удалить</button>
                    </div>
                </form>
                <?
                }
                ?>
                <form action="php/admins/addorder.php">
                    <input type="hidden" name="price" value="<?=$sumBasket?>"/>
                    <div class="mt-6 text-right">
                        <p class="text-xl font-bold">Итого: <?=$sumBasket?> ₽</p>
                        <button type="submit" class="mt-4 bg-blue-500 text-white py-3 px-6 rounded hover:bg-blue-600">Оформить заказ</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>

</body>
</html>